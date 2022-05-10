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


       $dataPoints = array();
       foreach($result as $row) {
       array_push($dataPoints, array( "label"=> $row["rating"], "y"=> $row["MeanBoxOffice"]));


       }

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


<html>
<head>
<script>
window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title:{
                        text: "Mean International Box Office (Millions of Dollars) for Different Movie Ratings"
                },
                data: [{
                        type: "bar", //change type to column, bar, line, area, pie, etc
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
        });
        chart.render();
}
</script>
</head>
<body>
        <div id="chartContainer" style="height: 400px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>