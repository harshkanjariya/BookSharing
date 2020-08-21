<?php
date_default_timezone_set('Asia/Kolkata');
$date=date('D M Y H:i:s');
$cuki=$_COOKIE['key1'];
$cuki=explode(",",$cuki); //$cuki[1] =clg name
$pd_name=$_POST['pdname'];
$pd_dis=$_POST['pddis'];
if(isset($_POST['autname']) && isset($_POST['addname']) && isset($_POST['scode'])){
	$authname=$_POST['autname'];
	$addname=$_POST['addname'];
	$scode=$_POST['scode'];
}
else{	
	$authname='NULL';
	$addname='NULL';
	$scode='NULL';
}

$who=$_POST['who'];
$time=1582000000000;
$filename=round(microtime(true) * 1000)-$time;
$newfilename=$who.$filename;
$src = $_FILES['file']['tmp_name'];
$file_size =$_FILES['file']['size'];
//echo $src;
$targ ="../img/".$_FILES['file']['name'];
$temp = explode(".", $_FILES['file']['name']);
$explode=$temp;
$file_ext=strtolower(end($explode));  
$extensions= array("jpeg","jpg","png");
if(in_array($file_ext,$extensions)=== false)
 	$errors[]="extension nooot allowed, please choose a JPEG or PNG file.";
if(empty($errors)==true){
	if ($file_ext=='jpg' || $file_ext=='jpeg')
        $image = imagecreatefromjpeg($src);
    if($file_ext=='png')
		$image = imagecreatefrompng($src);
	$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
	imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
	imagealphablending($bg, TRUE);
	imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
	imagedestroy($image);
	$quality = 100; // 0 = worst / smaller file, 100 = better / bigger file 
	imagejpeg($bg, "../img/".$newfilename.".jpg", $quality);
	imagedestroy($bg);

//	move_uploaded_file($src,"../img/".$newfilename);
}
if(isset($_FILES['file1'])){
	$src1 = $_FILES['file1']['tmp_name'];
	$targ1 ="../img/".$_FILES['file1']['name'];
	$temp1 = explode(".", $_FILES['file1']['name']);
	$explode1=$temp1;
	$file_ext1=strtolower(end($explode1));  
	$extensions1= array("jpeg","jpg","png");
	if(in_array($file_ext1,$extensions1)=== false)
		 $errors1[]="extension not allowed, please choose a JPEG or PNG file...";
	if(empty($errors1)==true){
		$filename1=$filename+1;
	if ($file_ext1=='jpg' || $file_ext1=='jpeg')
        $image = imagecreatefromjpeg($src1);
    if($file_ext1=='png')
		$image = imagecreatefrompng($src1);
	$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
	imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
	imagealphablending($bg, TRUE);
	imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
	imagedestroy($image);
	$quality = 100; // 0 = worst / smaller file, 100 = better / bigger file 
	$newfilename1=$who.$filename1;
	imagejpeg($bg, "../img/".$newfilename1.".jpg", $quality);
	imagedestroy($bg);


//		move_uploaded_file($src1,"../img/".$newfilename1);
	}
	else{
		print_r($errors1);
	}
}
include 'database.php';
$sql = "insert into ".$cuki[1]."_product values('$newfilename','".$pd_name."','".$pd_dis."','".$authname."','".$addname."','".$scode."')" ;
if (mysqli_query($db, $sql)){
		$sql="insert into ".$cuki[1]."_productStatus values('".$newfilename."','".$cuki[0]."','-','".$date."')";
		if (mysqli_query($db, $sql)){
			    echo "New record ted successfully";
		} 
		else if(empty(mysqli_query($db, $sql))){
			$sql="create table if not exists ".$cuki[1]."_productStatus (p_id varchar(30),Sender_erno varchar(40),Reciver_erno varchar(40),date varchar(50))";
			mysqli_query($db,$sql);
			$sql="insert into ".$cuki[1]."_productStatus values('".$newfilename."','".$cuki[0]."','-','".$date."')";
			if(mysqli_query($db,$sql)){
			    echo "success";
			}else{
			     mysqli_error($db);
			}
		}

	    echo "New record ted successfully";
} 
else if(empty(mysqli_query($db, $sql))){
    $query = "create table ".$cuki[1]."_product(cp_id varchar(30),cp_name varchar(30),cp_dis varchar(30),cp_au varchar(30),cp_addi varchar(20),cp_sc varchar(20))";
    $result = mysqli_query($db, $query);
    if($result){
		$sql = "insert into ".$cuki[1]."_product values('$newfilename','".$pd_name."','".$pd_dis."','".$authname."','".$addname."','".$scode."')" ;
		if (mysqli_query($db, $sql)) {
			$sql="insert into ".$cuki[1]."_productStatus values('".$newfilename."','".$cuki[0]."','-','".$date."')";
			if (mysqli_query($db, $sql)){
				    echo "New record ted successfully";
			} 
			else if(empty(mysqli_query($db, $sql))){
				$sql="create table if not exists ".$cuki[1]."_productStatus (p_id varchar(30),Sender_erno varchar(40),Reciver_erno varchar(40),date varchar(50))";
				mysqli_query($db,$sql);
				$sql="insert into ".$cuki[1]."_productStatus values('".$newfilename."','".$cuki[0]."','-','".$date."')";
				if(mysqli_query($db,$sql)){
				    echo "success";
				}else{
				     mysqli_error($db);
				}
			}
			    echo "New record reated successfully";
		}
    }
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}
		
echo $newfilename;
?>