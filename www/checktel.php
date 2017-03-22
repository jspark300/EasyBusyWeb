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
function tel_check($hp)
{
	$hp = preg_replace("/[^0-9]/", "", $hp);
 
if(preg_match("/^01[0-9]{8,9}$/", $hp))
   return true;
else
    return false;
}
?>
	<script>
		parent.document.Frm.hpchk.value="";
	</script>
<?

//$tel = Trim($tel);
if(!tel_check($hp))
{
?>
	<script>
		alert("정상적인 휴대폰번호를 입력하세요.")
	</script>
<?
	exit;
}

if($hp == "")
{
?>
	<script>
		alert("휴대폰번호를 입력해주세요.")
	</script>
<?
	exit;
}
else
{
	$m_uid = $member["mb_no"];
    if($m_uid == "")
	    $sql = "select count(mb_no) c from g5_member where mb_hp ='".$hp."' ";
	else
	    $sql = "select count(mb_no) c from g5_member where mb_no<>'".$m_uid."' and mb_hp ='".$hp."' ";
	//echo $sql;
	$res = sql_fetch($sql);

	$mb_count = $res['c'];

	
	if($mb_count == 0)
	{
//		if(filter_var($email2,FILTER_VALIDATE_EMAIL)!="")
//		{
?>
		<script>
	//		document.domain = "game.daum.net";
			parent.document.Frm.hpchk.value="1";
			alert("사용할 수 있는 휴대폰번호 입니다.")	
		</script>
<?
//		}
//		else
//		{
?>
	<? //		<script>
		//		alert("사용할 수 없는 휴대폰번호 입니다.")
		//	</script>
	?>
<?	 //	}
	}
	else
	{
?>
		<script>
			alert("사용중인 휴대폰번호 입니다.")
		</script>
<?
	}
}
?> 