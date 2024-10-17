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

async function visualizar_frequencia_aluno(infoeventid) {

    id_registro = infoeventid

    if (id_registro != '') {
        jQuery.ajax({
            type: "POST",
            url: "./model/controller/aluno/visualizar/visualizar_frequencia_aluno",
            data: { 'id_registro': id_registro },
            dataType: 'json',
            success: function (response) {

                switch (response['status']) {
                    case 0:
                        sweetalert2('Falhou', response['retorno'], 'warning');
                        break;
                    case 1:
                        $('#historico_de_horarios_modal').modal('hide');

                        let data_referencia = new Date(response['dados']['data_referencia']);

                        document.getElementById('nome_aluno_f').innerHTML = response['nome_aluno'];
                        document.getElementById('setor_aluno_f').innerHTML = response['nome_setor'];
                        document.getElementById('dia_atual_f').innerHTML = data_referencia.toLocaleDateString("pt-BR", { timeZone: 'UTC' })

                        if (response['dados']['status_registro'] == 1) {
                            document.getElementById('status_badge').innerHTML = '<span class="badge text-bg-success">Aprovado</span>';
                            $("#botao_aprovar_frequencia").prop("disabled", true);

                        } else {
                            document.getElementById('status_badge').innerHTML = '<span class="badge text-bg-info text-white">Pendente</span>';
                            $("#botao_aprovar_frequencia").prop("disabled", false);
                        }

                        document.getElementById('valor_entrada').value = response['dados']['entrada_1'] != null ? new Date(response['dados']['entrada_1']).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' }) : 'Não registrado.'
                        document.getElementById('valor_intervalo').value = response['dados']['intervalo'] != null ? new Date(response['dados']['intervalo']).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' }) : 'Não registrado.'
                        document.getElementById('valor_volta_intervalo').value = response['dados']['volta_intervalo'] != null ? new Date(response['dados']['volta_intervalo']).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' }) : 'Não registrado.'
                        document.getElementById('valor_saida').value = response['dados']['saida_1'] != null ? new Date(response['dados']['saida_1']).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' }) : 'Não registrado.'
                        document.getElementById('valor_entrada_2').value = response['dados']['entrada_2'] != null ? new Date(response['dados']['entrada_2']).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' }) : 'Não registrado.'
                        document.getElementById('valor_saida_2').value = response['dados']['saida_2'] != null ? new Date(response['dados']['saida_2']).toLocaleTimeString('pt-br', { hour: '2-digit', minute: '2-digit' }) : 'Não registrado.'

                        document.getElementById('botao_aprovar_frequencia').value = id_registro
                        document.getElementById('botao_salvar_frequencia').value = id_registro
                        
                        $('#frequencia_de_horarios_modal').modal('show');
                        break;
                    default:
                        sweetalert2('Falhou', response['retorno'], 'warning');
                        break;
                }
            }
        })
    } else {
        sweetalert2('Campos em branco', 'Não é possível registrar uma frequência com informações em branco.', 'warning');
    }
}