<?php
session_start();
$conn = mysqli_connect("localhost","root","","myDB");

$sql = "create table if not exists users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName varchar(20) NOT NULL,
    lastName varchar(20) NOT NULL,
    email varchar(30) NOT NULL,
    password varchar(255) NOT NULL,
    Role varchar(10) NOT NULL
)";

mysqli_query($conn,$sql);

$sql1="create table if not exists blogs(
    `blog id` INT(5) AUTO_INCREMENT PRIMARY KEY,
    user varchar(14) NOT NULL,
    title varchar(13) ,
    content TEXT,
    image varchar(30) ,
    id INT(5) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  )";

mysqli_query($conn,$sql1);
$firstName=$_POST["first"];
$lastName=$_POST["last"];
$email=$_POST["email"];
$password=$_POST["password"];
$confirm=$_POST["confirm"];
$admin=$_POST["admin"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$_SESSION["secure"]=$hashed_password;
$_SESSION["first"]=$firstName;

$role=($admin=="on")?"admin":"user";
$_SESSION["role"]=$role;

//validation


if(!validate($firstName,$lastName,$email,$password,$confirm))
{ 
    echo $firstName,$lastName,$email,$password,$confirm;
    $_SESSION["status"]="<span style='color:red'>incorrect credentials</span>";
    header("location:1.php");
}
else{
    $sql="INSERT INTO `users`(`firstName`,`LastName`,`email`,`password`,`Role`) VALUES ('$firstName','$lastName','$email','$hashed_password','$role')";
 
    $store=mysqli_query($conn,$sql);
    

    if($store)                                    
    { if($_SESSION["admin"]=="admin")
        {
            header("location:admin.php");    
        }
      else
      {
        header("location:blog.php");
      }
       
    }
    else{
        die ("there is also an error".error_reporting (E_ALL | E_STRICT)  );
    }
    mysqli_close($conn);  
}


function validate($firstName,$lastName,$email,$password,$confirm){
 
    if($firstName==" ")
    {
        return false;
    }
    if(!preg_match('/^[a-z]*$/i', $firstName))
    {
        return false;
    }
    if(!preg_match('/^[a-z]*$/i', $lastName))
    {
        return false;
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        return false;
    }
    if(strlen($password)<8)
    {
        return false;
    }
    if(strlen($password)>15)
    {
        return false;
    }
    if($password!=$confirm)
    {
        return false;
    }
    
    else
    {
        return true;
    }


    
    
}



?> 
