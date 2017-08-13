<?php
  if(isset($_GET['sendMessage'])){
    sendMessage();
  }

  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  function sendMessage(){
    $email_from = $_POST['email'];
    $user = explode("@", $email_from);
    $domain = explode(".", $user[1]);
    if(count($domain) > 1){
      $TLD = $domain[1];
    }

    if(empty($user) || empty($domain) || empty($TLD)) {
      echo json_encode('The email address is not valid.');
    }
    else{
      $email_name = $_POST['name'];
      $email_subject = $_POST['subject'];
      $email_message = $_POST['message'];
      $email_to = "myname@domain.com";

      $headers = 'From: '. $email_to . "\r\n" . 'Reply-To: ' . $email_from;
      // mail($email_to, $email_subject, $email_message, $headers);
      echo json_encode($email_subject);
    }
  }
?>
