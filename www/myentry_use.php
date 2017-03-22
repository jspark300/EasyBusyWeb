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
	function shop_ceo_confirm()
	{
		if(confirm('쿠폰 사용확인을 완료하시겠습니까?\n사용확인을 하시면 더이상 쿠폰을 사용하실 수 없습니다.'))
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
			<p>사용방법 선택</p>
		</div>
	</header>
	<section class="infobox2">
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

// 사용하기 선택 status 2 업데이트
// 쿠폰 발행
$coupon = md5("ally".$give[name].$give[price].$give[start_date]);
$sql = "update t_give set status = 2,coupon='".$coupon ."' where id=$id and lot_mb_no=$member[mb_no] and status=1";
sql_query($sql);
$sql = "update t_give_enter set status = 2 where give_id=$id and mb_no=$member[mb_no] and status=1 ";
sql_query($sql);

$sql = "select *, date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY) last_date,  datediff(date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY),now()) gr,date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY) va_date from t_give where id=$id";
$give = sql_fetch($sql);
$sql = "select name,addr_s from t_comp where id=$give[com_id]";
$com = sql_fetch($sql);

?>

		<div>
			<dl>
				<dt>이지비지쿠폰</dt>
				<dd>
					
					<p>업체명 : <?=$com[name]?></p>
					<p>경품명 : <?=$give[name]?> (<?=number_format($give[price])?>원 상당)</p>
					<p>위치 : <?=$com[addr_s]?> </p>
					<p>쿠폰번호 : <?=$give[coupon]?></p>
					<p>유효기간 : <?=$give[va_date]?></p>
					<?if($give[status]==100) {?>
					<p>사용일자 : <?=$give[use_date]?></p>
					<? } ?>
					<p>상태 : <?
									if($give[status]==2) 
										echo "미사용"; 
									else if($give[status]==5)
										echo "기부완료";
									else if($give[status]>5 && $give[status]<99)
										echo "유효기간지남";
									else if($give[status]==100) 
										echo "사용완료";
								
								
								?></p>
				</dd>
			</dl>
		</div>
	</section>
	<section class="myentry">
		
		<ul class="btn3">
			<li><a href="javascript:shop_ceo_confirm();">주인장확인(쿠폰사용완료하기)</a></li>
			<li><a href="myentry_list.php">닫기</a></li>
			
		</ul>
		<ul class="exp_txt2 mt10">
			<li>유효기간 이내에 사용하셔야 합니다.</li>
			<li>주문하기전에 쿠폰을 제시하셔야 사용가능합니다.</li>
			<li>쿠폰사용가능횟수는 1회입니다.</li>
			<li>주인장확인(쿠폰사용완료하기)을 누르시면 더 이상 쿠폰을 사용하실 수 없습니다.</li>
		</ul>
	</section>
	<form name="give_con" method="post" charset="utf-8" action="shop_ceo_coupon_confirm.php">
	<input type="hidden" name="id" value="<?=$id?>">
	</form>

</body>
</html>