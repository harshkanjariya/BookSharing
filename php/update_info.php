<?php
include 'database.php';
$clgid=$_POST['clg'];
$enroll=$_POST['enroll'];
$fn=$_POST['first'];
$ln=$_POST['last'];
$gender=substr($_POST['gender'],0,1);
$em=$_POST['email'];
$pass=$_POST['pass'];
$sql="update ".$clgid."_users set enroll='".$enroll."',first_name='".$fn."',last_name='".$ln."',gender='".$gender."',email='".$em."',password='".$pass."' where enroll='".$enroll."'";
if(mysqli_query($db,$sql)){
    echo "success";
}else{
    echo mysqli_error($db);
}
mysqli_close($db);
//update iu_users set password="abc" where year=3;
// create table colleges(id varchar(5) primary key,name varchar(100));
// create table if not exists ".$clgid."_users(enroll varchar(15),department varchar(30),type varchar(1),year int,first_name varchar(20),last_name varchar(20),gender varchar(1),email varchar(50),password varchar(20))
?>