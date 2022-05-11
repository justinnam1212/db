<body>
<?php
        include 'open.php';

	$id = $_POST['ID'];
	$name = $_POST['person_name'];
	$byear= $_POST['birth_year'];
	$dyear= $_POST['death_year'];
	$pp = $_POST['prim_profession'];
	$kft = $_POST['known_for'];

    if (!empty($id)) {
        if($resultsPass = $conn->query("SELECT IsPerson('".$id."');")) {
         if($resultsPass->fetch_assoc()["IsPerson('".$pid."')"] > 0) {
           echo "ERROR: ID already used for a person<br><br>";
           }
         else {
         	if ($stmt = $conn->prepare("CALL insertPerson(?, ?, ?, ?, ?, ?")) {
         		$stmt->bind_param("ssiiss", [$id, $name, $byear, $dyear, $pp, $kft]);
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