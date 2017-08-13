<?php
session_start();

function username(){
  if(isset($_SESSION['user'][0]['username'])){
    return ucfirst($_SESSION['user'][0]['username']);
  }
  else{
    return "user name not set";
  }
}

function name(){
  if(isset($_SESSION['user'][0]['f_name'])){
    return ucfirst($_SESSION['user'][0]['f_name'])." ".ucfirst($_SESSION['user'][0]['l_name']);
  }
  else{
    return "name not set";
  }
}

function email(){
  if(isset($_SESSION['user'][0]['email'])){
    return $_SESSION['user'][0]['email'];
  }
  else{
    return "email not set";
  }
}

function aboutMe(){
  if(isset($_SESSION['user'][0]['about_me'])){
    return ucfirst($_SESSION['user'][0]['about_me']);
  }
  else{
    return "email not set";
  }
}

function uploadedFile(){
  if(isset($_SESSION['avatar']['avatar_link'])){
    return '../uploads/' . $_SESSION['avatar']['avatar_link'];
  }
  else {
    return '../images/defaultprofilepicture.png';
  }
}
?>
