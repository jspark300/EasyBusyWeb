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
			<p>내 응모권</p>
		</div>
	</header>
<?
include_once('./_common.php');


// 적립
$sql = "select sum(point) c   from t_give_point_use where mb_no=$member[mb_no] and status=1";
$res = sql_fetch($sql);
$save_point = $res[c];
// 사용
$sql = "select sum(point) c   from t_give_point_use where mb_no=$member[mb_no] and status=0";
$res = sql_fetch($sql);
$use_point = $res[c];

?>

	<section class="entry_info">
		<div class="infobox1 left">
			<p class="tit_txt">사용가능 응모권 : <?=$member[give_point]?>별</p>
			<ul class="fl3">
				<li>누적 : <?=$save_point?></li>
				<li>사용 : <?=$use_point?></li>
			</ul>
		</div>
		<ul class="exp_txt2 mt10">
			<li>응모권 별은 각종 컨텐츠 및 커뮤니티에 참여 시 제공되는 것으로 경품에 응모할 때 사용하실 수 있습니다.</li>
			<li>응모권 별은 현금으로 전화되지 않으며, 서비스 운영정책에 따라 변경될 수 있습니다.</li>
		</ul>
	</section>
	<section class="search">
		<div class="tab_wrap">
			<ul class="u2">
				<li><a href="?" <? if($st=="") { ?>class="on"<?}?>>전체</a></li>
				<li><a href="?st=1" <? if($st=="1") { ?>class="on"<?}?>>적립</a></li>
				<li><a href="?st=0" <? if($st=="0") { ?>class="on"<?}?>>사용</a></li>
			</ul>
		</div>
	</section>
	<section class="entry_list">
		<ul id="listbody">
<?
$today = date("Ymd");

if($st == "1")
	$where = " and status=1 ";
else if($st == "0")
	$where = " and status=0 ";
else 
	$where = "";
$sql = "select * from t_give_point_use a where mb_no=$member[mb_no] $where order by id desc limit 10";
$res = sql_query($sql);
for($i=0; $row=sql_fetch_array($res); $i++) {
?>

			<li>
				<a href="#1">
					<div class="d1"><?=date("Y-m-d",$row[reg_date])?></div>
					<dl>
						<dt>
							<p class="tit"><?=$row[point_name]?></p>
						</dt>
						<dd>
							<p><?=$row[point_use]?></p>
						</dd>
					</dl>
					<?if($row[status] == "1") {?>
					<div class="d2">
						<p class="plus">+<?=$row[point]?></p>
					</div>
					<? } else  { ?>
					<div class="d2">
						<p class="minus">-<?=$row[point]?></p>
					</div>
					<? } ?>
				</a>
			</li>
<? } ?>

		</ul>
		<!--div class="btn_more"><a href="#more">더보기</a></div-->
	</section>
</body>
</html>