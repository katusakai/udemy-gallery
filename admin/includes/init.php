<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);      //defines this slash symbol \ which is different in different OS
defined('SITE_ROOT') ? null : define('SITE_ROOT', "F:" . DS . "xampp" . DS . "htdocs" . DS . "udemy" . DS . "udemy-gallery");
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS. 'includes');


require_once("functions.php");
require_once("config.php");
require_once("database.php");
require_once("db_object.php");
require_once("user.php");
require_once("session.php");
require_once("photo.php");



?>
