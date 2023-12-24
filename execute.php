<?php
session_start();
$ip=$_SERVER['SERVER_ADDR'];

$conn = mysqli_connect("localhost", "root", "", "myDB");
$logEmail = $_POST["email"];
$logPass = $_POST["password"];
$_SESSION["temp_email"]=$_POST["email"];
$_SESSION["temp_pass"]=$_POST["password"];
$_SESSION["check"]=false;

$pass = "SELECT * FROM `users`";
$testPass = mysqli_query($conn, $pass);
$flag = false;
$eflag = false;
$_SESSION["flag"]=true;
$_SESSION["show_err"]="";
while ($rows = mysqli_fetch_assoc($testPass)) {
    if(password_verify($logPass,$rows["password"]))
    {
      $flag=true;
    }
    if ($logEmail == $rows["email"]) {
        $eflag = true;
        break;
    }
}

if ($eflag == false) {
    $_COOKIE["first-flag"]=true;
    $_SESSION["flag"]=true;
    $_SESSION["check"]=true;
    $_SESSION["show_err"]="incorrect email and password";
    echo '<script type="text/javascript">
    location.href="login.php"
    </script>';
    $_SESSION['error']='Wrong Credentials';

} else {
    $newPass = "SELECT * FROM  users  WHERE email='" . $logEmail . "'";
    $queryPass = mysqli_query($conn, $newPass);
    if(mysqli_num_rows($queryPass)==0)
    {
        $_SESSION["flag"]=true;
    }
    while ($item = mysqli_fetch_assoc($queryPass)) {
    
        if (password_verify($logPass, $item["password"])) {
            $_SESSION["firstName"] = $item["firstName"];
            $_SESSION["id"] = $item["id"];
            $_SESSION["email"] = $item["email"];
            $_SESSION["admin"] = $item["Role"];
            
            if ($item["Role"] == "admin") {
                $_COOKIE["first-flag"]=false;
                $_SESSION["flag"]=false; 
                $_SESSION['something']="Welcome Admin";
                

                echo '<script type="text/javascript">
         location.href="admin.php"
         </script>
         ';
            } else {
                $_SESSION["flag"]=false;
                echo '<script type="text/javascript" >
                location.href="blog.php"
                </script>';

            }
        } 
        else {
            echo '<script type="text/javascript">
            location.href="login.php"
            </script>';
            $_SESSION['error'] = 'Wrong Credentials';
            $_SESSION["check"]=true;
            $_SESSION["flag"]=true;
            $_SESSION["load"]="incorrect email and password";
        }
    }

 


}


exit();

?>