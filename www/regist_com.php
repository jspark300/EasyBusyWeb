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
		if(reg_com.com_id.value == "")
		{
			alert('업체를 선택해 주세요');
			return;
		}

		if(trim(reg_com.ceo.value) == "")
		{
			alert('대표자를 입력해 주세요');
			reg_com.ceo.focus();
			return;
		}
		if(trim(reg_com.tel.value) == "")
		{
			alert('연락처를 입력해 주세요');
			reg_com.tel.focus();
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
			<p>업체회원신청</p>
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

$sql = "select id,name from t_comp where reg_id='".$member[mb_id]."' or own_id='".$member[mb_id]."' order by modify_date desc";
$ba_result = sql_query($sql);
$str = "<option value='' selected>선택";
$i = 0;
while ($row=sql_fetch_array($ba_result)) {
	++$i;
	if($rx[com_id]==$row[id])
		$str .= "<option value='".$row['id']."' selected>".$row['name'];
	else
		$str .= "<option value='".$row['id']."' >".$row['name'];

}
if($i==0)
	$com_msg = "(* 업체등록을 먼저 해 주세요.)";

?>
	<section class="member_wrap">
<form name="reg_com" method="post" charset="utf-8" action="regist_pay.php"   >
		<ul class="input_wrap">
			<li>
				<p class="tit_txt">● 업체선택<?=$com_msg?></p>
				<div class="input com">
					<span>
						<select name="com_id">
							<?=$str?>
						</select>
					</span>
				</div>
			</li>			<li>
				<p class="tit_txt">● 대표자명</p>
				<div class="input">
					<input type="text" name="ceo" placeholder="대표자명 입력" value="<?=$rx[ceo]?>">
				</div>
			</li>
			<li>
				<p class="tit_txt">● 연락처(연락가능한 전화번호를 입력해 주세요.)</p>
				<div class="input">
					<input type="tel" name="tel" placeholder="전화번호"  value="<?=$rx[tel]?>">
				</div>
			</li>
			<li>
				<p class="tit_txt">● 배달주문수신전화번호(입력시 전화주문가능 업체로 등록됩니다.)</p>
				<div class="input">
					<input type="tel" name="tel_delivery" placeholder="배달주문전화번호"  value="<?=$rx[tel_delivery]?>">
				</div>
			</li>
			<li>
				<p class="tit_txt">● 배달주문SMS수신번호(입력시 SMS주문가능 업체로 등록됩니다.)</p>
				<div class="input">
					<input type="tel" name="tel_sms" placeholder="배달주문SMS"  value="<?=$rx[tel_sms]?>">
				</div>
			</li>
						
			<!--li>
				<p class="tit_txt">● 문자사용</p>
				<div class="input check">
					<p><input type="checkbox" name="c1" id="c1_1"><label for="c1_1"> 문자사용하기</label></p>
				</div>
				<p class="exp">문자서비스는 회원이 주문시 50원씩 비용이 발생합니다.</p>
			</li -->
		</ul>
		<div class="btn1">
			<a href="javascript:reg_shopmember();">업체회원 신청</a>
			<a href="my_index.php">취소</a>
		</div>
</form>
	</section>
</body>
</html>