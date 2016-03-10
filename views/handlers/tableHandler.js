$('#mainTable tbody tr').hover(function() {
  $(this).addClass('highlight').siblings().removeClass('highlight');
  $(this).css('cursor', 'pointer');
});

$('#mainTable tbody tr').on('click', function(event) {
  var separate = $(this.id).selector.split('-');
  var page = 'subViews/'+separate[0]+'View.php';
  var id = separate[1];
  console.log(id);
  console.log(page);
  $.post(page, {'id':id}, function(data, status, xhr) {
    $('.page-header').html(data);
  });
});
