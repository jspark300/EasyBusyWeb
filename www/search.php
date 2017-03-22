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
<script language="JavaScript" type="text/JavaScript">
function form_submit2() {
	if (myTrim(document.f2.search_str.value) == "") {
		alert("검색어를 입력해 주시기 바랍니다.");
		document.f2.search_str.focus();
		return;
	}
	loading();	
	document.f2.submit();
}

function myTrim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
}
</script>

</head>
<body>

<? include_once('./header.php');?>


	<header class="header2">
		<form name="f2" method="get" action="search.php">		
			<div class="btn_back"><a href="javascript:history.back();"></a></div>
				<div class="search_wrap2">
					<p><input type="text"  name="search_str" value="<?=$search_str?>" placeholder="검색어 입력"></p> <a href="javascript:form_submit2();">검색</a>
			</div>
		</form>	
	</header>


	<section class="shop_list">
		<ul  id="listbody">
<?
$where = "  where name like '%".$search_str."%'";

if($lon!="" && $lat!= "")
{
	$where .= " and lon>$lon-0.1 and lon<$lon+0.1 and lat>$lat-0.1 and lat<$lat+0.1 ";
	$dist =",(round((acos(cos(radians(90-$lat))*cos(radians(90-lat))+sin(radians(90-$lat))*sin(radians(90-lat))*cos(radians($lon-lon)))*6371000), 0)) AS distance ";
	$dist_sort = " distance ";
//	$dist_sort = " modify_date desc, distance ";
}
else
	$dist_sort = " modify_date desc ";


//echo $sql;
if($search_str != "")
{
	$sql =  "select count(id) c from t_comp $where";
	$s_cx = sql_fetch($sql);
	$s_count = $s_cx[c];	
	if($s_count>0)
	{
		if($loc == "")
			echo "<li><p>[전체지역]에 [$search_str] 검색결과는 $s_count 개 입니다.</p></li>";
		else
			echo "<li><p>[$loc]에 [$search_str] 검색결과는 $s_count 개 입니다.</p></li>";
	}	
	$sql = "select id,name,cate,cate_sub,img0,img_id,lat,lon,eva_point,eva_count,order_tel_st,order_sms_st,view,regular_count  ".$dist." from t_comp ".$where." order by ".$dist_sort." limit 10";	
	$res = sql_query($sql);
	$i = 0;
}
else
{
	if($loc == "")
		echo "<li><p>[전체지역]에서 검색됩니다. 위치를 선택하시면 선택된 지역에서만 검색됩니다.</p></li>";
	else
		echo "<li><p>[$loc]에서 검색됩니다.</p></li>";
}	
while ($row=sql_fetch_array($res)) {
	++$i;
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
				<a href="shop_detail.php?id=<?=$row['id']?>&c1=<?=$c1?>&c2=<?=$c2?>" target="_blank">
					<div class="d1" ><img src="<?=$img_str?>" alt="" height="75"><!--span>단골</span--></div>
					<dl>
						<dt>
							<p class="tit"><?=$row['name']?></p>
							<p class="eval">
<?
$icon_p = floor($row[eva_point]);
?>							
							<span style="color:#a6a6a6">주점 > <?=$cate_sub_str?></span>
							</p>
						</dt>
						<dd>
							<p class="distance"><?=number_format($row[distance])?>m</p>
							<p class="favor"><?=$row['regular_count']?></p>
							<p class="view">조회 <?=$row['view']?></p>
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
if($i==0)
{
	if($loc == "")
		echo "<li><p>[전체지역]에 [$search_str] 검색결과가 없습니다.</p></li>";
	else
		echo "<li><p>[$loc]에 [$search_str] 검색결과가 없습니다.</p></li>";
		
}
if($c2=="")
	$c2 = 0;
?>

		</ul>
		<div class="btn_more"  id="lastlist"><a href="javascript:add_searchlist('<?=$search_str?>');">더보기</a></div>
	</section>
<script> 

  var listcount=0; 

  function add_searchlist(cs){ 
        listcount+=10; 
        $.post("/get_shop_searchlist.php",{"count" : listcount,"cs" : cs},function(data){ 
              var oldlist =  $("#listbody").html(); 
               if(trim(data) != "0")
				$("#listbody").html(oldlist+data); 
			else
				$("#lastlist").html("<a href='javascript:add_searchlist();'>마지막 목록입니다.</a>"); 
			
        });	
  } 
  
  function trim(str)
	{
		return str.replace(/^\s*|\s*$/g,"");
	}

  var listcount_r=0; 

  function addlist(){ 
        listcount_r += 10; 
        $.post("/get_myregular.php",{"count" : listcount_r},function(data){ 
              var oldlist =  $("listbody_r").html(); 
              $("listbody_r").html(oldlist+data); 
        });	
  } 

</script> 

</body>
</html>