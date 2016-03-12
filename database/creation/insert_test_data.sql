-- CREATE GENRE --
INSERT INTO genre (genre_type) VALUES
	("Drama"),("Action"),("Comedy"),("Family"), ("Sci-Fi"), ("Mystery"), ("Thriller"),
	("Adventure"), ("Fantasy"), ("Romance"), ("Crime");


-- INSERT MOVIE --
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

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  VALUES
	("Harry Potter and the Goblet of Fire", LAST_INSERT_ID(), "2005-11-18", "UK", 157, "PG-13");
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  VALUES
	("The Decoy Bride", LAST_INSERT_ID(), "2012-03-09", "UK", 157, "PG");
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  VALUES
	("The Fifth Estate", LAST_INSERT_ID(), "2013-10-18", "USA", 128, "R");
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  VALUES
	("World War Z", LAST_INSERT_ID(), "2013-06-21", "USA", 116, "PG-13");
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  VALUES
	("In The Loop", LAST_INSERT_ID(), "2009-09-04", "UK", 106, "NR");
COMMIT;


-- INSERT MOVIE GENRE --
INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT @mId := id FROM movie WHERE title = "In The Loop"),(SELECT id FROM genre WHERE genre_type = "Comedy"));
  
INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT @mId := id FROM movie WHERE title = "World War Z"),(SELECT id FROM genre WHERE genre_type = "Action")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Adventure")),
  (@mId, (SELECT id FROM genre WHERE genre_type = "Sci-Fi")),
  (@mId, (SELECT id FROM genre WHERE genre_type = "Thriller"));
  
INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT @mId := id FROM movie WHERE title = "The Fifth Estate"),(SELECT id FROM genre WHERE genre_type = "Drama")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Thriller"));
  
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

INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT @mId := id FROM movie WHERE title = "Harry Potter and the Goblet of Fire"),(SELECT id FROM genre WHERE genre_type = "Action")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Fantasy")),
  (@mId, (SELECT id FROM genre WHERE genre_type = "Mystery")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Adventure"));
  
INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT @mId := id FROM movie WHERE title = "The Decoy Bride"),(SELECT id FROM genre WHERE genre_type = "Comedy")),
	(@mId, (SELECT id FROM genre WHERE genre_type = "Drama")),
  (@mId, (SELECT id FROM genre WHERE genre_type = "Romance"));


-- INSERT TVSHOW --
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

START TRANSACTION;
INSERT INTO media (id)
  VALUES (null);
INSERT INTO tvshow (title, media_id, start_year, release_country, content_rating)
  VALUES ("Broadchurch", LAST_INSERT_ID(), 2013, "UK", "TV-MA");
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO tvshow (title, media_id, start_year, end_year, release_country, content_rating)
	VALUES ("The Thick Of It", LAST_INSERT_ID(), 2005, 2012, "UK", "TV-MA");
COMMIT;

-- INSERT TVSHOW_GENRE --
INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES	
	((SELECT @tId := id FROM tvshow WHERE title = "Daredevil"),(SELECT id FROM genre WHERE genre_type = "Action")),
	(@tId, (SELECT id FROM genre WHERE genre_type = "Crime")),
	(@tId, (SELECT id FROM genre WHERE genre_type = "Drama"));
	
INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES	
	((SELECT @tId := id FROM tvshow WHERE (title = "The Office" AND release_country = "UK")),(SELECT id FROM genre WHERE genre_type = "Comedy")),
	(@tId, (SELECT id FROM genre WHERE genre_type = "Drama"));
	
INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES	
	((SELECT id FROM tvshow WHERE (title = "The Office" AND release_country = "USA")),(SELECT id FROM genre WHERE genre_type = "Comedy"));
  
INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES
  ((SELECT @tId := id FROM tvshow WHERE title = "Broadchurch"), (SELECT id FROM genre WHERE genre_type = "Crime")),
  (@tId, (SELECT id FROM genre WHERE genre_type = "Drama")),
  (@tId, (SELECT id FROM genre WHERE genre_type = "Mystery"));

INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES
  ((SELECT @tId := id FROM tvshow WHERE title = "The Thick Of It"), (SELECT id FROM genre WHERE genre_type = "Comedy"));

-- INSERT TVSHOW_EPISODE --
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
  
INSERT INTO tvshow_episode (tvshow_id, airdate, episode_title, runtime, episode_number, season) VALUES
  ((SELECT @tId := id FROM tvshow WHERE title = "Broadchurch"), "2013-08-07", "Episode #1.1", 47, 1, 1),
  (@tId, "2013-08-14", "Episode #1.2", 47, 2, 1),
  (@tId, "2013-08-21", "Episode #1.3", 47, 3, 1),
  (@tId, "2013-08-28", "Episode #1.4", 47, 4, 1),
  (@tId, "2013-09-04", "Episode #1.5", 47, 5, 1),
  (@tId, "2013-09-11", "Episode #1.6", 47, 6, 1),
  (@tId, "2013-09-18", "Episode #1.7", 47, 7, 1),
  (@tId, "2013-09-25", "Episode #1.8", 47, 8, 1),
  (@tId, "2015-03-04", "Episode #2.1", 47, 1, 2),
  (@tId, "2015-03-11", "Episode #2.2", 47, 2, 2),
  (@tId, "2015-03-18", "Episode #2.3", 47, 3, 2),
  (@tId, "2015-03-25", "Episode #2.4", 47, 4, 2),
  (@tId, "2015-04-01", "Episode #2.5", 47, 5, 2),
  (@tId, "2015-04-08", "Episode #2.6", 47, 6, 2),
  (@tId, "2015-04-15", "Episode #2.7", 47, 7, 2),
  (@tId, "2015-04-22", "Episode #2.8", 47, 8, 2);
  
INSERT INTO tvshow_episode (tvshow_id, airdate, episode_title, runtime, episode_number, season) VALUES
  ((SELECT @tId := id FROM tvshow WHERE title = "The Thick Of It"), "2005-05-19", "Episode #1.1", 29, 1, 1),
  (@tId, "2005-05-29", "Episode #1.2", 29, 2, 1),
  (@tId, "2005-06-02", "Episode #1.3", 29, 3, 1),
  (@tId, "2005-10-20", "Episode #2.1", 29, 1, 2),
  (@tId, "2005-10-27", "Episode #2.2", 29, 2, 2),
  (@tId, "2005-11-03", "Episode #2.3", 29, 3, 2),
  (@tId, "2009-10-24", "Episode #3.1", 29, 1, 3),
  (@tId, "2009-10-31", "Episode #3.2", 29, 2, 3),
  (@tId, "2009-11-07", "Episode #3.3", 29, 3, 3),
  (@tId, "2009-11-14", "Episode #3.4", 29, 4, 3),
  (@tId, "2009-11-21", "Episode #3.5", 29, 5, 3),
  (@tId, "2009-11-28", "Episode #3.6", 29, 6, 3),
  (@tId, "2009-12-05", "Episode #3.7", 29, 7, 3),
  (@tId, "2009-12-22", "Episode #3.8", 29, 8, 3),
  (@tId, "2012-09-08", "Episode #4.1", 29, 1, 4),
  (@tId, "2012-09-15", "Episode #4.2", 29, 2, 4),
  (@tId, "2012-09-22", "Episode #4.3", 29, 3, 4),
  (@tId, "2012-09-29", "Episode #4.4", 29, 4, 4),
  (@tId, "2012-10-13", "Episode #4.5", 29, 5, 4),
  (@tId, "2012-10-20", "Episode #4.6", 29, 6, 4),
  (@tId, "2012-10-27", "Episode #4.7", 29, 7, 4);

	
-- INSERT PEOPLE --
INSERT INTO person(first_name, last_name, birthdate) VALUES
	("Rainn", "Wilson", "1966-01-20"),
	("Ricky", "Gervais", "1961-06-25"),
	("Charlie", "Cox", "1982-12-15"),
	("Ben", "Stiller", "1965-11-30"),
	("Ryan", "Reynolds", "1976-10-23"),
	("Franka", "Potente", "1974-07-22"),
	("Matt", "Damon", "1970-10-08"),
	("Robin", "Williams", "1951-07-21"),
  ("David", "Tennant", "1971-04-18"),
  ("Peter", "Capaldi", "1958-04-14"),
  ("David", "Thewlis", "1963-03-20"),
  ("Benedict", "Cumberbatch", "1976-07-19"),
  ("Daniel", "Brühl", "1978-06-16"),
  ("Alicia", "Vikander", "1988-10-03"),
  ("Bill", "Condon", "1955-10-22"),
  ("Marc", "Forster", "1969-11-30"),
  ("Mike", "Newell", "1942-03-28"),
  ("Armando", "Iannucci", "1963-11-28"),
  ("Les", "Mayfield", "1959-11-30");

-- INSERT ACTOR --
INSERT INTO actor(person_id) VALUES
	((SELECT id FROM person WHERE (first_name = "Rainn" AND last_name = "Wilson"))), 
	((SELECT id FROM person WHERE (first_name = "Ricky" AND last_name = "Gervais"))), 
	((SELECT id FROM person WHERE (first_name = "Charlie" AND last_name = "Cox"))), 
	((SELECT id FROM person WHERE (first_name = "Ben" AND last_name = "Stiller"))), 
	((SELECT id FROM person WHERE (first_name = "Ryan" AND last_name = "Reynolds"))), 
	((SELECT id FROM person WHERE (first_name = "Franka" AND last_name = "Potente"))), 
	((SELECT id FROM person WHERE (first_name = "Matt" AND last_name = "Damon"))), 
	((SELECT id FROM person WHERE (first_name = "Robin" AND last_name = "Williams"))),
  ((SELECT id FROM person WHERE (first_name = "David" AND last_name = "Tennant"))),
  ((SELECT id FROM person WHERE (first_name = "Peter" AND last_name = "Capaldi"))),
  ((SELECT id FROM person WHERE (first_name = "David" AND last_name = "Thewlis"))),
  ((SELECT id FROM person WHERE (first_name = "Benedict" AND last_name = "Cumberbatch"))),
  ((SELECT id FROM person WHERE (first_name = "Daniel" AND last_name = "Bruhl"))),
  ((SELECT id FROM person WHERE (first_name = "Alicia" AND last_name = "Vikander")));

-- INSERT DIRECTOR --
INSERT INTO director(person_id) VALUES
	((SELECT id FROM person WHERE (first_name = "Ben" AND last_name = "Stiller"))), 
	((SELECT id FROM person WHERE (first_name = "Rainn" AND last_name = "Wilson"))),
  ((SELECT id FROM person WHERE (first_name = "Bill" AND last_name = "Condon"))),
  ((SELECT id FROM person WHERE (first_name = "Marc" AND last_name = "Forster"))),
  ((SELECT id FROM person WHERE (first_name = "Mike" AND last_name = "Newell"))),
  ((SELECT id FROM person WHERE (first_name = "Armando" AND last_name = "Iannucci"))),
  ((SELECT id FROM person WHERE (first_name = "Les" AND last_name = "Mayfield")));

-- INSERT MEDIA_ACTOR TV SHOW --
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
	((SELECT media_id FROM tvshow WHERE title = "Broadchurch"), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "David" AND person.last_name = "Tennant")));

INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM tvshow WHERE title = "The Thick Of It"), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Peter" AND person.last_name = "Capaldi")));

-- INSERT MEDIA_ACTOR MOVIE --
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "In The Loop")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Peter" AND person.last_name = "Capaldi")));

INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "World War Z")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Peter" AND person.last_name = "Capaldi")));

INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "The Fifth Estate")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "David" AND person.last_name = "Thewlis")));  

INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "The Fifth Estate")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Benedict" AND person.last_name = "Cumberbatch"))); 
  
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "The Fifth Estate")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Daniel" AND person.last_name = "Brühl"))); 
  
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "The Fifth Estate")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Alicia" AND person.last_name = "Vikander"))); 

INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "The Fifth Estate")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "Peter" AND person.last_name = "Capaldi")));
  
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

INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "Harry Potter and the Goblet of Fire")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "David" AND person.last_name = "Tennant")));
  
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "The Decoy Bride")), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = "David" AND person.last_name = "Tennant")));

-- INSERT MEDIA_DIRECTOR --
INSERT INTO media_director(media_id, director_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "Zoolander 2")), 
	(SELECT director.id FROM director INNER JOIN person ON director.person_id = person.id WHERE (person.first_name = "Ben" AND person.last_name = "Stiller")));

INSERT INTO media_director(media_id, director_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "The Fifth Estate")), 
	(SELECT director.id FROM director INNER JOIN person ON director.person_id = person.id WHERE (person.first_name = "Bill" AND person.last_name = "Condon")));
  
INSERT INTO media_director(media_id, director_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "World War Z")), 
	(SELECT director.id FROM director INNER JOIN person ON director.person_id = person.id WHERE (person.first_name = "Marc" AND person.last_name = "Forster")));
  
INSERT INTO media_director(media_id, director_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "Harry Potter and the Goblet of Fire")), 
	(SELECT director.id FROM director INNER JOIN person ON director.person_id = person.id WHERE (person.first_name = "Mike" AND person.last_name = "Newell")));
  
INSERT INTO media_director(media_id, director_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "In The Loop")), 
	(SELECT director.id FROM director INNER JOIN person ON director.person_id = person.id WHERE (person.first_name = "Armando" AND person.last_name = "Iannucci")));
  
INSERT INTO media_director(media_id, director_id) VALUES
	((SELECT media_id FROM movie WHERE (title = "Flubber")), 
	(SELECT director.id FROM director INNER JOIN person ON director.person_id = person.id WHERE (person.first_name = "Les" AND person.last_name = "Mayfield")));
	
-- INSERT SITE --
INSERT INTO site (name, site_url, max_rating) VALUES
	("IMDB", "http://imdb.com", 10),
	("Rotten Tomatoes", "http://www.rottentomatoes.com", 10),
  ("metacritic", "http://www.metacritic.com", 100),
  ("RogerEbert.com", "http://www.rogerebert.com", 5);
  
-- INSERT RATING -- 
INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = "Deadpool")),
        (SELECT site.id FROM site WHERE (site.name = "Rotten Tomatoes")),
	6.9,
	"http://www.rottentomatoes.com/m/deadpool");

INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = "Deadpool")),
        (SELECT site.id FROM site WHERE (site.name = "RogerEbert.com")),
	2,
	"http://www.rogerebert.com/reviews/deadpool-2016");
  
INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = "Deadpool")),
        (SELECT site.id FROM site WHERE (site.name = "IMDB")),
	8.4,
	"http://www.imdb.com/title/tt1431045");

INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = "Deadpool")),
        (SELECT site.id FROM site WHERE (site.name = "metacritic")),
	65,
	"http://www.metacritic.com/movie/deadpool");
  
  
  
INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = "The Fifth Estate")),
        (SELECT site.id FROM site WHERE (site.name = "Rotten Tomatoes")),
	5.4,
	"http://www.rottentomatoes.com/m/the_fifth_estate/");

INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = "The Fifth Estate")),
        (SELECT site.id FROM site WHERE (site.name = "RogerEbert.com")),
	2,
	"http://www.rogerebert.com/reviews/the-fifth-estate-2013");
  
INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = "The Fifth Estate")),
        (SELECT site.id FROM site WHERE (site.name = "IMDB")),
	6.2,
	"http://www.imdb.com/title/tt1837703");

INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = "The Fifth Estate")),
        (SELECT site.id FROM site WHERE (site.name = "metacritic")),
	49,
	"http://www.metacritic.com/movie/the-fifth-estate");

INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = "In The Loop")),
        (SELECT site.id FROM site WHERE (site.name = "metacritic")),
	83,
	"http://www.metacritic.com/movie/in-the-loop");
  
INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = "Harry Potter and the Goblet of Fire")),
        (SELECT site.id FROM site WHERE (site.name = "RogerEbert.com")),
	3.5,
	"http://www.rogerebert.com/reviews/harry-potter-and-the-goblet-of-fire-2005");