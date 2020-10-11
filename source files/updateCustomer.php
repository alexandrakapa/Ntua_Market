<?php
$Card_id=$_POST['Card_id'];
$City=$_POST['City'];
$Street=$_POST['Street'];
$Number=$_POST['Number'];
$Postal_code=$_POST['Postal_code'];
$Family_members=$_POST['Family_members'];
$Pets=$_POST['Pets'];
$Phone_number=$_POST['Phone_number'];
$E_mail=$_POST['E_mail'];
$Points=$_POST['Points'];
$dbconnect=mysqli_connect('localhost','root','fresdr7l389','database');
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
if ($Pets!="")
{
$sql .= "update Customer set Pets='$Pets' where Card_id=$Card_id;";
}
if ($Family_members!="")
{
$sql .= "update Customer set Family_members='$Family_members' where Card_id=$Card_id;";
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
if ($E_mail!="")
{
$sql .= "update E_mail set E_mail='$E_mail' where Card_id=$Card_id;";
}
if ($Phone_number!="")
{
$sql .= "update Phone_C set Phone_number='$Phone_number' where Card_id=$Card_id;";
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
