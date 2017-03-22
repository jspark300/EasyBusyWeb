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
function com_ok(mb_no,id,com_id,mb_id,st)
{
	if(confirm("권한을 변경하시겠습니까?"))
	{
	document.com_f.mb_no.value = mb_no;
	document.com_f.com_id.value = com_id;
	document.com_f.id.value = id;
	document.com_f.mb_id.value = mb_id;
	document.com_f.st.value = st;
	document.com_f.submit();
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

//if($page<1)
//	$page = 1;
$rows = 10;
//$start = ($page-1)*$rows;
$sql = "select * from t_com_member_ask order by id desc  limit $rows";

$res = sql_query($sql);
?>

	<? include_once('./header.php');?>
	<section class="board_main">
		<div class="cate">
			<p style="float:left;cursor:pointer;display:block; width:80px; height:30px; padding:10px 5px 0 0; text-align:center; color:#fff;  background:#00b6fd;"><b>업체회원신청</b></p>
		</div>
		</div>
	</section>
	<section class="nboard">
		<div id="listbody">
	<?php

	while($row = sql_fetch_array($res))
	{
		$sql = "select name from t_comp where id=$row[com_id]";
		//echo $sql;
		$ss = sql_fetch($sql);

		if($row[status]=="0")
			$member_str = "일반회원(신청)";
		else if($row[status]=="1")
			$member_str = "업체회원(일반->업체)";
		else if($row[status]=="2")
			$member_str = "일반회원(업체->일반)";

	?>
		<div class="notice1">
			<dl>
				<dt>
					<strong>[업체회원신청]</strong><?=$member_str?> <?=date("Y-m-d H:i",$row[reg_date])?> 
					<?if($row[status]=="0" || $row[status]=="2" ) {?><a href="javascript:com_ok('<?=$row[mb_no]?>', '<?=$row[id]?>' ,'<?=$row[com_id]?>','<?=$row[mb_id]?>','1');">업체회원으로 등업하기</a>
					<?} else {?> <a href="javascript:com_ok('<?=$row[mb_no]?>', '<?=$row[id]?>', '<?=$row[com_id]?>', '<?=$row[mb_id]?>','0');">일반회원으로 수정하기</a><?}?>
				</dt>
				<dd>
				 업체명 : <?=$ss[name]?> <br>
				 회원id : <?=$row[mb_id]?> <br>
				 연락처 : <?=$row[tel]?><br>
				 배달수신전화번호 : <?=$row[tel_delivery]?> <br>
				 배달수신sms번호 : <?=$row[tel_sms]?><br>
				 입금금액 : <?=$row[pay_sel]?><br>
				 입금계좌 : <?=$row[pay_bank]?><br>

				</dd>
			</dl>
		</div>

	<? } ?>
		</div>
			
		<div class="btn_more"  id="lastlist"><a href="javascript:addlist();">더보기</a></div>
		
	</section>
<form name="com_f" method="post" charset="utf-8" action="modify_com_member.php" >
<input type="hidden" name="mb_no" >
<input type="hidden" name="id">
<input type="hidden" name="com_id">
<input type="hidden" name="mb_id">
<input type="hidden" name="st">
</form>

<script> 
  var listcount=0; 

  function addlist(){ 
        listcount+=10; 
        $.post("/get_com_member.php",{"count" : listcount},function(data){ 
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

</body>
</html>