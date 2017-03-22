<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

global $menu;

$i=0;
for ($z=1; $z < count($menu); $z++) {
	if($menu[$z]['on'] == "on" && $menu[$z]['is_sub']) {
		$i = $z;
		break;
	}
}

if(!$i) return;

// Random ID
$accordion_id = apms_id();

?>
<style>
	.category-line { padding:3px 0px !important; border:0px !important; }	
	.panel-group.div-panel .panel-heading a.active.category-line { border-bottom: 0px !important; }
</style>
<div id="<?php echo $accordion_id;?>" class="div-panel no-animation panel-group no-bottom at-toggle">
	<?php  
		$m = 1; //메뉴 카운팅
		for($j=0; $j < count($menu[$i]['sub']); $j++) {
			$is_on = ($menu[$i]['sub'][$j]['on'] == 'on') ? true : false;

	?>
			<?php if($menu[$i]['sub'][$j]['line']) { //구분라인이 있을 때 ?>
				<div class="div-title-wrap" style="margin:15px 0px;">
					<div class="div-title">
						<b><?php echo $menu[$i]['sub'][$j]['line'];?></b>
					</div>
					<div class="div-sep-wrap">
						<div class="div-sep sep-bold"></div>
					</div>
				</div>
			<?php } ?>
			<div class="panel panel-default">
				<div class="panel-heading" id="<?php echo $accordion_id;?>H<?php echo $m;?>" role="tab">
					<?php if(G5_IS_MOBILE && $menu[$i]['sub'][$j]['is_sub']) { ?>
						<a href="#<?php echo $accordion_id;?>G<?php echo $m;?>" data-parent="#<?php echo $accordion_id;?>" data-toggle="collapse" class="category-line<?php echo ($is_on) ? ' active' : '';?>">
					<?php } else { ?>
						<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>" class="category-line<?php echo ($is_on) ? ' active' : '';?>">
					<?php } ?>
						<?php if($menu[$i]['sub'][$j]['new'] == "new") { ?>
							<span class="rank-icon en bg-red pull-right">New</span>
						<?php } ?>
						<span class="panel-icon"></span> <b><?php echo $menu[$i]['sub'][$j]['name'];?></b>
						<?php if($menu[$i]['sub'][$j]['cnt']) { // 글수를 출력하고 싶으면 sr-only 삭제 ?>
							<span class="sr-only en lightgray font-11">&nbsp;<?php echo number_format($menu[$i]['sub'][$j]['cnt']);?></span>
						<?php } ?>
					</a>
				</div>
				<div class="list-group panel-collapse collapse<?php echo ($is_on) ? ' in' : '';?>" id="<?php echo $accordion_id;?>G<?php echo $m;?>">
					<?php for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { ?>
						<?php if($menu[$i]['sub'][$j]['sub'][$k]['line']) { //구분라인이 있을 때 ?>
							<a class="list-group-item list-group-line">
								<div class="div-title-wrap" style="margin:5px 0px;">
									<div class="div-title">
										<b><?php echo $menu[$i]['sub'][$j]['sub'][$k]['line'];?></b>
									</div>
									<div class="div-sep-wrap">
										<div class="div-sep sep-thin"></div>
									</div>
								</div>
							</a>
						<?php } ?>
						<a class="list-group-item" href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>>
							<?php if($menu[$i]['sub'][$j]['on'] == 'on' && $menu[$i]['sub'][$j]['sub'][$k]['on'] == 'on') { // 현재위치 표시 ?>
								<b class="crimson"><?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?></b>
								<i class="fa fa-spinner fa-spin red"></i>
							<?php } else { ?>
								<?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?>
							<?php } ?>
							<?php if($menu[$i]['sub'][$j]['sub'][$k]['new'] == "new") { ?>
								<span class="rank-icon en bg-blue pull-right">New</span>
							<?php } ?>
						</a>
					<?php } ?>
				</div>
			</div>

	<?php $m++;
		} 
	?>
</div>
