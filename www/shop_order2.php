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
</head>
<body>
<?
include_once('header.php');
?>

<?
include_once('./_common.php');

$sql = "select * ".$dist."  from t_comp where id=$com_id";
$res = sql_fetch($sql);


$sql = "select * from t_com_order  where order_id='$order_id' and mb_no=$member[mb_no]";
$rs = sql_fetch($sql);
$t = time();


if($rs)
{
	if($rs[price]<=0)
	{
		echo "<script>alert('0원 이하는 주문이 불가능합니다. 메뉴를 선택해 주세요.');location.href='shop_detail.php?id=$com_id'</script>";
		exit;
	}
	$tel = $tel1."-".$tel2."-".$tel3;
	$add = $address1. " ". $address2." ".$address3;
	$sql = "update t_com_order set otype='$r1',reg_date=$t, name='$o_name',tel='$tel',address='$add', memo='$memo',status=1 where order_id='$order_id' and mb_no=$member[mb_no]";
	sql_query($sql);

	$sql = "select count(id) c from t_give_point_use where order_id='$order_id'";
	$purs = sql_fetch($sql);
	if($purs[c]==0)
	{
		// 포인트 로그 입력
		$sql = "insert into t_give_point_use (point_name,point_use, point,status,reg_date,mb_no,order_id) values ('주문','$rs[name]',10,1,$t,$member[mb_no],'$order_id')";
		sql_query($sql);
		// 회원정보에 포인트 +10
		$sql = "update g5_member set give_point=give_point+10 where mb_no=$member[mb_no]";
		sql_query($sql);
	}

}

?>

	<header class="header2">
		<div class="btn_back"></div>
		<div class="txt_tit">
			<p>주문완료</p>
		</div>
	</header>

	<section class="shop_orderinfo">
		<span class="icon"></span>
		<div class="tit_txt">주문이 완료되었습니다.</div>
		<ul class="exp">
			<li>● 업체명 : <?=$res[name]?></li>
			<li>● 주문일자 : <?=date("Y-m-d",$rs[reg_date])?> (<?=date("H:i:s",$rs[reg_date])?>)</li>
		</ul>
	</section>
	<section class="shop_orderlist">
		<h2>주문내역</h2>
		<table class="tbl1">
<?
	$sql = "select * from t_com_order where order_id='$order_id'";
	$rs = sql_fetch($sql);
	if($rs)
	{
?>
			<tfoot>
				<tr>
					<td>주문금액</td>
					<td></td>
					<td><?=number_format($rs[price])?>원</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4"><?=$rs[address]?><br><?=$rs[name]?><br><?=$rs[tel]?></td>
				</tr>
				<tr>
					<td colspan="4"><?=nl2br($rs[memo])?></td>
				</tr>
			</tfoot>
			<tbody>
			<?
			$sql = "select * from t_com_order_sub where order_id='$order_id'";
			$srs = sql_query($sql);
			for($i=0; $row=sql_fetch_array($srs); $i++) {
			?>
				<tr>
					<td><?=$row[menu_name]?></td>
					<td><?=$row[ocount]?>개</td>
					<td><?=number_format($row[price]*$row[ocount])?>원</td>
					<td></td>
				</tr>
			<?}?>
				
				
			</tbody>
<? } ?>
		</table>

	</section>
	<section class="shop_orderconfirm">
		<div class="d1">
			<span>구매 보상</span> <strong>경품응모권 10장</strong>이 추가되었습니다.
		</div>
		<div class="btn1">
			
			<a href="myorder.php">주문내역확인</a><a href="shop_list.php">메인</a>
		</div>
	</section>
	<!--section class="banner">
		<div>banner</div>
	</section-->
</body>
</html>