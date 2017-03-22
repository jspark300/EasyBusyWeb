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
	<section class="s3"  style="margin-top:0px;">
		<ul>
			<li><img src="img/main.png" alt="EASYBUSY" style="width:200px;margin:80px 0px 0px 0px"></li>
		</ul>
	</section>
	<section class="s7" style="margin-bottom:1px;margin-top:50px;">
		<ul  style="width:200px">
			<li style="width:200px"><a href="/shop_list.php?nation=kr&t=<?=time();?>" style="display:inline-block;padding:5px 30px;">들어가기</a><!--a href="/shop_list.php?nation=ti&t=<?=time();?>"  style="display:inline-block;padding:5px 30px;">태국</a--></li>
		</ul>
	</section>
<?
include_once('./_common.php');
?>

	
<? include_once('./footer.php');?>
</body>
</html>