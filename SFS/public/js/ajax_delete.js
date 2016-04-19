var deleteThread = function(e) {
  var idAttr = $(e.target).attr('id');
  var threadId = idAttr.substr(6, idAttr.length - 1);
  var forumId = $('#forum_id').val();
  console.log(threadId);
  $.ajax({
      url: "/ZendSFS/SFS/public/thread/delete",
      method: 'POST',
      data: {
          id: threadId
      },
      success: function(response) {
          console.log(response);
          if ($(e.target).attr('name') == 'detail-delete') {
              window.location.href = '/ZendSFS/SFS/public/forum/posts/id/'+forumId;
          } else {
            $('#post'+threadId).remove();
          }
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
$('.delete-thread').click(deleteThread);
