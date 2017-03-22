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
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
        <meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, target-densitydpi=medium-dpi" >
        <title>*** KCP Online Certification System [PHP Version] ***</title>
        <link href="../css/sample.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">

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
                        response_data += frm.elements[i].name + " : " + frm.elements[i].value + "\n";
                    }
                }
                
                if( navigator.userAgent.indexOf("Android") > - 1 || navigator.userAgent.indexOf("iPhone") > - 1 )
                {
                    document.getElementById( "cert_info" ).style.display = "";
                    document.getElementById( "kcp_cert"  ).style.display = "none";
                }
                    
                alert(response_data);
            }
            
            // 인증창 호출 함수
            function auth_type_check()
            {
                var auth_form = document.form_auth;

                if( auth_form.ordr_idxx.value == "" )
                {
                    alert( "주문번호는 필수 입니다." );

                    return false;
                }
                else
                {
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

                    auth_form.action = "./smartcert_proc_req.php"; // 인증창 호출 및 결과값 리턴 페이지 주소
                    
                    return true;
                }
            }

            /* 예제 */
            window.onload=function()
            {
                
                init_orderid(); // 주문번호 샘플 생성
            }

            // 주문번호 생성 예제 ( up_hash 생성시 필요 ) 
            function init_orderid()
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

        </script>
    </head>
    <body oncontextmenu="return false;" ondragstart="return false;" onselectstart="return false;">
        <div align="center" id="cert_info">
            <form name="form_auth" method="post">
                <table width="589" cellpadding="0" cellspacing="0">
                    <tr style="height:14px"><td style="background-image:url('../img/boxtop589.gif');"></td></tr>
                    <tr>
                        <td style="background-image:url('../img/boxbg589.gif')">
        
                            <!-- 상단 테이블 Start -->
                            <table width="551px" align="center" cellspacing="0" cellpadding="16">
                                <tr style="height:17px">
                                    <td style="background-image:url('../img/ttbg551.gif');border:0px " class="white">
                                        <span class="bold big">[인증요청]</span> 이 페이지는 휴대폰 인증요청 페이지입니다.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-image:url('../img/boxbg551.gif') ;">
                                        <p class="align_left">소스 수정 시 가맹점의 상황에 맞게 적절히 수정 적용하시길 바랍니다.</p>
                                        <p class="align_left">결제에 필요한 정보를 정확하게 입력하시어 인증를 진행하시기 바랍니다.</p>
                                    </td>
                                </tr>
                                <tr style="height:11px"><td style="background:url('../img/boxbtm551.gif') no-repeat;"></td></tr>
                            </table>
                            <!-- 상단 테이블 End -->
        
                            <!-- 주문 정보 출력 테이블 Start -->
                            <table width="527" align="center" cellspacing="0" cellpadding="0" class="margin_top_20">
                                <tr><td colspan="2"  class="title">인 증 정 보</td></tr>
                                <!-- 주문번호(ordr_idxx) -->
                                <tr>
                                    <td class="sub_title1">주문 번호</td>
                                    <td class="sub_input1">&nbsp&nbsp<input type="hidden" name="ordr_idxx" class="frminput" value="" size="40" readonly="readonly" maxlength="40"/></td>
                                </tr>
                                
        
                                <tr class="height_1px"><td colspan="2" bgcolor="#0f75ac"></td></tr>
                            </table>
                            <!-- 주문 정보 출력 테이블 End -->
        
                            <!-- 결제 버튼 테이블 Start -->
                            <table width="527" align="center" cellspacing="0" cellpadding="0" class="margin_top_20">
                                <!-- 결제 요청/처음으로 이미지 버튼 -->
                                <tr id="show_pay_btn">
                                    <td colspan="2" align="center">
                                        <input type="image" src="../img/btn_certi.gif" onclick="return auth_type_check();" width="108" height="37" alt="결제를 요청합니다" />
                                    </td>
                                </tr>
                            </table>
                            <!-- 결제 버튼 테이블 End -->
                        </td>
                    </tr>
                    <tr><td><img src="../img/boxbtm589.gif" alt="Copyright(c) KCP Inc. All rights reserved."/></td></tr>
                </table>
        
                <!-- 요청종류 -->
                <input type="hidden" name="req_tx"       value="cert"/>
                <!-- 요청구분 -->
                <input type="hidden" name="cert_method"  value="01"/>
                <!-- 웹사이트아이디 -->
                <input type="hidden" name="web_siteid"   value="easybusy"/> 
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
            </form>
        </div>
        <iframe id="kcp_cert" name="kcp_cert" width="100%" height="700" frameborder="0" scrolling="no" style="display:none"></iframe>
    </body>
</html>