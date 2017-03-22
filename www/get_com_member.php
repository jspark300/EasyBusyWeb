<?
include_once('./_common.php');
if($member[mb_level]<10)
{
	echo "<script>alert('권한이없습니다.');location.href='/shop_list.php';</script>";
	exit;
}

$start = $count;

$rows = 10;
//$start = ($page-1)*$rows;
$sql = "select * from t_com_member_ask order by id desc  limit $start, $rows";

$res = sql_query($sql);
$i=0;
while($row = sql_fetch_array($res))
{
	++$i;
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

<? }
if($i==0)
	echo "0";
 ?>
