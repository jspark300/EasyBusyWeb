<?
include_once('./_common.php');
if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
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
</head>
<body>
	<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>마이 업체(내가등록한업체)</p>
		</div>
	</header>

	<section class="shop_list">
		<ul  id="listbody">

<?

$where = " where own_id='$member[mb_id]'";
if($member[mb_level]>3)
	$where = " where reg_id='$member[mb_id]'";

$start = $count;

if($lon!="" && $lat!= "")
{
//	$where .= " and lon>$lon-0.025 and lon<$lon+0.025 and lat>$lat-0.025 and lat<$lat+0.025 ";
	$dist =",(round((acos(cos(radians(90-$lat))*cos(radians(90-lat))+sin(radians(90-$lat))*sin(radians(90-lat))*cos(radians($lon-lon)))*6371000), 0)) AS distance ";
	$dist_sort = " distance ";
}
else
	$dist_sort = " modify_date desc ";
$sql = "select id,name,cate,cate_sub,img1,img_id,order_tel_st,order_sms_st,regular_count,view, eva_point ".$dist." from t_comp ".$where." order by ".$dist_sort." limit  10";
//echo $sql;
$res = sql_query($sql);
while ($row=sql_fetch_array($res)) {
	$cate = $row['cate'];
	if($row['img_id'] == "")
	{
		$img_str = "./img_shop_detail/".$cate."/".$cate."/".$row['cate_sub'].".jpg";
		if(!file_exists($img_str))
			$img_str = "/img_shop_detail/shop.png";
		}
	else
	{
		$img_str = "./data/shop/".$row[img_id]."/".$row['img1'];
	}
	if(!file_exists($img_str))
		$img_str = "/images/noimg.jpg";	
	if($row[order_tel_st]!="" || $row[order_sms_st]!="" )
		$order_st = "<a href='shop_menu.php?id=".$id."'>바로주문가능</a>";
	else
		$order_st = "";
	$cate_sub = $row[cate_sub];
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
				<a href="shop_detail.php?id=<?=$row['id']?>&c1=<?=$c1?>&c2=<?=$c2?>" target="_blank">
					<div class="d1" ><img src="<?=$img_str?>" alt="" height="65"><!--span>단골</span--></div>
					<dl>
						<dt>
							<p class="tit"><?=$row['name']?></p>
<?
$icon_p = floor($row[eva_point]);
?>								
							<p class="eval">
							<span style="color:#a6a6a6">주점 > <?=$cate_sub_str?></span>
								
							</p>
						</dt>
						<dd>
							<p class="distance"><?//=number_format($rx[distance])?>m</p>
							<p class="favor"><?=$row['regular_count']?></p>
							<p class="view">조회 <?=$row['view']?></p>
							<p><strong><?=$order_st ?></strong></p>
						</dd>
					</dl>
<?if($c1<21) {?>
					<?
						// 경품존재여부
						$t = date("Ymd");
						$sql = "select id from t_give where com_id=$row[id] and start_date<=$t and end_date>=$t";
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
<? } ?>
				</a>
			</li>
<?
}

if($c2=="")
	$c2 = 0;
?>

		</ul>
		<div class="btn_more"   id="lastlist"><a href="javascript:addlist();">더보기</a></div>
		<div class="btn_wrap_btm"><a href="regist_shopinfo.php" class="btn_t1">업체등록</a></div>
	</section>
</body>
<script> 


  var listcount=0; 
 // var x1=<?=$c1?>;
 // var x2=<?=$c2?>;
    var psel = 0;

  function addlist(){ 

        listcount+=10; 
        $.post("/get_myshop_list.php",{"count" : listcount},function(data){ 
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