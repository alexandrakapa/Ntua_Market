<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 70%;
  border-collapse: collapse;
}
th {
  text-align: center;
  height: 60px;
  background-color: #DEB887;
}
td {
  height: 50px;
}
table, td, th {
  text-align: center;
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
tr:hover {background-color: #edebeb;}
h2 {
margin-bottom:20px;
}

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

<title>Products</title>
<h1>Products</h1>
<h2>In order to search for a specific product please select a valid Barcode from below</h2>
<form style="margin-left: 450px;" action="product_profile.php" method="post">
<div class='container'>
<div class='Input'>
<td>Barcode:</td>
<input type="text" name="Barcode" class='Input-text' placeholder="Exactly 12 digits">
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

$connection = mysqli_connect('localhost','root', 'fresdr7l389','database');
if (!$connection) {
  die('Could not connect: ' . mysqli_error($connection));
}

mysqli_select_db($connection,"ajax_demo");
$sql="SELECT Product_name, Category_name, Barcode FROM Product ORDER BY Category_name,Product_name ASC";
$result = mysqli_query($connection,$sql);

echo "<table>";
echo "<tr>";
echo '<th style="text-align:center;">' .'Category_name' . '</th>';
echo '<th style="text-align:center;">'.'Product_name'. '</th>';
echo '<th style="text-align:center;">' . 'Barcode' . '</th>';
echo "</tr>";
$N=0;
while($row = mysqli_fetch_array($result)) {
  if ($N==0){
    echo "<tr>";
    echo "<td style='background-color:#DEB887;'>" . $row['Category_name'] . "</td>";
    echo "<td>" . $row['Product_name'] . "</td>";
    echo "<td>" . $row['Barcode'] . "</td>";
    echo "</tr>";
  }
  else {
    if ($PreviousCategory==$row['Category_name'])
    {
      echo "<tr>";
      echo '<td>&nbsp;</td>';
      echo "<td>" . $row['Product_name'] . "</td>";
      echo "<td>" . $row['Barcode'] . "</td>";
      echo "</tr>";
    }
    else 
    {
      echo "<tr>";
      echo "<td style='background-color:#DEB887;'>" . $row['Category_name'] . "</td>";
      echo "<td>" . $row['Product_name'] . "</td>";
      echo "<td>" . $row['Barcode'] . "</td>";
      echo "</tr>";
    }
   }
    $PreviousCategory=$row['Category_name'];
    $N++;

  }

echo "</table>";

mysqli_close($connection);

?>

<form action="CreateProduct.html">
<button type="submit">Create Product</button>
</form>

<?php

$connection = mysqli_connect('localhost','root', 'fresdr7l389','database');
if (!$connection) {
  die('Could not connect: ' . mysqli_error($connection));
}

mysqli_select_db($connection,"ajax_demo");

$query1="SELECT barcode1, barcode2, name1, name2, COUNT(barcode1) as c
FROM (SELECT c1.Barcode as barcode1, c2.Barcode as barcode2, c1.DateTime as dt, c1.Card_id as card, p1.Product_name as name1, p2.Product_name as name2 
FROM Contains as c1, Contains as c2, Product as p1, Product as p2 
WHERE p1.Barcode=c1.Barcode AND p2.Barcode=c2.Barcode AND c1.Card_id=c2.Card_id AND c1.DateTime=c2.DateTime AND c1.Barcode<c2.Barcode) as pairs
GROUP BY barcode1, barcode2
ORDER BY c DESC";
$r=mysqli_query($connection, $query1);

echo"<h2>Most Popular Pair of Products Bought by Customers:</h2>";

echo "<table>";
echo "<tr>";
//echo '<th colspan="4"; style="text-align:center;">' .'Most Popular Pair of Products Bought by Customers' . '</th>';
echo "</tr>";
echo "<tr>";
echo '<th style="text-align:center;">' .'1st Product: Name' . '</th>';
echo '<th style="text-align:center;">' .'1st Product: Barcode' . '</th>';
echo '<th style="text-align:center;">'.'2nd Product: Name'. '</th>';
echo '<th style="text-align:center;">' . '2nd Product: Barcode' . '</th>';
echo "</tr>";
$N=10;
while ($N>0)
{
  $row=mysqli_fetch_array($r);
  echo "<tr>";
  echo "<td>" . $row['name1'] . "</td>";
  echo "<td>" . $row['barcode1'] . "</td>";
  echo "<td>" . $row['name2'] . "</td>";
  echo "<td>" . $row['barcode2'] . "</td>";
  echo "</tr>";
  $N--;
}

echo "</table>";

$query2="SELECT  y.category as categoryname, concat(round((x.arithm/y.paronom * 100),2),'%') as percentage
FROM ((SELECT Product.Category_name as category, sum(Contains.Pieces) as paronom
     FROM Contains
     LEFT JOIN Product
     ON Contains.Barcode=Product.Barcode
     GROUP BY Product.Category_name) as y
     INNER JOIN
     (SELECT Product.Category_name as category1, sum(Contains.Pieces) as arithm
     FROM Contains
     LEFT JOIN Product
     ON Contains.Barcode=Product.Barcode
     WHERE Product.Brand_name='yes'
     GROUP BY Product.Category_name) as x
     ON x.category1=y.category)
GROUP BY category
ORDER BY percentage";
$r=mysqli_query($connection, $query2);

echo"<h2>Percentage per Product Category that Customers Trust Products with our Store Brand Name:</h2>";

echo "<table>";
echo "<tr>";
//echo '<th colspan="2"; style="text-align:center;">' .'Percentage per Product Category
//that Customers Trust Products with our Store Brand Name' . '</th>';
echo "</tr>";
echo "<tr>";
echo '<th style="text-align:center;">' .'Category' . '</th>';
echo '<th style="text-align:center;">' .'Percentage' . '</th>';
echo "</tr>";

while ($row=mysqli_fetch_array($r))
{
  echo "<tr>";
  echo "<td>" . $row['categoryname'] . "</td>";
  echo "<td>" . $row['percentage'] . "</td>";
  echo "</tr>";
}
echo "</table>";

mysqli_close($connection);

?>

</body>
</html> 
