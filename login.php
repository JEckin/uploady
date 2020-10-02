<?php
session_start();

if (isset($_SESSION['lOg1naac'])){
session_destroy();
session_start();
}


if (isset($_POST['login'])){
	if ($_POST['link']!=""){
		header("Location: x/".$_POST['link']);
		die();
	}
        if ($_POST['username']=="user" && $_POST['password']=="password"){
                $_SESSION['lOg1naac']="p1ass";
                header("Location: index.php");
        }
}
?>
<html>
<head>
<title>Login o1u.de</title>
<link rel="stylesheet" href="design.css">
</head>
<body>
<br><br><br><br>
<table align="center"><form action="" method="post">
<tr>
<th colspan="2"><h1>Login</h1></th>
</tr>
<tr><th><br></th></tr>
<tr>
<td colspan="2"><input class="login" type="text" placeholder="Instanz" name="link"></td>
</tr>
<tr><th colspan="2">Oder</th></tr>
<tr>
<th><a class="login">Username:</a></th>
<td><input class="login" type="text" id="username" name="username"></td>
</tr>
<tr>
<th><a class="login">Password:</a></th>
<td><input class="login" type="password" id="password" name="password"></td>
</tr>
<tr>
<th colspan="2"><input class="login" type="submit" name="login" value="Login"></th>
</tr>
</form></table>
</body>
</html>
