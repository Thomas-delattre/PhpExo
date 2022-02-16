<?php 

session_start();

if(isset($_GET['logout'])) {
	//logout
	unset($_SESSION['isAdmin']);
}

if (isset($_SESSION['isAdmin'])) {
	header("Location: dashboard.php");
	exit;
}

if(isset($_GET['error_code'])) {
	$code = (int)$_GET['error_code'];
	switch($code) {
		case 1: 
			$error = "Vous n'êtes pas autorisé à entrer";
			break;
	}
}

if (isset($_POST['username']) && isset($_POST['password'])) {
	
	if($_POST['username'] == 'admin' && 
	   $_POST['password'] == 'password') {
		$_SESSION['isAdmin'] = true;
		header("Location: dashboard.php");
	} else {
		$error = "Votre identifiant ou mot de passe est incorrect";
	}
}
?>

<html>
	<head>
	</head>
	<body>
		<h1>Authentification</h1>
		<?php 
		if(isset($error)) {
			echo '<p style="color:white; background-color: red;">' . $error . '</p>';
		}
		?>
		<form action="" method="POST">
			<input type="text" name="username" 
			placeholder="votre identifiant"/>
			<input type="password" name="password" 
			placeholder="votre mot de passe"/>
			
			<input type="submit" value="Se connecter"/>
		</form>
	</body>
</html>