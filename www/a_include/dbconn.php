<?
//******************************************************************************************************
// Eexplanation : 생성자 함수를 이용하여 DB에 접속한다.
// Input Value  : $dbhost, $dbuser, $dbpassword, $dbname, $connect ==> 멤버변수를 받아 사용한다.
//******************************************************************************************************

$dbhost = "localhost";
$dbuser = "wegit"; //MySQL계정 아이디를 입력하십시오
$dbpassword = "dlwlqdlwl1!"; //MySQL계정 비밀번호를 입력하십시오
$dbname = "webit"; //MySQL계정 데이타베이스 이름을 입력하십시오
 

 

$connect = mysql_connect($dbhost,$dbuser ,$dbpassword);
if(!$connect) 
{
   echo("<script>alert('데이타베이스에 연결할 수 없습니다..\\n\\n관리자에게 문의 하여 주십시요');</script>");
   exit;
}else{
  $status = mysql_select_db($dbname,$connect);
  mysql_query(" set names utf8 ");
}

if (!$status) 
{
   mysql_close($connect);
   echo("<script>alert('데이타베이스에 연결할 수 없습니다.\\n\\n관리자에게 문의 하여 주십시요');</script>");
   exit;
}

function clean_xss_tags($str)
{
    $str = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $str);

    $search  = array('"', "'");
    $replace = array('&#34;', '&#39;');

    $str = str_replace($search, $replace, $str);

    return $str;
}
?>
