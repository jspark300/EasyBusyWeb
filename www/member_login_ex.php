<?php
include_once('./_common.php');
if ($is_member) {
	echo "<script>location.href='/';</script>";
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
	<script src="a_js/jquery-1.11.3.min.js"></script>
	<script src="a_js/common.js"></script>
	<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>
    function gologin() {
        //로그인과정
        f = document.FrmLoginx;
        if (!f.mb_id.value || f.mb_id.value == "") {
            alert("이메일(아이디)을 입력해 주세요");
            f.mb_id.focus();
            return;
        }
        if (!f.mb_password.value || f.mb_password.value == "") {
            alert("비밀번호를 입력해 주세요");
            f.mb_password.focus();
            return;
        }


        f.action = "/bbs/login_check.php"
        f.target = ""
        f.submit();
    }

	history.go(1);
  
</script>	
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
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
   //   document.getElementById('status').innerHTML = 'Please log ' +
   //     'into this app.';
	  FB.login(function(response){
			testAPI();
			//location.replace('/index.php');
		});

    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
   //   document.getElementById('status').innerHTML = 'Please log ' +
   //     'into Facebook.';
	  FB.login(function(response){
			 testAPI();
			//location.replace('/index.php');
		});
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
	   console.log('checkLoginState');
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

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
		$.post("/flogin.php",{name: response.name, id: response.id, facebook: "facebook"},
		function(postphpdata) { 
				if(postphpdata == "ok"){
					location.replace('/index.php');
				}
			});
		
  //    console.log('Successful login for: ' + response.name);
  //    document.getElementById('status').innerHTML =
  //      'Thanks for logging in, ' + response.name + '!';
    });
  }
    </script>
</head>
<body>

	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>로그인</p>
		</div>
	</header>
	<section class="member_wrap">
<form name="FrmLoginx" method="post" >
<? if($url=="")
	$url =  $_SERVER['HTTP_REFERER'];
?>
	<input type="hidden" name="url" value="<?=$url?>">
		<h2 class="tit_txt">
			● 회원님의 이메일 및 비밀번호를 입력해 주세요
		</h2>
		<div class="input">
			<input type="email" name="mb_id" placeholder="이메일(아이디) 입력">
			<input type="password" name="mb_password" placeholder="비밀번호 입력">
		</div>
		<div class="btn1">
			<a href="javascript:gologin();">로그인</a>
		</div>
		<div class="btn2">
			<a href="member_pw.php">비밀번호찾기</a>
			<a href="member_join2.php">회원가입</a>
		</div>
</form>
	</section>
	<!--section class="member_wrap">
		<div class="d1">
			<h3 class="subtit_txt">간편로그인</h3>
			<a href="/plugin/sns_plugin/naver/login.php" class="naver">네이버계정으로 로그인</a>
			<a href="/plugin/sns_plugin/kakao/login.php" id="custom-login-btn" class="kakao">카카오계정으로 로그인</a>
			<a href="javascript:checkLoginState();"   class="facebook">페이스북계정으로 로그인</a>
		</div>
		<div id="status"></div>
	</section-->
	<!--section class="member_wrap">
		<div class="d1">
			<h3 class="subtit_txt">간편로그인</h3>
			<a href="#1" class="naver">네이버계정으로 로그인</a>
			<a href="#1" class="facebook">페이스북계정으로 로그인</a>
			<a href="#1" class="kakao">카카오계정으로 로그인</a>
		</div>
	</section-->
    
<iframe name="FrmHid" id="FrmHid" src="" width=0 height=0></iframe>

</body>
</html>