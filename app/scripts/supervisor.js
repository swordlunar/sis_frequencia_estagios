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

async function visu_registros_aluno(ra_aluno, cod_curso) {
    jQuery.ajax({
        type: "POST", // Ou GET
        url: "./model/controller/aluno/visualizar/carregar_historico_frequencia_aluno", // Caminho do model que será executado
        data: { 'ra_aluno': ra_aluno, 'cod_curso': cod_curso }, //dados que serão enviados
        dataType: 'json', // tipo do dado
        success: function (response) {
            if (response['status'] == 1) {
                $('#historico_de_horarios_modal_vs').modal('show');
            } else {
                alert(response['retorno'])
            }
        }
    })

}
