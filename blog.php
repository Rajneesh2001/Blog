<?php session_start();
if (!isset($_SESSION["email"])) {
    header("location:login.php");
} else if ($_SESSION["admin"] != "user") {
    header("location:admin.php");
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
    * {
        margin: 0;
        padding: 0;
    }

    .header {
        color: grey;
    }

    h1 {
        padding-bottom: 1vh;
        ;
    }

    .container {
        width: 86%;
        margin: 25px auto;
    }

    button {
        float: right;
        display: flex;
        cursor: pointer;
        padding: 6px;
        background-color: whitesmoke;
        /* border-color: darkcyan; */
        border: 1px solid darkcyan;
        border-radius: 10px 10px 10px 10px;
        margin-bottom: 1vh;

    }

    input {
        padding: 5px;
        margin-bottom: 2vh;
    }

    .main-body,
    table {
        width: 100%;
    }

    #here {
        display: flex;
        flex-direction: column;
        width: 100%;
        justify-content: center;

    }

    .btn-header{
        flex-direction:row-reverse;
        box-sizing: border-box;
        display:flex;
        flex:1;
    }

    #here td {
        /* padding-left:3vw; */
        /* width:11%;
        text-align:center; */
        width: 9vw;
        padding: 2vh 0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 2vw;
        word-break: break-all;
    }

    #here tr {
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .apple {
        box-shadow: 0px 2px grey, 0px -2px grey;
        display: flex;
        justify-content: space-around;
        padding: 1vh 0
    }

    /* .apple th{
        padding-right:5.3vw;
    } */
    /* th{
        width:2vw;
    } */

    img {
        width: 6vw;
        height: 8vh;
    }

    .btn {
        display: flex;
    }

    .content {
        display: inline !important;
    }

    .btn button {
        margin-left: 1vw;
    }

    table tr {
        box-shadow: 0px 2px grey
    }

    a {
        margin-left: 1vw;
        text-decoration: none;
        color: black;
        background-color: whitesmoke;
        border: 1px solid darkcyan;
        padding: 6px;
        border-radius: 10px 10px 10px 10px;
    }

    .out {
        top: 8px;
        position: absolute;
        right: 18px;
    }

    .para {
        background: none;
        border: none;
        display: inline;
        padding: 0;
        margin: 0;
        border-radius: none;
        color: purple;
        cursor: pointer;
    }

    .footer {
        width: 100%;
        text-align: center;
    }

    .pink {
        font-size: 2vw;
        position: absolute;
        right: 40vw;
        font-weight: 600;
        background-color: green;
        color: whitesmoke;
        padding: 1vw;
        border-radius: 10px 10px 10px 10px;
    }

    .del {
        position: absolute;
        top: 40vh;
        left: 5vw;
        background-color: yellow;
        border: 1px solid black;
        padding: 1vw 1vw;
        border-radius: 10px 10px 10px 10px;
        font-size: 1.5vw;

    }

    .del:hover {
        opacity: 0.5;
    }

    .sp-footer {
        width: 100%;
        text-align: center;
        margin-top: 4vh;
    }

    .deleteAll{
        margin-left:2rem;
        display:none;
    }
</style>

<body>
    <?php 
    if(isset($_SESSION['something'])){
        $temp = explode(" ",$_SESSION['something']);
        $temp[1] = $_SESSION["firstName"];
        echo' <span class="pink">' .  implode(" ",$temp)  .  '</span>';
        unset($_SESSION['something']);
    }
    ?>
   
    <div class="container">
        <div class="header">
            <h1>Blogs</h1>
            <input type="text" placeholder="search blog" id="search">
        </div>
        <div class = 'btn-header'>
            <button type="submit" class = "deleteAll"> Delete All </button>
            <button type="submit" onClick="location.href='create.php'">Create New Blog</button>
        </div>
        <div class="main-body">
            <table id="main">
                <thead>
                    <tr class="apple">
                        <th>id</th>
                        <th>Image</th>
                        <th style="cursor:pointer" id="title" class="clickable">Title<span class="getTitle"></span></th>
                        <th style="cursor:pointer" id="desc" class="clickable">Desc<span class="getDesc"></span></th>
                        <th>Created By</th>
                        <th style="cursor:pointer" id="create" class="clickable">Created On<span
                                class="getCreate"></span></th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="here">
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "myDB");
                    if (!$conn) {
                        echo "there is an error in connection part" . mysqli_connect_error();
                    }
                    
                    $query = "SELECT * FROM blogs WHERE user='" . $_SESSION["firstName"] . "'";
                    $sql = mysqli_query($conn, $query);
                    $i = 1;
                    $display_rows = 3;
                    if(!empty($sql) && isset($sql)){
                        $total_rows = mysqli_num_rows($sql);
                    }
                    else $total_rows=0;
                    $num_of_pages = ceil($total_rows / $display_rows);
                    if (!isset($_GET["page"])) {
                        $page = 1;
                    } else {
                        $page = $_GET["page"];
                    }
                    $start_result = ($page - 1) * ($display_rows);
                    $query = "SELECT * FROM blogs WHERE user='" . $_SESSION["firstName"] . "' LIMIT " . $start_result . ',' . $display_rows;
                    $sql = mysqli_query($conn, $query);
                    $val = 1;
                    while ($result = mysqli_fetch_array($sql)) {
                        ?>
                        <tr>
                            <td class="identity"><input type="checkbox" id="checkbox" name="checkbox"
                                    value="<?php echo $result['blog id'] ?>"></td>
                            <td class="img"><img src="./<?php echo $result["image"]; ?>"></td>
                            <td class="title">
                                <?php echo $result["title"]; ?>
                            </td>
                            <td class="content">
                                <?php

                                echo substr($result["content"], 0, 30) . "....<br>"; ?>
                                <span><a class='para'
                                        href="http://localhost/blog_project/content.php?id=<?php echo $result["blog id"]; ?>">read
                                        more</a></span>
                                <?php

                                ?>
                            </td>
                            <td class="user">
                                <?php echo $result["user"]; ?>
                            </td>
                            <td class="createdAt">
                                <?php echo substr($result["createdAt"], 0, 10); ?>
                            </td>
                            <td class="btn"><a
                                    href="http://localhost/blog_project/edit.php?id=<?php echo $result["blog id"]; ?>">edit</a>
                                <a
                                    href="http://localhost/blog_project/delete.php?id=<?php echo $result["blog id"]; ?>">delete</a>
                            </td>
                        </tr>

                        <?php
                        $i++;
                    }


                    ?>
                </tbody>

            </table>
        </div>
    </div>
    <button class="out">SignOUt</button>
    <div class="footer">
        <?php
        for ($page = 1; $page <= $num_of_pages; $page++) {
            echo '<a href="blog.php?page=' . $page . '">' . $page . '</a>';
        }
        ?>
    </div>
    
    
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded',()=>{
        const notify = document.querySelector(".pink");
        if(notify){
            setTimeout(() => {
                notify.style.display="none";
            }, 3000);
        }
    })

    $(".out").click(() => {
        location.href = "logout.php";
    })


    //searching 

    $(document).ready(
        $("#search").keyup(function () {
            var searchValue = $(this).val();
            var use = "<?php echo $_SESSION["firstName"]; ?>";
            $.ajax({
                url: "search_user.php",
                type: "POST",
                data: { search: searchValue, user: use },
                success: function (data) {
                    $(".footer").hide();
                    $(".main-body").html(data);
                    var len = data.split("<tr>");
                    $("table tbody tr").hide()
                    $("table tbody tr").slice(0, 3).show()
                    $(".sp-footer a").click(function (e) {
                        newVal = parseInt(e.target.id)
                        counter = newVal;
                        start = (newVal - 1) * 3;
                        end = start + 3
                        end = (end >= len.length) ? len.length : end
                        $('table tbody tr').hide();
                        console.log(start, end)
                        $("table tbody tr").slice(start, end).show();
                        document.querySelectorAll("thead th").forEach(header => {
                            console.log("his");
                            $(header).on("click", () => {
                                const tableElement = header.parentElement.parentElement.parentElement;

                                const headerIndex = Array.prototype.indexOf.call(header.parentElement.children, header);

                                const currentIsAsc = header.classList.contains("th-sort-asc");
                                sortTable(tableElement, headerIndex, !currentIsAsc)
                            })
                        })

                        function sortTable(table, column, asc = true) {
                            const tBody = table.tBodies[0];
                            const dirModifier = asc ? 1 : -1;
                            const rows = Array.from(tBody.querySelectorAll("tr"))
                            const sortedRows = rows.sort((a, b) => {
                                const aColText = a.querySelector(`td:nth-child(${column + 1})`).textContent.trim()
                                const bColText = b.querySelector(`td:nth-child(${column + 1})`).textContent.trim()
                                return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier)
                            })
                            while (tBody.firstChild) {
                                tBody.removeChild(tBody.firstChild);
                            }
                            tBody.append(...sortedRows)
                            table.querySelectorAll("th").forEach(th => (th.classList.remove("th-sort-asc", "th-sort-desc")))
                            table.querySelector(`th:nth-child(${column + 1})`).classList.toggle("th-sort-asc", asc)
                            table.querySelector(`th:nth-child(${column + 1})`).classList.toggle("th-sort-desc", !asc)

                        }
                    })

                }
            })


        })
        
        )


    //sorting
    var titleSort = "asc";
    var desSort = "asc";
    var createdOn = "asc";

    $("#title").click(function () {
        if (titleSort == "asc") {
            $(".getTitle").html("&uarr;")
            titleSort = "des";
            console.log("hi")
        }
        else if (titleSort == "des") {
            $(".getTitle").html("&darr;")
            titleSort = "asc";
            console.log("no")
        }
    })
    $("#desc").click(function () {
        if (desSort == "asc") {
            $(".getDesc").html("&uarr;")
            desSort = "des";
            console.log("hi")
        }
        else if (desSort == "des") {
            $(".getDesc").html("&darr;")
            desSort = "asc";
            console.log("no")
        }
    })
    $("#create").click(function () {
        if (createdOn == "asc") {
            $(".getCreate").html("&uarr;")
            createdOn = "des";
            console.log("hi")
        }
        else if (createdOn == "des") {
            $(".getCreate").html("&darr;")
            createdOn = "asc";
            console.log("no")
        }
    })

    document.querySelectorAll("thead .clickable").forEach(header => {
        $(header).on("click", () => {
            console.log("click");
            const tableElement = header.parentElement.parentElement.parentElement;

            const headerIndex = Array.prototype.indexOf.call(header.parentElement.children, header);
            console.log(headerIndex)
            const currentIsAsc = header.classList.contains("th-sort-asc");
            sortTable(tableElement, headerIndex, !currentIsAsc)
        })
    })

    function sortTable(table, column, asc = true) {
        const tBody = table.tBodies[0];
        const dirModifier = asc ? 1 : -1;
        const rows = Array.from(tBody.querySelectorAll("tr"))
        const sortedRows = rows.sort((a, b) => {
            const aColText = a.querySelector(`td:nth-child(${column + 1})`).textContent.trim()
            const bColText = b.querySelector(`td:nth-child(${column + 1})`).textContent.trim()
            return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier)
        })
        while (tBody.firstChild) {
            tBody.removeChild(tBody.firstChild);
        }
        tBody.append(...sortedRows)
        table.querySelectorAll("th").forEach(th => (th.classList.remove("th-sort-asc", "th-sort-desc")))
        table.querySelector(`th:nth-child(${column + 1})`).classList.toggle("th-sort-asc", asc)
        table.querySelector(`th:nth-child(${column + 1})`).classList.toggle("th-sort-desc", !asc)

    }

    function handle() {
        location.href = "http://localhost/blog_project/edit.php";
    }
    


   const selectedValues = [];
   $("#main").on("change","#checkbox",(e)=>{
    const value = e.target.value;
    if(event.target.checked){
        selectedValues.push(value);
    }
    else{
        const index = selectedValues.indexOf(value);
        selectedValues.splice(index,1);
    }
    deleteSelectedValues(selectedValues);
   })
   
   function deleteSelectedValues(values){
    if(values.length>0){
        $(".deleteAll").show().data("selectedValues",values);
    }
    else $(".deleteAll").hide();
   }
   
    $(".deleteAll").click(function(){
        let values = $(this).data("selectedValues");
        $.ajax({
            url:"deleting.php",
            method:'POST',
            data:{
                deleteSelectedFile:"deleteSelectedFile",
                data:JSON.stringify(values)
            },
            success:function(){
               location.reload();
            }

        })
    })
    

   



</script>


</html>