-- HW4_ShowPercentages.sql                                                                                               
-- Displays a specific student's % and their overall grade                                                               

DELIMITER ?

DROP PROCEDURE IF EXISTS single_ratio ?

CREATE PROCEDURE single_ratio(IN selectedMovie VARCHAR(30))
BEGIN

SELECT movie, 100* domestic_box_office / (domestic_box_office + international_box_office) AS box_office_ratio
FROM Movie
WHERE movie = selectedMovie;

END; ?

DELIMITER ;
