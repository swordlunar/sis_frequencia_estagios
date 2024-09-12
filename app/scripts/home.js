function realizar_logout(){
    jQuery.ajax({
        type: "POST",
        url: "./model/controller/login/logout",
        success: function (response) {
            window.location.href = 'http://localhost/sis_frequencia'

        }
    })
}