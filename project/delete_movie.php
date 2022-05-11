<body>
<?php
        include 'open.php';

	
	$mid = $_POST['ID'];

    if (!empty($mid)) {
        if($resultsPass = $conn->query("SELECT IsMovie('".$mid."');")) {
         if($resultsPass->fetch_assoc()["IsMovie('".$mid."')"] <= 0) {
           echo "ERROR: ID does not exist in database<br><br>";
           }
         else {
            if ($stmt = $conn->prepare("CALL deleteMovie(?)")) {
                $stmt->bind_param("s", $mid);
                $stmt->execute();
            }
         }
     }
	} else {
	  echo "ID not set";
	}
	$conn->close();
?>
</body?