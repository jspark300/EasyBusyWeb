<?
include_once('./_common.php');

//if ($member['mb_level'] < 2) {
//   alert('회원만 이용가능합니다.', '/member_login.php');
//}
$loc = $_COOKIE['location'];

if($loc != "")
{
	$loc = unescape($loc);
	$ar = explode("|",$loc);
	if(count($ar)==4)
	{
		$loc = $ar[0];
		$lon = $ar[1];
		$lat = $ar[2];
//		$where .= " and lon>$lon-0.025 and lon<$lon+0.025 and lat>$lat-0.025 and lat<$lat+0.025 ";

	}
}
function unescape($source)
{
    $decodedStr = '';
    $pos        = 0;
    $len        = strlen($source);
    while ($pos < $len) {
        $charAt = substr($source, $pos, 1);
        if ($charAt == '%') {
            $pos++;
            $charAt = substr($source, $pos, 1);
            if ($charAt == 'u') {
                // we got a unicode character
                $pos++;
                $unicodeHexVal = substr($source, $pos, 4);
                $unicode       = hexdec($unicodeHexVal);
                $entity        = '&#' . $unicode . ';';
                $decodedStr .= utf8_encode($entity);
                $pos += 4;
            }
            else {
                // we have an escaped ascii character
                $hexVal = substr($source, $pos, 2);
                $decodedStr .= chr(hexdec($hexVal));
                $pos += 2;
            }
        } else {
            $decodedStr .= $charAt;
            $pos++;
        }
    }
    return $decodedStr;
}

if($c1=="")
	$c1 = 0;

?>
<?
if($loc != "")
{
 $dist =",(round((acos(cos(radians(90-$lat))*cos(radians(90-lat))+sin(radians(90-$lat))*sin(radians(90-lat))*cos(radians($lon-lon)))*6371000), 0)) AS distance ";
}
$sql = "update t_comp set view=view+1 where id=$id";
sql_query($sql);
$sql = "select * ".$dist."  from t_comp where id=$id";
$res = sql_fetch($sql);
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
	<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>
	function del_shop()
	{
		if(confirm('업체를 삭제하시겠습니까?\n삭제후 복구가 불가능합니다.'))
		{
			document.del_com.action = "del_com_ok.php";
			document.del_com.submit();
		}
	}
	function del_shop_image()
	{
		if(confirm('업체 이미지를 삭제하시겠습니까?\n삭제후 복구가 불가능합니다.'))
		{
			document.del_com.action = "del_com_img_ok.php";
			document.del_com.submit();
		}
	}
	function close_view()
	{
		//history.back()
		//var win = window.open("","_self");
		//win.close();
		open(location, '_self').close();
	}	
</script>

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
		<div class="btn_back"><a href="shop_list.php?c1=<?=$c1?>&c2=<?=$c2?>&lc=<?=$lc?>&sc=<?=$sc?>&t=<?=time();?>"></a></div>
		<div class="txt_tit">
			<p><?=$res['name']?></p>
		</div>
		<div class="btn_right" id="regular">
			<a href="javascript:add_regularx('<?=$id?>');" class="<?=$regular_str?>">단골</a>
			
		</div>
		<div style="position:absolute; top:10px; right:50px;">
		<button id="full" style="border-radius: 18px;height:35px;width:35px;background-color:white;border:0px;" onclick="full();">+</button>
		</div>
		
	</header>

	
	<section class="shop_map">
		
	
<? if($res['lat'] != "0") { ?>	
	<div id="map_view" style="width:100%; height:300px"></div>
	<script>
		function initMap() {
			var x = <?=$res['lat']?>;
			var y = <?=$res['lon']?>;

			var zoomlevel = 16;
			var markertitle = "<?=$res['name']?>";
			var markermaxwidth = 300;
			var contentstring = "<div><h2><?=$res['name']?></h2></div>";
			var mylatlng = new google.maps.LatLng(x,y);
			var mapoption = { zoom : zoomlevel,
								center : mylatlng,
								mapTypeId : google.maps.MapTypeId.ROADMAP
							}
			var map = new google.maps.Map(document.getElementById('map_view'),mapoption);
			var marker = new google.maps.Marker( {
											position : mylatlng,
												map:map,
												title: markertitle
										});
			var infowindow = new google.maps.InfoWindow( {
														content: contentstring,
															maxWidth : markermaxwidth
														});
			google.maps.event.addListener(marker, 'click', function() { infowindow.open(map, marker); });
		}

	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCT6aggjOd9vZsrfI4JVs4UAkR6fuzA4HI&callback=initMap" async defer></script>
<? }
?>	
	
	</section>
	<section class="slide_gallery">
		<div>
			<ul class="bxslider" id="bxslider">
			<? if($res['img_id'] != "") {?>
				<? if($res['img1']!="") {?>	<li><img src="<?="data/shop/".$res['img_id']."/".$res['img1'] ?>" alt=""></li><? }?>
				<? if($res['img2']!="") {?>	<li><img src="<?="data/shop/".$res['img_id']."/".$res['img2'] ?>" alt=""></li><? }?>
				<? if($res['img3']!="") {?>	<li><img src="<?="data/shop/".$res['img_id']."/".$res['img3'] ?>" alt=""></li><? }?>
				<? if($res['img4']!="") {?>	<li><img src="<?="data/shop/".$res['img_id']."/".$res['img4'] ?>" alt=""></li><? }?>
				<? if($res['img5']!="") {?>	<li><img src="<?="data/shop/".$res['img_id']."/".$res['img5'] ?>" alt=""></li><? }?>
			<? } else {?>
				<? if(file_exists("img_shop_detail/".$c1."/1.jpg")) {?>	<li><img src="img_shop_detail/<?=$c1?>/1.jpg" alt=""></li><? }?>
				<? if(file_exists("img_shop_detail/".$c1."/2.jpg")) {?>	<li><img src="img_shop_detail/<?=$c1?>/2.jpg" alt=""></li><? }?>
				<? if(file_exists("img_shop_detail/".$c1."/3.jpg")) {?>	<li><img src="img_shop_detail/<?=$c1?>/3.jpg" alt=""></li><? }?>
				<? if(file_exists("img_shop_detail/".$c1."/4.jpg")) {?>	<li><img src="img_shop_detail/<?=$c1?>/4.jpg" alt=""></li><? }?>
				<? if(file_exists("img_shop_detail/".$c1."/5.jpg")) {?>	<li><img src="img_shop_detail/<?=$c1?>/5.jpg" alt=""></li><? }?>
				<? if(file_exists("img_shop_detail/".$c1."/6.jpg")) {?>	<li><img src="img_shop_detail/<?=$c1?>/6.jpg" alt=""></li><? }?>
					<!--li><img src="img_shop_detail/<?=$c1?>/6.jpg" alt=""></li-->
			<? }?>
			</ul>
		</div>
		<a href="#" id="prev" class="prev">이전</a>
		<a href="#" id="next" class="next">다음</a>
	</section>
<script>
var st = "";
function full() 
{
	if(st == "")
	{
		document.getElementById("full").innerHTML = "-";
		document.getElementById("map_view").style.height = "500px";
		st = "full";
	}
	else
	{
		document.getElementById("full").innerHTML = "+";
		document.getElementById("map_view").style.height = "300px";
		st = "";
	}
	initMap();
}
$(document).ready(function(){
 var mySlider = $('#bxslider').bxSlider( {
	pager:false,
	controls:false,
	infiniteLoop:false
 }
  );
  $( '#prev' ).on( 'click', function () {
                mySlider.goToPrevSlide();  //이전 슬라이드 배너로 이동
                return false;              //<a>에 링크 차단
            } );
 
           //다음 버튼을 클릭하면 다음 슬라이드로 전환
            $( '#next' ).on( 'click', function () {
                mySlider.goToNextSlide();  //다음 슬라이드 배너로 이동
                return false;
            } );
});
</script>
<?if($c1<21) {?>
	<section class="shop_detail">
		<?
			$t = date("Ymd");
			$sql = "select * from t_give where com_id='".$id."' and start_date<=".$t." and end_date>=".$t."";
			$give = sql_fetch($sql);

			if($give) {
				$total_enter = floor($give[price]/25000)*50;
				$sql = "select id,reg_date from t_give_enter where give_id=".$give[id]." and mb_no=".$member[mb_no]."";
				//echo $sql;
				$give_enter_rs = sql_fetch($sql);
				$sql = "select count(id) c from t_give_enter where  give_id=".$give[id]."";
				$g_rs = sql_fetch($sql);
				$g_count = $g_rs[c];
			
		?>
		
		<h2>경품</h2>
		<ul class="u1">
			<li>
				<dl>
					<dt>
						<p><img src="<?="/data/item/".$give['img_id']."/".$give['img_id'].".jpg" ?>" height="100" alt=""></p>
					</dt>
					<dd>
						<p><span class="tit"><?=$give[name]?></span> <span>(<?=number_format($give[price])?>원)</span></p>
						<p>- 응모기간 : <strong><?=substr($give[start_date],0,4).".".substr($give[start_date],4,2).".".substr($give[start_date],6,2)?>~<?=substr($give[end_date],0,4).".".substr($give[end_date],4,2).".".substr($give[end_date],6,2)?></strong></p>
						<p>- 현재 응모자수 : <strong><?=$g_count?></strong> (전체 : <?=$total_enter?>)</p>
						
							<p class="btn"><a href="shop_entry.php?id=<?=$id?>&c1=<?=$c1?>&give_id=<?=$give[id]?>">응모하기</a></p>
						
					</dd>
				</dl>
			</li>			
		</ul>
		<? } ?>
		<!--p class="btn_more"><a href="#1">지난 경품 보기</a>
	
		</p-->
		<div class="btn_wrap">
			<ul>
				<!--li><a href="shop_sns.php?id=<?=$id?>">공유</a></li-->
				<li><a href="shop_board_list.php?bo_table=public&com_id=<?=$id?>">후기</a></li>
				
				<li><a href="shop_menu.php?id=<?=$id?>">메뉴</a></li>
				<li><a href="/regist_shopinfo.php?id=<?=$res['id']?>&c1=<?=$c1?>&c2=<?=$c2?>">수정</a></li>
			</ul>
		</div>




	</section>
<? }else {?>
	<section class="shop_detail">
		<div class="btn_wrap">
			<ul>
				<!--li><a href="shop_sns.php?id=<?=$id?>">공유</a></li-->
				<li><a href="shop_board_list.php?bo_table=public&com_id=<?=$id?>">후기</a></li>
				<li><a href="shop_menu.php?id=<?=$id?>">메뉴</a></li>
				<li><a href="/regist_shopinfo.php?id=<?=$res['id']?>&c1=<?=$c1?>&c2=<?=$c2?>">수정</a></li>
			</ul>
		</div>
	</section>
<? } ?>
	<section class="shop_info">
	<h2>업체정보</h2>
		<div class="d1">
			<p class="exp">
				<?=$res['description']?>
			</p>
		</div>
		<div class="cb">
			<ul class="fl">
				<li class="exp1">
				
<?

$sql = "select count(wr_id) c from g5_write_public where wr_1='".$id."'";
//echo $sql;
$comp = sql_fetch($sql);
$sql = "select  call_count from t_call where com_id='".$id."'";
//echo $sql;
$call = sql_fetch($sql);
if($call['call_count'] == "")
	$call_count = 0;
else
	$call_count = $call['call_count'];
?>
					<p>거리 <?=number_format($res[distance])?>m, 단골 <?=$res['regular_count']?>, 조회 <?=$res['view']?>, 후기 <?=$comp[c]?>, 콜수 <?=$call_count?>
					<? if($member[mb_level]==10) { ?>
				<p><strong><a href="javascript:del_shop();">삭제</a></strong>
				</p>
				<? } ?>
					<!--p><strong>바로주문가능</strong></p-->
				</li>	


				
			</ul>
			<ul class="fr">
				<li><a href="javascript:;"  id="kakao-link-btn"><img src="images/btn_sns_kt.png" alt="kakao talk"></a></li>
				<li><a href="javascript:shareStory();"><img src="images/btn_sns_ks.png" alt="kakao story"></a></li>
				<li><a href="javascript:facebook_share();"  target="_blank"><img src="images/btn_sns_fb.png" alt="facebook"></a></li>
				<li><a href="https://twitter.com/intent/tweet?text=EASYBUSY&url=http://easybusy.co.kr/shop_detail.php?id=<?=$id?>"><img src="images/btn_sns_tw.png" alt="twitter"  target="_blank"></a></li>
			</ul>
		</div>
		<!-- h2>업체정보</h2 -->
		<ul>

			
			<li class="exp2">
				<dl>
					<dt>주소</dt><dd><?=str_replace("|"," ",trim($res['addr_s']))==""?"미등록":str_replace("|"," ",$res['addr_s'])?></dd>
				</dl>
				<!--dl>
					<dt>전화번호</dt><dd><?=$res['phone']=="--"?"미등록":$res['phone']?></dd>
				</dl-->
				<dl>
					<dt>매장정보</dt>
					<dd>
						<? if($res[business_hour]=="1") { ?>
						<p>영업시간 : 24시간</p>
						<? } else {?>
						<p>영업시간 : <?=$res[sdate]?> ~ <?=$res[edate]?></p>
						<? } ?>
						<p>휴무정보 : <?=$res[holiday]?></p>
						<p></p>
					</dd>
				</dl>
				<dl>
					<dt>홈페이지</dt><dd>
					<?if($res['homepage']!="") {?>
					<a href="http://<?=str_replace("http://","",$res['homepage'])?>"><?=$res['homepage']?></a>
					<?} else { ?>
					미입력
					<? } ?>
					</dd>
				</dl>
			</li>
		</ul>
	</section>
<section class="member_wrap" style="top:0px;">
	<div class="btn5">
				<?if(strlen($res[phone])>6) {?><a href="javascript:call();">전화걸기</a> <? } ?>
	<? if($res[order_tel_st]!="" || $res[order_sms_st]!="") { ?>			<a href="shop_menu.php?id=<?=$id?>">주문하기</a> <? } ?><!-- a href="javascript:self.close();">길안내</a-->
	</div>
</section>			

		<script>
	  function add_regularx(id){ 
        $.post("/add_regular.php",{"id" : id},function(data){ 
			if(data=="x")
			{
				alert('로그인이 필요합니다.');
				//location.href='member_login.php';
			}
			else
				 $("#regular").html(data); 
					
        });	
		}
	function call(){ 
			$.post("/add_call.php",{"id" : <?=$id?>},function(data){ 
					
			});	
			location.href='tel:<?=$res['phone']?>';
		}
		
		
		
//	 function kim_navi()
//	 {
//		 $.post("/kim_navi_go.php","
//	 }
	</script>
<script>
    // 사용할 앱의 JavaScript 키를 설정해 주세요.
    Kakao.init('43dc3e37a036fe11fe435fd96ce7f051');

    // 카카오톡 링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
    Kakao.Link.createTalkLinkButton({
      container: '#kakao-link-btn',
      label: '<?=$res[name]?>',
      image: {
        src: '<?="http://easybusy.co.kr/data/shop/".$res[img_id]."/".$res[img1]?>',
        width: '400',
        height: '300'
      },
      webButton: {
        text: '이지비지:술이한잔 땡길때 ;)',
        url: 'http://easybusy.co.kr/shop_detail.php?id=<?=$id?>' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
      }
    });
	 function shareStory() {
        Kakao.Story.open({
			url: 'http://easybusy.co.kr/shop_detail.php?id=<?=$id?>',
			text: '<?=$res[name]?> : 이지비지:술이한잔 땡길때 ;)'
        });
      }
	  function facebook_share()
	  {
		  var u = encodeURIComponent("http://easybusy.co.kr/shop_detail.php?id=<?=$id?>&t=<?=time()?>");
		  top.location.href ="http://www.facebook.com/sharer/sharer.php?u="+u;
	  }
    </script>
<form name="del_com" method="post" charset="utf-8" action="del_com_ok.php">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="c1" value="<?=$c1?>">
	<input type="hidden" name="c2" value="<?=$c2?>">
	<input type="hidden" name="lc" value="<?=$lc?>">
	<input type="hidden" name="sc" value="<?=$sc?>">
</form>
	
</body>

</html>