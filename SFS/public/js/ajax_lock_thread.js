var lockThread = function(e) {
    var idAttr = $(e.target).attr('id');
    var threadId = idAttr.substr(4, idAttr.length - 1);
    var status;
    if ($(e.target).text().trim() == "Lock") {
      status = 1;
    } else {
      status = 0;
    }
    $.ajax({
        url: "/ZendSFS/SFS/public/thread/lock",
        method: 'POST',
        data: {
            id: threadId,
            status: status
        },
        success: function(response) {
          if (status) {
            $(e.target).text("Unlock");
          } else {
            $(e.target).text("Lock");
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
$('.lock-thread').click(lockThread);
