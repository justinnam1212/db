-- fresh_rotten_by_year.sql
-- Displays either fresh or rotten movies by year

DELIMITER ?

DROP PROCEDURE IF EXISTS fresh_rotten_by_year ?

CREATE PROCEDURE fresh_rotten_by_year(IN user_choice VARCHAR(12))
BEGIN


SELECT M.production_year, COUNT(tomatometer_rating) AS countFresh
FROM Review AS R JOIN Movie AS M on R.movieID = M.movieID
WHERE review_type = user_choice
GROUP BY M.production_year;



END; ?

DELIMITER ;
