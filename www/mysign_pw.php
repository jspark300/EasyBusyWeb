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
<!--
function gosave(){
	f = document.Frm;
	if(!f.pass.value){
		alert("비밀번호를 입력해 주세요");
		f.userpass.focus();
		return;
	}
	if(!f.newpass.value){
		alert("신규 비밀번호를 입력해 주세요");
		f.repass.focus();
		return;
	}
	if(f.newpass.value.length<4){
		alert("신규 비밀번호를 4자 이상 입력해 주세요");
		f.newpass.focus();
		return;
	}
	if(!f.newpass_re.value){
		alert("신규 비밀번호 확인을 입력해 주세요");
		f.newpass_re.focus();
		return;
	}
	if (f.newpass.value!=f.newpass_re.value){
		alert("신규 비밀번호와 신규 비밀번호 확인이 일치하지 않습니다.");
		f.newpass.focus();
		return;
	}
	f.submit();
}
//-->
</script>
</head>
<body>
	<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>비밀번호 변경</p>
		</div>
	</header>
	<section class="member_wrap">
<form name="Frm" method="post" action="modify_pw_db.php">
		<ul class="input_wrap">
			<li>
				<div class="input">
					<input type="password" name="pass" placeholder="기존비밀번호">
				</div>
				<div class="input">
					<input type="password" name="newpass" placeholder="신규 비밀번호 4자 이상 숫자, 영문 입력">
				</div>
				<div class="input">
					<input type="password" name="newpass_re" placeholder="신규 비밀번호 확인 입력">
				</div>
			</li>
		</ul>
		
		<div class="btn1">
			<a href="javascript:gosave();">비밀번호 변경</a>
		</div>
</form>
	</section>
</body>
</html>