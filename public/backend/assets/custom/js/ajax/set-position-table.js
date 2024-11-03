// Vị trí bàn 
$(function () {
    $("#sortableTable").sortable({
        update: function (event, ui) {
            var array_id = [];
            $('.tables .table_position').each(function () {
                array_id.push($(this).attr('id'));
            })
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: updatePositionUrl,
                method: "POST",
                data: {
                    array_id: array_id
                },
                success: function (data) {
                    executeExample('success');
                },
                error: function (error) {
                    executeExample('error');
                }
            })
        }
    });
});
