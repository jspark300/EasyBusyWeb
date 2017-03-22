<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

if($wset['gap_r'] == "") $wset['gap_r'] = 10;
if($wset['gap_b'] == "") $wset['gap_b'] = 30;
if(!$wset['thumb_w']) $wset['thumb_w'] = 400;
if($wset['thumb_h'] == "") $wset['thumb_h'] = 400;
if(!$wset['garo']) $wset['garo'] = 4;
if(!$wmset['garo']) $wmset['garo'] = 1;
if(!$wset['sero']) $wset['sero'] = 5;
if(!$wmset['sero']) $wmset['sero'] = 10;

?>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>위젯설정</caption>
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
		<td align="center">보이기</td>
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
		<td align="center">썸네일</td>
		<td>
			<input type="text" required name="wset[thumb_w]" value="<?php echo $wset['thumb_w']; ?>" class="frm_input" size="4">
			x
			<input type="text" name="wset[thumb_h]" value="<?php echo $wset['thumb_h']; ?>" class="frm_input" size="4">
			px 
			&nbsp;
			<select name="wset[shadow]">
				<?php echo apms_shadow_options($wset['shadow']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">가로수</td>
		<td>
			<input type="text" name="wset[garo]" value="<?php echo $wset['garo']; ?>" class="frm_input" size="4"> 개 - PC
			&nbsp;
			<input type="text" name="wmset[garo]" value="<?php echo $wmset['garo']; ?>" class="frm_input" size="4"> 개 - 모바일
		</td>
	</tr>
	<tr>
		<td align="center">세로수</td>
		<td>
			<input type="text" name="wset[sero]" value="<?php echo $wset['sero']; ?>" class="frm_input" size="4"> 개 - PC
			&nbsp;
			<input type="text" name="wmset[sero]" value="<?php echo $wmset['sero']; ?>" class="frm_input" size="4"> 개 - 모바일
		</td>
	</tr>
	<tr>
		<td align="center">간격설정</td>
		<td>
			<input type="text" name="wset[gap_r]" value="<?php echo $wset['gap_r']; ?>" class="frm_input" size="4"> px - 가로
			&nbsp;
			<input type="text" name="wset[gap_b]" value="<?php echo $wset['gap_b']; ?>" class="frm_input" size="4"> px - 세로
		</td>
	</tr>
	<tr>
		<td align="center">추출유형</td>
		<td>
			<select name="wset[type]">
				<?php echo apms_item_type_options($wset['type']);?>
			</select>
			추출
			&nbsp;
			<input type="text" name="wset[page]" value="<?php echo $wset['page'];?>" size="3" class="frm_input"> 페이지 자료
		</td>
	</tr>
	<tr>
		<td align="center">분류지정</td>
		<td>
			<input type="text" name="wset[ca_id]" value="<?php echo $wset['ca_id']; ?>" size="20" class="frm_input">
			(분류는 1개만 지정가능, 분류코드 입력)
		</td>
	</tr>
	<tr>
		<td align="center">제외분류</td>
		<td>
			<input type="text" name="wset[ex_ca]" value="<?php echo $wset['ex_ca']; ?>" size="20" class="frm_input">
			(제외분류는 1개만 지정가능, 분류코드 입력)
		</td>
	</tr>
	<tr>
		<td align="center">새아이템</td>
		<td>
			<input type="text" name="wset[newtime]" value="<?php echo ($wset['newtime']);?>" size="4" class="frm_input"> 시간 이내 등록 아이템
			&nbsp;
			색상
			<select name="wset[new]">
				<?php echo apms_color_options($wset['new']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">정렬설정</td>
		<td>
			<select name="wset[sort]">
				<?php echo apms_item_rank_options($wset['sort']);?>
			</select>
			&nbsp;
			랭크표시
			<select name="wset[rank]">
				<option value=""<?php echo get_selected('', $wset['rank']); ?>>표시안함</option>
				<?php echo apms_color_options($wset['rank']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">기간설정</td>
		<td>
			<select name="wset[term]">
				<?php echo apms_term_options($wset['term']);?>
			</select>
			&nbsp;
			<input type="text" name="wset[dayterm]" value="<?php echo $wset['dayterm'];?>" size="4" class="frm_input"> 일전까지 자료(일자지정 설정시 적용)
		</td>
	</tr>
	<tr>
		<td align="center">파트너지정</td>
		<td>
			<?php echo help('파트너아이디를 콤마(,)로 구분해서 복수 등록 가능');?>
			<input type="text" name="wset[pt_list]" value="<?php echo $wset['pt_list']; ?>" size="46" class="frm_input">
			&nbsp;
			<label><input type="checkbox" name="wset[ex_pt]" value="1"<?php echo ($wset['ex_pt']) ? ' checked' : '';?>> 제외하기</label>
		</td>
	</tr>
	<tr>
		<td align="center">캐시사용</td>
		<td>
			<input type="text" name="wset[cache]" value="<?php echo $wset['cache']; ?>" class="frm_input" size="4"> 초 간격으로 캐싱
		</td>
	</tr>
	</tbody>
	</table>
</div>