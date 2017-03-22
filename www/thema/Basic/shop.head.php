<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
if($is_demo) @include_once(THEMA_PATH.'/assets/demo.php'); // 데모
include_once(THEMA_PATH.'/assets/thema.php');
include_once(THEMA_PATH.'/sidebar.php'); // 사이드바

?>

<div class="wrapper <?php echo $at_set['font'];?><?php echo (G5_IS_MOBILE) ? ' mobile-font' : '';?> <?php echo $at_set['layout'];?>">
	<!-- LNB -->
	<aside>
		<div class="<?php echo $at_set['lnb'];?> at-lnb">
			<div class="container">
				<nav class="at-lnb-icon hidden-xs">
					<ul class="menu">
						<li>
							<a href="javascript://" onclick="this.style.behavior = 'url(#default#homepage)'; this.setHomePage('<?php echo $at_href['home'];?>');" class="at-tip" data-original-title="<nobr>시작페이지</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true">
								<i class="fa fa-bug fa-lg"></i><span class="sound_only">시작페이지</span>
							</a>
						</li>
						<li>
							<a href="javascript://" onclick="window.external.AddFavorite(parent.location.href,document.title);" class="at-tip" data-original-title="<nobr>북마크</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true">
								<i class="fa fa-bookmark-o fa-lg"></i><span class="sound_only">북마크</span>
							</a>
						</li>
						<li>
							<a href="<?php echo $at_href['rss'];?>" target="_blank" data-original-title="<nobr>RSS 구독</nobr>" class="at-tip" data-toggle="tooltip" data-placement="bottom" data-html="true">
								<i class="fa fa-rss fa-lg"></i><span class="sound_only">RSS 구독</span>
							</a>
						</li>
					</ul>
				</nav>

				<nav class="at-lnb-menu">
					<ul class="menu">
						<?php if($is_member) { ?>
							<li class="asideButton cursor"><a><i class="fa fa-user"></i><?php echo $member['mb_nick'];?></a></li>
							<?php if($member['response']) { ?>
								<li>
									<a href="<?php echo $at_href['response'];?>" target="_blank" class="win_memo">
										<i class="fa fa-retweet"></i>반응 <span class="count red"><?php echo number_format($member['response']);?></span>
									</a>
								</li>
							<?php } ?>
							<?php if($member['memo']) { ?>
								<li>
									<a href="<?php echo $at_href['memo'];?>" target="_blank" class="win_memo">
										<i class="fa fa-envelope-o"></i>쪽지 <span class="count blue"><?php echo number_format($member['memo']);?></span>
									</a>
								</li>
							<?php } ?>
							<?php if($member['admin']) {?>
								<li><a href="<?php echo G5_ADMIN_URL;?>"><i class="fa fa-cog"></i>관리</a></li>
							<?php } ?>
							<li>
								<a href="<?php echo $at_href['logout'];?>">
									<i class="fa fa-power-off"></i><span class="hidden-xs">로그아웃</span>
								</a>
							</li>
						<?php } else { ?>
							<li  class="asideButton cursor"><a><i class="fa fa-power-off"></i>로그인</a></li>
							<li><a href="<?php echo $at_href['reg'];?>"><i class="fa fa-sign-in"></i><span class="hidden-xs">회원</span>가입</a></li>
							<li><a href="<?php echo $at_href['lost'];?>" class="win_password_lost"><i class="fa fa-search"></i>정보찾기</a></li>
						<?php } ?>
						<li class="hidden-xs"><a href="<?php echo $at_href['connect'];?>"><i class="fa fa-comments" title="현재 접속자"></i><?php echo number_format($stats['now_total']); ?><?php echo ($stats['now_mb'] > 0) ? '(<span class="count orangered">'.number_format($stats['now_mb']).'</span>)' : ''; ?></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</aside>

	<header>
		<!-- Logo -->
		<div class="at-header">
			<div class="container">
				<?php // 로고 및 검색창 위치는 아래 padding-left 값으로 조정하시면 됩니다. ?>
				<div class="header-container" style="padding-left:27%;">
					<div class="header-logo text-center pull-left">
						<a href="<?php echo $at_href['home'];?>">
							ALLYALL
						</a>
						<div class="header-desc">
							세상의 모든 동맹
						</div>
					</div>

					<div class="header-search pull-left">
						<form name="tsearch" method="get" onsubmit="return tsearch_submit(this);" role="form" class="form">
						<input type="hidden" name="url"	value="<?php echo $at_href['isearch'];?>">
							<div class="input-group input-group-sm">
								<input type="text" name="stx" class="form-control input-sm" value="<?php echo $stx;?>">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-black"><i class="fa fa-search fa-lg"></i></button>
								</span>
							</div>
						</form>
						<?php echo apms_widget('basic-item-newsticker', 'shop-newsticker', 'interval=4000 new=red icon={아이콘:heart}'); // 뉴스티커 ?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		<div class="navbar <?php echo $at_set['menu'];?> at-navbar" role="navigation">

			<div class="text-center navbar-toggle-box">
				<button type="button" class="navbar-toggle btn btn-dark pull-left" data-toggle="collapse" data-target=".navbar-collapse">
					<i class="fa fa-bars"></i> <span class="font-12">MENU</span>
				</button>

				<div class="pull-right">
					<?php if(IS_YC) { // 영카트 이용시 ?>
						<a href="<?php echo $at_href['change'];?>" class="btn btn-dark">
							<?php if(IS_SHOP) { // 쇼핑몰일 때 ?>
								<i class="fa fa-users"></i>
								<span class="font-12">업체정보</span>
							<?php } else { // 커뮤니티일 때 ?>
								<i class="fa fa-shopping-cart"></i>
								<span class="font-12">SHOP</span>
							<?php } ?>
						</a>
					<?php } ?>	
					<button type="button" class="navbar-toggle btn btn-dark asideButton">
						<i class="fa fa-outdent"></i>
					</button>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="container">
				<!-- Right Menu -->
				<div class="hidden-xs pull-right navbar-menu-right">
					<?php if(IS_YC) { // 영카트 이용시 ?>
						<a href="<?php echo $at_href['change'];?>" class="btn btn-dark">
							<?php if(IS_SHOP) { // 쇼핑몰일 때 ?>
								<i class="fa fa-users"></i>
								<span class="font-12">업체정보</span>
							<?php } else { // 커뮤니티일 때 ?>
								<i class="fa fa-shopping-cart"></i>
								<span class="font-12">SHOP</span>
							<?php } ?>
						</a>
					<?php } ?>	
					<button type="button" class="btn btn-dark asideButton">
						<i class="fa fa-outdent"></i>
					</button>
				</div>
				<!-- Left Menu -->
				<div class="navbar-collapse collapse">
					<h4 class="visible-xs en lightgray" style="margin:0px; padding:10px 15px; line-height:30px;">
						<span class="cursor" data-toggle="collapse" data-target=".navbar-collapse">
							<i class="fa fa-arrow-circle-left fa-lg"></i> Close
						</span>
					</h4>
					<ul class="nav navbar-nav">
						<li<?php echo ($is_index) ? ' class="active"' : '';?>>
							<a href="<?php echo $at_href['main'];?>">메인</a>
						</li>
						<?php for ($i=1; $i < count($menu); $i++) { //메뉴출력 - 1번부터 출력?>
							<?php if($menu[$i]['is_sub']) { //서브메뉴가 있을 때 ?>
								<li class="dropdown<?php echo ($menu[$i]['on'] == "on") ? ' active' : '';?>">
									<a href="<?php echo $menu[$i]['href'];?>" class="dropdown-toggle" <?php echo(G5_IS_MOBILE) ? 'data-toggle="dropdown"' : 'data-hover="dropdown"';?> data-close-others="true"<?php echo $menu[$i]['target'];?>>
										<?php echo $menu[$i]['name'];?><i class="fa fa-circle <?php echo $menu[$i]['new'];?>"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-head<?php echo $pc_menu;?>">
										<ul class="pull-left">
										<?php 
											$smw1 = 1; //나눔 체크
											for($j=0; $j < count($menu[$i]['sub']); $j++) { 
										?>
											<?php if($menu[$i]['sub'][$j]['sp']) { //나눔 ?>
												</ul>
												<ul class="pull-left">
											<?php $smw1++; } // 나눔 카운트 ?>
											<?php if($menu[$i]['sub'][$j]['line']) { //구분라인 ?>
												<li class="line"><a><?php echo $menu[$i]['sub'][$j]['line'];?></a></li>
											<?php } ?>
											<?php if(!G5_IS_MOBILE && $menu[$i]['sub'][$j]['is_sub']) { //모바일이 아니고 서브메뉴가 있을 때 ?>
												<li class="dropdown-submenu<?php echo ($menu[$i]['sub'][$j]['on'] == "on") ? ' sub-on' : ' sub-off';?>">
													<a tabindex="-1" href="<?php echo $menu[$i]['sub'][$j]['href'];?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
														<?php echo $menu[$i]['sub'][$j]['name'];?><i class="fa fa-circle sub-<?php echo $menu[$i]['sub'][$j]['new'];?>"></i>
														<i class="fa fa-caret-right sub-caret pull-right"></i>
													</a>
													<div class="dropdown-menu dropdown-menu-sub hidden-xs<?php echo $pc_menu;?>">
														<ul class="pull-left">
														<?php 
															$smw2 = 1; //나눔 체크
															for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { 
														?>
															<?php if($menu[$i]['sub'][$j]['sub'][$k]['sp']) { //나눔 ?>
																</ul>
																<ul class="pull-left">
															<?php $smw2++; } // 나눔 카운트 ?>
															<?php if($menu[$i]['sub'][$j]['sub'][$k]['line']) { //구분라인 ?>
																<li class="line-sub"><a><?php echo $menu[$i]['sub'][$j]['sub'][$k]['line'];?></a></li>
															<?php } ?>
															<li class="<?php echo ($menu[$i]['sub'][$j]['sub'][$k]['on'] == "on") ? 'sub-on' : 'sub-off';?>">
																<a tabindex="-1" href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>><?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?></a>
															</li>
														<?php } ?>
														</ul>
														<?php $smw2 = ($smw2 > 1) ? 200 * $smw2 : 0; //서브메뉴 너비 ?>
														<div class="clearfix hidden-xs"<?php echo ($smw2) ? ' style="width:'.$smw2.'px;"' : '';?>></div>
													</div>
												</li>
											<?php } else { //서브메뉴가 없을 때 ?>
												<li class="<?php echo ($menu[$i]['sub'][$j]['on'] == "on") ? 'sub-on' : 'sub-off';?>">
													<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
														<?php echo $menu[$i]['sub'][$j]['name'];?><i class="fa fa-circle <?php echo $menu[$i]['sub'][$j]['new'];?>"></i>
													</a>
												</li>
											<?php } ?>
										<?php } ?>
										</ul>
										<?php $smw1 = ($smw1 > 1) ? 200 * $smw1 : 0; //서브메뉴 너비 ?>
										<div class="clearfix hidden-xs"<?php echo ($smw1) ? ' style="width:'.$smw1.'px;"' : '';?>></div>
									</div>
								</li>
							<?php } else { //서브메뉴가 없을 때 ?>
								<li<?php echo ($menu[$i]['on'] == "on") ? ' class="active"' : '';?>>
									<a href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
										<?php echo $menu[$i]['name'];?><i class="fa fa-circle <?php echo $menu[$i]['new'];?>"></i>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="navbar-menu-bar"></div>
		</div>
		<div class="clearfix"></div>
	</header>

	<?php if($page_title) { // 페이지 타이틀 ?>
		<div class="page-title">
			<div class="container">
				<h2><?php echo ($bo_table) ? '<a href="'.G5_BBS_URL.'/board.php?bo_table='.$bo_table.'"><span>'.$page_title.'</span></a>' : $page_title;?></h2>
				<?php if($page_desc) { // 페이지 설명글 ?>
					<ol class="breadcrumb hidden-xs">
						<li class="active"><?php echo $page_desc;?></li>
					</ol>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

	<?php if($col_name) { ?>
		<div class="at-content">
			<div class="container">
			<?php if($col_name == "two") { ?>
				<div class="row">
					<div class="col-md-<?php echo $col_content;?><?php echo ($at_set['side']) ? ' pull-right' : '';?> contentArea">		
			<?php } ?>
	<?php } ?>
