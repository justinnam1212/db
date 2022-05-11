-- desc_tomato.sql
-- displays info for each rated movie

DELIMITER ?

DROP PROCEDURE IF EXISTS desc_tomato ?

CREATE PROCEDURE desc_tomato()
BEGIN


	SELECT DISTINCT movieID, movie_name, tomatometer_rating
       FROM Review
      ORDER BY tomatometer_rating DESC;


END; ?

DELIMITER ;



