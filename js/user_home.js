$(function(){
  $('#delete_profile').click(deleteProfile);
  $('#home-logout-button').show();
  $.ajax({
    url: '../php/userHome.php?cmd=aboutMe',
    type: 'GET',
    contentType: 'application/json',
    success: function(json){
    },
    error: function(request, status, error) {
      console.log("error" + request.responseText);
    }
  });
  loadActivity();
});

function deleteProfile(){
  if(window.confirm("Are you sure you want to delete your profile")){
    $.ajax({
      url: '../php/userHome.php?cmd=deleteProfile',
      type: 'DELETE',
      contentType: 'application/json',
      success: function(json){
        console.log("account removed");
        window.location.assign('/findkita/view/index.html.php');
        logoutUser();
      },
      error: function(request, status, error) {
        console.log("error" + request.responseText);
      }
    });
  }
}

function loadActivity(){
  $.ajax({
    url: '../php/userHome.php?cmd=loadActivity',
    type: 'POST',
    contentType: 'application/json',
    success: function(json){
      $('.table').DataTable({
        paging: true,
        bFilter: false,
        data: json,
        columns: [
          { data: 'topic'},
          { data: 'post' },
          { data: 'post_date' }
        ],
      });
    },
    error: function(request, status, error) {
      console.log("error" + request.responseText);
    }
  });
}
