var deleteReply = function(e) {
    var idAttr = $(e.target).attr('id');
    var rplyId = idAttr.substr(11, idAttr.length - 1);
    $.ajax({
        url: "/ZendSFS/SFS/public/reply/delete/id/"+rplyId,
        method: 'DELETE',
        success: function(response) {
            console.log(response);
            // window.location.href = window.location.href;
            $(e.target).parent().parent().remove();
            var rplsNo = parseInt($('#rplsCount').text()) - 1;
            $('#rplsCount').text(rplsNo);
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
}
$('.delete-rply').click(deleteReply);
