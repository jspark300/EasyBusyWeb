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
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

$sql = "select id,name,addr_s,phone,lat,lon,description from t_comp where id=$shop_id";
$res = sql_fetch($sql);

$sql = "select * from t_give where id=$give_id";
$give = sql_fetch($sql);

$sql = "select count(id) c from t_give_enter where give_id=$give_id and select_no=$select_no";
$rs = sql_fetch($sql);
$selcount = $rs[c];
if($selcount > 0)
{
	echo "<script>alert('선택하신 번호는 이미 응모하였습니다. 다른 번호를 선택해 주세요.');history.back();</script>";
	exit;
}
$sql = "select count(id) c from t_give_enter where  give_id=$give_id and mb_no=".$member[mb_no];
$rs = sql_fetch($sql);
if($rs[c]>0)  // 이미 응모완료
{
	echo "<script>alert('이미 응모하였습니다.');location.href='/shop_list.php';</script>";
	exit;
}

// 응모하기
$t = time();
$sql = "insert into t_give_enter (give_id,mb_no,select_no,reg_date) values ($give_id,".$member[mb_no].",$select_no,$t)";
sql_query($sql);
// 응모 포인트 차감
$sql = "insert into t_give_point_use (point_name,point_use,point,status,mb_no,reg_date) values ('경품응모','$give[com_name]',1,0,'".$member[mb_no]."',$t)";
sql_query($sql);
// 응모 포인트 차감
$sql = "update g5_member set give_point = give_point - 1 where mb_no=$member[mb_no]";
sql_query($sql);


$total_enter = floor($give[price]/25000)*50;
$sql = "select count(id) c from t_give_enter where give_id=$give_id";
$give_enter = sql_fetch($sql);
$enter_count = $give_enter[c];


$end_date=substr($give[end_date],0,4)."-".substr($give[end_date],4,2)."-".substr($give[end_date],6,2);
$datex = date_create($end_date);
date_add($datex,date_interval_create_from_date_string("8 days"));

?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p><?=$res["name"]?></p>
		</div>
	</header>
	<section class="shop_detail pb10">
		<h2>경품 응모완료</h2>
		<ul class="u1">
			<li>
				<dl>
					<dt>
						<p><img src="<?="/data/item/".$give['img_id']."/".$give['img1'] ?>" height="100" alt=""></p>
					</dt>
					<dd>
						<p><span class="tit"><?=$give['name']?></span> <span>(<?=number_format($give[price])?>원)</span></p>
						<p>- 응모마감 : <strong><?=substr($give[end_date],0,4).".".substr($give[end_date],4,2).".".substr($give[end_date],6,2)?></strong></p>
						<p>- 현재 응모자수 : <strong><?=$enter_count?></strong> (전체 : <?=$total_enter?>)</p>
						<p class="exp">응모완료 (응모번호 : <strong><?=$select_no?></strong>)</p>
					</dd>
				</dl>				
			</li>			
		</ul>
	</section>
	<section class="shop_entryconfirm">
        <div class="entry_box">
            <p class="p1">응모가 완료되었습니다.<br><?=$member[mb_nick]?>님의 응모번호는 <strong><?=$select_no?></strong>번입니다.</p>
            <p class="p2">응모하신 경품은 당첨시,<br> 아래 기간내에 당첨확인을 하지 않으시면<br> <strong>자동 기부</strong>가 됩니다.<br>
            <em>응모확인 기간 : <?=date_format($datex,"Y-m-d")?></em></p>
        </div>
		<div class="btn_wrap_btm"><a href="shop_detail.php?id=<?=$shop_id?>&c1=<?=$c1?>" class="btn_t1">확인</a></div>
	</section>

</body>
</html>