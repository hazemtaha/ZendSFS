var adminUser = function(e) {
  e.preventDefault();
  var idAttr = $(e.target).attr('id');
  var userId = idAttr.substr(5, idAttr.length - 1);
  //var rowId = "row"+userId;
  console.log(userId);
  $.ajax({
      url: "/ZendSFS/SFS/public/user/make-admin",
      method: 'POST',
      data: {
          id: userId
      },
      success: function(response) {
        if($(e.target).text()=="Make Admin"){
          $(e.target).text("Make Regular User");
          $(e.target).removeClass("btn-success");
          $(e.target).addClass("btn-primary"); 
        }else{
          $(e.target).text("Make Admin");
          $(e.target).removeClass("btn-primary");
          $(e.target).addClass("btn-success"); 
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
$('.admin-user').click(adminUser);
