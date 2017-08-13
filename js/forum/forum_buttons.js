var quote;

$(function(){
  $('.create-thread-submit-button').click(createThread);
  $('.reply-post-submit-button').click(sendReply);
  $('.quote-post-submit-button').on('click', function(){
    sendQuoteReply(quote);
  });
});

function createThread(){
  $.ajax({
    url: '../php/forum/forumThread.php?cmd=createThread',
    type: 'GET',
    contentType: 'text/html',
    data: {
      'title': $('#create_thread_title').val(),
      'post': $('#create_thread_post').val(),
    },
    success: function(data){
      alert(data.toUpperCase() + " successfully was created.");
      location.reload();
    },
    error: function(request, status, error) {
      console.log("error " + request.responseText);
    }
  });
}

$(document).on('click','#post-reply', function(){
  quote = $('#forum-post-post').text();
});

function sendQuoteReply(quote){
  var post = $('#quote-post-content').val();
  $.ajax({
    url: '../php/forum/forumPost.php?cmd=quoteReply',
    type: 'GET',
    contentType: 'application/json',
    data: {
      'post': post,
      'quote': quote
    },
    success: function(json){
      loadPosts(json);
    },
    error: function(request, status, error) {
      console.log("error " + request.responseText);
    }
  });
}

function sendReply(){
  var post = $('#reply-post-content').val();
  $.ajax({
    url: '../php/forum/forumPost.php?cmd=postReply',
    type: 'GET',
    contentType: 'application/json',
    data: {
      'post': post
    },
    success: function(json){
      loadPosts(json);
    },
    error: function(request, status, error) {
      console.log("error " + request.responseText);
    }
  });
}
