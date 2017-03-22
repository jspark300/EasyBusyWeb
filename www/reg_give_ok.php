<?php
include_once('./_common.php');

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
if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$mb_id = $member['mb_id'];


$shop_img_dir = G5_DATA_PATH.'/item';
if($it_id == "")
	$it_id = time().rand(0,9999);

// 이미지업로드
if ($_FILES['img1']['name']) {
   $it_img1 = it_img_upload($_FILES['img1']['tmp_name'],   $_FILES['img1']['name'],$shop_img_dir.'/'.$it_id);
	$it_img1 = basename($it_img1);
}
$info_image=getimagesize($shop_img_dir.'/'.$it_id.'/'.$it_img1);

//$fileinfo = pathinfo($it_img1);
//$ext = $fileinfo['extension'];
//$filename =  $fileinfo['filename'];
//$it_img_ex = $filename."_.".$ext;
   
make_thumbnail($shop_img_dir.'/'.$it_id.'/'.$it_img1,111,83,$shop_img_dir.'/'.$it_id.'/'.$it_id.'.jpg');





$sql = "select cate,cate_sub   from t_comp where id=$com_id";
$res = sql_fetch($sql);
$ts = date("Ymd");
$t = time();
//if($give_start<$ts)
//{
//	echo "<script>alert('응모시작일은 오늘 이후부터 설정가능합니다.'); history.back();</script>";
//	exit;
//}
if($give_start>$give_end)
{
	echo "<script>alert('응모시작일은 응모마감일보다 이전일이어야 합니다.'); history.back();</script>";
	exit;
}
if($price<10000)
{
	echo "<script>alert('경품가격은 1만원 이상이어야 합니다.'); history.back();</script>";
	exit;
}
// 같은 com_id 기간 겹침 채크
if($give_id == "")
	$sql = "select start_date,end_date,name from t_give where com_id=$com_id and ( (start_date<=$give_start and end_date>=$give_start) or (start_date<=$give_end and end_date>=$give_end))";
else
	$sql = "select start_date,end_date,name from t_give where com_id=$com_id and id!=$give_id and ( (start_date<=$give_start and end_date>=$give_start) or (start_date<=$give_end and end_date>=$give_end))";
$rs = sql_fetch($sql);
if($rs)
{
	echo "<script>alert('응모기간에 다른 경품이 존재합니다. \\n\\n경품명 : ".$rs[name]."\\n\\n중복기간 : ".$rs[start_date]."~".$rs[end_date]."'); history.back();</script>";
	exit;
}

if($give_id != "")
{
	$sql = "select count(id) c from t_give_enter where give_id='".$give_id."'";
	$re = sql_fetch($sql);
	if($re[c]>0)
	{
		echo "<script>alert('응모자가 있습니다. 수정이 불가능합니다.');location.href = '/mygive_list.php';</script>";
		exit;
	}

}


if($give_id == "")
{
	$sql = "insert into t_give set name='".$give_name."',
								com_id='".$com_id."',
								img_id= '".$it_id."',
								img1= '".$it_img1."',
								cate='".$res[cate]."',
								cate_sub='".$res[cate_sub]."',
								description='".$description."',
								start_date='".$give_start."',
								end_date='".$give_end."',
								price='".$price."',
								reg_date='".$t."',
								modify_date='".$t."',
								reg_id='".$mb_id."'";
}
else
{
	$wh = "";
	if($it_img1 != "")
		$wh .= "img1= '".$it_img1."',";


	$sql = "update t_give set name='".$give_name."',
								com_id='".$com_id."',
								".$wh."
								cate='".$res[cate]."',
								cate_sub='".$res[cate_sub]."',
								description='".$description."',
								start_date='".$give_start."',
								end_date='".$give_end."',
								price='".$price."',
								modify_date='".$t."',
								mod_id='".$mb_id."'
								where id='".$give_id."'";


}
sql_query($sql);

if($give_start<=$ts)
{
	$sql = "update t_comp set is_giveaway = 1 where id=$com_id";
	sql_query($sql);
}
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
if($give_id == "")
{
	echo "<script>alert('등록하였습니다.'); location.href = '/mygive_list.php';</script>";
}
else
{
	echo "<script>alert('수정하였습니다.'); location.href = '/mygive_list.php';</script>";
}
?>