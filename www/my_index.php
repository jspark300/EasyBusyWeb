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
	<script>

 function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
     // testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
//      document.getElementById('status').innerHTML = 'Please log ' +
  //      'into this app.';
	//  FB.login();
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
    //  document.getElementById('status').innerHTML = 'Please log ' +
      //  'into Facebook.';
	  //FB.login();
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1652690171658082',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

//  FB.getLoginStatus(function(response) {
//	 statusChangeCallback(response);
//	 });
  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

 function facebookLogout() {
		 FB.logout();
		location.replace('/bbs/logout.php');
		
  }
    </script>
</head>
<body>

	<? include_once('./header.php');?>
	<section class="my_nav">
		<nav class="n1">
			<div>
				<ul>
					<? if($is_member) { 
						if($member[mb_level] == "2")
							$lv_str = "회원 ";
						else if($member[mb_level] == "3")
							$lv_str = "<font color='#dd0032'>업체회원</font> ";
						else if($member[mb_level] == "4")
							$lv_str = "영업회원 ";
						else
							$lv_str = $member[mb_id];
						}
if($_SESSION[ss_login_site] == "facebook")
	$logout_url = "javascript:facebookLogout();";
else
	$logout_url = G5_BBS_URL."/logout.php?url=/";
if($_SESSION[ss_login_site] == "")
	$mysign_index_url = "member_check.php";
else
	$mysign_index_url = "mysign_index.php";
?>
					<? if($member[mb_level]==2) {?>
						<li style="color:crimson;font-weight:bold;"><span></span>COMMUNITY</li>
						<li><a href="/"><span><img src="images/blt_my5.png" alt=""></span> 홈</a></li>
						<li><a href="board_list.php?bo_table=notice"><span><img src="images/blt_my6.png" alt=""></span> 공지사항</a></li>
						<li><a href="board_list.php?bo_table=free"><span><img src="images/blt_my6.png" alt=""></span> 자유글</a></li>
						<li><a href="board_list.php?bo_table=qa"><span><img src="images/blt_my7.png" alt=""></span> 질문답변</a></li>
						<li><a href="board_list.php?bo_table=guide"><span><img src="images/blt_my6.png" alt=""></span> 이용안내</a></li>
						<li><a href="board_list.php?bo_table=public"><span><img src="images/blt_my6.png" alt=""></span> 방문후기</a></li>
						<li><a href="regist_com.php"><span><img src="images/blt_my7.png" alt=""></span> 업체회원신청</a></li>	
						<li style="color:crimson;font-weight:bold;"><span></span>MY COMPANY</li>
						<li><a href="regist_shopinfo.php"><span><img src="images/blt_my8.png" alt=""></span> 업체 등록하기</a></li>
						<li><a href="myshop_list.php"><span><img src="images/blt_my8.png" alt=""></span> 마이 업체(내가등록한)</a></li>
						<li><a href="regist_giveaway.php"><span><img src="images/blt_my9.png" alt=""></span> 경품 등록하기</a></li>
						<li><a href="mygive_list.php"><span><img src="images/blt_my9.png" alt=""></span> 마이 경품(내가등록한)</a></li>

						<li style="color:crimson;font-weight:bold;"><span></span>MY ORDER/GIVEAWAY</li>
						<li><a href="myorder.php"><span><img src="images/blt_my7.png" alt=""></span> 나의주문내역</a></li>
						<li><a href="myentry_list.php"><span><img src="images/blt_my1.png" alt=""></span> 나의경품응모내역</a></li>
						<li><a href="mycoupon_reg.php"><span><img src="images/blt_my1.png" alt=""></span> 쿠폰등록</a></li>
						<li><a href="mycoupon_list.php"><span><img src="images/blt_my1.png" alt=""></span> 쿠폰내역</a></li>
						<!--li><a href="mygiveaway_list.html"><span><img src="images/blt_my2.png" alt=""></span> 경품사용내역</a></li-->
						<li><a href="myentryticket.php"><span><img src="images/blt_my3.png" alt=""></span> 응모권내역</a></li>
						<li style="color:crimson;font-weight:bold;"><span></span>MY SETTING</li>
						<li><a href="myregular.php"><span><img src="images/blt_my5.png" alt=""></span> 단골집</a></li>
						<!--li><a href="mypoint.html"><span><img src="images/blt_my11.png" alt=""></span> 포인트</a></li-->
						<!-- li><a href="mysetting.html"><span><img src="images/blt_my12.png" alt=""></span> 설정</a></li-->
						<li><a href="<?=$mysign_index_url?>"><span><img src="images/blt_my4.png" alt=""></span> 내계정</a></li>
						<li><a href="<?php echo $logout_url ?>"><span><img src="images/blt_my12.png" alt=""></span> 로그아웃(<?=$lv_str?> 로그인중)</a></li>
					<? } else if($member[mb_level]>=3 and $member[mb_level]<10) { ?>
						<li style="color:crimson;font-weight:bold;"><span></span>COMMUNITY</li>
						<li><a href="/"><span><img src="images/blt_my5.png" alt=""></span> 홈</a></li>
						<li><a href="board_list.php?bo_table=notice"><span><img src="images/blt_my6.png" alt=""></span> 공지사항</a></li>
						<li><a href="board_list.php?bo_table=free"><span><img src="images/blt_my6.png" alt=""></span> 자유글</a></li>
						<li><a href="board_list.php?bo_table=qa"><span><img src="images/blt_my7.png" alt=""></span> 질문답변</a></li>
						<li><a href="board_list.php?bo_table=guide"><span><img src="images/blt_my6.png" alt=""></span> 이용안내</a></li>
						<li><a href="board_list.php?bo_table=public"><span><img src="images/blt_my6.png" alt=""></span> 방문후기</a></li>
						<li style="color:crimson;font-weight:bold;"><span></span>MY COMPANY</li>
						<li><a href="regist_shopinfo.php"><span><img src="images/blt_my8.png" alt=""></span> 업체 등록하기</a></li>
						<li><a href="myshop_list.php"><span><img src="images/blt_my8.png" alt=""></span> 마이 업체(내가등록한)</a></li>
						<li><a href="regist_giveaway.php"><span><img src="images/blt_my9.png" alt=""></span> 경품 등록하기</a></li>
						<li><a href="mygive_list.php"><span><img src="images/blt_my9.png" alt=""></span> 마이 경품(내가등록한)</a></li>
						<li><a href="comorder.php"><span><img src="images/blt_my7.png" alt=""></span> 고객주문내역</a></li>
						<li style="color:crimson;font-weight:bold;"><span></span>MY ORDER/GIVEAWAY</li>
						<li><a href="myorder.php"><span><img src="images/blt_my7.png" alt=""></span> 나의주문내역</a></li>						
						<li><a href="myentry_list.php"><span><img src="images/blt_my1.png" alt=""></span> 나의경품응모내역</a></li>
						<li><a href="mycoupon_reg.php"><span><img src="images/blt_my1.png" alt=""></span> 쿠폰등록</a></li>
						<li><a href="mycoupon_list.php"><span><img src="images/blt_my1.png" alt=""></span> 쿠폰내역</a></li>

						<!--li><a href="mygiveaway_list.html"><span><img src="images/blt_my2.png" alt=""></span> 경품사용내역</a></li-->
						<li><a href="myentryticket.php"><span><img src="images/blt_my3.png" alt=""></span> 응모권내역</a></li>
						<li style="color:crimson;font-weight:bold;"><span></span>MY SETTING</li>

						<li><a href="myregular.php"><span><img src="images/blt_my5.png" alt=""></span> 단골집</a></li>
						<li><a href="<?=$mysign_index_url?>"><span><img src="images/blt_my4.png" alt=""></span> 내계정</a></li>
						<!--li><a href="mypoint.html"><span><img src="images/blt_my11.png" alt=""></span> 포인트</a></li-->
						<!--li><a href="mysetting.html"><span><img src="images/blt_my12.png" alt=""></span> 설정</a></li-->
						<li><a href="<?php echo $logout_url ?>"><span><img src="images/blt_my12.png" alt=""></span> 로그아웃(<?=$lv_str?> 로그인중)</a></li>
					<? } else if($member[mb_level]==10) { ?>
						<li style="color:crimson;font-weight:bold;"><span></span>COMMUNITY</li>
						<li><a href="/"><span><img src="images/blt_my5.png" alt=""></span> 홈</a></li>
						<li><a href="board_list.php?bo_table=notice"><span><img src="images/blt_my6.png" alt=""></span> 공지사항</a></li>
						<li><a href="board_list.php?bo_table=free"><span><img src="images/blt_my6.png" alt=""></span> 자유글</a></li>
						<li><a href="board_list.php?bo_table=qa"><span><img src="images/blt_my7.png" alt=""></span> 질문답변</a></li>
						<li><a href="board_list.php?bo_table=guide"><span><img src="images/blt_my6.png" alt=""></span> 이용안내</a></li>
						<li><a href="board_list.php?bo_table=public"><span><img src="images/blt_my6.png" alt=""></span> 방문후기</a></li>
						<li><a href="all_eval.php"><span><img src="images/blt_my6.png" alt=""></span> 주인장에게한마디</a></li>
						<li><a href="reg_com_member_list.php"><span><img src="images/blt_my7.png" alt=""></span> 업체회원신청목록</a></li>	
						<li><a href="en_member_list.php"><span><img src="images/blt_my8.png" alt=""></span> 업체회원목록</a></li>
						<li><a href="bz_member_list.php"><span><img src="images/blt_my8.png" alt=""></span> 영업회원목록</a></li>
						<li><a href="enorder.php?id=0"><span><img src="images/blt_my8.png" alt=""></span> 전체주문목록</a></li>
						<li style="color:crimson;font-weight:bold;"><span></span>MY COMPANY</li>
						<li><a href="regist_shopinfo.php"><span><img src="images/blt_my8.png" alt=""></span> 업체 등록하기</a></li>
						<li><a href="myshop_list.php"><span><img src="images/blt_my8.png" alt=""></span> 마이 업체(내가등록한)</a></li>
					
						<li><a href="regist_giveaway.php"><span><img src="images/blt_my9.png" alt=""></span> 경품 등록하기</a></li>
						<li><a href="mygive_list.php"><span><img src="images/blt_my9.png" alt=""></span> 마이 경품(내가등록한)</a></li>
						<li style="color:crimson;font-weight:bold;"><span></span>MY ORDER/GIVEAWAY</li>
						<li><a href="myorder.php"><span><img src="images/blt_my7.png" alt=""></span> 나의주문내역</a></li>						
						<li><a href="myentry_list.php"><span><img src="images/blt_my1.png" alt=""></span> 나의경품응모내역</a></li>
						<li><a href="allentry_list.php"><span><img src="images/blt_my1.png" alt=""></span> 전체경품내역</a></li>
						<li><a href="mycoupon_reg.php"><span><img src="images/blt_my1.png" alt=""></span> 쿠폰등록</a></li>
						<li><a href="mycoupon_list.php"><span><img src="images/blt_my1.png" alt=""></span> 쿠폰내역</a></li>
						<!--li><a href="mygiveaway_list.html"><span><img src="images/blt_my2.png" alt=""></span> 경품사용내역</a></li-->
						<li><a href="myentryticket.php"><span><img src="images/blt_my3.png" alt=""></span> 응모권내역</a></li>
						<li style="color:crimson;font-weight:bold;"><span></span>MY SETTING</li>

						<li><a href="myregular.php"><span><img src="images/blt_my5.png" alt=""></span> 단골집</a></li>
						<li><a href="<?=$mysign_index_url?>"><span><img src="images/blt_my4.png" alt=""></span> 내계정</a></li>
						<!--li><a href="mypoint.html"><span><img src="images/blt_my11.png" alt=""></span> 포인트</a></li-->
						<!--li><a href="mysetting.html"><span><img src="images/blt_my12.png" alt=""></span> 설정</a></li-->
						<li><a href="<?php echo $logout_url ?>"><span><img src="images/blt_my12.png" alt=""></span> 로그아웃(<?=$lv_str?> 로그인중)</a></li>
					<? } else { ?>
						<li style="color:crimson;font-weight:bold;"><span></span>COMMUNITY</li>
						<li><a href="/"><span><img src="images/blt_my5.png" alt=""></span> 홈</a></li>
						<li><a href="board_list.php?bo_table=notice"><span><img src="images/blt_my6.png" alt=""></span> 공지사항</a></li>
						<li><a href="board_list.php?bo_table=free"><span><img src="images/blt_my6.png" alt=""></span> 자유글</a></li>
						<li><a href="board_list.php?bo_table=qa"><span><img src="images/blt_my7.png" alt=""></span> 질문답변</a></li>
						<li><a href="board_list.php?bo_table=guide"><span><img src="images/blt_my6.png" alt=""></span> 이용안내</a></li>
						<li><a href="board_list.php?bo_table=public"><span><img src="images/blt_my6.png" alt=""></span> 방문후기</a></li>
						<li style="color:crimson;font-weight:bold;"><span></span>LOGIN</li>
						<li><a href="member_login.php?url=/shop_list.php"><span><img src="images/blt_my12.png" alt=""></span> 로그인</a></li>
					<? } ?>
					
				</ul>
			</div>
		</nav>
		<!--nav class="n2">
			<div>
				<ul>
					<li><a href="member_login.html"><span></span>로그인</a></li>
					<li><a href="member_join1.html"><span></span>회원가입</a></li>
				</ul>
			</div>
		</nav>
		<nav class="n2">
			<div>
				<ul>
					<li><a href="shop_index.html"><span></span>업체정보</a></li>
					<li><a href="mall_index.html"><span></span>경품몰</a></li>
					<li><a href="javascript:alert('준비중입니다.');"><span></span>커뮤니티</a></li>
				</ul>
			</div>
		</nav-->
	</section>
<? include_once('./footer.php');?>	
</body>
</html>