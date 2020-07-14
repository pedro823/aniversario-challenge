CREATE TABLE users ( 
	user_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, 
	username TEXT NOT NULL, 
	password TEXT NOT NULL, 
	is_admin INTEGER NULL
);

INSERT INTO users (username, password, is_admin)
VALUES            ('admin', 'L7685rQf2CWpG6nM', 1);

