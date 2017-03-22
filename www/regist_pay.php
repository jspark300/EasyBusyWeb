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
	function reg_shopmember()
	{
		if(reg_com.pay_sel.value == "")
		{
			alert('입금금액을 선택해 주세요');
			return;
		}
		if(reg_com.pay_bank.value == "")
		{
			alert('입금계좌를 선택해 주세요');
			return;
		}

	

		reg_com.submit();
	}

	function trim(str)
	{
		return str.replace(/^\s*|\s*$/g,"");
	}
</script>

</head>
<body>
	<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>회원업체 결제</p>
		</div>
	</header>
<?
include_once('./_common.php');
if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$sql = "select * from t_com_member_ask where mb_no='$member[mb_no]'";
$rx = sql_fetch($sql);

?>
	<section class="member_wrap">
<form name="reg_com" method="post" charset="utf-8" action="regist_pay_db.php"   >
<input type="hidden" name="id"  value="<?=$rx[id]?>">
<input type="hidden" name="com_id"  value="<?=$com_id?>">
<input type="hidden" name="ceo"  value="<?=$ceo?>">
<input type="hidden" name="tel"  value="<?=$tel?>">
<input type="hidden" name="tel_delivery"  value="<?=$tel_delivery?>">
<input type="hidden" name="tel_sms"  value="<?=$tel_sms?>">
		<ul class="input_wrap">
			<li>
				<p class="tit_txt">● 입금금액</p>
				<div class="input ymd">
					<select name="pay_sel">
						<option value="">선택</option>
						<option value="100000" <?if($rx[pay_sel]=="100000") echo "selected";?>>[얼리버드] 100,000</option>
						<option value="300000" <?if($rx[pay_sel]=="300000") echo "selected";?>>[정상가] 300,000</option>
						<option value="400000" <?if($rx[pay_sel]=="400000") echo "selected";?>>[스페셜] 400,000</option>
					</select>
				</div>
			</li>
			<li>
				<p class="tit_txt">● 입금계좌</p>
				<div class="input ymd">
					<select name="pay_bank">
						<option value="">선택</option>
						<option value="[농협] 123-4567-45-78945"  <?if($rx[pay_bank]=="[농협] 123-4567-45-78945") echo "selected";?>>[농협] 123-4567-45-78945</option>
						<option value="[국민은행] 894561-456-23456" <?if($rx[pay_bank]=="[국민은행] 894561-456-23456") echo "selected";?>>[국민은행] 894561-456-23456</option>
						<option value="[우리은행] 123445-786-45612" <?if($rx[pay_bank]=="[우리은행] 123445-786-45612") echo "selected";?>>[우리은행] 123445-786-45612</option>
					</select>
				</div>
			</li>
			<li>
				<p class="tit_txt">● 동맹계약서</p>
				<div class="btn4">
					<a href="#1">동맹계약서 보기</a>
				</div>
			</li>
		</ul>		
		<div class="btn1">
			<a href="javascript:reg_shopmember()">광고회원업체 신청</a>
			<a href="my_index.php">취소</a>
		</div>
</form>
	</section>
</body>
</html>