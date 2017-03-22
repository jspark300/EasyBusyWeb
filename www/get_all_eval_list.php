<?
include_once('./_common.php');
$where = " where 1 ";
$start = $count;

$mb_no = $member[mb_no];

$sql = "select * from t_com_comment where  id=parent_id order by id desc limit ".$start.", 10";
$rs = sql_query($sql);
$i=0;
while($row=sql_fetch_array($rs))
{
		++$i;
	$sql = "select name from t_comp where id=$row[com_id]";
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
                <div  style='padding-left:20px;'>
					<p class="reply_cont2"><?=nl2br($rc[content])?><br><?=$rc[name]?> <?=apms_datetime($rc['reg_date'], 'Y.m.d');?></p>
					<p class="reply_btn2">
	                       <a href="javascript:del_go(<?=$rc[id]?>);">삭제</a>
	                </p>
                </div>
			<?
			}
			?>
			
            </li>
<? }
if($i==0)
	echo "0";
 ?> 		
<script src="a_js/common.js"></script>