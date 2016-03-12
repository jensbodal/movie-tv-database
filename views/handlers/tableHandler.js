$(document).ready(function() {
  addEditButton();
  setRowAction();
  setRowClickHandler();
});

var editMode = false;

function addEditButton() {
  var editEnabled = $('#mainTable tbody tr:first').attr('id');
  
  if (editEnabled) {
    // create the button
    $('#tableCaption').append(
      '<div id="editButtonDiv"><input id="viewEditToggle" type="checkbox"></div>'
    );
    
    var editToggle = $('#viewEditToggle');
    // turn into toggle switch and set actions
    editToggle.bootstrapToggle({
      on: 'SAVE',
      off: 'EDIT',
      onstyle:'danger',
      offstyle:'default'
    });

    editToggle.change(function() {
      editMode = $(this).prop('checked');
      addRemoveDeleteButtons();
    });
    $('#editButtonDiv').css({'display':'inline-block', 'float':'right'});
  };
}

function addRemoveDeleteButtons() {
  $('#mainTable tbody tr').siblings().removeClass();
  $.each($('#mainTable tbody tr td:last-child'), function() {
    if (editMode) {
      $(this).after('<td><i class="fa fa-trash"></i></td>');
    }
    else {
      $(this).remove();
    }
  });
}

function setRowAction() {
  $('#mainTable tbody tr').hover(function() {
    if ($(this.id).selector.length != 0) {
      $(this).removeClass().siblings().removeClass();
      if (!editMode) {
        $(this).addClass('highlight').siblings().removeClass('highlight');
        $(this).css('cursor', 'pointer');
      }
      else {
        $(this).addClass('deleteMode').siblings().removeClass('deleteMode');
        $(this).css('cursor', 'pointer');
      }
    }
    else {
      if (!editMode) {
        $(this).addClass('active').siblings().removeClass('active');
        $(this).css('cursor', 'not-allowed');
      }
      else {
      }
    }
  });
}

function setRowClickHandler() {
  $('#mainTable tbody tr').on('click', function(event) {
    if (!editMode) {
      viewMovieItem($(this.id));
    }
    else {
      deleteMovieItem($(this.id));
    }
  });
}

function viewMovieItem(movie) {
  var separate = movie.selector.split('-');
  var page = 'subViews/'+separate[0]+'View.php';
  var id = separate[1];

  if (id != undefined) {
    $.post(page, {'id':id}, function(data, status, xhr) {
      $('.page-header').html(data);
    });
  }
}

function deleteMovieItem(movie) {
  var separate = movie.selector.split('-');
  var page = 'subViews/'+separate[0]+'Delete.php';
  var id = separate[1];

  if (id != undefined) {
    $.post(page, {'id':id, 'type':separate[0]}, function(data, res, xhr) {
      var response = JSON.parse(data);
      if (response.status == 'error') {
        console.log("FAILURE");
      }
      else if (response.status == 'success') {
        console.log("SUCCESS");
        window.location.reload(true);
      }
      else {
        console.log("SOMETHING TERRIBLE WENT WRONG");
        console.log(response.status);
      }
    });
  }
}
