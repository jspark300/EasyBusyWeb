<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 썸네일
$wset['thumb_w'] = $wset['thumb_h'] = 80;
if(!$wset['rows']) $wset['rows'] = 6;

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = ($wset['icon']) ? apms_fa($wset['icon']) : '<i class="fa fa-user"></i>';

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']); 

// 리스트
for ($i=0; $i < $list_cnt; $i++) {

	// 아이콘
	$wr_icon = '';
	if($list[$i]['img']['src']) {
		$wr_icon = '<img src="'.$list[$i]['img']['src'].'" alt="'.$list[$i]['img']['alt'].'">';
	} else if($list[$i]['as_icon']) {
		$wr_icon = apms_fa(apms_emo($list[$i]['as_icon']));
	} else if($list[$i]['mb_id']) {
		$wr_icon = apms_photo_url($list[$i]['mb_id']);
		$wr_icon = ($wr_icon) ? '<img src="'.$wr_icon.'">' : '';
	}

	$wr_icon = ($wr_icon) ? $wr_icon : $icon;

?>
<li>
	<div class="media">
		<div class="pull-left">
			<a href="<?php echo $list[$i]['href'];?>">
				<span class="fix-icon circle normal">
					<?php echo $wr_icon;?>
				</span>
			</a>
		</div>
		<div class="media-body">
			<strong class="media-heading ellipsis">
				<a href="<?php echo $list[$i]['href'];?>">
					<?php if($wset['rank']) { ?>
						<span class="rank-icon en bg-<?php echo $wset['rank'];?>"><?php echo $rank; $rank++; ?></span>
					<?php } else if($list[$i]['new']) { ?>
						<span class="rank-icon en bg-<?php echo $wset['new'];?>">NEW</span>
					<?php } ?>
					<?php echo $list[$i]['subject'];?>
				</a>
			</strong>
			<div class="details ellipsis">
				<i class="fa fa-user"></i>
				<span class="font-12"><?php echo $list[$i]['name'];?></span>
				<?php if($wset['comment']) { // 댓글일 때?>
					<span class="sp">
						<i class="fa fa-clock-o"></i>
						<?php echo date("m.d H:i", $list[$i]['date']);?>
					</span>
				<?php } else { ?>
					<?php if($wset['cate'] && $list[$i]['category']) { ?>
						<span class="sp font-12 hidden-xs">
							<i class="fa fa-tag"></i>
							<?php echo $list[$i]['category'];?>
						</span>
					<?php } ?>
					<?php if($wset['cmt']) { ?>
						<span class="sp">
							<i class="fa fa-comment"></i>
							<?php echo ($list[$i]['comment']) ? '<span class="red">'.number_format($list[$i]['comment']).'</span>' : 0;?>
						</span>
					<?php } ?>
					<?php if($wset['hit']) { ?>
						<i class="fa fa-eye"></i>
						<?php echo ($list[$i]['hit']) ? '<span class="blue">'.number_format($list[$i]['hit']).'</span>' : 0;?>
					<?php } ?>
					<?php if($wset['good']) { ?>
						<span class="sp">
							<i class="fa fa-thumbs-up"></i>
							<?php echo ($list[$i]['good']) ? '<span class="orangered">'.number_format($list[$i]['good']).'</span>' : 0;?>
						</span>
					<?php } ?>
					<?php if($wset['down']) { ?>
						<span class="sp">
							<i class="fa fa-download"></i>
							<?php echo ($list[$i]['as_download']) ? '<span class="green">'.number_format($list[$i]['as_download']).'</span>' : 0;?>
						</span>
					<?php } ?>
					<?php if($wset['date']) { ?>
						<span class="sp hidden-xs">
							<i class="fa fa-clock-o"></i>
							<?php echo date("m.d", $list[$i]['date']);?>
						</span>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="item-none text-muted text-center">글이 없습니다.</li>
<?php } ?>
