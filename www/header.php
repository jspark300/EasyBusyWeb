<?
include_once('./_common.php');
$loc = $_COOKIE['location'];

if($loc != "")
{
	$loc = unescape($loc);
	$ar = explode("|",$loc);
	if(count($ar)==4)
	{
		$loc = $ar[0];
		$lon = $ar[1];
		$lat = $ar[2];
//		$where .= " and lon>$lon-0.025 and lon<$lon+0.025 and lat>$lat-0.025 and lat<$lat+0.025 ";

	}
}
function unescape($source)
{
    $decodedStr = '';
    $pos        = 0;
    $len        = strlen($source);
    while ($pos < $len) {
        $charAt = substr($source, $pos, 1);
        if ($charAt == '%') {
            $pos++;
            $charAt = substr($source, $pos, 1);
            if ($charAt == 'u') {
                // we got a unicode character
                $pos++;
                $unicodeHexVal = substr($source, $pos, 4);
                $unicode       = hexdec($unicodeHexVal);
                $entity        = '&#' . $unicode . ';';
                $decodedStr .= utf8_encode($entity);
                $pos += 4;
            }
            else {
                // we have an escaped ascii character
                $hexVal = substr($source, $pos, 2);
                $decodedStr .= chr(hexdec($hexVal));
                $pos += 2;
            }
        } else {
            $decodedStr .= $charAt;
            $pos++;
        }
    }
    return $decodedStr;
}

if($c1=="")
	$c1 = 0;

?>
<?php  include_once("analyticstracking.php") ?>
	<header class="header1">
		<div class="d1">
			<h1><a href="shop_list.php?c1=<?//=$c1?>"  ><img src="images/logo.png" alt="EASYBUSY"></a></h1>
			<p style='float:left;width:100px;text-align:center;margin:12px 0 0 0;font-size:11px;'><?=$loc?></p>
			<nav>
				<ul class="btn_wrap">
					
					<li><a href="search.php" class="search">검색</a></li>
					<li><a href="locate.php" class="locate">위치</a></li>
					<li><a href="my_index.php" class="menu">메뉴</a></li>
				</ul>
			</nav>
		</div>
		<!--div class="search_wrap1 dp_none">
			<p><input type="search" placeholder="검색어 입력"></p> <a href="#1">검색</a>
		</div-->
	</header>
