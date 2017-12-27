// JavaScript Document
$(function(){
	//定义时间戳
	timestamp = 0;
	chatroomLastUpdateTime = 0;
	updateStatus = true;
	showMorePosition = 0;//count from the last. addMessage +1 everytime
	//调用更新信息函数
	updateMsg();
	//表单提交
	$("#sendBtn").click(function funcSubmit(){
		updateStatus = false;
//				var picPath = $("#face img").filter(".current")[0].src;
//				var index = picPath.lastIndexOf("\/");  
//				var picName = picPath.substring(index + 1, picPath.length);
		$.post("backend.php",{
					message: $("#msg").val(),
					name: $("#inputAuthor").val(),
					action: "postmsg",
					time: timestamp,
					showPosition: 0
//							pic: $("#inputPic").val()
				}, function(xml) {
			//清空信息文本框内容
			$("#msg").val("");
			//调用解析xml的函数
//				alert(xml);
			addMessages(xml,"n");
					});
		return false; //阻止表单提交
	});
	$("#face img").click(function(){
		$(this).addClass("current").siblings().removeClass("current");
	});
	$("#showMore").click(function(){
		$.post("backend.php",{time: 0, showPosition: showMorePosition }, function(xml) {
				addMessages(xml,"o");
				});
//		alert(showMorePosition);
	})

});
        //更新信息函数，每隔一定时间去服务端读取数据
		function updateMsg(){
			if (updateStatus == true) {
				$.post("backend.php",{time: timestamp,
					showPosition: 0 }, function(xml) {
				//调用解析xml的函数
				addMessages(xml,"n");
				});
			}
			//每隔4秒，读取一次.
			setTimeout('updateMsg()', 4000);
		}
        //解析xml文档函数，把数据显示到页面上
		function addMessages(xml,showStatus) { //showStatus: n-new(append),o-old(insert)
		    //如果状态为2，则终止
			if($("status",xml).text() == "2") return;
			//更新时间戳
//			timestamp = $("time",xml).text();
			//$.each循环数据
			$("ul li").eq(1).attr("id","liMark");
					
			$("message",xml).each(function() {
			    var author = $("author",this).text(); //发布者
				var content = $("text",this).text();  //内容
				if (content.match(/^\s*$/)){ //all space or \\n or empty
					content = "&nbsp";
				}
				time = $("time",this).text();
				if (showStatus == "n"){
					
					timestamp = $("time",this).text();  //内容
				}
				
				
//				var htmlcode = "<strong>"+author+"</strong>: "+content+"<br />";
				var userpic = $("pic",this).text();
				if ($("#inputAuthor").val() == author){
					msgMe = " class=\"msgMe\"";
				}else{
					msgMe = "";
				}
				var htmlcode = "<li" + msgMe + "><div class=\"times\"><span>" + timeFormat(time) + "</span></div>\
							<div class=\"userPic\"><img src=\"" + userpic + "\"></div>\
							 <div class=\"content\">\
								<div class=\"msgInfo\">" + content + "</div>\
							 </div></li>";
				if (showStatus == "n"){
					
					$(".messagewindow").append( htmlcode ); //添加到文档中
					$(".messagewindow").scrollTop($('.messagewindow')[0].scrollHeight);
				}else if (showStatus == "o"){
//					alert(htmlcode);
					$( htmlcode ).insertBefore( "#liMark");

				}
				showMorePosition += 1;
				updateStatus = true;
			});
					$("ul li").eq(1).removeAttr("id");
//			<div class=\"author\"><a href=\"javascript:;\">" + author + "</a>:</div>\
			
		}
		
		function timeFormat(Time){//将当前时间转换成yyyymmdd格式
			var weekday=new Array(7);
			weekday[0]="Sunday";
			weekday[1]="Monday";
			weekday[2]="Tuesday";
			weekday[3]="Wednesday";
			weekday[4]="Thursday";
			weekday[5]="Friday";
			weekday[6]="Saturday";
			
			var $curTime = new Date().Format("MM/dd/yyyy");  //current time->决定日期部分如何显示
			var $curYear = new Date().Format("yyyy");
			var $chatTime = Time.toString(); //chat time
			var $chatyear = $chatTime.substr(0,4);
			var $chatmonth = $chatTime.substr(4,2);
			var $chatday = $chatTime.substr(6,2);
			var $chathour = $chatTime.substr(8,2);
			var $chatmin = $chatTime.substr(10,2);
			var $chatsec = $chatTime.substr(12 ,2); 
			var $chatTime = $chatyear+' '+$chatmonth+' '+$chatday +' '+$chathour+':'+$chatmin+':'+$chatsec; // mm/dd/yyyy yyyy mm dd parse都可以用
//			$curTime = "12/27/2017";
//			$curYear = "2017";
			var dayDiff=((Date.parse($curTime)-Date.parse($chatTime))/86400000);
			dayDiff = Math.abs(dayDiff);
			var yearDiff = Math.abs($curYear-$chatyear);
			var result = "";
			if (yearDiff >= 2){//大于两年 显示yyyy-mm-dd
				result = $chatyear+"-"+$chatmonth+"-"+$chatday+"  ";
			}else{//两年内（今年和去年）不现实年份
				if (dayDiff == 0){//当天：只显示时间
					alert("0");
					result = "";
				}else if (dayDiff >=1 && dayDiff <=6){//1-6天：显示星期几
					result = weekday[(new Date(Date.parse($chatTime))).getDay()] + "  ";//返回星期几 
					alert("1");
				}else if (dayDiff >=7){//大于7天 显示日期
					result = $chatmonth+"-"+$chatday+"  ";
					alert("2");
				}
			}
		
			var minDiff=(Date.parse($chatTime)-Date.parse(chatroomLastUpdateTime))/60000;
			if (minDiff<=5){//五分钟之内
				result="";
			}else{
				result = result + $chathour+':'+$chatmin;
				chatroomLastUpdateTime = $chatTime;
			}
			return result;//返回星期几
		  }

Date.prototype.Format = function (fmt) //date format
{ 
    var o = {
        "M+": this.getMonth() + 1, 
        "d+": this.getDate(), 
        "h+": this.getHours(), 
        "m+": this.getMinutes(), 
        "s+": this.getSeconds(), 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}
