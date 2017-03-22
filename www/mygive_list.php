<?
include_once('./_common.php');
if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
if($member[mb_level]<3)
{
	echo "<script>alert('업체회원만 사용가능합니다.');location.href='member_login.php';</script>";
	exit;
}


?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EASYBUSY</title>
	<link href="a_css/default.css" rel="stylesheet">
	<link href="a_css/common.css" rel="stylesheet">
	<script src="a_js/jquery-1.11.3.min.js"></script>
	<script src="a_js/common.js"></script>
	<link rel="stylesheet" href="a_css/swiper.min.css">
	<script src="a_js/swiper.min.js"></script>
<script type="text/javascript">
	function delete_give(no)
	{
		if(confirm('정말로 삭제하시겠습니까?'))
		{
			document.give_del.give_id.value = no;
			document.give_del.submit();
		}
	}
</script>

</head>
<body>
<form name="give_del" method="post" charset="utf-8" action="delete_give.php">
<input type="hidden" name="give_id" >
</form>

<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>마이 경품</p>
		</div>
	</header>

	<section class="mall_list">
		<ul class="u1"  id="listbody">

<?
if($member[mb_level]>2)
	$where = " where reg_id='$member[mb_id]'";
else
	$where = " where 1 ";

$start = $count;
$t = date("Ymd");
$sql = "select * from t_give ".$where." order by start_date desc limit  10";
$res = sql_query($sql);
while ($give=sql_fetch_array($res)) {
				$total_enter = floor($give[price]/25000)*50;
				$sql = "select count(id) c from t_give_enter where  give_id=".$give[id]."";
				$g_rs = sql_fetch($sql);
				$g_count = $g_rs[c];
				$sql = "select id,name,addr_s,cate,cate_sub from t_comp where id=$give[com_id]";
				$t_rs = sql_fetch($sql);
				$company = $t_rs[name];
				$sql = "select mstr1, mstr2 from b_menu where m1=$t_rs[cate] and m2=$t_rs[cate_sub]";
				$ca_rs = sql_fetch($sql);
?>
			<!-- li onclick="location.href='shop_detail.php?id=<?=$t_rs[id]?>'" -->
			<li>
				<dl>
					<dt>
						<p><img src="<?="/data/item/".$give['img_id']."/".$give['img_id'].".jpg" ?>" alt=""></p>
					</dt>
					<dd>
						<p><span class="tit"><?=$give[name]?></span> <span>(<?=number_format($give[price])?>원)</span></p>
						<p><strong class="shop"><?=$company?></strong> (<?=$ca_rs[mstr1]?> &gt; <?=$ca_rs[mstr2]?>)</p>
						<div>
							<p class="locate"><strong><?=$t_rs[addr_s]?></strong></p>
							<p class="timer">응모기간 : <strong><?=substr($give[start_date],0,4).".".substr($give[start_date],4,2).".".substr($give[start_date],6,2)?>~<?=substr($give[end_date],0,4).".".substr($give[end_date],4,2).".".substr($give[end_date],6,2)?></strong>  </p>
						</div>
						
						<?if($g_count==0 && $give[end_date]>=$t) {?>
						<p><span><a href="regist_giveaway.php?give_id=<?=$give[id]?>">수정</a></span> <span><a href="javascript:delete_give(<?=$give[id]?>);">삭제</a></span></p>
						<?}?>
						<? if($give[start_date]>$t) { ?>
						<? } else if($give[start_date]<=$t && $give[end_date]>=$t) {?>
						<p>응모중(응모자:<?=$g_count?>명)</p>
						<? } else { ?>
						<p>지난경품</p>
						<? } ?>
						
					</dd>
				</dl>
			</li>
	
			

<?
}
?>

		</ul>
		<div class="btn_more"  id="lastlist"><a href="javascript:addlist();">더보기</a></div>
		<div class="btn_wrap_btm"><a href="regist_giveaway.php" class="btn_t1">경품등록</a></div>
	</section>
</body>
<script> 

  var listcount=0; 
  function addlist(){ 
        listcount+=10; 
        $.post("/get_mygive_list.php",{"count" : listcount},function(data){ 
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