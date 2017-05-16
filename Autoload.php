<?php
class Autoload
{

	public static function load_class($class_name)
	{
		$class_path = str_replace("\\", '/', $class_name);
		$class_path = __DIR__ . "/" . $class_path . ".php";
		if (file_exists($class_path)) {
			require_once $class_path;
		} else {
			throw  new Exception("No such file");

		}
	}
}
