$('#mainTable tbody tr').hover(function() {
  if ($(this.id).selector.length != 0) {
    $(this).addClass('highlight').siblings().removeClass('highlight');
    $(this).css('cursor', 'pointer');
  }
  else {
    $(this).addClass('active').siblings().removeClass('active');
    $(this).css('cursor', 'not-allowed');
  }
});

$('#mainTable tbody tr').on('click', function(event) {
  var separate = $(this.id).selector.split('-');
  var page = 'subViews/'+separate[0]+'View.php';
  var id = separate[1];
  
  if (id != undefined) {
    $.post(page, {'id':id}, function(data, status, xhr) {
      $('.page-header').html(data);
    });
  }
});
