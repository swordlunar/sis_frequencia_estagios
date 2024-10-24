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

    if (isset($_POST['id_registros'])) {
        $array_registros = $_POST['id_registros'];
        $status_registro = 1;

        $conn = inicia_conexao();

        
    } else {
        $retorno['status'] = 3;
        $retorno['retorno'] = 'Registros não identificado.';
        echo json_encode($retorno);
    }
}
