<?php
include_once __DIR__ . "/../../../database/conexao_local.php";
include_once __DIR__ . "/../../controle e notificacoes/funcoes.php";
include __DIR__ . "/../../login/verifica_login.php";

$retorno = array(
    'status' => 0,
    'dados' => ''
);

if ($_SESSION['TIPO_USUARIO'] == '1') {
    $RA = $_SESSION['MATRICULA'];
    $CODCURSO = $_SESSION['COD_CURSO'];
    $periodo_letivo = $_SESSION['PERIODO_LETIVO'];
} else if ($_SESSION['TIPO_USUARIO'] == '2' || $_SESSION['TIPO_USUARIO'] == '3') {
    if (!empty($_POST['ra_aluno']) && !empty($_POST['cod_curso'])) {
        $RA = $_POST['ra_aluno'];
        $CODCURSO = $_POST['cod_curso'];
        $periodo_letivo = $_SESSION['PERIODO_LETIVO'];
    }
}

if (isset($RA, $CODCURSO, $periodo_letivo)) {

    $conn = inicia_conexao();

    $verifica_aluno = "SELECT * FROM aluno WHERE matricula_aluno = :matricula_aluno AND cod_curso = :cod_curso AND periodo_letivo = :periodo ";
    $ver_aluno = $conn->prepare($verifica_aluno);
    $ver_aluno->bindParam(':matricula_aluno', $RA);
    $ver_aluno->bindParam(':cod_curso', $CODCURSO);
    $ver_aluno->bindParam(':periodo', $periodo_letivo);
    $ver_aluno->execute();

    $verificacao_aluno = $ver_aluno->fetch(PDO::FETCH_ASSOC);

    if (!empty($verificacao_aluno)) {
        $verifica_validade = "SELECT * FROM setor WHERE id_setor = :setor";
        $ver_validade = $conn->prepare($verifica_validade);
        $ver_validade->bindParam(':setor', $verificacao_aluno['id_setor']);

        $ver_validade->execute();

        $verificacao_validade = $ver_validade->fetch(PDO::FETCH_ASSOC);

        if (!empty($verificacao_validade)) {
            $verifica_registro = "SELECT * FROM registro_frequencia WHERE id_aluno = :id_aluno";
            $ver_registro = $conn->prepare($verifica_registro);
            $ver_registro->bindParam(':id_aluno', $verificacao_aluno['id_aluno']);

            $ver_registro->execute();

            $verificacao_registro = $ver_registro->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($verificacao_registro)) {
                $evento = [];
                foreach ($verificacao_registro as $linha) {
                    if ($linha['entrada_1']) {
                        $evento[] = [
                            'title' => 'Entrada',
                            'start' => $linha['entrada_1'],
                            'end' => $linha['entrada_1'],
                            'color' => '#24a424',
                            'id' => $linha['id_registro'],
                            'tipo' => 'entrada_1'
                        ];
                    }
                    if ($linha['intervalo']) {
                        $evento[] = [
                            'title' => 'Intervalo',
                            'start' => $linha['intervalo'],
                            'end' => $linha['intervalo'],
                            'color' => '#ec5353',
                            'id' => $linha['id_registro'],
                            'tipo' => 'intervalo'
                        ];
                    }
                    if ($linha['volta_intervalo']) {
                        $evento[] = [
                            'title' => 'Volta do intervalo',
                            'start' => $linha['volta_intervalo'],
                            'end' => $linha['volta_intervalo'],
                            'color' => '#24a424',
                            'id' => $linha['id_registro'],
                            'tipo' => 'volta_intervalo'
                        ];
                    }
                    if ($linha['saida_1']) {
                        $evento[] = [
                            'title' => 'Saída',
                            'start' => $linha['saida_1'],
                            'end' => $linha['saida_1'],
                            'color' => '#ec5353',
                            'id' => $linha['id_registro'],
                            'tipo' => 'saida_1'
                        ];
                    }
                    if ($linha['entrada_2']) {
                        $evento[] = [
                            'title' => 'Segunda entrada',
                            'start' => $linha['entrada_2'],
                            'end' => $linha['entrada_2'],
                            'color' => '#24a424',
                            'id' => $linha['id_registro'],
                            'tipo' => 'entrada_2'
                        ];
                    }
                    if ($linha['saida_2']) {
                        $evento[] = [
                            'title' => 'Segunda saída',
                            'start' => $linha['saida_2'],
                            'end' => $linha['saida_2'],
                            'color' => '#ec5353',
                            'id' => $linha['id_registro'],
                            'tipo' => 'saida_2'
                        ];
                    }
                }
                $retorno['status'] = 1;
                $retorno['dados'] = $evento;

                echo json_encode($retorno);
            } else {
                $retorno['status'] = 2;
                echo json_encode($retorno);
            }
        } else {
            $retorno['status'] = 3;
            echo json_encode($retorno);
        }
    } else {
        $retorno['status'] = 4;
        echo json_encode($retorno);
    }
} else {
    $retorno['status'] = 5;
    $retorno['dados'] = $_POST['ra_aluno'];
    $retorno['dados_cod_curso'] = $_POST['cod_curso'];
    echo json_encode($retorno);
}
