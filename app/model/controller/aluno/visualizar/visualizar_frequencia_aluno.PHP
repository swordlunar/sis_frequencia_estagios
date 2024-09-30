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

    $conn = inicia_conexao();
    $verifica_registro = "SELECT * FROM registro_frequencia WHERE id_registro = :id_registro";
    $ver_registro = $conn->prepare($verifica_registro);
    $ver_registro->bindParam(':id_registro', $id_registro);

    $ver_registro->execute();

    $verificacao_registro = $ver_registro->fetch(PDO::FETCH_ASSOC);

    if (!empty($verificacao_registro)) {

        $verifica_aluno = "SELECT * FROM aluno WHERE id_aluno = :id_aluno ";
        $ver_aluno = $conn->prepare($verifica_aluno);
        $ver_aluno->bindParam(':id_aluno', $verificacao_registro['id_aluno']);
        $ver_aluno->execute();

        $verificacao_aluno = $ver_aluno->fetch(PDO::FETCH_ASSOC);

        if (!empty($verificacao_aluno)) {

            $verifica_setor = "SELECT * FROM setor WHERE id_setor = :setor";
            $ver_setor = $conn->prepare($verifica_setor);
            $ver_setor->bindParam(':setor', $verificacao_registro['id_setor']);

            $ver_setor->execute();

            $verificacao_setor = $ver_setor->fetch(PDO::FETCH_ASSOC);

            if (!empty($verificacao_setor)) {
                $retorno['status'] = 1;
                $retorno['dados'] = $verificacao_registro;
                $retorno['nome_aluno'] = $verificacao_aluno['nome_aluno'];
                $retorno['nome_setor'] = $verificacao_setor['nome_setor'];
            } else {
                $retorno['status'] = 2;
            }
        } else {
            $retorno['status'] = 3;
        }
        echo json_encode($retorno);
    } else {
        echo json_encode($retorno);
    }
} else {
    echo json_encode($retorno);
}
