<head><title>c1: displaying all course score</title></head>
<body>
<?php
        include 'open.php';

	$pass = $_POST['password'];
	$NumQuizzesResult = $conn->query("SELECT CountQuiz();");
        $NumQuizzes = $NumQuizzesResult->fetch_assoc()["CountQuiz()"];
        $NumExamResult = $conn->query("SELECT CountExam();");
        $NumExams = $NumExamResult->fetch_assoc()["CountExam()"];
	
        echo "<h2>All Course Averages</h2><br>";

        if (!empty($pass)) {
        if($resultsPass = $conn->query("SELECT IsPassword('".$pass."');")) {
         if($resultsPass->fetch_assoc()["IsPassword('".$pass."')"] == 0) {
           echo "ERROR: Invalid password<br><br>";
           }
           else {
	   	if($result = $conn->query("CALL AllPercentages(".$NumQuizzes.", ".$NumExams.");")) {
		echo "<table border=\"2px solid black\">";
		echo "<tr><td>SID</td><td>LName</td><td>FName</td><td>Section</td><td>Course Average</td>";
		foreach($result as $row){
		echo "<tr>";
                echo "<td>".$row["SID"]."</td>";
                echo "<td>".$row["LName"]."</td>";
                echo "<td>".$row["FName"]."</td>";
                echo "<td>".$row["Sec"]."</td>";
		$num_form = number_format((float)$row["CourseAverage"], 2, '.', '');
		echo "<td>".$num_form."%"."</td>";
		echo "</tr>";}
		echo "</table>";
		} else {
		echo "Call to AllPercentages failed <br>";
		}
	}
	}
	} else {
	  echo "pass not set";
	}
	$conn->close();
?>
</body?
 