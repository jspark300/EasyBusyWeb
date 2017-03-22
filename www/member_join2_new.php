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

// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "http://easybusy.co.kr";
var g5_bbs_url   = "http://easybusy.co.kr/bbs";

function checkNic(){
	f = document.fregisterform;
	if(f.mb_nick.value == "" )
	{
		alert("닉네임을 입력해 주세요.");
		return;
	}
	f.action="/checknic.php"
	f.target = "FrmHid";
	f.submit();
}
function checkEmail(){
	f = document.fregisterform;
	if(f.email.value == "" )
	{
		alert("이메일을 입력해 주세요.");
		return;
	}
	f.action="/checkemail.php"
	f.target = "FrmHid";
	f.submit();
}
function checkTel(){
	f = document.fregisterform;
	if(f.hp.value == "" )
	{
		alert("휴대폰 번호를 입력해 주세요.");
		return;
	}
	f.action="/checktel.php"
	f.target = "FrmHid";
	f.submit();
}
function fregisterform_submit(f){
//	f = document.fregisterform;
//	if(!f.mb_nick.value){
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}	
		if (f.mb_password.value.length < 4) {
				alert("비밀번호를 4글자 이상 입력하십시오.");
				f.mb_password.focus();
				return false;
		}
		if (f.mb_password.value != f.mb_password_re.value) {
			alert("비밀번호가 같지 않습니다.");
			f.mb_password_re.focus();
			return false;
		}
		
	//	alert("닉네임을 입력해 주세요");
	//	f.nicname.focus();
	//	return;
	//}

		// 본인확인 체크
	if(f.cert_no.value=="") {
		alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
		return false;
	}	
	if (f.mb_name.value.length < 1) {
		alert("이름을 입력하십시오.");
		f.mb_name.focus();
		return false;
	}
	var msg = reg_mb_hp_check();
		if (msg) {
		alert(msg);
		f.reg_mb_hp.select();
		return false;
	}
	var msg = reg_mb_nick_check();
		if (msg) {
			alert(msg);
			f.reg_mb_nick.select();
			return false;
		}
	//	var msg = reg_mb_id_check();
	//	if (msg) {
	//		alert(msg);
	//		f.mb_id.select();
	//		return false;
	//	}

	//if(!f.email.value){
	//	alert("이메일를 입력해 주세요");
	//	f.email.focus();
	//	return;
	//}
	//if(f.emailchk.value==""){
	//	alert("이메일 중복확인체크를 해주세요");
	//	return;
	//}
	//if(f.hp.value==""){
	//	alert("휴대폰번호를 입력해 주세요");
	//	f.hp.focus();
	//	return;
	//}	
//	if(f.hpchk.value==""){
//		alert("휴대폰번호 중복확인체크를 해주세요");
//		return;
//	}		
//	if(!f.userpass.value){
//		alert("비밀번호를 입력해 주세요");
//		f.userpass.focus();
//		return;
//	}
//	if(f.userpass.value.length<4){
//		alert("비밀번호를 4자 이상 입력해 주세요");
//		f.userpass.focus();
//		return;
//	}
//	if(!f.repass.value){
//		alert("비밀번호 확인을 입력해 주세요");
//		f.repass.focus();
//		return;
//	}
//	if (f.userpass.value!=f.repass.value){
//		alert("비밀번호 확인이 맞지 않습니다.");
//		f.userpass.focus();
//		return;
//	}
	
	
	if(f.c1.checked!=true){
		alert("이지비지 서비스 이용약관에 동의 해주세요.");
		return false;
	}
	if(f.c2.checked!=true){
		alert("위치기반 서비스 이용약관에 동의 해주세요.");
		return false;
	}
	if(f.c3.checked!=true){
		alert("개인정보 수집 및 이용에 동의 해주세요.");
		return false;
	}
	if(f.c4.checked!=true){
		alert("개인정보 제3자 이용에 동의 해주세요.");
		return false;
	}	
	document.getElementById("btn_submit").disabled = "disabled";
	return true;
//	f.action = "join_db.php";
//	f.target="";
//	f.submit();
}
//-->
</script>
<script src="/js/jquery.register_form.js"></script>
<script src="/js/certify.js"></script>
</head>


<body>
	<header class="header2">
		<div class="btn_back"><a href="member_login.php"></a></div>
		<div class="txt_tit">
			<p>회원가입</p>
		</div>
	</header>
	<section class="member_wrap">
<form name="fregisterform" method="post" action="join_db_new.php"  onsubmit="return fregisterform_submit(this);">
						<input type="hidden" name="username" />
					      <input type="hidden" name="birthday" />
						  <input type="hidden" name="agecheck" />
					      <input type="hidden" name="nation" />
					      <input type="hidden" name="phoneNo" />
						<input type="hidden" name="idchk">
						<input type="hidden" name="nicchk">
						<input type="hidden" name="emailchk">
						<input type="hidden" name="hpchk">
						<input type="hidden" name="CI" value="" />
						<input type="hidden" name="userid" />
						<input type="hidden" name="cert_type" value="">
						<input type="hidden" name="cert_no" value="">
		<ul class="input_wrap">
			<li>
				<p class="tit_txt">● 이메일(아이디) <span>(비밀번호 찾기 시 이메일 확인을 위해 필요합니다.)</span></p>
				<div class="input">
					<input type="email" name="mb_email" placeholder="이메일 입력" id="reg_mb_email" >
					
				</div>
			</li>
			<li>
				<p class="tit_txt">● 비밀번호</p>
				<div class="input">
					<input type="password" name="mb_password" placeholder="4자 이상 숫자, 영문 입력">
				</div>
				<div class="input">
					<input type="password" name="mb_password_re" placeholder="비밀번호 확인 입력">
				</div>
			</li>
			
			
			<li>
				<p class="tit_txt">● 이름 </p>
				<div class="input">
					<p><input type="name"  id="reg_mb_name" name="mb_name"  placeholder="이름"></p>
					<a href="#1"   onclick="javascript:go_cert();">휴대폰본인확인</a>
				</div>
			</li>				
			<li>
				<p class="tit_txt">● 휴대폰번호 </p>
				<div class="input">
					<input type="tel"  name="mb_hp" id="reg_mb_hp" placeholder="휴대폰번호">
					
				</div>
			</li>			
			<li>
				<p class="tit_txt">● 닉네임 <span>(3~30자 이내, 공백불가능, 한글/숫자/영문 가능)</span></p>
				<div class="input">
					<input type="text"   name="mb_nick" placeholder="닉네임 입력" id="reg_mb_nick">
					
				</div>
			</li>
			
			
			<li>
				<div class="input check">
					<p><input type="checkbox" name="c0" id="c1_0"  onclick="all_check();"><label for="c1_0"> 전체동의</label></p>
					
				</div>
				<div class="input check">
					<p><input type="checkbox" name="c1" id="c1_1"><label for="c1_1"> 이지비지 서비스 이용약관에 동의</label></p>
					<a href="/provision.php" target="_blank">내용보기</a>
				</div>
				<div class="input check">
					<p><input type="checkbox" name="c2" id="c1_2"><label for="c1_2"> 위치기반 서비스 이용약관에 동의</label></p>
					<a href="/provision_loc.php" target="_blank">내용보기</a>
				</div>
				<div class="input check">
					<p><input type="checkbox" name="c3" id="c1_3"><label for="c1_3"> 개인정보 수집 및 이용에 동의</label></p>
					<a href="/private.php" target="_blank">내용보기</a>
				</div>
				<div class="input check">
					<p><input type="checkbox" name="c4" id="c1_4"><label for="c1_4"> 개인정보 제3자 이용에 동의</label></p>
					<a href="/private3.php" target="_blank">내용보기</a>
				</div>
			</li>
		</ul>
	

	
		<div class="btn1">
			<button type="submit" id="btn_submit" class="btn1 btn-color" accesskey="s" style="border-radius: 8px;background-color: crimson;border: none;    color: white;    padding: 15px 32px;text-align: center;    text-decoration: none;    display: inline-block;    font-size: 16px;cursor:pointer;">회원가입</button>
			<button type="button" id="btn_cancel" class="btn1 btn-color" accesskey="s" style="border-radius: 8px;background-color: black;border: none;    color: white;    padding: 15px 32px;text-align: center;    text-decoration: none;    display: inline-block;    font-size: 16px;cursor:pointer;" onclick="location.href='/'">취소</button>
		</div>
</form>
	</section>
<iframe name="FrmHid" id="FrmHid" src="" width=0 height=0></iframe>	
<script>
function go_cert()
{
if(!cert_confirm())
			return false;
else
	certify_win_open("kcp-hp", "/plugin/kcpcert/kcpcert_form.php");
}
function all_check() {
    f = document.fregisterform;

    if (f.c0.checked == true) {
        f.c1.checked = true;
        f.c2.checked = true;
		f.c3.checked = true;
		f.c4.checked = true;
		
    }
    else {
        f.c1.checked = false;
        f.c2.checked = false;
		f.c3.checked = false;
		f.c4.checked = false;
    }

}
</script>


</body>
</html>