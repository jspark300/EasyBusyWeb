<?
include_once('./_common.php');

$loc = $_COOKIE['location'];
if($loc != "")
{
	$loc = unescape($loc);
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
}
if($lon!="" && $lat!= "")
{
	$dist =",(round((acos(cos(radians(90-$lat))*cos(radians(90-lat))+sin(radians(90-$lat))*sin(radians(90-lat))*cos(radians($lon-lon)))*6371000), 0)) AS distance ";
	$dist_sort = " distance ";
}
else
	$dist_sort = " modify_date desc ";

$start = $count;

$sql = "select * from t_com_regular where mb_no=$member[mb_no] order by id desc limit $start, 10";

$res = sql_query($sql);
$i = 0;
while ($row=sql_fetch_array($res)) {
	++$i;
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
<? } 
if($i==0)
{
	echo "0";
}
?>
