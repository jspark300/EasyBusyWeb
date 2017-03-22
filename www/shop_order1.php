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
	<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

<script type="text/javascript">
	function order_complete()
	{
		if(trim(document.myorder.o_name.value) == "")
		{
			alert('주문자명을 입력해 주세요.');
			document.myorder.o_name.focus();
			return;
		}
		if(trim(document.myorder.tel1.value) == "")
		{
			alert('연락처를 입력해 주세요.');
			document.myorder.tel1.focus();
			return;
		}
		if(trim(document.myorder.tel2.value) == "")
		{
			alert('연락처를 입력해 주세요.');
			document.myorder.tel2.focus();
			return;
		}
		if(trim(document.myorder.tel3.value) == "")
		{
			alert('연락처를 입력해 주세요.');
			document.myorder.tel3.focus();
			return;
		}

		if(isNaN(document.myorder.tel1.value) == true)
		{
			alert('연락처는 숫자로 입력해 주세요');
			document.myorder.tel1.focus();
			return;
		}
		if(isNaN(document.myorder.tel2.value) == true)
		{
			alert('연락처는 숫자로 입력해 주세요');
			document.myorder.tel2.focus();
			return;
		}
		if(isNaN(document.myorder.tel3.value) == true)
		{
			alert('연락처는 숫자로 입력해 주세요');
			document.myorder.tel3.focus();
			return;
		}
		if(trim(document.myorder.address1.value) =="" || trim(document.myorder.address2.value)=="")
		{
			alert('주소를 입력해 주세요');
			return;
		}
		if(document.myorder.r1[0].checked == false && document.myorder.r1[1].checked == false)
		{
			alert('결제수단을 선택해 주세요');
			return;
		}
		document.myorder.submit();
		
	}
	function trim(str)
	{
		return str.replace(/^\s*|\s*$/g,"");
	}
	function del_sub(sub_id)
	{
		document.del_menu.sub_id.value = sub_id;
		document.del_menu.submit();

	}

</script>
<script>
<!--
function findad() {
	new daum.Postcode({
		oncomplete: function(data) {
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

        // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
        if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
            fullAddr = data.roadAddress;

        } else { // 사용자가 지번 주소를 선택했을 경우(J)
            fullAddr = data.jibunAddress;
        }
		   // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				extraAddr = (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}
			document.myorder.mb_zip.value = data.zonecode;
			document.myorder.address1.value = fullAddr;
			document.myorder.address3.value = extraAddr;
			document.myorder.mb_addr_jibeon.value = data.userSelectedType;
			document.myorder.address2.focus();		
		}
	}).open();
}
//-->
</script>
</head>
<body>
<?
include_once('header.php');
?>

<?
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

$sql = "select * ".$dist."  from t_comp where id=$com_id";
$res = sql_fetch($sql);

?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>주문하기</p>
		</div>
	</header>

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
<? } ?>
		</table>
		<form name="del_menu" method="post" charset="utf-8" action="order_del_ok.php">
			<input type="hidden" name="com_id" value="<?=$com_id?>">
			<input type="hidden" name="order_id" value="<?=$order_id?>">
			<input type="hidden" name="sub_id">
			<input type="hidden" name="url" value="shop_order1.php">
		</form>

	</section>
	<section class="shop_menulist">
		<form name="myorder" method="post" charset="utf-8" action="shop_order2.php">
		<input type="hidden" name="mb_addr_jibeon">
		<input type="hidden" name="com_id" value="<?=$com_id?>">
		<input type="hidden" name="order_id" value="<?=$order_id?>">
		<ul class="input_wrap">
			<li>
				<p class="tit_txt">● 주문자명</p>
				<div class="input name">
					<input type="text" name="o_name" placeholder="주문자명 입력"  value="<?=$member[mb_name]?>">
				</div>
			</li>
			<li>
				<p class="tit_txt">● 연락처</p>
				<div class="input tel">
<? if($member[mb_tel]!="") {
		$ar = explode("-",$member[mb_tel]);

	
}?>
					<span><input type="tel" name="tel1" value="<?=$ar[0]?>"> - </span>
					<span><input type="tel" name="tel2" value="<?=$ar[1]?>"> - </span>
					<span><input type="tel" name="tel3" value="<?=$ar[2]?>"></span>
				</div>
			</li>
			<li>
				<p class="tit_txt">● 배달받을 주소</p>
				<div class="input">
					<p><input type="text" placeholder="" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" readonly></p> <a href="javascript:findad();">주소검색</a>
					<input type="text" placeholder="기본주소" name="address1" value="<?=$member[mb_addr1]?>">
					<input type="text" placeholder="상세주소" name="address2" value="<?=$member[mb_addr2]?>">
					<input type="text" placeholder="참고항목" name="address3" value="<?=$member[mb_addr3]?>">
				</div>
			</li>
			<li>
				<p class="tit_txt">● 결제수단 선택</p>
				<div class="input radio">
					<input type="radio" name="r1" id="r1_1" value="현금"> <label for="r1_1">현금</label>
					<input type="radio" name="r1" id="r1_2" value="카드"> <label for="r1_2">신용카드</label>
				</div>
			</li>
			<li>
				<p class="tit_txt">● 주문 요청사항</p>
				<div class="input">
					<textarea name="memo"></textarea>
				</div>
			</li>
		</ul>
		<div class="btn1">
			<a href="javascript:order_complete();">주문하기</a>
		</div>
		</form>
	</section>
</body>
</html>