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
function delete_ok(nid,b)
{
	if(confirm("삭제 후 복구가 불가능합니다.\n글을 삭제하시겠습니까?"))
	{
	document.del_f.wr_id.value = nid;
	document.del_f.b.value = b;
	document.del_f.submit();
	}
}
</script>

</head>
<body>

<?
include_once('./_common.php');


if (!$is_member) {
	echo "<script>alert('로그인이 필요합니다.');location.href='member_login.php';</script>";
	exit;
}
$sql = "select name   from t_comp where id=$com_id";
$comp = sql_fetch($sql);

if($page<1)
	$page = 1;
$rows = 10;
$start = ($page-1)*$rows;


$sql = "select * from g5_write_public where wr_is_comment=0 and wr_1='".$com_id."'  order by wr_id desc  limit $start, $rows";

$res = sql_query($sql);
?>
<? include_once('./header.php');?>
<header class="header2">
		<div class="btn_back"><a href="shop_detail.php?id=<?=$com_id?>"></a></div>
		<div class="txt_tit">
			<p>방문후기 - <?=$comp[name]?></p>
		</div>
	</header>
	<section class="board_list" style="margin-bottom:80px;">
		<ul id="listbody">
	<?php

	while($row = sql_fetch_array($res))
	{
		if($row[wr_comment]>0)
			$com_st = "  <font size='2' color='red'>".$row[wr_comment]."</font>";
		else
			$com_st = "";
		$is_lock = "";
		if(strpos($row[wr_option],"secret")!==false)
		{
			$is_lock = "<img src='/skin/board/ally/img/icon_secret.gif'>";
		}
	?>
			<li>
				<a href="shop_board_detail.php?com_id=<?=$com_id?>&bo_table=<?=$bo_table?>&wr_id=<?=$row[wr_id]?>&page=1">
					<!-- div class="d1"><img src="images/temp_c1.jpg" alt=""></div-->
					<dl>
						<dt><?=$is_lock?><?=$row[wr_subject].$com_st?></dt>
						<dd>
							<p>조회수 <?=$row[wr_hit]?></p>
						</dd>
						
					</dl>
				</a>
			</li>
	<? } ?>

		</ul>
			
		<div class="btn_more"  id="lastlist"><a href="javascript:addlist('<?=$bo_table?>');">더보기</a></div>
		<? if((($bo_table=='qa' || $bo_table=='public') && $member[mb_level]>1) || ($member[mb_level]>9)) { ?>
		<div class="btn_wrap_btm"><a href="shop_board_write.php?bo_table=<?=$bo_table?>&com_id=<?=$com_id?>">글쓰기</a></div>
		<? } ?>
	</section>
<form name="del_f" method="post" charset="utf-8" action="delete_notice_ok.php" >
<input type="hidden" name="wr_id" >
<input type="hidden" name="b">
</form>

<script> 
  var listcount=0; 

  function addlist(ch){ 
        listcount+=10; 
        $.post("/shop_board_list_get.php",{"count" : listcount,"bo_table" : ch,"com_id" : <?=$com_id?>},function(data){ 
              var oldlist =  $("#listbody").html(); 
              if(trim(data) != "0")
				$("#listbody").html(oldlist+data); 
			else
				$("#lastlist").html("<a href='javascript:addlist();'>마지막 목록입니다.</a>"); 
			
        });	
  } 
  
  function trim(str)
	{
		return str.replace(/^\s*|\s*$/g,"");
	}
</script> 
<script type="text/javascript">
	function ch(ch)
	{
		location.href = "board_list.php?bo_table="+ch;
	}
</script>
</body>
</html>