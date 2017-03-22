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
	<h4>검색어추가</h4>
</div>
<form name="cat" method="post" charset="utf-8"  action="cat_insert.php">
<div class="form-group" style="position:relative;">
			
			<div class="col-sm-9"><label class="col-sm-2 control-label" style="margin:-2px 0 0 -3px;float:left;"><h4>검색어</h4></label>
			<div id="qstr_id" class="qstr_id" style="float:left;margin-right:3px;">
				<input type="text" name="b_cat" id="b_cat"  class="form-control input-sm"  style="float:left;width:100px;margin-right:10px;ime-mode:active;"  ><input type="text" style="display: none;" /><input type="button" class="btn btn-color" name="추가"  value="추가" onclick="insert_item();" style="float:left;">&nbsp;&nbsp;* <b> {!@#$%^&*()_-=+.,/\][} 등 특수문자는 입력금지,<br>&nbsp;&nbsp;영문 한글 한개 단어씩 입력하세요.</b>
			</div>
</div>
</form>

<?
$sql="select title from b_cat order by seq";
$ba_result = sql_query($sql);
while ($row=sql_fetch_array($ba_result)) {
		$str4 .= " ".$row['title'];
}

?>

<div class="form-group" style="position:relative;">
			
			<div class="col-sm-7"><label class="col-sm-2 control-label" style="margin:-2px 0 0 -3px;float:left;"><h4></h4></label>
			<div id="qstr_id" class="qstr_id" style="float:left;margin-right:3px;">
				<?=$str4?>
				</div>
			</div>
</div>




<?
@include_once(THEMA_PATH.'/tail.sub.php');
include_once(G5_PATH.'/tail.sub.php');

?>