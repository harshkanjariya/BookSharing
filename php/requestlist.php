<?php
include 'database.php';
$pid=$_POST['pid']; //doner
//echo $pid;
$cuki=$_COOKIE['key1'];
$cuki=explode(",",$cuki); //$cuki[1] =clg name
$sql = "select Sender_erno from ait_productStatus where p_id='$pid'";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $donerErno =$row["Sender_erno"];
        $sql="create table if not exists ".$cuki[1]."_requestList (s_er varchar(30),r_er varchar(40),p_id varchar(50))";
				mysqli_query($db,$sql);
				$sql="insert into ".$cuki[1]."_requestList values('".$donerErno."','".$cuki[0]."','".$pid."')";
				if(mysqli_query($db,$sql)){
				    echo "success";
				}else{
				     mysqli_error($db);
				}


    }
} else {
    echo "0 results";
}
mysqli_close($db);
?>