<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
 <script src="scripts/jquery-1.3.1.js" type="text/javascript"></script>
 <script src="scripts/chatroom.js" type="text/javascript"></script>
<script src="scripts/jquerysession.js" type="text/javascript"></script>
 <!--<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />-->
<!-- <link rel="stylesheet" href="style.css" type="text/css" />-->
	
	
 <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
</head>
<body>
<div style="text-align: right;">
	<span class="glyphicon glyphicon-user"></span>&nbsp;Hi, <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span>
	<a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>
</div> 
         
	<div id="msgBox">
		<ul class="messagewindow"  >	
		</ul>
		<form class="chatform" action="#">	
			<div>
				<input id="author" class="" value="">
				<p id="face"><img src="img/face1.gif" class="current"><img src="img/face2.gif" class=""><img src="img/face3.gif" class=""><img src="img/face4.gif" class=""><img src="img/face5.gif" class=""><img src="img/face6.gif" class=""><img src="img/face7.gif" class=""><img src="img/face8.gif" class=""></p>
			</div>
			<div>
				<textarea id="msg" class=""></textarea>
			</div>
			<div class="tr">
				<p>
					<input id="sendBtn" type="submit" value="" title="快捷键 Ctrl+Enter" class="">
				</p>
			</div>
		</form>
	</div>
	
<input type="hidden" id="inputAuthor"  value="<?php echo $userRow[' ']; ?>" />
    
<!--
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
-->
    
</body>
</html>
<?php ob_end_flush(); ?>