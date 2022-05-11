-- low_fresh.sql
-- displays info for each rated movie

DELIMITER ?

DROP PROCEDURE IF EXISTS low_fresh ?

CREATE PROCEDURE low_fresh()
BEGIN


	SELECT DISTINCT movieID, movie_name, tomatometer_rating
       FROM Review
     WHERE tomatometer_status = 'Fresh'
      ORDER BY tomatometer_rating
      LIMIT 10;


END; ?

DELIMITER ;



