<?php
include("dbconnect.php");

if(isset($_GET['deleteid'])){
	$id=intval($_GET['deleteid']);
	$sql="delete from reg where id=$id";
	$result=mysqli_query($conn,$sql);
	if($result){
		header('location:index.php');
	}
	else{
		die(mysql_error($conn));
	}
}
?>