<h3>Contact Us</h3>
<form style="width:400px">
    <input name="name" class="form-control" placeholder="Name"><br>
    <input name="email" class="form-control" placeholder="Email"><br>
    <textarea name="message" class="form-control" placeholder="Message"></textarea><br>
    <button id="button" class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
</form>

<div id="container"></div>

<script src="/js/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            var data = ( $( this ).serialize() );
            $.ajax({
                url: '/contacts/index_ajax',
                type: 'post',
                beforeSend: function(xhr){xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');},
                data: data,
                success: function(content) {
                    $('#container').html(content);
                },
                error: function (xhr, status) {
                    console.log('Error: ' + status);
                }
            });
        });
    });
</script>