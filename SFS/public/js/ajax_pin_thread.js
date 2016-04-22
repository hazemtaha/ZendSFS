var pinThread = function(e) {
    var idAttr = $(e.target).attr('id');
    var threadId = idAttr.substr(3, idAttr.length - 1);
    var status;
    if ($(e.target).text().trim() == "Pin") {
      status = 1;
    } else {
      status = 0;
    }
    $.ajax({
        url: "/ZendSFS/SFS/public/thread/pin",
        method: 'POST',
        data: {
            id: threadId,
            status: status
        },
        success: function(response) {
          if (status) {
            $(e.target).text("UnPin");
          } else {
            $(e.target).text("Pin");
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
$('.pin-thread').click(pinThread);
