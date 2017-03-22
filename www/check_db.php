<?
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

$sql = "select count(mb_no) c from g5_member where mb_id = '".$member[mb_id]."' and mb_password = password('".$mb_password."')";
$res = sql_fetch($sql);
$mb_count = $res['c'];
if($mb_count==0)
{	
	echo "<script>alert('비밀번호가 틀립니다. 확인후 다시 시도해 주세요.');history.back();</script>";
	exit;
}
$_SESSION['check_member'] = true;
?> 
<script>
	top.location.href="/mysign_index.php";
</script>
