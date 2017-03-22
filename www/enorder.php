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
	function order_st(id,st)
	{
		var strx = "";
		if(st=="2")
			strx = "주문확인으로";
		else if(st=="3")
			strx = "배달중으로";
		else if(st =="4")
			strx = "배달완료로";
		if(confirm('주문의 상태를 '+strx+' 변경하시겠습니까?'))
		{
			document.order_c.id.value = id;
			document.order_c.st.value = st;
			document.order_c.listcount.value = listcount;
			document.order_c.submit();
		}
	}	
</script>
</head>
<body>
<? include_once('./header.php');?>
<?
include_once('./_common.php');
$sql = "select name from t_comp where id=$id";
$res = sql_fetch($sql);
$com_name = $res[name];
if($id==0)
	$com_name = "전체업체"
?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p><?=$com_name?> 고객주문내역</p>
		</div>
	</header>

		<?




if($member[mb_level]!=10)
{
	echo "<script>alert('관리권한이 필요합니다.');history.back();</script>";
	exit;
}

if($id==0)
	$where = "1";
else
	$where = " com_id = '$id' ";

// 전체주문
$sql = "select count(id) c  from t_com_order where  status>0 and ($where)";
$rx_c = sql_fetch($sql);
$order_count1 = $rx_c[c];
// 주문완료
$sql = "select count(id) c  from t_com_order where status=1 and ($where)";
$rx_c = sql_fetch($sql);
$order_count2 = $rx_c[c];
// 주문확인
$sql = "select count(id) c  from t_com_order where status=2 and ($where)";
$rx_c = sql_fetch($sql);
$order_count3 = $rx_c[c];
// 배달중
$sql = "select count(id) c  from t_com_order where status=3 and ($where)";
$rx_c = sql_fetch($sql);
$order_count4 = $rx_c[c];
// 배달완료
$sql = "select count(id) c  from t_com_order where status=4 and ($where)";
$rx_c = sql_fetch($sql);
$order_count5 = $rx_c[c];
?>
	<section class="entry_info2">
		<div class="d1">
			<ul>
				<li>전체 <strong><?=$order_count1?></strong></li>
				<li>주문 <strong><?=$order_count2?></strong></li>
				<li>준비중 <strong><?=$order_count3?></strong></li>
				<li>배달중 <strong><?=$order_count4?></strong></li>
				<li>배달완료 <strong><?=$order_count5?></strong></li>
				
				
			</ul>
		</div>
		<div class="infobox1">
			주문관련 안내 :<br>
			주문해 주셔서 감사합니다.<br>
			안내글 입력이 필요합니다.
		</div>
	</section>
	<section class="search">
		<div class="tab_wrap">
			<ul class="u4">
				<li><a href="?t=0&id=<?=$id?>" <?if($t==0) { ?> class="on" <?}?>>전체</a></li>
				<li><a href="?t=1&id=<?=$id?>" <?if($t==1) { ?> class="on" <?}?>>주문</a></li>
				<li><a href="?t=2&id=<?=$id?>" <?if($t==2) { ?> class="on" <?}?>>준비중</a></li>
				<li><a href="?t=3&id=<?=$id?>" <?if($t==3) { ?> class="on" <?}?>>배달중</a></li>
				<li><a href="?t=4&id=<?=$id?>" <?if($t==4) { ?> class="on" <?}?>>배달완료</a></li>
				
			</ul>
		</div>
	</section>
	<section class="entry_list2">
		<ul id="listbody">
<?
if($t != 0)
	$wh = "status=$t  ";
else
	$wh = " status > 0  ";
if($listcount == "")
	$listc = 10;
else
	$listc = $listcount+10;
	
$sql = "select * ,(select name from t_comp where id=com_id) comstr  from t_com_order where  $wh and ($where) order by id desc limit $listc";
$res = sql_query($sql);
for($i=0; $row=sql_fetch_array($res); $i++) {
	$sql = "select *  from t_com_order_sub where order_id='$row[order_id]' order by id";
	$res_sub = sql_query($sql);
	$strmenu = "";
	for($k=0; $row_sub=sql_fetch_array($res_sub); $k++)
	{
		$strmenu .= $row_sub[menu_name] ." ".$row_sub[ocount]."개 / ";
	}
	if($row[status] == "1")
		$strorder = "주문";
	else if($row[status] == "2")
		$strorder = "주문>준비중";
	else if($row[status] == "3")
		$strorder = "주문>준비중>배달중";
	else if($row[status] == "4")
		$strorder = "주문>준비중>배달중>배달완료";	

?>

	<li>
					<dl>
						<dt>
							<p class="tit"><a href="/shop_detail.php?id=<?=$row[com_id]?>" target="_blank"><?=$row[comstr]?></a></p>
						</dt>
						<dd>
							<p style="font-weight:bold;">메뉴 : <?=$strmenu?></p>
						</dd>
						<dd>
							<p style="font-weight:bold;color:#1d8ade; ">주문상태 : <?=$strorder?></p>
						</dd>	
						<dd>
							<p style="font-weight:bold;">가격(결제방법) : <?=number_format($row[price])?>(<?=$row[otype]?>)</p>
						</dd>
						<dd>
							<p>전화번호 : <?=$row[tel]?></p>
						</dd>
						<dd>
							<p>주소 : <?=$row[address]?></p>
						</dd>					
						<dd>
							<p>주문요청사항 : <?=$row[memo]?></p>
						</dd>
						<dd>
							<p>주문일 : <?=apms_datetime($row['reg_date'], 'Y.m.d')?></p>
						</dd>
		
					</dl>
					<div class="d2 ">
						<p class="reply_btn">
							<a href="enorder.php?id=<?=$row[com_id]?>">업체주문내역</a>
							<a href="/shop_detail.php?id=<?=$row[com_id]?>">업체바로가기</a>
						</p>
					</div>
				
			</li>
<? } ?>
			
		</ul>
		<div class="btn_more"  id="lastlist"><a href="javascript:addlist();">더보기</a></div>
	</section>
<form name="order_c" method="post" charset="utf-8" action="comorder_st.php">
						<input type="hidden" name="id" >
						<input type="hidden" name="st">
						<input type="hidden" name="ost" value="<?=$t?>">
						<input type="hidden" name="listcount">
	
	</form>		
</body>
<script> 
  var listcount=<?=$listc-10?>; 

  function addlist(){ 
        listcount+=10; 
        $.post("/get_enorder.php",{"count" : listcount, "t":<?=$t?$t:0;?>, "com_id": <?=$id?>},function(data){ 
              var oldlist =  $("#listbody").html(); 
               if(trim(data).substring(0,1) != "0")
				$("#listbody").html(oldlist+data); 
			else
				$("#lastlist").html("<a href='javascript:addlist();'>마지막 목록입니다.</a>"); 
			
        });	
  } 
  
  function trim(str)
	{
		return str.replace(/^\s*|\s*$/g,"");
	}
</script> 

</html>