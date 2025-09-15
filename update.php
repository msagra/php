<?php
include("dbconnect.php");
$id=intval($_GET['updateid']);
$sql="select *from reg where id=$id";
$result=mysqli_query($conn,$sql);
$rows=mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];

	
	$sql="update reg set name='$name',email='$email',phone='$phone',address='$address' where id='$id'";
	$result=mysqli_query($conn,$sql);

	if($result){
		header('location:index.php');
	}
	else{
		die(mysqli_error($conn));
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
</head>

<body>
    <form method="POST">
        <label>Name:</label><input type="text" name="name" id="name" placeholder="<?php echo $rows['name'];?>">
        <label>email:</label><input type="text" name="email" id="email" value="<?php echo $rows['email'];?>">
        <label>phone:</label><input type="text" name="phone" id="phone" value="<?php echo $rows['phone'];?>">
        <label>address:</label><input type="text" name="address" id="address" value="<?php echo $rows['address'];?>">
       <!--  password:<input type="text" name="password" id="password">
        cpassword:<input type="text" name="cpassword" id="cpassword"> -->

        <button type="submit" name="submit">submit</button>
    </form>

</body>

</html>