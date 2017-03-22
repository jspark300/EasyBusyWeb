<?php
include_once('./_common.php');


if($b_cat=="")
{
	echo "검색어가 없습니다.";
}
else
{
	$sql = "select count(seq) st from b_cat where title = '".$b_cat."'";
	$row = sql_fetch($sql);
	if($row['st'] == 0)
	{
		$sql = "insert into b_cat (title) values ('".$b_cat."')";
		sql_query($sql);
		echo $b_cat." 이(가) 추가되었습니다.";
	}
	else
	{
		echo $b_cat." 이(가) 이미 추가되었습니다.";
	}
}
?>
<br>
<script>
function go()
{
	location.href = "cat.php";
}
</script>
<input type="button" name="back" value="back" onclick="javascript:go();" style="width:200px;height:50px;">

