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
<script>
    function gocheck() {
        //로그인과정
        f = document.FrmLoginx;
        if (!f.mb_password.value || f.mb_password.value == "") {
            alert("비밀번호를 입력해 주세요");
            f.mb_password.focus();
            return;
        }


        f.action = "/check_db.php"
        f.target = ""
        f.submit();
    }

  
</script>	

</head>
<body>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>비밀번호확인</p>
		</div>
	</header>
	<section class="member_wrap">
<form name="FrmLoginx" method="post" >
<? if($url=="")
	$url =  $_SERVER['HTTP_REFERER'];
?>
	<input type="hidden" name="url" value="<?=$url?>">
		<h2 class="tit_txt">
			● 회원님의 비밀번호를 입력해 주세요
		</h2>
		<div class="input">
			<input type="password" name="mb_password" placeholder="비밀번호 입력">
		</div>
		<div class="btn1">
			<a href="javascript:gocheck();">확인</a>
		</div>
</form>
	</section>
	<!--section class="member_wrap">
		<div class="d1">
			<h3 class="subtit_txt">간편로그인</h3>
			<a href="#1" class="naver">네이버계정으로 로그인</a>
			<a href="#1" class="facebook">페이스북계정으로 로그인</a>
			<a href="#1" class="kakao">카카오계정으로 로그인</a>
		</div>
	</section-->
<iframe name="FrmHid" id="FrmHid" src="" width=0 height=0></iframe>

</body>
</html>