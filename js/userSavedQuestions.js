$(function(){
  $.ajax({
    url: '../php/userEdit.php?cmd=getSearchOptions',
    type: 'POST',
    contentType: 'application/json',
    success: function(json){
      console.log(json.length);
      if(json.length == 10){
        var index = 0;
        $('select').each(function(){
          console.log(json[index].listed_answer.replace(/\s/g, ''));
          var id = json[index].listed_answer.replace(/\s/g, '');
          $('option#' + id).prop('selected', true);
          index++;
        });
      }
    },
    error: function(request, status, error) {
      console.log("error" + request.responseText);
    }
  });
});
