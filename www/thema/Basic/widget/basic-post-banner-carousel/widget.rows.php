<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

$wset['thumb_w'] = ($wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
if($wset['thumb_h'] == "") $wset['thumb_h'] = 160;

// 추출수
$wset['rows'] = $wset['slider'] * $wset['item'];

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list);

$img_height = apms_img_height($wset['thumb_w'], $wset['thumb_h'], 40);

?>

<div class="item active">
	<div class="item-wrap">
		<?php for ($i=0; $i < $list_cnt; $i++) { // 리스트 ?>
			<?php if($i > 0 && $i%$wset['item'] == 0) { ?>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="item">
					<div class="item-wrap">
			<?php } ?>
			<div class="item-row">
				<div class="item-list">
					<div class="img-wrap" style="padding-bottom:<?php echo $img_height;?>%;">
						<div class="img-item">
							<?php if($wset['rank']) { ?>
								<div class="label-icon rank-icon en bg-<?php echo $wset['rank'];?>"><?php echo $rank; $rank++; ?></div>
							<?php } else if($list[$i]['new']) { ?>
								<div class="label-icon rank-icon en bg-<?php echo $wset['new'];?>">NEW</div>
							<?php } ?>
							<a href="<?php echo $list[$i]['href'];?>">
								<img draggable="false" src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>">
							</a>
							<div class="item-caption ellipsis trans-bg-black">
								<?php echo $list[$i]['subject'];?>
							</div>
						</div>
					</div>
					<?php if($wset['shadow']) echo apms_shadow($wset['shadow']); //그림자 ?>
				</div>
			</div>
		<?php } // end for ?>
		<?php if(!$list_cnt) { ?>
			<div class="item-none text-muted text-center">글이 없습니다.</div>
		<?php } ?>
		<div class="clearfix"></div>
	</div>
</div>