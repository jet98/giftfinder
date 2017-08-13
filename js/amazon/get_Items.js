function getItems(url, keyword, div){
  $(div).html("");
  $.ajax({
    url: url,
    type: 'GET',
    contentType: 'application/json',
    data: {
      'keyword': keyword
    },
    success: function(json){
      var addHtml = "";
      for(var i = 0; i < json.length; i++){
        addHtml += "<div class=\"col-sm-6 col-md-4\" id=\"item\">" +
          "<div class=\"thumbnail\">" +
            "<a href=\"" + json[i][3][0] + "\"><img src=" + json[i][2][0] + " alt=\"Generic placeholder thumbnail\" style=\"height:200px\" /></a>" +
          "</div>" +
          "<div class=\"caption\">" +
            "<a style=\"color:black\" href=\"" + json[i][3][0] + "\"><h4 style=\"height:120px\">" + json[i][0][0] + "</h4></a>" +
            "<p>" +
              "<h4 id=\"float_left\" style=\"color:#FF0000\">" + json[i][1][0] + "</h4>" +
              "<span class=\"a-button-inner\" id=\"float_right\">" +
                "<a onclick=\"location.href='" + json[i][3][0] + "'\">Buy Now</br><img src=\"http://webservices.amazon.com/scratchpad/assets/images/Amazon-Favicon-64x64.png\" class=\"a-icon a-icon-shop-now\" /></a>" +
              "</span>" +
            "</p>" +
          "</div>" +
        "</div>";
      }
      $(div).append(addHtml);
    },
    error: function(request, status, error) {
      console.log("error " + error.responseText);
    }
  });
}
