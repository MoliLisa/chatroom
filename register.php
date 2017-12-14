<?php
	ob_start();
	session_start();
	if( isset($_SESSION['user'])!="" ){
		header("Location: home.php");
	}
	include_once 'dbconnect.php';

	$error = false;

	if ( isset($_POST['btn-signup']) ) {
		
		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		$face = $_POST['face'];
	
		// basic name validation
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your full name.";
		} else if (strlen($name) < 3) {
			$error = true;
			$nameError = "Name must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		} else {
			// check name exist or not
			$query = "SELECT userName FROM users WHERE userName='$name'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			if($count!=0){
				$error = true;
				$nameError = "Provided name is already in use.";
			}
		}
	
		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have atleast 6 characters.";
		}
		
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		
		// if there's no error, continue to signup
		if( !$error ) {
			
			$query = "INSERT INTO users(userName,userPass,userPic) VALUES('$name','$password','$face')";
			$res = mysql_query($query);
				
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($pass);
				unset($face);
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";	
			}	
				
		}
		
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage - Login & Registration System</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
	 <script src="scripts/jquery-1.3.1.js" type="text/javascript"></script>
 <script src="scripts/register.js" type="text/javascript"></script>
	
	<meta http-equiv="Cache-control" content="no-cache">


</head>
<body>

	<script>
  function myFun(sId) {
    var oImg = document.getElementsByTagName('img');

    for (var i = 0; i < oImg.length; i++) {
      if (oImg[i].id == sId) {
        oImg[i].previousSibling.previousSibling.checked = true;
        oImg[i].style.border = '1px solid #FF6600';
      } else {
        oImg[i].style.border = '1px solid #008800';

      }
    }
  }


</script>
	
	
	
	
<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Sign Up.</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
			<div id="face">
				<input type="radio" name="face" value="face1.gif" style="display: none" checked="true"><img src="img/face1.gif" class="current">
				<input type="radio" name="face" value="face2.gif" style="display: none"><img src="img/face2.gif" class="">
				<input type="radio" name="face" value="face3.gif" style="display: none"><img src="img/face3.gif" class="">
				<input type="radio" name="face" value="face4.gif" style="display: none"><img src="img/face4.gif" class="">
				<input type="radio" name="face" value="face5.gif" style="display: none"><img src="img/face5.gif" class="">
				<input type="radio" name="face" value="face6.gif" style="display: none"><img src="img/face6.gif" class="">
				<input type="radio" name="face" value="face7.gif" style="display: none"><img src="img/face7.gif" class="">
				<input type="radio" name="face" value="face8.gif" style="display: none"><img src="img/face8.gif" class="">
			</div>	
				
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<a href="index.php">Sign in Here...</a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>