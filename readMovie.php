<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT moviename,thumbnail,imdbcode FROM movies WHERE moviename like '" . $_POST["keyword"] . "%' ORDER BY moviename LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $movie) {
?>
<li onClick="selectMovie('<?php echo $movie["moviename"]; ?>');"><?php echo " <a href='http://www.imdb.com/title/".$movie['imdbcode']."'><img src='".$movie['thumbnail']."' width = 50px height = 50px float:left> "."<b><i> {$movie['moviename']}</i></b></a>"; ?></li>
<?php } ?>
</ul>
<?php } } ?>