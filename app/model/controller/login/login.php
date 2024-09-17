<?php

include_once "../../database/conexao_local.php";
include_once __DIR__ . "/../../env/env.php";
include_once __DIR__ . "/../../soap/conexao_soap.php";
include_once __DIR__ . "/../controle e notificacoes/funcoes.php";
include_once __DIR__ . "/../aluno/cadastro/cadastrar_aluno.php";

//Array de retorno exemplo
$retorno = array(
    'status' => 0,
    'informacao_adicional' => ''
);

$periodo_letivo = periodo_letivo_atual();
$hoje = hoje();

//Verifica se as variáves foram passadas pela requisição
if (!empty($_POST["usuario"]) && !empty($_POST["senha"])) {

    //Pega os valores das variáveis passadas pelo metodo "POST"
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    // if (!isset($_POST['cursos'])) {
    //     $auth = base64_encode($usuario . ':' . $senha);

    //     $curl = curl_init();

    //     // Api responsável por validar o acesso do usuário
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://tbc.unileao.edu.br:8051/RMSRestDataServer/getAvailableServices',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'GET',
    //         CURLOPT_HTTPHEADER => array(
    //             'Authorization: Basic ' . $auth . ''
    //         ),
    //     ));

    //     $response = curl_exec($curl);

    //     $info = curl_getinfo($curl);

    //     curl_close($curl);
    // } else {
    //     $info["http_code"] == 401;
    // }

    $info["http_code"] = 200;

    if ($info["http_code"] == 200) {

        if ($_POST['tipo_usuario'] == 'aluno') {

            try {

                $conexao = inicia_Conexao_Soap('conexaoSql');


                $sentenca = 'FREQEST.001';

                $parametros = array(
                    'codSentenca' => $sentenca,
                    'codColigada' => 1,
                    'codSistema' => 'G',
                    'Usuario' => $_ENV['usuario_tbc'],
                    'Senha' => $_ENV['senha_tbc'],
                    'parameters' => 'COLIGADA=' . $_ENV['COD_COLIGADA'] . ';IDPERLET=' . $periodo_letivo . ';USUARIO=' . $usuario . ''
                );


                $resultado = $conexao->RealizarConsultaSQL($parametros);

                $response = json_decode(json_encode(simplexml_load_string($resultado->RealizarConsultaSQLResult)), FALSE);

                $result = isset($response->Resultado) == false ? null : $response->Resultado;

            } catch (SoapFault $exception) {
                echo json_encode($exception->getMessage());
            }

            if ($result == null) {
                $retorno['status'] = 0;
                $retorno['informacao_adicional'] = "Sem permissão para acessar o sistema no tipo de login selecionado!";
                echo json_encode($retorno);

            } else {
                // Configurando o array de retorno no caso do sucesso (Ex: Status = 1)
                // var_dump($result);
                $verifica_aluno = cadastrar_aluno($result, $periodo_letivo, $hoje);
                if ($verifica_aluno['status'] == 1){
                    session_start();

                    $_SESSION['MATRICULA'] = $result->{'RA'};
                    $_SESSION['NOME'] = $result->{'NOME_ALUNO'};
                    $_SESSION['COD_CURSO'] = $result->{'CODCURSO'};
                    $_SESSION['NOME_CURSO'] = $result->{'NOME_CURSO'};
                    $_SESSION['COD_TURMA'] = $result->{'CODTURMA'};
                    $_SESSION['PERIODO_LETIVO'] = $periodo_letivo;

                    // $_SESSION['ID_SETOR'] = 1;

                    $_SESSION['TIPO_USUARIO'] = 1;


                    $retorno['status'] = 1;
                    $retorno['informacao_adicional'] = "O login do usuário <b>" . $usuario . "</b> foi realizado com sucesso!";
                    echo json_encode($retorno);
                 }else{
                    $retorno['status'] = 0;
                    $retorno['informacao_adicional'] = "Erro no login!";
                    echo json_encode($retorno);
                 }                
            }

        } else if ($_POST['tipo_usuario'] == 'supervisor') {
            echo json_encode($retorno);
        } else if ($_POST['tipo_usuario'] == 'coordenador') {
            echo json_encode($retorno);
        } else {
            // Configurando o array de retorno no caso do erro (Ex: Status = 0)
            $retorno['status'] = 0;
            $retorno['informacao_adicional'] = "Selecione um tipo de usuário para prosseguir com o login!";
        }

    
    } else {
        // Obtendo o retorno do erro da api de validação
        $erro_msg = json_decode($response);

        $erro = array(
            'status' => 3,
            'informacao_adicional' => $erro_msg->message
        );

        echo json_encode($erro);
    }
} else {
    // Configurando o array de retorno no caso do erro (Ex: Status = 0)
    $retorno['informacao_adicional'] = "Os valores do POST não chegaram do lado do servidor";
    // Retornamos o array de retorno como um 'json' para que o ajax entenda a resposta bem sucedida
    echo json_encode($retorno);
}
