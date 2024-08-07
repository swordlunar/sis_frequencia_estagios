<?php
// Sempre que precisarmos validar acesso para uma página devemos incluir o arquivo
// "verifica_login.php" para verificarmos se há uma sessão ativa ou não
include __DIR__ . "/model/controller/login/verifica_login.php";
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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-primary">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Frequência</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link align-middle px-0" style="color:white;">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Cadastrar Frequência</span>
                            </a>
                        </li>
                        <!-- Podemos abrir "IFs e ELSEs" do php para controlar o que será exibido com base na sessão -->
                        <?php if ($_SESSION["TIPO_USUARIO"] == 2) { ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link align-middle px-0" style="color:white;">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Visualizar Frequências</span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION["NOME"]; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="model/controller/login/logout.php">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <!-- Podemos abrir "IFs e ELSEs" do php para controlar o que será exibido com base na sessão -->
                <?php if ($_SESSION["TIPO_USUARIO"] == 1) { ?>
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            Tipo usuário 01
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Aqui temos as informações pertinentes ao usuário do tipo 01.</li>
                            <li class="list-group-item">Verifiquem a mudança nas opções do menu lateral.</li>
                            <li class="list-group-item">Podemos usar as sessões dessa maneira.</li>
                        </ul>
                    </div>
                <?php } else if ($_SESSION["TIPO_USUARIO"] == 2) { ?>
                    <div class="card">
                        <h5 class="card-header">Tipo Usuário 02</h5>
                        <div class="card-body">
                            <h5 class="card-title">Conteúdo</h5>
                            <p class="card-text">Como podem ver o conteúdo pode ser dividido usando as variaveis de sessão.</p>
                            <a href="#" class="btn btn-primary">Enviar</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>