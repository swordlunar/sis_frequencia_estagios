<!DOCTYPE html>

<head>
    <title>Frequência - Unileão</title>
</head>
<!-- Importando o jquery para usarmos suas funções (Ex: Ajax) -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./app/style/main.css"/>
<!-- <style>
    html {
        position: relative;
        height: 100%;
    }

    body {
        height: 100%;
        margin-bottom: 30px;
    }
</style> -->

<body>
    <section class="vh-100" style="background-color: #055160;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <div class="d-flex align-items-center mb-3 pb-1">
                                    <span class="h1 fw-bold mb-0" style="color: #055160;">Frequência Estágio</span>
                                </div>

                                <h6 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color: #666768;">Entre na sua conta para acessar o sistema</h6>

                                <form>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form2Example11">Usuário</label>
                                        <input id="form2Example11" class="form-control"placeholder="Digite seu usuário" />
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form2Example22">Senha</label>
                                        <input type="password" id="form2Example22" class="form-control" placeholder="Digite sua senha"/>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="1">Aluno</option>
                                            <option value="2">Coordenador</option>
                                            <option value="3">Supervisor</option>
                                        </select>
                                    </div>
                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-botao btn-block fa-lg gradient-custom-2" style = 'padding: 0.7rem; border-radius: 1rem; width: 100%;' type="button">Entrar</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                            <div class="col-md-6 col-lg-5 d-md-flex" style = 'background-image: url(./assets/imagens/loginimagem.png); background-size: cover;background-position: 40%;background-repeat: no-repeat; border-radius: 1rem;'>
                            <!-- <img src='./assets/imagens/loginimagem.png' alt="login form" class="img-fluid" style="width: 100%;"/> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Sistema de Frequência
                    </div>
                    <div class="card-body">
                        <form id="form_login" onsubmit="return false" novalidate="">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="button" onclick="realiza_login()" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Importando a biblioteca do sweealert para auxilio no retorno ao usuário -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- importando os scripts que irão atuar no nosso index.php -->
<script src="./app/scripts/login.js"></script>

</html>