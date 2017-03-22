<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);

// 값정리
$gap_right = ($wset['gap_r'] == "") ? 10 : $wset['gap_r'];
$gap_bottom = ($wset['gap_b'] == "") ? 30 : $wset['gap_b'];
$wset['garo'] = ($wset['garo'] > 0) ? $wset['garo'] : 4;
$wset['sero'] = ($wset['sero'] > 0) ? $wset['sero'] : 5;

// 랜덤아이디
$apms_id = apms_id();
?>
<style>
	#<?php echo $apms_id;?> .item-wrap { margin-right:<?php echo ($gap_right > 0) ? '-'.$gap_right : 0;?>px; margin-bottom:<?php echo ($gap_bottom > 0) ? '-'.$gap_bottom : 0;?>px; }
	#<?php echo $apms_id;?> .item-row { width:<?php echo apms_img_width($wset['garo']);?>%; }
	#<?php echo $apms_id;?> .item-list { margin-right:<?php echo $gap_right;?>px; margin-bottom:<?php echo $gap_bottom;?>px; }
</style>
<div id="<?php echo $apms_id;?>" class="widget-basic-item-gallery<?php echo (G5_IS_MOBILE) ? ' item-mobile' : '';?>">
	<div class="item-wrap">
		<?php 
			if($wset['cache'] > 0) { // 캐시적용시
				echo apms_widget_cache($widget_path.'/widget.rows.php', $wname, $wid, $wset);
			} else {
				include($widget_path.'/widget.rows.php');
			}
		?>
		<div class="clearfix"></div>
	</div>
</div>
<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>
