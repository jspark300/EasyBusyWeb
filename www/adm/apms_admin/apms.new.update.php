<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');

if($act == 'ok') {

	check_admin_token();

	// 자료가 많을 경우 대비 설정변경
	@ini_set('memory_limit', '-1');

	// 새글 수정하기
	$pa = array();
	$fa = array();
	$ea = array();
	$result = sql_query(" select bn_id, bo_table, wr_id, wr_parent from {$g5['board_new_table']} where 1 order by bn_id desc ", false);
	for ($i=0; $row=sql_fetch_array($result); $i++) {

		$tmp_write_table = $g5['write_prefix'] . $row['bo_table']; 

		if($row['wr_parent'] == $row['wr_id'] ) { //글
			$pa = sql_fetch(" select wr_id, wr_reply, wr_content, wr_datetime, wr_option, wr_comment, wr_hit, wr_good, wr_nogood, wr_link1, wr_link2, (wr_link1_hit + wr_link2_hit) as as_link, as_poll, as_type, as_publish, as_extra, as_re_mb, as_update from $tmp_write_table where wr_id = '{$row['wr_id']}' ", false);
			$fa = sql_fetch(" select sum(bf_download) as download from {$g5['board_file_table']} where bo_table = '{$row['bo_table']}' and wr_id = '{$row['wr_id']}' ", false);
			$ea = sql_fetch(" select count(*) as event from {$g5['apms_event']} where bo_table = '{$row['bo_table']}' and wr_id = '{$row['wr_id']}' ", false);

			$as_secret = (strstr($pa['wr_option'], 'secret')) ? 1 : 0;

			$pa['chk_img'] = true;
			$p_image = apms_wr_thumbnail($row['bo_table'], $pa, 0, 0);

			// 동영상글 체크 - 링크 URL만 체크
			$p_video = false;
			if($pa['wr_link1']) { // Link1
				$p_video = (apms_video($pa['wr_link1'])) ? true : false;
			}

			if($pa['wr_link2'] && !$p_video) { // Link2
				$p_video = (apms_video($pa['wr_link2'])) ? true : false;
			}

			// 글타입정리
			if($p_image && $p_video) { //이미지도 있고, 비디오도 있으면
				$as_list = 3;
			} else if(!$p_image && $p_video) { //이미지 없고, 비디오 있으면
				$as_list = 2;
			} else if($p_image && !$p_video) { //이미지 있고, 비디오 없으면
				$as_list = 1;
			} else { // 모두 없으면
				$as_list = 0;
			}

			// 업데이트
			$sql = " update {$g5['board_new_table']} 
						set as_comment = '{$pa['wr_comment']}',
							as_hit = '{$pa['wr_hit']}',
							as_good = '{$pa['wr_good']}',
							as_nogood = '{$pa['wr_nogood']}',
							as_link = '{$pa['as_link']}',
							as_poll = '{$pa['as_poll']}',
							as_download = '{$fa['download']}',
							as_event = '{$ea['event']}',
							as_secret = '{$as_secret}',
							as_type = '{$pa['as_type']}',
							as_list = '{$as_list}',
							as_publish = '{$pa['as_publish']}',
							as_extra = '{$pa['as_extra']}',
							as_reply = '{$pa['wr_reply']}',
							as_re_mb = '{$pa['as_re_mb']}',
							as_update = '{$pa['as_update']}',
							bn_datetime = '{$pa['wr_datetime']}'
						where bn_id = '{$row['bn_id']}' ";
		} else { //댓글

			$pa = sql_fetch(" select wr_datetime, wr_option, as_lucky, as_re_mb from $tmp_write_table where wr_id = '{$row['wr_id']}' ", false);

			$as_secret = (strstr($pa['wr_option'], 'secret')) ? 1 : 0;

			// 업데이트
			$sql = " update {$g5['board_new_table']} 
						set as_lucky = '{$pa['as_lucky']}',
							as_secret = '{$as_secret}',
							as_re_mb = '{$pa['as_re_mb']}',
							bn_datetime = '{$pa['wr_datetime']}'
						where bn_id = '{$row['bn_id']}' ";
		}

		sql_query($sql, false);	
	}
?>	
    <script type='text/javascript'> 
		alert('새글DB 업데이트 완료했습니다.'); 
		self.close();
	</script>
<?php } else { ?>
	<script src="<?php echo G5_ADMIN_URL ?>/admin.js"></script>
	<form id="defaultform" name="defaultform" method="post" onsubmit="return update_submit(this);">
	<input type="hidden" name="act" value="ok">
	<div style="padding:10px">
		<div style="border:1px solid #ddd; background:#f5f5f5; color:#000; padding:10px; line-height:20px;">
			<b><i class="fa fa-bolt"></i> 새글DB 업데이트</b>
		</div>
		<div style="border:1px solid #ddd; border-top:0px; padding:10px;line-height:22px;">
			<ul>
				<li>복수게시판 정렬/랭킹 자료 등 새글DB에 필요한 정보를 업데이트합니다.</li>
				<li>전체 새글 자료에 자동으로 반영되므로 시간이 걸릴 수 있습니다.</li>
			</ul>
		</div>
		<br>
		<div class="btn_confirm01 btn_confirm">
			<input type="submit" value="실행하기" class="btn_submit" accesskey="s">
		</div>
	</div>
	</form>
	<script>
		function update_submit(f) {
			if(!confirm("실행후 완료메시지가 나올 때까지 기다려 주세요.\n\n정말 실행하시겠습니까?")) {
				return false;	
			} 

			return true;
		}
	</script>
<?php } ?>
<?php include_once(G5_PATH.'/tail.sub.php'); ?>