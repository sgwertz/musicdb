DROP TABLE IF EXISTS tracks, albums, artists;

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

CREATE TABLE tracks (
	id int AUTO_INCREMENT,
	artist_id int NOT NULL,
	album_id int NOT NULL,
	number int,
	title varchar(255),
	length time NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY (artist_id) REFERENCES artists (id),
	FOREIGN KEY (album_id) REFERENCES albums (id)
);
