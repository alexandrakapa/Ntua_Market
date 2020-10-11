<?php
$Store_id=$_GET["Store_id"];
$dbconnect=mysqli_connect('localhost','root','fresdr7l389','database');
$sql = "delete from Store where Store_id='$Store_id'";
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
Redirect('storeRemove.jsp',false);
}
else
{
echo"not ok";
}



?>
