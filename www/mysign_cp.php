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
	if(!f.hp.value){
		alert("휴대폰번호를 입력해 주세요");
		f.hp.focus();
		return;
	}
	if(f.hpchk.value==""){
		alert("휴대폰번호 중복확인체크를 해주세요");
		return;
	}	
	f.action="/modify_cp_db.php";
	f.target = "";
	f.submit();
}
function checkTel(){
	f = document.Frm;
	if(f.hp.value == "" )
	{
		alert("휴대폰 번호를 입력해 주세요.");
		return;
	}
	f.action="/checktel.php";
	f.target = "FrmHid";
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
			<p>휴대폰번호 변경</p>
		</div>
	</header>
<?
include_once('./_common.php');

?>

	<section class="member_wrap">
<form name="Frm" method="post" action="modify_cp_db.php">
<input type="hidden" name="hpchk">
		<ul class="input_wrap">
			<li>
				<div class="input">
					<p><input type="tel" name="hp" placeholder="휴대폰번호 입력" value="<?=$member[mb_hp]?>"></p><a href="#1"   onclick="javascript:checkTel();">중복확인</a>
					
				</div>

				<!--div class="input">
					<p><input type="tel" placeholder="휴대폰번호 입력"></p>
					<a href="#1">인증번호 발송</a>
				</div>
				<div class="input">
					<p><input type="password" placeholder="인증번호 입력"></p>
					<a href="#1">확인</a>
				</div-->
				<div class="input check">
					<p><input type="checkbox" name="mb_sms" id="c1_1" value="1" <?if($member[mb_sms]=="1") echo "checked";?>><label for="c1_1"> SMS 수신 동의</label></p>
				</div>
				<p class="exp">EASYBUSY에서 제공하는 서비스 안내 및 이벤트 소식을 받으실 수 있습니다.</p>
			</li>
		</ul>
		
		<div class="btn1">
			<a href="javascript:gosave();">휴대폰번호 변경</a>
		</div>
</form>
	</section>
	<iframe name="FrmHid" id="FrmHid" src="" width=0 height=0></iframe>	
</body>
</html>