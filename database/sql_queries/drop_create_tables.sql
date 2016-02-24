DROP TABLE IF EXISTS rating_source;
DROP TABLE IF EXISTS site;
DROP TABLE IF EXISTS rating;
DROP TABLE IF EXISTS media_director;
DROP TABLE IF EXISTS media_actor;
DROP TABLE IF EXISTS director;
DROP TABLE IF EXISTS actor;
DROP TABLE IF EXISTS person;
DROP TABLE IF EXISTS tvshow_episode;
DROP TABLE IF EXISTS tvshow_genre;
DROP TABLE IF EXISTS tvshow;
DROP TABLE IF EXISTS movie_genre;
DROP TABLE IF EXISTS movie;
DROP TABLE IF EXISTS genre;
DROP TABLE IF EXISTS media;

CREATE TABLE media (
	id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE genre (
	id INT NOT NULL AUTO_INCREMENT,
	genre_type VARCHAR(255) NOT NULL,
	PRIMARY KEY(id),
	UNIQUE (genre_type)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE movie (
	id INT NOT NULL AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	media_id INT NOT NULL,
	release_date DATE NOT NULL,
	release_country VARCHAR(3) NOT NULL,
	runtime INT NOT NULL,
	content_rating VARCHAR(10) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(media_id) REFERENCES media(id),
	UNIQUE(media_id),
	UNIQUE(title, release_date, release_country)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE movie_genre(
	id INT NOT NULL AUTO_INCREMENT,
	movie_id INT NOT NULL,
	genre_id INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(movie_id) REFERENCES movie(id),
	FOREIGN KEY(genre_id) REFERENCES genre(id),
	UNIQUE(movie_id, genre_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
	
CREATE TABLE tvshow (
	id INT NOT NULL AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	media_id INT NOT NULL,
	start_year INT(4) NOT NULL,
	end_year INT(4) NULL,
	release_country VARCHAR(3) NOT NULL,
	content_rating VARCHAR(10) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(media_id) REFERENCES media(id),
	UNIQUE(media_id),
	UNIQUE(title, start_year, release_country)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tvshow_genre(
	id INT NOT NULL AUTO_INCREMENT,
	tvshow_id INT NOT NULL,
	genre_id INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(tvshow_id) REFERENCES tvshow(id),
	FOREIGN KEY(genre_id) REFERENCES genre(id),
	UNIQUE(tvshow_id, genre_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tvshow_episode (
	id INT NOT NULL AUTO_INCREMENT,
	airdate DATE NOT NULL,
	episode_title VARCHAR(255) NOT NULL,
	runtime INT NOT NULL,
	episode_number INT NOT NULL,
	season INT NOT NULL,
	tvshow_id INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(tvshow_id) REFERENCES tvshow(id),
	UNIQUE(tvshow_id, season, episode_number)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
	
CREATE TABLE person (
	id INT NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
	birthdate DATE NOT NULL,
	PRIMARY KEY(id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
	
CREATE TABLE actor (
	id INT NOT NULL AUTO_INCREMENT,
	person_id INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(person_id) REFERENCES person(id),
	UNIQUE(person_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE director (
	id INT NOT NULL AUTO_INCREMENT,
	person_id INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(person_id) REFERENCES person(id),
	UNIQUE(person_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE media_actor (
	id INT NOT NULL AUTO_INCREMENT,
	media_id INT NOT NULL,
	actor_id INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(media_id) REFERENCES media(id),
	FOREIGN KEY(actor_id) REFERENCES actor(id),
	UNIQUE (actor_id, media_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE media_director (
	id INT NOT NULL AUTO_INCREMENT,
	media_id INT NOT NULL,
	director_id INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(media_id) REFERENCES media(id),
	FOREIGN KEY(director_id) REFERENCES director(id),
	UNIQUE (director_id, media_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE rating (
  id INT NOT NULL AUTO_INCREMENT,
  media_id INT NOT NULL,
  rating FLOAT NOT NULL,
  link VARCHAR(512),
  PRIMARY KEY(id),
  FOREIGN KEY(media_id) REFERENCES media(id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE site (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  max_rating FLOAT NOT NULL,
  PRIMARY KEY(id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE rating_source (
  id INT NOT NULL AUTO_INCREMENT,
  rating_id INT NOT NULL,
  site_id INT NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(rating_id) REFERENCES rating(id),
  FOREIGN KEY(site_id) REFERENCES site(id),
  UNIQUE(rating_id, site_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;