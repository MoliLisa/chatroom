$(function(){
	var clipArea = new bjj.PhotoClip("#clipArea", {
		size: [428, 321],
		outputSize: [428, 321], 
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
			$('#view').css('background-size','100% 100%');
			$(".uploadSrc").attr('src', dataURL);
			$(".uploadSrc").prev().attr('value', 'upload.jpg');
			$(".picURL").val(dataURL);
		<?php 
		 file_put_contents('tmp/imgs.jpg', base64_decode(explode(',', 'aaa,aaaaaddddd')[1])) ; 
		?> 
			console.log(dataURL);
		}
	});
	
$("#face img").click(function(){						
	$(this).prev().attr('checked',true);
	$(this).addClass("current").siblings().removeClass("current");

});
});