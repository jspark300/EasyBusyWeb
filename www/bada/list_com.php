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
if($it_name == "")
	$where = "";
else
	$where = "where ".$it_search." like '%".$it_name."%'";
$sql = "select count(id) c from t_comp ".$where;
$res = sql_fetch($sql);
$total_count = $res['c'];
$rows = 100;

$sql = "select * from t_comp  ".$where." order by id  limit $start, $rows";
$res = sql_query($sql);
$num = 0;




$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

//$page_rows = 10;
//$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산


$qstr = "it_name=".$it_name."&it_search=".$it_search;
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
		str2 = document.reg_product.it_search.value;
		if(str == "")
		{
			alert('검색할 업체명을 입력하세요.');
			return;
		}
		//str = str.replace(" ", "");
		str =  str.replace(/\s/gi, ''); 
		str = encodeURIComponent(str);
		location.href = "/bada/list_com.php?it_name="+str+"&it_search="+str2;
	}
</script>

<div class="sub-title">
	<h4>총 <?=$total_count?> <a href="/bada/list_com.php">새로고침</a></h4>
</div>
<form name="reg_product" method="post" charset="utf-8" action="engine.php">
						<select name="it_search"   style="float:left;height:30px;" >
							<option value="name" <?if($it_search=="name") echo "selected"; ?>>업체명
							<option value="cate1" <?if($it_search=="cate1") echo "selected"; ?> >cate1
							<option value="cate2" <?if($it_search=="cate2") echo "selected"; ?> >cate2
							<option value="cate3" <?if($it_search=="cate3") echo "selected"; ?> >cate3
							<option value="scate" <?if($it_search=="scate") echo "selected"; ?> >scate
						</select>
<input type="text" name="it_name" id="it_name" <?php echo $required ?>  required   class="form-control input-sm"  style="float:left;width:300px;margin-right:10px;ime-mode:active;" value="<?=$it_name?>" >
				<input type="text" style="display: none;" /><input type="button" class="btn btn-color" name="검색"  value="검색" onclick="search_item2();" style="float:left;">
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
		<th class="text-center" scope="col">cate1</th>
		<th class="text-center" scope="col">cate2</th>
		<th class="text-center" scope="col">cate3</th>
		<th class="text-center" scope="col">scate</th>
		<th class="text-center" scope="col">업체</th>
		<th class="text-center" scope="col">.</th>
		<th class="text-center" scope="col">.</th>
		<th class="text-center" scope="col">전화번호</th>
		<th class="text-center" scope="col">주소</th>
		<th class="text-center" scope="col">.</th>
		<th class="text-center" scope="col">mapx</th>
		<th class="text-center" scope="col">mapy</th>
		<th width="20"></th>
	</tr>
	<?php
	$i = 0;
	while($row = sql_fetch_array($res))
	{

		$idx = $total_count - ($page-1)*100 - $i;
		++$i;
	?>
	<tr>
		<td class="text-center"><?php echo $idx; ?></td>
		<td class="text-left"><?php echo $row['cate1']; ?></td>
		<td class="text-left"><?php echo $row['cate2']; ?></td>
		<td class="text-left"><?php echo $row['cate3']; ?></td>
		<td class="text-left"><?php echo $row['scate']; ?></td>
		<td class="text-left"><?php echo $row['name']; ?></td>
		<td class="text-center"><?php echo  $row['category']; ?></td>
		<td class="text-center font-11"><?php echo  $row['description']; ?></td>
		<td class="text-center"><?php echo  $row['phone']; ?></td>
		<td class="text-center"><?php echo  $row['addr_s']; ?></td>
		<td class="text-center"><?php echo  $row['roadAddress']; ?></td>
		<td class="text-center"><?php echo  $row['lat']; ?></td>
		<td class="text-center"><?php echo  $row['lon']; ?></td>
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