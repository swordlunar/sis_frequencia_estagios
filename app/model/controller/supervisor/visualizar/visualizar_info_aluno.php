<?php
include_once __DIR__ . "/../../../database/conexao_local.php";
include __DIR__ . "/../../login/verifica_login.php";

$retorno = array(
    'status' => 0,
    'retorno' => 'Ocorreu um erro inesperado.'
);

$conn = inicia_conexao();

if (isset($_POST['id_aluno'])) {
    $id_aluno = $_POST['id_aluno'];

    $query_estagiarios = "SELECT id_aluno, nome_aluno, matricula_aluno, telefone_aluno, email_aluno, id_setor FROM aluno WHERE id_aluno = :id_aluno";
    $result_estagiarios = $conn->prepare($query_estagiarios);
    $result_estagiarios->bindParam(':id_aluno', $id_aluno);
    $result_estagiarios->execute();

    $dados = "";

    if ($row_estagiario = $result_estagiarios->fetch(PDO::FETCH_ASSOC)) {

        $nome_setor = "SELECT nome_setor FROM setor WHERE id_setor = :id_setor";
        $result_nome_setor = $conn->prepare($nome_setor);
        $result_nome_setor->bindParam(':id_setor', $row_estagiario['id_setor']);
        $result_nome_setor->execute();

        if ($resultado_nome_setor = $result_nome_setor->fetch((PDO::FETCH_ASSOC))) {
            $dados .= '';
            $retorno['status'] = 1;
            $retorno['retorno'] = $row_estagiario;
            $retorno['nome_setor'] = $resultado_nome_setor['nome_setor'];
        } else {
            $retorno['status'] = 2;
            $retorno['retorno'] = 'Não foi possível encontrar o nome do setor';
        }
    } else {
        $retorno['status'] = 2;
        $retorno['retorno'] = 'Não foi possível encontrar o aluno';
    }
    echo json_encode($retorno);
} else {
    $retorno['retorno'] = 'Parametro id necessário para visualizar.';
    echo json_encode($retorno);
}
