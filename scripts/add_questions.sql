USE find_kita;
TRUNCATE TABLE questions;

INSERT INTO questions(question, type)
VALUES("Which gender are you?", "user");
INSERT INTO questions(question, type)
VALUES("What is your age?", "user");
INSERT INTO questions(question, type)
VALUES("What is your favorite color?", "user");
INSERT INTO questions(question, type)
VALUES("What is you favorite movie genre?", "user");
INSERT INTO questions(question, type)
VALUES("If your life was a book what genre whould it be?", "user");
INSERT INTO questions(question, type)
VALUES("Planning a night out? What would you want to do?", "user");
INSERT INTO questions(question, type)
VALUES("What would be the perfect first date?", "user");
INSERT INTO questions(question, type)
VALUES("What would best fit what you like to do in your downtime?", "user");
INSERT INTO questions(question, type)
VALUES("You have $500 to spend what do you do with it?", "user");
INSERT INTO questions(question, type)
VALUES("What would be the perfect gift for you?", "user");

INSERT INTO questions(question, type)
VALUES("What gender is this gift for?", "profile");
INSERT INTO questions(question, type)
VALUES("What age is this person?", "profile");
INSERT INTO questions(question, type)
VALUES("Is this for a significant other?", "profile");
INSERT INTO questions(question, type)
VALUES("What would you best be described them?", "profile");
INSERT INTO questions(question, type)
VALUES("Is this for a special occasion?", "profile");
INSERT INTO questions(question, type)
VALUES("What do they like to do?", "profile");
INSERT INTO questions(question, type)
VALUES("What do they do for a living?", "profile");
INSERT INTO questions(question, type)
VALUES("What do they do on their downtime?", "profile");
INSERT INTO questions(question, type)
VALUES("Are they a parent?", "profile");
INSERT INTO questions(question, type)
VALUES("What is their personality?", "profile");
