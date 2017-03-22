<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

if($wset['gap_r'] == "") $wset['gap_r'] = 10;
if($wset['gap_b'] == "") $wset['gap_b'] = 30;

?>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>스킨설정</caption>
	<colgroup>
		<col class="grid_2">
		<col>
	</colgroup>
	<thead>
	<tr>
		<th scope="col">구분</th>
		<th scope="col">설정</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center">간격설정</td>
		<td>
			<input type="text" name="wset[gap_r]" value="<?php echo ($wset['gap_r']);?>" size="4" class="frm_input"> px 좌우간격
			&nbsp;
			<input type="text" name="wset[gap_b]" value="<?php echo ($wset['gap_b']);?>" size="4" class="frm_input"> px 상하간격
		</td>
	</tr>
	<tr>
		<td align="center" rowspan="2">카테고리</td>
		<td>
			<select name="wset[tab]">
				<?php echo apms_tab_options($wset['tab']);?>
			</select>
			&nbsp;
			<label><input type="checkbox" name="wset[tabline]" value="1" <?php echo ($wset['tabline']) ? ' checked' : '';?>> 일반탭 상단라인 출력</label>
		</td>
	</tr>
	<tr>
		<td>
			<label><input type="radio" name="wset[ctype]" value="" <?php echo (!$wset['ctype']) ? ' checked' : '';?>> 일반형</label>
			&nbsp;
			<label><input type="radio" name="wset[ctype]" value="1"<?php echo ($wset['ctype'] == "1") ? ' checked' : '';?>> 배분형</label>
			&nbsp;
			<label><input type="radio" name="wset[ctype]" value="2"<?php echo ($wset['ctype'] == "2") ? ' checked' : '';?>> 분할형</label>
			-
			가로 최대 <input type="text" name="wset[bunhal]" value="<?php echo ($wset['bunhal']);?>" size="2" class="frm_input"> 개 출력
		</td>
	</tr>
	<tr>
		<td align="center">그림자</td>
		<td>
			<select name="wset[shadow]">
				<?php echo apms_shadow_options($wset['shadow']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">출력설정</td>
		<td>
			<label><input type="checkbox" name="wset[cmt]" value="1"<?php echo ($wset['cmt']) ? ' checked' : '';?>> 댓글</label>
			&nbsp;
			<label><input type="checkbox" name="wset[buy]" value="1"<?php echo ($wset['buy']) ? ' checked' : '';?>> 구매수</label>
			&nbsp;
			<label><input type="checkbox" name="wset[sns]" value="1"<?php echo ($wset['sns']) ? ' checked' : '';?>> SNS아이콘</label>
			&nbsp;
			<label><input type="checkbox" name="wset[star]" value="1"<?php echo ($wset['star']) ? ' checked' : '';?>> 별점</label>
			<select name="wset[scolor]">
				<?php echo apms_color_options($wset['scolor']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">새아이템</td>
		<td>
			<input type="text" name="wset[newtime]" value="<?php echo ($wset['newtime']);?>" size="3" class="frm_input"> 시간 이내 등록 아이템
			&nbsp;
			색상
			<select name="wset[new]">
				<?php echo apms_color_options($wset['new']);?>
			</select>
		</td>
	</tr>
	</tbody>
	</table>
</div>