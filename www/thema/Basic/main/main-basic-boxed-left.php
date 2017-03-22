<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<style>
	.idx-box { padding:10px 0px 30px; }
	.idx-sidebox { padding:10px 0px 30px; }
	@media all and (max-width:767px) {
		.responsive .main-col.pull-left, 
		.responsive .main-col.pull-right { float:none !important; }
	}
</style>

<div class="at-content">
	<div class="container">
		<?php // 중앙 상단 시작 ---------------------------------- ?>

		<?php echo apms_widget('basic-title-carousel', 'idx-bbs-title', 'interval=5000 shadow=2'); //타이틀 위젯 ?>
		<div class="h20"></div>

		<?php // 중앙 상단 끝 ---------------------------------- ?>

		<div class="row">
			<div class="col-md-9 main-col pull-right">
				<div class="row">
					<div class="col-sm-7">
						<?php // 중앙 좌측 시작 ---------------------------------- ?>
						<div class="div-title-wrap no-margin">
							<div class="div-title">
								<a href="#">
									<b>블로그</b>
								</a>
							</div>
							<div class="div-sep-wrap">
								<div class="div-sep sep-bold"></div>
							</div>
						</div>
						<div class="idx-box">
							<?php echo apms_widget('basic-post-gallery-carousel', 'idx-post-gallery', 'interval=6000 rows=6 item=2 cmt=1 hit=1 date=1 shadow=2 new=red'); ?>
						</div>

						<div class="div-title-wrap no-margin">
							<div class="div-title">
								<a href="#">
									<b>웹진</b>
								</a>
							</div>
							<div class="div-sep-wrap">
								<div class="div-sep sep-thin"></div>
							</div>
						</div>
						<div class="idx-box">
							<?php echo apms_widget('basic-post-webzine', 'idx-post-webzine', 'rows=7 shadow=1 new=green cmt=1 hit=1 date=1'); ?>
						</div>

						<div class="h20"></div>
						<?php // 중앙 좌측 끝 ---------------------------------- ?>

					</div>
					<div class="col-sm-5">

						<?php // 중앙 우측 시작 ---------------------------------- ?>

						<div class="div-title-wrap no-margin">
							<div class="div-title">
								<a href="#">
									<b>갤러리</b>
								</a>
							</div>
							<div class="div-sep-wrap">
								<div class="div-sep sep-bold"></div>
							</div>
						</div>
						<div class="idx-box">
							<?php echo apms_widget('basic-post-photo-carousel', 'idx-post-photo', 'interval=7000 rows=12 item=6 item_w=3 new=blue'); ?>
						</div>

						<div class="div-title-wrap no-margin">
							<div class="div-title">
								<a href="#">
									<b>아이콘</b>
								</a>
							</div>
							<div class="div-sep-wrap">
								<div class="div-sep sep-thin"></div>
							</div>
						</div>
						<div class="idx-box">
							<?php echo apms_widget('basic-post-icon', 'idx-post-icon', 'rows=6 new=orangered cmt=1 hit=1 date=1'); ?>
						</div>

						<div class="div-title-wrap no-margin">
							<div class="div-title">
								<a href="#">
									<b>리스트</b>
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
								<a href="#">
									<b>리스트</b>
								</a>
							</div>
							<div class="div-sep-wrap">
								<div class="div-sep sep-thin"></div>
							</div>
						</div>
						<div class="idx-box">
							<?php echo apms_widget('basic-post-list', 'idx-post-board2', 'new=red icon={아이콘:caret-right}'); ?>
						</div>

						<?php // 중앙 우측 끝 ---------------------------------- ?>

					</div>
				</div>

				<?php // 중앙 하단 시작 : 배너 ---------------------------------- ?>

				<div style="margin-top:-30px;">
					<?php echo apms_line('fa', 'fa-thumbs-up fa-lg'); // FA Icon Line ?>
				</div>

				<?php echo apms_widget('basic-post-banner-carousel', 'idx-post-banner', 'interval=5000 rows=8 item=4 new=red'); ?>

				<div class="h20"></div>

				<?php // 중앙 하단 끝 ---------------------------------- ?>

			</div>
			<div class="col-md-3 main-col pull-left">

				<?php // 우측 시작 ---------------------------------- ?>

				<div class="hidden-sm hidden-xs">
					<?php echo apms_widget('basic-outlogin'); // 외부로그인 - 768px 이하에서 숨김(hidden-xs) ?>
					<div class="h10"></div>
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
					<?php echo apms_widget('basic-post-list', 'idx-post-notice', 'new=red icon={아이콘:caret-right} rows=5'); ?>
				</div>

				<div class="idx-sidebox" style="margin-top:-20px;">
					<div style="width:100%; height:280px; line-height:280px; text-align:center; background:#f5f5f5;">
						반응형 구글광고 등
					</div>
				</div>

				<div class="div-title-wrap no-margin">
					<div class="div-title">
						<a href="<?php echo $at_href['new'];?>?view=w">
							<b>최근글</b>
						</a>
					</div>
					<div class="div-sep-wrap">
						<div class="div-sep sep-thin"></div>
					</div>
				</div>
				<div class="idx-sidebox">
					<?php echo apms_widget('basic-post-list', 'idx-post-newpost', 'new=red icon={아이콘:caret-right}'); ?>
				</div>

				<div class="div-title-wrap no-margin">
					<div class="div-title">
						<a href="<?php echo $at_href['new'];?>?view=c">
							<b>최근댓글</b>
						</a>
					</div>
					<div class="div-sep-wrap">
						<div class="div-sep sep-thin"></div>
					</div>
				</div>
				<div class="idx-sidebox">
					<?php echo apms_widget('basic-post-list', 'idx-post-newcomment','comment=1 new=red icon={아이콘:caret-right}'); ?>
				</div>

				<?php // 설문조사
					$is_poll_list = apms_widget('basic-poll');
					if($is_poll_list) {
				?>
					<div style="margin:20px 0px 30px;">
						<?php echo $is_poll_list; ?>
					</div>					
				<?php } ?>

				<div class="div-title-wrap no-margin">
					<div class="div-title">
						<b>최근통계</b>
					</div>
					<div class="div-sep-wrap">
						<div class="div-sep sep-thin"></div>
					</div>
				</div>
				<div class="idx-sidebox">
					<ul style="padding:0; margin:0; list-style:none;">
						<li><a href="<?php echo $at_href['connect'];?>">
							현재 접속자 <span class="pull-right"><?php echo number_format($stats['now_total']); ?><?php echo ($stats['now_mb'] > 0) ? '(<b>'.number_format($stats['now_mb']).'</b>)' : ''; ?> 명</span></a>
						</li>
						<li>오늘 방문자 <span class="pull-right"><?php echo number_format($stats['visit_today']); ?> 명</span></li>
						<li>어제 방문자 <span class="pull-right"><?php echo number_format($stats['visit_yesterday']); ?> 명</span></li>
						<li>최대 방문자 <span class="pull-right"><?php echo number_format($stats['visit_max']); ?> 명</span></li>
						<li>전체 방문자 <span class="pull-right"><?php echo number_format($stats['visit_total']); ?> 명</span></li>
						<li>전체 회원수	<span class="pull-right at-tip" data-original-title="<nobr>오늘 <?php echo $stats['join_today'];?> 명 / 어제 <?php echo $stats['join_yesterday'];?> 명</nobr>" data-toggle="tooltip" data-placement="top" data-html="true"><?php echo number_format($stats['join_total']); ?> 명</span>
						</li>
						<li>전체 게시물	<span class="pull-right at-tip" data-original-title="<nobr>글 <?php echo number_format($menu[0]['count_write']);?> 개/ 댓글 <?php echo number_format($menu[0]['count_comment']);?> 개</nobr>" data-toggle="tooltip" data-placement="top" data-html="true"><?php echo number_format($menu[0]['count_write'] + $menu[0]['count_comment']); ?> 개</span>
						</li>
					</ul>
				</div>

				<div class="idx-sidebox sns-share-icon text-center">
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
			<div class="clearfix"></div>
		</div>
	</div>
</div>
