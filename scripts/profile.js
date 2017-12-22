
$(function(){	
	
	var clipArea = new bjj.PhotoClip("#clipArea", {
		size: [198, 198], 
		outputSize: [50, 50],
		file: "#file", 
		view: "#view", 
		ok: "#clipBtnSave", 
		loadStart: function() {
			$('#photoclipWapper').fadeIn();
			console.log("照片读取中");
		},
		loadComplete: function() {
			console.log("照片读取完成");
		},
		clipFinish: function(dataURL) {
			$('#photoclipWapper').fadeOut();
			$("#profilePic").attr('src', dataURL);
//			$("#profilePic").attr("src",xml);
		$.post("upload.php",{
				face: dataURL,
				systemPic: "false"
			}, function(xml) {
//			$("#profilePic").attr("src",xml);
			});
		}
	});
	
$("#clipBtnCancel").click(function(){						
	$('#photoclipWapper').hide();
	return false;//防止页面整个刷新
});
	
$("#face img").click(function(){						
	var $face = $(this).attr("src");
	$.post("upload.php",{
				face: $face,
				systemPic: "true"
			}, function() {
	$("#profilePic").attr("src",$face);
	});
});
	
	
$("#face img").hover(
	function(){	
	$(this).css("margin","0px");
	$(this).parent().css({"width": "44px", "height":"44px", "-webkit-border-radius": "4px","-moz-border-radius": "4px","border-radius": "4px","border": "2px solid rgba(89,86,86,1.00)"});}, function(){	
	$(this).css("margin","2px");
	$(this).parent().css({"width": "48px", "height":"48px", "border": "0px"});}
);
		
$(document).click(function(e) {
   if(($(e.target).parents("#profileWrapper").length==0) && e.target.id != 'profilePic')
      if ( $('#profileWrapper').is(':visible') ) {
         $('#profileWrapper').hide();
		  
      }
});

$("#profilePic").click( function(e){
	$("#profileWrapper").toggle();
});

	
});