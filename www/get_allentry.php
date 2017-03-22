<?
include_once('./_common.php');
$start = $count;

if($st == "")
	$where = "";
else if($st == "6")
	$where = " and status>5 and status<99";
else if($st == "3")
	$where = " and (status=3 or status=110)";
else
	$where = " and status=$st";

$sql = "select * ,(select name from t_comp b where b.id=a.com_id) company, datediff(date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY),now()) gr, date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY) va_date, date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY) va_date2 from t_give a where 1 $where  order by end_date desc limit $start, 10";
$res = sql_query($sql);
for($i=0; $give=sql_fetch_array($res); $i++) {
	$sql = "select * from g5_member where mb_no=$give[lot_mb_no]";
	$mbx = sql_fetch($sql);

	// 당첨확인 1주일 이후 자동기부(status=6)상태변경 
?>
			<li>
				
					<div class="d1">
					<?=substr($give[start_date],0,4)."-".substr($give[start_date],4,2)."-".substr($give[start_date],6,2)?><br>
					<?=substr($give[end_date],0,4)."-".substr($give[end_date],4,2)."-".substr($give[end_date],6,2)?></div>
					<dl>
						<dt>
							<p class="tit"><?=$give[company]?></p>
						</dt>
						<dd>
							<p><?=$give[name]?></p>
						</dd>
						<dd>
							<p>당첨자 : <?=$mbx[mb_id]?></p>
						</dd>
					</dl>
					<? if($give[status]=="1") { ?>
					<div class="d2 notopen">
						<p>당첨확인</p>
						<p><?=$give[gr]?>일 남음</p>
					</div>
					<? } else if($give[status]=="0") { ?>
					<div class="d2">
						<p>진행중</p>
						<p>마감일<br><?=substr($give[end_date],0,4)."-".substr($give[end_date],4,2)."-".substr($give[end_date],6,2)?></p>
					</div>				
					<? } else if($give[status]=="2") { ?>
					<div class="d2">
						<p><strong>미사용쿠폰</strong></p>
						<p>유효기간<br><?=$give[va_date]?></p>
					</div>				
					<? } else if($give[status]=="3") { ?>
					<div class="d2">
						<p>선물</p>
						<p>유효기간<br><?=$give[va_date]?></p>
					</div>				
					<? } else if($give[status]=="4") { ?>
					<div class="d2">
						<p>판매</p>
						<p>유효기간<br><?=$give[va_date]?></p>
					</div>				
					<? } else if($give[status]=="5") { ?>
					<div class="d2">
						<p>기부</p>
						<p>기부날자<br><?=date("Y-m-d",$give[use_date])?></p>
					</div>				
					<? } else if($give[status]==6) { ?>
					<div class="d2">
						<p>유효기간지남</p>
						<p>선택유효기간<br><?=$give[va_date2]?></p>
					</div>	
					<? } else if($row[status]>6 &&  $row[status]<99) { ?>
					<div class="d2">
						<p>유효기간지남</p>
						<p>사용유효기간<br><?=$give[va_date]?></p>
					</div>							
					<? } else if($give[status]=="-1") {  ?>
					<div class="d2">
						<p>미당첨</p>
						<p>마감일<br><?=substr($give[end_date],0,4)."-".substr($give[end_date],4,2)."-".substr($give[end_date],6,2)?></p>
					</div>				
					
					<? } else if($give[status]=="100") {  ?>
					<div class="d2">
						<p>사용완료</p>
						<p>사용일<br><?=date("Y-m-d",$give[use_date])?></p>
					</div>				
					<? } else if($give[status]=="110") {  ?>
					<div class="d2">
						<p>선물</p>
						<p>유효기간<br><?=$give[va_date]?></p>
					</div>				
					<? } ?>
			</li>

<?}
if($i==0)
	echo "0";
?>			