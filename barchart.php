<?php 
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"osrs_db");
$test=array();
$count=0;
$res=mysqli_query($link,"select * from results");
while($row=mysqli_fetch_array($res))
{
  $test[$count]["label"]=$row["student_id"];
  $test[$count]["y"]=$row["marks_percentage"];
  $count=$count+1;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Report Analysis"
	},
	axisY: {
		title: "Average Marks"
	},
    axisX: {
		title: "Student id"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.##",
		dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> 