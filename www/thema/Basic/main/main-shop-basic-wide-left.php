<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<style>
	.idx-box { padding:10px 0px 50px; }
	.idx-sidebox { padding:10px 0px 30px; }
	@media all and (max-width:767px) {
		.responsive .main-col.pull-left,
		.responsive .main-col.pull-right { float:none !important; }
	}
</style>

<div class="at-content" style="padding-top:0px;">
	<?php // 중앙 시작 ---------------------------------- ?>

	<?php echo apms_widget('basic-title-carousel', 'idx-shop-title', 'interval=5000 shadow=2'); //타이틀 위젯 ?>
	<div class="h30"></div>

	<?php // 중앙 상단 끝 ---------------------------------- ?>

	<div class="container">
		<div class="row">
			<div class="col-md-9 main-col pull-right">

				<div class="div-title-block-bold text-center">
					<h3 class="en no-margin">
						<a href="<?php echo $at_href['itype'];?>?type=1">
							<span><i class="fa fa-bolt lightgray"></i> Best</span>
						</a>
					</h3>
				</div>
				<div class="idx-box">
					<?php echo apms_widget('basic-item-gallery-carousel', 'idx-shop-hit', 'type=1 interval=6000 slider=2 item=4 shadow=2 cmt=1 thumb_w=400 thumb_h=600'); ?>
				</div>


				<div class="div-title-block-bold text-center">
					<h3 class="en no-margin">
						<a href="<?php echo $at_href['itype'];?>?type=2">
							<span><i class="fa fa-thumbs-up lightgray"></i> Cool</span>
						</a>
					</h3>
				</div>
				<div class="idx-box">
					<?php echo apms_widget('basic-item-gallery-carousel', 'idx-shop-cool', 'type=2 interval=7000 slider=2 item=4 shadow=2 cmt=1 thumb_w=400 thumb_h=600'); ?>
				</div>


				<div class="div-title-block-bold text-center">
					<h3 class="en no-margin">
						<a href="<?php echo $at_href['itype'];?>?type=4">
							<span><i class="fa fa-heart lightgray"></i> Popular</span>
						</a>
					</h3>
				</div>
				<div class="idx-box">
					<?php echo apms_widget('basic-item-gallery-carousel', 'idx-shop-popular', 'type=4 interval=8000 slider=2 item=4 shadow=2 cmt=1 thumb_w=400 thumb_h=600'); ?>
				</div>


				<div class="div-title-block-bold text-center">
					<h3 class="en no-margin">
						<a href="<?php echo $at_href['itype'];?>?type=5">
							<span><i class="fa fa-gift lightgray"></i> Discount</span>
						</a>
					</h3>
				</div>
				<div class="idx-box">
					<?php echo apms_widget('basic-item-gallery-carousel', 'idx-shop-dc', 'type=5 interval=6000 slider=2 item=4 shadow=2 cmt=1 thumb_w=400 thumb_h=600'); ?>
				</div>


				<div class="div-title-block-bold text-center">
					<h3 class="en no-margin">
						<a href="<?php echo $at_href['itype'];?>?type=3">
							<span><i class="fa fa-paper-plane lightgray"></i> New Arrival</span>
						</a>
					</h3>
				</div>
				<div class="idx-box" style="padding-bottom:10px;">
					<?php echo apms_widget('basic-item-gallery-carousel', 'idx-shop-new', 'type=3 interval=5000 slider=2 item=4 shadow=2 cmt=1 thumb_w=400 thumb_h=600'); ?>
				</div>

				<?php echo apms_line('fa', 'fa-cube'); // 라인 ?>

				<div class="idx-box">
					<?php echo apms_widget('basic-item-gallery', 'idx-shop-item', 'garo=4 sero=2 shadow=2 cmt=1 thumb_w=400 thumb_h=600'); ?>
				</div>

				<?php // 중앙 끝 ---------------------------------- ?>

			</div>
			<div class="col-md-3 main-col pull-left">

				<?php // 우측 시작 ---------------------------------- ?>

				<div class="hidden-sm hidden-xs">
					<?php echo apms_widget('basic-outlogin'); // 외부로그인 - 768px 이하에서 숨김(hidden-xs) ?>
					<div class="h10"></div>
				</div>

				<div class="idx-sidebox" style="padding-top:0px;">
					<?php echo apms_widget('basic-cart'); // 장바구니 등 ?>
				</div>

				<div class="div-title-wrap no-margin">
					<div class="div-title">
						<a href="#">
							<b>알림장</b>
						</a>
					</div>
					<div class="div-sep-wrap">
						<div class="div-sep sep-thin"></div>
					</div>
				</div>
				<div class="idx-sidebox">
					<?php echo apms_widget('basic-post-list', 'idx-post-notice', 'new=red icon={아이콘:caret-right} rows=7'); ?>
				</div>

				<div class="idx-sidebox" style="padding-top:0px;">
					<?php echo apms_widget('basic-event-banner-carousel', 'idx-shop-event', 'interval=5000 shadow=1'); // 이벤트 ?>
				</div>

				<div class="div-title-wrap no-margin">
					<div class="div-title">
						<a href="<?php echo $at_href['iuse'];?>">
							<b>최근후기</b>
						</a>
					</div>
					<div class="div-sep-wrap">
						<div class="div-sep sep-thin"></div>
					</div>
				</div>
				<div class="idx-sidebox">
					<?php echo apms_widget('basic-item-post-icon', 'idx-item-use', 'mode=use rows=7 new=red'); ?>
				</div>

				<div class="div-title-wrap no-margin">
					<div class="div-title">
						<a href="<?php echo $at_href['iqa'];?>">
							<b>최근문의</b>
						</a>
					</div>
					<div class="div-sep-wrap">
						<div class="div-sep sep-thin"></div>
					</div>
				</div>
				<div class="idx-sidebox">
					<?php echo apms_widget('basic-item-post-icon', 'idx-item-qa', 'mode=qa rows=7 new=blue'); ?>
				</div>

				<div class="div-title-wrap no-margin">
					<div class="div-title">
						<b>최근댓글</b>
					</div>
					<div class="div-sep-wrap">
						<div class="div-sep sep-thin"></div>
					</div>
				</div>
				<div class="idx-sidebox">
					<?php echo apms_widget('basic-item-post-icon', 'idx-item-comment', 'mode=comment rows=7 new=green'); ?>
				</div>


				<div class="idx-sidebox" style="padding-top:0px;">
					<?php echo apms_widget('basic-banner-carousel', 'idx-shop-banner', 'interval=5000'); // 배너 ?>
				</div>


				<div class="div-title-wrap no-margin">
					<div class="div-title">
						<a href="<?php echo $at_href['secret'];?>">
							<b>고객센터</b>
						</a>
					</div>
					<div class="div-sep-wrap">
						<div class="div-sep sep-thin"></div>
					</div>
				</div>
				<div class="idx-sidebox" style="padding-left:12px;">
					<div class="en red font-24">
						<i class="fa fa-phone"></i> <b>000.0000.0000</b>
					</div>

					<div class="h10"></div>

					<div class="help-block">
						월-금 : 9:30 ~ 17:30
						<br>
						런치타임 : 12:30 ~ 13:30
						<br>
						토/일/공휴일은 휴무
					</div>

					<h4>Bank Info</h4>
					
					국민은행 000000-00-000000
					<br>
					기업은행 000-000000-00-000
					<br>
					예금주 홍길동
				</div>

				<div class="idx-sidebox sns-share-icon text-center">
					<?php // 소셜 보내기
						$sns_url  = G5_URL;
						$sns_title = get_text($config['cf_title']);
						$sns_img = THEMA_URL.'/assets/img';
						echo  get_sns_share_link('facebook', $sns_url, $sns_title, $sns_img.'/sns_fb.png').' ';
						echo  get_sns_share_link('twitter', $sns_url, $sns_title, $sns_img.'/sns_twt.png').' ';
						echo  get_sns_share_link('googleplus', $sns_url, $sns_title, $sns_img.'/sns_goo.png').' ';
						echo  get_sns_share_link('kakaostory', $sns_url, $sns_title, $sns_img.'/sns_kakaostory.png').' ';
						echo  get_sns_share_link('kakaotalk', $sns_url, $sns_title, $sns_img.'/sns_kakao.png').' ';
						echo  get_sns_share_link('naverband', $sns_url, $sns_title, $sns_img.'/sns_naverband.png').' ';
					?>
				</div>

				<?php // 우측 끝 ---------------------------------- ?>

			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
