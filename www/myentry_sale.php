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
		if(trim(document.give_con.sale_price.value) == "")
		{
			alert('판매 희망 가격을 입력해 주세요.');
			document.give_con.sale_price.focus();
			return;
		}

		if(isNaN(document.give_con.sale_price.value) == true)
		{
			alert('가격은 숫자로 입력해 주세요');
			document.give_con.sale_price.focus();
			return;
		}
		if(confirm('경품몰에 경품을 등록하시겠습니까? 등록후에는 사용이 제한됩니다.'))
		{
			document.give_con.submit();
		}
		
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
			<p>경품몰에 팔기</p>
		</div>
	</header>
<?
include_once('./_common.php');

// 당첨 검색
$sql = "select count(id) c   from t_give where id=$id and lot_mb_no=$member[mb_no] and status=1";
$res = sql_fetch($sql);
$give_count = $res[c];
if($give_count == 0)
{
	echo "<script>alert('당첨된 경품이 없습니다.');history.back();</script>";
	exit;
}
$sql = "select datediff(date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY),now()) gr  from t_give where id=$id and status=1";
$res = sql_fetch($sql);
$last_count = $res[gr];
if($last_count < 0)
{
	echo "<script>alert('당첨된 경품이 유효기간이 지났습니다.');history.back();</script>";
	exit;
}

$sql = "select *, date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY) last_date,  datediff(date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY),now()) gr,date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY) va_date from t_give where id=$id";
$give = sql_fetch($sql);
$sql = "select name,addr_s from t_comp where id=$give[com_id]";
$com = sql_fetch($sql);

?>
	<form name="give_con" method="post" charset="utf-8" action="myentry_sale_db.php">
	<input type="hidden" name="ca_id" value="">
	<input type="hidden" name="id" value="<?=$id?>">
	<section class="myentry">
		<ul class="list2">
			<li>
				<p class="tit_txt">● 판매할 경품</p>
				<div class="exp_txt"><?=$give[name]?> (<?=$com[name]?>)<br>
				(유효기간 : ~<?=$give[va_date]?>)<br>
				주소 : <?=$com[addr_s]?>
				</div>
			</li>
			<li>
				<p class="tit_txt">● 판매 희망 가격</p>
				<div class="exp_txt">
					<p><input type="number" name="sale_price"> 원</p>
					<p class="mt10"><em>최대판매금액 : <?=number_format($give[price])?>원</em></p>
				</div>
			</li>
		</ul>
		<ul class="list1">
			<li>- 최대금액 이상으로는 경품을 판매할 수 없습니다.</li>
			<li>- 경품의 유효기간이 초과하는 경우 자동으로 판매가 중단되며, 경품은 기부됩니다.</li>
			<li>- 판매 신청한 경품은 판매 완료될 때까지 사용하실 수 없습니다.</li>
			<li>- 판매수수료는 판매금액의 10%입니다.</li>
		</ul>
		<div class="btn2">
			<a href="javascript:gosave();">판매하기</a>
		</div>
	</section>
	</form>
</body>
</html>