<!DOCTYPE html>
<html>
<head>
	<title>View Sales</title>
<img src="logo.png" width="250" height="130">

	<h1 style="border-left: 70px;">View Sales per Store</h1>
<style>
table {
  width: 70%;
  border-collapse: collapse;
}
img {
margin-top:10px;
margin-left:1550px;
margin-bottom:0px;
}

th {
  height: 60px;
  background-color: #DEB887;
}
td {
  height: 50px;
}
table, td, th {
  text-align: center;
  margin-left: 450px;
  margin-top: 50px;
  border: 1px solid #ddd;
  padding: 10px;
  margin-bottom:50px;
}
form {
margin-top:20px;
margin-left:410px;
margin-bottom:40px;
}
tr:hover {background-color: #edebeb;}
th {text-align: middle;}

</style>
</head>

<body>

  <link rel="stylesheet" href="theme.css">
<div class="sidenav">
  <a href="welcome.jsp">Home</a>
  <a href="store.php">Stores</a>
  <a href="customer.php">Customers</a>
  <a href="products.php">Products</a>
</div>

<?php
$connection = mysqli_connect('localhost','root', 'fresdr7l389','database');
if (!$connection) {
  die('Could not connect: ' . mysqli_error($connection));
}


$q="SELECT DISTINCT Store_id, Category_name, SUM(Pieces) as SoldPieces FROM Sales GROUP BY Store_id, Category_name ORDER BY Store_id";
$result = mysqli_query($connection,$q);

echo "<table>
<tr>
<th style='text-align:center;'>Store ID</th>
<th style='text-align:center;'>Category</th>
<th style='text-align:center;'>Sold Pieces</th>
</tr>";
$N=0;
while($row = mysqli_fetch_array($result))
{
if ($N==0) {
  echo "<td style='background-color:#DEB887;'>" . $row['Store_id'] . "</td>";
  echo "<td>" . $row['Category_name'] . "</td>";
  echo "<td>" . $row['SoldPieces'] . "</td>";
 }
else {
  echo "<tr>";
  if ($row['Store_id']!=$PreviousStoreID)
    echo "<td style='background-color:#DEB887;'>" . $row['Store_id'] . "</td>";
  else 
  echo '<td>&nbsp;</td>';

  echo "<td>" . $row['Category_name'] . "</td>";
  echo "<td>" . $row['SoldPieces'] . "</td>";

  echo "</tr>";

 }
 $N++;
 $PreviousStoreID=$row['Store_id'];
}
echo "</table>";
$q="SELECT Store_id";
$result = mysqli_query($connection,$q);
mysqli_close($connection); 
?>
</body>
</html>
