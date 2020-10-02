<?php

if(isset($_POST['delete'])){
        $del="rm -f ".$_POST['delete'];
        exec($del);
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
<form method="POST" action="upload.php" enctype="multipart/form-data">
<input type="file" name="files[]" multiple/>
<input type="submit" name="submit" value="Upload" />
</form>
</div>
<?php
$fileList = glob('uploads/*');

echo "<table><form method='post'>";
foreach($fileList as $filename){
	echo "<tr><td colspan='2'><hr></td></tr>";
	echo "<tr>";
	echo "<td><a href='$filename'>$filename</a></td>";
	echo "<td><button value='$filename' name='delete' type='submit'>Del</button></td>";
	echo "</tr>";
}
echo "</form></table>";
?>
</body>
</html>
