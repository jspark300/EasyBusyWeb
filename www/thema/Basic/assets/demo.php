<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 데모일 때 설정
$demo_config = array('bo_table' => 'basic', 'ca_id' => '10', 'ev_id' => '', 'bn_id' => '');

// 데모테마 레이아웃 설정
if(IS_YC && IS_SHOP) { // 쇼핑몰
	$at_set['mfile'] = 'main-shop-basic';
	$at_set['sfile'] = 'side-shop-basic';
} else {
	$at_set['mfile'] = 'main-basic';
	$at_set['sfile'] = 'side-basic';

	if(!G5_IS_MOBILE) { // PC 모드
		$at_set['layout'] = "boxed";
		$at_set['body_background'] = "http://amina.co.kr/demo/data/apms/background/1107.jpg";
	}
}

// 수동메뉴설정
$hmenu = array();
$bmenu = array();
$tmenu = array();

if($mon && $pvm) $is_main = false; // 메인 스타일 보기일 때

$i = 0;
$msp = 'main';
$demo_href = $at_href['home'].'/?mon='.$msp.'&amp;pv='.THEMA.'&amp;pvm=';
$shmh = (IS_YC && IS_SHOP) ? 'shop-' : '';
$hmenu[$i]['new'] = 'old';
$hmenu[$i]['on'] = ($mon == $msp) ? true : false;
$hmenu[$i]['href'] = $demo_href.urlencode('main-'.$shmh.'basic');
$hmenu[$i]['name'] = '기본 메인';
$hmenu[$i]['is_sub'] = true;

$shmenu = array();
$shmenu[] = array('main-'.$shmh.'basic', '사이드 - 기본T', '', 0);
$shmenu[] = array('main-'.$shmh.'basic-left', '사이드 - 기본T/좌측S', '', 0);
$shmenu[] = array('main-'.$shmh.'basic-wide', '사이드 - 와이드T', '', 0);
$shmenu[] = array('main-'.$shmh.'basic-wide-left', '사이드 - 와이드T/좌측S', '', 0);
$shmenu[] = array('main-'.$shmh.'basic-boxed', '사이드 - 박스형T', '', 0);
$shmenu[] = array('main-'.$shmh.'basic-boxed-left', '사이드 - 박스형T/좌측S', '', 0);
if(IS_YC && IS_SHOP) {
	$shmenu[] = array('main-'.$shmh.'wide', '와이드 - 와이드T', '', 0);
	$shmenu[] = array('main-'.$shmh.'wide-boxed', '와이드 - 박스형T', '', 0);
}
for($j=0; $j < count($shmenu); $j++) {
	$hmenu[$i]['sub'][$j]['line'] = $shmenu[$j][2];
	$hmenu[$i]['sub'][$j]['sp'] = $shmenu[$j][3];
	$hmenu[$i]['sub'][$j]['on'] = ($pvm == $shmenu[$j][0]) ? true : false;
	$hmenu[$i]['sub'][$j]['href'] = $demo_href.urlencode($shmenu[$j][0]);
	$hmenu[$i]['sub'][$j]['name'] = $shmenu[$j][1];
	$hmenu[$i]['sub'][$j]['new'] = 'old';
	$hmenu[$i]['sub'][$j]['is_sub'] = false;
}

// 쇼핑몰 페이지
if(IS_YC && IS_SHOP) {
	// 상품 페이지
	unset($shmenu);
	$i++;
	$msp = 'it';
	$hmenu[$i]['new'] = 'old';
	$hmenu[$i]['on'] = ($mon == $msp) ? true : false;
	$hmenu[$i]['href'] = G5_SHOP_URL.'/list.php?ca_id=10&amp;mon='.$msp.'&amp;pv='.THEMA.'&amp;slist='.urlencode('basic|1');
	$hmenu[$i]['name'] = '상품 페이지';
	$hmenu[$i]['is_sub'] = true;

	$shmenu[] = array('list', '10', 'basic|1', '갤러리형 - 사이드', '', 0);
	$shmenu[] = array('list', '10', 'basic|2', '갤러리형 - 와이드', '', 0);

	$shmenu[] = array('item', '399', 'shop|1', '기본형 - 사이드', '상품설명 페이지', 0);
	$shmenu[] = array('item', '399', 'shop|2', '기본형 - 와이드', '', 0);
	$shmenu[] = array('item', '395', 'board|1', '보드형 - 사이드', '', 0);
	$shmenu[] = array('item', '395', 'board|2', '보드형 - 와이드', '', 0);

	for($j=0; $j < count($shmenu); $j++) {
		$hmenu[$i]['sub'][$j]['line'] = $shmenu[$j][4];
		$hmenu[$i]['sub'][$j]['sp'] = $shmenu[$j][5];
		$hmenu[$i]['sub'][$j]['on'] = ($hmenu[$i]['on'] && ($slist == $shmenu[$j][2] || $sitem == $shmenu[$j][2])) ? true : false;
		switch($shmenu[$j][0]) {
			case 'list'		: $demo_mode = 'list.php?ca_id='.$shmenu[$j][1].'&amp;slist='; break;
			case 'item'		: $demo_mode = 'item.php?it_id='.$shmenu[$j][1].'&amp;sitem='; break;
			default			: $demo_mode = 'list.php?ca_id='.$shmenu[$j][1].'&amp;slist='; break;
		}
		$hmenu[$i]['sub'][$j]['href'] = G5_SHOP_URL.'/'.$demo_mode.urlencode($shmenu[$j][2]).'&amp;mon='.$msp.'&amp;pv='.THEMA;
		$hmenu[$i]['sub'][$j]['name'] = $shmenu[$j][3];
		$hmenu[$i]['sub'][$j]['new'] = 'old';
		$hmenu[$i]['sub'][$j]['is_sub'] = false;
	}
}

$t = 0;
@include_once(G5_BBS_PATH.'/demo.menu.php');

$i++;
$demo_href = $at_href['home'].'/?pv='.THEMA.'&amp;pvc=';
$hmenu[$i]['new'] = 'old';
$hmenu[$i]['href'] = $demo_href.urlencode('Basic');
$hmenu[$i]['name'] = '기본 컬러셋';
$hmenu[$i]['is_sub'] = true;

unset($shmenu);
$shmenu[] = array('Basic', 'Basic 컬러셋', '', 0);
$shmenu[] = array('Basic-Black', 'Basic Black 컬러셋', '', 0);
$shmenu[] = array('Basic-White', 'Basic White 컬러셋', '', 0);
$shmenu[] = array('Basic-Trans', 'Basic Trans 컬러셋', '', 0);
$shmenu[] = array('Basic-Gray', 'Basic Gray 컬러셋', '', 0);
$shmenu[] = array('Basic-Dark-Footer', 'Basic Dark Footer 컬러셋', '', 0);
for($j=0; $j < count($shmenu); $j++) {
	$hmenu[$i]['sub'][$j]['line'] = $shmenu[$j][2];
	$hmenu[$i]['sub'][$j]['sp'] = $shmenu[$j][3];
	$hmenu[$i]['sub'][$j]['on'] = ($colorset == $shmenu[$j][0]) ? true : false;
	$hmenu[$i]['sub'][$j]['href'] = $demo_href.urlencode($shmenu[$j][0]);
	$hmenu[$i]['sub'][$j]['name'] = $shmenu[$j][1];
	$hmenu[$i]['sub'][$j]['new'] = 'old';
	$hmenu[$i]['sub'][$j]['is_sub'] = false;
}

// Basic-Trans 컬러셋 배경
if(COLORSET == "Basic-Trans") {
	$at_set['body_background'] = "http://amina.co.kr/demo/data/apms/background/1107.jpg";
}

/* 자동메뉴 재배열 
	- apms_array_menu('그룹,분류', '그룹 또는 분류 1개만', '그룹,분류')
	- 첫번째와 세번째 메뉴는 콤바(,)를 이용해서 복수등록 가능
*/

//$bmenu = (IS_YC && IS_SHOP) ? apms_array_menu('10,shop','','') : apms_array_menu('shop','','');

$bmenu = $menu[0];

// 매뉴 재설정
unset($menu);

// 메뉴 통계
$menu[0] = $bmenu[0];

$i = 1;
// Head Menu
for($j = 0; $j < count($hmenu); $j++) {
	$menu[$i] = $hmenu[$j];
	$i++;
}

// Body Menu
for($j = 1; $j < count($bmenu); $j++) {
	$menu[$i] = $bmenu[$j];
	if($mon == 'side') $menu[$i]['on'] = false;
	$i++;
}

// Tail Menu
for($j = 0; $j < count($tmenu); $j++) {
	$menu[$i] = $tmenu[$j];
	$i++;
}

?>