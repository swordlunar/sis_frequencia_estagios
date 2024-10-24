<?php
include_once __DIR__ . "/../../../database/conexao_local.php";
include __DIR__ . "/../../login/verifica_login.php";

$retorno = array(
    'status' => 0,
    'retorno' => 'Ocorreu um erro inesperado.'
);

$conn = inicia_conexao();

if ($_SESSION['TIPO_USUARIO'] == '2') {
    if (isset($_POST['id_aluno'])) {
        $validade = 0;
        $status_registro = 0;

        $id_aluno = $_POST['id_aluno'];

        if ($_POST['mes_filtrado'] != '') {
            $ano_atual = date('Y');
            $mes_filtrado = $_POST['mes_filtrado'];

            switch ($mes_filtrado) {
                case 'janeiro':
                    $data_inicio = "$ano_atual-01-01";
                    $data_fim = "$ano_atual-01-31";
                    break;
                case 'fevereiro':
                    $data_inicio = "$ano_atual-02-01";
                    $data_fim = "$ano_atual-02-31";
                    break;
                case 'março':
                    $data_inicio = "$ano_atual-03-01";
                    $data_fim = "$ano_atual-03-31";
                    break;
                case 'abril':
                    $data_inicio = "$ano_atual-04-01";
                    $data_fim = "$ano_atual-04-31";
                    break;
                case 'maio':
                    $data_inicio = "$ano_atual-05-01";
                    $data_fim = "$ano_atual-05-31";
                    break;
                case 'junho':
                    $data_inicio = "$ano_atual-06-01";
                    $data_fim = "$ano_atual-06-31";
                    break;
                case 'julho':
                    $data_inicio = "$ano_atual-07-01";
                    $data_fim = "$ano_atual-07-31";
                    break;
                case 'agosto':
                    $data_inicio = "$ano_atual-08-01";
                    $data_fim = "$ano_atual-08-31";
                    break;
                case 'setembro':
                    $data_inicio = "$ano_atual-09-01";
                    $data_fim = "$ano_atual-09-31";
                    break;
                case 'outubro':
                    $data_inicio = "$ano_atual-10-01";
                    $data_fim = "$ano_atual-10-31";
                    break;
                case 'novembro':
                    $data_inicio = "$ano_atual-11-01";
                    $data_fim = "$ano_atual-11-31";
                    break;
                case 'dezembro':
                    $data_inicio = "$ano_atual-12-01";
                    $data_fim = "$ano_atual-12-31";
                    break;

                default:
                    echo "Mês inválido!";
                    exit;
            }

            $consulta_status = 'SELECT * FROM registro_frequencia WHERE id_aluno = :id_aluno AND id_setor = :id_setor AND status_registro = :status_registro AND (data_referencia BETWEEN :data_inicio AND :data_fim) ';
            $ver_status = $conn->prepare($consulta_status);
            $ver_status->bindParam(':id_aluno', $id_aluno);
            $ver_status->bindParam(':id_setor', $_SESSION['ID_SETOR']);
            $ver_status->bindParam(':status_registro', $status_registro);
            $ver_status->bindParam(':data_inicio', $data_inicio);
            $ver_status->bindParam(':data_fim', $data_fim);

            $ver_status->execute();

            while ($row_registro = $ver_status->fetchALL(PDO::FETCH_ASSOC)) {
                $validade = 1;

                $registro = [];
                $registro[] = $row_registro;
            }

            if ($validade != 1) {
                $retorno['status'] = 2;
                $retorno['retorno'] = 'O aluno não possui pendências nesse mês';
                echo json_encode($retorno);
            } else {
                $retorno['status'] = 1;
                $retorno['retorno'] = $registro;
                echo json_encode($retorno);
            }
        } else {
            $retorno['status'] = 1;
            echo json_encode($retorno);
        }
    }
}
