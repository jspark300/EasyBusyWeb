<?
function SQL_Injection( $get_String)
{
//	$get_String = Server.HTMLEncode($get_String);
	$get_String = str_replace("'","\'",$get_String);
	$get_String = str_replace("&","&amp;",$get_String);
	$get_String = str_replace("\'","&quot;",$get_String);
	$get_String = str_replace("<","&lt;",$get_String);
	$get_String = str_replace(">","&gt;",$get_String);
	$get_String = str_replace("%","",$get_String);
	$get_String = str_replace("=","",$get_String);
//	$get_String = str_replace("'","''",$get_String);
	$get_String = str_replace(";","''",$get_String);
	$get_String = str_replace("--","",$get_String);
	$get_String = str_replace("select","",$get_String);
	$get_String = str_replace("insert","",$get_String);
	$get_String = str_replace("update","",$get_String);
	$get_String = str_replace("delete","",$get_String);
	$get_String = str_replace("drop","",$get_String);
	$get_String = str_replace("union","",$get_String);
	$get_String = str_replace("and","",$get_String);
	$get_String = str_replace("or","",$get_String);
	$get_String = str_replace("sp_","",$get_String);
	$get_String = str_replace("xp_","",$get_String);
	$get_String = str_replace("@variable","",$get_String);
	$get_String = str_replace("@@variable","",$get_String);
	$get_String = str_replace("exec","",$get_String);
	$get_String = str_replace("sysobject","",$get_String);
	return $get_String;
}
function SQL_Injection2( $get_String)
{
//	$get_String = Server.HTMLEncode(get_String);
	$get_String = str_replace("'","\'",$get_String);
	$get_String = str_replace("\'","&quot;",$get_String);
	$get_String = str_replace("<","&lt;",$get_String);
	$get_String = str_replace(">","&gt;",$get_String);
	$get_String = str_replace("%","",$get_String);
//	$get_String = str_replace("'","''",$get_String);
	$get_String = str_replace(";","''",$get_String);
	$get_String = str_replace("--","",$get_String);
	$get_String = str_replace("select","",$get_String);
	$get_String = str_replace("insert","",$get_String);
	$get_String = str_replace("update","",$get_String);
	$get_String = str_replace("delete","",$get_String);
	$get_String = str_replace("drop","",$get_String);
	$get_String = str_replace("union","",$get_String);
	$get_String = str_replace("and","",$get_String);
	$get_String = str_replace("or","",$get_String);
	$get_String = str_replace("sp_","",$get_String);
	$get_String = str_replace("xp_","",$get_String);
	$get_String = str_replace("@variable","",$get_String);
	$get_String = str_replace("@@variable","",$get_String);
	$get_String = str_replace("exec","",$get_String);
	$get_String = str_replace("sysobject","",$get_String);
	return $get_String;
}
function SQL_Injection3($get_String)
{
	$get_String = str_replace("'","",$get_String);
	$get_String = str_replace("\'","",$get_String);
	$get_String = str_replace("<","",$get_String);
	$get_String = str_replace(">","",$get_String);
	$get_String = str_replace("%","",$get_String);
	$get_String = str_replace(";","",$get_String);
	$get_String = str_replace("--","",$get_String);
	return $get_String;
}

?>