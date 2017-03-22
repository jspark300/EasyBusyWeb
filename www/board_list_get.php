<?
include_once('./_common.php');

$start = $count;
$page = $count/10+1;
$rows = 10;
$sql = "select wr_id,wr_subject,wr_hit,wr_option  from g5_write_".$bo_table."  where wr_is_comment=0 order by wr_id desc limit $start, $rows";
$res = sql_query($sql);
$i= 0;
while($row = sql_fetch_array($res))
{
	++$i;
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
				<a href="board_detail.php?bo_table=<?=$bo_table?>&wr_id=<?=$row[wr_id]?>&page=<?=$page?>">
					<!-- div class="d1"><img src="images/temp_c1.jpg" alt=""></div-->
					<dl>
						<dt><?=$is_lock?><?=$row[wr_subject]?></dt>
						<dd>
							<p>조회수 <?=$row[wr_hit]?></p>
						</dd>
						
					</dl>
				</a>
			</li>
<? } 
if($i==0)
	echo "0";
?>