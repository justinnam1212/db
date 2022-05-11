-- movie_rating.sql
-- displays info for each rated movie

DELIMITER ?

DROP PROCEDURE IF EXISTS movie_rating ?

CREATE PROCEDURE movie_rating()
BEGIN

	SELECT rating, AVG(international_box_office) / 1000000 AS MeanBoxOffice, AVG(running_time) AS MeanRunTime
	FROM Movie
	GROUP BY rating
	ORDER BY MeanBoxOffice DESC;

END; ?

DELIMITER ;



