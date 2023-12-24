<?php session_start() ;

$conn=mysqli_connect("localhost","root","","myDB");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteSelectedFile'])) {
    $data = json_decode($_POST['data'], true); 

    if (function_exists($_POST['deleteSelectedFile'])) {
        $_POST['deleteSelectedFile']($data,$conn); 
    } else {
        echo "Function does not exist";
    }

    exit();
}
function deleteSelectedFile($data,$conn=''){
     $sql = "delete from blogs where `blog id` IN (".implode(",",$data).")";
     $query = mysqli_query($conn,$sql);
    
} 

$imgSql="SELECT image from blogs where `blog id`='".$_SESSION["del"]."'";
$imgQuery=mysqli_query($conn,$imgSql);
$imgQ=mysqli_fetch_assoc($imgQuery);

unlink($imgQ['image']);
$sql="DELETE FROM blogs WHERE `blog id`='".$_SESSION["del"]."'";
$query=mysqli_query($conn,$sql);

if($_SESSION["admin"]=="admin")
{
    header("location:http://localhost/blog_project/admin.php");
}
else{
    header("location:http://localhost/blog_project/blog.php");
}

?>
