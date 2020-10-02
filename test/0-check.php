<?php
// GET
echo ini_get("file_uploads");
echo ini_get("upload_max_filesize");
echo ini_get("post_max_size");

/* THESE WILL NOT WORK!
ini_set("upload_max_filesize", "10M");
ini_set("post_max_size", "10M");*/
?>