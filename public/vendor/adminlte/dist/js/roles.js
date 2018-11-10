$(function () {

    $('#table tr').click(function () {

        var id = $(this).attr('id');

        if (id) {
            $.get('roles/' + id + '/edit', function (dataReturn) {
                $('#conteudoModal').html(dataReturn);
                $('#modal-edit').modal();
            });
        }
    });

    $('#table tr').css('cursor', 'pointer');

    $('#table').DataTable({
        language: {
            url: '/vendor/adminlte/plugins/datatables/pt-BR.json'
        }
    });

    $('select').select2({
        width: '100%',
        language: "pt-BR",
    });
});