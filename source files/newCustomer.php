<?php
$Card_id=$_POST['Card_id'];
$Name=$_POST['Name'];
$Last_name=$_POST['Last_name'];
$Date_of_birth=$_POST['Date_of_birth'];
$City=$_POST['City'];
$Street=$_POST['Street'];
$Number=$_POST['Number'];
$Postal_code=$_POST['Postal_code'];
$Family_members=$_POST['Family_members'];
$Pets=$_POST['Pets'];
$Phone_number=$_POST['Phone_number'];
$E_mail=$_POST['E_mail'];
$dbconnect=mysqli_connect('localhost','root','fresdr7l389','database');
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
if ($Pets=="" and $Family_members=="")
{
$sql = "insert into Customer(Card_id,Name,Last_name,Date_of_birth,City,Postal_code,Number,Street) values ('$Card_id','$Name','$Last_name','$Date_of_birth','$City','$Postal_code','$Number','$Street');";
}
elseif ($Pets=="")
{
$sql = "insert into Customer(Card_id,Name,Last_name,Date_of_birth,City,Postal_code,Number,Street,Family_members) values ('$Card_id','$Name','$Last_name','$Date_of_birth','$City','$Postal_code','$Number','$Street','$Family_members');";
}
elseif ($Family_members=="")
{
$sql = "insert into Customer(Card_id,Name,Last_name,Date_of_birth,City,Postal_code,Number,Street,Pets) values ('$Card_id','$Name','$Last_name','$Date_of_birth','$City','$Postal_code','$Number','$Street','$Pets');";
}
else
{
$sql = "insert into Customer(Card_id,Name,Last_name,Date_of_birth,City,Postal_code,Number,Street,Family_members,Pets) values ('$Card_id','$Name','$Last_name','$Date_of_birth','$City','$Postal_code','$Number','$Street','$Family_members','$Pets');";
}
$sql .= "insert into E_mail(E_mail,Card_id) values ('$E_mail','$Card_id');";
$sql .= "insert into Phone_C(Card_id,Phone_number) values ('$Card_id','$Phone_number')";
$run =  mysqli_multi_query($dbconnect,$sql);
if ($run==TRUE) {
Redirect('customerReady.jsp',false);
}
else
{
Redirect('customerWrong.jsp',false);
}

?>
