var keyword;

$(function(){
  loadUserQuestions();
  loadProfileQuestions();
  $('#user_profile_save_button').click(saveUserQuestions);
  $('#giftfind_profile_save_button').click(function(){
    var index = 0;
    var data = new FormData($('#user_form')[0]);
    $('option:selected').each(function(){
      data.append($('#' + index).text().replace(/\s/g, ''), $(this).val());
      index += 2;
    });

    $.ajax({
      url: '../php/questions.php?cmd=getProfileGifts',
      type: 'POST',
      data: data,
      contentType: false,
      processData: false,
      success: function(json){
        keyword = json['keyword'];
        getProfileGifts();
      },
      error: function(request, status, error) {
        console.log("error " + request.responseText);
      }
    });
  });
});

function loadUserQuestions(){
  $.ajax({
    url: '../php/questions.php?cmd=loadUserQuestions',
    type: 'POST',
    contentType: 'application/json',
    success: function(json){
      var addHtml = "";
      for(var i = 0; i < json.length; i+=2){
        addHtml += "<div class=\"form-group\">" +
               "<label id=\"" + i + "\"class=\"col-md-3 control-label\">" + json[i].question + "</label>" +
               "<div class=\"col-md-8 select_option\">" +
                 "<div class=\"ui-select\">" +
                   "<select id=\"user-select-option\" class=\"form-control\">" + json[i+1] +
                   "</select>" +
                 "</div>" +
               "</div>" +
            "</div>";
      }
      $('#user_form').html(addHtml);
    },
    error: function(request, status, error) {
      console.log("error " + request.responseText);
    }
  });
}

function loadProfileQuestions(){
  $.ajax({
    url: '../php/questions.php?cmd=loadProfileQuestions',
    type: 'POST',
    contentType: 'application/json',
    success: function(json){
      var addHtml = "";
      for(var i = 0; i < json.length; i+=2){
        addHtml += "<div class=\"form-group\">" +
               "<label id=\"" + i + "\"class=\"col-md-3 control-label\">" + json[i].question + "</label>" +
               "<div class=\"col-md-8 select_option\">" +
                 "<div class=\"ui-select\">" +
                   "<select id=\"profile-select-option\" class=\"form-control\">" + json[i+1] +
                   "</select>" +
                 "</div>" +
               "</div>" +
            "</div>";
      }
      $('#giftfind_form').html(addHtml);
    },
    error: function(request, status, error) {
      console.log("error " + request.responseText);
    }
  });
}

function saveUserQuestions(){
  var index = 0;
  var data = new FormData($('#user_form')[0]);
  $('option:selected').each(function(){
    data.append($('#' + index).text().replace(/\s/g, ''), $(this).val());
    index += 2;
  });

  $.ajax({
    url: '../php/questions.php?cmd=saveUserQuestions',
    type: 'POST',
    data: data,
    contentType: false,
    processData: false,
    success: function(json){
      console.log(json);
    },
    error: function(request, status, error) {
      console.log("error " + request.responseText);
    }
  });
}

function getProfileGifts(){
  $('#search_results_body').show();
  $('#main_body').hide();
  getItems("../php/amazon/search.php?cmd=searchItems", keyword, "#results_list");
}
