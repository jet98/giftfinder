<?php
  session_start();

  require_once "../functions.php";
  require_once "../db_login.php";

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

  if ($cmd == 'loadPosts')
  {
    $thread = getValue('threadTitle');
    setSessionValue('thread', $thread);
    $response = loadPosts($thread);
    echo json_encode($response);
  }
  elseif($cmd == 'postReply'){
    $post = getValue('post');
    $thread = $_SESSION['thread'];
    postReply($post, $thread);
    echo json_encode($thread);
  }
  elseif($cmd == 'quoteReply'){
    $quote = getValue('quote');
    $post = getValue('post');
    $thread = $_SESSION['thread'];
    quoteReply($post, $quote, $thread);
    echo json_encode($thread);
  }

  function loadPosts($thread) {
    global $mysqli;
    $response = array();
    $query = 'SELECT forum_posts.*, users.f_name, avatar.avatar_link  FROM forum_posts INNER JOIN forum_thread ft ON ft.thread_id = forum_posts.parent_id INNER JOIN users ON users.user_id = forum_posts.user_id INNER JOIN avatar ON avatar.avatar_id = forum_posts.avatar_id WHERE ft.thread_title = ?';
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('s', $thread);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc())
    {
      $response[] = $row;
    }
    $stmt->close();

    return $response;
  }

  function postReply($post, $thread){
    global $mysqli;
    $user = $_SESSION['user'][0]['user_id'];
    if(isset($_SESSION['avatar']['avatar_id'])){
      $avatar = $_SESSION['avatar']['avatar_id'];
    }
    else{
      $avatar = 1;
    }
    $thread_id = getParent($thread);
    $query = 'INSERT INTO forum_posts(parent_id, user_id, avatar_id, post, post_date) VALUES(?, ?, ?, ?, NOW())';
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('ddds', $thread_id['thread_id'], $user, $avatar, $post);
    $stmt->execute();
    $stmt->close();
  }

  function quoteReply($post, $quote, $thread){
    global $mysqli;
    $user = $_SESSION['user'][0]['user_id'];
    if(isset($_SESSION['avatar']['avatar_id'])){
      $avatar = $_SESSION['avatar']['avatar_id'];
    }
    else{
      $avatar = 1;
    }
    $thread_id = getParent($thread);
    $query = 'INSERT INTO forum_posts(parent_id, user_id, avatar_id, post, post_date, quote) VALUES(?, ?, ?, ?, NOW(), ?)';
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('dddss', $thread_id['thread_id'], $user, $avatar, $post, $quote);
    $stmt->execute();
    $stmt->close();
  }

  function getParent($thread){
    global $mysqli;
    $query = 'SELECT thread_id FROM forum_thread WHERE thread_title = ?';
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('s', $thread);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc())
    {
      $response = $row;
    }

    return $response;
  }
  $mysqli->close();
?>
