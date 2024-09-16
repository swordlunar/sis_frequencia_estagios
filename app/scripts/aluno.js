async function registrar_horario_visu(){
    $('#registrarhorario_visu').modal('show');

}

async function registrar_horario(){
    let codigo = document.getElementById('codigo').value;
    console.log(codigo);

    const checkbox_1 = document.getElementById("primeira_entrada");
    const isChecked_1 = checkbox_1.checked;
    if (isChecked_1) {
        tipo_entrada = checkbox_1.value;}

    const checkbox_2 = document.getElementById("intervalo");
    const isChecked_2 = checkbox_2.checked;
    if (isChecked_2) {
        tipo_entrada = checkbox_2.value;}

    const checkbox_3 = document.getElementById("volta_intervalo");
    const isChecked_3 = checkbox_3.checked;
    if (isChecked_3) {
        tipo_entrada = checkbox_3.value;}

    const checkbox_4 = document.getElementById("primeira_saida");
    const isChecked_4 = checkbox_4.checked;
    if (isChecked_4) {
        tipo_entrada = checkbox_4.value;}

    const checkbox_5 = document.getElementById("segunda_entrada");
    const isChecked_5 = checkbox_5.checked;
    if (isChecked_5) {
        tipo_entrada = checkbox_5.value;}

    const checkbox_6 = document.getElementById("segunda_saída");
    const isChecked_6 = checkbox_6.checked;
    if (isChecked_6) {
        tipo_entrada = checkbox_6.value;}
        
    console.log(tipo_entrada);

    jQuery.ajax({
        type: "POST",
        url: "./model/controller/aluno/cadastro/registrar_horario",
        data: { 'codigo': codigo, 'tipo_entrada': tipo_entrada},
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