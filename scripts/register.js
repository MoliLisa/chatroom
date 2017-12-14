
		$(function(){
				$("#face img").click(function(){
								
				$(this).prev().attr('checked',true);
				$(this).addClass("current").siblings().removeClass("current");
				
			});
});