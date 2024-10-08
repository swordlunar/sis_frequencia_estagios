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
    dataTableEstagiario();
});

async function info_aluno(id_aluno) {
    // $('#info_aluno').modal('show');
    jQuery.ajax({
        type: "POST", // Ou GET
        url: "./model/controller/supervisor/visualizar/visualizar_info_aluno", // Caminho do model que será executado
        data: { 'id_aluno': id_aluno }, //dados que serão enviados
        dataType: 'json', // tipo do dado
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
        calendario_frequencia.render();

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