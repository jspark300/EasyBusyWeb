<? 
include_once('./_common.php');
include_once(G5_LIB_PATH.'/register.lib.php');
include_once('./cate_table.php');

$mb_email       = trim($_POST['mb_email']);
$mb_email       = get_email_address($mb_email);
$mb_password    = trim($_POST['mb_password']);
$mb_password_re = trim($_POST['mb_password_re']);
$mb_name        = trim($_POST['mb_name']);
$mb_hp          = isset($_POST['mb_hp'])            ? trim($_POST['mb_hp'])          : "";
$mb_nick        = trim($_POST['mb_nick']);
$mb_mailling    = isset($_POST['mb_mailling'])      ? trim($_POST['mb_mailling'])    : "";
$mb_sms         = isset($_POST['mb_sms'])           ? trim($_POST['mb_sms'])         : "";
$tmp_mb_name = iconv('UTF-8', 'UTF-8//IGNORE', $mb_name);
if($tmp_mb_name != $mb_name) {
       alert('이름을 올바르게 입력해 주십시오.');
 }
$tmp_mb_nick = iconv('UTF-8', 'UTF-8//IGNORE', $mb_nick);
if($tmp_mb_nick != $mb_nick) {
    alert('닉네임을 올바르게 입력해 주십시오.');
}
if($mb_password != $mb_password_re)
      alert('비밀번호가 일치하지 않습니다.');
if($msg = valid_mb_hp($mb_hp))     
	alert($msg, "", true, true);

$sql = "select count(mb_no) c from g5_member where mb_id = '".$mb_email."'";
$res = sql_fetch($sql);
$mb_count = $res['c'];
if($mb_count>0)
{	
	echo "<script>alert('이미 등록된 이메일입니다. 다른 이메일을 입력해 주세요.');history.back();</script>";
	exit;
}

//===============================================================
//  본인확인
//---------------------------------------------------------------
$mb_hp = hyphen_hp_number($mb_hp);

$sql = "select mb_id from g5_member where mb_hp = '".$mb_hp."'";
$row = sql_fetch($sql);
if($row['mb_id'])
{	
	alert("입력하신 본인확인 정보로 가입된 내역이 존재합니다.\\n회원아이디 : ".$row['mb_id']);

}
$sql = "select count(mb_no) c from g5_member where mb_nick = '".$mb_nick."'";
$res = sql_fetch($sql);
$mb_count = $res['c'];
if($mb_count>0)
{	
	echo "<script>alert('이미 등록된 닉네임입니다. 다른 닉네임을 입력해 주세요.');history.back();</script>";
	exit;
}
$ip = $_SERVER["REMOTE_ADDR"];

$x = date("Y-m-d");


$sql_certify = '';
$md5_cert_no = $_SESSION['ss_cert_no'];
$cert_type = $_SESSION['ss_cert_type'];
if($cert_type && $md5_cert_no) {
    // 해시값이 같은 경우에만 본인확인 값을 저장한다.
    if ($_SESSION['ss_cert_hash'] == md5($mb_name.$cert_type.$_SESSION['ss_cert_birth'].$md5_cert_no)) {
        $sql_certify .= " , mb_hp = '{$mb_hp}' ";
        $sql_certify .= " , mb_certify  = '{$cert_type}' ";
        $sql_certify .= " , mb_adult = '{$_SESSION['ss_cert_adult']}' ";
        $sql_certify .= " , mb_birth = '{$_SESSION['ss_cert_birth']}' ";
        $sql_certify .= " , mb_sex = '{$_SESSION['ss_cert_sex']}' ";
        $sql_certify .= " , mb_dupinfo = '{$_SESSION['ss_cert_dupinfo']}' ";
        
    } 
	else
	{
		echo "<script>alert('잘못된접근입니다.');history.back();</script>";
		exit;		
	}
}
//if($_SESSION['ss_cert_adult']!="1")
//{
//		echo "<script>alert('19세 이상만 회원가입이 가능합니다.');history.back();</script>";
//		exit;		
//}

$sql = "insert into g5_member 
		set mb_id='{$mb_email}',
		mb_password = '".get_encrypt_string($mb_password)."',
		mb_name = '{$mb_name}',
        mb_nick = '{$mb_nick}',
        mb_nick_date = '".G5_TIME_YMD."',
		mb_email = '{$mb_email}',
		mb_datetime = '".G5_TIME_YMDHIS."',
		mb_ip = '{$_SERVER['REMOTE_ADDR']}',
		mb_level = '{$config['cf_register_level']}',
		mb_login_ip = '{$_SERVER['REMOTE_ADDR']}',
		mb_mailling = '{$mb_mailling}',
		mb_sms = '{$mb_sms}'
		{$sql_certify} ";
	//	mb_password,mb_nick,mb_name,mb_email,mb_level,mb_datetime,mb_ip,mb_nick_date,mb_hp) values ('".$mb_email."',password('".$mb_password."'),'".$mb_nick."','".$mb_name."','".$mb_email."',2,now(),'".$ip."','".$x."','".$mb_hp."')";
sql_query($sql);

//echo $sql;
//exit;

$sql = "select mb_no from g5_member where mb_id='$mb_email'";
$rs_mb = sql_fetch($sql);
$mb_no = $rs_mb[mb_no];
$t = time();
$sql = "insert into t_give_point_use (point_name,point_use,point,status,mb_no,reg_date) values ('회원가입','',10,1,'".$mb_no."',$t)";
sql_query($sql);

unset($_SESSION['ss_cert_type']);
unset($_SESSION['ss_cert_no']);
unset($_SESSION['ss_cert_hash']);
unset($_SESSION['ss_cert_birth']);
unset($_SESSION['ss_cert_adult']);
?> 
<script>
	alert("<?=$mb_name?>님의 회원가입을 진심으로 축하합니다. 감사합니다.");
	top.location.href="/";
</script>
