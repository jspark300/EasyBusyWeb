<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<style>
	.idx-box { padding:10px 0px 50px; }
	.idx-sidebox { padding:10px 0px 30px; }
</style>

<div class="at-content">
	<div class="container">
		<div class="row">
			<div class="col-md-9">

				<?php // 중앙 시작 ---------------------------------- ?>

				<?php echo apms_widget('basic-title-carousel', 'idx-shop-title', 'interval=5000 shadow=2'); //타이틀 위젯 ?>

				<div class="h30"></div>


<!-- div class="imgframe">
	<div class="img-wrap" style="padding-bottom:4.13%;">
		<div class="img-item img-full">
			<a href="/shop/list.php?ca_id=10"><img src="/img/book-C.jpg"></a>
		</div>
	</div>
</div -->

				<!-- div class="div-title-block-bold text-left">
					<h3 class="en no-margin">
						<a href="/shop/list.php?ca_id=30">
							<span><img src="/img/a-C.jpg"><img src="/img/book-C.jpg"></span>
						</a>
					</h3>
				</div -->
				<div class="idx-box">
					<?php echo apms_widget('basic-item-gallery-bada', 'idx-shop-hit', 'type=1 interval=6000 slider=2 item=4 shadow=2 cmt=1'); ?>
				</div>



				<?php //echo apms_line('fa', 'fa-cube'); // 라인 ?>



		<!-- div class="row">
					<div class="col-sm-7">

						<?php // 중앙 좌측 시작 ---------------------------------- ?>

						
						<div class="div-title-wrap no-margin">
							<div class="div-title">
								<a href="/bbs/board.php?bo_table=notice">
									<b>공지사항</b>
								</a>
							</div>
							<div class="div-sep-wrap">
								<div class="div-sep sep-thin"></div>
							</div>
						</div>
						<div class="idx-box">
							<?php echo apms_widget('basic-post-list', 'idx-post-board1', 'new=red icon={아이콘:caret-right}'); ?>
						</div>

						<div class="div-title-wrap no-margin">
							<div class="div-title">
								<a href="/bbs/board.php?bo_table=free">
									<b>자유게시판</b>
								</a>
							</div>
							<div class="div-sep-wrap">
								<div class="div-sep sep-thin"></div>
							</div>
						</div>
						<div class="idx-box">
							<?php echo apms_widget('basic-post-list', 'idx-post-board2', 'new=red icon={아이콘:caret-right}'); ?>
						</div>
						<?php // 중앙 좌측 끝 ---------------------------------- ?>

					</div>
					<div class="col-sm-5">

						<?php // 중앙 우측 시작 ---------------------------------- ?>


						<div class="div-title-wrap no-margin">
							<div class="div-title">
								<a href="/bbs/board.php?bo_table=notice">
									<b>아파트학교 공지사항</b>
								</a>
							</div>
							<div class="div-sep-wrap">
								<div class="div-sep sep-thin"></div>
							</div>
						</div>
						<div class="idx-box">
							<?php echo apms_widget('basic-post-list', 'idx-post-board3', 'new=red icon={아이콘:caret-right}'); ?>
						</div>

						<div class="div-title-wrap no-margin">
							<div class="div-title">
								<a href="/bbs/board.php?bo_table=free">
									<b>질문답변</b>
								</a>
							</div>
							<div class="div-sep-wrap">
								<div class="div-sep sep-thin"></div>
							</div>
						</div>
						<div class="idx-box">
							<?php echo apms_widget('basic-post-list', 'idx-post-board4', 'new=red icon={아이콘:caret-right}'); ?>
						</div>

						<?php // 중앙 우측 끝 ---------------------------------- ?>

					</div>
				</div -->


				<?php // 중앙 끝 ---------------------------------- ?>

			</div>
			<div class="col-md-3">

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


				<!--div class="div-title-wrap no-margin">
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
						<i class="fa fa-phone"></i> <b>0505.9352.663</b>
					</div>

					<div class="h10"></div>

					<div class="help-block">
						월-금 : 10:00 ~ 17:00
						<br>
						런치타임 : 12:00 ~ 13:00
						<br>
						토/일/공휴일은 휴무
					</div>

					<h4>Bank Info</h4>
					
					농협 076-12-178111
					
					<br>
					예금주 오영순
				</div -->

				<div class="idx-sidebox text-center">
					<?php // 소셜 보내기
						$sns_url  = G5_URL;
						$sns_title = get_text($config['cf_title']);
						$sns_img = THEMA_URL.'/assets/img';
						echo  get_sns_share_link('facebook', $sns_url, $sns_title, $sns_img.'/sns_fb_s.png').' ';
						echo  get_sns_share_link('twitter', $sns_url, $sns_title, $sns_img.'/sns_twt_s.png').' ';
						echo  get_sns_share_link('googleplus', $sns_url, $sns_title, $sns_img.'/sns_goo_s.png').' ';
						echo  get_sns_share_link('kakaostory', $sns_url, $sns_title, $sns_img.'/sns_kakaostory_s.png').' ';
						echo  get_sns_share_link('kakaotalk', $sns_url, $sns_title, $sns_img.'/sns_kakao_s.png').' ';
						echo  get_sns_share_link('naverband', $sns_url, $sns_title, $sns_img.'/sns_naverband_s.png').' ';
					?>
				</div>

				<?php // 우측 끝 ---------------------------------- ?>

			</div>
		</div>
	</div>
</div>
