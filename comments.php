<?php
require_once "bd.php";
$id = isset($_POST['id']) ? $_POST['id'] : $id;
$get = $pdo_get->getConnection()->prepare("SELECT  count(*)  FROM comments WHERE articles_id=:id");
$get->execute(['id' => $id]);
$summ_comments = $get->fetchColumn();
?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10"><h4>Comments(<?= $summ_comments ?>):</h4></div>
        <div class="col-md-1"></div>
    </div>
	<?php
	$get = $pdo_get->getConnection()->prepare("SELECT  id, author, email, text, pubdate  FROM comments WHERE articles_id=:id ORDER BY id ASC ");
	$get->execute(['id' => $id]);
	while ($row = $get->fetch()) {
		$default = "smile.png";
		$size = 15;
		$grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($row['email']))) . "&s=" . $size;
		?>
        <div class="row ">
            <div class="col-md-1"></div>
            <div class="col-md-10"><img width="40" height="40" src="<?= $grav_url ?>" alt="<?= $row['author'] ?>"/>
				<?php
				echo "<strong>" . $row['author'] . " </strong> &nbsp;&nbsp;&nbsp;" . $row['email'] . "&nbsp;&nbsp;&nbsp;  <strong>Date: </strong>" . $row['pubdate'] . "<br>";
				echo $row['text'] . "<br>";
				?>
            </div>
            <div class="col-md-1"></div>
        </div><br>
	<?php } ?>
