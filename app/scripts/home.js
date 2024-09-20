function realizar_logout() {
    jQuery.ajax({
        type: "POST",
        url: "./model/controller/login/logout",
        success: function (response) {
            window.location.href = 'http://localhost/sis_frequencia'

        }
    })
}

function sweetalert2(title, html, icon) {
    Swal.fire({
        confirmButtonColor: '#055160',
        title: title,
        html: html,
        icon: icon,
        confirmButtonText: 'Ok',
        allowOutsideClick: false,
    })
}