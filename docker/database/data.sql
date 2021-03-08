CREATE DATABASE dk;
USE dk;

CREATE TABLE teams (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(50),
	PRIMARY KEY (id)
);

INSERT INTO teams ( `name`)
VALUES ('A'), ('MU'), ('MC'), ('LVP');