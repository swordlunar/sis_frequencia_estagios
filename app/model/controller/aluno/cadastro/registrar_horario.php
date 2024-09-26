<?php

include_once __DIR__ . "/../../../database/conexao_local.php";
include_once __DIR__ . "/../../controle e notificacoes/funcoes.php";
include __DIR__ . "/../../login/verifica_login.php";

$retorno = array(
    'status' => 0,
    'retorno' => 'Ocorreu um erro inesperado.'
);

$data_hora = hoje();
$data = date("Y-m-d");
$status_inicial = 0;
$verifica_registro_anterior = 0;

$RA = $_SESSION['MATRICULA'];
$CODCURSO = $_SESSION['COD_CURSO'];
$CODTURMA = $_SESSION['COD_TURMA'];
$periodo_letivo = $_SESSION['PERIODO_LETIVO'];

// echo $codigo;
// echo $tipo_entrada;
// echo $tipo_entrada;

if (isset($_POST['codigo'], $_POST['tipo_entrada'])) {
    $codigo = $_POST['codigo'];
    $tipo_entrada = $_POST['tipo_entrada'];

    switch ($tipo_entrada) {
        case 'Primeira entrada':
            $tipo_entrada = 'entrada_1';
            break;
        case 'Intervalo':
            $tipo_entrada = 'intervalo';
            break;
        case 'Volta do intervalo':
            $tipo_entrada = 'volta_intervalo';
            break;
        case 'Saída':
            $tipo_entrada = 'saida_1';
            break;
        case 'Segunda Entrada':
            $tipo_entrada = 'entrada_2';
            break;
        case 'Segunda Saída':
            $tipo_entrada = 'saida_2';
            break;
        default:
            echo 'erro!';
            break;
    }

    $conn = inicia_conexao();

    $verifica_aluno = "SELECT * FROM aluno WHERE matricula_aluno = :matricula_aluno AND cod_curso = :cod_curso AND turma = :cod_turma AND periodo_letivo = :periodo ";
    $ver_aluno = $conn->prepare($verifica_aluno);
    $ver_aluno->bindParam(':matricula_aluno', $RA);
    $ver_aluno->bindParam(':cod_curso', $CODCURSO);
    $ver_aluno->bindParam(':cod_turma', $CODTURMA);
    $ver_aluno->bindParam(':periodo', $periodo_letivo);
    $ver_aluno->execute();

    $verificacao_aluno = $ver_aluno->fetch(PDO::FETCH_ASSOC);


    // var_dump($verificacao_aluno);

    if (!empty($verificacao_aluno) && ($tipo_entrada != 'erro!') && ($codigo != '')) {
        $verifica_validade = "SELECT * FROM setor WHERE token_qrcode = :token AND data_expiracao_token >= :hoje AND id_setor = :setor";
        $ver_validade = $conn->prepare($verifica_validade);
        $ver_validade->bindParam(':token', $codigo);
        $ver_validade->bindParam(':hoje', $data_hora);
        $ver_validade->bindParam(':setor', $verificacao_aluno['id_setor']);

        $ver_validade->execute();

        $verificacao_validade = $ver_validade->fetch(PDO::FETCH_ASSOC);

        if (!empty($verificacao_validade)) { // Se existe o registro
            //consulta registro

            $verifica_registro = "SELECT * FROM registro_frequencia WHERE data_referencia = :data_referencia AND id_setor = :id_setor AND id_aluno = :id_aluno";
            $ver_registro = $conn->prepare($verifica_registro);
            $ver_registro->bindParam(':data_referencia', $data);
            $ver_registro->bindParam(':id_setor', $verificacao_aluno['id_setor']);
            $ver_registro->bindParam(':id_aluno', $verificacao_aluno['id_aluno']);
            $ver_registro->execute();
            $verificacao_registro = $ver_registro->fetch(PDO::FETCH_ASSOC);

            if (!empty($verificacao_registro)) {
                if ($verificacao_registro[$tipo_entrada] != NULL) {
                    $retorno['status'] = 8;
                    $retorno['retorno'] = 'Tipo de presença já registrada!';
                } else {

                    switch ($tipo_entrada) {
                        case 'intervalo':
                            if (($verificacao_registro['entrada_1'] != NULL) && ($verificacao_registro['saida_1'] == NULL)) {
                                $verifica_registro_anterior = 1;
                            };
                            break;
                        case 'volta_intervalo':
                            if ($verificacao_registro['intervalo'] != NULL) {
                                $verifica_registro_anterior = 1;
                            };
                            break;
                        case 'saida_1':
                            if (($verificacao_registro['entrada_1'] != NULL && $verificacao_registro['intervalo'] == NULL) || ($verificacao_registro['entrada_1'] != NULL && ($verificacao_registro['intervalo'] != NULL) && ($verificacao_registro['volta_intervalo'] != NULL))) {
                                $verifica_registro_anterior = 1;
                            };
                            break;
                        case 'entrada_2':
                            if ($verificacao_registro['saida_1'] != NULL) {
                                $verifica_registro_anterior = 1;
                            };
                            break;
                        case 'saida_2':
                            if ($verificacao_registro['entrada_2'] != NULL) {
                                $verifica_registro_anterior = 1;
                            };
                            break;
                        default:
                            $verifica_registro_anterior = 0;
                            break;
                    }

                    if ($verifica_registro_anterior == 1) {

                        try {
                            $atualizar_registro = "UPDATE registro_frequencia SET $tipo_entrada = :data_hora WHERE id_registro = :id_registro";
                            $mudar_registro = $conn->prepare($atualizar_registro);
                            $mudar_registro->bindParam(':data_hora', $data_hora);
                            $mudar_registro->bindParam(':id_registro', $verificacao_registro['id_registro']);

                            if ($mudar_registro->execute()) {
                                if ($mudar_registro->rowCount() > 0) {
                                    $retorno['status'] = 1;
                                    $retorno['retorno'] = '<p>Presença registrada com sucesso! </p> <p align="left"><strong>Tipo:</strong> ' . $_POST['tipo_entrada'] . '</p> <p align="left"><strong>Hora cadastrada:</strong> ' . date('H:i') . '</p>';                             
                                } else {
                                    $retorno['status'] = 11;
                                    $retorno['retorno'] = 'Erro ao tentar alterar o registro';
                                }
                            } else {
                                $retorno['status'] = 11;
                                $retorno['retorno'] = 'Erro ao tentar alterar o registro';
                            }
                        } catch (\Throwable $th) {
                            $retorno['status'] = 11;
                            $retorno['retorno'] = 'Erro ao tentar alterar o registro';
                        }
                    } else {
                        $retorno['status'] = 7;
                        $retorno['retorno'] = 'Voce esta tentando inserir um registro do tipo ' . $_POST['tipo_entrada'] . ' sem registrar o anterior.';
                    }
                }
            } else { // Se não existe o registro

                if ($tipo_entrada == 'entrada_1') {

                    try {
                        $inserir_registro = "INSERT INTO registro_frequencia (status_registro, data_referencia, entrada_1, criado_em, criado_por, editado_em, editado_por, id_aluno, id_setor) VALUES (:status_registro, :data_referencia, :entrada_1, :criado_em, :criado_por, :editado_em, :editado_por, :id_aluno, :id_setor)";
                        $novo_registro = $conn->prepare($inserir_registro);
                        $novo_registro->bindParam(':status_registro', $status_inicial);
                        $novo_registro->bindParam(':data_referencia', $data);
                        $novo_registro->bindParam(':entrada_1', $data_hora);
                        $novo_registro->bindParam(':criado_em', $data_hora);
                        $novo_registro->bindParam(':criado_por', $RA);
                        $novo_registro->bindParam(':editado_em', $data_hora);
                        $novo_registro->bindParam(':editado_por', $RA);
                        $novo_registro->bindParam(':id_aluno', $verificacao_aluno['id_aluno']);
                        $novo_registro->bindParam(':id_setor', $verificacao_aluno['id_setor']);

                        // echo 'Insert';

                        if ($novo_registro->execute()) {
                            if ($novo_registro->rowCount() > 0) {
                                $retorno['status'] = 1;
                                $retorno['retorno'] = '<p>Presença registrada com sucesso! </p> <p ><strong>Tipo:</strong> ' . $_POST['tipo_entrada'] . '</p> <p><strong>Hora cadastrada:</strong> ' . date('H:i') . '</p>';
                            } else {
                                $retorno['status'] = 2;
                                $retorno['retorno'] = 'Erro ao inserir o registro';
                            }
                        } else {
                            $retorno['status'] = 2;
                            $retorno['retorno'] = 'Erro ao inserir o registro';
                        }
                    } catch (\Throwable $th) {
                        $retorno['status'] = 9;
                        $retorno['retorno'] = "Ocorreu um erro inesperado ao tentar inserir o registro";
                    }
                } else {
                    $retorno['status'] = 3;
                    $retorno['retorno'] = 'Tipo de presença inválido';
                }
            }
        } else {
            $retorno['status'] = 4;
            $retorno['retorno'] = 'QR Code inválido e/ou data já expirada!';
        }
        echo json_encode($retorno);
    } else {
        $retorno['status'] = 5;
        $retorno['retorno'] = 'Aluno não identificado';
        echo json_encode($retorno);
    }
} else {
    $retorno['status'] = 6;
    $retorno['retorno'] = 'Qr code ou tipo de entrada não informados.';
    echo json_encode($retorno);
}
