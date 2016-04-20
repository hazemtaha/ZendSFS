var addRply = function(e) {
  var idAttr = $(e.target).attr('id');
  var threadId = idAttr.substr(5, idAttr.length - 1);
  var rplyBody = $('#replyBody').val();
  console.log(threadId);
  $.ajax({
      url: "/ZendSFS/SFS/public/reply/add",
      method: 'POST',
      data: {
          thread_id: threadId,
          body: rplyBody
      },
      success: function(response) {
          console.log(response);
          $('#repliesArea').append("<div><div class='col-sm-offset-1 col-sm-10 panel panel-warning'><div class='panel-heading'>By : " +
              response[0]['username'] + " | On : " + response[0]['creation_date'] + "</div><div class='panel-body'>" + rplyBody + "</div></div>" +
              "<div class='col-sm-1'><a id='delete" + response[0]['id'] + "' class='btn btn-danger delete'>X</a></div></div>");
          $('#replyBody').val('');
          var rplsNo = parseInt($('#rplsCount').text()) + 1;
          $('#rplsCount').text(rplsNo);
          $('#noRpls').remove();
          // $('.delete').unbind('click');
          // $('.delete').click(deleteCmntFn);
      },
      error: function(xmlHttpRequestObj, status, error) {
          console.log(error);
      },
      complete: function(xmlHttpRequestObj) {
          console.log("complete");
      },
      dataType: 'json',
      async: true
  });
}
$('.reply').click(addRply);
