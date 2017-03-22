<?
include_once('./_common.php');

if($_SESSION['ss_login_site'] == "" && $_SESSION['check_member'] == false)
{
	echo "<script>alert('잘못된 접근입니다');location.href='/shop_list.php';</script>";
	exit;
}
else
	$_SESSION['check_member']= false;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EASYBUSY</title>
	<link href="a_css/default.css" rel="stylesheet" />
	<link href="a_css/common.css" rel="stylesheet" />
	<script src="a_js/jquery-1.11.3.min.js"></script>
	<script src="a_js/common.js"></script>
</head>
<body>
<? include_once('./header.php');?>
	<header class="header2">
		<div class="btn_back"><a href="javascript:history.back();"></a></div>
		<div class="txt_tit">
			<p>계정관리</p>
		</div>
	</header>

	<section class="sign_list">
		<ul>
		<?if($_SESSION['ss_login_site']=="") { ?>
			<li>
				<dl>
					<dt>이메일(아이디)</dt>
					<dd><?=$member[mb_id]?></dd>
				</dl>
				<div class="d2">
					
				</div>
			</li>
		<? } ?>
			<li>
				<dl>
					<dt>닉네임</dt>
					<dd><?=$member[mb_nick]?></dd>
				</dl>
				<div class="d2">
					<a href="mysign_nickname.php">변경</a>
				</div>
			</li>
		<?if($_SESSION['ss_login_site']=="") { ?>

			<li>
				<dl>
					<dt>비밀번호</dt>
					<dd>********</dd>
				</dl>
				<div class="d2">
					<a href="mysign_pw.php">변경</a>
				</div>
			</li>
		<? } ?>

			<li>
				<dl>
					<dt>휴대폰 번호</dt>
					<dd><?=$member[mb_hp]?></dd>
				</dl>
				<div class="d2">
					<!--a href="mysign_cp.php">변경</a-->
				</div>
			</li>
			<li>
				<dl>
					<dt>주소</dt>
					<dd><?=$member[mb_zip1].$member[mb_zip2]?><?=$member[mb_addr1]?> <?=$member[mb_addr2]?> <?=$member[mb_addr3]?></dd>
				</dl>
				<div class="d2">
					<a href="mysign_address.php">변경</a>
				</div>
			</li>
			<?if($_SESSION['ss_login_site']=="") { ?>
			<li>
				<dl>
					<dt>회원탈퇴</dt>
					<dd></dd>
				</dl>
				<div class="d2">
					<a href="mysign_out.php">탈퇴</a>
				</div>
			</li>
			<? } ?>

		</ul>
	</section>
</body>
</html>