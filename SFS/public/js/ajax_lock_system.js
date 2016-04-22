$.ajax({
    url: "/ZendSFS/SFS/public/admin/status",
    method: 'GET',
    success: function(response) {
      console.log(response);
      if (response == 0) {
        $('#lockBtn').text("Unlock System");
        $('#lockBtn').removeClass('btn-danger');
        $('#lockBtn').addClass('btn-success');
      } else {
        $('#lockBtn').text("Lock System");
        $('#lockBtn').removeClass('btn-success');
        $('#lockBtn').addClass('btn-danger');
      }
        // window.location.href = window.location.href;
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
var toggleLock = function(e) {
  var status;
  if ($('#lockBtn').text().trim() == "Lock System") {
    status = 0;
  } else {
    status = 1;
  }
  console.log(status);
  $.ajax({
      url: "/ZendSFS/SFS/public/admin/lock",
      method: 'POST',
      data: {
          status: status
      },
      success: function(response) {
        console.log(response);
        if (!status) {
          $(e.target).text("Unlock System");
          $(e.target).removeClass('btn-danger');
          $(e.target).addClass('btn-success');
        } else {
          $(e.target).text("Lock System");
          $(e.target).removeClass('btn-success');
          $(e.target).addClass('btn-danger');
        }
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
$('#lockBtn').click(toggleLock);
