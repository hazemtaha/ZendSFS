var banUser = function(e) {
  e.preventDefault();
  var idAttr = $(e.target).attr('id');
  var userId = idAttr.substr(3, idAttr.length - 1);
  //var rowId = "row"+userId;
  console.log(userId);
  $.ajax({
      url: "/ZendSFS/SFS/public/user/admin-ban-user",
      method: 'POST',
      data: {
          id: userId
      },
      success: function(response) {
        if($(e.target).text()=="Ban"){
          $(e.target).text("UnBan");
          $(e.target).removeClass("btn-danger");
          $(e.target).addClass("btn-success"); 
        }else{
          $(e.target).text("Ban");
          $(e.target).removeClass("btn-success");
          $(e.target).addClass("btn-danger"); 
        }
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
$('.ban-user').click(banUser);
