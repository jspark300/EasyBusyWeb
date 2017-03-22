<?php
include_once('./_common.php');
//////////////COPYRIGHT/////////////////////
/////////제작 buildsoft.co.kr(빌드소프트) 
/////////제작일 2015.7.28
/////////copyright 삭제하지 않는다는 조건하에 
/////////누구든지 그대로 복제하고 배포할 수 있습니다.
/////////본 프로그램 사용으로 인한 오류 및 사고는 책임지지 않습니다.
///////////////////////////////////
?>
<?/*********카카오톡에 토큰값 요청 redirect_uri 는 반드시 카카오톡에 redirectpath로 지정된 값이어야 합니다.*************/?>
<script type="text/javascript">
	document.location.href="https://kauth.kakao.com/oauth/authorize?client_id=fad4c2cb87ee47d37e463d10e8e514cb&redirect_uri=http://<?=$_SERVER['SERVER_NAME']?>/plugin/sns_plugin/kakao_oauth&response_type=code";
</script>
