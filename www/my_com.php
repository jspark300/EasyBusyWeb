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
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>마이업체</p>
		</div>
	</header>

	<section class="shop_list">
		<ul  id="listbody">
<?
include_once('./_common.php');
$mb_id = $member[mb_id];

$where = "  where reg_id = '".$mb_id."' or own_id='".$mb_id."' ";

$loc = $_COOKIE['location'];
if($loc != "")
{
	$ar = explode("|",$loc);
	if(count($ar)==4)
	{
	$loc = "지역 : ".$ar[0];
	$lon = $ar[1];
	$lat = $ar[2];
	}
}

function unescape($source)
{
    $decodedStr = '';
    $pos        = 0;
    $len        = strlen($source);
    while ($pos < $len) {
        $charAt = substr($source, $pos, 1);
        if ($charAt == '%') {
            $pos++;
            $charAt = substr($source, $pos, 1);
            if ($charAt == 'u') {
                // we got a unicode character
                $pos++;
                $unicodeHexVal = substr($source, $pos, 4);
                $unicode       = hexdec($unicodeHexVal);
                $entity        = '&#' . $unicode . ';';
                $decodedStr .= utf8_encode($entity);
                $pos += 4;
            }
            else {
                // we have an escaped ascii character
                $hexVal = substr($source, $pos, 2);
                $decodedStr .= chr(hexdec($hexVal));
                $pos += 2;
            }
        } else {
            $decodedStr .= $charAt;
            $pos++;
        }
    }
    return $decodedStr;
}if($lon!="" && $lat!= "")
{
	$dist =",(round((acos(cos(radians(90-$lat))*cos(radians(90-lat))+sin(radians(90-$lat))*sin(radians(90-lat))*cos(radians($lon-lon)))*6371000), 0)) AS distance ";
}
$dist_sort = " modify_date desc ";

$sql = "select id,name,cate,cate_sub,img1,img_id,order_tel_st,order_sms_st,regular_count,eva_point ".$dist." from t_comp ".$where." order by ".$dist_sort." ";
//echo $sql;
$res = sql_query($sql);
$i = 0;
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
		$img_str = "./data/shop/".$row[img_id]."/".$row['img1'];
	}
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
					<div class="d1" ><img src="<?=$img_str?>" alt=""  height="65"><!--span>단골</span--></div>
					<dl>
						<dt>
							<p class="tit"><?=$row['name']?></p>
<? $icon_p = floor($row[eva_point]); ?>						
							<p class="eval">
								<span style="color:#a6a6a6">주점 > <?=$cate_sub_str?></span>
								
							</p>
						</dt>
						<dd>
							<p class="distance"><?=number_format($rx[distance])?>m</p>
							<p class="favor"><?=$row['regular_count']?></p>
							<p><strong><?=$order_st ?></strong></p>
						</dd>
					</dl>
<?if($c1<21) {?>
					<div class="d2 ing">
						<img src="images/blt_intro_s4_1.png" alt="">
						<p>경품 진행중</p>
					</div>
<? } ?>
				</a>
			</li>
<? }
	if($i==0)
		echo "<li>등록된 업체가 없습니다.</li>";
?>
		</ul>
		<!-- div class="btn_more"><a href="javascript:add_searchlist('<?=$search_str?>');">더보기</a></div-->
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