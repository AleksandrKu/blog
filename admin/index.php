<?php
require_once "../bd.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/css.css">
    <script src="../javascript/jquery-git.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Blog</title>
    <script src="../javascript/jquery-git.js"></script>
</head>
<body>
<main>
    <h1> Admin </h1>
    <div id="container" class="container div_container">
		<?php
		$get = $pdo_get->getConnection()->query("SELECT  MAX(id)  FROM articles");
		$max_id = $get->fetchColumn();
		$max_id += 1;
		?>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <a href="/admin/change.php?id=<?= $max_id ?>" class="btn btn-primary">Add new post</a>
                <span class="new-post" id="delete-success"></span></div>
            <div class="col-md-1"></div>
        </div>
		<?php
		$get = $pdo_get->getConnection()->query("SELECT  id, title, text  FROM articles ORDER BY id DESC ");
		while ($row = $get->fetch()) {
			$id = $row['id'];
			?>
            <div class="row" id="row-<?= $id ?>">
                <div class="col-md-1"></div>
                <div class="col-md-10 main">
                    <strong> <?=$row['title']?> </strong><br>
					<?php
					echo mb_substr(strip_tags($row['text']), 0, 300, 'utf-8') . "...<a href='../?id={$id}'> Read more</a>";
					?>
                    <a class="btn btn-danger pull-right btn-space delete" id="<?= $id ?>">Delete</a>
                    <a href='/admin/change.php?id=<?= $id ?>' class="btn btn-success pull-right btn-space" id="edit">Edit</a>
                </div>
                <div class="col-md-1"></div>
            </div>
		<?php } ?>
    </div>
</main>
<script src="../javascript/js_admin.js"></script>
</body>
</html>