<?php
$conn=mysqli_connect("localhost","root","","myDB");
$email=$_POST["em"];
$sql="SELECT * FROM  users where email='{$email}'";
$query=mysqli_query($conn,$sql);
$output="no";
if(mysqli_num_rows($query)>0)
{
    $output="yes";
}
echo $output;
?>