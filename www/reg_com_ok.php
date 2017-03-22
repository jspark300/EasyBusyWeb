<?php
include_once('./_common.php');


if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

function make_thumbnail($source_path, $width, $height, $thumbnail_path){
    list($img_width,$img_height, $type) = getimagesize($source_path);
    if ($type!=1 && $type!=2 && $type!=3 && $type!=15) return;
    if ($type==1) $img_sour = imagecreatefromgif($source_path);
    else if ($type==2 ) $img_sour = imagecreatefromjpeg($source_path);
    else if ($type==3 ) $img_sour = imagecreatefrompng($source_path);
    else if ($type==15) $img_sour = imagecreatefromwbmp($source_path);
    if ($img_width > $img_height) {
        $w = round($height*$img_width/$img_height);
        $h = $height;
        $x_last = round(($w-$width)/2);
        $y_last = 0;
    } else {
        $w = $width;
        $h = round($width*$img_height/$img_width);
        $x_last = 0;
        $y_last = round(($h-$height)/2);
    }
    if ($img_width < $width && $img_height < $height) {
        $img_last = imagecreatetruecolor($width, $height); 
        $x_last = round(($width - $img_width)/2);
        $y_last = round(($height - $img_height)/2);

        imagecopy($img_last,$img_sour,$x_last,$y_last,0,0,$w,$h);
        imagedestroy($img_sour);
        $white = imagecolorallocate($img_last,255,255,255);
        imagefill($img_last, 0, 0, $white);
    } else {
        $img_dest = imagecreatetruecolor($w,$h); 
        imagecopyresampled($img_dest, $img_sour,0,0,0,0,$w,$h,$img_width,$img_height); 
        $img_last = imagecreatetruecolor($width,$height); 
        imagecopy($img_last,$img_dest,0,0,$x_last,$y_last,$w,$h);
        imagedestroy($img_dest);
    }
    if ($thumbnail_path) {
		imagejpeg($img_last, $thumbnail_path, 100);
     //   if ($type==1) imagegif($img_last, $thumbnail_path, 100);
     //   else if ($type==2 ) imagejpeg($img_last, $thumbnail_path, 100);
     //   else if ($type==3 ) imagepng($img_last, $thumbnail_path, 100);
     //   else if ($type==15) imagebmp($img_last, $thumbnail_path, 100);
    } else {
        if ($type==1) imagegif($img_last);
        else if ($type==2 ) imagejpeg($img_last);
        else if ($type==3 ) imagepng($img_last);
        else if ($type==15) imagebmp($img_last);
    }
    imagedestroy($img_last);
}

$mb_id = $member['mb_id'];

// 좌표 찾기
	$query = urlencode($sido.$gugun.$dong.$bungi);
	$url = "http://openapi.map.naver.com/api/geocode?key=4656599e5f320c8f90d2a7454368cfea&encoding=utf-8&coord=latlng&output=xml&query=".$query;
//	echo $url;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
 
    // execute and return string (this should be an empty string '')
    $str = curl_exec($curl);
	
    curl_close($curl);
	$xml = simplexml_load_string($str); 

	$total_count = $xml->result->total;
	
	$x = $xml->result->items->item->point->x;
	$y = $xml->result->items->item->point->y;

$y = $lat;
$x = $lng;



$shop_img_dir = G5_DATA_PATH.'/shop';
if($it_id == "")
	$it_id = time().rand(0,9999);
$itname_id = time().rand(0,9999);
// 이미지업로드
if ($_FILES['img1']['name']) {
   $it_img1 = it_img_upload($_FILES['img1']['tmp_name'],   $_FILES['img1']['name'],$shop_img_dir.'/'.$it_id);
	$it_img1 = basename($it_img1);
	
	make_thumbnail($shop_img_dir.'/'.$it_id.'/'.$it_img1,100*2,75*2,$shop_img_dir.'/'.$it_id.'/'.$itname_id.'0.jpg');
	$it_img0 = $itname_id."0.jpg";

	make_thumbnail($shop_img_dir.'/'.$it_id.'/'.$it_img1,400,300,$shop_img_dir.'/'.$it_id.'/'.$itname_id.'1.jpg');
	$it_img1 = $itname_id."1.jpg";

}
if ($_FILES['img2']['name']) {
    $it_img2 = it_img_upload($_FILES['img2']['tmp_name'],  $_FILES['img2']['name'],$shop_img_dir.'/'.$it_id);
	$it_img2 = basename($it_img2);
	make_thumbnail($shop_img_dir.'/'.$it_id.'/'.$it_img2,400,300,$shop_img_dir.'/'.$it_id.'/'.$itname_id.'2.jpg');
	$it_img2 = $itname_id."2.jpg";
}
if ($_FILES['img3']['name']) {
    $it_img3 = it_img_upload($_FILES['img3']['tmp_name'],  $_FILES['img3']['name'],$shop_img_dir.'/'.$it_id);
	$it_img3 = basename($it_img3);
	make_thumbnail($shop_img_dir.'/'.$it_id.'/'.$it_img3,400,300,$shop_img_dir.'/'.$it_id.'/'.$itname_id.'3.jpg');
	$it_img3 = $itname_id."3.jpg";
}
if ($_FILES['img4']['name']) {
    $it_img4 = it_img_upload($_FILES['img4']['tmp_name'],  $_FILES['img4']['name'],$shop_img_dir.'/'.$it_id);
	$it_img4 = basename($it_img4);
	make_thumbnail($shop_img_dir.'/'.$it_id.'/'.$it_img4,400,300,$shop_img_dir.'/'.$it_id.'/'.$itname_id.'4.jpg');
	$it_img4 = $itname_id."4.jpg";
}
if ($_FILES['img5']['name']) {
    $it_img5 = it_img_upload($_FILES['img5']['tmp_name'],  $_FILES['img5']['name'],$shop_img_dir.'/'.$it_id);
	$it_img5 = basename($it_img5);
	make_thumbnail($shop_img_dir.'/'.$it_id.'/'.$it_img5,400,300,$shop_img_dir.'/'.$it_id.'/'.$itname_id.'5.jpg');
	$it_img5 = $itname_id."5.jpg";
}
if ($_FILES['img6']['name']) {
    $it_img6 = it_img_upload($_FILES['img6']['tmp_name'],  $_FILES['img6']['name'],$shop_img_dir.'/'.$it_id."_");
	$it_img6 = basename($it_img6);
//	make_thumbnail($shop_img_dir.'/'.$it_id.'/'.$it_img5,400,300,$shop_img_dir.'/'.$it_id.'/5.jpg');
	//$it_img6 = "6.jpg";
}
if($pop1!="" && $pop2!="")
{
	$sql = "select seq from b_region_pop where reg1='".$pop1."' and reg2='".$pop2."'";
	$rs = sql_fetch($sql);
	$pop = $rs[seq];
}
if($sub1!="" && $sub2!="" && $sub3!="")
{
	$sql = "select seq from b_region_sub where reg1='".$sub1."' and reg2='".$sub2."' and reg3='".$sub3."'";
	$rs = sql_fetch($sql);
	$sub = $rs[seq];
}
$holiday = $holiday1." ".$holiday2;

if($id == "")
{
$t = date("Ymdh");
$t = time();
$sql = "insert into t_comp set name='".$company."',
							comp_id='',
							addr_s='".$sido." ". $gugun." ". $dong." ". $bungi."',
							phone='".$tel1."-". $tel2."-". $tel3."',
							img_id= '".$it_id."',
							img0= '".$it_img0."',
							img1= '".$it_img1."',
							img2= '".$it_img2."',
							img3= '".$it_img3."',
							img4= '".$it_img4."',
							img5= '".$it_img5."',
							img6= '".$it_img6."',
							lat='".$y."',
							lon='".$x."',
							cate='".$sel1."',
							cate_sub='".$sel2."',
							pop1='".$pop1."',
							pop2='".$pop2."',
							sub1='".$sub1."',
							sub2='".$sub2."',
							sub3='".$sub3."',
							pop='".$pop."',
							sub='".$sub."',
							business_hour='".$business_hour."',
							sdate='".$sdate."',
							edate='".$edate."',
							holiday='".$holiday."',
							businessno='".$businessno."',
							homepage='".$homepage."',
							ceo='".$ceo."',
							description='".$description."',
							reg_date='".$t."',
							modify_date='".$t."',
							own_id='".$mb_id."',
							reg_id='".$mb_id."',
							nation='".$config[cf_nation]."'";
	sql_query($sql);
	$com_id = sql_insert_id();
	// 회원정보에 포인트 +1
	$sql = "update g5_member set give_point=give_point+1 where mb_id='$mb_id'";
	sql_query($sql);


}
else
{
$wh = "";
if($it_img1 != "")
{
	$wh .= "img0= '".$it_img0."',";
	$wh .= "img1= '".$it_img1."',";
}
if($it_img2 != "")
	$wh .= "img2= '".$it_img2."',";
if($it_img3 != "")
	$wh .= "img3= '".$it_img3."',";
if($it_img4 != "")
	$wh .= "img4= '".$it_img4."',";
if($it_img5 != "")
	$wh .= "img5= '".$it_img5."',";
if($it_img6 != "")
	$wh .= "img6= '".$it_img6."',";
$t = date("Ymdh");
$t = time();

$sql = "update t_comp set name='".$company."',
							comp_id='',
							addr_s='".$sido." ". $gugun." ". $dong." ". $bungi."',
							phone='".$tel1."-". $tel2."-". $tel3."',
							img_id= '".$it_id."',
							".$wh."
							lat='".$y."',
							lon='".$x."',
							cate='".$sel1."',
							cate_sub='".$sel2."',
							pop1='".$pop1."',
							pop2='".$pop2."',
							sub1='".$sub1."',
							sub2='".$sub2."',
							sub3='".$sub3."',
							pop='".$pop."',
							sub='".$sub."',
							business_hour='".$business_hour."',
							sdate='".$sdate."',
							edate='".$edate."',
							holiday='".$holiday."',
							businessno='".$businessno."',
							ceo='".$ceo."',
							description='".$description."',
							homepage='".$homepage."',
							modify_date='".$t."',
							mod_id='".$mb_id."'
							where id='".$id."'
							";
							//echo $sql;
sql_query($sql);

}
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
if($id == "")
{
	echo "<script>alert('업체를 등록해주셔서 감사합니다.\\n경품응모권1장이 지급되었습니다.'); location.href = '/shop_detail.php?id=".$com_id."&c1=".$c1."&c2=".$c2."';</script>";
}
else
{
	echo "<script>alert('업체를 수정해주셔서 감사합니다.'); location.href = '/shop_detail.php?id=".$id."&c1=".$c1."&c2=".$c2."&t=$t';</script>";
}
?>