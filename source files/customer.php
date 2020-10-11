<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 70%;
  border-collapse: collapse;
}
th {
  height: 50px;
  background-color: #DEB887;
}
td {
  height: 60px;
}
img {
margin-top:10px;
margin-left:1550px;
margin-bottom:0px;
}

table, td, th {
  margin-left:450px;
  margin-top: 80px;
  border: 1px solid #ddd;
  padding: 10px;
}
form {
margin-top:20px;
margin-left:410px;
margin-bottom:40px;
}
tr:hover {background-color: #edebeb;}
th {text-align: center;}
</style>
</head>
<body>
<link rel="stylesheet" href="theme.css">
<div class="sidenav">
  <a href="welcome.jsp">Home</a>
  <a href="store.php">Stores</a>
  <a href="customer.php">Customers   </a>
  <a href="products.php">Products</a>
</div>
<img src="logo.png" width="250" height="130">
<title>Customers</title>
<h1>Customers</h1>
<h2>In order to search for a specific customer please select a valid Card id from below</h2>
<form action="customer_profile.php" method="post">
<div class='container'>
<div class='Input'>
<td>Card id:</td>
<input type="text" name="Card_id" class='Input-text' placeholder="Exactly 5 digits">
</div>
</div>
<div class='container'>
<div class='Input'>
<td><input type="submit" name="submit" value="Submit"> </td>
<td><input type="reset" value="Reset"></td>
</div>
</div>
</form>

<?php

$con = mysqli_connect('localhost','root','fresdr7l389','database');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT Last_name,Name,Card_id FROM Customer ORDER BY Last_name ASC";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Last name</th>
<th>First name</th>
<th>Card id</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['Last_name'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Card_id'] . "</td>";
  echo "</tr>";
}

echo "</table>";

echo "<h2>The customer with the most transactions is:</h2>";

$sql="SELECT Card_id, Count(*) as SUM FROM Transaction GROUP BY Card_id ORDER BY SUM DESC LIMIT 1";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Card id</th>
<th>Number of transactions</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['Card_id'] . "</td>";
  echo "<td>" . $row['SUM'] . "</td>";
  echo "</tr>";
}

echo "</table>";

$sql="SELECT Name";
$result = mysqli_query($con,$sql);
mysqli_close($con);
?>
<form action="createCustomer.html">
<button type="submit">Create Customer</button>
</form>

<form action="updateCustomer.html">
<button type="submit">Update Customer</button>
</form>

</body>
</html> 

