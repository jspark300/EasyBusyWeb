<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EASYBUSY</title>
	<link href="a_css/default.css" rel="stylesheet" />
	<link href="a_css/common.css" rel="stylesheet" />
	<script src="a_js/jquery-1.11.3.min.js"></script>
	<script src="a_js/common.js"></script>
<script type="text/javascript">
	function gosave()
	{
		if(trim(document.give_con.coupon.value) == "")
		{
			alert('쿠폰 번호를 입력해 주세요.');
			document.give_con.coupon.focus();
			return;
		}
		document.give_con.submit();
		
	}
	function trim(str)
	{
		return str.replace(/^\s*|\s*$/g,"");
	}
	function checkemail(email)
	{
		var regex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;   

		if(regex.test(email) === false) {  
			return false;  
		} else {  
			return true;
		}  
	}
//-->  
</script>
</head>
<body>
	<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>쿠폰등록하기</p>
		</div>
	</header>
<?
include_once('./_common.php');

if (!$is_member) {
	echo "<script>location.href='/member_login_ex.php';</script>";
	exit;
}


?>

<form name="give_con" method="post" charset="utf-8" action="mycoupon_reg_db.php">
	<section class="member_wrap">
		<ul class="input_wrap">
			<li>
				<p class="tit_txt">쿠폰번호</p>
				<div class="input">
					<input type="text" name="coupon"  placeholder="쿠폰번호" value="<?=$cp?>">
				</div>
			</li>
		</ul>
		<ul class="list1">
			<li>- 선물받은 경품(쿠폰)은 다시 선물을 할 수 없습니다.</li>
			<!-- li><em>- 선물하기가 완료되면 취소할 수 없으니, 받는 분을 꼭 확인하시기 바랍니다.</em></li -->
		</ul>
		<div class="btn2">
			<a href="javascript:gosave();">쿠폰등록</a>
		</div>
	</section>
</form>
</body>
</html>