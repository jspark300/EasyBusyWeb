<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EASYBUSY</title>
	<link href="a_css/default.css" rel="stylesheet" />
	<link href="a_css/common.css" rel="stylesheet" />
	<script src="a_js/jquery-1.11.3.min.js"></script>
	<script src="a_js/common.js"></script>
<script type="text/javascript">
	function gosave()
	{
		if(trim(document.give_con.send_name.value) == "")
		{
			alert('보내는분 이름을 입력해 주세요.');
			document.give_con.send_name.focus();
			return;
		}
		if(trim(document.give_con.send_email.value) == "")
		{
			alert('보내는분 이메일을 입력해 주세요.');
			document.give_con.send_email.focus();
			return;
		}
		if(!checkemail(document.give_con.send_email.value))
		{
			alert('잘못된 이메일 주소입니다.');
			document.give_con.send_email.focus();
			return;
		}
		if(trim(document.give_con.recv_email.value) == "")
		{
			alert('받는분 이메일을 입력해 주세요.');
			document.give_con.recv_email.focus();
			return;
		}
		if(!checkemail(document.give_con.recv_email.value))
		{
			alert('잘못된 이메일 주소입니다.');
			document.give_con.recv_email.focus();
			return;
		}
		if(document.give_con.msg.value.length > 200)
		{
			alert('메시지는 200자로 제한되어있습니다.');
			document.give_con.msg.focus();
			return;
		}


		document.give_con.submit();
		
	}
	function trim(str)
	{
		return str.replace(/^\s*|\s*$/g,"");
	}
	function checkemail(email)
	{
		var regex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;   

		if(regex.test(email) === false) {  
			return false;  
		} else {  
			return true;
		}  
	}
//-->  
</script>
</head>
<body>
	<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>선물하기</p>
		</div>
	</header>
<?
include_once('./_common.php');

// 당첨 검색
$sql = "select count(id) c   from t_give_enter where mb_no=$member[mb_no] and give_id=$id ";
$res = sql_fetch($sql);
$give_count = $res[c];
if($give_count == 0)
{
	echo "<script>alert('당첨된 경품이 없습니다.');history.back();</script>";
	exit;
}
$sql = "select *, date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY) last_date,  datediff(date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY),now()) gr from t_give where id=$id";
$give = sql_fetch($sql);
$sql = "select name,addr_s from t_comp where id=$give[com_id]";
$com = sql_fetch($sql);


?>

<form name="give_con" method="post" charset="utf-8" action="myentry_gift2.php">
	<input type="hidden" name="id" value="<?=$id?>">

	<section class="myentry">
		<ul class="list2">
			<li>
				<p class="tit_txt">선물할 경품</p>
				<div class="exp_txt"><?=$give[name]?> (<?=$com[name]?>)<br>(유효기간 : ~<?=$give[last_date]?>)</div>
			</li>
			<li>
				<p class="tit_txt">선물 보내는 분 이름</p>
				<div class="exp_txt">
					<input type="text" name="send_name"  placeholder="보내는분 이름" value="<?=$member[mb_name]?>">
				</div>
			</li>
			<li>
				<p class="tit_txt">선물 보내는 분 이메일</p>
				<div class="exp_txt">
					<input type="text" name="send_email"  placeholder="보내는분 이메일입력"  value="<?=$member[mb_email]?>">
				</div>
			</li>
			<li>
				<p class="tit_txt">선물 받는 분 이메일</p>
				<div class="exp_txt">
					<input type="text" name="recv_email" placeholder="받는분 이메일입력">
					<!-- input type="number" name="recv_email" placeholder="'-' 제외하고 숫자만 입력" -->
				</div>
			</li>
			<li>
				<p class="tit_txt">선물 메세지 (200자 이내)</p>
				<div class="exp_txt">
					<textarea name="msg"></textarea>
				</div>
			</li>
		</ul>
		<ul class="list1">
			<li>- 선물을 한 경품은 다시 선물을 할 수 없습니다.</li>
			<li><em>- 선물하기가 완료되면 취소할 수 없으니, 받는 분을 꼭 확인하시기 바랍니다.</em></li>
			<li>- 선물하기를 하면 받는 분에게 이메일을 통해 안내가 됩니다..</li>
		</ul>
		<div class="btn2">
			<a href="javascript:gosave();">선물하기</a>
		</div>
	</section>
</form>
</body>
</html>