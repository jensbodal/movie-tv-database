-- CREATE GENRE --
INSERT INTO genre (genre_type) VALUES
	([genre_name1]),([genre_name2]);


-- INSERT MOVIE --
START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  VALUES
	([movie_title], LAST_INSERT_ID(), [movie_date], [movie_country], [movie_runtime], [movie_rating]);
COMMIT;


-- INSERT MOVIE GENRE --
INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT @mId := id FROM movie WHERE title = [movie_title]),(SELECT id FROM genre WHERE genre_type = [genre1])),
	(@mId, (SELECT id FROM genre WHERE genre_type = [genre2])),
	(@mId, (SELECT id FROM genre WHERE genre_type = [genre3]));


-- INSERT TVSHOW --
START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO tvshow (title, media_id, start_year, release_country, content_rating)
	VALUES ([tv_title], LAST_INSERT_ID(), [tv_start_year], [tv_country], [tv_rating]);
COMMIT;

START TRANSACTION;
INSERT INTO media (id) 
	VALUES (null);
INSERT INTO tvshow (title, media_id, start_year, end_year, release_country, content_rating)
	VALUES ([tv_title], LAST_INSERT_ID(), [tv_start_year], [tv_end_year], [tv_country], [tv_rating]);
COMMIT;


-- INSERT TVSHOW_GENRE --
INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES	
	((SELECT @tId := id FROM tvshow WHERE title = [tv_title]),(SELECT id FROM genre WHERE genre_type = [genre1])),
	(@tId, (SELECT id FROM genre WHERE genre_type = [genre2])),
	(@tId, (SELECT id FROM genre WHERE genre_type = [genre3]));
	
INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES	
	((SELECT id FROM tvshow WHERE (title = [tv_title] AND release_country = [country])),(SELECT id FROM genre WHERE genre_type = [genre]));

-- INSERT TVSHOW_EPISODE --
INSERT INTO tvshow_episode(tvshow_id, airdate, episode_title, runtime, episode_number, season) VALUES
	((SELECT @tId := id FROM tvshow WHERE title = [show_title]), [ep_airdate], [ep_title], [show_runtime], [ep_number], [ep_season]),
	(@tId, [ep2_airdate], [ep2_title], [ep2_runtime], [ep2_number], [ep2_season]),
	(@tId, [ep3_airdate], [ep3_title], [ep3_runtime], [ep3_number], [ep3_season]);
	
-- INSERT PEOPLE --
INSERT INTO person(first_name, last_name, birthdate) VALUES
	([first_name1], [last_name1], [birthday1]),
	([first_name2], [last_name2], [birthday2]),
	([first_name3], [last_name3], [birthday3]);


-- INSERT ACTOR --
INSERT INTO actor(person_id) VALUES
	((SELECT id FROM person WHERE (first_name = [first_name1] AND last_name = [last_name1]))), 
	((SELECT id FROM person WHERE (first_name = [first_name2] AND last_name = [last_name2]))); 


-- INSERT DIRECTOR --
INSERT INTO director(person_id) VALUES
	((SELECT id FROM person WHERE (first_name = [first_name1] AND last_name = [last_name1]))), 
	((SELECT id FROM person WHERE (first_name = [first_name2] AND last_name = [last_name2])));

-- INSERT MEDIA_ACTOR --
INSERT INTO media_actor(media_id, actor_id) VALUES
	((SELECT media_id FROM tvshow WHERE (title = [show_name] AND release_country = [show_country])), 
	(SELECT actor.id FROM actor INNER JOIN person ON actor.person_id = person.id WHERE (person.first_name = [actor_first_name] AND person.last_name = [actor_last_name])));
	
	
-- INSERT site --
INSERT INTO site (name, site_url, max_rating) VALUES
	([site_name1], [url1], [site_max1]),
	([site_name2], [url2], [site_max2]);
	
INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	((SELECT movie.media_id FROM movie INNER JOIN media ON media.id = movie.media_id WHERE (movie.title = [movie_title])),
        (SELECT site.id FROM site WHERE (site.name = [site_name])),
	[rating],
	[review_url]);
