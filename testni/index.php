<?php
// Session variables login and id is transferred to another page
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<!--Most of CSS is from W3 website. I should probably put CSS in separate file but it works also this way.-->
<style>
input {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
label {
	display:block;
	margin:auto;
	text-align:center;
}
button {
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}
button:hover {
  opacity: 0.8;
}
.main1 {
	margin-left:20%; 
	margin-right:20%;
	width: 60%;
}
.main {
	width: 60%;
}
@media (max-width: 768px) {
    div.left {
        display: none;
    }
	div.right {
        display: none;
    }
	div.main1 {
		margin-left:0%;
		margin-right:0%;
		width:100%;		
    }
	div.main {
		margin-left:0%;
		margin-right:0%;
		width:80%;
    }
}
</style>
</head>
<title>Poruke</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<!--Establish database connection-->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evolt1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$_SESSION["login"] = 0;

// Create random six-character long username for all users
// A is 65 ASCII
// Z is 90 ASCII
// a is 97 ASCII
// z is 122 ASCII
$id = '';
$shfl = 0;
for ($x = 0; $x <= 6; $x++) {
	$shfl = rand(0,2);
	if($shfl == 0) 
	{
		$id .= chr(rand(65,90));
	} 
	elseif ($shfl == 1) 
	{
		$id .= chr(rand(48,57));
	} 
	else 
	{
		$id .= chr(rand(97,122));
	}
}
?>

<!-- Sidebars left and right-->
<div class="left w3-sidebar w3-light-grey w3-bar-block" style="width:20%">
</div>

<div class="right w3-sidebar w3-light-grey w3-bar-block" style="width:20%;right:0;">
</div>
<!-- Page Content -->
<div class="main1">
	<div class="main w3-container w3-amber" style="width: 100%; z-index:10;">
		<h2 class="w3-container" style="text-align:center">Prijava</h2> 
	</div>
	<!--Form copied from website below. CSS is bit altered to match style of website.
		Form is processed on the same page.
	<!-- https://www.w3schools.com/howto/howto_css_login_form.asp -->
	<form action="index.php" method="post">
		<div class="w3-container" style="width:60%; margin:auto;">
			<label for="fname">First Name</label>
			<input maxlength="20" type="text" placeholder="First name" name="fname" required>
			
			<label for="lname">Last Name</label>
			<input maxlength="20" type="text" placeholder="Last name" name="lname" required>

			<label for="psw">Password</label>
			<input maxlength="20" type="password" placeholder="Password" name="psw" required>
			
			<br><br><br>
			<button class="w3-amber" type="submit">Login</button>
		</div>
	</form>
</div>

</body>
<!--Create new user in the database or check if user exists and proceed to main page-->
<?php
$firstName = "";
$lastName = "";
$password = "";

$_SESSION["id"] = $id;
		
if ($_SERVER["REQUEST_METHOD"] == "POST" && ($_POST["fname"] != "") && 
($_POST["lname"] != "") && ($_POST["psw"] != "")) {
	$firstName = $_POST["fname"];
	$lastName = $_POST["lname"];
	$password = $_POST["psw"];
	
	echo $firstName . "<br>";
	echo $lastName . "<br>";
	echo $password;
	
	$sql = "INSERT INTO account (userId, name, surname, password) VALUES ('$id', '$firstName', '$lastName', '$password')";
	$result = $conn->query($sql);
	$sql2 = "SELECT * FROM account WHERE name='$firstName' AND surname='$lastName' AND password='$password'";
	$result2 = $conn->query($sql2);
	$num_rows = $result2->num_rows;
	if($num_rows != 0) {
		$row = $result2->fetch_assoc();
		$_SESSION["id"] = $row["userId"];	
	}
	$_SESSION["login"] = 1;
	header('Location: action.php');
}	
?>
</html>