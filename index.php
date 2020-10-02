<?php
session_start();

if (!isset($_SESSION['lOg1naac'])){
	header("Location: login.php");
	die();
}

if(isset($_POST['delete'])){
        $del="rm -fr ".$_POST['delete'];
        exec($del);
}

if(isset($_GET['name'])){
	$do="mkdir x/".$_GET['name'];
	exec($do);
	$do="cp -r form/* x/".$_GET['name']."/";
	exec($do);
	header("Location:  x/".$_GET['name']);
	die();
}
?>
<html>
<head>
<title>Upload Instanzen</title>
<link rel="stylesheet" href="index.css">
</head>
<body>
<div>
<form method="get">
Instanze erstellen
<input type="text" placeholder="Name" name="name">
<input type="submit" value="Erstellen">
</div>
</form>
<div>
<?php
$fileList = glob('x/*');

echo "<table><form method='post'>";
foreach($fileList as $filename){
	if ($filename!="x/index.php"){
		$filep = pathinfo($filename);
        	echo "<tr><td colspan='2'><hr></td></tr>";
       		echo "<tr style='width:100%'>";
        	echo "<td style='width:50%;text-align:right'><a href='$filename'>".$filep['filename']."</a></td>";
        	echo "<td style='width:50%;text-align:right'><button value='$filename' name='delete' type='submit'>Del</button></td>";
        	echo "</tr>";
	}
}
echo "</form></table>";
?>
</div>
</body>
</html>
