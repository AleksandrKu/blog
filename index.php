<?php
require_once "bd.php";
if (isset($_GET['id'])) {
	$id = (int)($_GET['id']);
	$get_id = $pdo_get->check_id($config['table_article'], $id);
	$get = $pdo_get->getConnection()->prepare("SELECT  count(*)  FROM comments WHERE articles_id=:id");
	$get->execute(['id' => $id]);
	$summ_comments = $get->fetchColumn();
}
if (!isset($_GET['id']) || empty($get_id) || $get_id < 1) {
	header('Location: /admin/index.php', TRUE, 302);
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
    <link rel="stylesheet" href="css/css.css">
    <script src="javascript/jquery-git.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title><?= $pdo_get->get_title($id) ?></title>
</head>
<body>
<div><a class="btn" href="/admin/">Back to articles</a></div>
<div class="container id_article" id="<?= $id ?>">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 back">
			<?php
			echo "<h1>" . $pdo_get->get_title($id) . "</h1>";
			echo $pdo_get->get_text($id);
			?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 back">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-body">
                        <form id="contactForm" method="post" enctype="application/x-www-form-urlencoded">
                            <div class="row">
                                <!-- Name and email  -->
                                <div class="col-sm-10">
                                    <div><span style="font-size: large">Add a comment</span> </span>
                                        <span class="hidden success" role="alert" id="successMessage">
                                        Comment added successfully.</span>
                                        <div>Fields marked as <sup class="red">*</sup> is requared</div>
                                    </div>
                                    <!-- Name user -->
                                    <div class="form-group has-feedback">
                                        <label for="name">Name <sup class="red">*</sup> <span id="result-name"> </span>
                                        </label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               required="required" value="" placeholder="example, Ivan"
                                               minlength="3" maxlength="30">
                                        <span class="glyphicon form-control-feedback"></span>
                                    </div>
                                    <!-- Email user  -->
                                    <div class="form-group has-feedback">
                                        <label for="email" class="control-label">Email <sup class="red">* </sup> <span
                                                    id="result"> </span> </label>
                                        <input type="email" id="email" name="email" class="form-control"
                                               required="required" value=""
                                               placeholder="example, ivan@mail.ru , from 3 to 30 characters"
                                               maxlength="30">
                                        <span class="glyphicon form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- message from user  -->
                            <div class="form-group has-feedback">
                                <label for="message" class="control-label">Comment <sup class="red">* </sup> <span
                                            id="result-message"> </span> </label>
                                <textarea id="message" class="form-control" rows="4"
                                          placeholder="From 5 to 500 characters" minlength="5"
                                          maxlength="500" required="required"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Send comment</button>
                        </form><!-- end form -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="content">
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
    </div>
</body>
<script src="./javascript/js.js"></script>
</html>
