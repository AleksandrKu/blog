<?php
require_once "bd.php";
$pdo_comment = new  PDODriver($config['host'], $config['username'], $config['password'], $config['database']);
$table = $config['table_comments'];

$data['result']='error';

function validStringLength($string,$min,$max) {
	$length = mb_strlen($string,'UTF-8');
	if (($length<$min) || ($length>$max)) {
		return false;
	}
	else {
		return true;
	}
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$data['result']='success';

	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		if (!validStringLength($name,2,30)) {
			$data['name']='Error';
			$data['result']='error';
		}
	} else {
		$data['result']='error';
	}
	// email
	if (isset($_POST['email'])) {
		$email = $_POST['email'];
		if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			$data['email']='Email error';
			$data['result']='error';
		}
	} else {
		$data['result']='error';
	}
	//message
	if (isset($_POST['message'])) {
		$message = $_POST['message'];
		if (!validStringLength($message,5,500)) {
			$data['message']='Error.';
			$data['result']='error';
		}
	} else {
		$data['result']='error';
	}

} else {
	// not method POST
	$data['result']='error';
}
date_default_timezone_set('Europe/Kiev');
if ($data['result']=='success') {
	$properties = [
		'articles_id' => (int)($_POST['id_article']),
		'author' => $name,
		'email' => $email,
		'text' => $message,
		'pubdate' => date('Y-m-d G:i:s')
	];
	$get_title = $pdo_comment->insert($table, $properties);
}
// answer
echo json_encode($data);
