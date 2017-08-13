<?php
  require_once "querySearch.php";
  require_once "getItems.php";

  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  $cmd = $_GET['cmd'];
  if($cmd == 'searchItems'){
    $keyword = $_GET['keyword'];
    $response = querySearch($keyword);
    $response = getItems($response);
    // $_SESSION['search'] = $response;
    echo json_encode($response);
  }
?>
