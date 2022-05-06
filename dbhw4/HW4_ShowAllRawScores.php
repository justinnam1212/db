<head><title>c1: displaying all raw score</title></head>
<body>
<?php
	include 'open.php';

	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	$pass = $_POST['password'];
	echo "<h2>All Raw Scores</h2><br>";
	$Valid = 1;

	if (!empty($pass)) {
	if($resultsPass = $conn->query("SELECT IsPassword('".$pass."');")) {
	 if($resultsPass->fetch_assoc()["IsPassword('".$pass."')"] == 0) {
	   echo "ERROR: Invalid password<br><br>";
	   }
	   else {
	   $Assigns = $conn->query("SELECT AName FROM HW4_Assignment ORDER BY AName;");
	   echo "<table border=\"2px solid black\">";
           echo "<tr><td>SID</td><td>LName</td><td>FName</td><td>Section</td>";
	   foreach($Assigns as $row) {
	   	echo "<td>".$row["AName"]."</td>";
               }
           echo "</tr>";

	   $conn->multi_query("CALL AllScores();");

	   $result = $conn->store_result();

	   while ($result) {
	   $inforow = $result->fetch_assoc();
	   //this assumes that a student must have taken at least one assignment
	   while($inforow["SID"] == ""){
	   	$inforow = $result->fetch_assoc();
		}
	   echo "<td>".$inforow["SID"]."</td>";
	   echo "<td>".$inforow["LName"]."</td>";
           echo "<td>".$inforow["FName"]."</td>";
           echo "<td>".$inforow["Sec"]."</td>";
           foreach($result as $row){
           	echo "<td>".$row["Score"]."</td>";
           }
                echo "</tr>";
		$result->free();
		$conn->next_result();
		$result = $conn->store_result();
              }
	      echo "</table>";
	}
       	   } else {
             echo "Call to ShowAllRawScores failed<br>";
	    }
	} else {
	   echo "pass not set";
	}
	$conn->close();
?>
</body?