<?php
  session_start();

  require_once "functions.php";
  require_once "db_login.php";
  include_once "setAvatar.php";

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
  if($cmd == 'uploadFile'){
    $username = $_SESSION['user'][0]['username'];
    $password = $_SESSION['user'][0]['password'];
    $file_name = $_FILES['file']['size'] . $_FILES['file']['name'];
    $file = $_FILES['file']['tmp_name'];
    uploadFileToDB($username, $password, $file_name, $file);

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES['file']['size'] . basename($_FILES['file']['name']));
    move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
    echo json_encode($target_file);
  }

  function uploadFileToDB($username, $password, $file_name, $file){
    global $mysqli;
    $query = 'INSERT INTO avatar(avatar_link, avatar_img) VALUES(?, ?)';
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('ss', $file_name, $file);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();

    $query = 'UPDATE users, avatar SET users.avatar_id = avatar.avatar_id WHERE users.username = ? AND users.password = ? AND avatar.avatar_link = ?';
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('sss', $username, $password, $file_name);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();

    setAvatar($username, $password);

  }

  function setAvatar($username, $password){
    global $mysqli;
    $response = "";
    $query = 'SELECT avatar_id FROM users WHERE username = ? and password = ?';
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()){
      $response = $row;
    }
    $_SESSION['user'][0]['avatar_id'] = $response['avatar_id'];
    $stmt->close();

    setAvatarSession();
  }
  $mysqli->close();
?>
