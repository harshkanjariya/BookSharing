<?php
include 'database.php';
$clg=$_POST['clg'];
$id=$_POST['id'];
$pass=$_POST['pass'];
$sql="select * from ".$clg."_users where enroll='$id' or email='$id' and password='$pass'";
$result=mysqli_query($db,$sql);
if(mysqli_num_rows($result)==1){
    echo "success";
}else if(mysqli_num_rows($result)==0)
    echo "wrong username or password!";
else{
    echo mysqli_error($db);
}
mysqli_close($db);
?>