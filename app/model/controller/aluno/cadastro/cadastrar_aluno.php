<?php
include_once __DIR__ . "/../../../database/conexao_local.php";

function cadastrar_aluno($array_info_aluno, $periodo_letivo, $hoje)
{
    $retorno = array(
        'status' => 0,
        'retorno' => 'Ocorreu um erro inesperado.'
    );

    $RA = $array_info_aluno->{'RA'};
    $NOME_ALUNO = $array_info_aluno->{'NOME_ALUNO'};
    $NOME_CURSO = $array_info_aluno->{'NOME_CURSO'};
    $CODCURSO = $array_info_aluno->{'CODCURSO'};
    $EMAIL = $array_info_aluno->{'EMAIL'};
    $TELEFONE = $array_info_aluno->{'TELEFONE'};
    $CODTURMA = $array_info_aluno->{'CODTURMA'};
    $HORAS_NECESSARIAS = $array_info_aluno->{'CARGA_HORARIA'};

    if (isset($RA, $NOME_ALUNO, $NOME_CURSO, $CODCURSO, $EMAIL, $TELEFONE, $CODTURMA)) {
        try {

            $conn = inicia_conexao();
            $status_estagio = 0;

            $verifica_aluno = "SELECT * FROM aluno WHERE matricula_aluno = :matricula_aluno AND cod_curso = :cod_curso AND turma = :cod_turma AND periodo_letivo = :periodo AND horas_necessarias = :horas_necessarias ";
            $ver_aluno = $conn->prepare($verifica_aluno);
            $ver_aluno->bindParam(':matricula_aluno', $RA);
            $ver_aluno->bindParam(':cod_curso', $CODCURSO);
            $ver_aluno->bindParam(':cod_turma', $CODTURMA);
            $ver_aluno->bindParam(':periodo', $periodo_letivo);
            $ver_aluno->bindParam(':horas_necessarias', $HORAS_NECESSARIAS);
            $ver_aluno->execute();

            $verficacao_aluno = $ver_aluno->fetch(PDO::FETCH_ASSOC);


            if (!empty($verficacao_aluno)) {
                $retorno['status'] = 1;
                $retorno['retorno'] = 'Estagiário já cadastrado!';
                return $retorno;
            } else {
                $query_estagiario = "INSERT INTO aluno (matricula_aluno, nome_aluno, nome_curso, cod_curso, email_aluno, telefone_aluno, turma, periodo_letivo, status_estagio, horas_necessarias, criado_em, criado_por, editado_em, editado_por) VALUES (:matricula_aluno, :nome_aluno, :nome_curso, :cod_curso, :email, :telefone, :cod_turma, :periodo, :status_estagio, :horas_necessarias, :criado_em, :criado_por, :editado_em, :editado_por)";
                $cad_estagiario = $conn->prepare($query_estagiario);
                $cad_estagiario->bindParam(':matricula_aluno', $RA);
                $cad_estagiario->bindParam(':nome_aluno', $NOME_ALUNO);
                $cad_estagiario->bindParam(':nome_curso', $NOME_CURSO);
                $cad_estagiario->bindParam(':cod_curso', $CODCURSO);
                $cad_estagiario->bindParam(':email', $EMAIL);
                $cad_estagiario->bindParam(':telefone', $TELEFONE);
                $cad_estagiario->bindParam(':cod_turma', $CODTURMA);
                $cad_estagiario->bindParam(':periodo', $periodo_letivo);
                $cad_estagiario->bindParam(':status_estagio', $status_estagio);
                $cad_estagiario->bindParam(':horas_necessarias', $HORAS_NECESSARIAS);
                $cad_estagiario->bindParam(':criado_em', $hoje);
                $cad_estagiario->bindParam(':criado_por', $RA);
                $cad_estagiario->bindParam(':editado_em', $hoje);
                $cad_estagiario->bindParam(':editado_por', $RA);

                $cad_estagiario->execute();

                //se entrou no banco de dados as informações
                if ($cad_estagiario->rowCount()) {
                    $retorno['status'] = 1;
                    $retorno['retorno'] = 'Estagiário cadastrado com sucesso!';
                } else {
                    //se não
                    $retorno['status'] = 2;
                    $retorno['retorno'] = 'Estagiário não cadastrado.';
                }
                return $retorno;
            }
        } catch (mysqli_sql_exception $e) {
            // var_dump($e);
            // exit;
            return $retorno;
        }
    } else {
        return $retorno;
    };
};
