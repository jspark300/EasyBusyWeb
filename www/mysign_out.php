<?
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

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
<script type="text/javascript">
	function expire()
	{	
        if (!document.exp.mb_password.value || document.exp.mb_password.value == "") {
            alert("비밀번호를 입력해 주세요");
            document.exp.mb_password.focus();
            return;
        }
		if(document.exp.c1.checked == false)
		{
			alert('동의합니다에 체크해 주세요.');
			return;
		}
		document.exp.submit();
	}
</script>

</head>
<body>
	<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>회원 탈퇴</p>
		</div>
	</header>
	<section class="myentry">
		<div class="exp_txt2">
			<strong>회원탈퇴를 하시기 전에 아래의 유의사항을 확인해 주세요</strong>
		</div>
		<div class="infobox1 left">
			<ul>
				<li>
					<p class="tit_txt">계정 사용 중지</p>
					<p>
						회원님께서 가입하셨던 아래의 이메일(아이디) 계정은 탈퇴 처리되며, 다시 EASYBUSY을 사용하시기 위해서는 다른 이메일(아이디) 계정으로 가입하셔야 합니다.
						<span>탈퇴 이메일(아이디)  : <strong><?=$member[mb_id]?></strong></span>
					</p>
				</li>
				<li class="mt20">
					<p class="tit_txt">당첨된 경품 처리</p>
					<p>
						사용하지 않은 경품은 삭제됩니다.<br>
						응모하신 경품이 회원탈퇴 이후 당첨되신 경우에도 삭제됩니다.
					</p>
				</li>
			</ul>
		</div>		
	</section>
	<section class="member_wrap">
	<form name="exp" method="post" charset="utf-8" action="member_expire_ok.php">
		<ul class="input_wrap">
			<li>
				<h2 class="tit_txt">
				● 회원님의 비밀번호를 입력해 주세요
				</h2>
				<div class="input">
					<input type="password" name="mb_password" placeholder="비밀번호 입력">
				</div>
				<div class="input check">
					<input type="checkbox" name="c1" id="c1_1"><label for="c1_1"> 탈퇴시 유의사항을 확인하였으며, 이에 동의합니다</label>
				</div>
			</li>
		</ul>
		
		<div class="btn1">
			<a href="javascript:expire();">회원탈퇴</a>
			<a href="/">취소</a>
		</div>
	</form>
	</section>
</body>
</html>