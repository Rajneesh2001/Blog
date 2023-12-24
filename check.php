<?php
session_start();
$conn=mysqli_connect("localhost","root","","myDB");

$getEmail=$_POST["em"];
$getPass=$_POST['ps'];
$test=password_verify($getPass,$_SESSION["secure"]);
$query="SELECT * FROM users where email ='{$getEmail}'";

$result=mysqli_query($conn,$query);



$flag=false;
if(mysqli_num_rows($result)>0)
{
   while($rows=mysqli_fetch_assoc($result))
   {
        if(password_verify($getPass,$rows["password"]))
        {
            $flag=true;
        }
   } 
}
  if($flag==false)
  {
    echo $getEmail." ".$getPass;
  }
   



?>