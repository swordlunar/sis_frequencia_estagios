<?php
include_once __DIR__ . "/../../../database/conexao_local.php";
include_once __DIR__ . "/../../controle e notificacoes/funcoes.php";
include __DIR__ . "/../../login/verifica_login.php";

$data_hora = hoje();

if ($_SESSION['TIPO_USUARIO'] == '2' || $_SESSION['TIPO_USUARIO'] == '3') {

    if ($_SESSION['TIPO_USUARIO'] == '2') {
        $usuario = $_SESSION['USUARIO_SUPERVISOR'];
    }

    $retorno = array(
        'status' => 0,
        'retorno' => 'Ocorreu um erro inesperado.'
    );

    if (isset($_POST['id_registro'], $_POST['entrada_1'], $_POST['saida_1'],)) {

        $conn = inicia_conexao();

        $consulta_registro = 'SELECT * FROM registro_frequencia WHERE id_registro = :id_registro';
        $prepara_registro = $conn->prepare($consulta_registro);
        $prepara_registro->bindParam(':id_registro', $_POST['id_registro']);
        $prepara_registro->execute();

        $resultado_registro = $prepara_registro->fetch(PDO::FETCH_ASSOC);

        if (!empty($resultado_registro)) {
            $data = $resultado_registro['data_referencia'];

            $entrada_1 = $_POST['entrada_1'];
            $intervalo = $_POST['intervalo'];
            $volta_intervalo = $_POST['volta_intervalo'];
            $saida_1 = $_POST['saida_1'];
            $entrada_2 = $_POST['entrada_2'];
            $saida_2 = $_POST['saida_2'];

            $alt_entrada_1 = date('Y-m-d H:i:s', strtotime("$data $entrada_1"));
            $alt_saida_1 = date('Y-m-d H:i:s', strtotime("$data $saida_1"));

            if (!empty($intervalo) && !empty($volta_intervalo)) {
                $alt_intervalo = date('Y-m-d H:i:s', strtotime("$data $intervalo"));
                $alt_volta_intervalo = date('Y-m-d H:i:s', strtotime("$data $volta_intervalo"));
            } else {
                $alt_intervalo = NULL;
                $alt_volta_intervalo = NULL;
            }
            if (!empty($entrada_2) && !empty($saida_2)) {
                $alt_entrada_2 = date('Y-m-d H:i:s', strtotime("$data $entrada_2"));
                $alt_saida_2 = date('Y-m-d H:i:s', strtotime("$data $saida_2"));
            } else {
                $alt_entrada_2 = NULL;
                $alt_saida_2 = NULL;
            }

            $consulta_registro = 'UPDATE registro_frequencia SET entrada_1 = :entrada_1, intervalo = :intervalo, volta_intervalo = :volta_intervalo, saida_1 = :saida_1, entrada_2 = :entrada_2, saida_2 = :saida_2, editado_em = :editado_em, editado_por = :editado_por, observacao_registro = :observacao_registro WHERE id_registro = :id_registro';
            $prepara_registro = $conn->prepare($consulta_registro);
            $prepara_registro->bindParam(':id_registro', $_POST['id_registro']);
            $prepara_registro->bindParam(':entrada_1', $alt_entrada_1);
            $prepara_registro->bindParam(':intervalo', $alt_intervalo);
            $prepara_registro->bindParam(':volta_intervalo', $alt_volta_intervalo);
            $prepara_registro->bindParam(':saida_1', $alt_saida_1);
            $prepara_registro->bindParam(':entrada_2', $alt_entrada_2);
            $prepara_registro->bindParam(':saida_2', $alt_saida_2);
            $prepara_registro->bindParam(':editado_em', $data_hora);
            $prepara_registro->bindParam(':editado_por', $usuario);
            $prepara_registro->bindParam(':observacao_registro', $_POST['observacao_registro']);
            $prepara_registro->execute();

            if ($prepara_registro->rowCount()) {
                $retorno['status'] = 1;
                $retorno['retorno'] = 'Registro alterado com sucesso!';
                echo json_encode($retorno);
            } else {
                $retorno['status'] = 2;
                $retorno['retorno'] = 'Não foi possível alterar o registro.';
                echo json_encode($retorno);
            }
        } else {
            $retorno['status'] = 3;
            $retorno['retorno'] = 'Registro não identificado.';
            echo json_encode($retorno);
        }
    }
}
