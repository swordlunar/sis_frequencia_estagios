<?php
include_once __DIR__ . "/../../../database/conexao_local.php";

$request_data = $_REQUEST;

$colunas = [
    0 => 'Nome',
    1 => 'Matrícula',
    2 => 'E-mail',
    3 => 'Turma'
];

//Consulta da quantidade de usuários para o recordsTotal e recordsFiltered
$query_qnt_usuarios = "SELECT COUNT(id_aluno) AS qnt_usuarios FROM aluno";
if (!empty($request_data['search']['value'])) {  //se tiver algo dentro da barra de pesquisa
    $query_qnt_usuarios .= " WHERE nome_aluno LIKE :nome";
    $query_qnt_usuarios .= " OR matricula_aluno LIKE :ra";
    $query_qnt_usuarios .= " OR email_aluno LIKE :email";
    $query_qnt_usuarios .= " OR turma LIKE :turma";
}
//Prepara a query
$result_qnt_usuarios = $conn->prepare($query_qnt_usuarios);
//Pesquisar
if (!empty($request_data['search']['value'])) {
    $valor_pesq = "%" . $request_data['search']['value'] . "%"; //like com % antes e depois para obter consultas só de ter o valor.
    $result_qnt_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':ra', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':email', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':turma', $valor_pesq, PDO::PARAM_STR);
}

$result_qnt_usuarios->execute();
$row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);
// var_dump($row_qnt_usuarios);

// Recuperar os registros do bando de dados
$query_estagiarios = "SELECT nome_aluno, matricula_aluno, email_aluno, turma FROM aluno ";//ORDER BY id_estagiario DESC LIMIT :inicio, :quantidade";

//Pesquisar
if (!empty($request_data['search']['value'])) {
    $query_estagiarios .= " WHERE nome_aluno LIKE :nome";
    $query_estagiarios .= " OR matricula_aluno LIKE :ra";
    $query_estagiarios .= " OR email_aluno LIKE :email";
    $query_estagiarios .= " OR turma LIKE :turma";
}

//Ordenar registros
$query_estagiarios .= " ORDER BY ". $colunas[$request_data['order'][0]['column']] . " " . $request_data['order'][0]['dir'] . " LIMIT :inicio, :quantidade";
$result_estagiarios = $conn->prepare($query_estagiarios);
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

while($row_usuario = $result_estagiarios->fetch(PDO::FETCH_ASSOC)){
    // var_dump($row_usuario);
    extract($row_usuario); //extraindo do banco de dados o nome das colunas como variáveis
    $registro = [];
    $registro[] = $nome_aluno;
    $registro[] = $matricula_aluno;
    $registro[] = $email_aluno;
    $registro[] = $turma;
    $dados[] = $registro;
}
// var_dump($dados);

//Cria o array de informações a serem retornadas para o JavaScript
$resultado = [
    "draw" => intval($request_data['draw']), // para cada requisição é enviado um número como parâmetro
    "recordsTotal" => intval($row_qnt_usuarios['qnt_usuarios']), //Quantidade de registros que há no banco de dados
    "recordsFiltered" => intval($row_qnt_usuarios['qnt_usuarios']), // Total de registros quando houver uma pesquisa
    "data" => $dados // Array de dados com os registros retornados da tabela usuarios
];

// var_dump($resultado);

// Retornar os dados em formato de objeto para o JavaScript
echo json_encode($resultado);