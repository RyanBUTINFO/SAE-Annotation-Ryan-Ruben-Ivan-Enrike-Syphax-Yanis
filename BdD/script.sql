CREATE TABLE Users(user_id INT PRIMARY KEY,
username VARCHAR(50) NOT NULL,
password_hash VARCHAR(255) NOT NULL,
email VARCHAR(100) NOT NULL,
created_at TIMESTAMP,
last_online_at TIMESTAMP);

CREATE TABLE UserStatus(user_id INT PRIMARY KEY,
is_online BOOLEAN,
last_active_at TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES Users(user_id));

CREATE TYPE emotions AS ENUM('joie', 'colère', 'tristesse', 'surprise', 'dégoût', 'peur');

CREATE TABLE Conversation(conversation_id INT PRIMARY KEY,
user_1_id INT,
user_2_id INT,
created_at TIMESTAMP,
FOREIGN KEY (user_1_id) REFERENCES Users(user_id),
FOREIGN KEY (user_2_id) REFERENCES Users(user_id));

CREATE TABLE Messages(message_id INT PRIMARY KEY,
conversation_id INT,
sender_id INT,
receiver_id INT,
content TEXT NOT NULL,
created_at TIMESTAMP,
FOREIGN KEY (conversation_id) REFERENCES Conversation(conversation_id),
FOREIGN KEY (sender_id) REFERENCES Users(user_id),
FOREIGN KEY (receiver_id) REFERENCES Users(user_id));

CREATE TABLE Annotation(annotation_id INT PRIMARY KEY,
message_id INT,
annotator_id INT,
emotion emotions NOT NULL,
created_at TIMESTAMP,
FOREIGN KEY (message_id) REFERENCES Messages(message_id),
FOREIGN KEY (annotator_id) REFERENCES Users(user_id));