<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 70%;
  border-collapse: collapse;
}
th {
  height: 60px;
  background-color:#DEB887;
}
td {
  height: 50px;
}
table, td, th {
  margin-left:450px;
  margin-top: 50px;
  border: 1px solid #ddd;
  padding: 10px;
  margin-bottom:50px;
}
img {
margin-top:10px;
margin-left:1550px;
margin-bottom:0px;
}
form {
margin-top:20px;
margin-left:800px;
margin-bottom:40px;
}
h2 {
margin-bottom:20px;
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
  <a href="customer.php">Customers   </a>
  <a href="products.php">Products</a>
</div>
<img src="logo.png" width="250" height="130">
<title>Product's profile</title>
<h1>Product's profile</h1>

<?php
$Barcode=$_POST['Barcode'];
$con = mysqli_connect('localhost','root','fresdr7l389','database');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}
//$Card_id='10023';
mysqli_select_db($con,"ajax_demo");
echo"<h2>Product info:</h2>";

$sql="SELECT * FROM Product WHERE Barcode='$Barcode'";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Product_name</th>
<th>Barcode</th>
<th>Category</th>
<th>Brand Name</th>
<th>Price(in euros)</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['Product_name'] . "</td>";
  echo "<td>" . $row['Barcode'] . "</td>";
  echo "<td>" . $row['Category_name'] . "</td>";
  echo "<td>" . $row['Brand_name'] . "</td>";
  echo "<td>" . $row['Price'] . "</td>";
  echo "</tr>";
}
echo "</table>";


echo"<h2>Product History:</h2>";

$sql="SELECT Start_date, End_date, Price FROM History WHERE Barcode='$Barcode'";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Start Date</th>
<th>End Date</th>
<th>Price</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  
echo "<tr>";
  echo "<td>" . $row['Start_date'] . "</td>";
  echo "<td>" . $row['End_date'] . "</td>";
  echo "<td>" . $row['Price'] . "</td>";
  echo "</tr>";
}
echo "</table>";

?>

<form action="removeProduct.php" method="get">
<button type="submit" name="Barcode" value="<?php echo $Barcode;?>">Remove Product</button>
</form>

<form action="updateProduct.html" method="get">
<button type="submit" name="Barcode" value="<?php echo $Barcode;?>">Update Product</button>
</form>



</body>
</html> 
