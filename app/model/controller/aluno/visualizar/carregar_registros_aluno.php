<?php
include_once __DIR__ . "/../../../database/conexao_local.php";
include_once __DIR__ . "/../../controle e notificacoes/funcoes.php";
include __DIR__ . "/../../login/verifica_login.php";

if ($_SESSION['TIPO_USUARIO'] == '1') {
    $retorno = array(
        'status' => 0,
        'retorno' => 'Ocorreu um erro inesperado.'
    );

    $data_hora = hoje();
    $data = date("Y-m-d");

    $RA = $_SESSION['MATRICULA'];
    $CODCURSO = $_SESSION['COD_CURSO'];
    $CODTURMA = $_SESSION['COD_TURMA'];
    $periodo_letivo = $_SESSION['PERIODO_LETIVO'];

    $conn = inicia_conexao();

    $verifica_aluno = "SELECT * FROM aluno WHERE matricula_aluno = :matricula_aluno AND cod_curso = :cod_curso AND turma = :cod_turma AND periodo_letivo = :periodo ";
    $ver_aluno = $conn->prepare($verifica_aluno);
    $ver_aluno->bindParam(':matricula_aluno', $RA);
    $ver_aluno->bindParam(':cod_curso', $CODCURSO);
    $ver_aluno->bindParam(':cod_turma', $CODTURMA);
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
            $verifica_registro = "SELECT * FROM registro_frequencia WHERE data_referencia = :data_referencia AND id_aluno = :id_aluno";
            $ver_registro = $conn->prepare($verifica_registro);
            $ver_registro->bindParam(':data_referencia', $data);
            $ver_registro->bindParam(':id_aluno', $verificacao_aluno['id_aluno']);

            $ver_registro->execute();

            $verificacao_registro = $ver_registro->fetch(PDO::FETCH_ASSOC);

            if (!empty($verificacao_registro)) {
                $verificacao_registro['nome_setor'] = $verificacao_validade["nome_setor"];

                $retorno['status'] = 1;
                $retorno['retorno'] = $verificacao_registro;
            } else {
                $retorno['status'] = 2;
                $retorno['retorno'] = 'Erro';
            }
            echo json_encode($retorno);
        }
    }
}
