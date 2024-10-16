<?php
include_once __DIR__ . "/../../../database/conexao_local.php";
include __DIR__ . "/../../login/verifica_login.php";

if ($_SESSION['TIPO_USUARIO'] == '2') {
    $retorno = array(
        'status' => 0,
        'retorno' => 'Ocorreu um erro inesperado.'
    );

    $conn = inicia_conexao();

    $consulta_setor = 'SELECT nome_setor FROM setor WHERE id_setor = :id_setor';
    $ver_setor = $conn->prepare($consulta_setor);
    $ver_setor->bindParam(':id_setor', $_SESSION['ID_SETOR']);
    $ver_setor->execute();

    $verificacao_setor = $ver_setor->fetch(PDO::FETCH_ASSOC);

    if (!empty($verificacao_setor)) {
        $retorno['status'] = 1;
        $retorno['retorno'] = $verificacao_setor['nome_setor'];
        echo json_encode($retorno);
    } else {
        $retorno['status'] = 2;
        echo json_encode($retorno);
    }
}
