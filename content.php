<?php
session_start();
if(!isset($_SESSION["email"]))
{
    header("location:login.php");
}
$conn=mysqli_connect("localhost","root","","myDB");

$id=$_GET["id"];
$query="SELECT * FROM blogs where `blog id`=$id";
$sql=mysqli_query($conn,$query);

$currTitle;
$currContent;
$currImage;
while($rows=mysqli_fetch_assoc($sql))
{
$currTitle=$rows["title"];
$currContent=$rows["content"];
$currImg=$rows["image"];
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
<style>
    *{
        margin: 0;
        padding: 0;
    }
    body{
        display:flex;
        justify-content:center;
        align-items:center;
        /* height:100vh; */
    }
    .container{
        width:40%;
        box-shadow:0 0 20px blue;
        border-radius:10px 10px 10px 10px;
        margin-top:8vh;
    }
    h1{
        text-align:center;
    }
    .contain{
        /* text-align:center; */
        object-fit:fill;
       
    }
    img{
        width:79%;
        height:70vh;
        /* padding:2vw 8vw; */
        margin-left:4vw;
        box-shadow:0 0 20px black;
        border-radius:10px 10px 10px 10px;
    }
    p{
        padding:2vh 4vw;
        word-break:break-all;
    }
    .btn{
        position:absolute;
        top:10vh;
        left:10vw;
    }
    .btn button{
        padding:1vh 3vw;
        border-radius:10px 10px 10px 10px;
        background-color: darkgoldenrod;

    }
    .btn button:hover{
        background-color:purple;
        color:white;
    }

</style>
<body>
    <div class="container">
        <h1><?php echo $currTitle; ?></h1>
        <div class="contain">
            <img src="<?php echo $currImg; ?>" alt="">
        </div>
        <p><?php echo $currContent; ?></p>
    </div>
    <div class="btn">
        <button onClick="fun()">close</button>
    </div>
</body>
<script>
  function fun(){
     <?php 
        if(($_SESSION["admin"])=="admin")
        {
            ?>
           location.href="admin.php";
           <?php
        }
        else{ ?>
            location.href="blog.php";
       <?php }
        ?>
   
  }
  
</script>
</html>