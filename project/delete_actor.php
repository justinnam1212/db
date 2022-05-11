<body>
<?php
        include 'open.php';

	
	$pid = $_POST['ID'];

    if (!empty($pid)) {
        if($resultsPass = $conn->query("SELECT IsPerson('".$pid."');")) {
         if($resultsPass->fetch_assoc()["IsPerson('".$pid."')"] <= 0) {
           echo "ERROR: ID does not exist in database<br><br>";
           }
         else {
            if ($stmt = $conn->prepare("CALL deletePerson(?)")) {
                $stmt->bind_param("s", $pid);
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