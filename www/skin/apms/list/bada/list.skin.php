<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/style.css" media="screen">', 0);

// 높이
$img_h = apms_img_height($thumb_w, $thumb_h);

// 너비
$item_w = apms_img_width($list_mods);

// 간격
$gap_right = ($wset['gap_r'] == "") ? 10 : $wset['gap_r'];
$gap_bottom = ($wset['gap_b'] == "") ? 30 : $wset['gap_b'];

// 새상품
$new_item = ($wset['newtime']) ? $wset['newtime'] : 24;

$list_cnt = count($list);

include_once($list_skin_path.'/category.skin.php');
?>
<!--div class="text-right" style="margin:30px 0px;"><a href="/bbs/page.php?hid=register_product"  class="btn btn-color" role="button">상품등록</a> 회원이시면 상품을 등록하실 수 있습니다. </div -->
<div class="text-right" style="margin:30px 0px;"><!--a href="/bbs/page.php?hid=register_product&ca_id=<?=$ca_id?>"><img src="/img/a-C.jpg"></a--></div>

<!-- div class="imgframe">
	<div class="img-wrap" style="padding-bottom:4.13%;margin-bottom:10px;">
		<div class="img-item img-full">
			<a href="/bbs/page.php?hid=register_product"><img src="/img/a-C.jpg"></a>
		</div>
	</div>
</div -->

<style>
	.list-wrap .list-container { overflow:hidden; margin-right:<?php echo ($gap_right > 0) ? '-'.$gap_right : 0;?>px; margin-bottom:<?php echo ($gap_bottom > 15) ? 0 : 15;?>px; }
	.list-wrap .list-row { float:left; width:<?php echo $item_w;?>%; }
	.list-wrap .list-item { margin-right:<?php echo $gap_right;?>px; margin-bottom:<?php echo $gap_bottom;?>px; }
</style>

<div class="list-wrap<?php echo (G5_IS_MOBILE) ? ' list-mobile' : '';?>">
	<div class="list-container">
		<?php 
			for ($i=0; $i < $list_cnt; $i++) { 

				$item_label = $cur_price = $dc = '';
				if($list[$i]['it_cust_price'] > 0 && $list[$i]['it_price'] > 0) {
					$dc = round((($list[$i]['it_cust_price'] - $list[$i]['it_price']) / $list[$i]['it_cust_price']) * 100);
					$cur_price = '<div class="cur-price"><strike>&nbsp;'.number_format($list[$i]['it_cust_price']).'</strike></div>';
				}

				if($list[$i]['it_id'] == $it_id) {
					$item_label = '<div class="label-cap bg-green">Now</div>';	
				} else if($dc || $list[$i]['it_type5']) {
					$item_label = '<div class="label-cap bg-red">DC</div>';	
				} else if($list[$i]['it_type3'] || $list[$i]['pt_num'] >= (G5_SERVER_TIME - ($new_item * 3600))) {
					$item_label = '<div class="label-cap bg-'.$wset['new'].'">New</div>';
				}

				// 이미지
				$img = apms_it_thumbnail($list[$i], $thumb_w, $thumb_h, false, true);

				// 아이콘
				$item_icon = item_icon($list[$i]);
				$item_icon = ($item_icon) ? '<div class="label-tack">'.$item_icon.'</div>' : '';

		?>
			<?php if($i > 0 && $i%$list_mods == 0) { ?>
				<div class="clearfix"></div>
			<?php } ?>
				<div class="list-row">
					<div class="list-item">
					<a href="<?php echo $list[$i]['href'];?>">
						<?php if($thumb_h) { // 이미지 높이값이 있을 경우?>
							<div class="imgframe">
								<div class="img-wrap" style="padding-bottom:<?php echo $img_h;?>%;">
									<?php echo $item_icon;?>
									<?php //echo $item_label;?>
									<div class="img-item">

										
											<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>">
										
										<?php if($dc) { ?>
											<div class="<?php echo ($cur_price) ? 'label-dc-cur' : 'label-dc';?> en">
												<?php echo $cur_price;?>
												<?php echo $dc;?>%
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="list-img">
								<?php echo $item_icon;?>
								<?php //echo $item_label;?>
								
									<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>">
							
								<?php if($dc) { ?>
									<div class="<?php echo ($cur_price) ? 'label-dc-cur' : 'label-dc';?> en">
										<?php echo $cur_price;?>
										<?php echo $dc;?>%
									</div>
								<?php } ?>
							</div>
						<?php } ?>
						</a>
						<?php if($wset['shadow']) echo apms_shadow($wset['shadow']); //그림자 ?>
						<div class="list-content">
							<?php if($wset['star']) { ?>
								<div class="list-star text-center">
									<?php echo apms_get_star($list[$i]['it_use_avg'], 'fa-2x '.$wset['scolor']); //평균별점 ?>
								</div>
							<?php } ?>
							<strong>
								<a href="<?php echo $list[$i]['href'];?>">
									<?php echo $list[$i]['it_name'];?>
								</a>
							</strong>
							<?php if($list[$i]['it_basic']) { ?>
								<div class="list-desc text-center text-muted">
									<?php echo $list[$i]['it_basic']; ?>
								</div>
							<?php } ?>
							<div class="list-details">
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
								<div class="list-sns">
									<?php 
										$sns_url  = G5_SHOP_URL.'/item.php?it_id='.$list[$i]['it_id'];
										$sns_title = get_text($list[$i]['it_name'].' | '.$config['cf_title']);
										$sns_img = $list_skin_url.'/img';
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
			<?php } ?>
			<div class="clearfix"></div>
		</div>
	<?php if (!$i) { ?>
		<div class="text-center text-muted list-none">등록된 자료가 없습니다.</div>
	<?php } ?>
</div>

<div style="list-btn">
	<?php if($total_page > 1) { ?>
		<div class="list-page pull-left">
			<ul class="pagination pagination-sm en">
				<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
			</ul>
			<div class="clearfix"></div>
		</div>
	<?php } ?>
	<div class="pull-right">
		<div class="btn-group">
			<?php if ($is_event) { ?>
				<a class="btn btn-color btn-sm" href="./event.php"><i class="fa fa-gift"></i> 이벤트</a>
			<?php } ?>
			<?php if ($write_href) { ?>
				<a class="btn btn-black btn-sm" href="<?php echo $write_href;?>"><i class="fa fa-upload"></i><span class="hidden-xs"> 등록</span></a>
			<?php } ?>
			<?php if ($admin_href) { ?>
				<a class="btn btn-black btn-sm" href="<?php echo $admin_href;?>"><i class="fa fa-th-large"></i><span class="hidden-xs"> 관리</span></a>
			<?php } ?>
			<?php if ($config_href) { ?>
				<a class="btn btn-black btn-sm" href="<?php echo $config_href;?>"><i class="fa fa-cog"></i><span class="hidden-xs"> 설정</span></a>
			<?php } ?>
			<?php if($setup_href) { ?>
				<a class="btn btn-black btn-sm win_memo" href="<?php echo $setup_href;?>"><i class="fa fa-cogs"></i><span class="hidden-xs"> 스킨설정</span></a>
			<?php } ?>
			<?php if ($rss_href) { ?>
				<a class="btn btn-color btn-sm" title="카테고리 RSS 구독하기" href="<?php echo $rss_href;?>" target="_blank"><i class="fa fa-rss fa-lg"></i></a>
			<?php } ?>
		</div>
		<div class="h30"></div>
	</div>
	<div class="clearfix"></div>
</div>
