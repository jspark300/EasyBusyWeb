<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

//G5 데모 설정값

$member_skin_path   = G5_SKIN_PATH.'/member/basic';
$member_skin_url    = G5_SKIN_URL.'/member/basic';

$new_skin_path      = G5_SKIN_PATH.'/new/basic';
$new_skin_url       = G5_SKIN_URL.'/new/basic';

$search_skin_path   = G5_SKIN_PATH.'/search/basic';
$search_skin_url    = G5_SKIN_URL.'/search/basic';

$connect_skin_path  = G5_SKIN_PATH.'/connect/basic';
$connect_skin_url   = G5_SKIN_URL.'/connect/basic';

$faq_skin_path      = G5_SKIN_PATH.'/connect/basic';
$faq_skin_url       = G5_SKIN_URL.'/faq/basic';

$tag_skin_path      = G5_SKIN_PATH.'/tag/basic';
$tag_skin_url       = G5_SKIN_URL.'/tag/basic';

$qa_skin_path       = G5_SKIN_PATH.'/qa/basic';
$qa_skin_url        = G5_SKIN_URL.'/qa/basic';

$board['bo_'.MOBILE_.'skin'] = 'apms-basic';
$board_skin_path = G5_SKIN_PATH.'/board/'.$board['bo_'.MOBILE_.'skin'];
$board_skin_url = G5_SKIN_PATH.'/board/'.$board['bo_'.MOBILE_.'skin'];


//YC5 데모 설정값

if(!IS_YC || !IS_SHOP) return;

//분류,이벤트 상품목록 & 상품설명스킨 - 추가설정값
if($ev_id || $ca_id || $it_id) {

	//상품설명 스킨
	if($it_id) {
		if($sitem) set_session('sitem', $sitem);

		$sitem = get_session('sitem');

		list($is, $io) = explode("|", $sitem);

		$item_skin = ($is) ? $is : 'shop';

		if($io == "2") { //와이드
			$at_set['page'] = 12; //페이지 스타일
			$itemrows['irelation_'.MOBILE_.'mods'] = 4;
			$itemrows['irelation_'.MOBILE_.'rows'] = 1;
			$slist = 'basic|2'; //상품목록 
		} else {
			$at_set['page'] = 9; //페이지 스타일
			$itemrows['irelation_'.MOBILE_.'mods'] = 3;
			$itemrows['irelation_'.MOBILE_.'rows'] = 1;
			$slist = 'basic|1'; //상품목록 
		}

		if($is == 'board') {
			$wset['seller'] = 1;
		}

		$default['de_'.MOBILE_.'rel_img_width'] = 400;
		$default['de_'.MOBILE_.'rel_img_height'] = 400;
		$wset['rshadow'] = 2;
		$wset['rcmt'] = 1;
		$wset['rhit'] = 1;
		$wset['rsns'] = 1; 
	}

	//목록스킨에 따른 설정
	if($slist) set_session('slist', $slist);

	$slist = get_session('slist');

	list($ls, $lo) = explode("|", $slist);

	$list_skin = ($ls) ? $ls : 'basic';

	//스킨설정
	$thumb_w = 400;// 썸네일 너비
	$thumb_h = 600;// 썸네일 높이
	$list_rows = (G5_IS_MOBILE) ? 3 : 4; //세로수
	$wset['shadow'] = 2;
	$wset['buy'] = 1;
	$wset['cmt'] = 1;
	$wset['hit'] = 1;
	$wset['sns'] = 1; 

	if($lo == "2") { //와이드형
		$at_set['page'] = 12; //페이지 스타일
		$list_mods = 4; //가로수
	} else {
		$at_set['page'] = 9; //페이지 스타일
		$list_mods = 3; //가로수
	}
}

//스킨 추가설정이 있는 페이지
if($pid == 'iuse') { //사용후기
	$skin_name = 'basic';
} else if($pid == 'iqa') { //상품문의
	$skin_name = 'basic';
} else if($pid == 'iev') { //이벤트(전체)
	$skin_name = 'basic';
} else if($pid == 'itype') { //상품유형
	$skin_name = 'basic';
} else if($pid == 'isearch') { //상품검색
	$skin_name = 'basic';
} else if($pid == 'myshop') { //마이샵
	$skin_name = 'basic';
} 

$order_skin_path    = G5_SKIN_PATH.'/apms/order/basic';
$order_skin_url     = G5_SKIN_URL.'/apms/order/basic';

?>