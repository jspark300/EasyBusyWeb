<?
//******************************************************************************************************
// Eexplanation : ������ �Լ��� �̿��Ͽ� DB�� �����Ѵ�.
// Input Value  : $dbhost, $dbuser, $dbpassword, $dbname, $connect ==> ��������� �޾� ����Ѵ�.
//******************************************************************************************************

$dbhost = "localhost";
$dbuser = "wegit"; //MySQL���� ���̵� �Է��Ͻʽÿ�
$dbpassword = "dlwlqdlwl1!"; //MySQL���� ��й�ȣ�� �Է��Ͻʽÿ�
$dbname = "webit"; //MySQL���� ����Ÿ���̽� �̸��� �Է��Ͻʽÿ�
 

 

$connect = mysql_connect($dbhost,$dbuser ,$dbpassword);
if(!$connect) 
{
   echo("<script>alert('����Ÿ���̽��� ������ �� �����ϴ�..\\n\\n�����ڿ��� ���� �Ͽ� �ֽʽÿ�');</script>");
   exit;
}else{
  $status = mysql_select_db($dbname,$connect);
  mysql_query(" set names utf8 ");
}

if (!$status) 
{
   mysql_close($connect);
   echo("<script>alert('����Ÿ���̽��� ������ �� �����ϴ�.\\n\\n�����ڿ��� ���� �Ͽ� �ֽʽÿ�');</script>");
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
