<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

$wset['thumb_w'] = ($wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
if($wset['thumb_h'] == "") $wset['thumb_h'] = 400;

// No-Image
$wset['no_img'] = $widget_url.'/img/no-img.jpg';

// 추출수
$wset['rows'] = $wset['slider'] * $wset['item'];

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list); // 글수

// 높이
$img_height = apms_img_height($wset['thumb_w'], $wset['thumb_h'], 100);

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']);

?>

<div class="item active">
	<div class="item-wrap">
		<?php // 리스트
			for ($i=0; $i < $list_cnt; $i++) {
		?>
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
								<div class="item-caption trans-bg-black">
									<?php echo $list[$i]['subject'];?>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php } // end for ?>
		<?php if(!$list_cnt) { ?>
			<div class="item-none text-muted text-center">글이 없습니다.</div>
		<?php } ?>
		<div class="clearfix"></div>
	</div>
</div>