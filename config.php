<?php
error_reporting(0);

define("DB_HOST", "**secret**");
define("DB_USER", "**secret**");
define("DB_PASSWORD", "**secret**");
define("DB_NAME", "**secret**");

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>
