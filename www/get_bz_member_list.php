<?
include_once('./_common.php');
$where = " where 1 ";
$start = $count;

$i=0;
$sql = "select * from g5_member where  mb_level=4 order by mb_no desc  limit ".$start.",10";
$rs = sql_query($sql);
while($row=sql_fetch_array($rs))
{
	++$i;
?>    	
            <li>
                <div>
	                <div class="reply_info">
	                    <a href="" target="_blank"><p class="reply_writer"><?=$row[mb_name]?><br></p></a>
					
	                    <p class="reply_btn">
	                        <!-- a href="javascript:del_go(<?=$row[mb_no]?>);">삭제</a--> 
	                    </p>
	                </div>
	                <p class="reply_cont"><a href="tel:<?=$row[mb_tel]?>"><? echo $row[mb_tel];	 ?></a></p>
	                <p class="reply_date">회원등록일 : <?=apms_datetime(strtotime($row['mb_datetime']), 'Y.m.d');?><!-- 2016-01-05 --></p>
                </div>
			<?
			$sql = "select id, name,reg_date from t_comp where reg_id='$row[mb_id]' order by reg_date desc";
			//echo $sql;
			$rx = sql_query($sql);
			while($rc = sql_fetch_array($rx))
			{
			?>	
                <div style='padding-left:20px;'>
					<p class="reply_cont2"><a href="shop_detail.php?id=<?=$rc[id]?>"><?=$rc[name]?></a><br><?=apms_datetime($rc['reg_date'], 'Y.m.d');?></p>
					<p class="reply_btn2">
	                       <!--a href="javascript:del_go(<?=$rc[id]?>);">삭제</a-->
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
