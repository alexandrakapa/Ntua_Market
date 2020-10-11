<?php
$Store_id=$_POST['Store_id'];
$Operating_hours=$_POST['Operating_hours'];
$Postal_code=$_POST['Postal_code'];
$Street=$_POST['Street'];
$Number=$_POST['Number'];
$City=$_POST['City'];
$Size=$_POST['Size'];
$Phone_number=$_POST['Phone_number'];
$dbconnect=mysqli_connect('localhost','root','fresdr7l389','database');
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

if ($Operating_hours!="")
{
$sql .= "update Store set Operating_hours='$Operating_hours' where Store_id=$Store_id;";
}
if ($Size!="")
{
$sql .= "update Store set Size='$Size' where Store_id=$Store_id;";
}
if ($City!="")
{
$sql .= "update Customer set City='$City' where Card_id=$Card_id;";
}
if ($Street!="")
{
$sql .= "update Customer set Street='$Street' where Card_id=$Card_id;";
}
if ($Number!="")
{
$sql .= "update Customer set Number='$Number' where Card_id=$Card_id;";
}
if ($Postal_code!="")
{
$sql .= "update Customer set Postal_code='$Postal_code' where Card_id=$Card_id;";
}
if ($Phone_number!="")
{
$sql .= "update Phone_S set Phone_number='$Phone_number' where Store_id=$Store_id;";
}

$run =  mysqli_multi_query($dbconnect,$sql);
if ($run==TRUE) {
Redirect('customer_updateReady.jsp',false);
}
else
{
Redirect('customer_updateWrong.jsp',false);
}
?>
