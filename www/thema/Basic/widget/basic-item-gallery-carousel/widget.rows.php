<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

$wset['thumb_w'] = ($wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
if($wset['thumb_h'] == "") $wset['thumb_h'] = 400;

// 추출수
$wset['rows'] = $wset['slider'] * $wset['item'];

// 추출하기
$list = apms_item_rows($wset);
$list_cnt = count($list);

$img_height = apms_img_height($wset['thumb_w'], $wset['thumb_h'], 100);
$rank = apms_rank_offset($wset['rows'], $wset['page']);
$new_item = ($wset['newtime']) ? $wset['newtime'] : 24;

?>

<div class="item active">
	<div class="item-wrap">
		<?php  // 리스트 
			for ($i=0; $i < $list_cnt; $i++) {
				$item_label = $cur_price = $dc = '';
				if($list[$i]['it_cust_price'] > 0 && $list[$i]['it_price'] > 0) {
					$dc = round((($list[$i]['it_cust_price'] - $list[$i]['it_price']) / $list[$i]['it_cust_price']) * 100);
					$cur_price = '<div class="cur-price"><strike>&nbsp;'.number_format($list[$i]['it_cust_price']).'</strike></div>';
				}

				if($wset['rank']) {
					$rank_txt = ($rank < 4) ? 'Top'.$rank : $rank.'th';
					$item_label = '<div class="label-cap bg-red">'.$rank_txt.'</div>'; $rank++;
				} else if($dc || $list[$i]['it_type5']) {
					$item_label = '<div class="label-cap bg-red">DC</div>';	
				} else if($list[$i]['it_type3'] || $list[$i]['pt_num'] >= (G5_SERVER_TIME - ($new_item * 3600))) {
					$item_label = '<div class="label-cap bg-'.$wset['new'].'">New</div>';
				}

				// 아이콘
				$item_icon = item_icon($list[$i]);
				$item_icon = ($item_icon) ? '<div class="label-tack">'.$item_icon.'</div>' : '';
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
					<div class="imgframe">
						<div class="img-wrap" style="padding-bottom:<?php echo $img_height;?>%;">
							<?php echo $item_icon;?>
							<?php echo $item_label;?>
							<div class="img-item">
								<a href="<?php echo $list[$i]['href'];?>">
									<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>">
								</a>
								<?php if($dc) { ?>
									<div class="<?php echo ($cur_price) ? 'label-dc-cur' : 'label-dc';?> en">
										<?php echo $cur_price;?>
										<?php echo $dc;?>%
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php if($wset['shadow']) echo apms_shadow($wset['shadow']); //그림자 ?>
					<div class="content">
						<?php if($wset['star']) { ?>
							<div class="star text-center">
								<?php echo apms_get_star($list[$i]['it_use_avg'], 'fa-2x '.$wset['scolor']); //평균별점 ?>
							</div>
						<?php } ?>
						<strong class="ellipsis">
							<a href="<?php echo $list[$i]['href'];?>">
								<?php echo $list[$i]['it_name'];?>
							</a>
						</strong>
						<div class="desc ellipsis text-center text-muted">
							<?php echo ($list[$i]['it_basic']) ? $list[$i]['it_basic'] : apms_cut_text($list[$i]['it_explan'], 60); ?>
						</div>
						<div class="details">
							<div class="pull-left en font-13 text-muted">
								<?php if($wset['cmt']) { ?>
									<i class="fa fa-comment"></i> 
									<?php echo ($list[$i]['pt_comment']) ? '<span class="red">'.number_format($list[$i]['pt_comment']).'</span>' : 0;?>
								<?php } ?>
								<?php if($wset['buy']) { ?>
									&nbsp;
									<i class="fa fa-shopping-cart"></i> <?php echo ($list[$i]['it_sum_qty']) ? '<span class="blue">'.number_format($list[$i]['it_sum_qty']).'</span>' : 0;?>
								<?php } ?>
								<?php if($list[$i]['it_point']) { ?>
									&nbsp;
									<i class="fa fa-gift"></i> 
									<span class="green"><?php echo ($list[$i]['it_point_type'] == 2) ? $list[$i]['it_point'].'%' : number_format(get_item_point($list[$i]));?></span>
								<?php } ?>
							</div>
							<div class="pull-right font-16 en">
								<b><?php echo ($list[$i]['it_tel_inq']) ? 'Call' : number_format($list[$i]['it_price']);?></b>
							</div>
							<div class="clearfix"></div>
						</div>
						<?php if($wset['sns']) { ?>
							<div class="sns">
								<?php 
									$sns_url  = G5_SHOP_URL.'/item.php?it_id='.$list[$i]['it_id'];
									$sns_title = get_text($list[$i]['it_name']);
									$sns_img = $widget_url.'/img';
									echo  get_sns_share_link('facebook', $sns_url, $sns_title, $sns_img.'/sns_fb_s.png').' ';
									echo  get_sns_share_link('twitter', $sns_url, $sns_title, $sns_img.'/sns_twt_s.png').' ';
									echo  get_sns_share_link('googleplus', $sns_url, $sns_title, $sns_img.'/sns_goo_s.png').' ';
									echo  get_sns_share_link('kakaostory', $sns_url, $sns_title, $sns_img.'/sns_kakaostory_s.png').' ';
									echo  get_sns_share_link('kakaotalk', $sns_url, $sns_title, $sns_img.'/sns_kakao_s.png').' ';
									echo  get_sns_share_link('naverband', $sns_url, $sns_title, $sns_img.'/sns_naverband_s.png').' ';
								?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } // end for ?>
		<?php if(!$list_cnt) { ?>
			<div class="item-none text-muted text-center">자료가 없습니다.</div>
		<?php } ?>
		<div class="clearfix"></div>
	</div>
</div>
