-- CREATE GENRE
INSERT INTO genre (genre_type) VALUES
	("Drama"),("Action"),("Comedy"),("Family"), ("Sci-Fi"), ("Mystery"), ("Thriller"),
	("Adventure"), ("Fantasy"), ("Romance"), ("Crime");


-- INSERT MOVIE
START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  VALUES
	("Flubber", LAST_INSERT_ID(), "1997-11-26", "USA", 99, "PG");
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  VALUES
	("The Bourne Identity", LAST_INSERT_ID(), "2002-06-14", "USA", 119, "PG-13");
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  VALUES
	("Deadpool", LAST_INSERT_ID(), "2016-02-12", "USA", 108, "R");
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  VALUES
	("Zoolander 2", LAST_INSERT_ID(), "2016-02-12", "USA", 119, "PG-13");
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  VALUES
	("The Invention of Lying", LAST_INSERT_ID(), "2009-10-02", "USA", 100, "PG-13");
COMMIT;

-- INSERT MOVIE GENRE
INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT @mId := id FROM movie WHERE title = "Flubber"),(SELECT id FROM genre WHERE genre_type = "Family")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Sci-Fi")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Comedy"));

INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT @mId := id FROM movie WHERE title = "The Bourne Identity"),(SELECT id FROM genre WHERE genre_type = "Action")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Mystery")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Thriller"));

INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT @mId := id FROM movie WHERE title = "Deadpool"),(SELECT id FROM genre WHERE genre_type = "Action")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Adventure")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Comedy"));
	
INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT id FROM movie WHERE title = "Zoolander 2"),(SELECT id FROM genre WHERE genre_type = "Comedy"));

INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT @mId := id FROM movie WHERE title = "The Invention of Lying"),(SELECT id FROM genre WHERE genre_type = "Comedy")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Fantasy")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Romance"));

-- INSERT TVSHOW
START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO tvshow (title, media_id, start_year, release_country, content_rating)
	VALUES ("Daredevil", LAST_INSERT_ID(), 2015, "USA", "TV-MA");
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO tvshow (title, media_id, start_year, end_year, release_country, content_rating)
	VALUES ("The Office", LAST_INSERT_ID(), 2001, 2003, "UK", "TV-MA");
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO tvshow (title, media_id, start_year, end_year, release_country, content_rating)
	VALUES ("The Office", LAST_INSERT_ID(), 2005, 2013, "USA", "TV-PG");
COMMIT;

-- INSERT TVSHOW_GENRE
INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES	
	((SELECT @tId := id FROM tvshow WHERE title = "Daredevil"),(SELECT id FROM genre WHERE genre_type = "Action")),
	(@tId, (SELECT id FROM genre WHERE genre_type = "Crime")),
	(@tId, (SELECT id FROM genre WHERE genre_type = "Drama"));
	
INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES	
	((SELECT @tId := id FROM tvshow WHERE (title = "The Office" AND release_country = "UK")),(SELECT id FROM genre WHERE genre_type = "Comedy")),
	(@tId, (SELECT id FROM genre WHERE genre_type = "Drama"));
	
INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES	
	((SELECT id FROM tvshow WHERE (title = "The Office" AND release_country = "USA")),(SELECT id FROM genre WHERE genre_type = "Comedy"));

-- INSERT TVSHOW_EPISODE
INSERT INTO tvshow_episode(tvshow_id, airdate, episode_title, runtime, episode_number, season) VALUES
	((SELECT @tId := id FROM tvshow WHERE title = "Daredevil"), "2015-04-10", "Cut Man", 53, 2, 1),
	(@tId, "2015-04-10", "Rabbit in a Snowstorm", 52, 3, 1),
	(@tId, "2015-04-10", "Into the Ring", 53, 1, 1);
	
INSERT INTO tvshow_episode(tvshow_id, airdate, episode_title, runtime, episode_number, season) VALUES
	((SELECT @tId := id FROM tvshow WHERE (title = "The Office" AND release_country = "UK")), "2001-07-09", "Downsize", 29, 1, 1),
	(@tId, "2001-07-16", "Work Experience", 29, 2, 1),
	(@tId, "2001-07-23", "The Quiz", 29, 3, 1);
	
INSERT INTO tvshow_episode(tvshow_id, airdate, episode_title, runtime, episode_number, season) VALUES
	((SELECT @tId := id FROM tvshow WHERE (title = "The Office" AND release_country = "USA")), "2005-03-24", "Pilot", 23, 1, 1),
	(@tId, "2005-09-20", "The Dundies", 21, 1, 2),
	(@tId, "2005-09-27", "Sexual Harassment", 22, 2, 2);

	
-- INSERT PEOPLE
INSERT INTO person(first_name, last_name, birthdate) VALUES
	("Rainn", "Wilson", "1966-01-20"),
	("Ricky", "Gervais", "1961-06-25"),
	("Charlie", "Cox", "1982-12-15"),
	("Ben", "Stiller", "1965-11-30"),
	("Ryan", "Reynolds", "1976-10-23"),
	("Franka", "Potente", "1974-07-22"),
	("Matt", "Damon", "1970-10-08"),
	("Robin", "Williams", "1951-07-21");

-- INSERT ACTOR
INSERT INTO actor(person_id) VALUES
	((SELECT id FROM person WHERE (first_name = "Rainn" AND last_name = "Wilson"))), 
	((SELECT id FROM person WHERE (first_name = "Ricky" AND last_name = "Gervais"))), 
	((SELECT id FROM person WHERE (first_name = "Charlie" AND last_name = "Cox"))), 
	((SELECT id FROM person WHERE (first_name = "Ben" AND last_name = "Stiller"))), 
	((SELECT id FROM person WHERE (first_name = "Ryan" AND last_name = "Reynolds"))), 
	((SELECT id FROM person WHERE (first_name = "Franka" AND last_name = "Potente"))), 
	((SELECT id FROM person WHERE (first_name = "Matt" AND last_name = "Damon"))), 
	((SELECT id FROM person WHERE (first_name = "Robin" AND last_name = "Williams")));

-- INSERT DIRECTOR
INSERT INTO director(person_id) VALUES
	((SELECT id FROM person WHERE (first_name = "Ben" AND last_name = "Stiller"))), 
	((SELECT id FROM person WHERE (first_name = "Rainn" AND last_name = "Wilson")));

-- INSERT MEDIA_ACTOR
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM tvshow WHERE (title = "The Office" AND release_country = "USA")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Rainn" AND person.last_name = "Wilson")));
	
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM tvshow WHERE (title = "The Office" AND release_country = "UK")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Ricky" AND person.last_name = "Gervais")));
	
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM tvshow WHERE (title = "Daredevil" AND release_country = "USA")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Charlie" AND person.last_name = "Cox")));
	
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "Zoolander 2")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Ben" AND person.last_name = "Stiller")));
	
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "Deadpool")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Ryan" AND person.last_name = "Reynolds")));
	
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "The Bourne Identity")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Franka" AND person.last_name = "Potente")));
	
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "The Bourne Identity")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Matt" AND person.last_name = "Damon")));
	
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "Flubber")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Robin" AND person.last_name = "Williams")));
	
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "The Invention of Lying")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Ricky" AND person.last_name = "Gervais")));

-- INSERT MEDIA_DIRECTOR
INSERT INTO media_director(media_id, director_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "Zoolander 2")), 
	(SELECT director.id FROM director INNER JOIN person ON director.person_id = person.id WHERE (person.first_name = "Ben" AND person.last_name = "Stiller")));
	
-- INSERT site
INSERT INTO site (name, site_url, max_rating) VALUES
	("IMDB", "http://imdb.com", 10),
	("Rotten Tomatoes", "http://www.rottentomatoes.com", 10);
	
INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = "Deadpool")),
        (SELECT site.id FROM site WHERE (site.name = "Rotten Tomatoes")),
	6.9,
	"http://www.rottentomatoes.com/m/deadpool/");
