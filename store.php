<?php
session_start();
if(!isset($_SESSION["email"]))
{
    header("location:login.php");
}
$conn=mysqli_connect("localhost","root","","myDB");
$titleName=$_POST['title'];
$content=strval($_POST['content']);
$image=$_FILES['myFile']["name"];

$first=$_SESSION['firstName'];
$sessionId=$_SESSION['id'];
$sessionEmail=$_SESSION["email"];
echo $titleName;
echo $content;
echo "img".$image;
echo $first;
echo $sessionId;
echo $sessionEmail;
$createdAt=date("Y-m-d") ;
var_dump($createdAt);
$time=time();

$getImage=$_FILES["myFile"]["tmp_name"];
$newfilename= date('dmYHis').str_replace(" ", "", basename($_FILES["file"]["name"]));
$path="img/".$newfilename.$image;
$_SESSION["getimg"]=$path;

move_uploaded_file($getImage,$path);
$sql="INSERT INTO `blogs` (`user`,`title`,`content`,`image`,`id`) VALUES ('$first','$titleName','$content','$path','$sessionId')";
$query=mysqli_query($conn,$sql);
header("location:http://localhost/blog_project/blog.php");

// function CreateBlogTable($conn){
//   $sql="create table if not exists blogs(
//     `blog id` INT(5) AUTO_INCREMENT PRIMARY KEY,
//     user varchar(14) NOT NULL,
//     title varchar(13) ,
//     content TEXT,
//     image varchar(30) ,
//     id INT(5) NOT NULL,
//     createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//   )";
//   $result = mysqli_query($conn,$sql);
//   if($result){
//     mysqli_query($conn,"INSERT INTO `blogs` (`user`,`title`,`content`,`image`,`id`) VALUES ('$first','$titleName','$content','$path','$sessionId')");
//   }
// }
?>
