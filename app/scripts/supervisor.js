var datatable_estagiarios;

function dataTableEstagiario(){
    $('#listar_estagiarios').DataTable({
        processing: true, // poder processar
        serverSide: true, // ter conexão com banco de dados
        responsive: true, // ser responsivo
        lengthChange: true, // poder pesquisar
        "ajax": { 
            url: "./model/controller/supervisor/visualizar/list",
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

$(document).ready(function() {
    dataTableEstagiario();
});

async function info_aluno(){
    $('#info_aluno').modal('show');

}