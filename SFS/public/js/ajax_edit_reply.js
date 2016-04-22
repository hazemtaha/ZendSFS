var editReply = function(e) {
    var idAttr = $(e.target).attr('id');
    var replyId = idAttr.substr(9, idAttr.length - 1);
    var rplyBody = $('#editBody' + replyId).val().trim();
    console.log(rplyBody);
    console.log(replyId);
    $.ajax({
        url: "/ZendSFS/SFS/public/reply/edit",
        method: 'POST',
        data: {
            id: replyId,
            body: rplyBody
        },
        success: function(response) {
            $(e.target).removeClass('glyphicon-ok');
            $(e.target).addClass('glyphicon-pencil');
            $('#rplyCntnt' + replyId).empty();
            $('#rplyCntnt' + replyId).append(rplyBody);
            $(e.target).unbind('click');
            $(e.target).click(toggleEdit);
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
}
var toggleEdit = function(e) {
    var idAttr = $(e.target).attr('id');
    var replyId = idAttr.substr(9, idAttr.length - 1);
    var rplyBody = $('#rplyCntnt' + replyId).text().trim();
    $(e.target).removeClass('glyphicon-pencil');
    $(e.target).addClass('glyphicon-ok');
    $('#rplyCntnt' + replyId).empty();
    $('#rplyCntnt' + replyId).append("<textarea id='editBody"+ replyId +
    "' class='form-control' rows='3' required='required'>" + rplyBody + "</textarea>");
    $(e.target).unbind('click');
    $(e.target).click(editReply);
}
$('.edit-rply').click(toggleEdit);
