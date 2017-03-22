<? 
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once('./cate_table.php');


if ($is_member) {
    alert("이미 로그인중입니다.");
/*
$sql = "select count(mb_no) c from g5_member where mb_id = '".$email."'";
$res = sql_fetch($sql);
$mb_count = $res['c'];
if($mb_count==0)
{	
	echo "<script>alert('입력된 이메일은 미등록 된 이메일입니다. 다른 이메일을 입력해 주세요.');history.back();</script>";
	exit;
}

$str  = "abcdefghijklmnopqrstuvwxyz";   

$shuffled_str = str_shuffle($str);   
$send_password =  substr($shuffled_str,1,5);

$sql = "update g5_member set mb_password = passowrd('".$send_password."') where mb_id=  '".$email."'";
sql_query($sql);

echo "<script>alert('입력된 이메일로 임시 비밀번호를 전송했습니다. 이메일을 확인하신후 발급된 임시 비밀번호로 로그인해 주세요.');</script>";
*/

?> 
<script>
	top.location.href="/member_login.php";
</script>

<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

if ($is_member) {
    alert("이미 로그인중입니다.");
}

// Page ID
$pid = ($pid) ? $pid : '';
$at = apms_page_thema($pid);
if(!defined('THEMA_PATH')) {
	include_once(G5_LIB_PATH.'/apms.thema.lib.php');
}

$g5['title'] = '회원정보 찾기';
include_once(G5_PATH.'/head.sub.php');
if(!USE_G5_THEME) @include_once(THEMA_PATH.'/head.sub.php');

$skin_path = $member_skin_path;
$skin_url = $member_skin_url;

$action_url = G5_HTTPS_BBS_URL."/password_lost2.php";

include_once($skin_path.'/password_lost.skin.php');

if(!USE_G5_THEME) @include_once(THEMA_PATH.'/tail.sub.php');
include_once(G5_PATH.'/tail.sub.php');
?>