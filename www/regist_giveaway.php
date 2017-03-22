<?
include_once('./_common.php');
if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
if($member[mb_level]<3)
{
	echo "<script>alert('업체회원만 등록가능합니다.');location.href='member_login.php';</script>";
	exit;
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
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
	<script src="a_js/jquery-1.11.3.min.js"></script>
	<script src="a_js/common.js"></script>
	<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

<script type="text/javascript">
	function reg_give()
	{
		if(reg_com.com_id.value == "")
		{
			alert('업체를 선택해 주세요');
			return;
		}

		if(trim(reg_com.give_name.value) == "")
		{
			alert('경품명을 입력해 주세요');
			reg_com.give_name.focus();
			return;
		}
		if(reg_com.price.value == "")
		{
			alert('경품가를 입력해 주세요');
			reg_com.price.focus();
			return;
		}
		if(isNaN(reg_com.give_start.value) == true)
		{
			alert('경품응모시작일은 숫자로 입력해 주세요');
			reg_com.give_start.focus();
			return;
		}
		if(isNaN(reg_com.give_end.value) == true)
		{
			alert('경품응모마감일은 숫자로 입력해 주세요');
			reg_com.give_end.focus();
			return;
		}
		if(isNaN(reg_com.price.value) == true)
		{
			alert('경품가는 숫자로 입력해 주세요');
			reg_com.price.focus();
			return;
		}
		if(reg_com.price.value < 10000)
		{
			alert('경품가는 만원이상 입력해 주세요');
			reg_com.price.focus();
			return;
		}

<?if($give_id=="") { ?>
		if(reg_com.img1.value == "")
		{
			alert('이미지를 입력해 주세요');
			reg_com.img1.focus();
			return;
		}
<?} ?>
//		if(reg_com.description.value == "")
	//	{
	//		alert('경품소개를 입력해 주세요');
	//		reg_com.description.focus();
	//		return;
	//	}
		reg_com.submit();
	}

	function trim(str)
	{
		return str.replace(/^\s*|\s*$/g,"");
	}
  $(function() {
  $("#sdate").datepicker({ dateFormat: "yymmdd" });
  $("#edate").datepicker({ dateFormat: "yymmdd" });
 });

</script>
</head>
<body>
	<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>무료경품 등록</p>
		</div>
	</header>
<?
if($give_id != "")
{
	$sql = "select * from t_give where id='".$give_id."'";
	$give = sql_fetch($sql);
}
$sql = "select id,name from t_comp where reg_id='".$member[mb_id]."' or own_id='".$member[mb_id]."' order by modify_date desc";
$ba_result = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($ba_result)) {
	if($give[com_id]==$row[id])
		$str .= "<option value='".$row['id']."' selected>".$row['name'];
	else
		$str .= "<option value='".$row['id']."' >".$row['name'];

}

?>

	<section class="member_wrap">
<form name="reg_com" method="post" charset="utf-8" action="reg_give_ok.php"   enctype="multipart/form-data">
<input type="hidden" name="it_id" value="<?=$give[img_id]?>">
<input type="hidden" name="give_id" value="<?=$give_id?>">


		<ul class="input_wrap">
			<li>
				<p class="tit_txt">● 업체선택</p>
				<div class="input com">
					<span>
						<select name="com_id">
							<?=$str?>
						</select>
					</span>
				</div>
			</li>
			<li>
				<p class="tit_txt">● 경품명</p>
				<div class="input">
					<input type="text" name="give_name" placeholder="경품명 입력" value="<?=$give[name]?>">
				</div>
			</li>
			<li>
				<p class="tit_txt">● 경품응모시작일</p>
				<div class="input">
					<input type="text" id="sdate" name="give_start" placeholder="경품응모시작일(20151210)"  value="<?=$give[start_date]?>">
				</div>
			</li>
			<li>
				<p class="tit_txt">● 경품응모마감일</p>
				<div class="input">
					<input type="text" id="edate" name="give_end" placeholder="경품응모마감일(20151220)"  value="<?=$give[end_date]?>">
				</div>
			</li>
			<li>
				<p class="tit_txt">● 경품가</p>
				<div class="input txt_r">
					<input type="text" name="price" placeholder="경품가 입력"  value="<?=$give[price]?>">
				</div>
				<p class="exp">응모가능 인원은 자동으로 계산됩니다.(1만원인경우 50명)</p>
			</li>
			<li>
				<p class="tit_txt">● 경품 이미지 등록</p>
				<div class="input"><? if($give['img1']!="") {?><img src="<?="data/item/".$give['img_id']."/".$give['img_id'].".jpg" ?>" alt=""><? }?>
					<input type="file" name="img1">
				</div>
				<p class="exp">이미지는 가로 이미지로 등록해주세요.</p>
			</li>
			<!--li>
				<p class="tit_txt">● 경품소개</p>
				<div class="input">
					<textarea name="description"><?//=$give[description]?></textarea>
				</div>
			</li-->
		</ul>
		<div class="btn1">
			<a href="javascript:reg_give();">경품등록</a>
			<a href="javascript:history.back();">취소</a>
		</div>
</form>
	</section>
</body>
</html>