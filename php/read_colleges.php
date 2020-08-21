<?php
include 'database.php';
$sql="select * from colleges";
$result=mysqli_query($db,$sql);
for($i=0;$i<mysqli_num_rows($result);$i++){
    if($i>0)echo "\n";
    $data=mysqli_fetch_assoc($result);
    echo $data['id'].",".$data['name'];
}
mysqli_close($db);
?>