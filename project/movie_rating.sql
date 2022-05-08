-- movie_rating.sql
-- displays info for each rated movie

DELIMETER ?

DROP PROCEDURE IF EXISTS

CREATE PROCEDURE movie_rating_info()
BEGIN

	SELECT movieID, AVG(international_box_office) AS MeanBoxOffice, AVG(running_time) AS MeanRunTime
	FROM Movie
	GROUP BY rating
	ORDER BY MeanBoxOffice;




END; ?

DELIMETER ;


