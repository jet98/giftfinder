$(function(){
  $('#upload_file').click(uploadFile);
});

function uploadFile(){
  var preview = document.querySelector('img');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();
  var formData = new FormData();
  formData.append('file', $('input[type=file]')[0].files[0]);

  if (file) {
    reader.readAsDataURL(file);
  }

  $.ajax({
    url: '../php/upload.php?cmd=uploadFile',
    type: 'POST',
    mimeType: 'multipart/form-data',
    contentType: false,
    processData: false,
    cache: false,
    data: formData,
    success: function(json){
      $('#edit-profile-picture').prop('src', json.replace(/\\/g, "").replace(/"/g, ""));
      console.log(json.replace(/\\/g, "").replace(/"/g, ""));
      console.log("file was uploaded");
    },
    error: function(request, status, error) {
      console.log("error " + request.status + " " + request.error);
    }
  });
}
