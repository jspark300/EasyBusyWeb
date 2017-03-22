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
			<p>개인정보 수집 및 이용약관</p>
		</div>
		
		
	</header>


	<section class="shop_info" style="padding-bottom:60px;">
	
		
		<ul>
<br><br>
본 약관은 회원이 얼리올(이하 '회사')에서 정보통신망법 규정에 따라 이지비지 회원가입을 신청하시는 분께 수집하는 개인정보의 항목, 개인정보의 수집 및 이용목적, 개인정보의 보유 및 이용기간을 안내 드리오니 자세히 읽은 후 동의하여 주시기 바랍니다. 
회원가입시 약관의 동의하기 버튼을 클릭하였을 경우 본 약관의 내용을 모두 읽고 이를 충분히 이해하였으며, 그 적용에 동의한 것으로 봅니다. 
<br>1. 항목 본사는 이용자가 이지비지 서비스를 이용하기 위해 필요한 최소한의 개인정보를 수집합니다. 회원가입 시점에서 이지비지 이용자로부터 수집하는 개인정보는 아래와 같습니다. 
아이디, 비밀번호, 이름, 생년월일, 성별, 가입인증을 위한 핸드폰번호, 주요활동지역을 필수항목으로 수집합니다. 
서비스 이용 과정에서 이벤트 응모 및 신청이나 당첨 등의 이유로 이용자로부터 추가로 개인정보를 수집할 수 있습니다. 
추가로 개인정보를 수집할 경우에는 해당 개인정보 수집 시점에서 이용자에게 안내해 드리고 동의를 받습니다. 
서비스 이용 과정에서 IP 주소, 쿠키, 방문일시, 불량 이용 기록 등의 서비스 이용 기록, 기기정보가 생성되어 수집될 수 있습니다. 
구체적으로 1) 서비스 이용 과정에서 이용자에 관한 정보를 정보통신서비스 제공자가 자동화된 방법으로 생성하여 이를 저장(수집)하거나, 2) 이용자 기기의 고유한 정보를 원래의 값을 확인하지 못하도록 안전하게 변환한 후에 수집하는 경우를 의미합니다. 
<br>2. 이용목적 
저희 얼리올은이지비지 회원관리, 서비스 개발・제공 및 향상, 안전한 인터넷 이용환경 구축 등 아래의 목적으로만 개인정보를 이용합니다.a 
<br>-회원 가입 의사의 확인, 연령 확인, 이용자 본인 확인, 이용자 식별, 회원탈퇴 의사의 확인 등 회원관리를 위하여 개인정보를 이용합니다. 
<br>-콘텐츠 등 기존 서비스 제공(광고 포함)에 더하여, 인구통계학적 분석, 서비스 방문 및 이용기록의 분석, 개인정보 및 관심에 기반한 이용자간 관계의 형성, 지인 및 관심사 등에 기반한 맞춤형 서비스 제공 등 신규 서비스 요소의 발굴 및 기존 서비스 개선 등을 위하여 개인정보를 이용합니다.
<br> - 법령 및 회사의 이용약관을 위반하는 회원에 대한 이용 제한 조치, 부정 이용 행위를 포함하여 서비스의 원활한 운영에 지장을 주는 행위에 대한 방지 및 제재, 계정도용 및 부정거래 방지, 약관 개정 등의 고지사항 전달, 분쟁조정을 위한 기록 보존, 민원처리 등 이용자 보호 및 서비스 운영을 위하여 개인정보를 이용합니다. 
<br>- 유료 서비스 제공에 따르는 본인인증, 구매 및 요금 결제, 상품 및 서비스의 배송을 위하여 개인정보를 이용합니다. - 이벤트 정보 및 참여기회 제공, 광고성 정보 제공 등 마케팅 및 프로모션 목적으로 개인정보를 이용합니다. 
<br>- 서비스 이용기록과 접속 빈도 분석, 서비스 이용에 대한 통계, 서비스 분석 및 통계에 따른 맞춤 서비스 제공 및 광고 게재 등에 개인정보를 이용합니다 
<br>- 보안, 프라이버시, 안전 측면에서 이용자가 안심하고 이용할 수 있는 서비스 이용환경 구축을 위해 개인정보를 이용합니다. 

<br>3.보유 및 이용기간 
회사는 원칙적으로 이용자의 개인정보를 회원 탈퇴 시 지체없이 파기하고 있습니다. 
(법령에서 정한 기간이 있는 경우에는 해당 기간 종료시까지 보유합니다.) 
<br>-전자상거래 등에서 소비자 보호에 관한 법률 
<br>-전자금융에 관한 기록 : 5년 
<br>-계약 또는 청약철회,대금결제, 재화 등의 공급에 관한 기록 : 5년 
<br>-소비자 불만 또는 분쟁처리에 관한 기록 : 3년 -통신비밀보호법-인터넷 로그기록자료 :3개월 –전자금융거래법
<br>-전자금융 거래에 관한 기록 : 5년 
<br>단, 이용자에게 개인정보 보관기간에 대해 별도의 동의를 얻은 경우, 또는 법령에서 일정 기간 정보보관 의무를 부과하는 경우에는 해당 기간 동안 개인정보를 안전하게 보관합니다. 
이용자에게 개인정보 보관기간에 대해 별도의 동의를 얻은 경우는 아래와 같습니다 부정가입 및 징계기록 등의 부정이용기록은 부정 가입 및 이용 방지를 위하여 수집 시점으로부터 6개월간 보관하고 파기하고 있습니다. 부정이용기록 내 개인정보는 가입인증 휴대폰 번호가 있습니다. 
결제도용 등 관련 법령 및 이용약관을 위반하는 결제관련 부정거래기록(아이디, 이름, 휴대폰번호, IP주소, 기기정보, )은 부정거래 방지 및 다른 선량한 이용자의 보호, 안전한 거래 환경 보장을 위하여 수집 시점으로부터 3년간 보관하고 파기합니다



		</ul>
	</section>
<? include_once('./footer.php');?>
</body>

</html>