<?php
include_once('./_common.php');

if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

if($member[mb_level]<10)
{
	echo "<script>alert('이미지를 삭제할 권한이 없습니다.');history.back();</script>";
	exit;
}

$sql = "update t_comp set img_id='', img0='',img1='',img2='',img3='',img4='',img5=''  where id='".$id."'";
sql_query($sql);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
echo "<script>alert('이미지를 삭제하였습니다.'); location.href = '/shop_detail.php?id=".$id."&c1=".$c1."&c2=".$c2."&lc=".$lc."&sc=".$sc."&t=".time()."';</script>";

?>