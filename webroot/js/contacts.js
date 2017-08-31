$(document).ready(sendMessage());

function sendMessage() {
    $( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        var data = $( this ).serialize();
        $.ajax({
            url: '/contacts/index_ajax',
            type: 'post',
            beforeSend: function(xhr){xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');},
            data: data,
            success: function(response) {
                $('#container').html(response);
                var result = $(response).find('.alert-success');
                if (result.length > 0) {
                    $('#myform')[0].reset();
                }
            },
            error: function (xhr, status) {
                console.log('Error: ' + status);
            }
        });
    });
}