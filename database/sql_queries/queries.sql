----------------------------------------------------------------------------------------------------
-- QUERIES ---



-- Add all queries used in the website here before submission --

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
                              WHERE first_name = 'Ben' AND last_name = 'Stiller'
                  ) d_reqs ON d_reqs.id = media.id
                  INNER JOIN (SELECT media.id FROM media
                                LEFT JOIN media_actor ON media_actor.media_id = media.id
                                LEFT JOIN actor ON actor.id = media_actor.actor_id  
                                LEFT JOIN person on person.id = actor.person_id 
                                WHERE first_name = 'Ben' AND last_name = 'Stiller'
                  ) AS a_reqs ON a_reqs.id = media.id

                  WHERE release_country = 'USA' 
                       AND runtime = 119
                       AND YEAR(release_date) = 2016
                       AND (genre_type = 'Action' OR genre_type = 'Comedy' OR genre_type = 'Drama' OR genre_type = 'Adventure') 
                       AND (content_rating = 'PG' OR content_rating = 'R'OR content_rating = 'PG-13')
                        
                  GROUP BY id 
    ) AS movie_reqs on movie_reqs.id = media.id
    GROUP BY title
    ORDER BY title