<?php
 if(isset($_POST['updx'])){
    include "connection.php";
    $notes=$_POST['notes'];  
   
    //$rsrc=$_POST['rsrc'];
   // $rsrc=$_FILES['rsrc']['name'];
   
    $nid=$_GET['ids'];            

$targetDir = "pictures/";
$fileName =!empty( basename($_FILES["file"]["name"]));
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["updx"]) && !empty($_FILES["file"]["name"])){
// Allow certain file formats
$allowTypes = array('jpg','png','jpeg','gif','pdf');
if(in_array($fileType, $allowTypes)){
// Upload file to server
if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
// Insert image file name into database
$sql="update resources set notes='$notes',srcimage='$filename' where id='$nid'";
$insert = mysqli_query($con,$sql);
if($insert){
$statusMsg = "The file ".$fileName. " has been uploaded successfully.";
}else{
$statusMsg = "File upload failed, please try again.";
} 
}else{
$statusMsg = "Sorry, there was an error uploading your file.";
}
}else{
$statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
}
}else{
$statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
}






?>