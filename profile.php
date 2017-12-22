<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage - Login & Registration System</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />

<meta http-equiv="x-ua-compatible" content="ie=edge">
<!--<link rel="stylesheet" href="css/style.css" type="text/css" />-->
<!--		<meta name="robots" content="all">-->
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/iscroll-zoom.js"></script>
<script src="js/hammer.js"></script>
<script src="js/lrz.all.bundle.js"></script>
<script src="js/jquery.photoClip.js"></script>

</head>
<body>
	
<script>

$(function(){	
	var clipArea = new bjj.PhotoClip("#clipArea", {
		size: [100, 100], 
		outputSize: [50, 50],
		file: "#file", 
		view: "#view", 
		ok: "#clipBtn", 
		loadStart: function() {
			$('.cover-wrap').fadeIn();
			console.log("照片读取中");
		},
		loadComplete: function() {
			console.log("照片读取完成");
		},
		clipFinish: function(dataURL) {
			$('.cover-wrap').fadeOut();
//			$('#view').css('background-size','100% 100%');
//			$(".picURL").val(dataURL);
			$("#userPic").attr('src', dataURL);
			$systemPic = false;
//			$(".uploadSrc").prev().attr('value', 'upload.jpg');
			
		$("#formURL").submit();	
		<?php 
		 file_put_contents('img/upload.jpg', base64_decode(explode(',', $_POST['picURL'])[1])) ; 
		?> 
		}
	});
$("#uploadPic").submit(function(){
		var $face = $('input:radio[name="face"]:checked').val();
				$.post("upload.php",{
							face: $face,
							systemPic: $systemPic
						}, function(xml) {
					alert(xml);
							});
				
				return false; //阻止表单提交
			});
	
$("#face img").click(function(){						
	$(this).prev().attr('checked',true);
	$("#userPic").attr('src', $(this).attr('src'));
	$systemPic = true;
//	$(this).addClass("current").siblings().removeClass("current");

});
});
</script>

<img id="userPic" src="img/default.gif">
<div>
	  
	<div id="container" ontouchstart="">
		<div id="btn">点击上传头像
			<input type="file" id="file" >
		</div>
	</div>				
	<div class="form-group">
		<button type="submit" class="btn btn-block btn-primary" name="btn-signup">OK</button>
	</div>
 

<form action="" method="post" id="formURL" target="nm_iframe">
  <input type="hidden" name="picURL" class="picURL" value="">
	<button type="submit" id='picForm' name=""></button>
</form> 
<iframe id="id_iframe" name="nm_iframe" style="display:none;"></iframe>  
   
<div id="#photoclipWrap" >	
		<div class="cover-wrap-first">
			<div id="clipArea"></div>
			<div class="cover-wrap-second">
				<button id="clipBtn">保存封面</button>
			</div>
		</div>
</div>
</div>

	
</body>
</html>
