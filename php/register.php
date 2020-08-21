<?php
include 'database.php';
$clgid=$_POST['clg'];
$deptname=$_POST['deptname'];
$type=substr($_POST['type'],0,1);
$enroll=$_POST['enroll'];
$fn=$_POST['fn'];
$ln=$_POST['ln'];
$gender=substr($_POST['gender'],0,1);
$em=$_POST['email'];
$pass=$_POST['pass'];
mysqli_query($db,$sql);
$sql="insert into users values('".$clgid."','a".$enroll."','".$deptname."','".$type.",'".$fn."','".$ln."','".$gender."','".$em."','".$pass."')";
if(mysqli_query($db,$sql)){
    echo "success";
}else{
    echo mysqli_error($db);
}
mysqli_close($db);
// create table colleges(id varchar(20) primary key,name varchar(100));
// create table users(clgid varchar(20),id varchar(15),department varchar(30),type varchar(1),first_name varchar(20),last_name varchar(20),gender varchar(1),email varchar(50),password varchar(20));
?>