<?
include_once('./_common.php');
$where = " where 1 ";
$start = $count;

$mb_no = $member[mb_no];
$mb_id = $member[mb_id];

$sql = "select *  from t_comp where id=$id";
$res = sql_fetch($sql);
$sql = "select * from t_com_comment where com_id=$id  and id=parent_id order by id desc limit ".$start.", 10";
$rs = sql_query($sql);
$i=0;
while($row=sql_fetch_array($rs))
{
		++$i;
?>    	
            <li>
                <div>
	                <div class="reply_info">
	                    <!--p class="reply_writer"><?=$row[name]?></p-->
	                    <p class="reply_btn">
	                        <?if($row[mb_no]==$mb_no) { ?><a href="javascript:del_go(<?=$row[id]?>);">삭제</a> <?}?>
	                    </p>
	                </div>
	                <p class="reply_cont"><?if($row[mb_no] == $mb_no || $res[own_id]==$mb_id || $row[is_comment]=="1") 
														echo nl2br($row[content]);
													else
														echo "주인장 댓글을 기다리고 있는 글입니다."; 
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
<? }
if($i==0)
	echo "0";
 ?> 		
<script src="a_js/common.js"></script>