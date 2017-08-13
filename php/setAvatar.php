<?php
function setAvatarSession(){
  global $mysqli;
  $response = array();
  $query = 'SELECT * FROM avatar WHERE avatar_id = ?';
  $stmt = $mysqli->stmt_init();
  $stmt->prepare($query) or die(mysqli_error($mysqli));
  $stmt->bind_param('d', $_SESSION['user'][0]['avatar_id']);
  $stmt->execute();
  $res = $stmt->get_result();
  while($row = $res->fetch_assoc()){
    $response = $row;
  }
  setSessionValue('avatar', $response);
  $query = 'UPDATE forum_posts SET avatar_id = ? where user_id = ?';
  $stmt = $mysqli->stmt_init();
  $stmt->prepare($query) or die(mysqli_error($mysqli));
  $stmt->bind_param('dd', $_SESSION['avatar']['avatar_id'], $_SESSION['user'][0]['user_id']);
  $stmt->execute();
  $stmt->close();
}
?>
