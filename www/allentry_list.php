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
	<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>전체경품내역</p>
		</div>
	</header>
	
<?
include_once('./_common.php');

if($member[mb_level]<10)
{
	echo "<script>alert('관리권한이 필요합니다.');history.back();</script>";
	exit;
}
// 총
$sql = "select count(id) c   from t_give ";
$res = sql_fetch($sql);
$total_give = $res[c];
// 당첨
$sql = "select count(id) c   from t_give where  status=1";
$res = sql_fetch($sql);
$elect_give = $res[c];
// 진행중
$sql = "select count(id) c   from t_give where status=0";
$res = sql_fetch($sql);
$ing_give = $res[c];
// 사용완료
$sql = "select count(id) c   from t_give where status=100";
$res = sql_fetch($sql);
$use_give = $res[c];
// 미사용
$sql = "select count(id) c   from t_give where status=2";
$res = sql_fetch($sql);
$notuse_give = $res[c];
// 선물
$sql = "select count(id) c   from t_give where status=3 or  status=110";
$res = sql_fetch($sql);
$gift_give = $res[c];

// 판매
$sql = "select count(id) c   from t_give where status=4";
$res = sql_fetch($sql);
$sale_give = $res[c];

// 기부
$sql = "select count(id) c   from t_give where status=5";
$res = sql_fetch($sql);
$donation_give = $res[c];
// 유효기간 지남
$sql = "select count(id) c   from t_give where status>5 and status<99";
$res = sql_fetch($sql);
$past_give = $res[c];
// 미당첨
$sql = "select count(id) c   from t_give where  status=-1";
$res = sql_fetch($sql);
$mi_give = $res[c];

?>
	
	<section class="entry_info">
		<div class="d1">
			<ul>
				<li>총 경품수 <strong><?=number_format($total_give)?></strong></li>
				<li>당첨미확인 <strong><?=number_format($elect_give)?></strong></li>
				<li>진행중 <strong><?=number_format($ing_give)?></strong></li>
				<li>사용완료 <strong><?=number_format($use_give)?></strong></li>
				
			</ul>
		</div>
		<div class="infobox1">
			추첨: 매일 오전10시 자동으로 추첨이 진행됩니다.<br>
			당첨일로부터 7일이내에 당첨확인 안하면 기부로 전환됩니다.<br>
			사용하기를 선택하신후 30일 이내에 사용안하면 기부로 전환됩니다.
		</div>
	</section>
	<section class="search">
		<div class="tab_wrap">
			<ul class="u2">
				<li><a href="?st=" <? if($st=="") { ?>class="on"<?}?>>전체[<?=number_format($total_give)?>]</a></li>
				<li><a href="?st=0" <? if($st=="0") { ?>class="on"<?}?>>진행중[<?=number_format($ing_give)?>]</a></li>
				<li><a href="?st=1" <? if($st=="1") { ?>class="on"<?}?>>당첨미확인[<?=number_format($elect_give)?>]</a></li>
				<li><a href="?st=2" <? if($st=="2") { ?>class="on"<?}?>>미사용쿠폰[<?=number_format($notuse_give)?>]</a></li>
				<li><a href="?st=100" <? if($st=="100") { ?>class="on"<?}?>>사용완료[<?=number_format($use_give)?>]</a></li>
				<li><a href="?st=4" <? if($st=="4") { ?>class="on"<?}?>>판매[<?=number_format($sale_give)?>]</a></li>
				<li><a href="?st=3" <? if($st=="3") { ?>class="on"<?}?>>선물[<?=number_format($gift_give)?>]</a></li>
				<li><a href="?st=5" <? if($st=="5") { ?>class="on"<?}?>>기부[<?=number_format($donation_give)?>]</a></li>
				<li><a href="?st=6" <? if($st=="6") { ?>class="on"<?}?>>유효기간지남[<?=number_format($past_give)?>]</a></li>
				<li><a href="?st=-1" <? if($st=="-1") { ?>class="on"<?}?>>미당첨[<?=number_format($mi_give)?>]</a></li>
			</ul>
		</div>
	</section>
	<section class="entry_list">
		<ul id="listbody">
			<li>
					
						<div class="d1">기간</div>
						<dl>
							<dt>
								경품내용
							</dt>
							
						</dl>
						<div class="d2">
							<p>상태</p>
							<p></p>
						</div>
			</li>
<?
$today = date("Ymd");

if($st == "")
	$where = "";
else if($st == "6")
	$where = " and status>5 and status<99";
else if($st == "3")
	$where = " and (status=3 or status=110)";
else
	$where = " and status=$st";

$sql = "select * ,(select name from t_comp b where b.id=a.com_id) company, datediff(date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY),now()) gr, date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY) va_date, date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY) va_date2 from t_give a where 1 $where  order by end_date desc limit 10";
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
<?}?>			
		</ul>
		<div class="btn_more" id="lastlist"><a href="javascript:addlist();">더보기</a></div>
	</section>

</body>
<script> 
  var listcount=0; 

  function addlist(){ 
        listcount+=10; 
        $.post("/get_allentry.php",{"count" : listcount,"st":'<?=$st?>'},function(data){ 
              var oldlist =  $("#listbody").html(); 
              if(trim(data) != "0")
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