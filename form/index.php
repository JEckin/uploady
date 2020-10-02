<?php
session_start();

if(isset($_POST['delete'])){
	$del="rm -rf ".$_POST['delete'];
	exec($del);
}

if(isset($_GET['f'])){
	$_SESSION['folder']=$_SESSION['folder'].$_GET['f']."/";
	header("Location: .");
	die();
}
if(isset($_GET['b'])){
	$_SESSION['folder']="./uploads/";
	header("Location: .");
	die();
}
if(!isset($_SESSION['folder'])){
	$_SESSION['folder']="./uploads/";
}

echo "Ordner: ".$_SESSION['folder'];

if(isset($_POST['sordner'])){
	$add="mkdir ".$_SESSION['folder'].$_POST['ordner'];
	exec($add);
}

if(isset($_POST['submit'])){
	foreach ($_FILES['files']['tmp_name'] as $key => $value){
		$upload_dir = 'uploads'.DIRECTORY_SEPARATOR;
		$fileTmpPath = $_FILES['files']['tmp_name'][$key];
		$fileName = $_FILES['files']['name'][$key];
		$fileSize = $_FILES['files']['size'][$key];
		$fileType = $_FILES['files']['type'][$key];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));
		$notallowed = array('html', 'php');
		$uploadFileDir = $_SESSION['folder'];
		if (!in_array($fileExtension,$notallowed)){
			$dest_path = $uploadFileDir . $fileName;
			if(file_exists($dest_path)) {
        	        	$dest_path = $upload_dir.time().$fileName;
			}
			if(move_uploaded_file($fileTmpPath, $dest_path)){
			        $message ='Erfolgreich hochgeladen!';
			}
			else{
			        $message = 'Error!';
			}
		}
		$_SESSION['message'] = $message;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="design.css">
<title>Upload</title>
</head>
<body>
<div>
<form method="POST" name='file' enctype="multipart/form-data">
<a href="uploads" id='lfolder'>Ordner</a>
<input type="file" name="files[]" id='fileup' multiple/>
<input type="submit" name="submit" value="Upload"/>

</form><form method="POST">
<input type="text" name="ordner">
<input type="submit" name="sordner" value="Ordner Hinzufügen">
</form>
</div>
<?php
$fileList = glob($_SESSION['folder'].'*');
echo "<table><form method='post'>";
echo "<tr><td colspan='2'><a href='?b=yes'>Zurück</a></td></tr>";
foreach($fileList as $filename){
	$filep = pathinfo($filename);
	echo "<tr><td colspan='2'><hr></td></tr>";
	echo "<tr style='width:100%;'>";
	if(isset($filep['extension'])){
		echo "<td style='widht:50%;text-align:left;'><a href='$filename'>".$filep['basename']."</a></td>";
	}else{
		echo "<td style='width:50%;text-align:left;'><a href='?f=".$filep['filename']."'>".$filep['filename']."</a></td>";
	}
	echo "<td style='width:50%;text-align:left'><button value='$filename' name='delete' type='submit'>Del</button></td>";
	echo "</tr>";
}
echo "</form></table>";
?>
</body>
</html>
