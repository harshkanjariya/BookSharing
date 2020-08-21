<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/nw.css?y=6">
	<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
	<script type="text/javascript" src="js/nw.js"></script>
	<style>
	    .nw-page{
	        top:0!important;
	        height:100vh!important;
	    }
	    @media only screen and (max-width:900px){
    	    .nw-page{
    	        top:50px!important;
    	        height:calc(100vh - 50px)!important;
    	    }
	    }
	    .mobile-menu-toggle{
	        font-size: 5px;
        	color: #27b3c8;
        	cursor: pointer;
        	padding: 5px;
        	width:25px;
        	height:25px;
        	margin-left:12px;
        	border-radius: 5px;
        	display:flex;
        	align-items:center;
        	justify-content:center;
        }
	</style>
</head>
<body>
	<div class="nw-navbar">
		<div class="nw-navbar-header">
			<div class="nw-text">ADMIN</div>
			<div class="nw-toggle"><i class="material-icons">menu</i></div>
		</div>
		<div class="nw-body"> 
			<ul>
                <li><a href="html/Dashboard.html" target="myfrm"><i class="material-icons-outlined">dashboard</i><span>Dashboard</span></a></li>
                
                <li><a href="html/AccountSetting.html" target="myfrm"><i class="material-icons-outlined">settings</i><span>Account Setting</span></a></li>
                
                <!-- <li><a href="html/AddStationary.html" target="myfrm"><i class="material-icons-outlined">
                note_add</i><span>Add stationary</span></a></li> -->
                <li><a class="nw-expandable"><i class="material-icons-outlined">note_add</i><span>Add stationary</span></a>
                    <ul>
                        <li><a href="html/addStationary.html" target="myfrm">Stationary</a></li>
                        <li><a href="html/addBook.html" target="myfrm">Book</a></li>
                    </ul>
                </li>
                <li><a href="html/FindStationary.html" target="myfrm"><i class="material-icons-outlined">find_in_page</i><span>find stationary</span></a></li>
                
                <li><a href="html/historynew.html" target="myfrm"><i class="material-icons-outlined">history</i><span>History</span></a></li>
                
                <li><a href="html/Notifications.html" target="myfrm"><i class="material-icons-outlined">notification_important</i><span>Notification</span></a></li>
                
                <li><a href="html/chat.html" target="myfrm"><i class="material-icons-outlined">message</i><span>Chat</span></a></li>

                <li><a href="html/TopPeoples.html" target="myfrm"><i class="material-icons-outlined">vertical_align_top</i><span>Top Peoples</span></a></li>

			    
			    <li onclick="logout()"><a href="javascript:void(0)"><i class="material-icons-outlined">login</i><span>logout</span></a></li>
			    
			</ul>
		</div>
	</div>
	<div class="nw-header">
	    <div class="mobile-menu-toggle" onclick="toggleMobileNavbar();"><i class="material-icons">menu</i></div>
	</div>
	<div class=nw-page>
        <iframe id="myfrm" src="html/Dashboard.html" name="myfrm" style=""></iframe>
	</div>
</body>
<script>
    function logout(){
        if(confirm('Are you sure for sign out')){
            location.replace('html/login.html');
        }
    }
    <?php
        if(!isset($_COOKIE['key1'])){
            	header('Location:html/login.html');
        }else{
            include 'php/database.php';
            $cuki=$_COOKIE['key1'];
            $cuki=explode(",",$cuki);
            $sql="select * from ".$cuki[1]."_users where enroll='".$cuki[0]."' or email='".$cuki[0]."'";
            $result=mysqli_query($db,$sql);
            $result=mysqli_fetch_assoc($result);
            $sql="select name from colleges where id='".$cuki[1]."'";
            $cnm=mysqli_fetch_assoc(mysqli_query($db,$sql))['name'];
            $result['college']=$cnm;
            $result['cid']=$cuki[1];
            $ar=json_encode($result);
            mysqli_close($db);
            echo "userInfo=JSON.parse('".$ar."');\n";
        }
        ?>
</script>
</html>