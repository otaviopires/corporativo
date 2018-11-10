$(function () {

    $('#table_user tr').click(function () {
        var id = $(this).attr('id');

        if (id) {
            $.get('/usuarios/' + id + '/edit', function (dataReturn) {
                $('#conteudoModal').html(dataReturn);
                $('#modal-edit').modal();
            });
        }
    });

    $('#table_user tr').css('cursor', 'pointer');

    $('#table_user').DataTable({
        language: {
            url: '/vendor/adminlte/plugins/datatables/pt-BR.json'
        }
    });

    $('select').select2({
        width: '100%',
        language: "pt-BR"
    });

});
