var editThread = function(e) {
    var id = $(e.target).attr('id');
    var title = $('#title' + id).text().trim();
    var body = $('#body' + id).text().trim();
    $('#title').val(title);
    $('#body').val($.trim(body));
    $('#id').val(id);
    $('#savePost').click(function(e) {
        $('#editModal').modal('toggle');
        $.ajax({
            url: "/ZendSFS/SFS/public/thread/edit",
            method: 'POST',
            data: {
                id: id,
                title: $('#title').val(),
                body: $('#body').val()
            },
            success: function(response) {
                var nTitle = $('#title').val();
                var nBody = $('#body').val();
                $('#title'+id).text(nTitle);
                $('#body'+id).text(nBody);
                console.log(response);
                // window.location.href = window.location.href;
            },
            error: function(xmlHttpRequestObj, status, error) {
                console.log(error);
            },
            complete: function(xmlHttpRequestObj) {
                console.log("complete");
            },
            // dataType: 'json',
            async: true
        });
    });
}
$('.edit').click(editThread);
