<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = apms_fa($wset['icon']);

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']); 

// 리스트
for ($i=0; $i < $list_cnt; $i++) { 
?>
	<li>
		<a href="<?php echo $list[$i]['href'];?>" class="ellipsis">
			<?php if($list[$i]['comment']) { ?>
				<span class="pull-right count red"><?php echo number_format($list[$i]['comment']);?></span>
			<?php } else if($wset['comment']) { ?>
				<span class="pull-right name"><?php echo $list[$i]['name'];?></span>
			<?php } ?>
			<?php if($wset['rank']) { ?>
				<span class="rank-icon bg-<?php echo $wset['rank'];?> en"><?php echo $rank; $rank++; ?></span>
			<?php } else if($wset['icon']) { ?>
				<span class="icon">
					<?php if($list[$i]['new']) { ?>
						<span class="<?php echo $wset['new'];?>"><?php echo $icon;?></span>
					<?php } else { ?>
						<?php echo $icon;?>
					<?php } ?>
				</span>
			<?php } ?>
			<?php echo $list[$i]['subject'];?>
		</a> 
	</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="item-none text-muted text-center">글이 없습니다.</li>
<?php } ?>