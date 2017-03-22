<? 
include_once('./_common.php');
include_once('./cate_table.php');


/*function email_check($email)
{
	if(ereg("(^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*$)", $email))
		return true;
	else
		return false;
}
*/
?>
	<script>
		parent.document.Frm.emailchk.value="";
	</script>
<?

$email = Trim($email);

$email_e = $email;
$email2 = SQL_Injection3($email);
$email2 = str_replace(" ","",$email2);
if($email2 != $email_e)
{
?>
	<script>
		alert("이메일에 특수문자 또는 공백은 제한되어있습니다.")
	</script>
<?
	exit;
}
If( strlen($email2) > 180)
{
?>
	<script>
		alert("이메일 길이는 180자로 제한되어있습니다.")
	</script>
<?
	exit;
}

if($email2 == "")
{
?>
	<script>
		alert("이메일을 입력해주세요.")
	</script>
<?
	exit;
}
else
{
	$m_uid = $_SESSION["userloginKey"];
    if($m_uid == "")
	    $sql = "select count(mb_no) c from g5_member where mb_id ='".$email2."' ";
	else
	    $sql = "select count(mb_no) c from g5_member where mb_no<>'".$m_uid."' and mb_id ='".$email2."' ";
	
	$res = sql_fetch($sql);

	$mb_count = $res['c'];

	
	if($mb_count == 0)
	{
		if(filter_var($email2,FILTER_VALIDATE_EMAIL)!="")
		{
?>
		<script>
	//		document.domain = "game.daum.net";
			parent.document.Frm.emailchk.value="1";
			alert("사용할 수 있는 이메일 입니다.")	
		</script>
<?
		}
		else
		{
?>
			<script>
				alert("사용할 수 없는 이메일 입니다.")
			</script>
<?		}
	}
	else
	{
?>
		<script>
			alert("사용중인 이메일 입니다.")
		</script>
<?
	}
}
?> 