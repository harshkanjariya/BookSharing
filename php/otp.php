<?php
function getName($n) { 
    // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters='0123456789';
    $randomString = ''; 
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    }
    return $randomString; 
}
$otp=getName(6);
$to = $_POST['to'];
$subject  = "otp";
$txt  = "Your otp is : ".$otp;
$From = $_POST['from'];
$headers = "From: ".$From. "\r\n";
mail($to,$subject,$txt,$headers);
echo "success\n".$otp;
?>
