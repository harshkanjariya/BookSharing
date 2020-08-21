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
require('../../../harsh.netwebdevelopers.com/PHPMailer/src/PHPMailer.php');
require('../../../harsh.netwebdevelopers.com/PHPMailer/src/Exception.php');
require('../../../harsh.netwebdevelopers.com/PHPMailer/src/SMTP.php');

$email=$_POST['email'];
$name=$_POST['name'];

$mail=new PHPMailer\PHPMailer\PHPMailer();
if(!$mail->validateAddress($email)){
	echo 'Invalid Email Address';
    return;
}
$email_body = "<html><body>Hello, ".$name."<br/>";
$email_body .="Your Otp : ".$otp."</body></html>";
$mail->IsSMTP();
// $mail->SMTPDebug = 2;
$mail->SMTPAuth = true;
// $mail->Authtype='LOGIN';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->Username = "netweb.developers.official@gmail.com";
$mail->Password = "wearegeekcoders_@";
$mail->setFrom("account@netwebdevelopers.com","Netweb Developers");
$mail->AddReplyTo("harshgkanjariya2468@gmail.com","Harsh Kanjariya");
$mail->addAddress($email,$name);
$mail->isHTML(true);
$mail->Subject = 'Otp';
$mail->Body = $email_body;
if(!$mail->send()) {
    echo 'Message could not be sent. ';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    return;
}else
    echo "sent\n".$otp;
// $to = $_POST['to'];
// $subject  = "otp";
// $txt  = "Your otp is : ".$otp;
// $From = $_POST['from'];
// $headers = "From: ".$From. "\r\n";
// mail($to,$subject,$txt,$headers);
// echo "success\n".$otp;
?>
