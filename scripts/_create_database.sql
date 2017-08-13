DROP DATABASE IF EXISTS find_kita;
CREATE DATABASE find_kita;
USE find_kita;

CREATE TABLE users(
  user_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  f_name varchar(25) NOT NULL,
  l_name varchar(25) NOT NULL,
  email varchar(50) NOT NULL UNIQUE,
  password varchar(100) NOT NULL,
  avatar_id int DEFAULT 1,
  username varchar(50) NOT NULL UNIQUE,
  removed boolean DEFAULT false,
  about_me varchar(500) DEFAULT "About me...",
  FOREIGN KEY (avatar_id) REFERENCES avatar(avatar_id)
);

CREATE TABLE avatar(
  avatar_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  avatar_link varchar(900) NOT NULL,
  avatar_img blob NOT NULL
);
-- sets default image for all new users
-- also change forumPost.php default value to 1
INSERT INTO avatar(avatar_link, avatar_img)
VALUES("defaultprofilepicture.png", "");

CREATE TABLE questions(
  question_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  question varchar(500),
  type varchar(10)
);

CREATE TABLE user_questions(
  user_questions_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id int,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  questions_id int,
  FOREIGN KEY (questions_id) REFERENCES questions(questions_id),
  answers_id int,
  FOREIGN KEY (answers_id) REFERENCES answers(answers_id),
  points int
);

CREATE TABLE gift_finder(
  gift_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  answerA_id int,
  answerB_id int,
  answerC_id int,
  FOREIGN KEY (answerA_id) REFERENCES profile_answers(answer_id),
  FOREIGN KEY (answerB_id) REFERENCES profile_answers(answer_id),
  FOREIGN KEY (answerC_id) REFERENCES profile_answers(answer_id),
  keyword varchar(25)
);

CREATE TABLE user_answers(
  answers_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  question_id int,
  listed_answer varchar(500),
  FOREIGN KEY (question_id) REFERENCES questions(question_id)
);

CREATE TABLE profile_answers(
  answers_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  question_id int,
  listed_answer varchar(500),
  FOREIGN KEY (question_id) REFERENCES questions(question_id)
);

CREATE TABLE forum_topics(
  topic_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  topic varchar(255),
  topic_desc varchar(255),
  post int DEFAULT '0'
);

CREATE TABLE forum_thread(
  thread_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  thread_title varchar(255),
  thread varchar(255),
  post_date datetime,
  parent_id int,
  user_id int,
  replies int DEFAULT '0',
  FOREIGN KEY (parent_id) REFERENCES forum_topics(topic_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE forum_posts(
  post_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  parent_id int,
  user_id int,
  avatar_id int,
  post varchar(8000),
  quote varchar(8000) DEFAULT "",
  post_date datetime,
  FOREIGN KEY (parent_id) REFERENCES forum_thread(thread_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (avatar_id) REFERENCES avatar(avatar_id)
);
