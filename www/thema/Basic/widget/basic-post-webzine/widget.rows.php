<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

$wset['thumb_w'] = ($wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
if($wset['thumb_h'] == "") $wset['thumb_h'] = 300;

// No-Image
$wset['no_img'] = ($wset['noimg']) ? $widget_url.'/img/no-img.jpg' : '';

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list);

// 높이
$img_height = apms_img_height($wset['thumb_w'], $wset['thumb_h'], 75);

// 너비
$img_width = ($wset['img_w'] > 0) ? $wset['img_w'] : 120;

// 위치
$img_align = ($wset['align']) ? 'right img-right' : 'left img-left';

// 내용
$cont_len = ($wset['cont'] > 0) ? $wset['cont'] : 60;

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']);

// 리스트
for ($i=0; $i < $list_cnt; $i++) { 
?>
<li>
	<div class="media">
		<?php if($list[$i]['img']['src']) { ?>
			<div class="img pull-<?php echo $img_align;?>" style="width:<?php echo $img_width;?>px;">
				<div class="imgframe">
					<div class="img-wrap" style="padding-bottom:<?php echo $img_height;?>%;">
						<div class="img-item">
							<a href="<?php echo $list[$i]['href'];?>">
								<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>">
							</a>
						</div>
					</div>
				</div>
				<?php if($wset['shadow']) echo apms_shadow($wset['shadow']); //그림자 ?>
			</div>
		<?php } ?>
		<div class="media-body">
			<strong class="media-heading">
				<a href="<?php echo $list[$i]['href'];?>">
					<?php if($wset['rank']) { ?>
						<span class="rank-icon en bg-<?php echo $wset['rank'];?>"><?php echo $rank; $rank++; ?></span>
					<?php } else if($list[$i]['new']) { ?>
						<span class="rank-icon en bg-<?php echo $wset['new'];?>">NEW</span>
					<?php } ?>
					<?php echo $list[$i]['subject'];?>
				</a>
			</strong>
			<div class="details">
				<i class="fa fa-user"></i>
				<span class="font-12"><?php echo $list[$i]['name'];?></span>
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
					<span class="sp hidden-xs">
						<i class="fa fa-eye"></i>
						<?php echo ($list[$i]['hit']) ? '<span class="blue">'.number_format($list[$i]['hit']).'</span>' : 0;?>
					</span>
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
			</div>
			<?php if($cont_len > 0) { ?>
				<div class="cont">
					<a href="<?php echo $list[$i]['href'];?>">
						<span class="text-muted">
							<?php echo apms_cut_text($list[$i]['content'], $cont_len,'… <span class="font-11">더보기</span>');?>
						</span>
					</a>
				</div>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="item-none text-muted text-center">글이 없습니다.</li>
<?php } ?>
