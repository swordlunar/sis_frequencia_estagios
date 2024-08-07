
jQuery(document).ready(function () {

    //Aqui vão os scripts que serão executados quando o documento carregar

});

function realiza_login() {
    // Pegando os valores dos campos do html e atribuindo a variaveis do javascript
    var usuario = $('#usuario').val();
    var senha = $('#senha').val();

    // O que foi feito acima é o equivalente a isso no javascript puro:
    // var usuario = document.getElementById("usuario").value;
    // var senha = document.getElementById("senha").value;

    if (usuario == '' || senha == '') {
        $("#form_login").addClass("was-validated");

        Swal.fire({
            confirmButtonColor: '#4e73df',
            title: 'Campos em branco!',
            html: 'Preencha o <b>usuário</b> e a <b>senha</b> para prosseguir com o login',
            icon: 'error',
            confirmButtonText: 'Ok',
            allowOutsideClick: false,
        })

    } else {
        jQuery.ajax({
            type: "POST",
            url: "./app/model/controller/login/login",
            data: { 'usuario': usuario, 'senha': senha },
            dataType: 'json',
            beforeSend: function () {
                Swal.fire({
                    title: 'Aguarde!',
                    icon: 'info',
                    html: 'Realizando Login ...',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        var b = Swal.getHtmlContainer().querySelector('b')
                    },
                    allowOutsideClick: false,
                });
            },
            success: function (response) {
                swal.close();
                switch (response['status']) {
                    case 0:
                        Swal.fire({
                            confirmButtonColor: '#4e73df',
                            title: 'Falhou',
                            html: response['informacao_adicional'],
                            icon: 'warning',
                            confirmButtonText: 'Ok',
                            allowOutsideClick: false,
                        })
                        break;
                    case 1:
                        
                        //Redireciona para a página home
                        location.href = 'app/home';

                        // Swal.fire({
                        //     confirmButtonColor: '#4e73df',
                        //     title: 'Sucesso!',
                        //     html: response['informacao_adicional'],
                        //     icon: 'success',
                        //     confirmButtonText: 'Ok',
                        //     allowOutsideClick: false,
                        // })
                        break;
                    default:
                        Swal.fire({
                            confirmButtonColor: '#4e73df',
                            title: 'Falhou',
                            html: 'Ocorreu um erro inesperado ao tentar realizar o login',
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            allowOutsideClick: false,
                        })
                        break;
                }
            }
        })
    }


}