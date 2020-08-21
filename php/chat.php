<?php
include('database.php');
$cuki=$_COOKIE['key1'];
$cuki=explode(",",$cuki); //$cuki[1] =clg name
$f=$_POST['fnm'];
$m=$_POST['m'];
$b=$_POST['b'];
//echo $m.'m-->'.$f.'f--->'.$cuki[0].'c';
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<title>chats</title>
	<style type="text/css">
		html,body{
			margin:0px;
			margin-left:100px;
			height: 100vh;
			font-family: sans-serif;
			background: url('https://mir-s3-cdn-cf.behance.net/project_modules/disp/aec89173426833.5c08f56351139.png');
		}
		h3{
			font-weight: 1px;
			font-size: 20px;
			margin: 5px;
			display: inline-block;
		}
		#allmessages{
			width: 80vw;
			height: 80vh;
			font-size: 20px;
			overflow-y: auto;
		}
		::-webkit-scrollbar {
		    width: 0px;
		    background: transparent; 
		}
		::-webkit-scrollbar-thumb{
		    background: #FF0000;
		    background: transparent; 
		    display:none;
		}
		#msgform{
			width: 81vw;
			height: 10vh;
		}
		#msgform textarea{
			width: 88%;
			height: 100%;
			border: 0px;
			resize: none;
			padding: 5px;
			font-size: 20px;
		}
		#msgform input[type="submit"]{
			width: 40px;
			height: 40px;
			background: url('https://www.verasport.pl/pub/skin/default-skin/img/icons/send-button.png');
			background-size: 100% 100%;
			background-repeat: no-repeat;
			vertical-align: top;
			margin-top: 12px;
			margin-left: 10px;
			border: 0px;
		}
		#msgform input[type="submit"]:focus{
		    outline:0px;
		}
		.mymsg{
			text-align: right;
			margin: 3px 0px;
		}
		.frndmsg{
			text-align: left;
			margin: 3px 0px;
		}
		.mymsg span{
			background-color: #a0ffa0;
			padding: 10px;
			max-width: 70vw;
			display: inline-block;
			word-wrap: break-word;
			text-align: left;
		}
		.frndmsg span{
			background-color: #3030ff;
			color: white;
			padding: 10px;
			max-width: 70vw;
			display: inline-block;
			word-wrap: break-word;
		}
		@media only screen and (max-width: 475px){
		    #msgform {
                width: 100vw;
            }
            #msgform textarea{
                width:75%;
            }
    		#allmessages{
    		    height: 70vh;
    		}
    		.mymsg span,.frndmsg span{
    			max-width: 60vw
    		}
		}
		@media only screen and (max-height: 475px){
		    #allmessages{
		        height: 55vh;
		    }
    		#msgform input[type="submit"]{
		        margin-top: 0px;
		    }
		}
	</style>
</head>
<body>
  	<h3 id="frndname">Person 1</h3>
	<div id="allmessages">
	</div>
	<form id="msgform" onsubmit="return sendmessage()">
		<textarea name="msg" id="msgtxt" placeholder="Write a Message"></textarea>
		<input type="submit" value="">
	</form>
  	<script type="text/javascript">
	  	var form=document.forms[0];
	  <?php
	  		$fname1=$cuki[0].".".$f.".enc";
	  		$tp=$f.".".$cuki[0].".enc";
	  		if(file_exists("../chats/".$fname1)){
	  			$fname1=$cuki[0].".".$f.".enc";
	  		}
	  		else if (file_exists("../chats/".$tp)) {
	  			$fname1=$f.".".$cuki[0].".enc";
	  		}
	  		else{
	  			$fname1=$cuki[0].".".$f.".enc";
	  		}
	  		if($cuki[0] == $f)
	  			$who='f';
			else $who='s';
	  ?>
	$(function() {
	    $("#msgtxt").keypress(function (e) {
	        if(e.which == 13 && e.shiftKey) {
	            e.preventDefault();
	            sendmessage();
	        }
	    });
	});
	var div=document.getElementById('allmessages'),scrolling=false;
	function sendmessage(){
		var msg=form.msg.value.replace(/(?:\r\n|\r|\n)/g,'\\n');
		$.ajax({
			url:"sendmessage.php",
			data:{
				f:'<?php echo $fname1;?>',
				m:'<?php echo $m;?>'+":"+msg
			},
			type:"POST",
			success:function(result,status){
				console.log(result);
				scrolling=true;
			}
		});
		form.msg.value="";
		return false;
	}
	<?php
	  		$fname1=$cuki[0].".".$f.".enc";
	  		$tp=$f.".".$cuki[0].".enc";
	  		if(file_exists("../chats/".$fname1)){
	  			$fname1=$cuki[0].".".$f.".enc";
	  		}
	  		else if (file_exists("../chats/".$tp)) {
	  			$fname1=$f.".".$cuki[0].".enc";
	  		}
	  		else{
	  			$fname1=$cuki[0].".".$f.".enc";
	  		}
	  ?>
	var first=true,txt="",updatecount=0;
	setInterval(function(){
		$.ajax({
			url:'../chats/<?php echo $fname1;?>',
			type:"POST",
			success:function(result,status){
				if(txt!=result){
					txt=result;
		var all=result.split("\n");
		div.innerHTML="";
		for(var i = 0; i < all.length-1; i++){
			var tmp=all[i].replace(/\\n/g,'<br>');
			var a=tmp;
			var b=a.split(":");
			var er= all[i].substr(0, all[i].indexOf(':')); 
			if(er!=<?php echo $cuki[0]?>){
				div.innerHTML=div.innerHTML+'<div class="frndmsg"><span>'+b[1]+'</span></div>';
			}else if (er==<?php echo $cuki[0]?>){
				div.innerHTML=div.innerHTML+'<div class="mymsg"><span>'+b[1]+'</span></div>';
			}
		}
		scrolling=false;
		$('#allmessages').animate({
            scrollTop: $('#allmessages').prop('scrollHeight')-$('#allmessages').height()
        }, 500);
				}
			}
		});
	},500);
  	</script>
</body>
</html>