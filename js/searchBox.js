var keyword;

$(function(){
  $('.search').click(function(){
    keyword = $('#search').val();
    getSearchResults();
  });
});

function getSearchResults(){
  $('#search_results_body').show();
  $('#main_body').hide();
  getItems("../php/amazon/search.php?cmd=searchItems", keyword, "#results_list");
}
