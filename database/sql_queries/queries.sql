----------------------------------------------------------------------------------------------------
-- QUERIES ---
 SELECT person.first_name, person.last_name, movie.title FROM person 
	INNER JOIN actor ON actor.person_id = person.id 
	INNER JOIN media_actor ON media_actor.actor_id = actor.id 
	INNER JOIN movie ON movie.media_id = media_actor.media_id;


SELECT * FROM rating_source;
SELECT * FROM site;
SELECT * FROM rating;
SELECT * FROM media_director;
SELECT * FROM media_actor;
SELECT * FROM director;
SELECT * FROM actor;
SELECT * FROM person;
SELECT * FROM tvshow_episode;
SELECT * FROM tvshow_genre;
SELECT * FROM tvshow;
SELECT * FROM movie_genre;
SELECT * FROM movie;
SELECT * FROM genre;
SELECT * FROM media;






-- HAVE NOT MODIFIED TO WORK WITH CURRENT DATA
SELECT title FROM movie
	INNER JOIN media ON media.id = movie.media_id
	INNER JOIN media_actor ON media_actor.media_id = media.id
	INNER JOIN actor ON actor.id = media_actor.actor_id
	WHERE (actor.first_name = "Emily" AND actor.last_name = "Snyder");

-- select all tv shows and movies in alphabetical order that an actor has been in
SELECT title FROM (	
	(SELECT title, media_id FROM movie)
	UNION ALL
	(SELECT title, media_id FROM tvshow)
) ms_u
WHERE ms_u.media_id IN (
	(SELECT media_id FROM media_actor
	INNER JOIN actor ON actor.id = media_actor.actor_id
	WHERE (actor.first_name = "Emily" AND actor.last_name = "Snyder")
	)
)
ORDER BY ms_u.title DESC;