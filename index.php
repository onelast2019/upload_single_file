

<?php


if ($_SERVER['REQUEST_METHOD']=='POST') {
  //get uploaded files info into variables
  $name=$_FILES['my_file']['name'];
  $type=$_FILES['my_file']['type'];
  $error=$_FILES['my_file']['error'];
  $size=$_FILES['my_file']['size'];
  $tmp_name=$_FILES['my_file']['tmp_name'];
  //echo file info
  // echo $name."<br>";
  // echo $type."<br>";
  // echo $error."<br>";
  // echo $size."<br>";
  // echo $tmp_name."<br>";
  /*getting file extension using explode and then
  getting last element of the array in case of
  more than one '.' and converting to lower case*/
  $exploded_name=explode('.',$name);
  $ext=strtolower(end($exploded_name));
  $allowed_file_types=array('jpg','jpeg','png','pdf');
  //check for no files uploaded when error=4 in the $_Files super global
  $file_errors=array();
  //check if file type is allowed
  if (!in_array($ext,$allowed_file_types)&&!empty($ext)) {
    $file_errors[]='Files of extensions ('.$ext.") are not allowed";
  }
  //check if error code in FILES =4
  if ($error==4) {
    $file_errors[]= 'No files uploaded';
  }elseif ($error!=4 && $error!=0) {
    $file_errors[]='Error uploading file error number: '.$error;
  }
  //check if file size is less or equal to 2 Mega Bytes
  if ($size>2097152) {
  $file_errors[]='File size exceeds 2 MB';
  }
  if (empty($file_errors)) {
    $new_name=rand(0,100000000000).'.'.$ext;
    move_uploaded_file($tmp_name,'C:\xampp\htdocs\php_projects\upload_single_file\uploads\\'.$new_name);
    echo "<div class='success-message'>Message uploaded successfully</div>";

  }else {
    foreach ($file_errors as $err) {
      echo $err."<br>";
    }
  }




}




 ?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Upload Single File</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
  </head>
  <body >
<form class="mt-5" action="index.php" method="post" enctype="multipart/form-data" >
  <h2 class="mb-3">Upload Files</h2>
  <input type="file" name="my_file" value="" class="form-control mb-3">
  <input type="submit" name="submit" value="Upload">

</form>




    <script src="js\jquery-3.5.1.min.js" charset="utf-8"></script>
    <script src="js\bootstrap.min.js" charset="utf-8"></script>
    <script src="js\custom.js" charset="utf-8"></script>

  </body>
</html>
