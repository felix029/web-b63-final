DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS pages;

CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(16) NOT NULL,
	pwd VARCHAR(64) NOT NULL,
	visibility INT NOT NULL,
	
	PRIMARY KEY pk_users(id),
	CONSTRAINT uc_users_username UNIQUE (username)

) engine = innoDB character set utf8 collate utf8_general_ci;

CREATE TABLE pages (
	id INT NOT NULL AUTO_INCREMENT,
	title VARCHAR(16) NOT NULL,
	content TEXT,
	
	PRIMARY KEY pk_pages(id),
	CONSTRAINT uc_pages_title UNIQUE (title)

) engine = innoDB character set utf8 collate utf8_general_ci;