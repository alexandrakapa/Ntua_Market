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
img {
margin-top:10px;
margin-left:1550px;
margin-bottom:0px;
}

table, td, th {
  margin-left:450px;
  margin-top: 50px;
  border: 1px solid #ddd;
  padding: 10px;
  margin-bottom:50px;
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
<title>Store's profile</title>
<h1>Store's profile</h1>

<?php
$Store_id=$_POST['Store_id'];
$con = mysqli_connect('localhost','root','fresdr7l389','database');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM Store WHERE Store_id='$Store_id'";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Store_id</th>
<th>Operating Hours</th>
<th>Postal Code</th>
<th>Street</th>
<th>City</th>
<th>Number</th>
<th>Size</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['Store_id'] . "</td>";
  echo "<td>" . $row['Operating_hours'] . "</td>";
  echo "<td>" . $row['Postal_code'] . "</td>";
  echo "<td>" . $row['Street'] . "</td>";
  echo "<td>" . $row['City'] . "</td>";
  echo "<td>" . $row['Number'] . "</td>";
  echo "<td>" . $row['Size'] . "</td>";
  echo "</tr>";
}
echo "</table>";

$sql="SELECT Phone_number FROM Phone_S where Store_id='$Store_id'";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Phone number(s)</th>
</tr>";
while($row = mysqli_fetch_array($result)) 
{
echo "<tr>";
echo "<td>" . $row['Phone_number'] . "</td>";
echo "</tr>";
}
echo "</table>";

echo"<h2>Most popular placements in store:</h2>";

$sql="SELECT Barcode, Alley, Self
FROM Transaction, ( SELECT Contains.Barcode, Alley, Self, Pieces, DateTime, Card_id, Store_id
                   FROM Contains
                   INNER JOIN Offers
                   ON Contains.Barcode = Offers.Barcode) as jointtbl(Barcode,Alley,Self,Pieces,DateTime,Card_id,Store_id)
WHERE (jointtbl.DateTime,jointtbl.Card_id) in (SELECT DateTime,Card_id
                                               FROM Transaction
                                               WHERE Store_id='$Store_id') and jointtbl.Store_id='$Store_id'
GROUP BY Barcode, Alley, Self
ORDER BY SUM(Pieces) DESC
LIMIT 5";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Barcode</th>
<th>Alley</th>
<th>Shelf</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  
echo "<tr>";
  echo "<td>" . $row['Barcode'] . "</td>";
  echo "<td>" . $row['Alley'] . "</td>";
  echo "<td>" . $row['Self'] . "</td>";
  //echo "<td>" . $row['Total_amount'] . "</td>";
  echo "</tr>";
}
echo "</table>";

echo"<h2>This store's most profitable hours:</h2>";

$sql="Select HOUR(DateTime),avg(Total_amount) 
from Transaction
where Store_id='$Store_id'
group by HOUR(DateTime) 
ORDER BY `avg(Total_amount)` DESC
LIMIT 5";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Hour</th>
<th>Total Income</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  
echo "<tr>";
  echo "<td>" . $row['HOUR(DateTime)'] . "</td>";
  echo "<td>" . $row['avg(Total_amount)'] . "</td>";
}
echo "</table>";

echo"<h2>Percentage of age range in every operation hour(in 24-hour format):</h2>";

$sql="SELECT x.hours1, x.Age_Range, concat(round((x.arithm/y.paronom * 100),2),'%') as percentage
FROM
(SELECT CASE
WHEN C.Date_of_birth > ADDDATE(DATE_FORMAT(CURRENT_DATE(), '%Y%m%d'), INTERVAL -20 YEAR) THEN 'Below 20'
WHEN C.Date_of_birth > ADDDATE(DATE_FORMAT(CURRENT_DATE(), '%Y%m%d'), INTERVAL -30 YEAR) THEN '21-30'
WHEN C.Date_of_birth > ADDDATE(DATE_FORMAT(CURRENT_DATE(), '%Y%m%d'), INTERVAL -40 YEAR) THEN '31-40'
WHEN C.Date_of_birth > ADDDATE(DATE_FORMAT(CURRENT_DATE(), '%Y%m%d'), INTERVAL -50 YEAR) THEN '41-50'
WHEN C.Date_of_birth > ADDDATE(DATE_FORMAT(CURRENT_DATE(), '%Y%m%d'), INTERVAL -60 YEAR) THEN '51-60'
WHEN C.Date_of_birth > ADDDATE(DATE_FORMAT(CURRENT_DATE(), '%Y%m%d'), INTERVAL -70 YEAR) THEN '61-70'
ELSE 'Over 71'
END AS Age_Range, Count(DISTINCT(C.Card_id)) as arithm, HOUR(T.DateTime) as hours1
from Customer as C, Transaction as T
where C.Card_id=T.Card_id and T.Store_id='$Store_id'
GROUP BY Age_Range, hours1
ORDER BY arithm) as x
INNER JOIN 
(SELECT Count(DISTINCT(C.Card_id)) as paronom, HOUR(T.DateTime) as hours2
from Customer as C, Transaction as T
where C.Card_id=T.Card_id and T.Store_id='$Store_id'
GROUP BY hours2
ORDER BY paronom) as y
ON x.hours1=y.hours2
ORDER BY x.hours1 ASC,  x.Age_Range, percentage
";

$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Hour</th>
<th>Age range</th>
<th>Percentage</th>
</tr>";
$N=0;
while($row = mysqli_fetch_array($result)) {
  if ($N==0){
    echo "<tr>";
    echo "<td style='background-color:#DEB887;'>" . $row['hours1'] . "</td>";
    echo "<td>" . $row['Age_Range'] . "</td>";
    echo "<td>" . $row['percentage'] . "</td>";
    echo "</tr>";
  }
  else {
    if ($PreviousCategory==$row['hours1'])
    {
      echo "<tr>";
      echo '<td>&nbsp;</td>';
      echo "<td>" . $row['Age_Range'] . "</td>";
      echo "<td>" . $row['percentage'] . "</td>";
      echo "</tr>";
    }
    else 
    {
      echo "<tr>";
      echo "<td style='background-color:#DEB887;'>" . $row['hours1'] . "</td>";
      echo "<td>" . $row['Age_Range'] . "</td>";
      echo "<td>" . $row['percentage'] . "</td>";
      echo "</tr>";
    }
   }
    $PreviousCategory=$row['hours1'];
    $N++;

  }


echo "</table>";


?>
<form action="removeStore.php" method="get">
<button type="submit" name="Store_id" value="<?php echo $Store_id;?>">Remove Store</button>
</form>

<form action="updateStore.html" method="get">
<button type="submit" name="Store_id" value="<?php echo $Store_id;?>">Update Store</button>
</form>
</body>
</html> 
