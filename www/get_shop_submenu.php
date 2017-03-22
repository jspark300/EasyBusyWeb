<? if($c1==0 || $c1=="") { ?>	
	<li class="swiper-slide"><a href="javascript:newlist_sub(<?=$c1?>,0);"  <?php if($c2 == "" || $c2 == "0") echo "class='on'"; ?>><span></span>경품</a></li>
<? } else { ?>
	<li class="swiper-slide"><a href="javascript:newlist_sub(<?=$c1?>,0);"  <?php if($c2 == "" || $c2 == "0") echo "class='on'"; ?>><span></span>전체</a></li>
<? } ?>
<?
include_once('./_common.php');
$sql = "select m2,mstr2 from b_menu where m1 = ".$c1." order by m2";
$res = sql_query($sql);
while ($row=sql_fetch_array($res)) {
?>
					<li class="swiper-slide"><a href="javascript:newlist_sub(<?=$c1?>,<?=$row['m2']?>);"    <?php if($c2 == $row['m2'] ) echo "class='on'"; ?>><span></span><?=$row['mstr2']?></a></li>
<? } ?>
