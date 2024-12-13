CREATE TABLE users (
	id_user SERIAL PRIMARY KEY,
	email VARCHAR UNIQUE NOT NULL,
	user_name VARCHAR UNIQUE NOT NULL,
	passwd VARCHAR NOT NULL,
);

CREATE TABLE annotation (
	id_annotation INTEGER PRIMARY KEY,
	code_hexa VARCHAR UNIQUE NOT NULL,
	id_emotion INTEGER REFERENCES emotion(id_emotion)
);

CREATE TABLE emotion (
	id_emotion INTEGER PRIMARY KEY,
	emotion_char VARCHAR UNIQUE NOT NULL
);

CREATE TABLE message_ (
	id_message SERIAL PRIMARY KEY,
	message_content VARCHAR NOT NULL,
	sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	id_sender INTEGER REFERENCES users(id_user),
	id_recipient INTEGER REFERENCES users(id_user),
	annotation_sender VARCHAR REFERENCES annotation(code_hexa),
	annotation_recipient VARCHAR REFERENCES annotation(code_hexa)
);

