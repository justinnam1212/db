DELIMITER //
DROP PROCEDURE IF EXISTS GetMovieIDs //

CREATE PROCEDURE GetMovieIDs()
BEGIN
	SELECT movieID
	FROM Movie;
END; //

DELIMITER ;


DELIMITER //
DROP PROCEDURE IF EXISTS GetYears //

CREATE PROCEDURE GetYears()
BEGIN
	SELECT DISTINCT production_year
	FROM Movie;
END; //

DELIMITER ;


DELIMITER //

DROP PROCEDURE IF EXISTS most_critic //

CREATE PROCEDURE most_critic(IN item VARCHAR(30))
BEGIN

	SELECT critic_name, COUNT(review_type) as NumberReviews
	FROM Review as R
	WHERE publisher_name LIKE item
	GROUP BY critic_name;

END //

DELIMITER ;

DELIMITER //

DROP PROCEDURE IF EXISTS actor_budget //

CREATE PROCEDURE actor_budget()
BEGIN 
	WITH actorsBudgetRank AS (
	SELECT I.personID, AVG(production_budget) AS avgBudget
	FROM Movie as M JOIN IsIn as I on M.movieID = I.movieID
	WHERE I.job = 'actor'
	GROUP BY I.personID)

	SELECT P.primaryName, A.personID, avgBudget
	FROM Person AS P JOIN actorsBudgetRank AS A on P.personID = A.personID
	ORDER BY avgBudget;
END //

DELIMITER ;

DELIMITER //

DROP PROCEDURE IF EXISTS year_prod_age //

CREATE PROCEDURE year_prod_age(IN item year(4))
BEGIN 
	WITH ActorsAndMovies AS (
	SELECT production_year, I.personID, domestic_box_office
	FROM Movie AS M JOIN IsIn AS I on M.movieID = I.movieID
	WHERE I.job = 'actor')
	SELECT A.production_year, AVG(domestic_box_office) AS avgDomBox, AVG(international_box_office) AS avgIntBox, (production_year - birthYear) as AverageAge
	FROM ActorsAndMovies AS A JOIN Person AS P on A.personID = P.personID
	WHERE A.production_year = item;
	
END //

DELIMITER ;

DELIMITER //

DROP PROCEDURE IF EXISTS AllYears //

CREATE PROCEDURE AllYears()
BEGIN
	DECLARE done int default 0;
	DECLARE current_year year(4);
	DECLARE year_curs cursor for (SELECT DISTINCT production_year
	FROM Movie);
	DECLARE continue handler for not found set done = 1;

	OPEN year_curs;
	year_loop : LOOP
	FETCH year_curs INTO current_year;
		IF done THEN
		 CLOSE year_curs;
		 LEAVE year_loop;
		END IF;
		CALL year_prod_age(current_year);
	
	END LOOP;
END //

DELIMITER ;


DELIMITER //

DROP PROCEDURE IF EXISTS AllDirectors //

CREATE PROCEDURE AllDirectors()
BEGIN
	WITH directorBudgetRank AS (
	SELECT I.personID, SUM(production_budget) AS TotalBudget
	FROM Movie as M JOIN IsIn as I on M.movieID = I.movieID
	WHERE I.category = 'director'
	GROUP BY I.personID)
	SELECT P.primaryName, TotalBudget
	FROM Person AS P JOIN directorBudgetRank AS A on P.personID = A.personID
	ORDER BY TotalBudget DESC; 
END //

DELIMITER ;


DELIMITER //

DROP PROCEDURE IF EXISTS deleteMovie //

CREATE PROCEDURE deleteMovie(id VARCHAR(20))
BEGIN
	DELETE FROM Movie WHERE movieID = id;
END; //

DELIMITER ;



DELIMITER //

DROP PROCEDURE IF EXISTS deletePerson//

CREATE PROCEDURE deletePerson(id VARCHAR(10))
BEGIN
	DELETE FROM Person WHERE personID = id;
END; //

DELIMITER ;




DELIMITER //

DROP PROCEDURE IF EXISTS insertPerson//

CREATE PROCEDURE insertPerson(id VARCHAR(10), name VARCHAR(40), birthYear Integer(4), deathYear Integer(4), primaryProf VARCHAR(100), kft VARCHAR(100))
BEGIN
	INSERT INTO Movie VALUES
	(id, name, birthYear, deathYear, primaryProf, kft);
END; //

DELIMITER ;

DELIMITER //

DROP PROCEDURE IF EXISTS insertIsIn//

CREATE PROCEDURE insertIsIn(mid VARCHAR(20), ordering INTEGER, pid VARCHAR(10), category VARCHAR(40), job VARCHAR(40), chars VARCHAR(100))
BEGIN

	INSERT INTO IsIn VALUES
	(mid, ordering, pid, category, job, chars);
END; //

DELIMITER ;

DELIMITER //

DROP PROCEDURE IF EXISTS AllMovies//

CREATE PROCEDURE AllMovies()
BEGIN
	SELECT * FROM Movie;
END; //

DELIMITER ;


DELIMITER //

DROP FUNCTION IF EXISTS next_isin_num //

CREATE FUNCTION next_isin_num(movie VARCHAR(20))
RETURNS INTEGER
BEGIN
        RETURN (SELECT MAX(ordering) + 1 FROM IsIn WHERE movieID = movie);
END; //

DELIMITER ;


DELIMITER //
DROP FUNCTION IF EXISTS IsMovie //
CREATE FUNCTION IsMovie(id VARCHAR(20))
RETURNS INTEGER
BEGIN
      RETURN (SELECT COUNT(movieID) FROM Movie WHERE movieID = id);
END; //

DELIMITER ;


DELIMITER //
DROP FUNCTION IF EXISTS IsPerson//
CREATE FUNCTION IsPerson(id VARCHAR(10))
RETURNS INTEGER
BEGIN
      RETURN (SELECT COUNT(personID) FROM Person WHERE personID = id);
END; //

DELIMITER ;
