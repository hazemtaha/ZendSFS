var deleteUser = function(e) {
  e.preventDefault();
  var idAttr = $(e.target).attr('id');
  var userId = idAttr.substr(6, idAttr.length - 1);
  var rowId = "row"+userId;
  console.log(userId);
  $.ajax({
      url: "/ZendSFS/SFS/public/user/admin-delete-user",
      method: 'POST',
      data: {
          id: userId
      },
      success: function(response) {
          $('#'+rowId).remove();
          console.log("susccess");
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
$('.delete-user').click(deleteUser);
