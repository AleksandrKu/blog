<?php
require_once("Classes/PDODriver.php");
$config = require_once "config.php";
$pdo_get = new  PDODriver($config['host'], $config['username'], $config['password'], $config['database']);