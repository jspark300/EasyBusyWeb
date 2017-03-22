<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');


if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}


// 당첨 검색
$sql = "select count(id) c   from t_give_enter where mb_no=$member[mb_no] and give_id=$id and status=1";
$res = sql_fetch($sql);
$give_count = $res[c];
if($give_count == 0)
{
	echo "<script>alert('당첨된 경품이 없습니다.');history.back();</script>";
	exit;
}
// 사용하기 선택 status 2 업데이트
// 쿠폰 발행
$coupon = md5($id."allycoupon3x");
$coupon = substr($coupon,0,15);
$sql = "update t_give set status = 3,coupon='".$coupon ."' where id=$id and lot_mb_no=$member[mb_no] and status=1";
sql_query($sql);
$sql = "update t_give_enter set status = 3 where give_id=$id and mb_no=$member[mb_no] and status=1 ";
sql_query($sql);



$sql = "select *, date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY) last_date,  datediff(date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 8 DAY),now()) gr, date_add(now(), INTERVAL 8 DAY) gift_send_date from t_give where id=$id";
$give = sql_fetch($sql);
$sql = "select name,addr_s from t_comp where id=$give[com_id]";
$com = sql_fetch($sql);


$subject = $send_name."님께서 이지비지 서비스를 통해 경품을 선물하셨습니다.";
	
$content =	"<!doctype html>
<html lang='ko'>
<head>
<meta charset='utf-8'>
<title>회원가입 축하 메일</title>
</head>

<body>

<div style='margin:30px auto;width:600px;border:10px solid #f7f7f7'>
    <div style='border:1px solid #dedede'>
        <h1 style='padding:30px 30px 0;background:#f7f7f7;color:#555;font-size:1.4em'>
            ".$subject."<br><br>
        </h1>
        
        <p style='margin:20px 0 0;padding:30px 30px 50px;min-height:40px;height:auto !important;height:200px;border-bottom:1px solid #eee'>
            <b>".nl2br($msg)."</b>
         </p>
			<dd>	
				<p><img src='http://easybusy.co.kr/data/item/".$give[img_id]."/".$give[img1]."' alt=''></p>
				<p><span class='tit'>".$give[name]."</span> </p>
				<p>- 업체명 : ".$com[name]."</p>
				<p>- 주소 : ".$com[addr_s]."</p>
				<p>- 등록유효기간 : ".$give[gift_send_date]."</p>
				<p>- 쿠폰번호 : <strong>".$give[coupon]."</strong></p>
			</dd>
        
        <a href='http://easybusy.co.kr/mycoupon_reg.php?cp=".$give[coupon]."' target='_blank' style='display:block;padding:30px 0;margin-bottom:1px;background:#0095fd;color:#fff;text-decoration:none;text-align:center'>쿠폰등록</a>
        
        <a href='http://easybusy.co.kr' target='_blank' style='display:block;padding:30px 0;background:#0095fd;color:#fff;text-decoration:none;text-align:center'>EASYBUSY 사이트 바로가기</a>
        
    </div>
</div>

</body>
</html>		";

$content =	"<html>
    <head>
        <meta charset='UTF-8'>
        <title>세상의 모든 동맹 - EASYBUSY</title>
    </head>
    <body>
        <table style='border:0; cellpadding:0; cellspacing:0; border-collapse:collapse; border-spacing:0; width:700px;'>
            <tr>
                <td style='border:#00b6fd solid 1px; background-color:#00b6fd; text-align:center; padding:10px 0 5px 0;'>
                    <img src='http://easybusy.co.kr/images/email/logo.png'>
                </td>
            </tr>
            <tr>
                <td style='border:#00a2de solid 1px; border-top:0; border-bottom:0; padding:10px;'>
                    <div style='padding:10px; background-color:#e8e8e8;'>
                    <p style='text-size:14px; font-weight:bold; color:#000;'>".$subject."</p>
                    <p style='text-size:12px; color:#0080d3;'>".nl2br($msg)."</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td style='border:#00a2de solid 1px; border-top:0; border-bottom:0; padding:20px 20px; text-size:14px; color:#000; line-height:1.5em;'>
                    <div style='padding:10px; background-color:#008aea; color:#fff;'>
						<p  style='text-align:center;'><img src='http://easybusy.co.kr/data/item/".$give[img_id]."/".$give[img1]."' alt=''></p>
                        <p style='text-align:center; font-size:16px; font-weight:bold; border-bottom:#00b6fd solid 1px; padding-bottom:10px;'>경품명 : ".$give[name]."(".$com[name].")</p>
                        · 업체주소 : ".$com[addr_s]." <br>
                        · 등록유효기간 : ".$give[gift_send_date]."<br>
                        · 쿠폰번호 : ".$give[coupon]."
                        <p style='text-align:center; font-size:16px; font-weight:bold; background-color:#ff9933; padding:5px 0;'><a href='http://easybusy.co.kr/mycoupon_reg.php?cp=".$give[coupon]."' target='_blank' style='color:#000; text-decoration:none; display:block;'>쿠폰등록 바로가기</a></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td style='border:#00a2de solid 1px; border-top:0; border-bottom:0; padding:20px 20px; text-size:14px; color:#000;'>
                    <strong> ".$give[gift_send_date]."</strong>까지 올리올앱에 등록하지 않은 쿠폰은 자동 기부 처리 됩니다.<br><br>
                    자세한 사항은 올리올 앱에서 확인할 수 있습니다.<br>
                    
                    쿠폰은 로그인 후 쿠폰등록 메뉴에서 등록가능합니다.
                </td>
            </tr>
            <tr>
                <td style='border:#00a2de solid 1px; border-top:0; padding:0;' >
                    <img src='http://easybusy.co.kr/images/email//footer.png'>
                </td>
            </tr>         
        </table>
    </body>
</html>";



mailer($send_name, $send_email, $recv_email, $subject, $content, 1);


echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('이메일로 선물하기를 완료하였습니다.'); location.href = '/myentry_list.php?st=';</script>";

?>