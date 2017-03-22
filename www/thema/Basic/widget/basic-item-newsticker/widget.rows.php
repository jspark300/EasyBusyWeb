<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 추출하기
$list = apms_item_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = apms_fa($wset['icon']);

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']);

?>

<?php for ($i=0; $i < $list_cnt; $i++) { ?>
	<div class="item<?php echo ($i == 0) ? ' active' : '';?>">
		<a href="<?php echo $list[$i]['href'];?>" class="ellipsis">
			<?php if($list[$i]['comment']) { ?>
				<span class="pull-right en font-11 lightgray"><i class="fa fa-comment"></i> <b class="red"><?php echo number_format($list[$i]['comment']);?></b> &nbsp;</span>
			<?php } ?>
			<?php if($wset['rank']) { ?>
				<span class="rank-icon en bg-<?php echo $wset['rank'];?>"><?php echo $rank; $rank++; ?></span>
			<?php } else if($wset['icon']) { ?>
				<?php if($list[$i]['new']) { ?>
					<span class="<?php echo $wset['new'];?>"><?php echo $icon;?></span>
				<?php } else { ?>
					<?php echo $icon;?>
				<?php } ?>
			<?php } ?>
			<?php echo $list[$i]['subject'];?>
		</a> 
	</div>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<div class="item active">
		<a class="ellipsis"><?php echo $icon;?> 자료가 없습니다.</a>
	</div>
<?php } ?>
