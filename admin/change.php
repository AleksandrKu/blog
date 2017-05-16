<?php
/*require_once("../Autoload.php");
spl_autoload_register(["Autoload", "load_class"]);*/
require_once "../bd.php";
/*$pdo_get = new  PDODriver($config['host'], $config['username'], $config['password'], $config['database']);*/
if (isset($_GET['id'])) {
	$id = (int)$_GET['id'];
	$get_id = $pdo_get->check_id($config['table_article'], $id);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../javascript/jquery-git.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../CLEditorWYSIWYG/jquery.cleditor.css"/>
    <link rel="stylesheet" href="../css/css.css"/>
    <script src="../CLEditorWYSIWYG/jquery.cleditor.min.js"></script>
    <script src="../CLEditorWYSIWYG/jquery.cleditor.js"></script>
     <title>Admin</title>
</head>
<body><a class="btn" href="/admin/">Back to articles</a><a class="btn" href="/?id=<?=$id?>">Show article</a>
<!--<h2>Admin</h2>-->
<form  method="post" id="form" enctype="application/x-www-form-urlencoded">
    <div class="container">
        <div><h3>
            <?php if($get_id) {
                echo "Edit post  №"; echo $id; } else { echo "Add post  №"; echo $id;
            }
                ?>
            <span style="color: green; font-size: large; margin-left: 50px" id = "success"></span></h3>
            <textarea class="form-control text text-left"  rows="1"  id="title"  title="Title. "><?=$pdo_get->get_title($id)?></textarea>
            <br>
            <textarea class="form-control text" rows="25" id="text" title="Text"><?=$pdo_get->get_text($id)?></textarea>
            <div id="id_article" id_articles="<?=$id?>"></div>
            <div class="btn btn-success pull-right btn-space" id="save"> Save</div>
            <div class="btn btn-warning pull-right btn-space" id="cancel">Cancel</div>
        </div>
    </div>
    <div id="results"></div>
	<?php  include "change_article.php";
	?>
</form>

<script>
    $("#text").cleditor(); // Редактор формы
   // $("#title").cleditor(); // Редактор формы

    $("#cancel").on('click', function () {
        location.reload();
    });
    var id_article = $('#id_article').attr('id_articles');
    if (id_article === ""){
        console.log(id_article);
        console.log("No such ID");

    }  else {   console.log(id_article);
        console.log(id_article);
        console.log("IS such ID");}

    $("#save").on('click', function () {
        id_article = $('#id_article').attr('id_articles');
         var title_send = $('#title').val();
        var text_send = $("#text").val();
        /*var send_post = "title=" + encodeURIComponent(title) + "&text=" + encodeURIComponent(text);*/
        var send_post="title=" + title_send + "&text=" + text_send + "&id_article=" + id_article;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "change_article.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(send_post);

        xhr.onreadystatechange = function () {
            if (this.statusText === "OK" && this.status === 200 && this.readyState === 4) {
                console.log(xhr.response);
                $('#success').text(" Saved successfully.");
               // $('#results').html(xhr.response);
                // document.getElementById('container').innerHTML = "404 no file";
                return true;
            } else {
               // $('#results').html("not find file");
            }
        };

        /*    console.log(formData.get(document.forms.articles.elements[0].title)); // );*/


        /*  var dataString = "type=success";
         $.ajax({
         type: "POST",
         url: "change_article.php",
         data: dataString,
         success: function() {
         $('#results').text("!!!!!!!!!!!!!!!");
         }
         });*/
    });
</script>
</body>
</html>
