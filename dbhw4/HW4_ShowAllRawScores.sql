-- Justin Nam
-- jnam17
-- HW4_AllRawScores

DELIMITER //

DROP FUNCTION IF EXISTS IsPassword //

CREATE FUNCTION IsPassword(item VARCHAR(15))
RETURNS INTEGER
BEGIN
      RETURN (SELECT COUNT(CurPasswords) FROM HW4_Password WHERE CurPasswords = item);
END; //

DELIMITER ;

DELIMITER //

DROP PROCEDURE IF EXISTS GetSIDs //

CREATE PROCEDURE GetSIDs()
BEGIN
	SELECT SID
	FROM HW4_Student
	ORDER BY Sec, LName, FName;
END; //

DELIMITER ;


DELIMITER //

DROP PROCEDURE IF EXISTS AllScores //

CREATE PROCEDURE AllScores()
BEGIN
	DECLARE done int default 0;
	DECLARE current_SID varchar(4);
	DECLARE SID_curs cursor for (SELECT SID
        FROM HW4_Student
        ORDER BY Sec, LName, FName);
	DECLARE continue handler for not found set done = 1;

	OPEN SID_curs;
	SID_loop : LOOP
	FETCH SID_curs INTO current_SID;
		IF done THEN
		 CLOSE SID_curs;
		 LEAVE SID_loop;
		END IF;
		CALL ShowRawScores(current_SID);
	
	END LOOP;
END //

DELIMITER ;
