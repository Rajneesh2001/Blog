<?php session_start(); 
if(!isset($_SESSION["email"]))
{
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Are you sure you want to delete this</h1>
    <?php if($_SESSION["admin"]=="admin")
    {
    ?>
     <button onClick="location.href='http://localhost/blog_project/deleting.php'">yes</button>
    <button onClick="location.href='http://localhost/blog_project/admin.php'">no</button>
    <?php
    }
    else{?>
     <button onClick="location.href='http://localhost/blog_project/deleting.php'">yes</button>
    <button onClick="location.href='http://localhost/blog_project/blog.php'">no</button>
<?php
    }

    ?>
   
</body>
<?php $_SESSION["del"]=$_GET["id"] ?>
</html>