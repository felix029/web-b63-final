DROP TABLE IF EXISTS users;

CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(16),
	pwd VARCHAR(64),
	
	PRIMARY KEY pk_users(id),
	CONSTRAINT uc_users_username UNIQUE (username)

) engine = innoDB character set utf8 collate utf8_general_ci;

INSERT INTO users(username, pwd) VALUES ('dkadmin', '3c4506cbcf214e37faea109715d14d9959666b87defe50061b85e2daaaec7616');