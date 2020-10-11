<!DOCTYPE html>
<html>
<head>
<img src="logo.png" width="250" height="130">

	<title>View Customers</title>
	<h1>View Customers</h1>
	<style>
table {
  width: 70%;
  border-collapse: collapse;
}
th {
  height: 60px;
  background-color: #DEB887;
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
  text-align: center;
  margin-right: auto;
  margin-left: 450px;
  margin-top: 50px;
  margin-bottom:50px;
  border: 1px solid #ddd;
  padding: 10px;
}

tr:hover {background-color: #edebeb;}

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

//mysqli_select_db($connection,"ajax_demo");
$q="SELECT * FROM Customers_List ORDER BY Last_name ASC, Card_id, E_mail";
$result = mysqli_query($connection,$q);

echo "<table>
<tr>
<th style='text-align:center;'>Last name</th>
<th style='text-align:center;'>First name</th>
<th style='text-align:center;'>Card ID</th>
<th style='text-align:center;'>Card Points</th>
<th style='text-align:center;'>Age</th>
<th style='text-align:center;'>Date of Birth</th>
<th style='text-align:center;'>City</th>
<th style='text-align:center;'>Street</th>
<th style='text-align:center;'>Number</th>
<th style='text-align:center;'>Postal Code</th>
<th style='text-align:center;'>Family Members</th>
<th style='text-align:center;'>Pets</th>
<th style='text-align:center;'>E-mails</th>
<th style='text-align:center;'>Phone Numbers</th>
</tr>";

$N=0;
$MultipleEmails=0;
$FirstOfEmails=1;
$row = mysqli_fetch_array($result);

while($row == true )
{
  if ($N==0)
 {
  echo "<tr>";
  echo "<td>" . $row['Last_name'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Card_id'] . "</td>";
  echo "<td>" . $row['Points'] . "</td>";
  echo "<td>" . $row['Age'] . "</td>";
  echo "<td>" . $row['Date_of_birth'] . "</td>";
  echo "<td>" . $row['City'] . "</td>";
  echo "<td>" . $row['Street'] . "</td>";
  echo "<td>" . $row['Number'] . "</td>";
  echo "<td>" . $row['Postal_code'] . "</td>";
  echo "<td>" . $row['Family_members'] . "</td>";
  echo "<td>" . $row['Pets'] . "</td>";
  echo "<td>" . $row['E_mail'] . "</td>";
  echo "<td>" . $row['Phone_number'] . "</td>";
  echo "</tr>";
  $N=1;
  $previousID=$row['Card_id'];
  $previousEmail=$row['E_mail'];
  $row = mysqli_fetch_array($result);
 }
  else 
 {
  if ($previousID == $row['Card_id'])
    $MultipleEmails=1;

  if ($MultipleEmails == 0) 
  {
    echo "<tr>";
    echo "<td>" . $row['Last_name'] . "</td>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['Card_id'] . "</td>";
    echo "<td>" . $row['Points'] . "</td>";
    echo "<td>" . $row['Age'] . "</td>";
    echo "<td>" . $row['Date_of_birth'] . "</td>";
    echo "<td>" . $row['City'] . "</td>";
    echo "<td>" . $row['Street'] . "</td>";
    echo "<td>" . $row['Number'] . "</td>";
    echo "<td>" . $row['Postal_code'] . "</td>";
    echo "<td>" . $row['Family_members'] . "</td>";
    echo "<td>" . $row['Pets'] . "</td>";
    echo "<td>" . $row['E_mail'] . "</td>";
    echo "<td>" . $row['Phone_number'] . "</td>";
    echo "</tr>";
    $previousID=$row['Card_id'];
    $previousEmail=$row['E_mail'];
    $row = mysqli_fetch_array($result);
  }

  else
  {
    while($previousEmail == $row['E_mail'])
     {
       echo "<tr>";
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo "<td>" . $row['Phone_number'] . "</td>";
       echo "</tr>";
       $previousID=$row['Card_id'];
       $previousEmail=$row['E_mail'];
       $row = mysqli_fetch_array($result);
     }
     while($previousID == $row['Card_id'])
     {
      while ($previousEmail == $row['E_mail'])
      {
       $previousID=$row['Card_id'];
       $previousEmail=$row['E_mail'];
       $row = mysqli_fetch_array($result);
      }
      if($previousID == $row['Card_id'])
      {
       echo "<tr>";
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo '<td>&nbsp;</td>';
       echo "<td>" . $row['E_mail'] . "</td>";
       echo '<td>&nbsp;</td>';
       echo "</tr>";
       $previousID=$row['Card_id'];
       $previousEmail=$row['E_mail'];
       $row = mysqli_fetch_array($result);
      }
     }
     
     $MultipleEmails=0;
  }
 }
}

echo "</table>";
$q="SELECT Name";
$result = mysqli_query($connection,$q);
mysqli_close($connection); 
?>
</body>
</html>
