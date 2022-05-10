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
       $dataPoints = array();
       foreach($result as $row){
       		       $domestic = $row["box_office_ratio"];
           }
array_push($dataPoints, array( "label"=> "% domestic", "y"=> $domestic));	   
array_push($dataPoints,	array( "label" => "% international minus domestic","y" => 100-$domestic));
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



<html>
<head>
<script>
window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title:{
                        text: "Domestic vs International Box Office"
			},
                data: [{
                        type: "pie", //change type to column, bar, line, area, pie, etc
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