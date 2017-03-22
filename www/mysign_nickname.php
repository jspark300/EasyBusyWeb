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
var g5_url       = "http://easybusy.co.kr";
var g5_bbs_url   = "http://easybusy.co.kr/bbs";
function checkNic(){
	f = document.Frm;
	if(f.nicname.value == "" )
	{
		alert("닉네임을 입력해 주세요.");
		return;
	}
	f.action="/checknic.php"
	f.target = "FrmHid";
	f.submit();
}
function gosave(){
	f = document.Frm;
	 if(f.mb_nick.defaultValue != f.mb_nick.value)
	 {
		var msg = reg_mb_nick_check();
		if (msg) {
			alert(msg);
			f.reg_mb_nick.select();
			return false;
		}
	 }
		
	//f = document.Frm;
//	if(!f.nicname.value){
//		alert("닉네임을 입력해 주세요");
//		f.nicname.focus();
//		return;
//	}
//	if(f.nicchk.value==""){
//		alert("닉네임 중복확인체크를 해주세요");
//		return;
//	}
	
/*	if(!f.email.value){
		alert("이메일를 입력해 주세요");
		f.email.focus();
		return;
	}
	if(f.emailchk.value==""){
		alert("이메일 중복확인체크를 해주세요");
		return;
	}
	if(!f.userpass.value){
		alert("비밀번호를 입력해 주세요");
		f.userpass.focus();
		return;
	}
	if(!f.repass.value){
		alert("비밀번호 확인을 입력해 주세요");
		f.repass.focus();
		return;
	}
	if (f.userpass.value!=f.repass.value){
		alert("비밀번호 확인이 맞지 않습니다.");
		f.userpass.focus();
		return;
	}
	
	if(f.c1.checked!=true){
		alert("위치기반 서비스 이용약관에 동의 해주세요.");
		return;
	}
	if(f.c2.checked!=true){
		alert("개인정보 수집 및 이용에 동의 해주세요.");
		return;
	}
*/
	f.action = "nickname_db.php";
	f.target="";
	f.submit();
}
//-->
</script>
<script src="/js/jquery.register_form.js"></script>
</head>
<body>
	<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>닉네임 변경</p>
		</div>
	</header>
	<section class="member_wrap">
<form name="Frm" method="post" action="nickname_db.asp">
	<input type="hidden" name="nicchk">
		<ul class="input_wrap">
			<li>
				<div class="input">
					<input type="text" name="mb_nick" value="<?=$member[mb_nick]?>" placeholder="닉네임 입력" id="reg_mb_nick">
				</div>
				<p class="exp">3~10자 이내, 공백불가능, 한글/숫자/영문 가능</p>
			</li>
		</ul>
		
		<div class="btn1">
			<a href="javascript:gosave();">닉네임 변경</a>
		</div>
</form>
	</section>
</body>
<iframe name="FrmHid" id="FrmHid" src="" width=0 height=0></iframe>

</html>