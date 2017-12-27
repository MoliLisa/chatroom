<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Welcome - <?php echo $userRow['userName']; ?></title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
 <script src="scripts/jquery-1.3.1.js" type="text/javascript"></script>
 <script src="scripts/chatroom.js" type="text/javascript"></script>
 <script src="scripts/profile.js" type="text/javascript"></script>
<script src="scripts/jquerysession.js" type="text/javascript"></script>
 <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/iscroll-zoom.js"></script>
<script src="js/hammer.js"></script>
<script src="js/lrz.all.bundle.js"></script>
<script src="js/jquery.photoClip.js"></script>
<script src="js/moment.min.js"></script>
</head>
<body>
<div id="profile">
	<img id="profilePic" src="<?php echo $userRow['userPic']; ?>">
	<span class="glyphicon glyphicon-user"></span>&nbsp;Hi, <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span>
	<a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>
	<div id="profileWrapper">
		<div id="info1">系统头像</div>
		<div id="face">
			<input type="radio" name="face" value="face1.gif" style="display: none"><div id="faceBorder"><img src="img/face2.gif" class=""></div>
			<input type="radio" name="face" value="face2.gif" style="display: none"><div id="faceBorder"><img src="img/face2.gif" class=""></div>
			<input type="radio" name="face" value="face3.gif" style="display: none"><div id="faceBorder"><img src="img/face3.gif" class=""></div>
			<input type="radio" name="face" value="face4.gif" style="display: none"><div id="faceBorder"><img src="img/face4.gif" class=""></div>
			<input type="radio" name="face" value="face5.gif" style="display: none"><div id="faceBorder"><img src="img/face5.gif" class=""></div>
			<input type="radio" name="face" value="face6.gif" style="display: none"><div id="faceBorder"><img src="img/face6.gif" class=""></div>
			<input type="radio" name="face" value="face7.gif" style="display: none"><div id="faceBorder"><img src="img/face7.gif" class=""></div>
			<input type="radio" name="face" value="face8.gif" style="display: none"><div id="faceBorder"><img src="img/face8.gif" class=""></div>
		</div>	
		<div id="info2" class="info2Temp">自定义头像...</div>
		<input type="file" id="file" >
	</div>
	<div id="photoclipWapper" >	
		<div id="clipArea"></div>
		<div id="clipBtns">
			<button class="clipBtn" id="clipBtnSave">保存</button>
			<button class="clipBtn" id="clipBtnCancel">取消</button>
		</div>
				
	</div>
</div>  
<div id="msgBox">
	<ul class="messagewindow">	
<!--
	<li class="msgMe">
		<div class="times"><span>12月22日 14:56</span></div>	
		<div class="userPic"><img src="img/face3.gif"></div>							 
		<div class="content">							 	
			<div class="author"><a href="javascript:;">lisa</a>:</div>						
			<div class="msgInfo">right</div>								
									 
		</div>
	</li>
-->
		<li class="">
		<div class="userPic"><img src="img/face3.gif"></div>							 
		<div class="content">							 	
<!--			<div class="author"><a href="javascript:;">lisa</a>:</div>								-->
			<div class="msgInfo">right</div>								
			<div class="times"><span>12月22日 14:56</span></div>							 
		</div>
	</li>
	</ul>
	<form class="chatform" action="#">	
		<div>
			<textarea id="msg" class=""></textarea>
		</div>
		<div class="tr">
			<p>
				<input id="sendBtn" type="submit" value="" title="快捷键 Ctrl+Enter" class="">
			</p>
		</div>
	</form>
	<input type="hidden" id="inputAuthor"  value="<?php echo $userRow['userName']; ?>" />
	<input type="hidden" id="inputPic"  value="<?php echo $userRow['userPic']; ?>" />

</div>
	
</body>
</html>
<?php ob_end_flush(); ?>