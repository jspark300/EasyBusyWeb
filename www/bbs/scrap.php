<?php
include_once('./_common.php');

if (!$is_member)
    alert_close('회원만 조회하실 수 있습니다.');

$sql_common = " from {$g5['scrap_table']} where mb_id = '{$member['mb_id']}' ";
$sql_order = " order by ms_id desc ";

$sql = " select count(*) as cnt $sql_common ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list = array();

$sql = " select *
            $sql_common
            $sql_order
            limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 순차적인 번호 (순번)
    $num = $total_count - ($page - 1) * $rows - $i;

    // 게시판 제목
    $sql2 = " select bo_subject from {$g5['board_table']} where bo_table = '{$row['bo_table']}' ";
    $row2 = sql_fetch($sql2);
    if (!$row2['bo_subject']) $row2['bo_subject'] = '[게시판 없음]';

    // 게시물 제목
    $tmp_write_table = $g5['write_prefix'] . $row['bo_table'];
    $sql3 = " select wr_subject from $tmp_write_table where wr_id = '{$row['wr_id']}' ";
    $row3 = sql_fetch($sql3, FALSE);
    $subject = get_text(cut_str($row3['wr_subject'], 100));
    if (!$row3['wr_subject'])
        $row3['wr_subject'] = '[글 없음]';

    $list[$i]['num'] = $num;
    $list[$i]['opener_href'] = './board.php?bo_table='.$row['bo_table'];
    $list[$i]['opener_href_wr_id'] = './board.php?bo_table='.$row['bo_table'].'&amp;wr_id='.$row['wr_id'];
    $list[$i]['bo_subject'] = $row2['bo_subject'];
    $list[$i]['subject'] = $subject;
    $list[$i]['del_href'] = './scrap_delete.php?ms_id='.$row['ms_id'].'&amp;page='.$page;
}

$write_page_rows = (G5_IS_MOBILE) ? $config['cf_mobile_pages'] : $config['cf_write_pages'];
$list_page = $_SERVER['PHP_SELF'].'?'.$qstr.'&amp;page=';

// Page ID
$pid = ($pid) ? $pid : '';
$at = apms_page_thema($pid);
if(!defined('THEMA_PATH')) {
	include_once(G5_LIB_PATH.'/apms.thema.lib.php');
}

$g5['title'] = get_text($member['mb_nick']).'님의 스크랩';
include_once(G5_PATH.'/head.sub.php');
if(!USE_G5_THEME) @include_once(THEMA_PATH.'/head.sub.php');

$skin_path = $member_skin_path;
$skin_url = $member_skin_url;

// 스킨설정
$wset = (G5_IS_MOBILE) ? apms_skin_set('member_mobile') : apms_skin_set('member');

$setup_href = '';
if(is_file($skin_path.'/setup.skin.php') && ($is_demo || $is_admin == 'super')) {
	$setup_href = './skin.setup.php?skin=member';
}

include_once($skin_path.'/scrap.skin.php');

if(!USE_G5_THEME) @include_once(THEMA_PATH.'/tail.sub.php');
include_once(G5_PATH.'/tail.sub.php');
?>
