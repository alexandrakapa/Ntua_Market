<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$q = intval($_GET['q']);
$a = intval($_GET['a']);
$con = mysqli_connect('localhost','root','fresdr7l389','database');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT HOUR(DateTime),COUNT(*) FROM Transaction WHERE Card_id='".$a."' and Store_id='".$q."' GROUP BY HOUR(DateTime)ORDER BY HOUR(DateTime) ASC";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Hours in 24-hour format</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['HOUR(DateTime)'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>

</body>
</html>

