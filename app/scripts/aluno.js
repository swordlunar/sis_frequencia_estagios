function carregar_setor_e_dia_atual(){
    let dia_atual = new Date().toLocaleDateString('pt-br')
    let setor_aluno = 'Não definido'

    jQuery.ajax({
        type: "POST",
        url: "./model/controller/aluno/visualizar/carregar_setor_e_dia_atual",
        // data: {'codigo': codigo, 'tipo_entrada': tipo_entrada},
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 1){
                setor_aluno = response['retorno']['nome_setor']
            
                document.getElementById('relacao_setor').innerHTML = setor_aluno;
                document.getElementById('dia_atual').innerHTML = dia_atual;
            }else{
                document.getElementById('relacao_setor').innerHTML = setor_aluno;
                document.getElementById('dia_atual').innerHTML = dia_atual;
            }
        }
    })
}

function carregar_registro_diario_aluno(){
    // $('#tipo_presenca').empty();
    
    let visu_entrada_1 = 'não definido';
    let visu_intervalo = 'não definido';
    let visu_volta_intervalo = 'não definido';
    let visu_saida_1 = 'não definido';
    let visu_entrada_2 = 'não definido';
    let visu_saida_2 = 'não definido';
    
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

                setor_aluno = response['retorno']['nome_setor']
                dia_atual = new Date().toLocaleDateString('pt-br')

                response['retorno']['entrada_1'] != null ? $( "#card_visu_entrada_1" ).addClass( "bg-primary text-white" ) : ''
                response['retorno']['intervalo'] != null ? $( "#card_visu_intervalo" ).addClass( "bg-primary text-white" ) : ''
                response['retorno']['volta_intervalo'] != null ? $( "#card_visu_volta_intervalo" ).addClass( "bg-primary text-white" ) : ''
                response['retorno']['saida_1'] != null ? $( "#card_visu_saida_1" ).addClass( "bg-primary text-white" ) : ''
                response['retorno']['entrada_2'] != null ? $( "#card_visu_entrada_2" ).addClass( "bg-primary text-white" ) : ''
                response['retorno']['saida_2'] != null ? $( "#card_visu_saida_2" ).addClass( "bg-primary text-white" ) : ''

                document.getElementById('relacao_setor').innerHTML = setor_aluno;
                document.getElementById('dia_atual').innerHTML = dia_atual;

                document.getElementById('visu_entrada_1').innerHTML = visu_entrada_1;
                document.getElementById('visu_intervalo').innerHTML = visu_intervalo;
                document.getElementById('visu_volta_intervalo').innerHTML = visu_volta_intervalo;
                document.getElementById('visu_saida_1').innerHTML = visu_saida_1;
                document.getElementById('visu_entrada_2').innerHTML = visu_entrada_2;
                document.getElementById('visu_saida_2').innerHTML = visu_saida_2;


                if ((response['retorno']['entrada_1'] != null) && (response['retorno']['intervalo'] == null && (response['retorno']['saida_1'] == null))){
                    $('#tipo_presenca').empty();
                    $('#tipo_presenca').append('<option value="Intervalo">Intervalo</option>');
                    $('#tipo_presenca').append('<option value="Saída">Saída</option>');
                }
                else if ((response['retorno']['intervalo'] != null) && (response['retorno']['volta_intervalo'] == null)){
                    $('#tipo_presenca').empty();
                    $('#tipo_presenca').append('<option value="Volta do intervalo">Volta do intervalo</option>');
                }
                else if ((response['retorno']['volta_intervalo'] != null) && (response['retorno']['saida_1'] == null)){
                    $('#tipo_presenca').empty();
                    $('#tipo_presenca').append('<option value="Saída">Saída</option>');
                }
                else if ((response['retorno']['saida_1'] != null) && (response['retorno']['entrada_2'] == null)){
                    $('#tipo_presenca').empty();
                    $('#tipo_presenca').append('<option value="Segunda Entrada">Segunda Entrada</option>');
                }
                else if ((response['retorno']['entrada_2'] != null) && (response['retorno']['saida_2'] == null)){
                    $('#tipo_presenca').empty();
                    $('#tipo_presenca').append('<option value="Segunda Saída">Segunda Saída</option>');
                }
                else {
                    $('#tipo_presenca').empty();
                    $('#tipo_presenca').append('<option value="">Todas as presenças já foram preenchidas hoje</option>');
                    $("#tipo_presenca").prop("disabled", true);
                    $("#botao_registro").prop("disabled", true);
                }
            }
        }
    })
}

$( document ).ready(function() {
    carregar_registro_diario_aluno();
    carregar_setor_e_dia_atual();
});

async function registrar_horario_modal(){
    let tipo_entrada = document.getElementById('tipo_presenca').value;

    if (tipo_entrada == ''){
        sweetalert2('Falhou', 'Todos os tipos de frequência já foram preenchidos no dia atual.', 'warning', 'Ok', false);
    }else{
        $('#registrar_horario_modal').modal('show');
    }
}

async function registrar_horario(){
    let codigo = document.getElementById('codigo').value;
    // console.log(codigo);

    let tipo_entrada = document.getElementById('tipo_presenca').value;
        
    // console.log(tipo_entrada);

    if(codigo != '' && tipo_entrada != ''){
        jQuery.ajax({
            type: "POST",
            url: "./model/controller/aluno/cadastro/registrar_horario",
            data: {'codigo': codigo, 'tipo_entrada': tipo_entrada},
            dataType: 'json',
            success: function (response) {
    
                switch (response['status']) {
                    case 0:
                        sweetalert2('Falhou', response['retorno'], 'warning');
                        break;
                    case 1:
                        sweetalert2('Sucesso', response['retorno'], 'success');
                        carregar_registro_diario_aluno()
                        break;
                    default:
                        sweetalert2('Falhou', response['retorno'], 'warning');
                        break;
                }
            }
        })
    }else{
        sweetalert2('Campos em branco', 'Não é possível registrar uma frequência com informações em branco.', 'warning');
    }    
}

function historico_de_horarios_modal(){

    let nome_aluno = 'não definido'
    let setor_aluno = 'não definido'
    let periodo_letivo = 'não definido'

    jQuery.ajax({
        type: "POST",
        url: "./model/controller/aluno/visualizar/carregar_setor_e_dia_atual",
        // data: {'codigo': codigo, 'tipo_entrada': tipo_entrada},
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 1){
                nome_aluno = response['nome_aluno']
                setor_aluno = response['retorno']['nome_setor']
                periodo_letivo = response['periodo_letivo']
            
                document.getElementById('titulo_de_horarios_modal').innerHTML = nome_aluno;
                document.getElementById('setor_aluno').innerHTML = setor_aluno;
                document.getElementById('periodo_letivo_h').innerHTML = 'Horário ' + periodo_letivo;
                
                $('#historico_de_horarios_modal').modal('show');
            }else{
                sweetalert2('Falhou', 'Erro ao exibir o histórico.', 'warning', 'Ok', false);
            }
        }
    })
}

function frequencia_de_horarios_modal(){

    let nome_aluno = 'não definido'
    let setor_aluno = 'não definido'
    let periodo_letivo = 'não definido'
    let data_referencia = 'não definido'

    jQuery.ajax({
        type: "POST",
        url: "./model/controller/aluno/visualizar/carregar_setor_e_dia_atual",
        // data: {'codigo': codigo, 'tipo_entrada': tipo_entrada},
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 1){
                nome_aluno = response['nome_aluno']
                setor_aluno = response['retorno']['nome_setor']
                periodo_letivo = response['periodo_letivo']
            
                document.getElementById('nome_aluno_f').innerHTML = nome_aluno;
                document.getElementById('setor_aluno_f').innerHTML = setor_aluno;
                document.getElementById('dia_atual_f').innerHTML = 'data atual';
                
                $('#frequencia_de_horarios_modal').modal('show');
            }else{
                sweetalert2('Falhou', 'Erro ao exibir o histórico.', 'warning', 'Ok', false);
            }
        }
    })
}

