<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EASYBUSY</title>
	<link href="a_css/default.css" rel="stylesheet">
	<link href="a_css/common.css" rel="stylesheet">
	<script src="a_js/jquery-1.11.3.min.js"></script>
	<script src="a_js/common.js"></script>
	<link rel="stylesheet" href="a_css/swiper.min.css">
	<script src="a_js/swiper.min.js"></script>
</head>
<body>

<? include_once('./header.php');?>
<?
include_once('./_common.php');

$sql = "select * from g5_write_".$bo_table." where wr_id=$wr_id";
$view = sql_fetch($sql);

//echo "lv".$board['bo_read_level'];
    // 로그인된 회원의 권한이 설정된 읽기 권한보다 작다면
    if ($member['mb_level'] < $board['bo_read_level']) {
       alert('글을 읽을 권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보십시오.', '/member_login.php');
    }

if(strpos($view[wr_option],"secret")!==false)
{
	if($member[mb_level]<10 && $member[mb_id] != $view[mb_id])
	{
		echo "<script>alert('비밀글입니다.');history.back();</script>";
		exit;
	}
	
}

$sql = "update g5_write_".$bo_table." set wr_hit = wr_hit + 1 where wr_id=$wr_id";
sql_query($sql);

$view['file'] = get_file($bo_table,$wr_id);

?>

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
	<section class="board_detail">
		<div class="board1">
			<!--div class="d1"><img src="images/temp_c1.jpg" alt=""></div-->


		
			 <dl>
			 <?
			 if($view[wr_1] != "")
			 {
				$sql = "select name   from t_comp where id=".$view[wr_1]."";
				$comp = sql_fetch($sql);
			 
			 ?>
				<dt>[<?=$comp['name']?>] <?=$view['wr_subject']?></dt>
			<? } else {?>
				<dt><?=$view['wr_subject']?></dt>
			<? }?>
				<dd>
					<p><?=$view[wr_name]?> <?=apms_datetime(strtotime($view['wr_datetime']), 'Y.m.d');?></p>
				</dd>
			</dl>

		
		</div>
		<div class="board2">
			<!--img src="images/temp_c1.jpg" alt="" -->
<?php
		// 이미지 상단 출력
		$v_img_count = count($view['file']);
	
		//echo $v_img_count;
		if($v_img_count && $view[as_img]==0) {
			echo '<div class="view-img" style="margin-bottom:5px;">'.PHP_EOL;
			for ($i=0; $i<=count($view['file']); $i++) {
				if ($view['file'][$i]['view']) {
					echo get_view_thumbnail($view['file'][$i]['view']);
				}
			}
			echo '</div>'.PHP_EOL;
		}
	 ?>			
	<?//=nl2br($view[wr_content])?>
	<?
	$html = 0;
if (strstr($view['wr_option'], 'html1'))
    $html = 1;
else if (strstr($view['wr_option'], 'html2'))
    $html = 2;
		$view['content'] = conv_content($view['wr_content'], $html);
		$view['content'] = apms_content($view['content']);
		//$view['rich_content'] = preg_replace("/{이미지\:([0-9]+)[:]?([^}]*)}/ie", "view_image(\$view, '\\1', '\\2')", $view['content']);
		if($view['as_img'] == "2") { // 본문삽입
			function conv_rich_content($matches){
				global $view;
				return view_image($view, $matches[1], $matches[2]);
			}

			$view['content'] = preg_replace_callback("/{이미지\:([0-9]+)[:]?([^}]*)}/i", "conv_rich_content", $view['content']);
			//echo $view['content'];
		}	
	?>
<div class="view-content">
		<?php echo get_view_thumbnail($view['content']); ?>
	</div>
	
		<?php
		// 이미지 하단 출력
		if($v_img_count && $view[as_img]==1) {
			echo '<div class="view-img">'.PHP_EOL;
			for ($i=0; $i<=count($view['file']); $i++) {
				if ($view['file'][$i]['view']) {
					echo get_view_thumbnail($view['file'][$i]['view']);
				}
			}
			echo '</div>'.PHP_EOL;
		}
	?>			</div>
		<div class="btn51">
			<div class="fl">
<?if($member[mb_level]>9) { ?>				
				<a href="board_write.php?w=u&wr_id=<?=$view[wr_id]?>&bo_table=<?=$bo_table?>">수정</a>
				<a href="javascript:delete_ok(<?=$view[wr_id]?>,'fr');">삭제</a>
<? } else if($member[mb_id] == $view[mb_id]) {?>
				<a href="board_write.php?w=u&wr_id=<?=$view[wr_id]?>&bo_table=<?=$bo_table?>">수정</a>
				<a href="javascript:delete_ok(<?=$view[wr_id]?>,'fr');">삭제</a>
<? }?>
			</div>
			<div class="fr">
			<? if($view[wr_1] != "")
			 {	
			?>

				<a href="shop_detail.php?id=<?=$view[wr_1]?>">업체바로가기</a>
			 <? } ?>
				<a href="board_list.php?bo_table=<?=$bo_table?>">목록</a>
				
			</div>
		</div>
	</section>
<? if($bo_table=='qa' || $bo_table=='public') { ?>
    <section class="board_reply">
        <div class="reply_tit">
            <strong>댓글 <?=$view[wr_comment]?></strong> | <strong>조회수 <?=$view[wr_hit]?></strong>
        </div>
        <ul class="reply_list">
		<?
			$sql = "select * from g5_write_".$bo_table." where wr_parent=$view[wr_id] and wr_is_comment=1 order by wr_comment";
			$rsc = sql_query($sql);
			
			while($rowc = sql_fetch_array($rsc))
			{
		?>
            <li>
                <div class="reply_info">
                    <p class="reply_writer"><?=$rowc[wr_name]?></p>
                    <p class="reply_btn">
<?if($member[mb_level]>9) { ?>				
                        <a href="javascript:delete_ok(<?=$rowc[wr_id]?>,'c');">삭제</a>
<?} else if($member[mb_id]==$rowc[mb_id]) {?>
                        <a href="javascript:delete_ok(<?=$rowc[wr_id]?>,'c');">삭제</a>
<?}?>
                    </p>
                </div>
                <p class="reply_cont"><?=nl2br($rowc[wr_content])?></p>
                <p class="reply_date"><?=apms_datetime(strtotime($rowc['wr_datetime']), 'Y.m.d');?> <!-- 2016-01-05 --></p>
            </li>
		<? } ?>
           
        </ul>
		<form name="reg" method="post" charset="utf-8" action="board_reply_ok.php">
		<input type="hidden" name="parent_id" value="<?=$wr_id?>">
		<input type="hidden" name="bo_table" value="<?=$bo_table?>">
		<div class="reply_write">
            <p><input type="text" name="content"></p> 
            <a href="javascript:gosave();">댓글</a>
        </div>
		</form>
    </section>
	
<? } ?>	
<section class="search">
		<div class="tab_wrap">
			<ul class="u4x">
				<li>목록</li>

			</ul>
		</div>
	</section>
	<section class="board_list" style="margin-bottom:80px;">
		<ul id="listbody">
	<?php
if($page<1)
	$page = 1;
$rows = 10;
$start = ($page-1)*$rows;

$sql = "select count(wr_id) c from g5_write_".$bo_table." where wr_is_comment=0";
$resc = sql_fetch($sql);
$total_count = $resc[c];

if($bo_table == "")
	$bo_table = "notice";
$sql = "select * from g5_write_".$bo_table." where wr_is_comment=0  order by wr_id desc  limit $start, $rows";
$res = sql_query($sql);
	while($row = sql_fetch_array($res))
	{
		if($row[wr_comment]>0)
			$com_st = "  <font size='2' color='red'>".$row[wr_comment]."</font>";
		else
			$com_st = "";
		if($row[wr_id] == $wr_id)
			$com_str = "<font color='#1d8ade'>>> ".$row[wr_subject].$com_st."</font>";
		else
			$com_str = $row[wr_subject].$com_st;		
	?>
			<li>
				<a href="board_detail.php?bo_table=<?=$bo_table?>&wr_id=<?=$row[wr_id]?>&page=<?=$page?>">
					<!-- div class="d1"><img src="images/temp_c1.jpg" alt=""></div-->
					<dl>
						<dt><?=$com_str?></dt>
						<dd>
							<p>조회수 <?=$row[wr_hit]?></p>
						</dd>
						
					</dl>
				</a>
			</li>
	<? } ?>

		</ul>
		<div class="btn_more"  id="lastlist"><a href="javascript:addlist('<?=$bo_table?>');">더보기</a></div>
	</section>
		
	

<form name="del_f" method="post" charset="utf-8" action="board_delete_ok.php" >
<input type="hidden" name="wr_id" >
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="b">
</form>

<script> 
  var listcount=<?=($page-1)*10?>; 

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
	function delete_ok(nid,b)
	{
		if(confirm("한번 삭제한 자료는 복구가 불가능합니다.\n정말 삭제하시겠습니까?"))
		{
		document.del_f.wr_id.value = nid;
		document.del_f.b.value = b;
		document.del_f.submit();
		}
	}
	function gosave()
	{
		if(trim(document.reg.content.value) == "")
		{
			alert('댓글의 내용을 입력해 주세요.');
			return;
		}
		document.reg.submit();
		
	}
	
	function trim(str)
	{
		return str.replace(/^\s*|\s*$/g,"");
	}

function board_move(href){
	window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
$(function() {
	$("a.view_image").click(function() {
		window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
		return false;
	});
	});
</script>

</script>
</body>
</html>