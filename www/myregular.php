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
			<p>단골집</p>
		</div>
	</header>
	<section class="shop_list">
		<ul id="listbody">

<?
if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

if($lon!="" && $lat!= "")
{
	$dist =",(round((acos(cos(radians(90-$lat))*cos(radians(90-lat))+sin(radians(90-$lat))*sin(radians(90-lat))*cos(radians($lon-lon)))*6371000), 0)) AS distance ";
	$dist_sort = " distance ";
}
else
	$dist_sort = " modify_date desc ";

$sql = "select * from t_com_regular where mb_no=$member[mb_no] order by id desc limit 10";
$res = sql_query($sql);
while ($row=sql_fetch_array($res)) {
	$sql = "select id,name,cate,cate_sub,img0,img_id,lat,lon,eva_point,eva_count,order_tel_st,order_sms_st,view,regular_count ".$dist." from t_comp where id=$row[com_id]";
	
	$rx = sql_fetch($sql);
	$cate = $rx['cate'];
	if($rx['img_id'] == "")
	{
		$img_str = "./img_shop_detail/".$cate."/".$cate."/".$rx['cate_sub'].".jpg";
		if(!file_exists($img_str))
			$img_str = "/img_shop_detail/shop.png";
		}
	else
	{
		$img_str = "./data/shop/".$rx[img_id]."/".$rx['img0'];
	}
	if(!file_exists($img_str))
		$img_str = "/images/noimg.jpg";	
	if($rx[order_tel_st]!="" || $rx[order_sms_st]!="" )
		$order_st = "<a href='shop_menu.php?id=".$id."'>바로주문가능</a>";
	else
		$order_st = "";
	$cate_sub = $rx[cate_sub];
	if($cate_sub == "1")
		$cate_sub_str = "나이트";
	else if($cate_sub == "2")
		$cate_sub_str = "BAR";
	else if($cate_sub == "3")
		$cate_sub_str = "노래주점";
	else if($cate_sub == "4")
		$cate_sub_str = "룸싸롱";
	else if($cate_sub == "5")
		$cate_sub_str = "클럽";	
?>
			<li>
				<a href="shop_detail.php?id=<?=$rx[id]?>&c1=<?=$rx[cate]?>" target="_blank">
					<div class="d1"><img src="<?=$img_str?>" alt=""><span>단골</span></div>
					<dl>
						<dt>
							<p class="tit"><?=$rx[name]?></p>
<? $icon_p = floor($rx[eva_point]); ?>							
							<p class="eval">
								
								<span style="color:#a6a6a6">주점 > <?=$cate_sub_str?></span>
							</p>
						</dt>
						<dd>
							<p class="distance"><?=number_format($rx[distance])?>m</p>
							<p class="favor"  alt="단골"><?=$rx[regular_count]?></p>
							<p class="view">조회 <?=$rx['view']?></p>
							<p><strong><?=$order_st ?></strong></p>
						</dd>
					</dl>
					<?
						// 경품존재여부
						$t = date("Ymd");
						$sql = "select id from t_give where com_id=$rx[id] and start_date<=$t and end_date>=$t";
						$rs  = sql_fetch($sql);
						$sql = "select count(id) c from t_give_enter where give_id=$rs[id] and mb_no=$member[mb_no]";
						$rs_enter = sql_fetch($sql);
						if($rs && $rs_enter[c]>0)
						{
					?>
					<div class="d2 my">
						<img src="images/blt_intro_s4_1.png" alt="">
						<p>응모</p>
					</div>
					<? } else if($rs) { ?>
					<div class="d2 ing">
						<img src="images/blt_intro_s4_1.png" alt="">
						<p>경품 진행중</p>
					</div>
					<? } ?>
				</a>
			</li>
<? } ?>

			
		</ul>
		<div class="btn_more"  id="lastlist"><a href="javascript:addlist();">더보기</a></div>
	</section>
<script> 
  var listcount=0; 

  function addlist(){ 
        listcount+=10; 
        $.post("/get_myregular.php",{"count" : listcount},function(data){ 
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

</body>
</html>