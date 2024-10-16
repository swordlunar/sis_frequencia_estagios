<?php
include_once "../../database/conexao_local.php";

function login_supervisor($array_info_supervisor, $periodo_letivo)
{
    $retorno = array(
        'status' => 0,
        'retorno' => 'Ocorreu um erro inesperado.'
    );

    $USUARIO_SUPERVISOR = $array_info_supervisor['usuario_supervisor'];
    $NOME_SUPERVISOR = $array_info_supervisor['nome_supervisor'];
    $NOME_CURSO = $array_info_supervisor['nome_curso'];
    $CODCURSO = $array_info_supervisor['cod_curso'];
    $ID_SETOR = $array_info_supervisor['id_setor'];

    if (isset($USUARIO_SUPERVISOR, $NOME_SUPERVISOR, $NOME_CURSO, $CODCURSO, $ID_SETOR)) {
        if ($ID_SETOR == 0) {
            $retorno['status'] = 3;
            $retorno['retorno'] = 'Supervisor não cadastrado ou não alocado a um setor!';
            return $retorno;
        } else {
            try {

                $conn = inicia_conexao();
                $status_estagio = 0;

                $verifica_supervisor = "SELECT * FROM supervisor WHERE usuario_supervisor = :usuario_supervisor AND cod_curso = :cod_curso AND id_setor = :id_setor";
                $ver_supervisor = $conn->prepare($verifica_supervisor);
                $ver_supervisor->bindParam(':usuario_supervisor', $USUARIO_SUPERVISOR);
                $ver_supervisor->bindParam(':cod_curso', $CODCURSO);
                $ver_supervisor->bindParam(':id_setor', $ID_SETOR);
                $ver_supervisor->execute();

                $verificacao_supervisor = $ver_supervisor->fetch(PDO::FETCH_ASSOC);

                if (!empty($verificacao_supervisor)) {
                    $retorno['status'] = 1;
                    $retorno['retorno'] = 'Supervisor já cadastrado!';
                    
                    return $retorno;
                } else {
                    $retorno['status'] = 2;
                    $retorno['retorno'] = 'Supervisor não cadastrado!';

                    return $retorno;
                }
            } catch (mysqli_sql_exception $e) {
                // var_dump($e);
                // exit;
                return $retorno;
            }
        }
    } else {
        return $retorno;
    };
};
