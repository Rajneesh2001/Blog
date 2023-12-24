<?php session_start();

if (!empty($_SESSION["email"])) {
    if ($_SESSION["admin"] == "admin") {
        header("location:admin.php");
        exit();
    } else {
        header("location:blog.php");
        exit();
    }
} else { ?>

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
                padding: 0.5vw;

            }

            input {
                margin-top: 2vh;
                width: 100%;
                font-size: 1.3vw;
                padding: 1vh 0;
            }

            .sign {
                padding: 11px 6px;
                background-color: rgb(255, 217, 0);
                ;
                border: none;
                color: white;
                border-radius: 8px 8px 8px 8px;
                font-weight: 400;
                font-size: 2vw;
                width: 20%;
            }

            p {
                font-size: 1vw
            }

            a {
                color: rgb(255, 217, 0);
                text-decoration: none;
            }

            .firstName,
            .lastName,
            .emailId,
            .emailPassword,
            .confirmPassword {
                display: none;
                color:red;
                font-size:1vw;
            }
            .confirm{
                color:red;
                font-size:1vw;
                display:none;
            }
            .red{
                color:red;
                font-size:1vw;
                display:none;
            }
            .em{
                color:red;
            }
        </style>
    </head>

    <body>
        <div class="container ">

            <form method="post" action="welcome.php" onsubmit="return signUP()">
                <h1>CREATE AN ACCOUNT</h1>
                
                <div class="first black ">
                    <p>First Name </p>
                    <input type="text" name="first" required placeholder="Must be atleast 3 characters long" id="fname">
                    <div class="firstName">firstName should be equal to or greater than 3 and it should not be a number and no space</div>
                </div>
                <div class="first black">
                    <p>Last Name </p>
                    <input type="text" id="last" name="last" placeholder="Last name" required>
                    <div class="lastName">lastName should be equal to or greater than 3 and it should not be a number and no space</div>
                </div>
                <div class="first black ">
                <p class="em">email already used</p>
                    <p>Email Address </p>
                    <input name="email" id="email" type="email" placeholder = "Email address" required>
                    <div class="emailId">email not valid and it should not be empty</div>
                </div>
                <div class="first ">
                    <p>Password </p>
                    <input name="password" id="password" type="password" placeholder = "Password" required>
                    <div class="emailPassword">password should be of minimum 8 characters and not more than 15 characters
                    </div>
                </div>
                <div class="first ">
                    <p>confirm Password </p>
                    <input name="confirm" id="confirm" type="password" placeholder = "Correct Password"  required>
                    <div class="confirmPassword"></div>
                    <p class="confirm"> password and confirm password are not same </p>
                </div>
                <input type="checkbox" name="admin" style="width:5%"><span>SignUp as Admin </span>
                <div class="first ">
                    <input type="submit" value="SIGN UP" class="sign">
                </div>
                <p style="padding-bottom:20px">If you already have account with us just <span><a href="login.php">Login</a>
                    </span></p>

            </form>
        </div>

    </body>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script>
        
        var val;
        $("input[name=first]").keyup((e) => {
            val = e.target.value;
            console.log(val);
            const check=/^[a-zA-Z]{2,30}$/;
            if (val.length < 3 || !(check.test(val))) {
                $(".firstName").css("display", "inline")
                $(".firstName").css("color", "red");
            }

            else {
                $(".firstName").css("display", "none");
            }

        })

        $("input[name=last]").keyup((e) =>{
            val=e.target.value;
            const check=/^[a-zA-Z]{2,30}$/;
            if (val.length < 3 || !(check.test(val))) {
                $(".lastName").css("display", "inline")
                $(".lastName").css("color", "red");
            }

            else {
                $(".lastName").css("display", "none");
            }
        })

        $("input[name=email]").keyup((e) => {
            let val = e.target.value;
            var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if (!val.match(validRegex)) {
                $(".emailId").css("display", "block");
                $(".emailId").css("color", "red");
            }
            if (val == "") {
                $(".emailId").show();
            }
            else if (val != "") {
                $(".emailId").hide();
            }

            else {
                $(".emailId").css("display", "none");
            }
            const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            if (val.charAt(0).match(specialChars)) {
                $(".emailId").show();
                $(".emailId").css("display", "block");
                $(".emailId").css("color", "red");
            }
           


            console.log(val);
        })
       $(".em").hide()
        $("#email").change((e)=>{
            var email = e.target.value;
            console.log("this",email)
            $.ajax({
                url:"email-check.php",
                type:"POST",
                data:{em:email},
                success:function(data){
                    if(data=="yes")
                    {   
                        $("#email").blur();
                        $(".em").show();
                        $(".sign").prop("disabled",true);
                    }
                    else{
                        $(".em").hide();
                        $(".sign").prop("disabled", false);
                    }
                    console.log(data);
                }
            })
        })

        var pass;
        var details;
        $("input[name=password]").keyup((e) => {
            pass = e.target.value;
            details;
            if (pass.length < 8) {
                $(".emailPassword").css("display", "block");
                $(".emailPassword").css("color", "red");
                $("button").attributes

            }
            else if (pass.length > 15) {
                $(".emailPassword").css("display", "block");
                $(".emailPassword").css("color", "red");

            }
            else {
                $(".emailPassword").css("display", "none");
            }

        })

        $("input[name=confirm]").change((e) => {
            let confirm = e.target.value;
            if (pass != confirm) {
               $(".confirm").show();
            }
            else{
                $(".confirm").hide();
            }
        })

        


        function signUP() {
            var first = $("#fname").val();
            var last = $("#last").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var correctPass=$("#confirm").val();
            console.log(last);
            var specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            if (email.charAt(0).match(specialChars)) {
                $("#email").focus();
                return false;
            }
            const check=/^[a-zA-Z]{2,30}$/;
            if (first.length < 3 || !check.test(first)) {
                $("#fname").focus();
                return false;

            }
            if(last.length<3 || !check.test(last))
            {
                $("#last").focus();
                return false;
            }
            if (email = "") {
                $("#email").focus();
                return false;
            }
            if (password.length < 8 || password.length>15) {
                $("#password").focus();
                return false;
            }
            
            if(password!=correctPass)
            {
                $("#confirm").focus();
                return false;
            }

            
            
   
        }




    </script>

    </html>
    <?php
}
?>