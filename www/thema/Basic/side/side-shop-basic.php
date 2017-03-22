<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<style>
	.idx-sidebox { padding:10px 0px 30px; }
</style>

<div class="hidden-sm hidden-xs">
	<?php echo apms_widget('basic-outlogin'); // 외부로그인 - 768px 이하에서 숨김(hidden-xs) ?>
	<div class="h10"></div>
</div>

<div class="idx-sidebox" style="padding-top:0px;">
	<?php echo apms_widget('basic-cart'); // 장바구니 등 ?>
</div>

<?php 
// 카테고리 체크
$side_category = apms_widget('basic-category');
if($side_category) { 
?>
	<div class="div-title-wrap no-margin">
		<div class="div-title">
			<b>카테고리</b>
		</div>
		<div class="div-sep-wrap">
			<div class="div-sep sep-bold"></div>
		</div>
	</div>
	<div class="idx-sidebox">
		<?php echo $side_category;?>
	</div>
<?php } ?>

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
		echo  get_sns_share_link('facebook', $sns_url, $sns_title, $sns_img.'/sns_fb_s.png').' ';
		echo  get_sns_share_link('twitter', $sns_url, $sns_title, $sns_img.'/sns_twt_s.png').' ';
		echo  get_sns_share_link('googleplus', $sns_url, $sns_title, $sns_img.'/sns_goo_s.png').' ';
		echo  get_sns_share_link('kakaostory', $sns_url, $sns_title, $sns_img.'/sns_kakaostory_s.png').' ';
		echo  get_sns_share_link('kakaotalk', $sns_url, $sns_title, $sns_img.'/sns_kakao_s.png').' ';
		echo  get_sns_share_link('naverband', $sns_url, $sns_title, $sns_img.'/sns_naverband_s.png').' ';
	?>
</div>
