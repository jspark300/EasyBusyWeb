<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$ca_cnt = count($cate);
$cate_w = ($wset['ctype'] == "2") ? apms_bunhal($ca_cnt, $wset['bunhal']) : '';

?>

<?php if($is_nav) { // 네비게이션 ?>
	<aside>
		<div class="div-title-wrap">
			<div class="div-title">
				<?php 
					$nav_cnt = count($nav);
					for($i=0;$i < $nav_cnt; $i++) { 
				?>
					<a href="./list.php?ca_id=<?php echo $nav[$i]['ca_id'];?>">
						<?php echo ($i == 0) ? '<i class="fa fa-cube fa-lg lightgray"></i> ' : ' &nbsp;<i class="fa fa-chevron-right lightgray"></i>&nbsp; ';?>
						<?php if($nav[$i]['on']) { ?>
							<b><?php echo $nav[$i]['name'];?>(<?php echo $nav[$i]['cnt'];?>)</b>
						<?php } else { ?>
							<?php echo $nav[$i]['name'];?>(<?php echo $nav[$i]['cnt'];?>)
						<?php } ?>
					</a>
				<?php } ?>
			</div>
			<div class="div-sep-wrap">
				<div class="div-sep sep-bold"></div>
			</div>
		</div>
	</aside>
<?php } ?>

<?php if($is_cate) { ?>
	<aside class="list-category">
		<div class="div-tab<?php echo $wset['tab'];?> tabs<?php echo ($wset['tabline']) ? '' : ' trans-top';?> hidden-xs">
			<ul class="nav nav-tabs<?php echo ($wset['ctype'] == "1") ? ' nav-justified' :'';?><?php echo ($cate_w) ? ' text-center' :'';?>">
				<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
					<li<?php echo ($cate[$i]['ca_id'] == $ca_id) ? ' class="active"' : '';?><?php echo $cate_w;?>>
						<a href="./list.php?ca_id=<?php echo urlencode($cate[$i]['ca_id']);?>">
							<?php echo $cate[$i]['name'];?><?php if($cate[$i]['ca_id'] == $ca_id) echo '('.number_format($total_count).')';?>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>
		<div class="dropdown visible-xs">
			<a id="categoryLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-color btn-block">
				<?php echo ($ca_id) ? $ca['ca_name'] : '카테고리';?>(<?php echo number_format($total_count);?>)
			</a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="categoryLabel">
				<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
					<li<?php if($cate[$i]['ca_id'] == $ca_id) echo ' class="selected"';?>>
						<a href="./list.php?ca_id=<?php echo urlencode($cate[$i]['ca_id']);?>"><?php echo $cate[$i]['name'];?></a>
					</li>
				<?php } ?>
				<?php if($up_href) { ?>
					<li>
						<a href="<?php echo $up_href;?>">상위분류이동</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</aside>
<?php } ?>