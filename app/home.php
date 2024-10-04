<?php
// Sempre que precisarmos validar acesso para uma página devemos incluir o arquivo
// "verifica_login.php" para verificarmos se há uma sessão ativa ou não
include __DIR__ . "/model/controller/login/verifica_login.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Frequência - Unileão</title>
    <link rel="shortcut icon" href="https://unileao.edu.br/wp-content/themes/portalv2.0/img/favicon.ico">
    <link href="./style/sidebar.css" rel="stylesheet" />
    <link href="./style/calendario.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">


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
                <?php if ($_SESSION['TIPO_USUARIO'] == 1) { ?>
                    <div>
                        <span><strong> <?php echo $_SESSION['NOME_CURSO'] . ' - ' . $_SESSION['PERIODO_LETIVO']; ?> </strong></span>
                    </div>
                <?php } else if ($_SESSION['TIPO_USUARIO'] == 2) { ?>
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
                <?php } ?>
                <!-- <select class="form-select form-select-sm me-2" style="width: auto;">
                            <option selected>Nome do Curso</option>
                            <option value="1">Curso 1</option>
                            <option value="2">Curso 2</option>
                        </select>

                        <select class="form-select form-select-sm" style="width: auto;">
                            <option selected>20242</option>
                            <option value="1">20241</option>
                            <option value="2">20231</option>
                        </select> -->
            </div>
        </div>
    </header>

    <div class="l-navbar shadow rounded" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <img src="./../assets/imagens/logo2.png" alt="Logo Unileão"
                        style="background-size: cover;width: 20px;height: 20px;"> <span
                        class="nav_logo-name">UNILEÃO</span> </a>
                <div class="nav_list">
                    <a href="#" class="nav_link active-side"> <i class='bx bx-calendar-check nav_icon'></i> <span class="nav_name">FREQUÊNCIA</FRame></span></a>
                    <?php if ($_SESSION['TIPO_USUARIO'] == 2) { ?>
                        <a href="#" class="nav_link"> <i class='bx bx-qr nav_icon'></i> <span class="nav_name">GERAR QRCODE</span></a>

                    <?php }
                    if ($_SESSION['TIPO_USUARIO'] == 3) { ?>
                        <a href="#" class="nav_link"> <i class='bx bx-filter-alt nav_icon'></i> <span class="nav_name">SETORES</span></a>
                        <a href="#" class="nav_link"> <i class='bx bx-group nav_icon'></i> <span class="nav_name">SUPERVISORES</span></a>
                        <a href="#" class="nav_link"> <i class='bx bx-time-five nav_icon'></i> <span class="nav_name">RELATÓRIO</span></a>
                    <?php }
                    if ($_SESSION['TIPO_USUARIO'] == 2 || ($_SESSION['TIPO_USUARIO'] == 3)) { ?>
                        <a href="#" class="nav_link"> <i class='bx bx-calendar-event nav_icon'></i> <span class="nav_name">HORÁRIO</span></a>

                    <?php } ?>
                </div>
            </div>
            <a onclick='realizar_logout()' class="nav_link"> <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">Sair</span>
            </a>
        </nav>
    </div>

    <!--Container Principal-->
    <div class="container-fluid mt-5 bg-light" id="corpo_principal">
        <?php include_once __DIR__ . "/view/frequencia.php" ?>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.5/locales-all.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.15/index.global.min.js"></script>

<script src="./scripts/sidebar.js"></script>
<script src="./scripts/home.js"></script>
<script src="./scripts/qrcode.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<?php if ($_SESSION['TIPO_USUARIO'] == 1) { ?>
    <script src="./scripts/aluno.js"></script>
<?php } else if ($_SESSION['TIPO_USUARIO'] == 2) { ?>
    <script src="./scripts/supervisor.js"></script>
<?php } ?>

</html>