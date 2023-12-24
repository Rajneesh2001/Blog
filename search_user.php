<?php
// $session_start();
$conn = mysqli_connect("localhost", "root", "", "myDB");
$person=$_POST["user"];
$search_row = $_POST["search"];
$sql = "SELECT * from blogs where  title LIKE '%{$search_row}%' AND user LIKE '{$person}'  ";
$query = mysqli_query($conn, $sql);
$rows = 3;
$total_rows = mysqli_num_rows($query);
if (!isset($_GET["page"])) {
	$page = 1;
} else {
	$page = $_GET["page"];
}
$num_of_pages = ceil($total_rows / $rows);
$start = ($page - 1) * $rows;
$sql = "SELECT * from blogs where title LIKE '%{$search_row}%'  AND user LIKE '{$person}'  ";
$query = mysqli_query($conn, $sql);
$output = "";
$output.="
<table id='main'>
                <thead>
                    <tr class='apple'>
                        <th>id</th>
                        <th>Image</th>
                        <th class='clickable' >Title</th>
                        <th class='clickable' >Desc</th>
                        <th>Created By</th>
                        <th class='clickable' >Created On</th>
                        <th>Action</th>
                    </tr>
                </thead>
				<tbody id='here'>
";
while ($rows = mysqli_fetch_assoc($query)) {
	// $len=strlen($rows["content"]);
	$output .= "
	<tr>
	<td><input type='checkbox'></td>
	<td><img src='{$rows["image"]}'</td>
	<td>{$rows["title"]}</td>
	<td class='content'>".substr($rows["content"],0,25)."...<br><span><a class='para' href='content.php?id={$rows["blog id"]}'>Read more</a></span></td>
	<td>{$rows["user"]}</td>
	<td>{$rows["createdAt"]}</td>
	<td class='btn'><a href='http://localhost/blog_project/adminE.php?id={$rows["blog id"]}'>edit</a>
      <a href='http://localhost/blog_project/delete.php?id={$rows["blog id"]}'>delete</a>
    </td>
	</tr>
	";
}
$output.="</tbody>
</table>";
$output .="<div class='sp-footer' >";
for ($page = 1; $page <= $num_of_pages; $page++) {
	$output .="<a id=".$page." > $page  </a>";
}
$output .="</div>";

echo $output;




?>