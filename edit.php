<?php session_start();
if(!isset($_SESSION["email"]))
{
    header("location:login.php");
}
?>
<?php $_SESSION["head"]=$_GET["id"];
  $conn=mysqli_connect("localhost","root","","myDB");

  $sql="SELECT * FROM `blogs` WHERE `blog id`='".$_SESSION["head"]."'";
  $query=mysqli_query($conn,$sql);

  $row = mysqli_fetch_array($query);

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
    .container{
        margin:40px auto;
        width:70%;
    }
    .simple{
        font-weight:bold;
    }
    input{
        padding:1vh 0;
        margin-bottom:2vh;
        width:100%;
    }
    form{
        width:100%;
    }
    hr{
        opacity:0.3
    }
    textarea{
        width:100%;
        padding:1vw;
    }
    button{
        padding:1vh;
    }
   
   
</style>
<body>
    <div class="container">
    <form action="http://localhost/blog_project/editing.php" method="post" onsubmit="return handle()" enctype="multipart/form-data">
        <p class="simple">Title*:</p>
        <input type="text" name="title" value=<?php echo $row["title"];?> id="title" >
        <p class="containe">Select image to upload:</p>
        <hr>
        <input type="file" name="myFile" style="margin-left:1vw" accept="image/*" value=<?php echo $row["image"];?>> 
        <p style="font-weight:bold;margin-bottom:1vh;">Description:</p>
        <textarea  cols="30" rows="10" name="content" id="content"><?php echo $row["content"] ?></textarea>
        <button type="submit">Submit</button>
        <button type="reset" onClick="location='http://localhost/blog_project/blog.php'">Cancel</button>
    </form>
   
</div>

</body>
<script>
function handle(){
        var title=document.getElementById("title").value;
        var content=document.getElementById("content").value;
        if(title=="" && content=="")
        {
            alert("write something");
            return false;
        }
    }
</script>

</html>