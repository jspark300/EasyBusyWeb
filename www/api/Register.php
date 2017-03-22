<?
//require("password.php");

$connect = mysqli_connect("localhost","wegit","dlwlqdlwl1!","wegit");

$name = $_POST["name"];
$age = $_POST["age"];
$username = $_POST["username"];
$password = $_POST["password"];

function registerUser() {
	global $connect, $name, $age, $username, $password;
	//$passwordHash = password_hash($password, PASSWORD_DEFAULT);
	$statement = mysqli_prepare($connect, "INSERT INTO user (name,age,username,password) values (?,?,?,?)");
	//mysqli_stmt_bind_param($statement, "siss",$name,$age, $username, $password_hash);
	mysqli_stmt_bind_param($statement, "siss",$name,$age, $username, $password);
	mysqli_stmt_execute($statement);
	mysqli_stmt_close($statement);
}

function usernameAvailable() {
	global $connect, $username;
	$statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username=?");
	mysqli_stmt_bind_param($statement, "s", $username);
	mysqli_stmt_execute($statement);
	mysqli_stmt_store_result($statement);
	$count = mysqli_stmt_num_rows($statement);
	mysqli_stmt_close();
	if($count < 1) {
		return true;
		
	} else {
		return false;
	}
}

$response = array();
$response["success"] = false;

if(usernameAvailable()) {
	registerUser();
	$response["success"] = true;
}

echo json_encode($response);



?>