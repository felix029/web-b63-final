DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS pages;
DROP TABLE IF EXISTS team;
DROP TABLE IF EXISTS offers;
DROP TABLE IF EXISTS jobs;


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

CREATE TABLE jobs(
	id INT NOT NULL AUTO_INCREMENT,
	title VARCHAR(16),
	
	PRIMARY KEY pk_jobs(id),
	CONSTRAINT uc_jobs_title UNIQUE (title)

) engine = innoDB character set utf8 collate utf8_general_ci;

CREATE TABLE team (
	id INT NOT NULL AUTO_INCREMENT,
	fullname VARCHAR(32) NOT NULL,
	id_job INT NOT NULL,
	bio TEXT,
	image_url VARCHAR(64),
	pos INT,
	
	PRIMARY KEY pk_team(id),
	FOREIGN KEY (id_job) REFERENCES jobs(id) ON DELETE RESTRICT,
	CONSTRAINT uc_team_fullname UNIQUE (fullname)

) engine = innoDB character set utf8 collate utf8_general_ci;

CREATE INDEX idx_team_pos ON team(pos);

CREATE TABLE offers (
	id INT NOT NULL AUTO_INCREMENT,
	id_job INT NOT NULL,
	salary VARCHAR(16),
	job_desc TEXT,
	
	PRIMARY KEY pk_offers(id),
	FOREIGN KEY (id_job) REFERENCES jobs(id) ON DELETE RESTRICT

) engine = innoDB character set utf8 collate utf8_general_ci;