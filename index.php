<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Frequência de Estágios">
    <meta name="author" content="UNILEÂO">

    <title>Frequência - Unileão</title>
    <link rel="shortcut icon" href="https://unileao.edu.br/wp-content/themes/portalv2.0/img/favicon.ico">
</head>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./app/style/main.css" />

<body style="background-color: #055160;">
    <section class="vh-100" style="background-color: #055160;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-md-8 col-xl-9">
                    <div class="card" style="border-radius: 1rem;--bs-card-border-width: 0px;">
                        <div class="row">
                            <div class="col-md-12 col-lg-5 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <div class="d-flex align-items-center pb-1">
                                        <span class="h2 fw-bold mb-0" style="color: #055160;">Frequência Estágio</span>
                                    </div>

                                    <h6 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color: #666768;">Entre
                                        na sua conta para acessar o sistema</h6>

                                    <form>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="usuario">Usuário</label>
                                            <input id="usuario" class="form-control" placeholder="Digite seu usuário" value='' />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="senha">Senha</label>
                                            <input type="password" id="senha" class="form-control"
                                                placeholder="Digite sua senha" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <select id='tipo_usuario' class="form-select"
                                                aria-label="Default select example">
                                                <option value="aluno">Aluno</option>
                                                <option value="coordenador">Coordenador</option>
                                                <option value="supervisor">Supervisor</option>
                                            </select>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button data-mdb-button-init data-mdb-ripple-init onclick="realiza_login()"
                                                class="btn btn-botao btn-block fa-lg gradient-custom-2"
                                                style='padding: 0.7rem; border-radius: 1rem; width: 100%;'
                                                type="button">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class=" col-lg-7 d-lg-flex d-md-none"
                                style='background-image: url(./assets/imagens/loginimagem.png); background-size: cover;background-position: 40%;background-repeat: no-repeat; border-top-right-radius: 1rem;border-bottom-right-radius: 1rem;'>
                                <!-- <img src='./assets/imagens/loginimagem.png' alt="login form" class="img-fluid" style="width: 100%;"/> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="./app/scripts/login.js"></script>

</html>