----------------------------------------------------------------------------------------------------
-- QUERIES ---



-- Add all queries used in the website here before submission --

SELECT movie.title AS title, movie.media_id AS media_id FROM movie
UNION ALL
SELECT tvshow.title AS title, tvshow.media_id AS media_id  FROM tvshow
ORDER BY title ASC;
    
SELECT title FROM tvshow
  ORDER BY title ASC;
    
SELECT genre.genre_type AS genre FROM genre
  ORDER BY genre ASC;

SELECT episode_title, episode_number, season FROM tvshow_episode 
  WHERE tvshow_id = (SELECT id FROM tvshow WHERE title = [showTitleIn]) AND
    episode_number = [numberIn] AND
    season = [seasonIn]; 
    
INSERT INTO tvshow_episode (tvshow_id, airdate, episode_title, runtime, episode_number, season) VALUES
       ((SELECT id FROM tvshow WHERE title = [showTitleIn]), 
       [dateIn], [epTitleIn], [runtimeIn], [numberIn], [seasonIn];
       
       
START TRANSACTION;
INSERT INTO media (id) VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  
    VALUES ([titleIn], LAST_INSERT_ID(), [releaseDateIn], [countryIn], [runtimeIn], [ratingIn]);
COMMIT;

INSERT INTO movie_genre (movie_id, genre_id) VALUES	
    ((SELECT id FROM movie WHERE title = [titleIn]),(SELECT id FROM genre WHERE genre_type = [genreIn]));

INSERT INTO person(first_name, last_name, birthdate) VALUES ([firstNameIn], [lastNameIn], [birthdayIn])

INSERT INTO actor(person_id) VALUES ((SELECT id FROM person WHERE (first_name = [firstNameIn] AND last_name = [lastNameIn])))

INSERT INTO media_actor(media_id, actor_id) VALUES
        ([mediaIn], 
         (SELECT actor.id FROM actor 
          INNER JOIN person ON actor.person_id = person.id 
          WHERE (person.first_name = [firstNameIn] AND person.last_name = [lastNameIn])))

INSERT INTO director(person_id) VALUES ((SELECT id FROM person WHERE (first_name = [firstNameIn] AND last_name = [lastNameIn])))

INSERT INTO media_director(media_id, director_id) VALUES
        ([mediaIn], 
        (SELECT director.id FROM director 
          INNER JOIN person ON director.person_id = person.id 
          WHERE (person.first_name = [firstNameIn] AND person.last_name = [lastNameIn])))

INSERT INTO site (name, site_url, max_rating) VALUES ([siteNameIn], [urlIn], [maxIn])

START TRANSACTION;
INSERT INTO media (id) VALUES (null);
INSERT INTO tvshow (title, media_id, start_year, release_country, content_rating)
      VALUES ([titleIn], LAST_INSERT_ID(), [startYearIn], [countryIn], [ratingIn]);
COMMIT;

START TRANSACTION;
INSERT INTO media (id) VALUES (null);
INSERT INTO tvshow (title, media_id, start_year, end_year. release_country, content_rating)
      VALUES ([titleIn], LAST_INSERT_ID(), [startYearIn], [endYearIn], [countryIn], [ratingIn]);
COMMIT;

INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES	
    ((SELECT id FROM tvshow WHERE title = [titleIn]),(SELECT id FROM genre WHERE genre_type = [genreIn]));
 
SELECT max_rating FROM site WHERE site.name = [siteIn];

INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
    ([mediaIn], 
    (SELECT site.id FROM site WHERE (site.name = [nameIn])),
    [ratingIn], [urlIn])

SELECT mov_tv.title, mov_tv.release_country, media.id FROM media
  INNER JOIN (SELECT title, media_id, release_country FROM (
    (SELECT title, media_id, release_country FROM movie)
    UNION ALL
    (SELECT title, media_id, release_country from tvshow)
   ) mov_tv
  ) mov_tv ON mov_tv.media_id = media.id
  WHERE title = [titleIn];
  
SELECT id, name, max_rating FROM site;

SELECT actor.id AS actor_id, first_name, last_name, birthdate FROM person INNER JOIN actor ON actor.person_id = person.id ORDER BY first_name

SELECT director.id AS director_id, first_name, last_name, birthdate FROM person INNER JOIN director ON director.person_id = person.id ORDER BY first_name

SELECT genre.genre_type AS genre FROM genre
        ORDER BY genre ASC

SELECT person.id AS person_id, first_name, last_name, birthdate FROM person ORDER BY first_name

SELECT id, title, start_year, end_year, release_country, content_rating FROM tvshow ORDER BY title

DELETE media_tvshow.* 
  FROM tvshow
      LEFT JOIN media_tvshow ON media_tvshow.tvshow_id = tvshow.id
      WHERE tvshow.id = [idIn]
      
DELETE media_movie.* 
  FROM movie
      LEFT JOIN media_movie ON media_movie.movie_id = movie.id
      WHERE movie.id = [idIn]
      
DELETE tvshow.* FROM tvshow
      WHERE tvshow.id = [idIn]
      
DELETE movie.* FROM movie
      WHERE movie.id = [idIn]
      
DELETE movie_genre.*, media_actor.*, media_director.*, rating.* FROM movie_genre
      LEFT JOIN movie ON movie.id = movie_genre.movie_id
      INNER JOIN media ON media.id = movie.media_id
      LEFT JOIN media_actor ON media_actor.media_id = media.id
      LEFT JOIN media_director ON media_director.media_id = media.id
      LEFT JOIN rating ON rating.media_id = media.id
      WHERE movie.id = [idIn];
      
DELETE tvshow_genre.*, media_actor.*, media_director.*, rating.* FROM tvshow_genre
      LEFT JOIN tvshow ON tvshow.id = tvshow_genre.tvshow_id
      INNER JOIN media ON media.id = tvshow.media_id
      LEFT JOIN media_actor ON media_actor.media_id = media.id
      LEFT JOIN media_director ON media_director.media_id = media.id
      LEFT JOIN rating ON rating.media_id = media.id
      WHERE tvshow.id = [idIn];
      
  DELETE tvshow.*, media.* FROM tvshow
      INNER JOIN media ON media.id = tvshow.media_id
      WHERE tvshow.id = [idIn]

DELETE movie.*, media.* FROM movie
      INNER JOIN media ON media.id = movie.media_id
      WHERE movie.id = [idIn]
      
      
SELECT person.first_name AS fn, person.last_name AS ln, person.birthdate AS bd FROM movie 
        INNER JOIN media ON media.id=movie.media_id
        INNER JOIN media_actor ON media_actor.media_id = media.id
        INNER JOIN actor ON actor.id = media_actor.actor_id
        INNER JOIN person ON person.id = actor.person_id    
        WHERE movie.id = [movieIdIn]
        ORDER BY title
        
        
SELECT person.first_name AS fn, person.last_name AS ln, person.birthdate AS bd FROM movie 
        INNER JOIN media ON media.id=movie.media_id
        INNER JOIN media_director ON media_director.media_id = media.id
        INNER JOIN director ON director.id = media_director.director_id
        INNER JOIN person ON person.id = director.person_id    
        WHERE movie.id = [movieIdIn] 
        ORDER BY title

SELECT movie.title AS title, DATE_FORMAT(movie.release_date, '%M %d, %Y') AS release_date, movie.release_country AS release_country, movie.runtime AS runtime, movie.content_rating AS content_rating,
    person.first_name AS first_name, person.last_name AS last_name,
    GROUP_CONCAT(DISTINCT genre.genre_type ORDER BY genre.genre_type SEPARATOR ', ') AS genre_type
    FROM movie 
      INNER JOIN media ON media.id=movie.media_id
      INNER JOIN media_actor ON media_actor.media_id = media.id
      INNER JOIN actor ON actor.id = media_actor.actor_id
      INNER JOIN person ON person.id = actor.person_id    
      INNER JOIN movie_genre ON movie_genre.movie_id = movie.id
      INNER JOIN genre ON genre.id = movie_genre.genre_id
      WHERE movie.id = [movieIdIn] 
      ORDER BY title        

SELECT rating.rating AS rating, rating.rating_url AS rating_url, site.name AS site_name, site.max_rating AS max_rating FROM movie
    INNER JOIN media ON media.id = movie.media_id
    INNER JOIN rating ON rating.media_id = media.id
    INNER JOIN site ON site.id = rating.site_id
    WHERE movie.id = [movieIdIn]
    ORDER BY site_name;      

DELETE media_actor.*, media_director.* FROM movie
      LEFT JOIN actor ON actor.person_id = movie.id
      LEFT JOIN director ON director.person_id = movie.id
      LEFT JOIN media_actor ON media_actor.actor_id = actor.id
      LEFT JOIN media_director ON media_director.director_id = director.id
      WHERE movie.id = [idIn] 

DELETE actor.*, director.* FROM movie
      LEFT JOIN actor ON actor.person_id = movie.id
      LEFT JOIN director ON director.person_id = movie.id
      WHERE movie.id = [idIn]

DELETE movie.* FROM movie
      WHERE movie.id = [idIn]   

DELETE media_actor.*, media_director.* FROM tvshow
      LEFT JOIN actor ON actor.person_id = tvshow.id
      LEFT JOIN director ON director.person_id = tvshow.id
      LEFT JOIN media_actor ON media_actor.actor_id = actor.id
      LEFT JOIN media_director ON media_director.director_id = director.id
      WHERE tvshow.id = [idIn] 

DELETE actor.*, director.* FROM tvshow
      LEFT JOIN actor ON actor.person_id = tvshow.id
      LEFT JOIN director ON director.person_id = tvshow.id
      WHERE tvshow.id = [idIn]

DELETE tvshow.* FROM tvshow
      WHERE tvshow.id = [idIn]      



    SELECT person.first_name AS fn, person.last_name AS ln, person.birthdate AS bd FROM tvshow 
        INNER JOIN media ON media.id=tvshow.media_id
        INNER JOIN media_actor ON media_actor.media_id = media.id
        INNER JOIN actor ON actor.id = media_actor.actor_id
        INNER JOIN person ON person.id = actor.person_id    
        WHERE tvshow.id = [tvShowIn] 
        ORDER BY tvshow.title

    SELECT person.first_name AS fn, person.last_name AS ln, person.birthdate AS bd FROM tvshow 
        INNER JOIN media ON media.id=tvshow.media_id
        INNER JOIN media_director ON media_director.media_id = media.id
        INNER JOIN director ON director.id = media_director.director_id
        INNER JOIN person ON person.id = director.person_id    
        WHERE tvshow.id = [tvShowIn] 
        ORDER BY tvshow.title

  SELECT tvshow.title AS title, tvshow.start_year AS start_year, tvshow.end_year AS end_year, 
  tvshow.release_country AS release_country, tvshow.content_rating AS content_rating,
    person.first_name AS first_name, person.last_name AS last_name,
    GROUP_CONCAT(DISTINCT genre.genre_type ORDER BY genre.genre_type SEPARATOR ', ') AS genre_type
    FROM tvshow 
      INNER JOIN media ON media.id=tvshow.media_id
      INNER JOIN media_actor ON media_actor.media_id = media.id
      INNER JOIN actor ON actor.id = media_actor.actor_id
      INNER JOIN person ON person.id = actor.person_id    
      INNER JOIN tvshow_genre ON tvshow_genre.tvshow_id = tvshow.id
      INNER JOIN genre ON genre.id = tvshow_genre.genre_id
      WHERE tvshow.id = [tvShowIn] 
      ORDER BY title

  SELECT tvshow_episode.airdate AS airdate, tvshow_episode.episode_title AS title, tvshow_episode.runtime AS runtime, tvshow_episode.season AS season, tvshow_episode.episode_number AS number FROM tvshow_episode
    INNER JOIN tvshow ON tvshow.id = tvshow_episode.tvshow_id
    WHERE tvshow.id = [tvShowIn]

  SELECT rating.rating AS rating, rating.rating_url AS rating_url, site.name AS site_name, site.max_rating AS max_rating FROM tvshow
    INNER JOIN media ON media.id = tvshow.media_id
    INNER JOIN rating ON rating.media_id = media.id
    INNER JOIN site ON site.id = rating.site_id
    WHERE tvshow.id = [tvShowIn]
    ORDER BY site_name;


      
-- Advanced Movie Search Query: modified on website to allow any combination of the search terms -- 
SELECT movie.id AS movie_id, title, release_date, release_country, runtime, content_rating, GROUP_CONCAT(genre.genre_type ORDER BY genre.genre_type SEPARATOR ', ') AS genre_type FROM movie 
  LEFT JOIN media ON media.id = movie.media_id
  LEFT JOIN movie_genre ON movie_genre.movie_id = movie.id 
  LEFT JOIN genre ON genre.id = movie_genre.genre_id 
  INNER JOIN (SELECT media.id FROM movie
                LEFT JOIN movie_genre ON movie_genre.movie_id = movie.id
                LEFT JOIN genre ON genre.id = movie_genre.genre_id
                LEFT JOIN media ON media.id = movie.media_id
                INNER JOIN (SELECT media.id FROM media
                            LEFT JOIN media_director ON media_director.media_id = media.id
                            LEFT JOIN director on director.id = media_director.director_id
                            LEFT JOIN person on person.id = director.person_id
                            WHERE first_name = [actorFirstNameIn] AND last_name = [actorLastNameIn]
                ) d_reqs ON d_reqs.id = media.id
                INNER JOIN (SELECT media.id FROM media
                              LEFT JOIN media_actor ON media_actor.media_id = media.id
                              LEFT JOIN actor ON actor.id = media_actor.actor_id  
                              LEFT JOIN person on person.id = actor.person_id 
                              WHERE first_name = [directorFirstNameIn] AND last_name = [directorLastNameIn]
                ) AS a_reqs ON a_reqs.id = media.id

                WHERE release_country = [countryIn] 
                  AND runtime = [runtimeIn]
                  AND YEAR(release_date) = [yearIn]
                  AND (genre_type = [genreIn1] OR genre_type = [genreIn2] OR genre_type = [genreIn3] OR genre_type = [genreIn4]) 
                  AND (content_rating = [ratingIn1] OR content_rating = [ratingIn2] OR content_rating = [ratingIn3])
                      
                GROUP BY id 
  ) AS movie_reqs on movie_reqs.id = media.id
  GROUP BY title
  ORDER BY title;