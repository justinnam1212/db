-- Justin Nam
-- jnam17
-- HW4_ShowRawScores.sql

DELIMITER //

DROP PROCEDURE IF EXISTS ShowRawScores //

CREATE PROCEDURE ShowRawScores(IN item VARCHAR(10))
BEGIN
      IF (SELECT COUNT(SID) FROM HW4_Student WHERE SID = item) > 0 THEN
        WITH StudentScore as
        (SELECT S.SID, LName, FName, Sec, Score, AName
        FROM (HW4_Student as S JOIN HW4_RawScore as RS ON S.SID = RS.SID AND S.SID = item))

        SELECT SID, LName, FName, Sec, Score, A.AName
        FROM HW4_Assignment as A LEFT OUTER JOIN StudentScore ON A.AName = StudentScore.AName;
      ELSE
        SELECT "ERROR: SID" AS SID;
      END IF;
END; //
DELIMITER ;
