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

<div style="width:100%; height:280px; line-height:280px; text-align:center; background:#f5f5f5;margin-bottom:30px;">
	반응형 구글광고 등
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
	<?php echo apms_widget('basic-post-list', 'idx-post-newcomment', 'comment=1 new=red icon={아이콘:caret-right}'); ?>
</div>

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