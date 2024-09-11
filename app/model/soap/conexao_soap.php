<?php
include_once __DIR__ . "/../env/env.php";


if (!function_exists('inicia_Conexao_Soap')) {

    function inicia_Conexao_Soap($tipo_conexao)
    {

        try {

            if ($tipo_conexao == 'conexaoDataServer') {
                $url = $_ENV['tbc_url_dataserver'];
            } else {
                $url = $_ENV['tbc_url_consultaSQL'];
            }

            $dados_acesso = array(
                'login' => $_ENV['usuario_tbc'],
                'password' => $_ENV['senha_tbc'],
                'authentication' => SOAP_AUTHENTICATION_BASIC,
                'trace' => 1,
                '_keep_alive' => false,
                'exceptions' => 0
            );

            $conexao = new SoapClient($url, $dados_acesso);

            return $conexao;
        } catch (SoapFault $exception) {
            echo json_encode($exception);
        }
    }
}
