<?php
include_once __DIR__ . "/../../../database/conexao_local.php";
include_once __DIR__ . "/../../controle e notificacoes/funcoes.php";
include __DIR__ . "/../../login/verifica_login.php";

$data_hora = hoje();

if ($_SESSION['TIPO_USUARIO'] == '2' || $_SESSION['TIPO_USUARIO'] == '3') {

    if ($_SESSION['TIPO_USUARIO'] == '2') {
        $usuario = $_SESSION['USUARIO_SUPERVISOR'] == '2';
    }

    $retorno = array(
        'status' => 0,
        'retorno' => 'Ocorreu um erro inesperado.'
    );

    if (isset($_POST['id_registro'])) {
        $conn = inicia_conexao();

        $consulta_registro = 'SELECT * FROM registro_frequencia WHERE id_registro = :id_registro';
        $prepara_registro = $conn->prepare($consulta_registro);
        $prepara_registro->bindParam(':id_registro', $_POST['id_registro']);
        $prepara_registro->execute();

        $resultado_registro = $prepara_registro->fetch(PDO::FETCH_ASSOC);

        if (!empty($resultado_registro)) {
            if ($resultado_registro['status_registro'] == 1) {
                $retorno['status'] = 4;
                $retorno['retorno'] = 'Frequência já aprovada!';
                echo json_encode($retorno);
            } else {
                $status_registro = 1;

                $consulta_registro = 'UPDATE registro_frequencia SET status_registro = :status_registro, editado_em = :editado_em, editado_por = :editado_por WHERE id_registro = :id_registro';
                $prepara_registro = $conn->prepare($consulta_registro);
                $prepara_registro->bindParam(':status_registro', $status_registro);
                $prepara_registro->bindParam(':id_registro', $_POST['id_registro']);
                $prepara_registro->bindParam(':editado_em', $data_hora);
                $prepara_registro->bindParam(':editado_por', $usuario);

                $prepara_registro->execute();

                if ($prepara_registro->rowCount()) {
                    $retorno['status'] = 1;
                    $retorno['retorno'] = 'Frequência aprovada com sucesso!';
                    echo json_encode($retorno);
                } else {
                    $retorno['status'] = 2;
                    $retorno['retorno'] = 'Não foi possível aprovar a frequência.';
                    echo json_encode($retorno);
                }
            }
        } else {
            $retorno['status'] = 3;
            $retorno['retorno'] = 'Registro não identificado.';
            echo json_encode($retorno);
        }
    }
}
