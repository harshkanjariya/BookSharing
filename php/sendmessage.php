<?php
$f=$_POST['f'];
$m=$_POST['m'];

$file=fopen("../chats/".$f,'a');
fwrite($file,$m."\n");
fclose($file);
echo "sent";
?>