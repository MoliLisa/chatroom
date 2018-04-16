<?php
	ob_start();
	session_start();
	include_once 'dbconnect.php';
    $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
	$name = $userRow['userName'];

		$face = $_POST['face'];
		$systemPic = $_POST['systemPic'];
		if ($systemPic == 'true') {
			$query = "UPDATE users SET userPic = '$face' WHERE userName = '$name'";
		} else {
			$src = "img/".$name.".gif";
			file_put_contents($src, base64_decode(explode(',', $face)[1])) ; 
			// rename($face,$src);
			echo $src;
			$query = "UPDATE users SET userPic = '$src' WHERE userName = '$name'";
		}
		$res = mysql_query($query);
 		unset($face);

 ob_end_flush();
?>