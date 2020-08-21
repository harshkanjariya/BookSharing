<?php
include('database.php');
$cuki=$_COOKIE['key1'];
$cuki=explode(",",$cuki); //$cuki[1] =clg name
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<title>chats</title>
	<style type="text/css">
		.frndname{
			background-color: red;
			margin: 5px;
		}
	</style>
</head>
<body>
  	<div id="frndlist"></div>
  	<form method="post" action="chat.php">
  		<input type="hidden" name="fnm">
  		<input type="hidden" name="b">
  		<input type="hidden" name="m">
  	</form>
  	<script type="text/javascript">
	  	var frnds=[];
	  	<?php
		  	$result=mysqli_query($db,"select * from ".$cuki[1]."_requestList where r_er='".$cuki[0]."'");
		  	for ($i = 0; $i<mysqli_num_rows($result); $i++) {
		  		$data=mysqli_fetch_array($result);
		  		echo "frnds.push({f:'".$data['s_er']."',m:'".$data['r_er']."',p:'".$data['p_id']."'});";
		  	}
	  	?>
		  	console.log(frnds);
	  	var str='';
	  	console.log(frnds);
	  	for (var i = 0; i < frnds.length; i++){
	  		str+='<div class="frndname" onclick="startchat(\''+frnds[i].f+'\',\''+frnds[i].p+'\',\''+frnds[i].m+'\')">Person '+(i+1)+'</div>';
	  	}
	  	var form=document.forms[0];
	  	function startchat(f,p,m){
	  		form.fnm.value=f;
	  		form.b.value=p;
	  		form.m.value=m;
	  		form.submit();
	  	}
	  	$('#frndlist').html(str);
  	</script>
</body>
</html>