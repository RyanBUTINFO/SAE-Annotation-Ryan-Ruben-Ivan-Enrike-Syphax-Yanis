-- 1. script.sql

-- Suppression des anciens objets pour éviter les conflits
DROP TABLE IF EXISTS Annotation, Messages, Conversation, UserStatus, Users;
DROP TYPE IF EXISTS emotions;

-- Création des tables nécessaires
CREATE TABLE Users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP,
    last_online_at TIMESTAMP
);

CREATE TABLE Conversation (
    conversation_id SERIAL PRIMARY KEY,
    user_1_id INT NOT NULL,
    user_2_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_1_id) REFERENCES Users(user_id),
    FOREIGN KEY (user_2_id) REFERENCES Users(user_id)
);

CREATE TABLE Messages (
    message_id SERIAL PRIMARY KEY,
    conversation_id INT NOT NULL,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (conversation_id) REFERENCES Conversation(conversation_id),
    FOREIGN KEY (sender_id) REFERENCES Users(user_id),
    FOREIGN KEY (receiver_id) REFERENCES Users(user_id)
);

CREATE TYPE emotions AS ENUM (
    'joie', 'colère', 'tristesse', 'surprise', 'dégoût', 'peur'
);

CREATE TABLE Annotation (
    annotation_id SERIAL PRIMARY KEY,
    message_id INT NOT NULL,
    annotator_id INT NOT NULL,
    emotion emotions NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (message_id) REFERENCES Messages(message_id),
    FOREIGN KEY (annotator_id) REFERENCES Users(user_id)
);
