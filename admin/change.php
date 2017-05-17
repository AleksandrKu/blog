<?php
require_once "../bd.php";
if (isset($_GET['id'])) {
	$id = (int)$_GET['id'];
	$get_id = $pdo_get->check_id($config['table_article'], $id);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../javascript/jquery-git.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <!-- <link rel="stylesheet" href="../CLEditorWYSIWYG/jquery.cleditor.css"/>-->
    <link rel="stylesheet" href="../css/css.css"/>
    <!--<script src="../CLEditorWYSIWYG/jquery.cleditor.min.js"></script>
    <script src="../CLEditorWYSIWYG/jquery.cleditor.js"></script>-->
    <script src="../ckeditor/ckeditor.js"></script>
    <title>Admin</title>
</head>
<body><a class="btn" href="/admin/">Back to articles</a><a class="btn" href="/?id=<?= $id ?>">Show article</a>
<form method="post" id="form" enctype="application/x-www-form-urlencoded">
    <div class="container">
        <div><h3>
				<?php if ($get_id) {
					echo "Edit post № ".$id;
				} else {
					echo "Add post  № ".$id;;
				}
				?>
                <span style="color: green; font-size: large; margin-left: 50px" id="success"></span></h3>
            <textarea class="form-control text text-left" rows="1" id="title"
                      title="Title. "><?php  echo ($get_id)?$pdo_get->get_title($id):""; ?></textarea>
            <br>
            <textarea name="textarea" class="form-control text" rows="40" id="text"
                      title="Text"><?php  echo ($get_id)?$pdo_get->get_text($id):""; ?></textarea>
            <div id="id_article" id_articles="<?= $id ?>"></div>
            <div class="btn btn-success pull-right btn-space" id="save"> Save</div>
            <div class="btn btn-warning pull-right btn-space" id="cancel">Cancel</div>
        </div>
    </div>
    <div id="results"></div>
</form>
<script src="../javascript/js_change.js"></script>
<script>
    CKEDITOR.replace("textarea", {
        customConfig: 'config.js'
    });

</script>

</body>
</html>
