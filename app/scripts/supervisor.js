var datatable_estagiarios;

function dataTableEstagiario() {
    $('#listar_estagiarios').DataTable({
        processing: true, // poder processar
        serverSide: true, // ter conexão com banco de dados
        responsive: true, // ser responsivo
        lengthChange: true, // poder pesquisar
        "ajax": {
            url: "./model/controller/supervisor/visualizar/datatable_visualizar_alunos",
            type: 'POST'
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/2.1.4/i18n/pt-BR.json',

        },
        "columnDefs": [
            {
                "orderable": false,
                "targets": 4
            }
        ]
    });

    datatable_estagiarios = $('#listar_estagiarios').DataTable()
    datatable_estagiarios.ajax.reload();
};

$(document).ready(function () {
    carregar_setor();
    dataTableEstagiario();


    $('#historico_de_horarios_modal').on('hide.bs.modal', function () {

        document.getElementById('historico_de_horarios_calendar').innerHTML = ''

    });

});

async function info_aluno(id_aluno) {
    jQuery.ajax({
        type: "POST",
        url: "./model/controller/supervisor/visualizar/visualizar_info_aluno",
        data: { 'id_aluno': id_aluno },
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 1) {
                document.getElementById('titulo_info_aluno').innerHTML = response['retorno']['nome_aluno'];
                document.getElementById('valor_setor').value = response['nome_setor'];
                document.getElementById('valor_email').value = response['retorno']['email_aluno'];
                document.getElementById('valor_matricula').value = response['retorno']['matricula_aluno'];
                document.getElementById('valor_telefone').value = response['retorno']['telefone_aluno'];
                $('#info_aluno').modal('show');
            } else {
                alert(response['retorno'])
            }
        }
    })
}

function calendario_historico_frequencia(ra_aluno, cod_curso) {
    var div_calendario = document.getElementById('historico_de_horarios_calendar');

    var calendario_frequencia = new FullCalendar.Calendar(div_calendario, {
        themeSystem: 'bootstrap5',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        locale: 'pt-br',
        buttonIcons: true,
        weekNumbers: true,
        navLinks: true,
        dayMaxEvents: true,
        // events: 'https://fullcalendar.io/api/demo-feeds/events.json?overload-day',


        // Permite a edição do fullcalendar
        // editable: true,


        //Quando algum local do calendário for selecionado
        select: function (start, end, allDay) {


        },


        // Quando um evento do calendário for selecionado
        eventClick: function (info) {
            visualizar_frequencia_aluno(info.event.id)
            // alert('Evento: ' + info.event.title);
            // alert('Identificador: ' + info.event.id);
        },


        // Quando um evento for arrastado para o calendário
        eventDrop: function (event, delta, revertFunc) {


        },


        // Quando um evento for redimensionado no calendário
        eventResize: function (event, delta, revertFunc) {


        },


        events:
            function (fetchInfo, successCallback, failureCallback) {
                $.ajax({
                    url: './model/controller/geral/visualizar/carregar_historico_frequencia_aluno',
                    type: 'POST',
                    dataType: 'json',
                    data: { 'ra_aluno': ra_aluno, 'cod_curso': cod_curso },
                    success: function (data) {
                        switch (data['status']) {
                            case 1:
                                successCallback(data['dados']);
                                break;

                            default:
                                sweetalert2('Falhou', 'Não foi possível carregar o histórico de frequência do aluno.', 'error', 'Ok', false)
                                break;
                        }

                    },
                    error: function () {
                        failureCallback();
                    }
                });
            },
        eventColor: '#378006'
    });


    $('#historico_de_horarios_modal').on('shown.bs.modal', function () {

        document.getElementById('historico_de_horarios_calendar').innerHTML = `<div class="d-flex justify-content-center mb-3 "><div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      </div>`;

        setTimeout(() => {
            document.getElementById('historico_de_horarios_calendar').innerHTML = ''
            calendario_frequencia.render();

        }, 500);

    });

}

function horas_estagio(ra_aluno, cod_curso) {
    jQuery.ajax({
        type: "POST",
        url: "./model/controller/geral/visualizar/carregar_horas_estagio",
        data: { 'ra_aluno': ra_aluno, 'cod_curso': cod_curso },
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 1) {
                document.getElementById('tempo_estagio').innerHTML = response['horas_estagiadas'] + '/' + response['hora_total'] + ' horas registradas.';
                document.getElementById('progresso_estagio').innerHTML = '<div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: ' + response['porcentagem'] + '%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="480"></div>'

            } else {
                sweetalert2('Falhou', 'Erro ao contabilizar horas registradas.', 'error', 'Ok', false);
            }
        }
    })
}

async function visu_registros_aluno(ra_aluno, cod_curso) {
    let nome_aluno = 'não definido'
    let setor_aluno = 'não definido'
    let periodo_letivo = 'não definido'

    jQuery.ajax({
        type: "POST", // Ou GET
        url: "./model/controller/geral/visualizar/carregar_historico_frequencia_aluno",
        data: { 'ra_aluno': ra_aluno, 'cod_curso': cod_curso },
        dataType: 'json', // tipo do dado
        success: function (response) {
            if (response['status'] == 1) {
                nome_aluno = response['nome_aluno']
                setor_aluno = response['setor_aluno']
                periodo_letivo = response['periodo_letivo']

                document.getElementById('titulo_de_horarios_modal').innerHTML = nome_aluno;
                document.getElementById('setor_aluno').innerHTML = setor_aluno;
                document.getElementById('periodo_letivo_h').innerHTML = 'Horário ' + periodo_letivo;

                horas_estagio(ra_aluno, cod_curso);
                calendario_historico_frequencia(ra_aluno, cod_curso)

                $('#historico_de_horarios_modal').modal('show');
            } else {
                alert(response['retorno'])
            }
        }
    })

}

async function salvar_alteracoes(id_registro) {
    Swal.fire({
        title: 'Você deseja fazer qual tipo de alteração?',
        showDenyButton: true,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Alteração na frequência',
        confirmButtonColor: '#055160',
        denyButtonText: 'Comentário',
        denyButtonColor: '#055160',
        customClass: {
            actions: 'my-actions',
            cancelButton: 'order-3',
            confirmButton: 'order-1',
            denyButton: 'order-2',
        },
    }).then((result) => {
        if (result.isConfirmed) { // alteração na frequência
            salvar_alteracoes_hora(id_registro);

        } else if (result.isDenied) { // comentário
            salvar_comentario(id_registro);
        }
    })

}

async function salvar_alteracoes_hora(id_registro) {
    let validade = 1
    let data = document.getElementById('dia_atual_f').innerHTML;

    let entrada_1 = document.getElementById('valor_entrada').value;
    let intervalo = document.getElementById('valor_intervalo').value;
    let volta_intervalo = document.getElementById('valor_volta_intervalo').value;
    let saida_1 = document.getElementById('valor_saida').value;
    let entrada_2 = document.getElementById('valor_entrada_2').value;
    let saida_2 = document.getElementById('valor_saida_2').value;

    if (entrada_1 != '' && saida_1 != '' && entrada_1 < saida_1) {
        if (intervalo != '') {
            if (intervalo >= saida_1 || intervalo <= entrada_1) {
                validade = 0
                sweetalert2('Falhou', 'A relação dos registros <strong>intervalo</strong> e <strong>entrada/saída</strong> não estão coerentes', 'error', 'Ok', false);
            }
        } else {
            if (volta_intervalo != '') {
                validade = 0;
                sweetalert2('Falhou', 'Não é possível registrar um <strong>retorno do intervalo</strong> sem um <strong>início do intervalo</strong>', 'error', 'Ok', false);
            }
        }
        if (volta_intervalo != '') {
            if (volta_intervalo >= saida_1) {
                validade = 0
                sweetalert2('Falhou', 'A relação dos registros <strong>volta do intervalo</strong> e <strong>saída</strong> não estão coerentes', 'error', 'Ok', false);
            }
        }
        else {
            if (intervalo != '') {
                validade = 0;
                sweetalert2('Falhou', 'Não é possível registrar um <strong>início do intervalo</strong> sem um <strong>retorno do intervalo</strong>', 'error', 'Ok', false);

            }
        }
        if (intervalo != '' && volta_intervalo != '') {
            if (intervalo >= volta_intervalo) {
                validade = 0
                sweetalert2('Falhou', 'A relação dos registros <strong>intervalo</strong> e <strong>volta do intervalo</strong> não estão coerentes', 'error', 'Ok', false);
            }
        }
        if (entrada_2 != '') {
            if (saida_1 >= entrada_2) {
                validade = 0
                sweetalert2('Falhou', 'A relação dos registros <strong>saída</strong> e <strong>segunda entrada</strong> não estão coerentes', 'error', 'Ok', false);
            }
        }
        else {
            if (saida_2 != '') {
                validade = 0
                sweetalert2('Falhou', 'Não é possível registrar uma <strong>segunda saída</strong> sem uma <strong>segunda entrada</strong>', 'error', 'Ok', false);
            }
        }
        if (saida_2 != '') {
            if (entrada_2 >= saida_2) {
                validade = 0
                sweetalert2('Falhou', 'A relação dos registros <strong>segunda entrada</strong> e <strong>segunda saída</strong> não estão coerentes', 'error', 'Ok', false);
            }
        }
        else {
            if (entrada_2 != '') {
                validade = 0
                sweetalert2('Falhou', 'Não é possível registrar <strong>segunda entrada</strong> sem uma <strong>segunda saída</strong>', 'error', 'Ok', false);
            }
        }
    }
    else {
        validade = 0
        sweetalert2('Falhou', 'A relação dos registros <strong>entrada</strong> e <strong>saída</strong> não estão coerentes', 'error', 'Ok', false);
    }


    if (validade != 0) {
        jQuery.ajax({
            type: "POST",
            url: "./model/controller/supervisor/alterar/alterar_hora_estagio",
            data: { 'id_registro': id_registro, 'entrada_1': entrada_1, 'intervalo': intervalo, 'volta_intervalo': volta_intervalo, 'saida_1': saida_1, 'entrada_2': entrada_2, 'saida_2': saida_2, 'data': data },
            dataType: 'json',
            success: function (response) {
                if (response['status'] == 1) {
                    sweetalert2('Sucesso', response['retorno'], 'success', 'Ok', false);
                } else {
                    sweetalert2('Falhou', response['retorno'], 'error', 'Ok', false);
                }
            }
        })
    }
}

async function salvar_comentario(id_registro) {
    let data = document.getElementById('dia_atual_f').innerHTML;

    let observacao_registro = document.getElementById('observacao_frequencia').value;

    jQuery.ajax({
        type: "POST",
        url: "./model/controller/supervisor/alterar/alterar_hora_estagio",
        data: { 'id_registro': id_registro, 'data': data, 'observacao_registro': observacao_registro },
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 1) {
                sweetalert2('Sucesso', response['retorno'], 'success', 'Ok', false);
            } else {
                sweetalert2('Falhou', response['retorno'], 'error', 'Ok', false);
            }
        }
    })
}

function aprovar_frequencia(id_registro) {
    jQuery.ajax({
        type: "POST",
        url: "./model/controller/supervisor/alterar/aprovar_frequencia",
        data: { 'id_registro': id_registro },
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 1) {
                sweetalert2('Sucesso', response['retorno'], 'success', 'Ok', false);
                $('#frequencia_de_horarios_modal').modal('show');
                visualizar_frequencia_aluno(id_registro)
            } else {
                sweetalert2('Falhou', response['retorno'], 'error', 'Ok', false);
            }
        }
    })
}

async function carregar_setor() {
    jQuery.ajax({
        type: "POST",
        url: "./model/controller/supervisor/visualizar/carregar_setor",
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 1) {
                setor_aluno = response['retorno'];
                document.getElementById('relacao_setor').innerHTML = setor_aluno;
            } else {
                alert(response['retorno'])
            }
        }
    })
}