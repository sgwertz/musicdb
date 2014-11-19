DROP TABLE IF EXISTS collections, users, tracks, releases, albums, artists;

CREATE TABLE artists (
	id int NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	PRIMARY KEY(id)
);

-- Make the first entry in the table for various artists so we can be assured
-- that it is id=1
INSERT INTO artists (name) VALUES ('Various Artists');

CREATE TABLE albums (
	id int AUTO_INCREMENT,
	artist_id int NOT NULL,
	title varchar(255) NOT NULL,
	year date,
	PRIMARY KEY(id),
	UNIQUE KEY (artist_id, title),
	FOREIGN KEY (artist_id) REFERENCES artists (id)
);

CREATE TABLE releases (
	id int AUTO_INCREMENT,
	album_id int NOT NULL,
	description varchar(255) NOT NULL,
	year date,
	PRIMARY KEY(id),
	FOREIGN KEY (album_id) REFERENCES albums (id)
);

CREATE TABLE tracks (
	id int AUTO_INCREMENT,
	artist_id int NOT NULL,
	album_id int NOT NULL,
	release_id int NOT NULL,
	number int,
	title varchar(255),
	length time NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY (artist_id) REFERENCES artists (id),
	FOREIGN KEY (album_id) REFERENCES albums (id),
	FOREIGN KEY (release_id) REFERENCES releases (id)
);

CREATE TABLE users (
	id int AUTO_INCREMENT,
	name varchar(64) NOT NULL,
	password char(64) NOT NULL,
	PRIMARY KEY(id),
	UNIQUE KEY (name)
);

CREATE TABLE collections (
	owner_id int NOT NULL,
	release_id int NOT NULL,
	PRIMARY KEY(owner_id, release_id),
	FOREIGN KEY (owner_id) REFERENCES users (id),
	FOREIGN KEY (release_id) REFERENCES releases (id)
);
