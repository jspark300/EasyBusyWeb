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
	document.del_f.id.value = nid;
	document.del_f.b.value = b;
	document.del_f.submit();
	}
}
</script>

</head>
<body>

<?
include_once('./_common.php');

if($page<1)
	$page = 1;
$rows = 10;
$start = ($page-1)*$rows;
$sql = "select * from g5_write_notice where wr_is_comment=0  order by wr_id desc  limit $start, $rows";

$res = sql_query($sql);
?>

<? include_once('./header.php');?>
	<section class="search">
		<div class="tab_wrap">
			<ul class="u3">
				<li><a href="javascript:ch(1);" class="on">공지</a></li>
				<li><a href="javascript:ch(2);">문의</a></li>
				<li><a href="javascript:ch(3);">안내</a></li>
				<li><a href="javascript:ch(4);">홍보</a></li>
			</ul>
		</div>
	</section>
	<section class="board_list">
		<ul>
	<?php

	while($row = sql_fetch_array($res))
	{

	?>
			<li>
				<a href="board_detail.php?id=<?=$row[wr_id]?>">
					<!-- div class="d1"><img src="images/temp_c1.jpg" alt=""></div-->
					<dl>
						<dt><?=$row[wr_subject]?></dt>
						<dd>
							<p>조회수 : <?=$row[wr_hit]?></p>
						</dd>
						
					</dl>
				</a>
			</li>
	<? } ?>

		</ul>
			
		<div class="btn_more"  id="lastlist"><a href="javascript:addlist();">더보기</a></div>
		<? if($member[mb_level]>9) { ?>
		<div class="btn_wrap_btm"><a href="write_notice.php">글쓰기</a></div>
		<? } ?>
	</section>
<form name="del_f" method="post" charset="utf-8" action="delete_notice_ok.php" >
<input type="hidden" name="id" >
<input type="hidden" name="b">
</form>

<script> 
  var listcount=0; 

  function addlist(){ 
        listcount+=10; 
        $.post("/get_notice.php",{"count" : listcount},function(data){ 
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
	function ch(i)
	{
		if(i==1)
			location.href = "mynotice.php";
		else if(i==2)
			location.href = "myfree.php";
		else
			location.href = "myqna.php";
	}
		</script>
</body>
</html>