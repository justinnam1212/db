-- Justin Nam
-- jnam17
-- HW4_ShowAllCourseAverages.sql



DELIMITER //

DROP PROCEDURE IF EXISTS AllPercentages //

CREATE PROCEDURE AllPercentages(IN numquiz int, IN numexam int)
BEGIN
With Weighted As
(SELECT SID, LName, FName, Sec, CASE WHEN AType = "QUIZ" THEN Score/PtsPoss * (.4/numquiz) ELSE Score/PtsPoss * (.6/numexam) END as 'Average'
FROM HW4_Assignment as A LEFT OUTER JOIN (SELECT S.SID, LName, FName, Sec, Score, AName
FROM (HW4_Student as S JOIN HW4_RawScore as RS ON S.SID = RS.SID)) as StudentScore ON A.AName = StudentScore.AName)

SELECT SID, LName, FName, Sec, SUM(Average)* 100 AS 'CourseAverage' 
FROM Weighted
GROUP BY SID
ORDER BY Sec, CourseAverage DESC, LName, FName;
END //

DELIMITER ;
