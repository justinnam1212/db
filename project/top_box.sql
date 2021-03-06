-- top.sql                                                                                                                       
-- displays top box scores                                                                                                   

DELIMITER ?

DROP PROCEDURE IF EXISTS top_box ?

CREATE PROCEDURE top_box(IN num INT)
BEGIN

SELECT movie, international_box_office / 1000000 AS 'International', domestic_box_office / 1000000 AS 'Domestic'
FROM Movie
ORDER BY international_box_office DESC
LIMIT num;

END; ?

DELIMITER ;
