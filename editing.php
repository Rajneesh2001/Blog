<?php
session_start();
$titleName=$_POST['title'];
$content=$_POST['content'];
// $image=$_POST['myFile'];
$image=$_FILES["myFile"]["name"];
$getImage=$_FILES["myFile"]["tmp_name"];
$newfilename= date('dmYHis').str_replace(" ", "", basename($_FILES["file"]["name"]));
$path="img/".$newfilename.$image;
move_uploaded_file($getImage,$path);
$first=$_SESSION['firstName'];
$sessionId=$_SESSION['id'];
$conn=mysqli_connect("localhost","root","","myDB");


$sql="UPDATE blogs SET title='$titleName',content='$content',image='$path'
 WHERE `blog id`='".$_SESSION["head"]."'";
 $query=mysqli_query($conn,$sql);
header("location:http://localhost/blog_project/blog.php");
 ?>