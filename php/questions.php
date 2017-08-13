<?php
  session_start();

  require_once "functions.php";
  require_once "db_login.php";

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

  if($cmd == 'loadUserQuestions'){
    $response = loadUserQuestions();
    echo json_encode($response);
  }
  elseif($cmd == 'loadProfileQuestions'){
    $response = loadProfileQuestions();
    echo json_encode($response);
  }
  elseif($cmd == 'saveUserQuestions'){
    $options = array();
    $options['Which gender are you?'] = $_POST['Whichgenderareyou?'];
    $options['What is your age?'] = $_POST['Whatisyourage?'];
    $options['What is your favorite color?'] = $_POST['Whatisyourfavoritecolor?'];
    $options['What is you favorite movie genre?'] = $_POST['Whatisyoufavoritemoviegenre?'];
    $options['If your life was a book what genre whould it be?'] = $_POST['Ifyourlifewasabookwhatgenrewhoulditbe?'];
    $options['Planning a night out? What would you want to do?'] = $_POST['Planninganightout?Whatwouldyouwanttodo?'];
    $options['What would be the perfect first date?'] = $_POST['Whatwouldbetheperfectfirstdate?'];
    $options['What would best fit what you like to do in your downtime?'] = $_POST['Whatwouldbestfitwhatyouliketodoinyourdowntime?'];
    $options['You have $500 to spend what do you do with it?'] = $_POST['Youhave$500tospendwhatdoyoudowithit?'];
    $options['What would be the perfect gift for you?'] = $_POST['Whatwouldbetheperfectgiftforyou?'];
    foreach($options as $key => $option){
      saveUserQuestions($key, $option);
    }
    echo json_encode($options);
  }
  elseif($cmd == 'getProfileGifts'){
    $options = array();
    $options['What gender is this gift for?'] = $_POST['Whatgenderisthisgiftfor?'];
    $options['What age is this person?'] = $_POST['Whatageisthisperson?'];
    $options['What do they do on their downtime?'] = $_POST['Whatdotheydoontheirdowntime?'];
    $response = getProfileGifts($options);
    echo json_encode($response);
  }

  function loadUserQuestions(){
    global $mysqli;
    $response = array();
    $type = "user";
    $query = 'SELECT * FROM questions WHERE type = ?';
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('s', $type);
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()){
      $answer = loadAnswers($row, "user_answers");
      $response[] = $row;
      $response[] = $answer;
    }
    $stmt->close();
    return $response;
  }

  function loadProfileQuestions(){
    global $mysqli;
    $response = array();
    $type = "profile";
    $query = 'SELECT * FROM questions WHERE type = ?';
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('s', $type);
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()){
      $answer = loadAnswers($row, "profile_answers");
      $response[] = $row;
      $response[] = $answer;
    }
    $stmt->close();
    return $response;
  }

  function loadAnswers($array, $answerTable){
    global $mysqli;
    $response = array();
    $query = "SELECT * FROM " . $answerTable . " WHERE question_id = ?";
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('d', $array['question_id']);
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()){
      $response[] = $row;
    }
    $stmt->close();

    $answers = "<option id=\"\" value=\"\"></option>";
    foreach($response as $answer){
      $id = str_replace(" ", "", $answer['listed_answer']);
      $answers .= "<option name=\"" . $array['question'] . "\" id=\"" . $id . "\" value=\"" . $answer['listed_answer'] . "\">" . $answer['listed_answer'] . "</option>";
    }
    return $answers;
  }

  function saveUserQuestions($key, $option){
    global $mysqli;
    $response = array();
    $user = $_SESSION['user'][0]['user_id'];
    $q_id = getQuestionID($key);
    $a_id = getAnswerID($option, 'user_answers');
    $query = mysqli_query($mysqli, 'SELECT user_id FROM user_questions WHERE user_id = "$user"');
    $count = [];
    while($row = $query->fetch_assoc()){
      $count[] = $row;
    }
    if(count(serialize($count)) == 0){
      $query = 'INSERT INTO user_questions(user_id, questions_id, answers_id, points) VALUES(?, ?, ?, 1)';
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($query) or die(mysqli_error($mysqli));
      $stmt->bind_param('ddd', $user, $q_id['question_id'], $a_id['answers_id']);
      $stmt->execute();
      $res = $stmt->get_result();
    }
    else{
      $query = 'UPDATE user_questions SET answers_id = CASE WHEN answers_id IS NULL THEN ? ELSE ? END WHERE user_id = ? AND questions_id = ?';
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($query) or die(mysqli_error($mysqli));
      $stmt->bind_param('dddd', $a_id['answers_id'], $a_id['answers_id'], $user, $q_id['question_id']);
      $stmt->execute();
      $res = $stmt->get_result();
    }
    $stmt->close();
  }

  function getQuestionID($question){
    global $mysqli;
    $response = "";
    $query = "SELECT question_id FROM questions WHERE question = ?";
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('s', $question);
    $stmt->execute();
    $res = $stmt->get_result();
    $response = $res->fetch_assoc();
    return $response;
  }

  function getAnswerID($answer, $table){
    global $mysqli;
    $response = "";
    $query = "SELECT answers_id FROM " . $table . " WHERE listed_answer = ?";
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('s', $answer);
    $stmt->execute();
    $res = $stmt->get_result();
    $response = $res->fetch_assoc();
    if($response['answers_id'] == null){
      $response['answers_id'] = 57;
    }
    return $response;
  }

  function getProfileGifts($options){
    global $mysqli;
    $response = "";
    $answerA_id = getAnswerID($options['What gender is this gift for?'], 'profile_answers');
    $answerB_id = getAnswerID($options['What age is this person?'], 'profile_answers');
    $answerC_id = getAnswerID($options['What do they do on their downtime?'], 'profile_answers');
    $query = "SELECT keyword FROM gift_finder WHERE answerA_id = ? AND answerB_id = ? AND answerC_id = ?";
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query) or die(mysqli_error($mysqli));
    $stmt->bind_param('ddd', $answerA_id['answers_id'], $answerB_id['answers_id'], $answerC_id['answers_id']);
    $stmt->execute();
    $res = $stmt->get_result();
    $response = $res->fetch_assoc();
    return $response;
  }
  $mysqli->close();
?>
