<?php
include_once('./_common.php');

if (isset($_REQUEST['iq_id'])) { 
    $iq_id = (int)$_REQUEST['iq_id'];
}

if (!$iq_id) {
	alert('iq_id 값이 넘어오지 않았습니다.', G5_URL);
}

$view = sql_fetch(" select * from `{$g5['g5_shop_item_qa_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id) where a.iq_id = '$iq_id' ");

if(!$view['iq_id']) {
	alert('존재하지 않는 자료입니다.', G5_URL);
}

if($view['iq_secret']) {
	if($is_admin || ($view['mb_id'] && $member['mb_id' ] == $view['mb_id'])) {
		;
	} else {
		alert('비밀글로 보호된 문의입니다.');
	}
} 

if($ca_id) {
	$qstr .= '&amp;ca_id='.$ca_id;
}

// 버튼
$view['iq_ans_href'] = $view['iq_edit_href'] = $view['iq_del_href'] = '';

if($is_admin || ($view['pt_id'] && $member['mb_id'] == $view['pt_id'])) {
	$view['iq_ans_href'] = './itemqansform.php?it_id='.$view['it_id'].'&amp;iq_id='.$iq_id.'&amp;page='.$page.'&amp;move=3';
}

if($is_admin || ($view['mb_id'] && $member['mb_id'] == $view['mb_id'])) {
	$view['iq_edit_href'] = './itemqaform.php?it_id='.$view['it_id'].'&amp;iq_id='.$iq_id.'&amp;page='.$page.'&amp;w=u&amp;move=3';

	$hash = md5($view['iq_id'].$view['iq_time'].$view['iq_ip']);
	$view['iq_del_href'] = './itemqaformupdate.php?it_id='.$view['it_id'].'&amp;iq_id='.$iq_id.'&amp;w=d&amp;move=2&amp;hash='.$hash;
}

$view['iq_time'] = strtotime($view['iq_time']);
$view['iq_photo'] = apms_photo_url($view['mb_id']);
$view['iqa_photo'] = ($view['pt_id']) ? apms_photo_url($view['pt_id']) : apms_photo_url($config['cf_admin']);
$view['iq_question'] = apms_content(conv_content($view['iq_question'], 1));
$view['iq_answer'] = apms_content(conv_content($view['iq_answer'], 1));
$view['it_href'] = './item.php?it_id='.$view['it_id'];

// Page ID
$pid = ($pid) ? $pid : 'iqa';
$at = apms_page_thema($pid);
if(!defined('THEMA_PATH')) {
	include_once(G5_LIB_PATH.'/apms.thema.lib.php');
}

$skin_row = array();
$skin_row = apms_rows('qa_'.MOBILE_.'rows, qa_'.MOBILE_.'skin, qa_'.MOBILE_.'set');
$skin_name = $skin_row['qa_'.MOBILE_.'skin'];

// 스킨설정
$wset = array();
if($skin_row['qa_'.MOBILE_.'set']) {
	$wset = apms_unpack($skin_row['qa_'.MOBILE_.'set']);
}

// 데모
if($is_demo) {
	@include (THEMA_PATH.'/assets/demo.config.php');
}

$skin_path = G5_SKIN_PATH.'/apms/qa/'.$skin_name;
$skin_url = G5_SKIN_URL.'/apms/qa/'.$skin_name;

// 셋업
$setup_href = '';
if ($is_demo || $is_admin == 'super') {
	$setup_href = './skin.setup.php?skin=qa';
}

// SEO 메타태그
$is_seometa = 'iqa';

$g5['title'] = '문의보기';
include_once('./_head.php');
include_once($skin_path.'/qaview.skin.php');
include_once('./_tail.php');
?>
