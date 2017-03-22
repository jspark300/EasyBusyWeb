<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EASYBUSY</title>
	<link href="a_css/default.css" rel="stylesheet" />
	<link href="a_css/common.css" rel="stylesheet" />
	<?php  include_once("analyticstracking.php") ?>	
</head>
<body class="intro">
	<header class="header1">
		<div class="d1">
			<h1> </h1>
			<nav>
				<ul class="btn_wrap">
					<li><a href="search.php" class="search">검색</a></li>
					<li><a href="locate.php" class="locate">위치</a></li>
					<li><a href="my_index.php" class="menu">메뉴</a></li>
				</ul>
			</nav>
		</div>
		<div class="search_wrap1 dp_none">
			<p><input type="search" placeholder="검색어 입력"></p> <a href="#1">검색</a>
		</div>
	</header>

	<section class="s3">
		<ul>
			<li><a href="shop_list.php?t=<?=time();?>" style="font-size:45px;margin:80px 60px 50px 60px"><img src="img/main.png" alt="EASYBUSY"></a></li>
		</ul>
	</section>
<?
include_once('./_common.php');
 if (!$is_member) { ?>
	<section class="s6">
	
		<ul>
			<li><span></span><a href="member_login.php">로그인</a></li>
			<li><span></span><a href="/shop_list.php?t=<?=time();?>">들어가기</a></li>
		</ul>
	</section>
<? } else { ?>
	<section class="s7">
		<ul>
			<li><span></span><a href="/shop_list.php?t=<?=time();?>">들어가기</a></li>
		</ul>
	</section>

<? } ?>
	
<? include_once('./footer.php');?>
</body>
</html>