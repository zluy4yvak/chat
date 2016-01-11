$(document).ready(function() {
    $('.del-user').click(function() {
        if (confirm("Do you want to delete it ?")) {
            var id = $(this).data('id');
            var _token = $('input[name=_token]').val();
            var self = this;

            $.ajax({
                type: "post",
                data: {
                    id: id,
                    _token: _token,
                },
                url: 'admin/delete/' + id,
                success: function() {
                    $(self).closest('div.block').remove();
                }
            });
        }
    });

    $('#refresh').on('click',count);

    function count() {
        $.ajax({
            type: "get",
            url: '/refresh',
            success: function(data) {
                if (data) {
                    $('div#count').text('(' + data + ')');
                }
            }
        });
    }
    
    //setInterval(count, 20000);
    setInterval(count, 600000);

});