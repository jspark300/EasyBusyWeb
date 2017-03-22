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
	function select_use(st)
	{
		if(st=='1')
		{
			if(confirm('당첨된 경품을 사용하기를 선택하셨습니다. \n사용하기 선택 후에는 경품몰에 판매, 기부, 선물하기는 선택할 수 없습니다. \n계속 진행하시겠습니까?'))
			{
				document.give_con.action = "myentry_use.php";
				document.give_con.submit();
			}
		}
		else if (st=='2')
		{
		//	if(confirm('당첨된 경품을 경품몰에 팔기를 선택하셨습니다. \n경품몰에 팔기 선택 후에는 사용, 기부, 선물하기는 선택할 수 없습니다. \n계속 진행하시겠습니까?'))
		//	{
				document.give_con.action = "myentry_sale.php";
				document.give_con.submit();
		//	}
		}
		else if (st=='3')
		{
			if(confirm('당첨된 경품을 기부하기를 선택하셨습니다. \n기부하기 선택 후에는 사용, 경품몰에 판매, 선물하기는 선택할 수 없습니다. \n계속 진행하시겠습니까?'))
			{
				document.give_con.action = "shop_donation_confirm.php";
				document.give_con.submit();
			}
		}
		else if (st=='4')
		{
			//if(confirm('당첨된 경품을 선물하기를 선택하셨습니다. \n선물하기 선택 후에는 사용, 경품몰에 판매, 기부하기는 선택할 수 없습니다. \n계속 진행하시겠습니까?'))
			//{
				document.give_con.action = "myentry_gift.php";
				document.give_con.submit();
			//}
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
$sql = "select count(id) c   from t_give_enter where mb_no=$member[mb_no] and give_id=$id ";
$res = sql_fetch($sql);
$give_count = $res[c];
if($give_count == 0)
{
	echo "<script>alert('당첨된 경품이 없습니다.');history.back();</script>";
	exit;
}
$sql = "select *, date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY) last_date,  datediff(date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY),now()) gr from t_give where id=$id";
$give = sql_fetch($sql);
$sql = "select name,addr_s from t_comp where id=$give[com_id]";
$com = sql_fetch($sql);


?>

		<div>
			<dl>
				<dt>경품 당첨을 축하합니다.</dt>
				<dd>
					<p>업체명 : <?=$com[name]?></p>
					<p>경품명 : <?=$give[name]?> (<?=number_format($give[price])?>원 상당)</p>
					<p>위치 : <?=$com[addr_s]?> </p>
				</dd>
			</dl>
		</div>
	</section>
	<section class="myentry">
		<div>
			<p class="tit_txt">● 사용방법 선택</p>
			<p class="exp_txt"><?=$give[last_date]?>까지 사용방법을 선택하셔야 합니다.<br>(<?=$give[gr]?>일 남았습니다.)</p>
		</div>
		<ul class="btn31">
			<li><a href="javascript:select_use(1);">사용하기</a></li>
			<!--li><a href="javascript:select_use(2);">경품몰에 팔기</a></li-->
			<li><a href="javascript:select_use(3);">기부하기</a></li>
			<li><a href="javascript:select_use(4);">선물하기</a></li>
		</ul>
		<ul class="exp_txt2 mt10">
			<li>사용하기 : 선택 후 유효기간 이내에 사용하셔야 합니다.</li>
			<!--li>경품몰에 팔기 : 경품을 경품몰에서 판매하실 수 있습니다.</li-->
			<li>기부하기 : 기부단체에 경품을 기부합니다.</li>
			<li>선물하기 : 다른 회원에게 경품을 선물합니다.</li>
		</ul>
	</section>
	<form name="give_con" method="post" charset="utf-8">
	<input type="hidden" name="id" value="<?=$id?>">
	</form>
</body>
</html>