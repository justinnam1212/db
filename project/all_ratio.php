<head><title>all_ratio: displays all ratios</title></head>
<body>
<?php

        //open a connection to dbase server
        include 'open.php';

        $myQuery = "CALL all_ratio()";
        $conn->multi_query($myQuery);
        $result = $conn->store_result();
        if ($result) {
       	    echo "<table border=\"2px solid black\">";
           echo "<tr><td> movie </td><td> % box office domestic </td?></tr>";
	   echo "<br>highest ratios<br>";
           foreach ($result as $row){
                echo "<tr>";
                 echo "<td>".$row["movie"]."</td>";
                 echo "<td>".$row["box_office_ratio"]."</td>";
                 echo "</tr>";
                 }
                 echo "</table>";
                 $conn->next_result();
                 $result2 = $conn->store_result();
		 echo "<br>lowest ratios<br>";
                 echo "<table border=\"2px solid black\">";
                 echo "<tr><td> movie </td><td> ratio </td?></tr>";
                 foreach ($result2 as $row){
                 echo "<tr>";
                      echo "<td>".$row["movie"]."</td>";
                      echo "<td>".$row["box_office_ratio"]."</td>";
                      echo "</tr>";
                 }
                 echo "</table>";
		 
                 } else {
                 echo "not set";
}
        $conn->close();

?>
</body>