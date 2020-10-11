<?php
$Barcode=$_POST['Current_Barcode'];
$NewPrice=$_POST['NewPrice'];

$dbconnect=mysqli_connect('localhost','root','fresdr7l389','database');

function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

$qry = "select * from product where Barcode='$Barcode';";
$HelpQuery = mysqli_query($dbconnect, $qry);
$row = mysqli_fetch_array($HelpQuery);
$PreviousPrice=$row['Price'];

$qry1 = "select * from History where (Barcode='$Barcode' AND End_date IS NULL);";
$HelpQuery1 = mysqli_query($dbconnect, $qry1);
$row = mysqli_fetch_array($HelpQuery1);
$StartDate=$row['Start_date'];

if ($row['Barcode']!=$Barcode) { Redirect('WrongBarcode.jsp',false); }

else
{
if ($PreviousPrice==$NewPrice) { Redirect('SamePrice.jsp',false); }

if ($NewPrice!="")
{
	if ($StartDate == date("Y-m-d"))
	{
		$q = "update Product set Price='$NewPrice' where Barcode='$Barcode';";
		$q .= "update History set Price=$NewPrice where (Barcode='$Barcode' AND Start_date='".date("Y-m-d")."');";
	}
	else 
	{
		$q = "update Product set Price='$NewPrice' where Barcode='$Barcode';";
		$q .= "update History set End_date='".date("Y-m-d")."' where (Barcode='$Barcode' AND End_date IS NULL);";
		$q .= "insert into History(Start_date, End_date, Price, Barcode) values ('".date("Y-m-d")."', NULL,'$NewPrice','$Barcode')";
	}

	$run =  mysqli_multi_query($dbconnect,$q);

	if ($run==TRUE) 
	{
		Redirect('ProductUpdated.jsp',false);
	}
	else
	{
		Redirect('ProductUpdatedWrong.jsp',false);
	}
}
}
?>