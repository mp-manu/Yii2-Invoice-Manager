$('#w0 #gridCheckbox').click(function() {
    var items = $('#w0').yiiGridView('getSelectedRows');
    var status = $("select#selectStatus option").filter(":selected").val();
    $('#selectedItems').val(items);
});



$('.actionBtn').on('click', function (e) {
    e.preventDefault();
    var text = $(this).data('text');
    var id = $(this).data('id');
    var headerText = (text == 'update') ? 'Редактировать накладной №'+id.toString() : 'Добавить накладной';
    $.ajax({
        url: '/invoices/get-form',
        data: {id: id, 'text': text},
        type: 'GET',
        success: function (res) {
            if (!res) {
                alert('Error!');
                return false;
            }
            $('#crudModal .modal-header').html(headerText);
            $('#crudModal .modal-body').html(res);
            $('#crudModal').modal();
        },
        error: function () {
            alert('Something went wrong!');
        }
    });
    return false;
});

function f(element) {

    var action = $(element).data('text');
    var id = $("#invoice_id").val();
    var formData = {
        from_id: $("#from").val(),
        to_id: $("#to").val(),
        receiver_id: $("#receiver").val(),
        status_id: $("#status").val(),
    };

    $.ajax({
        url: '/invoices/'+action.toString()+'?id='+id.toString(),
        data: formData,
        type: 'POST',
        success: function (res) {
            if (!res) {
                alert('Error!');
                return false;
            }
            result = JSON.parse(res);
            if(result['code'] == 200){
                $('#crudModal .modal-body').html('<h4 class="text-center text-success">'+result['text']+'</h4><br><a href="/invoices" class="text-center">Список накладных</a>');
            }else{
                $('#message').html(res['text']);
            }

        },
        error: function () {
            alert('Something went wrong!');
        }
    });
    return false;
};