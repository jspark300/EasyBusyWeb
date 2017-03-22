<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

if ($is_member) {
    alert("이미 로그인중입니다.");
}

$action_url = "/bbs/password_lost2.php";
?>
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
    function send_email_pass() {
        //로그인과정
        f = document.fx;
        if (!f.mb_email.value || f.mb_email.value == "") {
            alert("이메일을 입력해 주세요");
            f.mb_email.focus();
            return;
        }

        f.action = "/bbs/password_lost2.php"
        f.target = "FrmHid"
        f.submit();
    }

  
</script>	

</head>
<body>


	<header class="header2">
		<div class="btn_back"><a href="member_login.php"></a></div>
		<div class="txt_tit">
			<p>비밀번호 찾기</p>
		</div>
	</header>
	<section class="member_wrap">
<form  name="fx"  method="post" autocomplete="off">
		<h2 class="tit_txt">
			● 회원님의 이메일을 입력해 주세요
		</h2>
		<div class="input">
			<input type="text" name="mb_email" placeholder="이메일 입력">
			<?php echo captcha_html(); ?>
			<!-- input type="tel" placeholder="휴대폰번호 입력('-' 제외)" -->
		</div>
		<!--div class="btn1">
			<p><a href="javascript:alert('인증번호를 발송했습니다.'); $('#certi_box').css('display', 'block');">인증번호 발송</a></p>
		</div -->
		<div class="btn1">
			<p><a href="javascript:send_email_pass();">임시비밀번호 발송</a></p>
		</div>
		<!--div id="certi_box" style="display:none;">
			<div class="input">
				<input type="tel" placeholder="인증번호 입력">
			</div>
			<div class="btn1">
				<p><a href="member_pw2.html">인증번호 확인</a></p>
			</div>
		</div-->
</form>
	</section>
	<iframe name="FrmHid" id="FrmHid" src="" width=0 height=0></iframe>
</body>
</html>