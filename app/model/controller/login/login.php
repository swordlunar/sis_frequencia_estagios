<?php

include_once "../../database/conexao_local.php";

//Array de retorno exemplo
$retorno = array(
    'status' => 0,
    'informacao_adicional' => ''
);

sleep(2);

//Verifica se as variáves foram passadas pela requisição
if (isset($_POST['usuario'], $_POST['senha'])) {

    //Pega os valores das variáveis passadas pelo metodo "POST"
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);

    // Aqui fariamos alguma coisa com esses dados Ex:

    //Exemplo do OPIS
    // try {
    //     $resultado = $db->from('usuarios')
    //         ->where('senha')->is($senha)
    //         ->andWhere('id_usuario')->is($usuario)
    //         ->select()
    //         ->all();

    //     if ($resultado) {
    //         $retorno['status'] = 1;
    //         $retorno['informacao_adicional'] = "O login do usuário <b>" . $usuario . "</b> foi realizado com sucesso!";
            
    //         session_start();

    //         $_SESSION["NOME"] = $resultado[0]->{'nome_usuario'};
    //         $_SESSION["TIPO_USUARIO"] =  $resultado[0]->{'tipo_usuario'};
    //     } else {
    //         $retorno['status'] = 0;
    //         $retorno['informacao_adicional'] = "Não foi possivel realizar o login do usuário <b>" . $usuario . "</b>!";
    //     }
    // } catch (\Throwable $th) {
    //     throw $th;
    // }

    // PDO do PHP
    $conn = inicia_conexao();

    $query_login = "SELECT *
    FROM usuarios
    WHERE id_usuario=? AND senha = ?";
    $resultado_usuario = $conn->prepare($query_login);
    $resultado_usuario->bind_param('ss', $usuario, $senha);
    $resultado_usuario->execute();
    $resultado = $resultado_usuario->get_result();

    if (($resultado) && ($resultado->num_rows != 0)) {
        // Configurando o array de retorno no caso do sucesso (Ex: Status = 1)
        $retorno['status'] = 1;
        $retorno['informacao_adicional'] = "O login do usuário <b>" . $usuario . "</b> foi realizado com sucesso!";

        $resultado = $resultado->fetch_assoc();

        session_start();
        $_SESSION["NOME"] = $resultado['nome_usuario'];
        $_SESSION["TIPO_USUARIO"] = $resultado['tipo_usuario'];
    } else {
        // Configurando o array de retorno no caso da falha (Ex: Status = 0)
        $retorno['status'] = 0;
        $retorno['informacao_adicional'] = "Não foi possivel realizar o login do usuário <b>" . $usuario . "</b>!";
    }

    // Retornamos o array de retorno como um 'json' para que o ajax entenda a resposta bem sucedida
    echo json_encode($retorno);
} else {
    // Configurando o array de retorno no caso do erro (Ex: Status = 0)
    $retorno['informacao_adicional'] = "Os valores do POST não chegaram do lado do servidor";
    // Retornamos o array de retorno como um 'json' para que o ajax entenda a resposta bem sucedida
    echo json_encode($retorno);
}
