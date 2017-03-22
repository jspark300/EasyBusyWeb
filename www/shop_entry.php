<?
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='/member_login.php'</script>";
	exit;
}

$sql = "select id,name,addr_s,phone,lat,lon,description from t_comp where id=$id";
$res = sql_fetch($sql);
$sql = "select * from t_give where id=$give_id";
$give = sql_fetch($sql);
$total_enter = floor($give[price]/25000)*50;
$sql = "select count(id) c from t_give_enter where give_id=$give_id";
$give_enter = sql_fetch($sql);
$enter_count = $give_enter[c];
$sql = "select id,reg_date,select_no from t_give_enter where  give_id=$give_id and mb_no=".$member[mb_no];
$rs = sql_fetch($sql);
if($rs)  // 이미 응모완료
{
	$sel_st = "0";
	$strmsg = "응모일 : ". date("Y-m-d H:i:s",$rs[reg_date]). "<br>선택번호 : <b>[".$rs[select_no]. "]</b> 에 응모하셨습니다.";
	//echo "<script>alert('이미 응모하였습니다.');location.href='/shop_list.php';</script>";
	//exit;
}
else
{
	$sel_st = "1";
	$strmsg = "※ 아래 응모번호 중 하나를 선택해 주세요.";
}

$sql = "select select_no from t_give_enter where  give_id=$give_id";
$rsc = sql_query($sql);
$give_ar = array();
while ($row=sql_fetch_array($rsc)) {
	$key = $row[select_no];
	$give_ar[$key] = 1;
}


?>
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
	function select_enter(no)
	{
		document.give_enter.select_no.value = no;
	}
	function select_enter_x(no)
	{
		//document.give_enter.select_no.value = no;
		strmsg = '<?=date("Y-m-d",$rs[reg_date]). "에 선택번호 [".$rs[select_no]. "]으로 이미 응모하셨습니다."?>';
		alert(strmsg);
	}
	function reg_give_enter()
	{
		if(document.give_enter.select_no.value == "")
		{
			alert('응모번호를 선택해 주세요');
			
			return;
		}
		document.give_enter.submit();

	}
	function close_exit()
	{
		location.href = '/shop_detail.php?id=<?=$shop_id?>&c1=<?=$c1?>'
	}
</script>
</head>
<body>

	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p><?=$res["name"]?></p>
		</div>
	</header>
	<section class="shop_detail pb10">
		<h2>경품 응모하기</h2>
		<ul class="u1">
			<li>
				<dl>
					<dt>
						<p><img src="<?="/data/item/".$give['img_id']."/".$give['img1'] ?>" height="100" alt=""></p>
					</dt>
					<dd>
						<p><span class="tit"><?=$give['name']?></span> <span>(<?=number_format($give[price])?>원)</span></p>
						<p>- 응모마감 : <strong><?=substr($give[end_date],0,4).".".substr($give[end_date],4,2).".".substr($give[end_date],6,2)?></strong></p>
						<p>- 현재 응모자수 : <strong><?=$enter_count?></strong> (전체 : <?=$total_enter?>)</p>
						<p class="exp"><?=$strmsg?></p>
					</dd>
				</dl>				
			</li>			
		</ul>
	</section>
	<section class="shop_entry_2">
<form name="give_enter" method="post" charset="utf-8" action="shop_entry2.php">
<input type="hidden" name="shop_id" value="<?=$id?>">
<input type="hidden" name="c1" value="<?=$c1?>">
<input type="hidden" name="give_id" value="<?=$give_id?>">
<input type="hidden" name="select_no" >
		<!--div class="d1">
			<a href="#1">랜덤선택</a>
		</div-->
		<div class="d2">
			<ul>
				<?
				for($i=1;$i<$total_enter+1; ++$i)
				{
					if($give_ar[$i] == 1)
					{
						if($rs[select_no] == $i)
							echo "<li><a href='#1' class='myselected'>".$i."</a></li>";
						else
							echo "<li><a href='#1' class='selected'>".$i."</a></li>";
					}
					else
					{
						if($sel_st == "1")
							echo "<li><a href='javascript:select_enter(".$i.");'>".$i."</a></li>";
						else
							echo "<li><a href='javascript:select_enter_x(".$i.");'>".$i."</a></li>";
					}
				}
				?>

			</ul>
		</div>
		<div class="btn_wrap_btm">
		<?if($sel_st=="1") { ?><a href="javascript:reg_give_enter();" class="btn_t1">선택 완료</a>
		<? } else { ?>
			<a href="javascript:history.back();" class="btn_t1">닫기</a>	
		<? } ?>
		</div>
</form>
	</section>
</body>
</html>