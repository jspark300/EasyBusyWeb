<?
phpinfo();
/*$exchange_url="http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22CNYUSD%22)&format=json&env=store://datatables.org/alltableswithkeys&callback=";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $exchange_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1000);
$rt = curl_exec($ch);
echo $rt;
curl_close($ch);
*/
?>
<?

function getRSS($url){ 
//    $fd = fopen ($url, "r"); 
  //  while (!feof ($fd)) { 
   //     $buffer .= fgets($fd, 4096); 
    //} 
    //fclose ($fd); 
    //return $buffer; 
	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1000);
$rt = curl_exec($ch);

curl_close($ch);
return $rt;
	
} 

function GetHTMLContent($strTag , $content)
{
$qur =sprintf("/\<%s[^>]*\>(.+?)\<\/%s\>/is", $strTag,$strTag);
preg_match($qur,  $content , $match);
return $match[1];

}

function tagListData($strTag, $content)
{
$reg =  sprintf("/\<%s[^>]*\>(.+?)\<\/%s\>/is" , $strTag, $strTag) ;
preg_match_all($reg , $content, $matches , PREG_PATTERN_ORDER );
return $matches[1];
}


// rss 서비스 환율 정보
$url = "http://community.fxkeb.com/fxportal/jsp/RS/DEPLOY_EXRATE/fxrate_all.html";
$content = getRSS($url);
 $SourceList = tagListData('tr' , $content);

//미국 정보 리스트의 4번
//일본 17
//캐나다 6
//중국 23
$ar = tagListData('td',$SourceList[4]);
echo "usd:".$ar[1];
$ar = tagListData('td',$SourceList[7]);
echo "cny:".$ar[1];

//print_r(tagListData('td' , $SourceList[4]));
//추후에 rss 서비로 변경하여 올려놓겠습니다.

/*
$ar = tagListData('td',$SourceList[4]);
echo "usd:".$ar[1];
$usd = $ar[1];
$ar = tagListData('td',$SourceList[7]);
echo "cny:".$ar[1];
$cny = $ar[1];
*/

$ar = tagListData('td',$SourceList[7]);
echo "1000KRW->".round(1000/$ar[6],2)."CNY<br>";
$cny = $ar[6];


$ar = tagListData('td',$SourceList[4]);
echo "1000KRW->".round(1000/$ar[6],2)."USD<br>";
$usd = $ar[6];


//print_r(tagListData('td' , $SourceList[4]));
//추후에 rss 서비로 변경하여 올려놓겠습니다.

if($fs == "1")
{
	if($fs2 == 2)
		$res = round($f_c/$cny,2);
	else if($fs2 == 3)
		$res = round($f_c/$usd,2);
	else
		$res = $f_c;
}
else if($fs == "2")
{
	if($fs2 == 1)
		$res = round($f_c*$cny,2);
	else if($fs2 == 3)
		$res = round($f_c*$cny/$usd,2);
	else
		$res = $f_c;

}
else if($fs == "3")
{
	if($fs2 == 2)
		$res = round($f_c*$usd/$cny,2);
	else if($fs2 == 1)
		$res = round($f_c*$usd,2);
	else
		$res = $f_c;

}

?>
<form name="fwrite" id="fwrite" action="cr.php" method="post" enctype="multipart/form-data" autocomplete="off" role="form" class="form-horizontal">
<select name='fs' id='dong1'>
<option value='2' <?if($fs==2) echo "selected";?>>CNY
<option value='1' <?if($fs==1 || $fs=="") echo "selected";?>>KRW
<option value='3' <?if($fs==3) echo "selected";?>>USD
</select>
<input type="number" name="f_c" value="<?=$f_c?>">
<select name='fs2' id='dong2'>
<option value='2' <?if($fs2==2 || $fs2=="") echo "selected";?>>CNY
<option value='1' <?if($fs2==1) echo "selected";?>>KRW
<option value='3' <?if($fs2==3) echo "selected";?>>USD
</select>
 <input type="number" name="f_to" value="<?=$res?>">

           <button type="submit" id="btn_submit" accesskey="s" class="btn1x"><b>계산</b></button>
</form>







