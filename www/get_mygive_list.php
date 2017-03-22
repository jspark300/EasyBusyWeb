<?
include_once('./_common.php');

if($member[mb_level]>2)
	$where = " where reg_id='$member[mb_id]'";
else
	$where = " where 1 ";

$start = $count;
$t = date("Ymd");
$sql = "select * from t_give ".$where." order by start_date desc limit $start, 10";
$res = sql_query($sql);
$i=0;
while ($give=sql_fetch_array($res)) {
	++$i;
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
						<p><img src="<?="/data/item/".$give['img_id']."/".$give['img1'] ?>" alt=""></p>
					</dt>
					<dd>
						<p><span class="tit"><?=$give[name]?></span> <span>(<?=number_format($give[price])?>원)</span></p>
						<p><strong class="shop"><?=$company?></strong> (<?=$ca_rs[mstr1]?> &gt; <?=$ca_rs[mstr2]?>)</p>
						<div>
							<p class="locate"><strong><?=$t_rs[addr_s]?></strong></p>
							<p class="timer">응모기간 : <strong><?=substr($give[start_date],0,4).".".substr($give[start_date],4,2).".".substr($give[start_date],6,2)?>~<?=substr($give[end_date],0,4).".".substr($give[end_date],4,2).".".substr($give[end_date],6,2)?></strong>  </p>
						</div>

						<? if($give[start_date]>$t) { ?>
						<p><a href="regist_giveaway.php?give_id=<?=$give[id]?>">수정</a><a href="javascript:delete_give(<?=$give[id]?>);">삭제</a></p>
						<? } else if($give[start_date]<=$t && $give[end_date]>=$t) {?>
						<p>응모중</p>
						<? } else { ?>
						<p>지난경품</p>
						<? } ?>
					</dd>
				</dl>
			</li>
	
			

<?
}
if($i==0)
	echo "0";
?>