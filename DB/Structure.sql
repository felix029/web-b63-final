DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS pages;
DROP TABLE IF EXISTS team;
DROP TABLE IF EXISTS offers;
DROP TABLE IF EXISTS jobs;
DROP TABLE IF EXISTS gallery;


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

CREATE TABLE gallery (
	id INT NOT NULL AUTO_INCREMENT,
	img_url VARCHAR(64),
	img_title VARCHAR (32),
	img_desc TEXT,

	PRIMARY KEY pk_gallery(id),
	CONSTRAINT uc_gallery_url UNIQUE (img_url)
	
) engine = innoDB character set utf8 collate utf8_general_ci;

-- THESE INSERTIONS ARE MANDATORY FOR THE GOOD FONCTIONNING OF THE WEBSITE
-- INSERTING DEFAULT ADMIN ACCOUNT *********************************************************************************

INSERT INTO 
	users(username, pwd, visibility) 
VALUES 
	('dkadmin', '$2y$12$Js858VNNiWx/EAAcYh4JQeOsAGDvawDY4z8llqQXBHsqWNLhk/wKG', 3);

-- INSERTING DEFAULT PAGES VALUES **********************************************************************************

INSERT INTO 
	pages(title, content) 
VALUES 
	('index.php', "null"),
	('resto.php', "null"),
	('services.php', "null");