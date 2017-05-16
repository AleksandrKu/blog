<?php

class PDODriver
{
	private $connection;

	public function __construct($server, $username, $password, $database)
	{
		$this->connection = new \PDO("mysql:host={$server};dbname={$database}", $username, $password);
	}

	public function getConnection()
	{
		return $this->connection;
	}

	public function delete($table, $id)
	{
		$sql = "DELETE FROM {$table} WHERE id = :id";
		$stm = $this->connection->prepare($sql);
		$parameters = ['id' => $id];
		$execute_res = $stm->execute($parameters);
		if ($execute_res == false) {
			throw new \Exception($stm->errorInfo()[2]);
		}
		return true;
	}

	public function insert($table, array $properties)
	{
		$sql = "INSERT INTO `{$table}` ";
		$sql .= "(" . implode(',', array_keys($properties)) . ")";
			$sql .= " VALUES ";
		foreach ($properties as $column_name => $value) {
			$values_array[] = ":{$column_name}";
		}
		$sql .= "(" . implode(',', $values_array) . ")";
		/*echo $sql;
		die();*/
		$stm = $this->connection->prepare($sql);
		$execute_res = $stm->execute($properties);
		if($execute_res == false) {
			throw new \Exception($stm->errorInfo()[2]);
		}
		return $this->connection->lastInsertId();
	}

	public function update($table, $id, array $properties)
{
	$sql = "UPDATE {$table} SET ";
	$update_sql = [];
	foreach ($properties as $column_name => $value) {
		$update_sql[] = "{$column_name}=:{$column_name}";
	}
	$sql .= implode(", ", $update_sql);
	$sql .= " WHERE id =:id";

	$stm = $this->connection->prepare($sql);
	$properties['id'] = $id;
	$execute_res = $stm->execute($properties);
	if ($execute_res == false) {
		throw new \Exception($stm->errorInfo()[2]);
	}
}

	public function check_id($table, $id)
	{
		$get_id = $this->connection->prepare("SELECT * FROM {$table} WHERE id=:id");
		$get_id->execute(['id' => $id]);
		$name = $get_id->fetchColumn();
		 return $name;
	}
	public function get_text($id)
	{
		$get_text = $this->connection->prepare("SELECT text FROM articles WHERE id=:id");
		$get_text->execute(['id' => $id]);
		$view = $get_text->fetchObject();
		return $view->text;
	}
	public function get_title($id)
	{
		$get_text = $this->connection->prepare("SELECT title FROM articles WHERE id=:id");
		$get_text->execute(['id' => $id]);
		$view = $get_text->fetchObject();
		return $view->title;
	}
}