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
		if(confirm('입력하신 내용으로 선물하기 이메일을 보내시겠습니까?\n받는분 이메일 <<?=$recv_email?>> 을 다시한번 확인해 주세요.'))
		{
			document.give_con.submit();
		}
	}
</script>
</head>
<body>
	<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>선물하기</p>
		</div>
	</header>
<?
include_once('./_common.php');

// 당첨 검색
$sql = "select count(id) c   from t_give_enter where mb_no=$member[mb_no] and give_id=$id ";
$res = sql_fetch($sql);
$give_count = $res[c];
if($give_count == 0)
{
	echo "<script>alert('당첨된 경품이 없습니다.');history.back();</script>";
	exit;
}
$sql = "select *, date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY) last_date,  datediff(date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY),now()) gr, date_add(now(), INTERVAL 8 DAY) gift_send_date from t_give where id=$id";
$give = sql_fetch($sql);
$sql = "select name,addr_s from t_comp where id=$give[com_id]";
$com = sql_fetch($sql);


?>


<form name="give_con" method="post" charset="utf-8" action="myentry_gift_send.php">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="send_name" value="<?=$send_name?>">
	<input type="hidden" name="send_email" value="<?=$send_email?>">
	<input type="hidden" name="recv_email" value="<?=$recv_email?>">
	<input type="hidden" name="msg" value="<?=$msg?>">
	<input type="hidden" name="id" value="<?=$id?>">
	
	<section class="myentry">
		<p class="tit_txt2">선물을 받는 분에게 아래와 같이 이메일로 전송됩니다.<br></p>
		<p class="tit_txt2"><font color='white'>. </font></p>
		<p class="tit_txt2">보내는분 : <?=$send_name?> <?=$send_email?></p>
		<p class="tit_txt2">받는분 : <?=$recv_email?></p>
		<div class="infobox2">
			<p>[메세지 제목]</p>
			<p><?=$send_name?>님께서 올리올 서비스를 통해 경품을 선물하셨습니다.</p>
			<p>[메세지 내용]</p>
			<p>
				<strong><?=nl2br($msg)?></strong><br><br>
			</p>
			<p>
				경품명 : <?=$give[name]?><?=$com[name]?><br>
				업체명 : <?=$com[name]?><br>
				업체주소 : <?=$com[addr_s]?><br>
				등록유효기간 : <?=$give[gift_send_date]?><br>
				쿠폰번호 :<strong> 자동생성</strong>
			</p>
			<p><strong><?=$give[gift_send_date]?></strong>까지 올리올앱에서 쿠폰을 등력하셔야 합니다. 미등록 시 자동 기부 처리됩니다.</p>
			
			

		</div>
		<div class="btn2">
			<a href="javascript:gosave();">선물하기</a>
		</div>
	</section>
</form>
</body>
</html>