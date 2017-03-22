<?php
include_once('./_common.php');

if (!$is_member) {
//	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}

if($member[mb_level]<10)
{
//	echo "<script>alert('이미지를 삭제할 권한이 없습니다.');history.back();</script>";
	exit;
}

if($img_index == "1")
	$sql = "update t_comp set img0='',img1=''  where id='".$id."'";
else if($img_index == "2")
	$sql = "update t_comp set img2=''  where id='".$id."'";	
else if($img_index == "3")
	$sql = "update t_comp set img3=''  where id='".$id."'";	
else if($img_index == "4")
	$sql = "update t_comp set img4=''  where id='".$id."'";	
else if($img_index == "5")
	$sql = "update t_comp set img5=''  where id='".$id."'";	
else if($img_index == "6")
	$sql = "update t_comp set img6=''  where id='".$id."'";	
else
	$sql = "";
sql_query($sql);


?>