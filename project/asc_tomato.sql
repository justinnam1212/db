-- asc_tomato.sql
-- displays info for each rated movie

DELIMITER ?

DROP PROCEDURE IF EXISTS asc_tomato ?

CREATE PROCEDURE asc_tomato()
BEGIN


	SELECT DISTINCT movieID, movie_name, tomatometer_rating
       FROM Review
      ORDER BY tomatometer_rating;
      
END; ?

DELIMITER ;



