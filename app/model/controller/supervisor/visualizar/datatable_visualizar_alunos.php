<?php
include_once __DIR__ . "/../../../database/conexao_local.php";
include __DIR__ . "/../../login/verifica_login.php";

if ($_SESSION['TIPO_USUARIO'] == '2' || $_SESSION['TIPO_USUARIO'] == '3') {
    $ID_SETOR = $_SESSION['ID_SETOR'];

    $request_data = $_REQUEST;

    $colunas = [
        0 => 'nome_aluno',
        1 => 'matricula_aluno',
        2 => 'email_aluno',
        3 => 'turma'
    ];

    $conn = inicia_conexao();

    //Consulta da quantidade de usuários para o recordsTotal e recordsFiltered
    $query_qnt_usuarios = "SELECT COUNT(id_aluno) AS qnt_usuarios FROM aluno WHERE id_setor = :id_setor";
    if (!empty($request_data['search']['value'])) {  //se tiver algo dentro da barra de pesquisa
        $query_qnt_usuarios .= " AND (nome_aluno LIKE :nome";
        $query_qnt_usuarios .= " OR matricula_aluno LIKE :ra";
        $query_qnt_usuarios .= " OR email_aluno LIKE :email";
        $query_qnt_usuarios .= " OR turma LIKE :turma)";
    }
    //Prepara a query
    $result_qnt_usuarios = $conn->prepare($query_qnt_usuarios);
    //Pesquisar
    // $result_qnt_usuarios->bindParam(':id_setor', $verificacao_id_setor['id_setor']);
    $result_qnt_usuarios->bindParam(':id_setor', $ID_SETOR);
    if (!empty($request_data['search']['value'])) {
        $valor_pesq = "%" . $request_data['search']['value'] . "%"; //like com % antes e depois para obter consultas só de ter o valor.
        $result_qnt_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
        $result_qnt_usuarios->bindParam(':ra', $valor_pesq, PDO::PARAM_STR);
        $result_qnt_usuarios->bindParam(':email', $valor_pesq, PDO::PARAM_STR);
        $result_qnt_usuarios->bindParam(':turma', $valor_pesq, PDO::PARAM_STR);
    }

    $result_qnt_usuarios->execute();
    $row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);

    // Recuperar os registros do bando de dados
    $query_estagiarios = "SELECT id_aluno, nome_aluno, matricula_aluno, cod_curso, email_aluno, turma FROM aluno WHERE id_setor = :id_setor";

    //Pesquisar
    if (!empty($request_data['search']['value'])) {
        $query_estagiarios .= " AND (nome_aluno LIKE :nome";
        $query_estagiarios .= " OR matricula_aluno LIKE :ra";
        $query_estagiarios .= " OR email_aluno LIKE :email";
        $query_estagiarios .= " OR turma LIKE :turma)";
    }

    //Ordenar registros
    $query_estagiarios .= " ORDER BY " . $colunas[$request_data['order'][0]['column']] . " " . $request_data['order'][0]['dir'] . " LIMIT :inicio, :quantidade";
    $result_estagiarios = $conn->prepare($query_estagiarios);
    // $result_estagiarios->bindParam(':id_setor', $verificacao_id_setor['id_setor']);
    $result_estagiarios->bindParam(':id_setor', $ID_SETOR);
    $result_estagiarios->bindParam(':inicio', $request_data['start'], PDO::PARAM_INT);
    $result_estagiarios->bindParam(':quantidade', $request_data['length'], PDO::PARAM_INT);

    //Inserir o bindparam no if
    if (!empty($request_data['search']['value'])) {
        $valor_pesq = "%" . $request_data['search']['value'] . "%";
        $result_estagiarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
        $result_estagiarios->bindParam(':ra', $valor_pesq, PDO::PARAM_STR);
        $result_estagiarios->bindParam(':email', $valor_pesq, PDO::PARAM_STR);
        $result_estagiarios->bindParam(':turma', $valor_pesq, PDO::PARAM_STR);
    }

    $result_estagiarios->execute();

    while ($row_usuario = $result_estagiarios->fetch(PDO::FETCH_ASSOC)) {
        // var_dump($row_usuario);
        extract($row_usuario); //extraindo do banco de dados o nome das colunas como variáveis
        $registro = [];
        $registro[] = $nome_aluno;
        $registro[] = $matricula_aluno;
        $registro[] = $email_aluno;
        $registro[] = $turma;
        $registro[] = '<button type="button" class="btn border" onclick="info_aluno(' . $id_aluno . ')"><i class="bx bx-pointer"></i><button type="button" class="btn border" onclick="visu_registros_aluno(' . $matricula_aluno . ',' . $cod_curso . ')"><i class="bx bx-time-five"></i>';
        $dados[] = $registro;
    }

    //Cria o array de informações a serem retornadas para o JavaScript

    if ($row_qnt_usuarios['qnt_usuarios'] >= 1) {
        $dados = $dados;
    } else {
        $dados = '';
    }

    $resultado = [
        "draw" => intval($request_data['draw']), // para cada requisição é enviado um número como parâmetro
        "recordsTotal" => intval($row_qnt_usuarios['qnt_usuarios']), //Quantidade de registros que há no banco de dados
        "recordsFiltered" => intval($row_qnt_usuarios['qnt_usuarios']), // Total de registros quando houver uma pesquisa
        "data" => $dados // Array de dados com os registros retornados da tabela usuarios
    ];

    // var_dump($resultado);

    // Retornar os dados em formato de objeto para o JavaScript
    echo json_encode($resultado);
}
