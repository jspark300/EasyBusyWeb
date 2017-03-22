<?
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');  // 캐쉬  업데이트  다시 저장
header("Pragma: no-cache");
header("Cache-Control: no-cache,must-revalidate");


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
	<script src="a_js/jquery.bxslider.js"></script>
	<script>
	function pop_shop(id)
	{
				height = $(window).height();
				width = $(window).width();
				wi = window.open('/shop_detail.php?id='+id+'', '', 'scrollbars=yes,toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=no,width='+width+',height='+height+'');
				//wi.focus();
	}
	function go_detail(id,c1,c2)
	{
		lc = listcount;
		var top  = window.pageYOffset || document.documentElement.scrollTop;
		location.href = "shop_detail.php?id="+id+"&c1="+c1+"&c2="+c2+"&lc="+lc+"&sc="+top+"&t=<?=time();?>";
	}

	</script>
</head>
<body onload="window.scrollTo(0,<?=$sc==""?0:$sc?>);">

<? include_once('./header.php');?>
<?
if($c1=="")
	$c1 = 1;
if($c2=="")
	$c2 = 0;
?>
	<header class="shop_nav">
		<nav class="n1">
			<div class="swiper-container">
				<ul class="swiper-wrapper">
					<li class="swiper-slide"><a href="javascript:newlist(1,0);" <?php if($c2 == "0") echo "class='on'"; ?>><span></span>전체</a></li>
					<li class="swiper-slide"><a href="javascript:newlist(1,4);" <?php if($c2 == "4") echo "class='on'"; ?>><span></span>룸싸롱</a></li>
					<li class="swiper-slide"><a href="javascript:newlist(1,5);" <?php if($c2 == "5") echo "class='on'"; ?>><span></span>클럽</a></li>
					<li class="swiper-slide"><a href="javascript:newlist(1,1);" <?php if($c2 == "1") echo "class='on'"; ?>><span></span>나이트</a></li>
					<li class="swiper-slide"><a href="javascript:newlist(1,3);" <?php if($c2 == "3") echo "class='on'"; ?>><span></span>노래주점</a></li>
					<li class="swiper-slide"><a href="javascript:newlist(1,2);" <?php if($c2 == "2") echo "class='on'"; ?>><span></span>BAR</a></li>

				</ul>

			</div>

		</nav>



</header>
	<!--section class="shop_nav3">
		<nav class="n3">
			<div>
				<ul>
					<li><a href="#1" class="on">경품우선</a></li>
					<li><a href="#1">거리순</a></li>
					<li><a href="#1">추천순</a></li>
					<li><a href="#1">등록순</a></li>
					<li><a href="#1">최근검색</a></li>
				</ul>
			</div>
		</nav>
	</section -->
	<section class="shop_list">
		<ul  id="listbody">

<?

$where = " where nation='$config[cf_nation]' ";
if($c1>0)
{
	$where .= " and cate=".$c1;
	if($c2 != "" && $c2!="0")
		$where .= " and cate_sub='".$c2."'";
}
//$where .= " and is_giveaway=1 ";


if($lon!="" && $lat!= "")
{
	$where2 = " and lon>$lon-0.1 and lon<$lon+0.1 and lat>$lat-0.1 and lat<$lat+0.1 ";
	$where .= $where2;

	$dist =",(round((acos(cos(radians(90-$lat))*cos(radians(90-lat))+sin(radians(90-$lat))*sin(radians(90-lat))*cos(radians($lon-lon)))*6371000), 0)) AS distance ";
	$dist_sort = " distance ";
	$dist_sort = " is_giveaway desc, distance,  modify_date desc ";

}
else
	$dist_sort = " is_giveaway desc, modify_date desc ";

if($lc)
	$listcount = $lc+10;
else
	$listcount = 10;
$sql = "select id,name,cate,cate_sub,img0,img_id,lat,lon,eva_point,eva_count,order_tel_st,order_sms_st,regular_count, view, description ".$dist." from t_comp ".$where." order by ".$dist_sort."  limit ".$listcount."";
//echo "<br>".$sql;
$rx = sql_query($sql);
while ($row=sql_fetch_array($rx)) {
//	echo "xx";
	$cate = $row['cate'];
	if($row['img_id'] == "")
	{
		$img_str = "./img_shop_detail/".$cate."/".$cate."/".$row['cate_sub'].".jpg";
		if(!file_exists($img_str))
			$img_str = "/img_shop_detail/shop.png";
	}
	else
	{
		$img_str = "./data/shop/".$row[img_id]."/".$row['img0'];
	}
	if(!file_exists($img_str))
		$img_str = "/images/noimg.jpg";

	if($row[order_tel_st]!="" || $row[order_sms_st]!="" )
		$order_st = "바로주문가능";
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
				<!-- a href="shop_detail.php?id=<?=$row['id']?>&c1=<?=$c1?>&c2=<?=$c2?>&page=" -->
				<a href="javascript:go_detail(<?=$row['id']?>,<?=$c1?>,<?=$c2?>);" >

					<div class="d1" ><img src="<?=$img_str?>" alt="" height="75"><!--span>단골</span--></div>
					<dl>
						<dt>
							<p class="tit"><?=$row['name']?></p>
							<p class="eval">
	<?
$icon_p = floor($row[eva_point]);

$sql = "select count(wr_id) c from g5_write_public where wr_1='".$row['id']."'";
//echo $sql;
$comp = sql_fetch($sql);
$sql = "select  call_count from t_call where com_id='".$row['id']."'";
//echo $sql;
$call = sql_fetch($sql);
if($call['call_count'] == "")
	$call_count = 0;
else
	$call_count = $call['call_count'];
?>
								<span style="color:#a6a6a6">주점 > <?=$cate_sub_str?></span>
								<!--span class="s2">
									<strong>맛집</strong>
									<strong>친절</strong>
									<strong>청결</strong>
								</span-->
							</p>
						</dt>
						<dd>
							<p>거리 <?=number_format($row[distance])?>m, 단골 <?=$row['regular_count']?>, 조회 <?=$row['view']?>, 후기 <?=$comp[c]?>, 콜수 <?=$call_count?></p>

							<p><strong><?=$order_st?></strong></p>
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
		<div class="btn_more"  id="lastlist"><a href="javascript:addlist();">더보기</a></div>
	</section>

</body>
<script>
	var swiper = new Swiper('.swiper-container', {
		initialSlide : <?=$c1-2?>,
		pagination: '.swiper-pagination',
		paginationClickable: true,
		spaceBetween: 2,
		freeMode: true,

		scrollbarHide: true,
		slidesPerView: 'auto',
		grabCursor: true
	});


  var listcount=<?=$lc==""?0:$lc?>;
  var x1=<?=$c1?>;
  var x2=<?=$c2?>;
    var psel = 0;

  function addlist(){
        listcount+=10;
        $.post("/get_shop_list.php",{"count" : listcount,"c1" : x1,"c2" : x2,"t":"<?=time();?>"},function(data){
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
  function newlist(c1,c2){
		x1 = c1;
		x2 = c2;
        listcount=0;
		psel = 1;
		var strArray;
        $.post("/get_shop_list.php",{"count" : listcount,"c1" : c1,"c2" : c2,"t":"<?=time();?>"},function(data){
        //      var oldlist =  $("#listbody").html();
              $("#listbody").html(data);
			   $("#lastlist").html("<a href='javascript:addlist();'>더보기</a>");
        });
        $.post("/get_shop_submenuex.php",{"c1" : c1},function(data){
			strArray = data.split("|");

		swiper2.removeAllSlides();
		for(i=0; i<strArray.length; ++i)
		{
			if(i==0)
				swiper2.appendSlide('<li class="swiper-slide"><a href="javascript:newlist_sub('+c1+',0);" class="on" ><span></span>'+strArray[i]+'</a></li>');
			else
				swiper2.appendSlide('<li class="swiper-slide"><a href="javascript:newlist_sub('+c1+','+i+');"><span></span>'+strArray[i]+'</a></li>');
		}
		swiper2.update();
		   });
  }
  function newlist_sub(c1,c2){
		x1 = c1;
		x2 = c2;
		se = c2+1;
        listcount=0;
        $.post("/get_shop_list.php",{"count" : listcount,"c1" : c1,"c2" : c2,"t":"<?=time();?>"},function(data){
        //      var oldlist =  $("#listbody").html();
              $("#listbody").html(data);
			  $("#lastlist").html("<a href='javascript:addlist();'>더보기</a>");
        });

		$(".shop_nav .n2 ul li:nth-child("+psel+") a").removeClass("on");
		$(".shop_nav .n2 ul li:nth-child("+se+") a").addClass("on");
		psel = se;

 //       $.post("/get_shop_submenu.php",{"c1" : c1,"c2" : c2},function(data){
  //      //      var oldlist =  $("#listbody").html();
    //          $("#submenubody").html(data);
//
  //      });
  }
</script>

</html>
