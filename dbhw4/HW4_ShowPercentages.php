<head><title>c1: displaying percentages</title></head>
<body>
<?php
        include 'open.php';

        $SID = $_POST['SID'];
	$CourseAvg = 0.0;
        echo "<h2>Percentage and Course Average</h2><br>";
        echo "SID: ";
	$Valid = 1;

	$NumQuizzesResult = $conn->query("SELECT CountQuiz();");
	$NumQuizzes = $NumQuizzesResult->fetch_assoc()["CountQuiz()"];
	$NumExamResult = $conn->query("SELECT CountExam();");
	$NumExams = $NumExamResult->fetch_assoc()["CountExam()"];

        if (!empty($SID)) {
           echo $SID;
           echo "<br><br>";

           if($result = $conn->query("CALL ShowPercentages('".$SID."');")) {

	   foreach($result as $row){
                if($row["SID"] == "ERROR: SID "){
                echo $row["SID"]." ".$SID. " not found";
                $Valid = 0;
		}
		}

	if($Valid == 1){
	   echo "<table border=\"2px solid black\">";
              echo "<tr><td>SID</td><td>LName</td><td>FName</td><td>Section</td>";
                foreach($result as $row){
                echo "<td>".$row["AName"]."</td>";
                }
		echo "<td>"."courseAvg"."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>".$row["SID"]."</td>";
                echo "<td>".$row["LName"]."</td>";
                echo "<td>".$row["FName"]."</td>";
                echo "<td>".$row["Sec"]."</td>";
                foreach($result as $row){
		$num_form = number_format((float)$row["Percentage"]*100, 2, '.', '');
                echo "<td>".$num_form."%"."</td>";
		if($row["AType"] == "QUIZ") {
		$CourseAvg = $CourseAvg + (float)$row["Percentage"]*100 * 0.40/(float)$NumQuizzes;
		}
		else {
		$CourseAvg = $CourseAvg + (float)$row["Percentage"]*100 * 0.60/(float)$NumExams;
                }
		}
		echo "<td>".number_format((float)$CourseAvg, 2, '.', '')."%"."</td>";
                echo "</tr>";
            echo "</table>";
	    }
           } else {
             echo "Call to ShowRawScores failed<br>";
            }
        } else {
           echo "not set";
        }
        $conn->close();

?>
</body?