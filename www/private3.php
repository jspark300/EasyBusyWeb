<?
include_once('./_common.php');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="fb:app_id" content="1652690171658082" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="EASYBUSY : <?=$res[name]?>" />
	<meta property="og:url" content="http://easybusy.co.kr/shop_detail.php?id=<?=$id?>&t=<?=time()?>" />
	<meta property="og:description" content="<?=$res['description']?>" />
	<meta property="og:image" content="http://easybusy.co.kr/data/shop/<?=$res[img_id]?>/1.jpg" />		
	<title>EASYBUSY</title>
	<link href="a_css/default.css" rel="stylesheet">
	<link href="a_css/common.css" rel="stylesheet">
	<script src="a_js/jquery-1.11.3.min.js"></script>
	<script src="a_js/common.js"></script>
	<link rel="stylesheet" href="a_css/swiper.min.css">
	<script src="a_js/swiper.min.js"></script>
	<script src="a_js/jquery.bxslider.js"></script>
</head>
<body>
<? include_once('./header_inc.php');?>


<?
if($res[order_tel_st]!="0" || $res[order_sms_st]!="0" )
	$order_st = "<a href='shop_menu.php?id=".$id."'>바로주문가능</a>";
$sql = "select count(id) c from t_com_regular where com_id='$id' and mb_no='$member[mb_no]'";
$rx = sql_fetch($sql);
$regular_st = $rx[c];
if($regular_st>0)
	$regular_str = "regular on";
else
	$regular_str = "regular";

?>
<header class="header2">
		<div class="btn_back"><a href="javascript:close_view();"></a></div>
		<div class="txt_tit">
			<p>개인정보 제3자 이용약관</p>
		</div>
		
		
	</header>


	<section class="shop_info" style="padding-bottom:60px;">
	
		
		<ul>
<br><br>
회사는 회원님이 제공한 개인정보를 회사에서 제공하는 서비스 이용과 관련한 목적에만 사용하며, 목적외에 이용하거나 타인 또는 타기업, 타기관에 제공하지 않습니다. 다만, 양질의 서비스 제공을 위한 회원님의 개인정보를 협력업체와 공유할 필요가 있는 경우에는 제공받는자, 제공목적, 제공정보 항목, 이용 및 보유기간 등을 회원에게 고지하여 동의를 구합니다. 
<br><br>
제1조 개인정보의 제3자 제공 
<br>1. 회사는 회원님의 개인정보를 제1조(개인정보의 처리 목적)에서 명시한 범위 내에서만 처리하며, 회원님의 동의 내지 법이 허용한 경우에만 개인정보를 제 3자에게 제공합니다. 
<br>2. 회사는 다음과 같이 회원님들의 개인정보를 제3자에게 제공합니다 
<br>3. 개인정보를 제공받는 자 -이지비지 어플리케이션 내 제휴사 등록 업소. 
<br>4. 개인정보를 제공받는 자의 개인정보 이용목적 -이지비지 서비스이용 
<br>5. 제공하는 개인정보의 항목 -회원이 등록한 별명 및 주요활동지역 
<br>6. 개인 정보 보유 및 이용기간 -서비스 제공 완료 후 6개월 
<br>7. 아래의 경우에는 관련 법령의 규정에 의하여 회원님의 동의 없이 개인정보를 제공할 수도 있사오니, 이점 양지 바랍니다. 1.이용자가 사전에 공개하거나 또는 제3자 제공에 동의한 경우 2.관계법령의 규정에 의거하거나, 수사목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우 
<br><br>
제2조 개인정보처리의 위탁 
<br>1. 회사는 위탁업무 계약서 등을 동해서 개인정보보호 관련 법규의 준수, 개인정보에 관한 비밀 유지, 제3자 제공에 대한 금지, 사고시의 책임 부담, 위탁기간, 처리 종료 후의 개인정보의 파기 의무 등을 규정하고, 이를 준수하도록 관리하고 있습니다. 
<br>2. 이벤트 제공시 개별적으로 회원님의 동의 하에 해당 이벤트업체에 고객님의 정보를 제공할 수 있으며, 시스템관련의 원활한 상담을 위해 아래와 같이 개인정보를 위탁하고 있습니다. 1.수탁자 위탁업무 2.결제시스템 운영 시 결제수단 제공 3.기프티콘운영시 제공업무 
<br>3. 위탁업무의 내용이나 수탁자가 변경될 경우에는 지체 없이 본 개인정보 취급방침을 통하여 공개하도록 하겠습니다.



		</ul>
	</section>
<? include_once('./footer.php');?>
</body>

</html>