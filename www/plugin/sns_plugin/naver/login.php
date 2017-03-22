<?php
include_once("../../../common.php");
//////////////COPYRIGHT/////////////////////
/////////제작 buildsoft.co.kr(빌드소프트) 
/////////제작일 2015.7.28
/////////copyright 삭제하지 않는다는 조건하에 
/////////누구든지 그대로 복제하고 배포할 수 있습니다.
/////////본 프로그램 사용으로 인한 오류 및 사고는 책임지지 않습니다.
///////////////////////////////////
function generate_state() {
        $mt = microtime();
        $rand = mt_rand();
        return md5($mt . $rand);
}

// state token으로 사용할 랜덤 문자열을 생성
$state = generate_state();
// 세션 state token을 저장
$_SESSION["state"]=$state;
$Url=Urlencode("http://{$_SERVER['SERVER_NAME']}/plugin/sns_plugin/naver_oauth/index.php");
$state=Urlencode($state);
?>

<?/*********네이버에 토큰값 요청 redirect_uri 는 반드시 카카오톡에 redirectpath로 지정된 값이어야 합니다.*************/?>
<script type="text/javascript">
	document.location.href="https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=GnJ4HNArC0Mh_9qWN39m&redirect_uri=<?=$Url?>&state=<?=$state?>";
</script>
