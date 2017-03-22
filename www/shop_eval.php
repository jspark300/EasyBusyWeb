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
<script type="text/javascript">
	function seteva(no,ev)
	{
		if(no==1)
			document.eva.eva1.value = ev;
		else if(no==2)
			document.eva.eva2.value = ev;
		else if(no==3)
			document.eva.eva3.value = ev;
		else if(no==4)
			document.eva.eva4.value = ev;
	}
	function eva_go()
	{
		if(document.eva.comment.value.length<5)
		{
			alert('후기 5자 이상 입력해 주세요!');
			return;
		}
		document.eva.submit();
		
	}
	function re_go(fx)
	{
		if(fx.comment.value == "")
		{
			alert('답글을 입력해 주세요.!');
			return;
		}
		fx.submit();
	}
	function del_go(id)
	{
		if(confirm('한번 삭제한 자료는 복구가 불가능합니다.\n정말 삭제하시겠습니까?'))
		{
			document.re_del.id.value = id;
			document.re_del.submit();
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
$sql = "select *   from t_comp where id=$id";
$res = sql_fetch($sql);
?>
	<header class="header2">
		<div class="btn_back"><a href="shop_detail.php?id=<?=$id?>"></a></div>
		<div class="txt_tit">
			<p><?=$res[name]?></p>
		</div>
	</header>
	<section class="shop_eval">
		<form name="eva" method="post" charset="utf-8" action="shop_eval_ok.php">
		<input type="hidden" name="com_id" value="<?=$res[id]?>">
		<input type="hidden" name="eva1" value="5">
		<input type="hidden" name="eva2" value="5">
		<input type="hidden" name="eva3" value="5">
		<input type="hidden" name="eva4" value="5">
		<h2>후기글쓰기</h2>
		<div class="d1">
			<span>후기 보상</span> <strong>응모권1개 지급</strong> (1일 최대 10개까지 지급)
		</div>
		

		<div class="d3">
			
			<div>
				<textarea name="comment" placeholder="최소 5자 이상 작성해 주세요." style="height:150px;"></textarea>
			</div>
		</div>
		
		<div class="btn1"><a href="javascript:eva_go();" class="btn_t1">완료</a></div>
		</form>
	</section>
	
	
	<section class="board_reply">
<? 
$mb_no= $member[mb_no];
$mb_id = $member[mb_id];
if($res[own_id] == $mb_id) // 주인장인경우
	$sql = "select count(id) c from t_com_comment where com_id=$id  and id=parent_id";
else	
	$sql = "select count(id) c from t_com_comment where com_id=$id  and id=parent_id and (is_comment=1 or mb_no='$mb_no')";
$cx = sql_fetch($sql);
$comment_count = $cx[c];

?>    

		<div class="reply_tit">
            <?=$comment_count?> 개의 글
        </div>
        <ul class="reply_list" id="listbody">
		
	<? 
//$sql = "select count(id) c from t_com_comment where com_id=$id";
//$cx = sql_fetch($sql);
//$comment_count = $cx[c];
$sql = "select * from t_com_comment where com_id=$id  and id=parent_id order by id desc  limit 10";
$rs = sql_query($sql);
while($row=sql_fetch_array($rs))
{
?>    	
            <li>
                <div>
	                <div class="reply_info">
	                    <!--p class="reply_writer"><?=$row[name]?></p-->
	                    <p class="reply_btn">
	                        <?if($row[mb_no]==$mb_no) { ?><a href="javascript:del_go(<?=$row[id]?>);">삭제</a> <?}?>
	                    </p>
	                </div>
	                <p class="reply_cont"><? //if($row[mb_no] == $mb_no || $res[own_id]==$mb_id || $row[is_comment]=="1") 
														echo nl2br($row[content]);
													//else
													//	echo "주인장 댓글을 기다리고 있는 글입니다."; 
													?></p>
	                <p class="reply_date"><?=$row[name]?> <?=apms_datetime($row['reg_date'], 'Y.m.d');?><!-- 2016-01-05 --></p>
                </div>
			<?
			$sql="select * from t_com_comment where parent_id=$row[id] and is_comment=2 order by id";
			$rsx = sql_query($sql);
			while($rc = sql_fetch_array($rsx))
			{
			?>	
                <div style='padding-left:20px;'>
					<p class="reply_cont2"><?=nl2br($rc[content])?><br><?=$rc[name]?> <?=apms_datetime($rc['reg_date'], 'Y.m.d');?></p>
					<p class="reply_btn2">
	                       <?if($rc[mb_no]==$mb_no) { ?><a href="javascript:del_go(<?=$rc[id]?>);">삭제</a> <?}?>
	                </p>
                </div>
			<?
			}
			
			// 업체 주인장 댓글달기
			if($member[mb_id] == $res[own_id] ) {
			?>
				<div>
                	<div class="reply_cont2">
						<form name="re_f_<?=$row[id]?>" method="post" charset="utf-8" action="shop_eval_re_ok.php">
						<input type="hidden" name="com_id" value="<?=$id?>">
						<input type="hidden" name="parent_id" value="<?=$row[id]?>">
							<div class="reply_input2">
								<textarea name="comment" placeholder="답글 쓰기"></textarea>
								<div class="btn2"><a href="javascript:re_go(document.re_f_<?=$row[id]?>);">입력</a> <a class="reply_btn3" href="#1">취소</a></div>
							</div>
							<div class="btn2 reply_btn2"><a href="#1">답글 쓰기</a></div>
						</form>
                	</div>
                </div>		
			<?}?>
            </li>
<? } ?> 			
            <!--li>
                <div class="reply_info">
                    <p class="reply_writer">extralover</p>
                </div>
                <p class="reply_cont">댓글 내용이 나오는 곳 댓글 내용이 나오는 곳 댓글 내용이 나오는 곳 댓글 내용이 나오는 곳 댓글 내용이 나오는 곳</p>
                <p class="reply_date">18시간 전 </p>
                <div>
                	<div class="reply_cont2">
                		<div class="reply_input2">
	                		<textarea placeholder="답글 쓰기"></textarea>
	                		<div class="btn2"><a href="#1">입력</a> <a class="reply_btn3" href="#1">취소</a></div>
                		</div>
                		<div class="btn2 reply_btn2"><a href="#1">답글 쓰기</a></div>
                	</div>
                </div>
            </li-->
        </ul>
        <div class="btn_more p10"  id="lastlist"><a href="javascript:addlist();">더보기</a></div>
    </section>
	<form name="re_del" method="post" charset="utf-8" action="shop_eval_re_del_ok.php">
						<input type="hidden" name="com_id" value="<?=$id?>">
						<input type="hidden" name="id" >
	
	</form>
<script>
  var listcount=0; 
  var comid=<?=$id?>;
   function addlist(){ 
        listcount+=10; 
        $.post("/get_eval_list.php",{"count" : listcount,"id" : comid},function(data){ 
              var oldlist =  $("#listbody").html(); 
               if(trim(data).substring(0,1) != "0")
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
	
</body>
</html>