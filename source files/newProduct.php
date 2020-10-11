<?php
$Barcode=$_POST['Barcode'];
$Category_name=$_POST['Category_name'];
$Brand_name=$_POST['Brand_name'];
$Price=$_POST['Price'];
$Product_name=$_POST['Product_name'];

$dbconnect=mysqli_connect('localhost','root','fresdr7l389','database');

function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
$q = "insert into product(Barcode, Category_name, Brand_name, Price, Product_name) values ('$Barcode', '$Category_name','$Brand_name','$Price', '$Product_name');";
$q .= "insert into history(Start_date, End_date, Price, Barcode) values ('".date("Y-m-d")."', NULL,'$Price','$Barcode')";
$run =  mysqli_multi_query($dbconnect,$q);

if ($run==TRUE) {
Redirect('ProductInserted.jsp',false);
}
else
{
Redirect('ProductWrong.jsp',false);
}

?>