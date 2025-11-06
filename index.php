<?php
include('dbconnect.php');
$sql="select * from reg";
$result=mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>

<body>

<button><a href="registration.php">add users</a></button>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>phone</th>
            <th>address</th>

        </tr>
            <?php while($rows=mysqli_fetch_assoc($result)){?>
            <tr>
                <td><?php echo $rows['id'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['email'];?></td>
                <td><?php echo $rows['phone'];?></td>
                <td><?php echo $rows['address'];?></td>
                <td><button><a href="update.php?updateid=<?php echo $rows['id']; ?>">update</a></button>
                <button><a href="delete.php?deleteid=<?php echo $rows['id']; ?>">delete</a></button></td>
                      
            </tr>
        <?php };?>
    </table>

</body>

</html>