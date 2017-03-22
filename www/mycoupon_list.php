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
			<p>쿠폰내역</p>
		</div>
	</header>
	
<?
include_once('./_common.php');

// 총
$sql = "select count(id) c   from t_give where (lot_mb_no=$member[mb_no] and (status=2 or status=100)) or (gift_mb_no=$member[mb_no] and (status=110 or status=100))";
$res = sql_fetch($sql);
$total_give = $res[c];
// 당첨쿠폰
$sql = "select count(id) c   from t_give where (lot_mb_no=$member[mb_no] and status=2)";
$res = sql_fetch($sql);
$elect_give = $res[c];
// 선물받은 쿠폰
$sql = "select count(id) c   from t_give where (gift_mb_no=$member[mb_no] and status=110)";
$res = sql_fetch($sql);
$gift_give = $res[c];
// 사용완료 쿠폰
$sql = "select count(id) c   from t_give where (lot_mb_no=$member[mb_no] or gift_mb_no=$member[mb_no]) and status=100)";
$res = sql_fetch($sql);
$use_give = $res[c];


?>
	
	<section class="entry_info">
		<div class="d1">
			<ul>
				<li>총 쿠폰 <strong><?=number_format($total_give)?></strong></li>
				<li>당첨쿠폰 <strong><?=number_format($elect_give)?></strong></li>
				<li>선물쿠폰 <strong><?=number_format($gift_give)?></strong></li>
				<li>사용완료 <strong><?=number_format($use_give)?></strong></li>
				
			</ul>
		</div>
		<div class="infobox1">
			쿠폰은 당첨일로 30일 이내에 사용하셔야 합니다<br>
			사용을 하지 않은 경우 자동으로 기부됩니다.
		</div>
	</section>
	<section class="search">
		<div class="tab_wrap">
			<ul class="u2">
			<li><a href="?st=" <? if($st=="") { ?>class="on"<?}?>>전체[<?=number_format($total_give)?>]</a></li>
			<li><a href="?st=0" <? if($st=="0") { ?>class="on"<?}?>>미사용쿠폰[<?=number_format($elect_give+$gift_give)?>]</a></li>
			<li><a href="?st=1" <? if($st=="1") { ?>class="on"<?}?>>사용완료쿠폰[<?=number_format($use_give)?>]</a></li>
			</ul>
		</div>
	</section>
	<section class="entry_list">
		<ul id="listbody">
			<li>
					
						<div class="d1">쿠폰등록일</div>
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

if($st == "0")
	$where = " and (lot_mb_no=$member[mb_no] and status=2) or (gift_mb_no=$member[mb_no] and status=110)";
else if($st == "1")
	$where = " and (lot_mb_no=$member[mb_no] or gift_mb_no=$member[mb_no]) and status=100)";
else
	$where = " and (lot_mb_no=$member[mb_no] and (status=2 or status=100)) or (gift_mb_no=$member[mb_no] and (status=110 or status=100))";

$sql = "select *,(select name from t_comp b where b.id=a.com_id) company,date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY) va_date from t_give a where 1 $where order by id desc limit 10";
$res = sql_query($sql);
for($i=0; $row=sql_fetch_array($res); $i++) {
	// 당첨확인 1주일 이후 자동기부(status=6)상태변경 
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
<?}?>			
		</ul>
		<div class="btn_more"  id="lastlist"><a href="javascript:addlist();">더보기</a></div>
		<div class="btn_wrap_btm"><a href="mycoupon_reg.php">쿠폰등록</a></div>
	</section>

</body>
<script> 
  var listcount=0; 

  function addlist(){ 
        listcount+=10; 
        $.post("/get_mycoupon.php",{"count" : listcount,"st":'<?=$st?>'},function(data){ 
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