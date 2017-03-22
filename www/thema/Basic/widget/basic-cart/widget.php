<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

global $at_href;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);

// 값정리
$wset['thumb_w'] = $wset['thumb_h'] = 400;

// 추출하기
$list = apms_cart_rows($wset);
$list_cnt = count($list);

?>
<style>
	.widget-basic-cart .row { margin:0; padding:0; }
	.widget-basic-cart .row .col { margin:0; padding:0; }
	.widget-basic-cart .row i { margin-bottom:8px; }
	.widget-basic-cart .row span { display:block; }
	.widget-basic-cart .content-box { margin-bottom:0; }
	<?php if($list_cnt) { $slider_id = apms_id(); // 랜덤아이디 ?>
	#<?php echo $slider_id;?> .item-wrap { overflow:hidden; margin-right:10px; margin-bottom:-10px; }
	#<?php echo $slider_id;?> .item-row { float:left; width:33.3%; }
	#<?php echo $slider_id;?> .item-list { margin-right:10px; margin-bottom:10px; }
	<?php } ?>
</style>
<div class="widget-basic-cart">
	<div class="row text-center">
		<div class="col-xs-3 col">
			<div class="content-box text-center">
				<div class="heading">
					<a href="<?php echo $at_href['inquiry']; ?>">
						<i class="fa fa-truck circle light-circle normal"></i>
						<span>주문/배송</span>
					</a>
				</div>
			</div>
		</div>
		<div class="col-xs-3 col">
			<div class="content-box text-center">
				<div class="heading">
					<a href="<?php echo $at_href['ppay']; ?>">
						<i class="fa fa-ticket circle light-circle normal"></i>
						<span>개인결제</span>
					</a>
				</div>
			</div>
		</div>
		<div class="col-xs-3 col">
			<div class="content-box text-center">
				<div class="heading">
					<a href="<?php echo $at_href['faq']; ?>">
						<i class="fa fa-question circle light-circle normal"></i>
						<span>FAQ</span>
					</a>
				</div>
			</div>
		</div>
		<div class="col-xs-3 col">
			<div class="content-box text-center">
				<div class="heading">
					<a href="<?php echo $at_href['secret'];?>">
						<i class="fa fa-user-secret circle light-circle normal"></i>
						<span>1:1 문의</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php if($list_cnt) { ?>
		<div class="div-title-block-thin text-center" style="margin-top:10px;">
			<a href="<?php echo $at_href['cart']; ?>">
				<b><span>장바구니 보기</span></b>
			</a>
		</div>
		<div id="<?php echo $slider_id;?>" class="carousel div-carousel slide" data-ride="carousel" data-interval="5000">
			<div class="carousel-inner">
				<div class="item active">
					<div class="item-wrap">
						<?php  for ($i=0; $i < $list_cnt; $i++) { // 리스트 ?>
							<?php if($i > 0 && $i%3 == 0) { ?>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="item">
									<div class="item-wrap">
							<?php } ?>
							<div class="item-row">
								<div class="item-list">
									<div class="imgframe">
										<div class="img-wrap" style="padding-bottom:100%;">
											<div class="img-item">
												<a href="<?php echo $list[$i]['href'];?>" title="<?php echo $list[$i]['alt'];?>">
													<img src="<?php echo $list[$i]['img'];?>" alt="<?php echo $list[$i]['alt'];?>">
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } // end for ?>
						<div class="clearfix"></div>
					</div>
				</div>

			</div>
			<!-- Controls -->
			<a class="left carousel-control" href="#<?php echo $slider_id;?>" role="button" data-slide="prev">
				<i class="fa fa-chevron-left" aria-hidden="true"></i>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#<?php echo $slider_id;?>" role="button" data-slide="next">
				<i class="fa fa-chevron-right" aria-hidden="true"></i>
				<span class="sr-only">Next</span>
			</a>
		</div>
	<?php } ?>
</div>