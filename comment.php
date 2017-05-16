<?php
require_once "bd.php";
$pdo_comment = new  PDODriver($config['host'], $config['username'], $config['password'], $config['database']);
$table = $config['table_comments'];
//открываем сессию
/*session_start();*/
// переменная, в которую будем сохранять результат работы
$data['result']='error';

// функция для проверки длины строки
function validStringLength($string,$min,$max) {
	$length = mb_strlen($string,'UTF-8');
	if (($length<$min) || ($length>$max)) {
		return false;
	}
	else {
		return true;
	}
}

// если данные были отправлены методом POST, то...
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// устанавливаем результат, равный success
	$data['result']='success';
	//получить имя, которое ввёл пользователь
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		if (!validStringLength($name,2,30)) {
			$data['name']='Поля имя содержит недопустимое количество символов.';
			$data['result']='error';
		}
	} else {
		$data['result']='error';
	}
	//получить email, который ввёл пользователь
	if (isset($_POST['email'])) {
		$email = $_POST['email'];
		if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			$data['email']='Email error';
			$data['result']='error';
		}
	} else {
		$data['result']='error';
	}
	//получить сообщение, которое ввёл пользователь
	if (isset($_POST['message'])) {
		$message = $_POST['message'];
		if (!validStringLength($message,5,500)) {
			$data['message']='Поле сообщение содержит недопустимое количество символов.';
			$data['result']='error';
		}
	} else {
		$data['result']='error';
	}

} else {
	//данные не были отправлены методом пост
	$data['result']='error';
}

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
// формируем ответ, который отправим клиенту
echo json_encode($data);
?>