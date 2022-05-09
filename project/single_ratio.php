<head><title>single_ratio: ratio of a movie</title></head>
<body>
<?php

        //open a connection to dbase server
        include 'open.php';

        // collect the posted value in a variable called $item
        $item = $_POST['movie'];

        echo "<h2>Movie and Box Office Ratio</h2>";
        echo "Movie: ";
	
        if (!empty($item)) {
           echo $item;
           echo "<br>";

	  
       if ($result = $conn->query("CALL single_ratio('".$item."');")) {

       echo "box office ratio is the percentage of box office that is domestic (100% * domestic/international) <br><br>";
       echo "<table border=\"2px solid black\">";
       echo "<tr><td> movie </td><td> box office ratio </td></tr>";
          foreach($result as $row){
             echo "<tr>";
             echo "<td>".$row["movie"]."</td>";
             echo "<td>".$row["box_office_ratio"]."</td>";
             echo "</tr>";
          }
              echo "</table>";
       } else {
          echo "Call to single_ratio failed<br>";
       }
        } else {
           echo "not set";
        }
        $conn->close();

?>
</body>
