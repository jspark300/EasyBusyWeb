<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

// 당첨 검색
//$sql = "select id   from t_give where coupon='$coupon' and status=3 and lot_mb_no!=$member[mb_no]";
$sql = "select *,date_add(str_to_date(end_date,'%Y%m%d'), INTERVAL 31 DAY) va_date   from t_give where id=$id and lot_mb_no=$member[mb_no]  and status=1";
$give = sql_fetch($sql);
if(!$give)
{
	echo "<script>alert('당첨된 경품이 존재하지않습니다. 다시 시도해 주세요.');history.back();</script>";
	exit;
}
$price = number_format($give[price]);
if($sale_price > $give[price])
{
	echo "<script>alert('판매가격은 ".$price."원 이상으로 판매할 수 없습니다');history.back();</script>";
	exit;
}

// 경품몰에 아이템 등록//
$pt_num = time();
$it_id = $give[img_id]; // 경품 이미지 id 를 아이템 아이디로 사용
$sql = "select ca_id from b_menu where m1=$give[cate] and m2=$give[cate_sub] ";
$res = sql_fetch($sql);
$ca_id = substr($res[ca_id],0,2);
$ca_id2 = substr($res[ca_id],0,4);
$ca_id3 = substr($res[ca_id],0,6);
//echo $cat1."/".$cat2."/".$cat3;

$sql = "select name,addr_s from t_comp where id=$give[com_id]";
$com = sql_fetch($sql);

$it_name = $give[name];
$it_maker = $com[name];
$it_price = $sale_price;
$it_stock_qty = 1;
$it_use = 1;
$it_img1 = $give[img_id]."/".$give[img1];

$sql_common = " ca_id               = '$ca_id',
                ca_id2              = '$ca_id2',
                ca_id3              = '$ca_id3',
                it_name             = '$it_name',
                it_maker            = '$it_maker',
                it_origin           = '$it_origin',
                it_brand            = '$it_brand',
                it_model            = '$it_model',
                it_option_subject   = '$it_option_subject',
                it_supply_subject   = '$it_supply_subject',
				it_basic            = '$it_basic',
                it_explan           = '$it_explan',
                it_explan2          = '".strip_tags(trim($_POST['it_explan']))."',
                it_mobile_explan    = '$it_mobile_explan',
                it_price            = '$it_price',
                it_cust_price            = '$it_cust_price',
				it_point            = '$it_point',
                it_point_type       = '$it_point_type',
                it_supply_point     = '$it_supply_point',
                it_notax            = '$it_notax',
				it_sell_email       = '$it_sell_email',
                it_use              = '$it_use',
                it_soldout          = '$it_soldout',
                it_stock_qty        = '$it_stock_qty',
                it_noti_qty         = '$it_noti_qty',
                it_sc_type          = '$it_sc_type',
                it_sc_method        = '$it_sc_method',
                it_sc_price         = '$it_sc_price',
                it_sc_minimum       = '$it_sc_minimum',
                it_sc_qty           = '$it_sc_qty',
                it_buy_min_qty      = '$it_buy_min_qty',
                it_buy_max_qty      = '$it_buy_max_qty',
                it_ip               = '{$_SERVER['REMOTE_ADDR']}',
                it_info_gubun       = '$it_info_gubun',
                it_info_value       = '$it_info_value',
                it_img1             = '$it_img1',
                it_img2             = '$it_img2',
                it_img3             = '$it_img3',
                it_img4             = '$it_img4',
                it_img5             = '$it_img5',
                it_img6             = '$it_img6',
                it_img7             = '$it_img7',
                it_img8             = '$it_img8',
                it_img9             = '$it_img9',
                it_img10            = '$it_img10',
                it_1_subj           = '$it_1_subj',
                it_2_subj           = '$it_2_subj',
                it_3_subj           = '$it_3_subj',
                it_4_subj           = '$it_4_subj',
                it_5_subj           = '$it_5_subj',
                it_6_subj           = '$it_6_subj',
                it_7_subj           = '$it_7_subj',
                it_8_subj           = '$it_8_subj',
                it_9_subj           = '$it_9_subj',
                it_10_subj          = '$it_10_subj',
                it_1                = '$it_1',
                it_2                = '$it_2',
                it_3                = '$it_3',
                it_4                = '$it_4',
                it_5                = '$it_5',
                it_6                = '$it_6',
                it_7                = '$it_7',
                it_8                = '$it_8',
                it_9                = '$it_9',
                it_10               = '$it_10',
				$admin_sql
				pt_it				= '1',
                pt_img				= '$pt_img',
                pt_ccl				= '$pt_ccl',
				pt_order			= '$pt_order',
				pt_show				= '$pt_show',
				pt_tag				= '$pt_tag',
                pt_link1			= '$pt_link1',
                pt_link2			= '$pt_link2',
				$pt_review_sql
				$pt_comment_sql
				pt_day				= '$pt_day',
				pt_end				= '$pt_end',
				pt_reserve			= '$pt_reserve',
				pt_reserve_use		= '$pt_reserve_use',
				$pt_syndi_sql
				pt_explan	        = '$pt_explan',
                pt_mobile_explan    = '$pt_mobile_explan',
				pt_msg1			    = '$pt_msg1',
                pt_msg2			    = '$pt_msg2',
                pt_msg3			    = '$pt_msg3'
				";


if($w == "") // 아이템 등록
{
    if (!trim($it_id)) {
        alert('코드가 없으므로 추가하실 수 없습니다.');
    }

    $t_it_id = preg_replace("/[A-Za-z0-9\-_]/", "", $it_id);
    if($t_it_id)
        alert('코드는 영문자, 숫자, -, _ 만 사용할 수 있습니다.');
	$it_time = date('Y-m-d H:i:s',$pt_num);
	$sql_common .= ", pt_id='".$member['mb_id']."' "; // 파트너 아이디 등록
	$sql_common .= ", it_time = '".$it_time."' ";
	$sql_common .= ", it_update_time = '".$it_time."' ";
	$sql = " insert g5_shop_item
				set it_id = '$it_id',
					pt_num = '$pt_num',
					$sql_common ";
	sql_query($sql);
//	echo $sql;
}
else if($w == "u") // 아이템 수정
{
 	$it_time = date('Y-m-d H:i:s', $pt_num);
    $sql_common .= " , it_update_time = '".$it_time."' ";
    $sql = " update g5_shop_item
                set $sql_common
              where it_id = '$it_id' ";
    sql_query($sql);
}

// 경품 상태 변경 status = 4 

$give_id = $give[id];
$va_date = str_replace("-","",$give[va_date]);
// 경품몰 팔기 선택 status 4 업데이트
$t = time();
$sql = "update t_give set status = 4, seller=$member[mb_no],sell_date=$t,discount_price=$sale_price, valid_date=$va_date  where id=$id and status=1";
sql_query($sql);
$sql = "update t_give_enter set status = 4 where give_id=$id and mb_no=$member[mb_no] and status=1";
sql_query($sql);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('경품몰에 등록하였습니다.'); location.href = '/shop/';</script>";

?>