<?
include_once('./_common.php');

$start = $count;


$where = " where own_id='$member[mb_id]'";
if($member[mb_level]>3)
	$where = " where reg_id='$member[mb_id]'";

$start = $count;

$dist_sort = " modify_date desc ";
$sql = "select id,name,cate,cate_sub,img1,img_id,order_tel_st,order_sms_st,regular_count,view,eva_point ".$dist." from t_comp ".$where." order by ".$dist_sort." limit  $start, 10";
//echo $sql;
$res = sql_query($sql);
$i=0;
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
if($i==0)
	echo "0";
?>