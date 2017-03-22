<?php
include_once('./_common.php');

$rows = 100;

if($sido==""  || $gugun=="" || $dong=="" || $it_name == "")
{
	echo "지역선택 및 검색어가 없습니다.";
}
else
{
	echo "start<br>";
		$total_count = search_count($sido,$gugun,$dong,$it_name);
		$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
		for($i=1; $i<=$total_page; ++$i)
		{
			search_com($sido,$gugun,$dong,$it_name,$i);
			echo $sido.$gugun.$dong.$it_name." page:".$i."<br>";
		}
}
echo "end";


function search_count($sido,$gugun,$dong,$qstr)
{
	$url = "http://openapi.naver.com/search?key=e95c655d8483f641edf896d08ad5fea4&query=".$sido.$gugun.$dong.$qstr."&display=1&start=1&target=local";
    $curl = curl_init();
     
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
 
    // execute and return string (this should be an empty string '')
    $str = curl_exec($curl);
	
    curl_close($curl);
	$xml = simplexml_load_string($str); 

	$total_count = $xml->channel->total;
	if($total_count>1000)
		$total_count = 1000;
	echo "total: ".$total_count." 개 저장되었습니다.<br>";
	return $total_count;
}

function search_com($sido,$gugun,$dong,$qstr,$page)
{
	$start = ($page-1)*100+1;

	$url = "http://openapi.naver.com/search?key=e95c655d8483f641edf896d08ad5fea4&query=".$sido.$gugun.$dong.$qstr."&display=100&start=".$start."&target=local";
    $curl = curl_init();
     
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
 
    // execute and return string (this should be an empty string '')
    $str = curl_exec($curl);
	
    curl_close($curl);
	$xml = simplexml_load_string($str); 

	$total_count = $xml->channel->total;

	$count = count($xml->channel->item);
	for ($i=0; $i<$count; $i++) {
		$xml->channel->item[$i]->title = str_replace("<b>","",$xml->channel->item[$i]->title);
		$xml->channel->item[$i]->title = str_replace("</b>","",$xml->channel->item[$i]->title);
		$xml->channel->item[$i]->description = str_replace("<b>","",$xml->channel->item[$i]->description);
		$xml->channel->item[$i]->description = str_replace("</b>","",$xml->channel->item[$i]->description);
		$xml->channel->item[$i]->description = str_replace("'","\'",$xml->channel->item[$i]->description);

		$sql = "select seq,qstr from b_company where title='".$xml->channel->item[$i]->title."' and telephone='".$xml->channel->item[$i]->telephone."' and mapx='".$xml->channel->item[$i]->mapx."' and mapy='".$xml->channel->item[$i]->mapy."'";
		$res = sql_fetch($sql);
		if($res['seq'] == "")
		{	$sql = "insert into b_company (title,category,description,telephone,address,roadAddress,mapx,mapy,qstr,sido,gugun,dong,page) values (
			'".$xml->channel->item[$i]->title."',
			'".$xml->channel->item[$i]->category."',
			'".$xml->channel->item[$i]->description."',
			'".$xml->channel->item[$i]->telephone."',
			'".$xml->channel->item[$i]->address."',
			'".$xml->channel->item[$i]->roadAddress."',
			'".$xml->channel->item[$i]->mapx."',
			'".$xml->channel->item[$i]->mapy."',
			'".$qstr."',
			'".$sido."',
			'".$gugun."',
			'".$dong."',
			'".$page."'
			)";
			sql_query($sql);
		}
		else
		{
			if(strpos($res['qstr'],$qstr) !== false)
			{

			}
			else
			{
				$sql = "update b_company set qstr = concat(qstr,'|".$qstr."') where seq='".$res['seq']."'";
				sql_query($sql);
			}
		}
	}
}
// 다음순서 검색어로 자동셋팅
$sql = "select title from b_cat where seq = (select seq+1 from b_cat where title='".$it_name."')";
$cat = sql_fetch($sql);
$it_name = $cat['title'];
?>
<br>
<script>
function go()
{
	location.href = "search_com.php?sido=<?=$sido?>&gugun=<?=$gugun?>&dong=<?=$dong?>&it_name=<?=$it_name?>";
}
</script>


<input type="button" name="back" value="back" onclick="javascript:go();" style="width:200px;height:50px;">
<br>back 누르면 자동으로 다음 검색어로 설정됩니다.
