<?php
require_once "../bd.php";
$pdo_change_article = new  PDODriver($config['host'], $config['username'], $config['password'], $config['database']);
$table = $config['table_article'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_article'])) {
	 $id = $_POST['id_article'];
	 $title = $_POST['title'];
	$text =preg_replace("/&ndash;/", " ", $_POST['text']);
	/*$text  = htmlentities($text, ENT_QUOTES);*/

	 $delete = $_POST['delete'];
	if ($delete != 'delete') {
		$get_id = $pdo_change_article->check_id($table, $id);
		echo " ID FROM BASE $get_id";
		$properties = [
			'title' => $title,
			'text' => $text,
			'pubdate' => date('Y-m-d G:i:s')
		];
		if ($get_id != false) {
			$get_title = $pdo_change_article->update($table, $id, $properties);
		} else {
			$get_title = $pdo_change_article->insert($table, $properties);
		}
	} else {
		$get_title = $pdo_change_article->delete($table, $id);
	}
}


