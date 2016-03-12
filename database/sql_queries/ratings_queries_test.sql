-- Select all movies/tv shows and their ratings
SELECT ms_u.title, rating.rating, site.max_rating, site.name FROM rating
  INNER JOIN rating_source ON rating.id = rating_source.rating_id
  INNER JOIN site ON site.id = rating_source.site_id
  INNER JOIN ( SELECT title, media_id FROM (	
      (SELECT title, media_id FROM movie)
      UNION ALL
      (SELECT title, media_id FROM tvshow)
    ) ms_u 
  ) ms_u ON ms_u.media_id = rating.media_id;
  
--- With percentages
SELECT ms_u.title, ROUND(rating.rating / site.max_rating * 100, 1) AS rating, site.name FROM rating
  INNER JOIN rating_source ON rating.id = rating_source.rating_id
  INNER JOIN site ON site.id = rating_source.site_id
  INNER JOIN ( SELECT title, media_id FROM (	
      (SELECT title, media_id FROM movie)
      UNION ALL
      (SELECT title, media_id FROM tvshow)
    ) ms_u 
  ) ms_u ON ms_u.media_id = rating.media_id;
    
----- Select all movies/tv shows with ratings by actor -----
SELECT ms_u.title, rating.rating, site.max_rating, site.name FROM rating
  INNER JOIN rating_source ON rating.id = rating_source.rating_id
  INNER JOIN site ON site.id = rating_source.site_id
  INNER JOIN ( 
    SELECT title, media_id FROM (	
      (SELECT title, media_id FROM movie)
      UNION ALL
      (SELECT title, media_id FROM tvshow)
    ) ms_u 
  ) ms_u ON ms_u.media_id = rating.media_id
WHERE ms_u.media_id IN (
	(SELECT media_id FROM media_actor
	INNER JOIN actor ON actor.id = media_actor.actor_id
	WHERE (actor.first_name = "Emily" AND actor.last_name = "Snyder")
	)
)
ORDER BY ms_u.title DESC;

--- All ratings for a given tv show/movie
SELECT ms_u.title, rating.rating, site.max_rating, site.name FROM rating
  INNER JOIN rating_source on rating.id = rating_source.rating_id
  INNER JOIN site on site.id = rating_source.site_id
  INNER JOIN ( 
    SELECT title, media_id FROM (
      (SELECT title, media_id FROM movie)
      UNION ALL
      (SELECT title, media_id FROM tvshow)
    ) ms_u
  ) ms_u ON ms_u.media_id = rating.media_id
WHERE ms_u.title = "Flubber"
                
--- Average ratings for a given tv show/movies
SELECT ms_u.title, ROUND(AVG(rating.rating / site.max_rating * 100), 1) AS average_rating FROM rating
  INNER JOIN rating_source on rating.id = rating_source.rating_id
  INNER JOIN site on site.id = rating_source.site_id
  INNER JOIN ( 
    SELECT title, media_id FROM (
      (SELECT title, media_id FROM movie)
      UNION ALL
      (SELECT title, media_id FROM tvshow)
    ) ms_u
  ) ms_u ON ms_u.media_id = rating.media_id
WHERE ms_u.title = "Flubber"

---- Average ratings for all tv shows/movies for a given actor
SELECT ms_u.title, ROUND(AVG(rating.rating / site.max_rating * 100), 1)AS average_rating FROM rating
  INNER JOIN rating_source on rating.id = rating_source.rating_id
  INNER JOIN site on site.id = rating_source.site_id
  INNER JOIN ( 
    SELECT title, media_id FROM (
      (SELECT title, media_id FROM movie)
      UNION ALL
      (SELECT title, media_id FROM tvshow)
    ) ms_u
  ) ms_u ON ms_u.media_id = rating.media_id
WHERE ms_u.media_id IN (
	(SELECT media_id FROM media_actor
	INNER JOIN actor ON actor.id = media_actor.actor_id
	WHERE (actor.first_name = "Emily" AND actor.last_name = "Snyder")
	)
)
GROUP BY ms_u.media_id
ORDER BY ms_u.title DESC;
