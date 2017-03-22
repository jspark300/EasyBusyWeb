<?php
include_once('./_common.php');

//if ($is_guest)
  //  alert_close('회원만 조회하실 수 있습니다.');

// Page ID
$pid = ($pid) ? $pid : '';
$at = apms_page_thema($pid);
if(!defined('THEMA_PATH')) {
	include_once(G5_LIB_PATH.'/apms.thema.lib.php');
}

//list($skin_path, $skin_url) = apms_skin_path('point.skin.php', '/bbs/point');
$skin_path = $member_skin_path;
$skin_url = $member_skin_url;

$g5['title'] = "<font color='red'>".$sido.$gugun.$dong.$it_name.'</font><br>검색결과 ';
include_once(G5_PATH.'/head.sub.php');

$list = array();

// 책 검색
if($page<1)
	$page = 1;
$start = ($page-1)*100;
$sql = "select count(seq) c from b_company";
$res = sql_fetch($sql);
$total_count = $res['c'];
$rows = 100;

$sql = "select * from b_company order by seq desc  limit $start, $rows";
$res = sql_query($sql);
$num = 0;




$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

//$page_rows = 10;
//$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산


$qstr = "";
$write_pages = (G5_IS_MOBILE) ? $config['cf_mobile_pages'] : $config['cf_write_pages'];
$list_page = $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page=';


@include_once(THEMA_PATH.'/head.sub.php');
?>


<?php
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);


?>
<script type="text/javascript">

	function search_item2()
	{
		str = document.reg_product.it_name.value;
		if(str == "")
		{
			alert('검색할 검색어를 선택하세요.');
			return;
		}
		//str = str.replace(" ", "");
//		str =  str.replace(/\s/gi, ''); 
//		str = encodeURIComponent(str);
		document.reg_product.submit();
	}
	function insert_item()
	{
		str = document.cat.b_cat.value;
		if(str == "")
		{
			alert('추가할 검색어를 입력하세요.');
			return;
		}
		if(confirm('검색어를 추가하시겠습니까?'))
		{
			document.cat.submit();
		}
	}
</script>

<div class="sub-title">
	<h4>총 <?=$total_count?><a href="javascript:location.reload();">새로고침</a></h4>
</div>
<script type="text/javascript">
	function send(sido) {
		sido = encodeURIComponent(sido);
		$.ajax({
			type:"GET",
			url:"/bada/apart_ex.php?sido="+sido,
			data:"",
			dataType:'html',
			success:function(data){
				str = "<select name='gugun' id='gugun' class='gugun' onchange='send2(sido.value,this.value);' style='width:100px;height:30px;margin-left:3px;'><option value='' >구군선택" + data+"</select>";
				document.getElementById('gugun_id').innerHTML = str;
				document.getElementById('dong_id').innerHTML = "<select  style='width:100px;height:30px;margin-left:3px;'><option value=''>동읍면선택</select>";
			}
		});
	}

	function send2(sido,gugun) {

		sido = encodeURIComponent(sido);
		gugun = encodeURIComponent(gugun);
		$.ajax({
			type:"GET",
			url:"/bada/apart_ex.php?sido="+sido+"&gugun="+gugun,
			data:"",
			dataType:'html',
			success:function(data){
				str = "<select name='dong' id='dong' class='dong' onchange='send3(sido.value,gugun.value,this.value);' style='width:100px;height:30px;margin-left:3px;'><option value='' >동읍면선택" + data+"</select>";
				document.getElementById('dong_id').innerHTML = str;
			}
		});

	}


	</script>
						
<?php



$sql="select distinct reg1 from b_region order by reg1";
$ba_result = sql_query($sql);
$str = "";
while ($row=sql_fetch_array($ba_result)) {
	if($row[reg1]==$sido)
		$str .= "<option value='".$row['reg1']."' selected>".$row['reg1'];
	else
		$str .= "<option value='".$row['reg1']."' >".$row['reg1'];

}

$sql="select distinct reg2 from b_region where reg1='$sido' order by reg2";
$ba_result = sql_query($sql);
$str2 = "<select name='gugun' id='gugun' class='gugun' onchange='send2(sido.value,this.value);' style='width:100px;height:30px;margin-left:3px;'><option value='' >구군선택";
while ($row=sql_fetch_array($ba_result)) {
	if($row[reg2]==$gugun)
		$str2 .= "<option value='".$row['reg2']."' selected>".$row['reg2'];
	else
		$str2 .= "<option value='".$row['reg2']."' >".$row['reg2'];
}
$str2 .="</select>";


$sql="select reg3 from b_region where reg1='$sido' and reg2='$gugun' order by reg3";
$ba_result = sql_query($sql);
$str3 = "<select name='dong' id='dong' style='width:100px;height:30px;margin-left:3px;'><option value='' >동읍면선택";
while ($row=sql_fetch_array($ba_result)) {
	if($row[reg3]==$dong)
		$str3 .= "<option value='".$row['reg3']."' selected>".$row['reg3'];
	else
		$str3 .= "<option value='".$row['reg3']."' >".$row['reg3'];
}
$str3 .= "</select>";

?>					
<form name="reg_product" method="post" charset="utf-8" action="engine.php">
<div class="form-group" style="position:relative;">
			
					<div class="col-sm-7">
						<label class="col-sm-1 control-label" style="margin:-2px 0 0 -3px;float:left;"><h4>지역</h4></label>
						<div id="sido_id" class="sido_id" style="float:left;">
						<select name="sido" onchange="send(this.value);" style="height:30px;">
							<option value="" selected>시도선택
							<?=$str?>
						</select>
						</div>
						<div id="gugun_id" class="gugun_id" style="float:left;">
							<?=$str2?>
						</div>
						<div id="dong_id" class="dong_id" style="float:left;">
							<?=$str3?> 
						</div>

					</div>
				
</div>	
<?
$sql="select title from b_cat order by seq";
$ba_result = sql_query($sql);
$str4 = "<select name='it_name' id='it_name' style='width:100px;height:30px;margin-left:3px;'><option value='' >검색어선택";
while ($row=sql_fetch_array($ba_result)) {
	if($row[title]==$it_name)
		$str4 .= "<option value='".$row['title']."' selected>".$row['title'];
	else
		$str4 .= "<option value='".$row['title']."' >".$row['title'];
}
$str4 .= "</select>";

?>

<div class="form-group" style="position:relative;">
			
			<div class="col-sm-7"><label class="col-sm-1 control-label" style="margin:-2px 0 0 -3px;float:left;"><h4>검색</h4></label>
			<div id="qstr_id" class="qstr_id" style="float:left;margin-right:3px;">
				<?=$str4?>
				</div>
				<!--input type="text" name="it_name" id="it_name" <?php echo $required ?>  required   class="form-control input-sm"  style="float:left;width:300px;margin-right:10px;ime-mode:active;" value="<?=$it_name?>" -->
				<input type="text" style="display: none;" /><input type="button" class="btn btn-color" name="검색"  value="지역검색" onclick="search_item2();" style="float:left;">
			</div>
</div>
</form>

<div class="form-group" style="position:relative:">
	<?php if($total_count > 0) { ?>
		<div class="col-sm-7">
			<ul class="pagination pagination-sm en" style="margin-top:10px;">
				<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
			</ul>
		</div>
	<?php } ?>
</div>	



<div class="point-skin">
	<table class="div-table table">
	<tbody>
	<tr class="bg-black">
		<th class="text-center" scope="col">번호</th>
		<th class="text-center" scope="col">지역</th>
		<th class="text-center" scope="col">쿼리</th>
		<th class="text-center" scope="col">업체</th>
		<th class="text-center" scope="col">카테고리</th>
		<th class="text-center" scope="col">설명</th>
		<th class="text-center" scope="col">전화번호</th>
		<th class="text-center" scope="col">주소</th>
		<th class="text-center" scope="col">신주소</th>
		<th class="text-center" scope="col">mapx</th>
		<th class="text-center" scope="col">mapy</th>
		<th width="20"></th>
	</tr>
	<?php

	while($row = sql_fetch_array($res))
	{

	?>
	<tr>
		<td class="text-center"><?php echo $row['seq']; ?></td>
		<td class="text-left"><?php echo $row['sido'].$row['gugun'].$row['dong']; ?></td>
		<td class="text-left"><?php echo $row['qstr']; ?></td>
		<td class="text-left"><?php echo $row['title']; ?></td>
		<td class="text-center"><?php echo  $row['category']; ?></td>
		<td class="text-center font-11"><?php echo  $row['description']; ?></td>
		<td class="text-center"><?php echo  $row['telephone']; ?></td>
		<td class="text-center"><?php echo  $row['address']; ?></td>
		<td class="text-center"><?php echo  $row['roadAddress']; ?></td>
		<td class="text-center"><?php echo  $row['mapx']; ?></td>
		<td class="text-center"><?php echo  $row['mapy']; ?></td>
		<td></td>
	</tr>
	<?php
	}

	?>

	</tbody>
	<tfoot>
	<tr class="active">
		<th></th>
		<th scope="row"></th>
		<th></th>
		<td align="right"><b></b></td>
		<td align="right"><b></b></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	</tfoot>
	</table>

	<?php if($total_count > 0) { ?>
		<div class="text-center">
			<ul class="pagination pagination-sm en" style="margin-top:0px;">
				<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
			</ul>
		</div>
	<?php } ?>
	<p class="text-center">
		<button type="button" class="btn btn-black btn-sm" onclick="window.close();">닫기</button>
	</p>
</div>







<?
@include_once(THEMA_PATH.'/tail.sub.php');
include_once(G5_PATH.'/tail.sub.php');

?>