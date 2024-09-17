async function registrar_horario_visu(){
    $('#registrarhorario_visu').modal('show');

}

async function registrar_horario(){
    let codigo = document.getElementById('codigo').value;
    console.log(codigo);

    let tipo_entrada = document.getElementById('tipo_presença').value;
        
    console.log(tipo_entrada);

    jQuery.ajax({
        type: "POST",
        url: "./model/controller/aluno/cadastro/registrar_horario",
        data: {'codigo': codigo, 'tipo_entrada': tipo_entrada},
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 1){
                alert(response['retorno'])
                
            }else{
                alert(response['retorno'])
            }   
        }
    })
}