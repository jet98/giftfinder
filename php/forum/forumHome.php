<?php
  session_start();

  require_once "/../functions.php";
  require_once "/../db_login.php";

  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  $mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
  if ($mysqli->connect_error)
  {
    die("Connection failed: " . $mysqli->connect_error);
  }

  $cmd = getValue('cmd');

  if ($cmd == 'loadTopics')
  {
    $response = loadTopics();
    echo json_encode($response);
  }

  function loadTopics(){
    global $mysqli;
    $response = array();
    $query = 'SELECT * FROM forum_topics';
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()){
      $response[] = $row;
    }
    $stmt->close();
    updateTopics($response);

    return $response;
  }

  function updateTopics($response){
    global $mysqli;
    foreach($response as $topic) {
      $query = 'UPDATE forum_topics SET post = (SELECT count(thread) FROM forum_thread WHERE parent_id = ?) WHERE topic_id = ?';
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($query) or die(mysqli_error($mysqli));
      $stmt->bind_param('dd', $topic['topic_id'], $topic['topic_id']);
      $stmt->execute();
      $stmt->close();
    }
  }
  $mysqli->close();
?>
