<?php
include_once __DIR__ . "/../../../database/conexao_local.php";
include __DIR__ . "/../../login/verifica_login.php";

if ($_SESSION['TIPO_USUARIO'] == '2') {
    $validade = 0;

    $id_aluno = $_POST['id_aluno'];
    $status_registro = 0;

    $retorno = array(
        'status' => 0,
        'retorno' => 'Ocorreu um erro inesperado.'
    );

    $conn = inicia_conexao();

    $consulta_status = 'SELECT * FROM registro_frequencia WHERE id_aluno = :id_aluno AND status_registro = :status_registro';
    $ver_status = $conn->prepare($consulta_status);
    $ver_status->bindParam(':id_aluno', $id_aluno);
    $ver_status->bindParam(':status_registro', $status_registro);

    $ver_status->execute();

    while ($row_registro = $ver_status->fetch(PDO::FETCH_ASSOC)) {
        $validade = 1;
        extract($row_registro);

        $registro = [];
        $registro[] = $data_referencia;
        $registro[] = $entrada_1;
        $registro[] = $intervalo;
        $registro[] = $volta_intervalo;
        $registro[] = $saida_1;
        $registro[] = $entrada_2;
        $registro[] = $saida_2;
        $registro[] = $status_registro;
        $registro[] = '<td><input type="checkbox"></td>';
        $dados[] = $registro;
    }

    if ($validade != 1) {
        $retorno['status'] = 2;
        $retorno['retorno'] = 'O estágiario já possui todos seus registros aprovados';
        echo json_encode($retorno);
    } else {
        $retorno['status'] = 1;
        $retorno['retorno'] = $dados;
        echo json_encode($retorno);
    }
}
