<?php
$work=$_POST['work'];
include('database.php');
$cuki=$_COOKIE['key1'];
$cuki=explode(",",$cuki); //$cuki[1] =clg name

if($work=="readBooks"){
    $sql="select * from ".$cuki[1]."_productStatus apsx,ait_product apx where apsx.Sender_erno!='$cuki[0]' and apsx.p_id=apx.cp_id";
    //$sql="select * from ".$cuki[1]."_product ";
      $result=mysqli_query($db,$sql);
      if (mysqli_num_rows($result) > 0) {
        $all=array();
        while($row = mysqli_fetch_assoc($result)) {
        $ar=array('cpid'=>$row['cp_id'],'cpname'=>$row['cp_name'] ,'cpdis'=>$row['cp_dis'],'cpau'=>$row['cp_au'],'cpaddi'=>$row['cp_addi'],'cpsc'=>$row['cp_sc']);
          array_push($all,$ar);
        }
        echo json_encode($all);
    }else echo "";
}
if($work=="productStatus"){
    $sql="select * from ".$cuki[1]."_productStatus where Sender_erno='$cuki[0]'";
      $result=mysqli_query($db,$sql);
      if (mysqli_num_rows($result) > 0) {
        $all=array();
        while($row = mysqli_fetch_assoc($result)) {
        $ar=array('pid'=>$row['p_id'],'serno'=>$row['Sender_erno'] ,'reerno'=>$row['Reciver_erno'],'date'=>$row['date']);
          array_push($all,$ar);
        }
        echo json_encode($all);
    }else echo "";
}
if($work=="srachfindBook"){
  $src=$_POST['src'];
      $sql="select * from ".$cuki[1]."_productStatus  apsx,ait_product apx  where (apsx.Sender_erno!='$cuki[0]' and apsx.p_id=apx.cp_id ) and (apx.cp_id LIKE '%".$src."%' OR apx.cp_name LIKE '%".$src."%' OR apx.cp_dis LIKE '%".$src."%' OR apx.cp_au LIKE '%".$src."%' OR apx.cp_addi LIKE '%".$src."%'  OR apx.cp_sc LIKE '%".$src."%')"; 
      $result=mysqli_query($db,$sql);
      if (mysqli_num_rows($result) > 0) {
        $all=array();
        while($row = mysqli_fetch_assoc($result)) {
        $ar=array('cpid'=>$row['cp_id'],'cpname'=>$row['cp_name'] ,'cpdis'=>$row['cp_dis'],'cpau'=>$row['cp_au'],'cpaddi'=>$row['cp_addi'],'cpsc'=>$row['cp_sc']);
          array_push($all,$ar);
        }
        echo json_encode($all);
    }else echo "";
}
if($work=="notification"){
    $sql="select * from ".$cuki[1]."_requestList where s_er='$cuki[0]'";
      $result=mysqli_query($db,$sql);
      if (mysqli_num_rows($result) > 0) {
        $all=array();
        while($row = mysqli_fetch_assoc($result)) {
        $ar=array('ser'=>$row['s_er'],'rer'=>$row['r_er'] ,'pid'=>$row['p_id']);
          array_push($all,$ar);
        }
        echo json_encode($all);
    }else echo "";
}
?>