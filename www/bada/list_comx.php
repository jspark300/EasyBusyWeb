<?php
include_once('./_common.php');

//if ($is_guest)
 //   alert_close('회원만 조회하실 수 있습니다.');

// Page ID
$pid = ($pid) ? $pid : '';
$at = apms_page_thema($pid);
if(!defined('THEMA_PATH')) {
	include_once(G5_LIB_PATH.'/apms.thema.lib.php');
}

//list($skin_path, $skin_url) = apms_skin_path('point.skin.php', '/bbs/point');
$skin_path = $member_skin_path;
$skin_url = $member_skin_url;

$g5['title'] = $it_name.' 검색결과 ';
include_once(G5_PATH.'/head.sub.php');

$list = array();

$it_name = trim($it_name);
//$it_name = urldecode($it_name);
//$it_name = clean_xss_tags($it_name);

$gubun = trim($gubun);
$gubun = clean_xss_tags($gubun);



// 책 검색
if($page<1)
	$page = 1;
$start = ($page-1)*100;
$sql = "select count(seq) c from b_company";
$res = sql_fetch($sql);
$total_count = $res['c'];
$rows = 100;

$sql = "select * from b_company order by seq  limit $start, $rows";
$res = sql_query($sql);
$num = 0;




$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

//$page_rows = 10;
//$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산


$qstr = "it_name=".$it_name;
$write_pages = (G5_IS_MOBILE) ? $config['cf_mobile_pages'] : $config['cf_write_pages'];
$list_page = $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page=';

@include_once(THEMA_PATH.'/head.sub.php');

?>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);


?>
<script type="text/javascript">
	function select_item(v1,v2,v3,v4,v5,v6)
	{
		var of = opener.document.reg_product;
		title = v1.replace('<b>','');
		title = title.replace('</b>','');
		author = v2.replace('<b>','');
		author = author.replace('</b>','');
		publisher = v3.replace('<b>','');
		publisher = publisher.replace('</b>','');

		of.it_name.value = title;
		of.it_1.value = author;
		of.it_2.value = publisher;
		of.it_3.value = v4;
//		of.it_price.value = v5;
		of.it_cust_price.value = v6;
		self.close();
	}

	function search_item2()
	{
		str = document.reg_product.it_name.value;
		if(str == "")
		{
			alert('검색할 도서명을 입력하세요.');
			return;
		}
		//str = str.replace(" ", "");
		str =  str.replace(/\s/gi, ''); 
		str = encodeURIComponent(str);
		location.href = "/bada/search_com.php?it_name="+str;
	}
</script>

<div class="sub-title">
	<h4>총 <?=$total_count?> <a href="">새로고침</a></h4>
</div>

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