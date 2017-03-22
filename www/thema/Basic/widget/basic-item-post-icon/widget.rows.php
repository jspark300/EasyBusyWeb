<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 썸네일
$wset['thumb_w'] = $wset['thumb_h'] = 80;
if(!$wset['rows']) $wset['rows'] = 5;

// 추출하기
$list = apms_item_post_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = ($wset['icon']) ? apms_fa($wset['icon']) : '<i class="fa fa-user"></i>';

// 리스트
for ($i=0; $i < $list_cnt; $i++) {

	// 아이콘
	$wr_icon = '';
	if($list[$i]['img']['src']) {
		$wr_icon = '<img src="'.$list[$i]['img']['src'].'" alt="'.$list[$i]['img']['alt'].'">';
	} else if($list[$i]['photo']) {
		$wr_icon = '<img src="'.$list[$i]['photo'].'">';
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
					<?php if($list[$i]['new']) { ?>
						<span class="rank-icon en bg-<?php echo $wset['new'];?>">NEW</span>
					<?php } ?>
					<?php echo $list[$i]['subject'];?>
				</a>
			</strong>
			<div class="details ellipsis">
				<?php if($wset['mode'] == 'use') { // 후기 ?>
					<span class="font-14 red"><?php echo $list[$i]['star'];?></span>
					&nbsp;
				<?php } else if($wset['mode'] == 'qa') { // 문의 ?>
					<?php echo ($list[$i]['answer']) ? '답변완료' : '답변대기';?>
					&nbsp;
				<?php } else if($list[$i]['name']) { ?>
					<?php echo $list[$i]['name'];?>
					&nbsp;
				<?php } ?>
				<i class="fa fa-cube"></i>
				<?php echo $list[$i]['it_name'];?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="item-none text-muted text-center">글이 없습니다.</li>
<?php } ?>
