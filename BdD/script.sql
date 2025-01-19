-- Supprimer les tables existantes si elles existent pour recommencer
DROP TABLE IF EXISTS Annotation, Messages, Conversation, UserStatus, Users;

-- Créer la table des utilisateurs
CREATE TABLE Users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP,
    last_online_at TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Créer la table pour le statut des utilisateurs
CREATE TABLE UserStatus (
    user_id INT PRIMARY KEY,
    is_online BOOLEAN,
    last_active_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Créer la table des conversations
CREATE TABLE Conversation (
    conversation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_1_id INT,
    user_2_id INT,
    created_at TIMESTAMP,
    FOREIGN KEY (user_1_id) REFERENCES Users(user_id),
    FOREIGN KEY (user_2_id) REFERENCES Users(user_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Créer la table des messages
CREATE TABLE Messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    conversation_id INT,
    sender_id INT,
    receiver_id INT,
    content TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    created_at TIMESTAMP,
    FOREIGN KEY (conversation_id) REFERENCES Conversation(conversation_id),
    FOREIGN KEY (sender_id) REFERENCES Users(user_id),
    FOREIGN KEY (receiver_id) REFERENCES Users(user_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Créer la table des annotations
CREATE TABLE Annotation (
    annotation_id INT AUTO_INCREMENT PRIMARY KEY,
    message_id INT,
    annotator_id INT,
    emotion ENUM('joie', 'colère', 'tristesse', 'surprise', 'dégoût', 'peur') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    created_at TIMESTAMP,
    FOREIGN KEY (message_id) REFERENCES Messages(message_id),
    FOREIGN KEY (annotator_id) REFERENCES Users(user_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
