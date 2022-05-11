<head><title>c1: displaying lowest fresh scores</title></head>
<body>
<?php
	echo '<body style="background-color:grey">';
        //open a connection to dbase server
        include 'open.php';

        echo "<h2>Movie Rating Info</h2><br>";
	$myQuery = "CALL low_fresh();";
       if ($result = $conn->query($myQuery)) {
       echo "<table border=\"2px solid black\">";
       echo "<tr><td> movie ID </td><td> movie name </td><td> tomatometer rating (out of 100)  </td></tr>";
   
       foreach($result as $row){
             echo "<tr>";
             echo "<td>".$row['movieID']."</td>";
             echo "<td>".$row['movie_name']."</td>";
             echo "<td>".$row['tomatometer_rating']."</td>";
             echo "</tr>";
          }
              echo "</table>";
       } else {
       
          echo "Call to movie_rating failed<br>";
       }
       
       // } else {
         //  echo "not set";
       // }
        $conn->close();
	
?>
</body>