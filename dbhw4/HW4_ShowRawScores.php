<head><title>c1: displaying raw score</title></head>
<body>
<?php
	include 'open.php';

	$SID = $_POST['SID'];
	echo "<h2>Raw Scores</h2><br>";
	echo "SID: ";
	$Valid = 1;

	if (!empty($SID)) {
	   echo $SID;
	   echo "<br><br>";

	   if($result = $conn->query("CALL ShowRawScores('".$SID."');")) {

	   foreach($result as $row){
                
                if($row["SID"] == "ERROR: SID"){
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
	   	echo "</tr>";
		
		echo "<tr>";
		echo "<td>".$row["SID"]."</td>";
             	echo "<td>".$row["LName"]."</td>";
             	echo "<td>".$row["FName"]."</td>";
		echo "<td>".$row["Sec"]."</td>";
		foreach($result as $row){
		echo "<td>".$row["Score"]."</td>";
		}
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