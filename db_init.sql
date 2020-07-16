CREATE TABLE users ( 
	user_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, 
	username TEXT NOT NULL, 
	password TEXT NOT NULL, 
	is_admin INTEGER
);

INSERT INTO users (username, password, is_admin)
VALUES            ('admin', 'L7685rQf2CWpG6nM', 1);

CREATE TABLE bombs (
	bomb_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	defuse_password TEXT NOT NULL,
	attempts_left INTEGER NOT NULL,
	active INTEGER NOT NULL
);

INSERT INTO bombs (active, defuse_password, attempts_left) VALUES (1, 'rozhdenye', 10);