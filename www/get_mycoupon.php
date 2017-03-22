<?
include_once('./_common.php');
$start = $count;
if($st == "0")
	$where = " and (lot_mb_no=$member[mb_no] and status=2) or (gift_mb_no=$member[mb_no] and status=110)";
else if($st == "1")
	$where = " and (lot_mb_no=$member[mb_no] or gift_mb_no=$member[mb_no]) and status=100)";
else
	$where = " and (lot_mb_no=$member[mb_no] and (status=2 or status=100)) or (gift_mb_no=$member[mb_no] and (status=110 or status=100))";

$sql = "select *,(select name from t_comp b where b.id=a.com_id) company,date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY) va_date from t_give a where 1 $where order by id desc limit ".$start.", 10";
$res = sql_query($sql);
for($i=0; $row=sql_fetch_array($res); $i++) {

?>
			<li>
						
					<div class="d1"><?=date("Y-m-d",$row[gift_reg_date])?></div>
					<dl>
						<dt>
							<p class="tit"><?=$row[company]?></p>
						</dt>
						<dd>
							<p><?=$row[name]?></p>
						</dd>
						<dd>
							<p>당첨일 : <?=date("Y-m-d",$row[lot_date])?></p>
						</dd>
					</dl>
					<? if($row[status]=="2") { ?>
					<div class="d2 notopen">
						<p><a href="mycoupon.php?id=<?=$row[id]?>"><strong>쿠폰보기</strong></a></p>
						<p>유효기간<br><?=$row[va_date]?></p>
					</div>				
					<? } else if($row[status]=="110") { ?>
					<div class="d2  notopen">
						<p><a href="mycoupon.php?id=<?=$row[id]?>"><strong>쿠폰보기</strong></a></p>
						<p>유효기간<br><?=$row[va_date]?></p>
					</div>				
		
					<? } else if($row[status]=="100") {  ?>
					<div class="d2">
						<p>사용완료</p>
						<p>사용일<br><?=date("Y-m-d",$row[use_date])?></p>
					</div>				
					<? } ?>
			</li>

<? }
if($i==0)
	echo "0";
?>
