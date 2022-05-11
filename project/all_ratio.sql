-- all_ratio.sql
-- Displays highest and lowest ratios for all movies                                 

DELIMITER ?

DROP PROCEDURE IF EXISTS all_ratio ?

CREATE PROCEDURE all_ratio()
BEGIN

SELECT movie, 100 * domestic_box_office / (domestic_box_office + international_box_office) AS box_office_ratio
FROM Movie
ORDER BY box_office_ratio DESC;

SELECT movie, 100 * domestic_box_office / (domestic_box_office + international_box_office) AS box_office_ratio
FROM Movie
ORDER BY box_office_ratio ASC;

END; ?

DELIMITER ;
