<?
    /* ============================================================================== */
    /* =   PAGE : 인증 요청 PAGE                                                    = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2012.01   KCP Inc.   All Rights Reserved.                 = */
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   Hash 데이터 생성 필요 데이터                                             = */
    /* = -------------------------------------------------------------------------- = */
    /* = 사이트코드 ( up_hash 생성시 필요 )                                         = */
    /* = -------------------------------------------------------------------------- = */

   $site_cd   = "SM06R";

    /* = -------------------------------------------------------------------------- = */
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
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "http://easybusy.co.kr";
var g5_bbs_url   = "http://easybusy.co.kr/bbs";

function checkNic(){
	f = document.form_auth;

	if(f.mb_nick.value == "" )
	{
		alert("닉네임을 입력해 주세요.");
		return;
	}
	f.action="/checknic.php"
	f.target = "FrmHid";
	f.submit();
}
function checkEmail(){
	f = document.form_auth;
	if(f.email.value == "" )
	{
		alert("이메일을 입력해 주세요.");
		return;
	}
	f.action="/checkemail.php"
	f.target = "FrmHid";
	f.submit();
}
function checkTel(){
	f = document.form_auth;
	if(f.hp.value == "" )
	{
		alert("휴대폰 번호를 입력해 주세요.");
		return;
	}
	f.action="/checktel.php"
	f.target = "FrmHid";
	f.submit();
}
function fregisterform_submit(){
	f = document.form_auth;
//	if(!f.mb_nick.value){
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}	
		if (f.mb_password.value.length < 4) {
				alert("비밀번호를 4글자 이상 입력하십시오.");
				f.mb_password.focus();
				return false;
		}
		if (f.mb_password.value != f.mb_password_re.value) {
			alert("비밀번호가 같지 않습니다.");
			f.mb_password_re.focus();
			return false;
		}
		
	//	alert("닉네임을 입력해 주세요");
	//	f.nicname.focus();
	//	return;
	//}

		// 본인확인 체크
//	if(f.cert_no.value=="") {
//		alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
//		return false;
//	}	
	if (f.mb_name.value.length < 1) {
		alert("이름을 입력하십시오.");
		f.mb_name.focus();
		return false;
	}
	var msg = reg_mb_hp_check();
		if (msg) {
		alert(msg);
		f.reg_mb_hp.select();
		return false;
	}
	var msg = reg_mb_nick_check();
		if (msg) {
			alert(msg);
			f.reg_mb_nick.select();
			return false;
		}
	
	
	if(f.c1.checked!=true){
		alert("이지비지 서비스 이용약관에 동의 해주세요.");
		return false;
	}
	if(f.c2.checked!=true){
		alert("위치기반 서비스 이용약관에 동의 해주세요.");
		return false;
	}
	if(f.c3.checked!=true){
		alert("개인정보 수집 및 이용에 동의 해주세요.");
		return false;
	}
	if(f.c4.checked!=true){
		alert("개인정보 제3자 이용에 동의 해주세요.");
		return false;
	}	
	document.getElementById("btn_submit").disabled = "disabled";
//	return true;
	f.action = "join_db.php";
	f.target="";
	f.submit();
}



            // 결제창 종료후 인증데이터 리턴 함수
            function auth_data( frm )
            {
                var auth_form     = document.form_auth;
                var nField        = frm.elements.length;
                var response_data = "";

                // up_hash 검증 
                if( frm.up_hash.value != auth_form.veri_up_hash.value )
                {
                    alert("up_hash 변조 위험있음");
                    
                }                
                

                //스마트폰 처리
                for ( i = 0; i < nField; i++ )
                {
                    if( frm.elements[i].value != "" )
                    {
                        response_data += frm.elements[i].name + " : " + frm.elements[i].value + "n";
						
                    }
                }
                
                if( navigator.userAgent.indexOf("Android") > - 1 || navigator.userAgent.indexOf("iPhone") > - 1 )
                {
                    document.getElementById( "cert_info" ).style.display = "";
                    document.getElementById( "kcp_cert"  ).style.display = "none";
                }
				auth_form.mb_name.value = frm.username.value;
				auth_form.mb_hp.value = frm.phone.value;
				auth_form.cert_no.value = frm.certno.value;
				document.getElementById( "reg_mb_name" ).readOnly = true;
				document.getElementById( "reg_mb_hp" ).readOnly = true;
                    
               // alert(response_data);
            }
            
            // 인증창 호출 함수
            function auth_type_check()
            {
                var auth_form = document.form_auth;


                
                    if( navigator.userAgent.indexOf("Android") > - 1 || navigator.userAgent.indexOf("iPhone") > - 1 )
                    {
                        auth_form.target = "kcp_cert";
                        
                        document.getElementById( "cert_info" ).style.display = "none";
                        document.getElementById( "kcp_cert"  ).style.display = "";
                    }
                    else
                    {
                        var return_gubun;
                        var width  = 410;
                        var height = 500;

                        var leftpos = screen.width  / 2 - ( width  / 2 );
                        var toppos  = screen.height / 2 - ( height / 2 );

                        var winopts  = "width=" + width   + ", height=" + height + ", toolbar=no,status=no,statusbar=no,menubar=no,scrollbars=no,resizable=no";
                        var position = ",left=" + leftpos + ", top="    + toppos;
                        var AUTH_POP = window.open('','auth_popup', winopts + position);
                        
                        auth_form.target = "auth_popup";
                    }

                    auth_form.action = "/kcpcert_enc_linux_php/SMART_ENC/smartcert_proc_req.php"; // 인증창 호출 및 결과값 리턴 페이지 주소
					auth_form.submit();
                 
                    //return true;
                
            }
			window.onload=function()
            {
               
                
              var today = new Date();
                var year  = today.getFullYear();
                var month = today.getMonth()+ 1;
                var date  = today.getDate();
                var time  = today.getTime();

                if(parseInt(month) < 10)
                {
                    month = "0" + month;
                }

                var vOrderID = year + "" + month + "" + date + "" + time;

                document.form_auth.ordr_idxx.value = vOrderID;
            }
       
          
			
//
</script>
<script src="/js/jquery.register_form.js"></script>
<script src="/js/certify.js"></script>
</head>


<body>
	<header class="header2">
		<div class="btn_back"><a href="member_login.php"></a></div>
		<div class="txt_tit">
			<p>회원가입</p>
		</div>
	</header>
	<section class="member_wrap" id="cert_info">
<!-- form name="fregisterform" method="post" action="join_db.php"  onsubmit="return fregisterform_submit(this);" -->
<form name="form_auth" method="post" action="join_db.php" >
						<input type="hidden" name="username" />
					      <input type="hidden" name="birthday" />
						  <input type="hidden" name="agecheck" />
					      <input type="hidden" name="nation" />
					      <input type="hidden" name="phoneNo" />
						<input type="hidden" name="idchk">
						<input type="hidden" name="nicchk">
						<input type="hidden" name="emailchk">
						<input type="hidden" name="hpchk">
						<input type="hidden" name="CI" value="" />
						<input type="hidden" name="userid" />
						<input type="hidden" name="cert_type" value="">
						<input type="hidden" name="cert_no" value="">
						<input type="hidden" name="ordr_idxx" class="frminput" value="" size="40" readonly="readonly" maxlength="40"/>

						<!-- 요청종류 -->
                <input type="hidden" name="req_tx"       value="cert"/>
                <!-- 요청구분 -->
                <input type="hidden" name="cert_method"  value="01"/>
                <!-- 웹사이트아이디 -->
                <input type="hidden" name="web_siteid"   value=""/> 
                <!-- 노출 통신사 default 처리시 아래의 주석을 해제하고 사용하십시요 
                     SKT : SKT , KT : KTF , LGU+ : LGT
                <input type="hidden" name="fix_commid"      value="KTF"/>
                -->
                <!-- 사이트코드 -->
                <input type="hidden" name="site_cd"      value="<?= $site_cd ?>" />               
                <!-- Ret_URL : 인증결과 리턴 페이지 ( 가맹점 URL 로 설정해 주셔야 합니다. ) -->
                <input type="hidden" name="Ret_URL"      value="http://easybusy.co.kr/kcpcert_enc_linux_php/SMART_ENC/smartcert_proc_req.php" />
                <!-- cert_otp_use 필수 ( 메뉴얼 참고)
                     Y : 실명 확인 + OTP 점유 확인 , N : 실명 확인 only
                -->
                <input type="hidden" name="cert_otp_use" value="Y"/>
                <!-- cert_enc_use 필수 (고정값 : 메뉴얼 참고) -->
                <input type="hidden" name="cert_enc_use" value="Y"/>

				<!-- cert_able_yn input 비활성화 설정 -->
                <input type="hidden" name="cert_able_yn" value=""/>

                <input type="hidden" name="res_cd"       value=""/>
                <input type="hidden" name="res_msg"      value=""/>

                <!-- up_hash 검증 을 위한 필드 -->
                <input type="hidden" name="veri_up_hash" value=""/>

                <!-- web_siteid 을 위한 필드 -->
                <input type="hidden" name="web_siteid_hashYN" value="Y"/>

                <!-- 가맹점 사용 필드 (인증완료시 리턴)-->
                <input type="hidden" name="param_opt_1"  value="opt1"/> 
                <input type="hidden" name="param_opt_2"  value="opt2"/> 
                <input type="hidden" name="param_opt_3"  value="opt3"/> 
						 
               
					
		<ul class="input_wrap">
			<!-- <li>
				<div class="btn1">
					<button type="button" id="btn_submit" onclick="auth_type_check();" class="btn1 btn-color" accesskey="s" style="border-radius: 8px;background-color: crimson;border: none;    color: white;    padding: 15px 32px;text-align: center;    text-decoration: none;    display: inline-block;    font-size: 16px;cursor:pointer;">휴대폰 본인인증</button>
					
					
				</div>
			</li> -->
			
			<li>
				<p class="tit_txt">● 만19세 이상만 회원가입이 가능합니다. </p>
				
			</li>
			<li>
				<p class="tit_txt">● 이메일(아이디) <span>(비밀번호 찾기 시 이메일 확인을 위해 필요합니다.)</span></p>
				<div class="input">
					<input type="email" name="mb_email" placeholder="이메일 입력" id="reg_mb_email" >
					
				</div>
			</li>
			<li>
				<p class="tit_txt">● 비밀번호</p>
				<div class="input">
					<input type="password" name="mb_password" placeholder="4자 이상 숫자, 영문 입력">
				</div>
				<div class="input">
					<input type="password" name="mb_password_re" placeholder="비밀번호 확인 입력">
				</div>
			</li>
			
			
			<li>
				<p class="tit_txt">● 이름 </p>
				<div class="input">
					<input type="name"  id="reg_mb_name" name="mb_name"  placeholder="이름">
					
				</div>
			</li>				
			<li>
				<p class="tit_txt">● 휴대폰번호 <span>(경품당첨시 핸드폰 번호로 쿠폰이 발송됩니다.)</span> </p>
				<div class="input">
					<input type="tel"  name="mb_hp" id="reg_mb_hp" placeholder="휴대폰번호">
					
				</div>
			</li>			
			<li>
				<p class="tit_txt">● 닉네임 <span>(3~30자 이내, 공백불가능, 한글/숫자/영문 가능)</span></p>
				<div class="input">
					<input type="text"   name="mb_nick" placeholder="닉네임 입력" id="reg_mb_nick">
					
				</div>
			</li>
			
			
			<li>
				<div class="input check">
					<p><input type="checkbox" name="c0" id="c1_0"  onclick="all_check();"><label for="c1_0"> 전체동의</label></p>
					
				</div>
				<div class="input check">
					<p><input type="checkbox" name="c1" id="c1_1"><label for="c1_1"> 이지비지 서비스 이용약관에 동의</label></p>
					<a href="/provision.php" target="_blank">내용보기</a>
				</div>
				<div class="input check">
					<p><input type="checkbox" name="c2" id="c1_2"><label for="c1_2"> 위치기반 서비스 이용약관에 동의</label></p>
					<a href="/provision_loc.php" target="_blank">내용보기</a>
				</div>
				<div class="input check">
					<p><input type="checkbox" name="c3" id="c1_3"><label for="c1_3"> 개인정보 수집 및 이용에 동의</label></p>
					<a href="/private.php" target="_blank">내용보기</a>
				</div>
				<div class="input check">
					<p><input type="checkbox" name="c4" id="c1_4"><label for="c1_4"> 개인정보 제3자 이용에 동의</label></p>
					<a href="/private3.php" target="_blank">내용보기</a>
				</div>
			</li>
			<li>

				<div class="input check">
					<input type="checkbox" name="mb_mailling" id="mb_mailling" value="1" ><label for="c1_1"> 메일링서비스(정보 메일을 받겠습니다.) </label>
					
				</div>
				<div class="input check">
					<input type="checkbox" name="mb_sms" id="mb_sms" value="1" ><label for="c1_2"> SMS수신동의(휴대폰 문자메세지를 받겠습니다.)</label>
					
				</div>
				
			</li>
		</ul>
	

	
		<div class="btn1">
			<button type="button" id="btn_submit" onclick="fregisterform_submit();" class="btn1 btn-color" accesskey="s" style="border-radius: 8px;background-color: crimson;border: none;    color: white;    padding: 15px 32px;text-align: center;    text-decoration: none;    display: inline-block;    font-size: 16px;cursor:pointer;">회원가입</button>
			<button type="button" id="btn_cancel" class="btn1 btn-color" accesskey="s" style="border-radius: 8px;background-color: black;border: none;    color: white;    padding: 15px 32px;text-align: center;    text-decoration: none;    display: inline-block;    font-size: 16px;cursor:pointer;" onclick="location.href='/'">취소</button>
		</div>
</form>
	</section>
<iframe name="FrmHid" id="FrmHid" src="" width=0 height=0></iframe>	
<script>
function go_cert()
{
if(!cert_confirm())
	return false;
else
	certify_win_open("kcp-hp", "http://easybusy.co.kr/plugin/kcpcert/kcpcert_form.php");
}
function all_check() {
    f = document.form_auth;

    if (f.c0.checked == true) {
        f.c1.checked = true;
        f.c2.checked = true;
		f.c3.checked = true;
		f.c4.checked = true;
		f.mb_mailling.checked = true;
		f.mb_sms.checked = true;
		
    }
    else {
        f.c1.checked = false;
        f.c2.checked = false;
		f.c3.checked = false;
		f.c4.checked = false;
 		f.mb_mailling.checked = false;
		f.mb_sms.checked = false;
   }

}
</script>

<iframe id="kcp_cert" name="kcp_cert" width="100%" height="700" frameborder="0" scrolling="no" style="display:none"></iframe>
</body>
</html>