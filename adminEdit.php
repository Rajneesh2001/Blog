<?php
session_start();
$titleName = $_POST['title'];
$content = $_POST['content'];
$game = substr($_POST["secret_img"], 18);
$image = $_FILES["myFile"]["name"];
$getImage = $_FILES["myFile"]["tmp_name"];
print_r($getImage);
if ($image == "") {
    $image = $game;
    $newfilename = date('dmYHis') . str_replace(" ", "", basename($image));
    $sql = "UPDATE blogs SET title='$titleName',content='$content',image='$image'
    WHERE `blog id`='" . $_SESSION["adHead"] . "'";
    $path = "img/" . $newfilename;
    header("location:http://localhost/blog_project/admin.php");
} else {
    $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["file"]["name"]));
    $path = "img/" . $newfilename . $image;
    move_uploaded_file($getImage, $path);
    print_r($getImage);
    $first = $_SESSION['firstName'];
    $sessionId = $_SESSION['id'];
    $conn = mysqli_connect("localhost", "root", "", "myDB");
   
    $sql = "UPDATE blogs SET title='$titleName',content='$content',image='$path'
 WHERE `blog id`='" . $_SESSION["adHead"] . "'";
    print_r($path);
    $query = mysqli_query($conn, $sql);
    
    echo $_SESSION["adHead"];
    header("location:http://localhost/blog_project/admin.php");
}




?>