$(function(){
	//上传封面
	var clipArea = new bjj.PhotoClip("#clipArea", {
		size: [428, 321],// 截取框的宽和高组成的数组。默认值为[260,260]
		outputSize: [428, 321], // 输出图像的宽和高组成的数组。默认值为[0,0]，表示输出图像原始大小
		//outputType: "jpg", // 指定输出图片的类型，可选 "jpg" 和 "png" 两种种类型，默认为 "jpg"
		file: "#file", // 上传图片的<input type="file">控件的选择器或者DOM对象
		view: "#view", // 显示截取后图像的容器的选择器或者DOM对象
		ok: "#clipBtn", // 确认截图按钮的选择器或者DOM对象
		loadStart: function() {
			$('.cover-wrap').fadeIn();
			console.log("照片读取中");
		},
		loadComplete: function() {
			console.log("照片读取完成");
		},
		//loadError: function(event) {}, 
		clipFinish: function(dataURL) {
			$('.cover-wrap').fadeOut();
			$('#view').css('background-size','100% 100%');
			$(".uploadSrc").attr('src', dataURL);
			$(".uploadSrc").prev().attr('value', dataURL);
			console.log(dataURL);
		}
	});
	
$("#face img").click(function(){						
	$(this).prev().attr('checked',true);
	$(this).addClass("current").siblings().removeClass("current");

});
});