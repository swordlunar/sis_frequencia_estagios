<?php

include_once __DIR__ . "/../../../database/conexao_local.php";
include_once __DIR__ . "/../../controle e notificacoes/funcoes.php";
include __DIR__ . "/../../login/verifica_login.php";

$retorno = array(
    'status' => 0,
    'dados' => ''
);

if (isset($_POST['id_registro'])) {
    $id_registro = $_POST['id_registro'];

    // consulta aqui:

    $conn = inicia_conexao();
    $verifica_registro = "SELECT * FROM registro_frequencia WHERE id_registro = :id_registro";
    $ver_registro = $conn->prepare($verifica_registro);
    $ver_registro->bindParam(':id_registro', $id_registro);

    $ver_registro->execute();

    $verificacao_registro = $ver_registro->fetch(PDO::FETCH_ASSOC);

    // var_dump($verificacao_registro);

    if (!empty($verificacao_registro)) {

        
        $retorno['status'] = 1;
        $retorno['dados'] = $verificacao_registro;

        echo json_encode($retorno);
    } else {
        echo json_encode($retorno);
    }
} else {
    echo json_encode($retorno);
}
