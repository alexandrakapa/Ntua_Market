<?php
$Barcode=$_GET["Barcode"];
$dbconnect=mysqli_connect('localhost','root','fresdr7l389','database');
$sql = "delete from Product where Barcode='$Barcode'";
$run =  mysqli_multi_query($dbconnect,$sql);

function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}


if ($run==TRUE) {
Redirect('productRemove.jsp',false);
}
else
{
echo"not ok";
}



?>
