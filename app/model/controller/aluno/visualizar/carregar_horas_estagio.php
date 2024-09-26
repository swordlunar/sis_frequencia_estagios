<?php

include_once __DIR__ . "/../../../database/conexao_local.php";
include_once __DIR__ . "/../../controle e notificacoes/funcoes.php";
include __DIR__ . "/../../login/verifica_login.php";

$retorno = array(
    'status' => 0,
    'horas_estagiadas' => '',
    'hora_total' => ''
);

$RA = $_SESSION['MATRICULA'];
$CODCURSO = $_SESSION['COD_CURSO'];
$periodo_letivo = $_SESSION['PERIODO_LETIVO'];

$segundos_estagiados  = 0;

$conn = inicia_conexao();

$verifica_aluno = "SELECT * FROM aluno WHERE matricula_aluno = :matricula_aluno AND cod_curso = :cod_curso AND periodo_letivo = :periodo ";
$ver_aluno = $conn->prepare($verifica_aluno);
$ver_aluno->bindParam(':matricula_aluno', $RA);
$ver_aluno->bindParam(':cod_curso', $CODCURSO);
$ver_aluno->bindParam(':periodo', $periodo_letivo);
$ver_aluno->execute();

$verificacao_aluno = $ver_aluno->fetch(PDO::FETCH_ASSOC);

if (!empty($verificacao_aluno)) {
    $verifica_registro = "SELECT * FROM registro_frequencia WHERE id_aluno = :id_aluno";
    $ver_registro = $conn->prepare($verifica_registro);
    $ver_registro->bindParam(':id_aluno', $verificacao_aluno['id_aluno']);

    $ver_registro->execute();

    $verificacao_registro = $ver_registro->fetch(PDO::FETCH_ASSOC);

    // var_dump(($verificacao_registro));

    if (!empty($verificacao_registro)) {

        if ($verificacao_registro['saida_1']) {

            $segundos_registro = "SELECT TIMESTAMPDIFF(SECOND, entrada_1, saida_1) + 
                IFNULL(TIMESTAMPDIFF(SECOND, entrada_2, saida_2), 0) - 
                IFNULL(TIMESTAMPDIFF(SECOND, intervalo, volta_intervalo), 0) as segundos_totais FROM 
                `registro_frequencia` 
                WHERE entrada_1 IS NOT NULL 
                AND saida_1 IS NOT NULL 
                AND id_aluno = :id_aluno";

            $contar_segundos_registro = $conn->prepare($segundos_registro);
            $contar_segundos_registro->bindParam(':id_aluno', $verificacao_aluno['id_aluno']);

            $contar_segundos_registro->execute();

            $tempo_registro = $contar_segundos_registro->fetchAll(PDO::FETCH_ASSOC);

            // var_dump($tempo_registro);

            if (!empty($tempo_registro)) {
                foreach ($tempo_registro as $dia) {
                    $segundos_estagiados += $dia['segundos_totais'];
                    // var_dump($dia['segundos_totais']);
                }

                $horas = floor($segundos_estagiados / 3600);
                // var_dump($horas);
                $minutos = floor(($segundos_estagiados % 3600) / 60);

                $horas_necessarias = $verificacao_aluno['horas_necessarias'];


                $retorno['status'] = 1;
                $retorno['horas_estagiadas'] = $horas . ',' . $minutos;
                $retorno['hora_total'] = $horas_necessarias;
                $retorno['porcentagem'] = $horas * 100 / $horas_necessarias;
            }
        }
    }
    echo json_encode($retorno);
}
