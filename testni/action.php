<?php
session_start();
//If user traverses to this page without login, back him to login
if($_SESSION["login"] == 0)
	header('Location: index.php');
?>
<!DOCTYPE html>
<html>
<head>
<style>
<!--Again, most CSS is modification of W3 code snippets-->
article.solid {
	border-bottom: solid;
}
button {
	right:20%;
	box-sizing: border-box; 
	border: 2px solid #ccc; 
	border-radius: 4px; 
	background-color: #f8f8f8;
	font-size: 16px;
	position:fixed; 
	bottom:1px;
	margin-left:50%;
	width:10%;
	height:20%;
	z-value:15;
}
textarea {
	position:fixed;
	z-index:3;
	bottom:1px;
	width: 50%;
	height: 20%;
	margin:-16px;
	box-sizing: border-box;
	border: 2px solid #ccc;
	border-radius: 4px;
	background-color: #f8f8f8;
	font-size: 16px;
	resize: none;
}
.main1 {
	margin-left:20%; 
	margin-right:20%;
	width: 60%;
}
.main {
	width: 60%;
}
.messages {
	margin-bottom:20%;
}
article:first-child {
	margin-top:15%;
}	
@media (max-width: 768px) {
    div.left {
        display: none;
    }
	div.main1 {
		margin-left:0%;
		margin-right:0%;
		width:80%;		
    }
	div.main {
		margin-left:0%;
		margin-right:0%;
		width:80%;
    }
	textarea {
		width:60%;
	}
	button {
		width:20%;
	}
	div > h4 {
		display:block !important;
	}
}
</style>
</head>
<title>Poruke</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
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

?>

<!-- Sidebars again the same, just with some text -->
<div class="left w3-sidebar w3-light-grey w3-bar-block" style="width:20%">
	<h4 class="w3-bar-item">Tvoje ime: <?php echo $_SESSION["id"];?></h4>
</div>

<div class="right w3-sidebar w3-light-grey w3-bar-block" style="width:20%;right:0;">
	<h4 class="w3-bar-item" style="display:none;"><?php echo $_SESSION["id"]?></h4>
	<h4 class="w3-bar-item">Aktivni korisnici</h4>
		<!--List users at sidebar-->
		<?php
			$sql0 = "SELECT userId FROM account";
			$result0 = $conn->query($sql0);

			while ($row0 = $result0->fetch_assoc()) {
		?>
		<a style="display:block; text-align:center"><?php echo $row0["userId"];?></a><br>
		<?php 
			}	
		?>	
</div>
<!-- Messages -->
<div class="main1">
	<div class="main w3-container w3-amber" style="position:fixed;z-index:10;">
		<h2 class="w3-container">Moja stranica</h2> 
	</div>
	<div class="messages w3-container">
		
		<?php
			$sql = "SELECT * FROM message ORDER BY date DESC";
			$result = $conn->query($sql);
		?>
		<?php
			while ($row = $result->fetch_assoc()) {
		?>
		<article class="w3-container solid">
			<h4><?= $row["writer"];?> / <?= $row["date"];?></h4> 
			<p><?= $row["text"];?></p>
		</article>
		<?php 
			}
			
		?>	
		<div style="margin:-16px; position:fixed; height:10%; z-index:10;">
		<?php 
			$message="";
		?>
		<form method="post" action="action.php">
			<textarea class="w3-container" maxlength="255" id="message" name="message" placeholder="Maksimalno 255 znakova"></textarea>
			<button type="submit" id="demo">Pošalji</button>
		</form>
		<?php $message = $_POST['message'];?>
	</div>
</div>

</body>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST") && ($message != "")) {
	$id = $_SESSION["id"];
	$message = $_POST["message"];
	date_default_timezone_set("Europe/Sarajevo");
	$date1 = date("Y-m-d H:i:s, time()");
	echo $date1;
	$sql2 = $conn->query("SELECT * FROM user WHERE userId IN ('$str')");
	$num_rows = $sql2->num_rows;
	echo $num_rows;
	/*
	if($num_rows == 0) {
		$sql3 = "INSERT INTO user (userId) VALUES ('$str')";
		$result3 = $conn->query($sql3);
	}
	*/
	$sql4 = "INSERT INTO message (text, writer, date) VALUES ('$message','$id', '$date1')";
	$result4 = $conn->query($sql4);
	$message = "";
	header("Refresh:0");
}
$conn->close();

?>
</html>