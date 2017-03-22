<?
include_once('./_common.php');
$start = $count;

if($com_id==0)
	$where = "";
else
	$where = " and com_id = '$com_id' ";


if($t != 0)
	$wh = " status=$t";
else
	$wh = " status > 0";
$sql = "select * ,(select name from t_comp where id=com_id) comstr  from t_com_order where $wh $where order by id desc limit $start, 10";
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
<? } 
if($i==0)
	echo "0";
?>