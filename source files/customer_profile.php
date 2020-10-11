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
  text-align: center;
}
img {
margin-top:10px;
margin-left:1550px;
margin-bottom:0px;
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
form {
margin-top:20px;
margin-left:800px;
margin-bottom:40px;
}
h2 {
margin-bottom:20px;
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

<title>Customer's profile</title>
<h1>Customer's profile</h1>

<?php
$Card_id=$_POST['Card_id'];
$con = mysqli_connect('localhost','root','fresdr7l389','database');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}
//$Card_id='10023';
mysqli_select_db($con,"ajax_demo");
echo"<h2>Personal info:</h2>";

$sql="SELECT * FROM Customer WHERE Card_id='$Card_id'";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>First name</th>
<th>Last name</th>
<th>Card id</th>
<th>Date_of_birth</th>
<th>Street</th>
<th>Number</th>
<th>Postal_code</th>
<th>City</th>
<th>Pets</th>
<th>Points</th>
<th>Family members</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['Last_name'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Card_id'] . "</td>";
  echo "<td>" . $row['Date_of_birth'] . "</td>";
  echo "<td>" . $row['Street'] . "</td>";
  echo "<td>" . $row['Number'] . "</td>";
  echo "<td>" . $row['Postal_code'] . "</td>";
  echo "<td>" . $row['City'] . "</td>";
  echo "<td>" . $row['Pets'] . "</td>";
  echo "<td>" . $row['Points'] . "</td>";
  echo "<td>" . $row['Family_members'] . "</td>";
  echo "</tr>";
}
echo "</table>";


$sql="SELECT Phone_number FROM Phone_C where Card_id='$Card_id'";
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


$sql="SELECT E_mail FROM E_mail where Card_id='$Card_id'";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>E_mail(s)</th>
</tr>";
while($row = mysqli_fetch_array($result)) 
{
echo "<tr>";
echo "<td>" . $row['E_mail'] . "</td>";
echo "</tr>";
}
echo "</table>";


echo"<h2>The stores this customer has visited:</h2>";

$sql="SELECT DISTINCT(S.Store_id),Street,Number,City,Postal_code FROM Store as S,Transaction as T WHERE S.Store_id=T.Store_id and T.Card_id='$Card_id' ORDER BY Store_id";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Store id</th>
<th>Street</th>
<th>Number</th>
<th>City</th>
<th>Postal code</th>

</tr>";
while($row = mysqli_fetch_array($result)) {
  
echo "<tr>";
  echo "<td>" . $row['Store_id'] . "</td>";
  echo "<td>" . $row['Street'] . "</td>";
  echo "<td>" . $row['Number'] . "</td>";
  echo "<td>" . $row['City'] . "</td>";
  echo "<td>" . $row['Postal_code'] . "</td>";
  echo "</tr>";
}
echo "</table>";


echo"<h2>The number of stores this customer has visited:</h2>";

$sql="SELECT COUNT(DISTINCT(S.Store_id)) FROM Store as S,Transaction as T WHERE S.Store_id=T.Store_id and T.Card_id=$Card_id";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Number of stores this customer visits</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  
echo "<tr>";
  echo "<td>" . $row['COUNT(DISTINCT(S.Store_id))'] . "</td>";
}
echo "</table>";


echo"<h2>The 10 most famous products he has bought:</h2>";

$sql="SELECT Barcode, Count(*) as SUM FROM Contains WHERE Card_id=$Card_id GROUP BY Barcode ORDER BY SUM DESC LIMIT 10";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Barcode</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  
echo "<tr>";
  echo "<td>" . $row['Barcode'] . "</td>";
}
echo "</table>";


echo"<h2>The transactions this customer has made:</h2>";

$sql="SELECT Store_id,DateTime,MONTHNAME(DateTime),WEEK(DateTime),Total_amount FROM Transaction WHERE Card_id='$Card_id'ORDER BY DateTime ASC";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Store id</th>
<th>DateTime</th>
<th>Month</th>
<th>Week</th>
<th>Total amount</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  
echo "<tr>";
  echo "<td>" . $row['Store_id'] . "</td>";
  echo "<td>" . $row['DateTime'] . "</td>";
  echo "<td>" . $row['MONTHNAME(DateTime)'] . "</td>";
  echo "<td>" . $row['WEEK(DateTime)'] . "</td>";
  echo "<td>" . $row['Total_amount'] . "</td>";
  echo "</tr>";
}
echo "</table>";


echo"<h2>The average number of amount in transactions/week:</h2>";

$sql="SELECT YEAR(DateTime),WEEK(DateTime),AVG(Total_amount) FROM Transaction WHERE Card_id=$Card_id GROUP BY YEAR(DateTime),WEEK(DateTime)";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Year</th>
<th>Week</th>
<th>Average amount</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  
echo "<tr>";
  echo "<td>" . $row['YEAR(DateTime)'] . "</td>";
  echo "<td>" . $row['WEEK(DateTime)'] . "</td>";
  echo "<td>" . $row['AVG(Total_amount)'] . "</td>";
}
echo "</table>";

echo"<h2>The average number of amount in transactions/month:</h2>";

$sql="SELECT YEAR(DateTime),MONTHNAME(DateTime),AVG(Total_amount) FROM Transaction WHERE Card_id=$Card_id GROUP BY MONTHNAME(DateTime),YEAR(DateTime)";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>Year</th>
<th>Month</th>
<th>Average amount</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  
echo "<tr>";
  echo "<td>" . $row['YEAR(DateTime)'] . "</td>";
  echo "<td>" . $row['MONTHNAME(DateTime)'] . "</td>";
  echo "<td>" . $row['AVG(Total_amount)'] . "</td>";
}
echo "</table>";

echo"<h2>The hour(s) the customer shops from a specific store:</h2>";
?>


<form>
    <select name="users" onchange="showStore(this.value)">
        <option value="">--Select the store's name--</option>
        <option value="1">Store 1</option>
        <option value="2">Store 2</option>
	<option value="3">Store 3</option>
        <option value="4">Store 4</option>
	<option value="5">Store 5</option>
        <option value="6">Store 6</option>
        <option value="7">Store 7</option>
        <option value="8">Store 8</option>
	<option value="9">Store 9</option>
        <option value="10">Store 10</option>
    </select>
</form>
<div id="txtHint"><b>Person info will be listed here...</b></div>

<form action="removeCustomer.php" method="get">
<button type="submit" name="Card_id" value="<?php echo $Card_id;?>">Remove Customer</button>
</form>

<script>
function showStore(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","getStore.php?a="+"<?php echo $Card_id;?>"+"&q="+str,true);
    xmlhttp.send();
  }
}
</script>



</body>
</html> 

