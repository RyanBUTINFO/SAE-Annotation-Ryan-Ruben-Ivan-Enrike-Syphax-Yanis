-- Insérer des utilisateurs fictifs
INSERT INTO Users (username, password_hash, email, created_at, last_online_at) VALUES
('RubenDubord', '$2y$10$eImG4mjOZO1Zh1MwQx4AOO9uazMv6ZR8S5WI4e.cBF9XBt8MOqta6', 'johndoe@example.com', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('YanisNait', '$2y$10$Kb6R3eOiyIHDwQMIb5MfEuvNMA44J6Njw3IJ7wZezvFbdXeQUw2Fa', 'janesmith@example.com', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- Insérer des statuts d'utilisateurs
INSERT INTO UserStatus (user_id, is_online, last_active_at) VALUES
(1, TRUE, CURRENT_TIMESTAMP),
(2, FALSE, CURRENT_TIMESTAMP);

-- Insérer des conversations fictives
INSERT INTO Conversation (user_1_id, user_2_id, created_at) VALUES
(1, 2, CURRENT_TIMESTAMP);

-- Insérer des messages fictifs
INSERT INTO Messages (conversation_id, sender_id, receiver_id, content, created_at) VALUES
(1, 1, 2, 'Bonjour, Jane !', CURRENT_TIMESTAMP),
(1, 2, 1, 'Salut, John ! Comment ça va ?', CURRENT_TIMESTAMP);

-- Insérer des annotations fictives
INSERT INTO Annotation (message_id, annotator_id, emotion, created_at) VALUES
(1, 1, 'joie', CURRENT_TIMESTAMP),
(2, 2, 'surprise', CURRENT_TIMESTAMP);
