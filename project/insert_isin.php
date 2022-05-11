<body>
<?php
        include 'open.php';

	$mid = $_POST['movie_ID'];
	$pid = $_POST['person_ID'];
	$cat= $_POST['category'];
	$job= $_POST['job'];
	$char = $_POST['characters'];

    if (!empty($mid) && !empty($pid)) {
        if($resultsPass = $conn->query("SELECT IsPerson('".$pid."');")) {
         if($resultsPass->fetch_assoc()["IsPerson('".$pid."')"] > 0) {
           echo "ERROR: ID already used for a person<br><br>";
           }
         else {
            $resultsPass = $conn->query("SELECT IsMovie('".$mid."');")
            if($resultsPass->fetch_assoc()["IsMovie('".$mid."')"] > 0) {
                echo "ERROR: ID already used for a movie<br><br>";
            }
            else {
                if ($stmt = $conn->prepare("CALL insertIsIn(?, ?, ?, ?, ?)")) {
                $stmt->bind_param("sssss", [$mid, $pid, $cat, $job, $char]);
                $stmt->execute();
                }
            }
         }
     }
	} else {
	  echo "ID(s) not set";
	}
	$conn->close();
?>
</body?