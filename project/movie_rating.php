<head><title>c1: displaying bid history</title></head>
<body>
<?php
	echo '<body style="background-color:yellow">';
        //open a connection to dbase server
        include 'open.php';

        echo "<h2>Movie Rating Info</h2><br>";
	$myQuery = "CALL movie_rating();";
       if ($result = $conn->query($myQuery)) {
       echo "<table border=\"2px solid black\">";
       echo "<tr><td> rating </td><td> mean box office (millions $) </td><td> mean run time (mins) </td></tr>";
   
       foreach($result as $row){
             echo "<tr>";
             echo "<td>".$row["rating"]."</td>";
             echo "<td>".$row["MeanBoxOffice"]."</td>";
             echo "<td>".$row["MeanRunTime"]."</td>";
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