<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EASYBUSY</title>
	<script src="a_js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">


jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}

 
showPopup = function() {
$("#popLayer").show();
$("#popLayer").center();
}
 
</script>
 
<body>

 
<a href="javascript:;" onclick="javascript:showPopup()">팝업띄우기</a>
 
...
</body>
 
<div id="popLayer" style="display:none;">
<div>팝업 레이어입니다.</div>
<div>
<? phpinfo();?>