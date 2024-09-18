function carregar_registro_diario_aluno(){

    let visu_entrada_1 = 'não definido';
    let visu_intervalo = 'não definido';
    let visu_volta_intervalo = 'não definido';
    let visu_saida_1 = 'não definido';
    let visu_entrada_2 = 'não definido';
    let visu_saida_2 = 'não definido';
    
// bg-primary text-white
// $( "#card_visu_entrada_1" ).addClass( "bg-primary text-white" );

    jQuery.ajax({
        type: "POST",
        url: "./model/controller/aluno/visualizar/carregar_registros_aluno",
        // data: {'codigo': codigo, 'tipo_entrada': tipo_entrada},
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 1){
                visu_entrada_1 = response['retorno']['entrada_1'] != null ? new Date(response['retorno']['entrada_1'] ).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' })  : 'Não registrado.'
                visu_intervalo = response['retorno']['intervalo'] != null ? new Date(response['retorno']['intervalo'] ).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' })  : 'Não registrado.'
                visu_volta_intervalo = response['retorno']['volta_intervalo'] != null ? new Date(response['retorno']['volta_intervalo'] ).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' })  : 'Não registrado.'
                visu_saida_1 = response['retorno']['saida_1'] != null ? new Date(response['retorno']['saida_1'] ).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' })  : 'Não registrado.'
                visu_entrada_2 = response['retorno']['entrada_2'] != null ? new Date(response['retorno']['entrada_2'] ).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' })  : 'Não registrado.'
                visu_saida_2 = response['retorno']['saida_2'] != null ? new Date(response['retorno']['saida_2'] ).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' })  : 'Não registrado.'


                response['retorno']['entrada_1'] != null ? $( "#card_visu_entrada_1" ).addClass( "bg-primary text-white" ) : ''
                response['retorno']['intervalo'] != null ? $( "#card_visu_intervalo" ).addClass( "bg-primary text-white" ) : ''
                response['retorno']['volta_intervalo'] != null ? $( "#card_visu_volta_intervalo" ).addClass( "bg-primary text-white" ) : ''
                response['retorno']['saida_1'] != null ? $( "#card_visu_saida_1" ).addClass( "bg-primary text-white" ) : ''
                response['retorno']['entrada_2'] != null ? $( "#card_visu_entrada_2" ).addClass( "bg-primary text-white" ) : ''
                response['retorno']['saida_2'] != null ? $( "#card_visu_saida_2" ).addClass( "bg-primary text-white" ) : ''


                document.getElementById('visu_entrada_1').innerHTML = visu_entrada_1;
                document.getElementById('visu_intervalo').innerHTML = visu_intervalo;
                document.getElementById('visu_volta_intervalo').innerHTML = visu_volta_intervalo;
                document.getElementById('visu_saida_1').innerHTML = visu_saida_1;
                document.getElementById('visu_entrada_2').innerHTML = visu_entrada_2;
                document.getElementById('visu_saida_2').innerHTML = visu_saida_2;
                
            }
        }
    })
}

$( document ).ready(function() {
    carregar_registro_diario_aluno();
});

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

            switch (response['status']) {
                case 1:
                    alert(response['retorno'])
                    carregar_registro_diario_aluno()
                    break;
                default:
                    break;
            }
        }
    })
}