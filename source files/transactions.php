<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
  margin-top: 5px;
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
</head>
<body>
</body>
</html>
<?php
echo IN;
$q = intval($_GET['q']);     
$a = strval($_GET['a']);     
$c = strval($_GET['c']);    
$ta = strval($_GET['ta']);   
$p = intval($_GET['p']);     
$sd = strval($_GET['sd']);    
$ed = strval($_GET['ed']);    
echo $q;
echo $a;
echo $c;
echo $ta;
$con = mysqli_connect('localhost','root','fresdr7l389','database');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");

echo"<h2>The transactions for this Store are:</h2>";

$sql="SELECT Card_id, DateTime,Total_amount,Payment_method from Transaction where Store_id = ' ".$q."'";
if ($a!="")
{ 
  $sql="select DateTime, Card_id 
        from (".$sql.") as T
        where (DateTime, Card_id) in 
              (select distinct DateTime, Card_id
               from Contains
               where (Barcode) in (select Barcode
                                  from Product
                                  where Category_name = '".$a."'))";
}


if ($c!="")
{
  $sql = "select DateTime, Card_id,Total_amount,Payment_method
   from (".$sql.") as T
   where (DateTime, Card_id,Total_amount,Payment_method) in (select DateTime, Card_id,Total_amount,Payment_method
                                from Transaction
                                where Payment_method = '".$c."')";
}


if ($ta!="")
{
  $sql = "select DateTime, Card_id,Total_amount,Payment_method
   from (".$sql.") as T
   where (DateTime, Card_id,Total_amount,Payment_method) in (select DateTime, Card_id,Total_amount,Payment_method
                                from Transaction
                                where Total_amount = '".$ta."')";
}

if ($p!="")
{
  $sql = "select DateTime, Card_id
   from (".$sql.") as T
   where (DateTime, Card_id) in (select DateTime, Card_id
from(
SELECT DateTime, Card_id, number_items
from (select DateTime, Card_id, sum(Pieces) as number_items
     from Contains
     group by DateTime, Card_id ) as totalitems(DateTime,Card_id,number_items) ) as selectnum(DateTime,Card_id,number_items)
where number_items >= '".$p."')";
}

if ($sd!="")
{
 
  $sql = "select DateTime, Card_id,Total_amount,Payment_method
   from (".$sql.") as T
   where (DateTime, Card_id,Total_amount,Payment_method) in (SELECT DateTime, Card_id,Total_amount,Payment_method
FROM Transaction 
WHERE DateTime >= '".$sd."'
AND DateTime <= '".$ed."')";
}


$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Card_id</th>
<th>Date & Time</th>
<th>Total amount</th>
<th>Payment method</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['Card_id'] . "</td>";
  echo "<td>" . $row['DateTime'] . "</td>";
  echo "<td>" . $row['Total_amount'] . "</td>";
  echo "<td>" . $row['Payment_method'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
