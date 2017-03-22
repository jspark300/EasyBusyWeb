<?
//require("password.php");

$con = mysqli_connect("localhost","wegit","dlwlqdlwl1!","wegit");
$username = $_POST["username"];
$password = $_POST["password"];

$statement = mysqli_prepare($con, "SELECT user_id,name,username,age,password FROM user WHERE username = ?");
mysqli_stmt_bind_param($statement, "s", $username);
mysqli_stmt_execute($statement);

mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $colUserID, $colName, $colUsername, $colAge,  $colPassword);

$response = array();
$response["success"] = false;

while(mysqli_stmt_fetch($statement)) {
	//if(password_verify($password, $colPassword)) {
	if($password == $colPassword) {
		$response["success"] = true;
		$response["name"] = $colName;
		$response["age"] = $colAge;
		$response["username"] = $colUsername;

	}
}

echo json_encode($response);



?>