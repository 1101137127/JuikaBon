<?php

$field_file = $_FILES['file'];
$filename=$_FILES['file']['name'];
$tmpname=$_FILES['file']['tmp_name'];
$filetype=$_FILES['file']['type'];
$filesize=$_FILES['file']['size'];
if (move_uploaded_file($_FILES['file']['tmp_name'], 'test/' . $_FILES["file"]['name'])) {
    echo "Uploaded";
} else {
   echo "File was not uploaded";
}

 ?>

