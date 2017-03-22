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
		if(document.eva.comment.value != "" && document.eva.comment.value.length<5)
		{
			alert('주인장에게 한마디 : 5자 이상 입력해 주세요!');
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
if($member[mb_level]<10)
{
	echo "<script>alert('관리권한이 필요합니다.');history.back();</script>";
	exit;
}

?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>주인장에게한마디</p>
		</div>
	</header>
	
	
	
	<section class="board_reply">
<? 
$sql = "select count(id) c from t_com_comment where  id=parent_id";
$cx = sql_fetch($sql);
$comment_count = $cx[c];

?>    

		<div class="reply_tit">
            <?=$comment_count?> 개의 글
        </div>
        <ul class="reply_list" id="listbody">
		
	<? 

$sql = "select * from t_com_comment where  id=parent_id order by id desc  limit 10";
$rs = sql_query($sql);
while($row=sql_fetch_array($rs))
{
	$sql = "select id, name from t_comp where id=$row[com_id]";
	$rx = sql_fetch($sql);
?>    	
            <li>
                <div>
	                <div class="reply_info">
	                    <a href="/shop_detail.php?id=<?=$rx[id]?>" target="_blank"><p class="reply_writer"><?=$rx[name]?><br></p></a>
					
	                    <p class="reply_btn">
	                        <a href="javascript:del_go(<?=$row[id]?>);">삭제</a> 
	                    </p>
	                </div>
	                <p class="reply_cont"><?if($row[mb_no] == $mb_no || $row[is_comment]=="1") 
														echo nl2br($row[content]);
													else
														echo "<font color='red'>주인장 댓글을 기다리고 있는 글입니다.</font><br>".nl2br($row[content]); 
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
	                       <a href="javascript:del_go(<?=$rc[id]?>);">삭제</a>
	                </p>
                </div>
			<?
			}
			?>
			
            </li>
<? } ?> 			
            
        </ul>
        <div class="btn_more p10"  id="lastlist"><a href="javascript:addlist();">더보기</a></div>
    </section>
	<form name="re_del" method="post" charset="utf-8" action="shop_eval_re_del_ok.php">
						<input type="hidden" name="com_id" value="<?=$id?>">
						<input type="hidden" name="id" >
						<input type="hidden" name="page">
	
	</form>
<script>
  var listcount=0; 
   function addlist(){ 
        listcount+=10; 
        $.post("/get_all_eval_list.php",{"count" : listcount},function(data){ 
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