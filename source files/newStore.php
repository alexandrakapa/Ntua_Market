<?php
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

$sql = "insert into Store(Operating_hours,Postal_code,Street,City,Number,Size) values ('$Operating_hours','$Postal_code','$Street','$City','$Number','$Size');";
$sql .= "insert into Phone_S(Store_id,Phone_number) values ('$Store_id','$Phone_number')";
$run =  mysqli_multi_query($dbconnect,$sql);
if ($run==TRUE) {
Redirect('storeReady.jsp',false);
}
else
{
Redirect('storeWrong.jsp',false);
}

?>
