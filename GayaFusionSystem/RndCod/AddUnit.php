<?php
session_start();
include ("../Includes/sql.php");
$page = $_POST['pagename'];
$tabelnya = $_POST['tablename'];
$field1 = $_POST['field1'];
$field2 = $_POST['field2'];
$codescnew = $_POST['codenew'];
$descscnew = $_POST['descnew'];
$codehid = $_POST['codehid'];

if (!$codehid == null){
	$UpdateQuery="UPDATE tblUnit SET 
		tblUnit.UnitID = '$codescnew', 
		tblUnit.UnitValue = '$descscnew' 
		where tblUnit.UnitID = '$codehid';";
	$Update = mysql_query($UpdateQuery);
	if ($Update)
	{
		header("location: $page");
	}else
	{
	//include(
	$sala = mysql_error();
	echo "$sala";
	echo "Failed Edit Data";
	}
}else{ 
	$ceksedia = mysql_query("select $field1 from $tabelnya where $field1 = '$codescnew'");
	$hasilcek = mysql_num_rows($ceksedia);
	$insertquery="insert into $tabelnya ($field1, $field2) value('$codescnew', '$descscnew')";
	If ($hasilcek >= 1){
		echo "<br><br><br><center>Code Already Use.</center><br><br><br>";
		die();
	}else{	
		$insert=mysql_query($insertquery);
	}
	
	if ($insert)
	{
		header("location: $page");
	}else
	{
	//include(
	$sala = mysql_error();
	echo "$sala";
	echo "Failed Add New Data";

	}
}
?>

