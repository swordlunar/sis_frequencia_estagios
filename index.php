<!DOCTYPE html>

<head>
    <title>Frequência - Unileão</title>
</head>
<!-- Importando o jquery para usarmos suas funções (Ex: Ajax) -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
    html {
        position: relative;
        height: 100%;
    }

    body {
        height: 100%;
        margin-bottom: 30px;

    }
</style>

<body style="background-image: linear-gradient(45deg,#1A237E, #1E40AF);">
    <div class="container mt-5">
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
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Importando a biblioteca do sweealert para auxilio no retorno ao usuário -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- importando os scripts que irão atuar no nosso index.php -->
<script src="./app/scripts/login.js"></script>

</html>