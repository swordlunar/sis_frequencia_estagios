<?php

// Vamos fazer a configuração com o banco de dados aqui

// Necessário importar o autoload sempre que formos utilizar 
// alguma biblioteca instalada  pelo composer
include __DIR__ . "/../../../vendor/autoload.php";

// O "use" serve para especificar quais classes da biblioteca iremos utilizar
use Opis\Database\Database;
use Opis\Database\Connection;

// Configuração da conexão com o OPIS
$connection = new Connection(
    'mysql:host=localhost;dbname=banco_exemplo',
    'root',
    ''
);

// Realização da conexão com o OPIS
$db = new Database($connection);

// Função para iniciar a conexão no modelo PDO do PHP 
// (Deve ser atribuida a uma variavel no local incluido para utilização dos metodos padrões)
function inicia_conexao()
{

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('BASE', 'banco_exemplo');

    $conn = new MySQLi(HOST, USER, PASS, BASE);

    return $conn;
}
