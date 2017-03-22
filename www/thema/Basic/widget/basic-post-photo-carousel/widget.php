<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);

// 값정리
$wset['slider'] = ($wset['slider'] > 0) ? $wset['slider'] : 3;
$wset['garo'] = ($wset['garo'] > 0) ? $wset['garo'] : 3;
$wset['sero'] = ($wset['sero'] > 0) ? $wset['sero'] : 2;
$wset['item'] = $wset['garo'] * $wset['sero'];
$gap = ($wset['gap'] == "") ? 10 : $wset['gap']; // 간격
$minus = ($gap > 0) ? '-'.$gap : 0; //

$effect = apms_carousel_effect($wset['effect']);
$interval = apms_carousel_interval($wset['interval']);
$slider_id = apms_id(); // Random ID

?>
<style>
	#<?php echo $slider_id;?> .item-wrap { margin-right:<?php echo $minus;?>px;<?php echo (!$wset['shadow'] && $minus) ? ' margin-bottom:'.$minus.'px;':'';?>}
	#<?php echo $slider_id;?> .item-row {  width:<?php echo apms_img_width($wset['garo']);?>%; }
	#<?php echo $slider_id;?> .item-list { margin-right:<?php echo $gap;?>px; margin-bottom:<?php echo $gap;?>px; }
</style>
<div id="<?php echo $slider_id;?>" class="carousel div-carousel<?php echo $effect;?> widget-basic-post-photo-carousel" data-ride="carousel" data-interval="<?php echo $interval;?>">
	<div class="carousel-inner">
	<?php 
		if($wset['cache'] > 0) { // 캐시적용시
			echo apms_widget_cache($widget_path.'/widget.rows.php', $wname, $wid, $wset);
		} else {
			include($widget_path.'/widget.rows.php');
		}
	?>
	</div>
	<!-- Controls -->
	<a class="left carousel-control" href="#<?php echo $slider_id;?>" role="button" data-slide="prev">
		<i class="fa fa-chevron-left" aria-hidden="true"></i>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#<?php echo $slider_id;?>" role="button" data-slide="next">
		<i class="fa fa-chevron-right" aria-hidden="true"></i>
		<span class="sr-only">Next</span>
	</a>
</div>
<?php if($wset['shadow']) echo apms_shadow($wset['shadow']); //그림자 ?>
<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>
