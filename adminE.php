<?php session_start();
if (!isset($_SESSION["email"])) {
    header("location:login.php");
}
$_SESSION["head"] = $_GET["id"];
$conn = mysqli_connect("localhost", "root", "", "myDB");

$sql = "SELECT * FROM `blogs` WHERE `blog id`='" . $_SESSION["head"] . "'";
$query = mysqli_query($conn, $sql);

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
    * {
        margin: 0;
        padding: 0;
    }

    .container {
        margin: 40px auto;
        width: 70%;
    }

    .simple {
        font-weight: bold;
    }

    input {
        padding: 1vh 0;
        margin-bottom: 2vh;
        width: 100%;
    }

    form {
        width: 100%;
    }

    hr {
        opacity: 0.3
    }

    textarea {
        width: 100%;
        padding: 1vw;
    }

    button {
        padding: 1vh;
    }

    #file-upload-button {
        cursor: pointer;
    }

    .btn {
        width: 5%;
    }
</style>
<body>
    <div class="container">
        <form method="post" action="adminEdit.php" onsubmit="return handle()" enctype="multipart/form-data">
            <p class="simple">Title*:</p>
            <input type="text" name="title" id="title" value=<?php echo $row["title"] ?>>
            <p class="containe">Select image to upload:</p>
            <hr>
            <input type="file" id="file-upload-button" name="myFile" style="margin-left:1vw" accept="image/*"
                class="img">
            <p style="font-weight:bold;margin-bottom:1vh;">Description:</p>
            <textarea cols="30" rows="10" name="content" id="content"><?php echo $row["content"]; ?></textarea>
            <input type="submit" style="cursor:pointer" class="btn">
            <input type="hidden" name="secret_img" value=<?php echo "{$_GET['image']}"?>>
            <button type="reset" style="cursor:pointer"
                onClick="location='http://localhost/blog_project/admin.php'">Cancel</button>
        </form>
    </div>

</body>
<script>
    function handle() {
        var title = document.getElementById("title").value;
        var content = document.getElementById("content").value;

        if (title == "" && content == "") {
            alert("write something");
            return false;
        }

    }
</script>

<?php $_SESSION["adHead"] = $_GET["id"];

?>

</html>