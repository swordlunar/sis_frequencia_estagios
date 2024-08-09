<?php
// È necessário instanciar a sessão para utilizar suas variaveis "$_SESSION"
session_start();

if (!isset($_SESSION["NOME"])){
    
    header(('Location: https://localhost/sis_frequencia/'));
    // exit;
}
?>