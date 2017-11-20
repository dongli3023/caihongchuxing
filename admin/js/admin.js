$(document).ready(function(){
	//隐藏搜索
	var s=$("#XDcms_search");
	$("#open_search").toggle(function(){
		s.hide('slow');
	},function(){
		s.show('slow');
	})
});


//弹出窗口
function confirm(message, callback) {
	$('#confirm').modal({
		closeHTML:"<a href='#' title='Close' class='modal-close'>x</a>",
		position: ["20%",],
		overlayId:'confirm-overlay',
		containerId:'confirm-container', 
		onShow: function (dialog) {
			$('.message', dialog.data[0]).append(message);
			
			$('.yes', dialog.data[0]).click(function () {
				window.location.href = callback;
				$.modal.close();
			});
		}
	});
}


//iframe弹出层
function ShowIframe(width, height, tit, url) {
	var winWinth = $(window).width(), winHeight = $(document).height();
	$("body").append("<div class='winbj' id='dialogCase'></div>");
	$("body").append("<div class='tanChu'><div class='tanChutit'><span class='tanchuTxt'>" + tit + "</span><span class='tanchuClose'>关闭</span></div><iframe class='winIframe' frameborder='0' hspace='0' src=" + url + "></iframe></div>");
	$(".winbj").css({ width: winWinth, height: winHeight, background: "#000", position: "absolute", left: "0", top: "0" });
	$(".winbj").fadeTo(0, 0.5);
	var tanchuLeft = $(window).width() / 2 - width / 2;
	var tanchuTop = $(window).height() / 2 - height / 2 + $(window).scrollTop();
	$(".tanChu").css({ width: width, height: height, border: "1px #7998B7 solid","border-top": "none", left: tanchuLeft, top: tanchuTop, background: "#fff", position: "absolute" });
	$(".tanChutit").css({ width: width, height: "29px", "border-top": "none","background": "url(admin/images/msgbg.gif) repeat-x", "line-height": "29px", "color": "#fff","font-family":"'微软雅黑','宋体', Verdana, Arial, Helvetica, sans-serif","font-weight":"bold" });
	$(".tanchuTxt").css({ "text-indent": "5px", "float": "left", "font-size": "14px" });
	$(".tanchuClose").css({ "width": "40px", "float": "right", "font-size": "12px", "color": "#fff", "cursor": "pointer","font-weight":"100" });
	var winIframeHeight = height - 26;
	$(".winIframe").css({ width: width, height: winIframeHeight, background: "#ffffff" });
	$(".tanchuClose").hover(
function() {
$(this).css("color", "#fff");
}, function() {
$(this).css("color", "#fff");
}
);
	$(".tanchuClose").click(function() {
		$(".winbj").remove();
		$(".tanChu").remove();
	});
}
//iframe弹出层end