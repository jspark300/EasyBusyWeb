<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

global $is_admin, $member;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);

$skin_dir = $wname; //위젯명
$list = apms_poll_rows($wset);
$po = $list[0]; //첫번째 설문만

if(!$po['po_id']) return;

?>

<!-- 설문조사 시작 { -->
<style>
	.poll-skin ul { margin:0; padding:0; list-style:none; }
	.poll-skin ul li { line-height:24px; }
	.poll-skin label { font-weight:normal; margin:0; }
	.poll-skin .text { padding:0px 15px; }
	.poll-skin .content-box-bg { padding-top:45px; }
	.poll-skin .content-box-bg .heading i.large.fa { top: -75px; }
</style>
<div class="poll-skin">
	<div class="content-box content-box-bg text-left">
		<div class="heading">
			<a>
				<i class="fa fa-bar-chart circle bg-black large"></i>
				<div style="margin:0px 0px 10px; text-align:left;">
					<strong class="black"><?php echo $po['po_subject'] ?></strong>
				</div>
			</a>
		</div>
		<div class="text">
			<form class="form" name="fpoll" action="<?php echo G5_BBS_URL; ?>/poll_update.php" onsubmit="return fpoll_submit(this);" method="post">
			<input type="hidden" name="po_id" value="<?php echo $po['po_id']; ?>">
			<input type="hidden" name="skin_dir" value="<?php echo $skin_dir; ?>">
			<ul>
				<?php for ($i=1; $i<=9 && $po["po_poll{$i}"]; $i++) {  ?>
				<li><input type="radio" name="gb_poll" value="<?php echo $i ?>" id="gb_poll_<?php echo $i ?>"> <label for="gb_poll_<?php echo $i ?>"><?php echo $po['po_poll'.$i] ?></label></li>
				<?php }  ?>
			</ul>
			<div class="h15"></div>
			<div class="text-center">
				<div class="btn-group">
					<button type="submit" class="btn btn-color btn-sm"><i class="fa fa-check"></i> 투표</button>
					<a class="btn btn-black btn-sm" href="<?php echo G5_BBS_URL;?>/poll_result.php?po_id=<?php echo $po['po_id']; ?>&amp;skin_dir=<?php echo urlencode($skin_dir);?>" target="_blank" onclick="poll_result(this.href); return false;"><i class="fa fa-bar-chart"></i> 결과</a>
					<?php if($is_admin == 'super') { ?>
						<a href="<?php echo G5_ADMIN_URL; ?>/poll_list.php" class="btn btn-black btn-sm"><i class="fa fa-th-large"></i> 관리</a>
					<?php } ?>
				</div>
			</div>
			</form>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<script>
function fpoll_submit(f)
{
    <?php
    if ($member['mb_level'] < $po['po_level'])
        echo " alert('권한 {$po['po_level']} 이상의 회원만 투표에 참여하실 수 있습니다.'); return false; ";
     ?>

    var chk = false;
    for (i=0; i<f.gb_poll.length;i ++) {
        if (f.gb_poll[i].checked == true) {
            chk = f.gb_poll[i].value;
            break;
        }
    }

    if (!chk) {
        alert("투표하실 설문항목을 선택하세요");
        return false;
    }

    var new_win = window.open("about:blank", "win_poll", "width=616,height=500,scrollbars=yes,resizable=yes");
    f.target = "win_poll";

    return true;
}

function poll_result(url)
{
    <?php
    if ($member['mb_level'] < $po['po_level'])
        echo " alert('권한 {$po['po_level']} 이상의 회원만 결과를 보실 수 있습니다.'); return false; ";
     ?>

    win_poll(url);
}
</script>
<!-- } 설문조사 끝 -->