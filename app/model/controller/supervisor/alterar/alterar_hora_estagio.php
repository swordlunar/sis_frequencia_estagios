<?php
include_once __DIR__ . "/../../../database/conexao_local.php";
include __DIR__ . "/../../login/verifica_login.php";

if ($_SESSION['TIPO_USUARIO'] == '2' || $_SESSION['TIPO_USUARIO'] == '3') {
    $retorno = array(
        'status' => 0,
        'retorno' => 'Ocorreu um erro inesperado.'
    );

    // $conn = inicia_conexao();

    // if (isset($_POST['id_registro'])) {
    //     $id_registro = $_POST['id_registro'];

    //     if (!empty($_POST['entrada_1'])) {
    //         $consulta_registro = 'UPDATE registro_frequencia SET entrada_1 = :entrada_1, intervalo = :intervalo, volta_intervalo = :volta_intervalo, saida_1 = :saida_1, entrada_2 = :entrada_2, saida_2 = :saida_2 WHERE id_registro = :id_registro';
    //         $prepara_registro = $conn->prepare($consulta_registro);
    //         $prepara_registro->bindParam(':id_registro', $_POST['id_registro']);
    //         $prepara_registro->bindParam(':entrada_1', $_POST['entrada_1']);
    //         $prepara_registro->bindParam(':intervalo', $_POST['intervalo']);
    //         $prepara_registro->bindParam(':volta_intervalo', $_POST['volta_intervalo']);
    //         $prepara_registro->bindParam(':saida_1', $_POST['saida_1']);
    //         $prepara_registro->bindParam(':entrada_2', $_POST['entrada_2']);
    //         $prepara_registro->bindParam(':saida_2', $_POST['saida_2']);
    //         $prepara_registro->execute();

    //         if ($prepara_registro->rowCount()) {
    $retorno['status'] = 1;
    $retorno['retorno'] = 'Registro alterado!';
    $retorno['entrada'] = $_POST['entrada_1'];
    echo json_encode($retorno);
    //         } else {
    //             $retorno['status'] = 2;
    //             $retorno['retorno'] = 'Não foi possível alterar o registro.';
    //             echo json_encode($retorno);
    //         }
    //     } else {
    //         $retorno['status'] = 3;
    //         $retorno['retorno'] = 'Impossível alterar com a entrada em branco!';
    //         echo json_encode($retorno);
    //     }
    // } else {
    //     $retorno['status'] = 4;
    //     echo json_encode($retorno);
    // }
}
