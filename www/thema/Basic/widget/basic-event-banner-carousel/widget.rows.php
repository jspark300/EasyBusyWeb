<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

$wset['thumb_w'] = ($wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
if($wset['thumb_h'] == "") $wset['thumb_h'] = 225;

// 추출하기
$list = apms_banner_event_rows($wset);
$list_cnt = count($list);

$img_height = apms_img_height($wset['thumb_w'], $wset['thumb_h']);

// 리스트
for ($i=0; $i < $list_cnt; $i++) {
?>
	<div class="item<?php echo (!$i) ? ' active' : '';?>">
		<div class="img-wrap" style="padding-bottom:<?php echo $img_height;?>%;">
			<div class="img-item">
				<a href="<?php echo $list[$i]['href'];?>">
					<img draggable="false" src="<?php echo $list[$i]['img'];?>" alt="<?php echo $list[$i]['alt'];?>">
				</a>
			</div>
		</div>
	</div>
<?php } // end for ?>
<?php if(!$list_cnt) { ?>
	<div class="item active">
		<div class="img-wrap" style="padding-bottom:<?php echo $img_height;?>%;">
			<div class="img-item">
				<img src="<?php echo THEMA_URL;?>/assets/img/bg.jpg" alt="">
				<div class="in-caption trans-bg-black">
					쇼핑몰현황/기타 > 이벤트관리 > 등록
				</div>
			</div>
		</div>
	</div>
<?php } ?>