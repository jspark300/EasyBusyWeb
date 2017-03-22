<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<style>
	.idx-box { padding:10px 0px 50px; }
	.idx-sidebox { padding:10px 0px 30px; }
</style>

<div class="at-content" style="padding-top:0px;">

	<?php echo apms_widget('basic-title-carousel', 'idx-shop-title', 'interval=5000 shadow=2'); //타이틀 위젯 ?>

	<div class="h30"></div>

	<div class="container">
		
		<div class="idx-box">
			<?php echo apms_widget('basic-item-gallery', 'idx-shop-hit', 'type=1 interval=6000 slider=2 item=4 shadow=2 cmt=1'); ?>
			<?php //echo apms_widget('basic-item-gallery-carousel', 'idx-shop-hit', 'type=1 interval=6000 slider=2 item=4 shadow=2 cmt=1 thumb_w=400 thumb_h=600'); ?>
		</div>


		

		<?php echo apms_line('fa', 'fa-info'); // 라인 ?>

		<style>
			.idx-footer ul { list-style: none; margin: 0px; padding: 0px; }
			.idx-footer ul.footer-icon { text-align:center; }
			.idx-footer ul.footer-icon li { float:left; margin-right:10px; }
			.idx-footer ul.footer-icon li span { display:block; white-space:nowrap; letter-spacing:-1px; margin-top:8px; }
		</style>

		<div class="idx-footer">
			<div class="row">
				<div class="col-md-3 col-sm-6 col">
					<h4>About</h4>
					<p>
						올이올은 서비스나 상품을 광고비 대신 받아서 여러분의 고객에게 복권을 추첨하는 방식으로 무료경품을 제공합니다.
					</p>
					<?php //SNS 아이콘
						$sns_share_url  = (IS_YC && IS_SHOP) ? G5_SHOP_URL : G5_URL;
						$sns_share_title = get_text($config['cf_title']);
						$sns_share_img = THEMA_URL.'/assets/img';
					?>
					<div class="sns-share-icon">
						<?php echo get_sns_share_link('facebook', $sns_share_url, $sns_share_title, $sns_share_img.'/sns_fb.png');?>
						<?php echo get_sns_share_link('twitter', $sns_share_url, $sns_share_title, $sns_share_img.'/sns_twt.png');?>
						<?php echo get_sns_share_link('googleplus', $sns_share_url, $sns_share_title, $sns_share_img.'/sns_goo.png');?>
						<?php echo get_sns_share_link('kakaostory', $sns_share_url, $sns_share_title, $sns_share_img.'/sns_kakaostory.png');?>
						<?php echo get_sns_share_link('kakaotalk', $sns_shareurl, $sns_share_title, $sns_share_img.'/sns_kakao.png');?>
						<?php echo get_sns_share_link('naverband', $sns_share_url, $sns_share_title, $sns_share_img.'/sns_naverband.png');?>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col">
					<h4>Service</h4>
					<ul class="footer-icon">
						<li>
							<a href="<?php echo $at_href['inquiry']; ?>">
								<i class="fa fa-truck circle normal bg-red"></i>
								<span>주문/배송</span>
							</a>
						</li>
						<li>
							<a href="<?php echo $at_href['ppay']; ?>">
								<i class="fa fa-ticket circle normal bg-blue"></i>
								<span>개인결제</span>
							</a>
						</li>
						<li>
							<a href="<?php echo $at_href['faq']; ?>">
								<i class="fa fa-question circle normal bg-green"></i>
								<span>FAQ</span>
							</a>
						</li>
						<li>
							<a href="<?php echo $at_href['secret'];?>">
								<i class="fa fa-user-secret circle normal bg-violet"></i>
								<span>1:1 문의</span>
							</a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="col-md-3 col-sm-6 col">
					<h4>Bank Info</h4>
					
					<ul>
						<li><a>국민은행 000000-00-000000</a></li>
						<li><a>기업은행 000-000000-00-000</a></li>
						<li><a>우리은행 0000-000-000000</a></li>
						<li><a>하나은행 000-00000000-000</a></li>
						<li>예금주 홍길동</li>
					</ul>
				</div>
				<div class="col-md-3 col-sm-6 col">
					<h4>CS Center</h4>
					<h2 class="en color" style="margin:0px 0px 12px; letter-spacing:-1px;">
						<b>000.0000.0000</b>
					</h2>
					<ul>
						<li>월-금 : 9:30 ~ 17:30</li>
						<li>런치타임 : 12:30 ~ 13:30</li>
						<li>토/일/공휴일은 휴무</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="h20"></div>
	</div>
</div>
