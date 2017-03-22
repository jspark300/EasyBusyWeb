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
	function savemenu()
	{
		if(trim(document.reg.menuname.value) == "")
		{
			alert('메뉴명을 입력해 주세요.');
			document.reg.menuname.focus();
			return;
		}
		if(trim(document.reg.price.value) == "")
		{
			alert('가격을 입력해 주세요.');
			document.reg.price.focus();
			return;
		}
		if(isNaN(document.reg.price.value) == true)
		{
			alert('가격은 숫자로 입력해 주세요');
			document.reg.price.focus();
			return;
		}
		document.reg.submit();
		
	}
	function trim(str)
	{
		return str.replace(/^\s*|\s*$/g,"");
	}
	function menu_sel(id,count)
	{
		var i = parseInt(eval("document.menu.menu"+id+".value")) + parseInt(count);
		if(i>0)
			eval("document.menu.menu"+id+".value=i");
//		alert(eval("document.menu.menu"+id+".value"));
	}
	function choice_menu(menu_id,menu_order)
	{
		var i = parseInt(eval("document.menu.menu"+menu_order+".value"));
		document.menu.menu_id.value = menu_id;
		document.menu.menu_count.value = i;
		if(document.menu.menu_count.value<=0)
		{
			alert('메뉴를 1개 이상 선택해 주세요');
			return;
		}
		document.menu.submit();

	}
	function del_sub(sub_id)
	{
		document.del_menu.sub_id.value = sub_id;
		document.del_menu.submit();

	}

</script>
</head>
<body>
<?
//include_once('header.php');
?>
<?
include_once('./_common.php');

$sql = "select * ".$dist."  from t_comp where id=$id";
$res = sql_fetch($sql);

if($res[order_tel_st]!="" || $res[order_sms_st]!="" )
	$order_st = "이 업체는 바로 주문이 가능합니다.";
else
	$order_st = "";

if($order_id == "")
	$order_id = time()."_".$id."_".rand(1000,9999);
?>

	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p><?=$res[name]?></p>
		</div>
	</header>

	<section class="shop_orderinfo">
		<p class="tit_txt"><?=$order_st?></p>
	</section>
	<!--section class="shop_orderlist">
		<h2>주문내역</h2>
		
<?
	$sql = "select * from t_com_order where order_id='$order_id'";
	$rs = sql_fetch($sql);
	if($rs)
	{
?>
		<table class="tbl1">
			<tfoot>
				<tr>
					<td>주문금액</td>
					<td></td>
					<td><?=number_format($rs[price])?>원</td>
					<td></td>
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
					<td><a href="javascript:del_sub(<?=$row[id]?>);" class="btn_delete" title="삭제">×</a></td>
				</tr>
			<?}?>
				
			</tbody>
		</table>
		<div class="btn1">
			<a href="shop_order1.php?com_id=<?=$id?>&order_id=<?=$order_id?>">주문하기</a>
		</div>
<? } ?>
		<form name="del_menu" method="post" charset="utf-8" action="order_del_ok.php">
			<input type="hidden" name="com_id" value="<?=$id?>">
			<input type="hidden" name="order_id" value="<?=$order_id?>">
			<input type="hidden" name="sub_id">
		</form>
	</section-->
	<section class="shop_menulist">
		<form name="menu" method="post" charset="utf-8" action="order_write_ok.php">
		<input type="hidden" name="com_id" value="<?=$id?>">
		<input type="hidden" name="order_id" value="<?=$order_id?>">
		<input type="hidden" name="menu_id">
		<input type="hidden" name="menu_count">


		<h2>메뉴</h2>
		<table class="tbl2">
			<tbody>
<?
$sql = "select * from t_com_menu where com_id=$id order by sorder,id";
$rs = sql_query($sql);
 for($i=0; $row=sql_fetch_array($rs); $i++) {

?>
				<tr>
					<td><?=$row[name]?></td>
					<td><?=number_format($row[price])?>원</td>
					<!--td><a class="btn_num" href="javascript:menu_sel(<?=$i?>,-1);">-</a><input type="number" name="menu<?=$i?>" value="1"><a class="btn_num" href="javascript:menu_sel(<?=$i?>,1);">+</a></td>
					<td><a class="btn_choice" href="javascript:choice_menu(<?=$row[id]?>,<?=$i?>);">선택</a></td-->
				</tr>
<? }
	if($i==0)
	{
?>
				<tr>
					<td>등록된 메뉴가 없습니다.</td>
					
				</tr>
				
<? } ?>
			</tbody>
		</table>
	</form>
	</section>
<?
//if($res[own_id] == $member[mb_id]) {
	if($member[mb_level]>3) {
?>
	<section class="shop_menulist">
		<h2>메뉴입력(영업회원, 관리자)</h2>
	<form name="reg" method="post" charset="utf-8" action="menu_write_ok.php">
		<input type="hidden" name="com_id" value="<?=$id?>">
		<ul class="input_wrap">
			<li>
				<p class="tit_txt">● 메뉴명</p>
				<div class="input">
					<input type="text" name="menuname" placeholder="메뉴명 입력">
				</div>
			</li>
			<li>
				<p class="tit_txt">● 가격</p>
				<div class="input">
					<input type="text" name="price" placeholder="가격 입력">
				</div>
			</li>
			
		</ul>
		<div class="btn1">
			<a href="javascript:savemenu();">메뉴입력하기</a>
		</div>
	</form>
	</section>
<? } ?>
</body>
</html>