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
margin-left:860px;
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
  <a href="customer.php">Customers   </a>
  <a href="products.php">Products</a>
</div>
<img src="logo.png" width="250" height="130">
<title>Stores</title>
<h1>Stores</h1>
<h2>In order to search for a specific store please select a valid Store id from below</h2>
<form action="store_profile.php" method="post">
<div class='container'>
<div class='Input'>
<td>Store id:</td>
<input type="text" name="Store_id" class='Input-text' placeholder="Store_id belongs to [1,10]">
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
$sql="SELECT Street,Number,City, Operating_hours,Store_id FROM Store ORDER BY Store_id ASC";
$result = mysqli_query($con,$sql);


echo "<table>
<tr>
<th>Street</th>
<th>Number</th>
<th>City</th>
<th>Operating Hours</th>
<th>Store_id</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['Street'] . "</td>";
  echo "<td>" . $row['Number'] . "</td>";
  echo "<td>" . $row['City'] . "</td>";
  echo "<td>" . $row['Operating_hours'] . "</td>";
  echo "<td>" . $row['Store_id'] . "</td>";
  echo "</tr>";
}

echo "</table>";

echo"<h2>Most popular store per city:</h2>";
?>


<script>
function showCity(str) {
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
    
    xmlhttp.open("GET","getCity.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>

<form>
    <select name="users" onchange="showCity(this.value)">
        <option value="">--Select city--</option>
        <option value="Athens">Athens</option>
        <option value="Patra">Patra</option>
        <option value="Thessaloniki">Thessaloniki</option>
    </select>
</form>
<div id="txtHint"><b></b></div>

<form action="createStore.html">
<button type="submit">Create Store</button>
</form>

</body>
</html> 
