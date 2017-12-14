// JavaScript Document
		$(function(){
		    //定义时间戳
			timestamp = 0;
			updateStatus = true;
			
			//调用更新信息函数
			updateMsg();
			//表单提交
			$(".chatform").submit(function funcSubmit(){
				updateStatus = false;
//				var picPath = $("#face img").filter(".current")[0].src;
//				var index = picPath.lastIndexOf("\/");  
//				var picName = picPath.substring(index + 1, picPath.length);
				$.post("backend.php",{
							message: $("#msg").val(),
							name: $("#inputAuthor").val(),
							action: "postmsg",
							time: timestamp,
							pic: $("#inputPic").val()
						}, function(xml) {
					//清空信息文本框内容
					$("#msg").val("");
					//调用解析xml的函数
					
					addMessages(xml);
							});
				return false; //阻止表单提交
			});
			$("#face img").click(function(){
				$(this).addClass("current").siblings().removeClass("current");
			});
			
		});
        //更新信息函数，每隔一定时间去服务端读取数据
		function updateMsg(){
			if (updateStatus == true) {
				$.post("backend.php",{ time: timestamp }, function(xml) {
				//调用解析xml的函数
				addMessages(xml);
				});
			}
			//每隔4秒，读取一次.
			setTimeout('updateMsg()', 100);
		}
        //解析xml文档函数，把数据显示到页面上
		function addMessages(xml) {
		    //如果状态为2，则终止
			if($("status",xml).text() == "2") return;
			//更新时间戳
//			timestamp = $("time",xml).text();
			//$.each循环数据
			$("message",xml).each(function() {
			    var author = $("author",this).text(); //发布者
				var content = $("text",this).text();  //内容
				timestamp = $("time",this).text();  //内容
//				var htmlcode = "<strong>"+author+"</strong>: "+content+"<br />";
				var userpic = "img/" + $("pic",this).text();
				var htmlcode = "<li><div class=\"userPic\"><img src=\"" + userpic + "\"></div>\
							 <div class=\"content\">\
							 	<div class=\"author\"><a href=\"javascript:;\">" + author + "</a>:</div>\
								<div class=\"msgInfo\">" + content + "</div>\
								<div class=\"times\"><span>" + timeFormat(timestamp) +
									"</span></div>\
							 </div></li>";
				$(".messagewindow").append( htmlcode ); //添加到文档中
				$(".messagewindow").scrollTop($('.messagewindow')[0].scrollHeight);
				updateStatus = true;				
			});
			
			
			
		}
		
		function timeFormat(curTime){//将当前时间转换成yyyymmdd格式
			curTimeToStr = curTime.toString(); 	
			curTimeToStr = curTimeToStr.substr(4,2) + "\u6708" + curTimeToStr.substr(6,2) + "\u65e5 " + curTimeToStr.substr(8,2) + ":" + curTimeToStr.substr(10,2);
			return curTimeToStr;
		  }