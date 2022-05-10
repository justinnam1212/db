-- high_rot.sql
-- displays info for each rated movie

DELIMITER ?

DROP PROCEDURE IF EXISTS high_rot ?

CREATE PROCEDURE high_rot()
BEGIN


	SELECT DISTINCT movieID, movie_name, tomatometer_rating
       FROM Review
     WHERE tomatometer_status = 'Rotten'
      ORDER BY tomatometer_rating DESC;


END; ?

DELIMITER ;



