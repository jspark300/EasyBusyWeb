<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

$wset['thumb_w'] = ($wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
if($wset['thumb_h'] == "") $wset['thumb_h'] = 300;

// No-Image
$wset['no_img'] = $widget_url.'/img/no-img.jpg';

// 추출수
$wset['rows'] = $wset['slider'] * $wset['item'];

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list);

$img_height = apms_img_height($wset['thumb_w'], $wset['thumb_h'], 75);
$rank = apms_rank_offset($wset['rows'], $wset['page']); // 랭킹시작

//옵션보기
$is_details = ($wset['cmt'] || $wset['hit'] || $wset['good'] || $wset['down'] || $wset['date']) ? true : false;

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
								<div class="label-cap bg-<?php echo $wset['rank'];?>">Top<?php echo $rank; $rank++; ?></div>
							<?php } else if($list[$i]['new']) { ?>
								<div class="label-cap bg-<?php echo $wset['new'];?>">New</div>
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
					<?php if($is_details) { ?>
						<div class="item-details">
							<?php if($wset['cmt']) { ?>
								<span class="sp">
									<i class="fa fa-comment"></i>
									<?php echo ($list[$i]['wr_comment']) ? '<span class="red">'.number_format($list[$i]['wr_comment']).'</span>' : 0;?>
								</span>
							<?php } ?>
							<?php if($wset['hit']) { ?>
								<span class="sp">
									<i class="fa fa-eye"></i>
									<?php echo ($list[$i]['wr_hit']) ? '<span class="blue">'.number_format($list[$i]['wr_hit']).'</span>' : 0;?>
								</span>
							<?php } ?>
							<?php if($wset['good']) { ?>
								<span class="sp">
									<i class="fa fa-thumbs-up"></i>
									<?php echo ($list[$i]['wr_good']) ? '<span class="orangered">'.number_format($list[$i]['wr_good']).'</span>' : 0;?>
								</span>
							<?php } ?>
							<?php if($wset['down']) { ?>
								<span class="sp">
									<i class="fa fa-download"></i>
									<?php echo ($list[$i]['as_download']) ? '<span class="green">'.number_format($list[$i]['as_download']).'</span>' : 0;?>
								</span>
							<?php } ?>
							<?php if($wset['date']) { ?>
								<span class="sp">
									<i class="fa fa-clock-o"></i>
									<?php echo date("m.d", $list[$i]['date']);?>
								</span>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } // end for ?>
		<?php if(!$list_cnt) { ?>
			<div class="item-none text-muted text-center">글이 없습니다.</div>
		<?php } ?>
		<div class="clearfix"></div>
	</div>
</div>