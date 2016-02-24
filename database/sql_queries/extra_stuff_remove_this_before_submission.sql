ALTER TABLE genre ADD CONSTRAINT UNIQUE(genre_type);
DELETE FROM genre WHERE id=1;

INSERT INTO genre(genre_type) VALUES ("Crime");