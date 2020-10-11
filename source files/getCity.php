<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$q = strval($_GET['q']);

$con = mysqli_connect('localhost','root','fresdr7l389','database');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");

$sql="SELECT T.Store_id,Street,Number,COUNT(T.Store_id)
FROM Transaction as T, (SELECT Street , Number , Store_id
		FROM Store
		WHERE City = '".$q."') as S
WHERE T.Store_id = S.Store_id
GROUP BY T.Store_id
ORDER BY COUNT(T.Store_id) DESC
LIMIT 1";


$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Store id</th>
<th>Street</th>
<th>Number</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['Store_id'] . "</td>";
  echo "<td>" . $row['Street'] . "</td>";
  echo "<td>" . $row['Number'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);

?>

</body>
</html>
