var topic = "";
var dataTable = $('table').DataTable();

$(function(){
  $('.create-thread-button').hide();
  $('.reply-post-button').hide();
  $('#nav-forum').hide();
  loadTopics();
  $('#nav-forum-text').on('click',function(){
    if($('#nav-forum-text').text() == "<< Threads"){
      loadThread(topic);
    }
    else{
      $('.create-thread-button').hide();
      loadTopics();
    }
  });
});

function loadTopics(){
  $.ajax({
    url: '../php/forum/forumHome.php?cmd=loadTopics',
    type: 'POST',
    contentType: 'application/json',
    success: function(json){
      dataTable.destroy();
      var addHead = "<tr><th id=\"topic-title-head\">Topic</th><th>Thread</th></tr>";
      $('#forum-topic-head').html(addHead);
      var addHtml = "";
      $('#nav-forum').hide();
      $('.reply-post-button').hide();
      for(var i = 0; i < json.length; i++){
        addHtml += "<tr>" +
                     "<td value=\"" + json[i].topic + "\" id=\"topic-row-value\"><span onmouseover=\"\" style=\"cursor: pointer;\" id=\"topic-title\">" + json[i].topic + "</span></br><p id=\"topic-theme\">" + json[i].topic_desc + "</p></td>" +
                     "<td><span>" + json[i].post + "</span> threads</td>" +
                   "</tr>";
      }
      $('#forum_topic_body').html(addHtml);
      getPaging();
    },
    error: function(request, status, error) {
      console.log("error " + request.responseText);
    }
  });
}

$(document).on('click','#topic-title', function(){
  topic = $(this).text();
  loadThread(topic);
});

function loadThread(topicTitle){
  $.ajax({
    url: '../php/forum/forumThread.php?cmd=loadThread',
    type: 'GET',
    contentType: 'application/json',
    data: {
      'topicTitle': topicTitle
    },
    success: function(json){
      dataTable.destroy();
      $('.create-thread-button').show();
      $('.reply-post-button').hide();
      $('#nav-forum').show();
      $('#nav-forum-text').html("<< Topics");
      var addHead = "<tr><th id=\"thread-title-head\">Thread</th><th>Replies</th></tr>";
      $('#forum-topic-head').html(addHead);
      var addHtml = "";
      for(var i = 0; i < json.length; i++){
        addHtml += "<tr>" +
                     "<td><span onmouseover=\"\" style=\"cursor: pointer;\" id=\"thread-title\">" + json[i].thread_title + "</span>" +
                     "<p id=\"forum-user\">Created By: " + json[i].f_name + " on " + json[i].post_date.substring(0, 10) + "</p></td>" +
                     "<td><span>" + json[i].replies + "</span> replies</td>" +
                   "</tr>";
      }
      $('#forum_topic_body').html(addHtml);
      getPaging();
    },
    error: function(request, status, error) {
      console.log("error " + request.responseText);
    }
  });
}

$(document).on('click','#thread-title', function(){
  var thread = $(this).text();
  loadPosts(thread);
});

function loadPosts(threadTitle){
  $.ajax({
    url: '../php/forum/forumPost.php?cmd=loadPosts',
    type: 'GET',
    contentType: 'application/json',
    data: {
      'threadTitle': threadTitle
    },
    success: function(json){
      dataTable.destroy();
      $('.create-thread-button').hide();
      $('.reply-post-button').show();
      $('#nav-forum').show();
      $('#nav-forum-text').html("<< Threads");
      var addHead = "<tr><th id=\"forum-post-author\">Author</th><th id=\"forum-post-post-title\">Posts</th><th id=\"forum-post-reply\">Reply</th></tr>";
      $('#forum-topic-head').html(addHead);
      var addHtml = "";
      for(var i = 0; i < json.length; i++){
        addHtml += "<tr>" +
          "<td id=\"forum-post-author\">" +
            "<img src=\"../uploads/" + json[i].avatar_link + "\" id=\"forum-profile-picture\" />" +
            "<h4 id=\"forum-post-username\">" + json[i].f_name + "</h4>" +
            "<h4 id=\"forum-post-date\">" + json[i].post_date.substring(0, 10) + "</h4>" +
          "</td>" +
          "<td><p><i style=\"margin-left: 5%; color: grey;\">" + json[i].quote + "</i></p><span id=\"forum-post-post\">" + json[i].post + "</span></td>" +
          "<td id=\"forum-post-reply\">" +
            "<div class=\"create-post-button\">" +
              "<span id=\"post-reply\" data-toggle=\"modal\" data-target=\"#quotePost\" type=\"submit\" onmouseover=\"\" style=\"cursor: pointer;\" onclick=\"\" title=\"Quote Post\">&#10226</span>" +
            "</div>" +
          "</td>" +
        "</tr>";
      }
      $('#forum_topic_body').html(addHtml);
      getPaging();
    },
    error: function(request, status, error) {
      console.log("error " + request.responseText);
    }
  });
}

function getPaging(){
  dataTable = $('table').DataTable({
    bPaginate: true,
    bInfo: false,
    bFilter: false,
    bLengthChange: false,
    bSort: false
  });
}
