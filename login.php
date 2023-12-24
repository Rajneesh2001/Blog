<?php session_start();
if (isset($_SESSION["email"]) != "") {
    if (($_SESSION["admin"]) == "admin") {
        header("location:admin.php");
    } else if (($_SESSION["admin"]) == "user") {
        header("location:blog.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mynerve&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: black;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            background-color: rgb(255, 217, 0);
            color: white;
            font-weight: 400;
            font-size: 2vw;
            padding: 2vh 0;
            padding-left: 1vw;


        }

        .container {
            width: 60%;
            background-color: whitesmoke;

            padding: 2px;
        }

        .first {
            padding: 1vw;

        }

        input {
            margin-top: 2vh;
            width: 97%;
            font-size: 1vw;
            padding: 1vh;
        }

        .input-btn {
            padding: 11px 6px;
            background-color: rgb(255, 217, 0);
            ;
            border: none;
            color: white;
            border-radius: 8px 8px 8px 8px;
            font-weight: 400;
            font-size: 1vw;
            width: 5vw;
        }

        p {
            font-size: 1vw
        }

        a {
            color: rgb(255, 217, 0);
            text-decoration: none;
        }
        .notify{
            position:absolute;
            top:10vh;
            display:none;
           
            
        }
        .notify h1{
            color:red ;
        }
        .white{
            color:red;
            position:absolute;
            top:5vh;
            font-size:2vw;
            background-color:black;
            /* display:none; */
        }
    </style>
</head>

<body>
   <?php 
   if(isset($_SESSION['error'])){
    echo "<h1 class='white'>".$_SESSION['error']."</h1>";  
    unset($_SESSION['error']);
   }
   ?>
   
    <div class="container ">
        <form action="execute.php" method="post"  onsubmit='return handle()'>
            <h1>LOG IN </h1>

            <div class="first ">
                <p>Email Address </p>
                <input name="email" type="email"  id="email" placeholder = "Email Address"  required>
            </div>
            <div class="first ">
                <p>Password </p>
                <input name="password" type="password" id="password" placeholder = "Password" required>
            </div>

            <div class="first ">
                <input type="submit" value="Log IN" class="input-btn" style="cursor:pointer">
            </div>
            <p style="padding-bottom:20px; margin-left:1.2vw;">new user <span><a href="1.php">?Sign up</a>
                </span></p>
        </form>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    //sign up
    function handle(e) {
        // e.preventDefault;
        var email = document.getElementById("email").value;
        var pass = document.getElementById("password").value;
        var valid=false;
        $.ajax({
            url: "check.php",
            type: "POST",
            async:true,
            data: {
                em: email,
                ps: pass
            },
            success: function (data) {
               var ar=data.split(" ")
               $("#email").val(ar[0])
               $("#password").val(ar[1])
            }
     
        })
    }
 
   


    <?php 
        if($_SESSION["check"]==true)
        {?>
        $("#email").val("<?php echo $_SESSION["temp_email"]?>")
        $("#password").val("<?php echo $_SESSION["temp_pass"]?>")
        <?php
            
        }
    ?>
    document.addEventListener('DOMContentLoaded',()=>{
       const errorMessage = document.getElementsByClassName('white')[0]; 
       if(errorMessage){
        setTimeout(()=>{
            errorMessage.style.display="none";
        },3000)
       }
    })
</script>

</html>


