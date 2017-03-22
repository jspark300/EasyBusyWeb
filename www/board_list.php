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

if($page<1)
	$page = 1;
$rows = 10;
$start = ($page-1)*$rows;

if($bo_table == "")
	$bo_table = "notice";
$sql = "select * from g5_write_".$bo_table." where wr_is_comment=0  order by wr_id desc  limit $start, $rows";

$res = sql_query($sql);
?>
<? include_once('./header.php');?>
	<section class="search">
		<div class="tab_wrap">
			<ul class="u4">
				<li><a href="javascript:ch('notice');" <?if($bo_table=="notice") echo "class='on'"; ?> >공지사항</a></li>
				<li><a href="javascript:ch('free');" <?if($bo_table=="free") echo "class='on'"; ?> >자유글</a></li>
				<li><a href="javascript:ch('qa');" <?if($bo_table=="qa") echo "class='on'"; ?> >질문답변</a></li>
				<li><a href="javascript:ch('guide');" <?if($bo_table=="guide") echo "class='on'"; ?> >이용안내</a></li>
				<li><a href="javascript:ch('public');" <?if($bo_table=="public") echo "class='on'"; ?> >방문후기</a></li>
			</ul>
		</div>
	</section>
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
				<a href="board_detail.php?bo_table=<?=$bo_table?>&wr_id=<?=$row[wr_id]?>&page=1">
					<!-- div class="d1"><img src="images/temp_c1.jpg" alt=""></div-->
					<dl>
				<?
			 if($row[wr_1] != "")
			 {
				$sql = "select name   from t_comp where id=".$row[wr_1]."";
				$comp = sql_fetch($sql);
			 
			 ?>
				
				<dt>[<?=$comp['name']?>] <?=$is_lock?><?=$row[wr_subject].$com_st?></dt>
			<? } else {?>
				<dt><?=$is_lock?><?=$row[wr_subject].$com_st?></dt>
			<? }?>	
					
						
						<dd>
							<p>조회수 <?=$row[wr_hit]?></p>
						</dd>
						
					</dl>
				</a>
			</li>
	<? } ?>

		</ul>
			
		<div class="btn_more"  id="lastlist"><a href="javascript:addlist('<?=$bo_table?>');">더보기</a></div>
		<? if((($bo_table=='qa' || $bo_table=='public' || $bo_table=='free') && $member[mb_level]>1) || ($member[mb_level]>9)) { ?>
		<div class="btn_wrap_btm"><a href="board_write.php?bo_table=<?=$bo_table?>">글쓰기</a></div>
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
        $.post("/board_list_get.php",{"count" : listcount,"bo_table" : ch},function(data){ 
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