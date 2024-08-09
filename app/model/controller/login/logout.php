<?php

session_start();
// Destruir a sessão remove todas as informações armazenadas na variavel $_SESSION 
// (remove do ambiente local que está sendo executado (Navegador))
session_destroy();

header(('Location: https://localhost/sis_frequencia/'));