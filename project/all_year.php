
<?php
include 'open.php';

//Override the PHP configuration file to display all errors
//This is useful during development but generally disabled before release
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

//Collect the posted value in a variable called $item

echo "<h2>Information by Year</h2>";

//Determine if any input was actually collected
   echo "Budget Info and Actor Average Age for all years<br>";
   echo "(only includes data for which actor information is specified)";
   echo "<br><br>";

   //Prepare a statement that we can later execute. The ?'s are placeholders for
   //parameters whose values we will set before we run the query.
   $conn->multi_query("CALL AllYears();");

   $result = $conn->store_result();
   $dataPointsDom = array();
   $dataPointsInt = array();
   $dataPointsAge = array();

      while ($result) {
         $inforow = $result->fetch_assoc();
      //this assumes that a student must have taken at least one assignment
         foreach($result as $row) {
              array_push($dataPointsDom, array( "label"=> $row['production_year'], "y"=> $row['avgDomBox']));
              array_push($dataPointsInt, array( "label"=> $row['production_year'], "y"=> $row['avgIntBox']));
	      array_push($dataPointsAge, array( "label"=> $row['production_year'], "y"=> $row['AverageAge']));
	      }
      $result->free();
      $conn->next_result();
      $result = $conn->store_result();
      }
      //echo "</table>";

//Close the connection created in open.php

$conn->close();
?>
</body>






<html>
<head>
<script>
window.onload = function () {
        var chart1 = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title:{
                        text: "Domestic Box Office by Year"
                },
                data: [{
                        type: "line", //change type to column, bar, line, area, pie, etc
                        dataPoints: <?php echo json_encode($dataPointsDom, JSON_NUMERIC_CHECK); ?>
                }]
        });
        var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title:{
                        text: "International Box Office by Year"
                },
                data: [{
                        type: "line", //change type to column, bar, line, area, pie, etc
                        dataPoints: <?php echo json_encode($dataPointsInt, JSON_NUMERIC_CHECK); ?>
                }]
        });
	        var chart3 = new CanvasJS.Chart("chartContainer3", {
                animationEnabled: true,
                exportEnabled: true,
		theme: "light1", // "light1", "light2", "dark1", "dark2"
		title:{
                        text: "Avg Actor Age by Year"
                },
                data: [{
                        type: "line", //change type to column, bar, line, area, pie, etc
                        dataPoints: <?php echo json_encode($dataPointsAge, JSON_NUMERIC_CHECK); ?>
                }]
        });
        chart1.render();
        chart2.render();
	chart3.render();
}
</script>
</head>
<body>
        <div id="chartContainer" style="height: 400px; width: 100%;"></div>
        <div id="chartContainer2" style="height: 400px; width: 100%;"></div>
	<div id="chartContainer3" style="height: 400px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
