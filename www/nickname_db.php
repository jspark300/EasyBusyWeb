<? 
include_once('./_common.php');
include_once(G5_LIB_PATH.'/register.lib.php');

// 리퍼러 체크
referer_check();

$mb_id = $member[mb_id];
$mb_nick        = trim($_POST['mb_nick']);
if($msg = empty_mb_nick($mb_nick))    
	alert($msg, "", true, true);

if($member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400)))
{
    $mb_nick = $member['mb_nick'];
	echo "<script>alert('닉네임 수정가능일이 아직 지나지 않았습니다.');location.href = '/';</script>";
	exit;
}
if ($msg = exist_mb_nick($mb_nick, $mb_id))     alert($msg, "", true, true);

$sql = " update {$g5['member_table']}
			set mb_nick = '{$mb_nick}'
			where mb_id = '$mb_id' ";
sql_query($sql);

?> 
<script>
	top.location.href="/my_index.php";
</script>
