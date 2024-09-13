<?php
// Sempre que precisarmos validar acesso para uma página devemos incluir o arquivo
// "verifica_login.php" para verificarmos se há uma sessão ativa ou não
//include __DIR__ . "/model/controller/login/verifica_login.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Frequência - Unileão</title>
    <link rel="shortcut icon" href="https://unileao.edu.br/wp-content/themes/portalv2.0/img/favicon.ico">
    <link href="./style/sidebar.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />


    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet" />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
</head>

<body id="body-pd">
<header class="header shadow rounded" id="header">
    <div class="container-fluid d-flex justify-content-between align-items-center p-2">

        <div class="header_toggle"> 
            <i class='bx bx-menu' id="header-toggle"></i> 
        </div>
       
        <div class="d-flex align-items-center">
            
            <select class="form-select form-select-sm me-2" style="width: auto;">
                <option selected>Nome do Curso</option>
                <option value="1">Curso 1</option>
                <option value="2">Curso 2</option>
            </select>
            
            <select class="form-select form-select-sm" style="width: auto;">
                <option selected>20242</option>
                <option value="1">20241</option>
                <option value="2">20231</option>
            </select>
        </div>
    </div>
</header>
    
    <div class="l-navbar shadow rounded" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <img src="./../assets/imagens/logo2.png" alt="Logo Unileão"
                        style="background-size: cover;width: 20px;height: 20px;"> <span
                        class="nav_logo-name">UNILEÃO</span> </a>
                <div class="nav_list"> <a href="#" class="nav_link active-side"> <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span> </a> <a href="#" class="nav_link"> <i
                            class='bx bx-user nav_icon'></i> <span class="nav_name">Usuários</span> </a> <a href="#"
                        class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span
                            class="nav_name">Mensagens</span> </a> <a href="#" class="nav_link"> <i
                            class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Favoritos</span> </a> <a
                        href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span
                            class="nav_name">Arquivos</span> </a>
                    <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                            class="nav_name">Estatisticas</span> </a>
                </div>
            </div> <a onclick='realizar_logout()' class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">Logout</span> </a>
        </nav>
    </div>

    <!--Container Principal-->
    <div class="mt-5 height-100 bg-light" id="corpo_principal">
        <div class='col'>
            <div class="row mt-5">
                <?php session_start(); $_SESSION['TIPO_USUARIO'] = 1; if($_SESSION['TIPO_USUARIO'] == 1){ ?>
                <span class="mt-5">
                    <?php
                        echo 'É aluno';
                    ?>
                </span>
                <?php }else{?>
                <span class="mt-5">
                    <?php
                        echo 'Não é aluno!!!';
                    ?>
                </span>
            <?php } ?></div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script src="./scripts/sidebar.js"></script>
<script src="./scripts/home.js"></script>
</html>