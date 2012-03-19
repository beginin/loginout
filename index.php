<?php


if (!isset($_POST['in']) || !isset($_POST['user']) || !isset($_POST['comp'])) die('no param');

$link = mysql_connect('localhost', 'ad', 'zYmUMJfpzJLpuKSc');
if (!$link) die('Could not connect: ' . mysql_error());


$in = mysql_real_escape_string($_POST['in']);
$user = mysql_real_escape_string($_POST['user']);
$comp = mysql_real_escape_string($_POST['comp']);


$sql = "set names 'utf8';";
$result = mysql_query($sql, $link);
if (!$result) die('Invalid query: ' . mysql_error());



$sql = "
		 INSERT INTO `ad`.`log_in_out`
		 (`id`,`in`, `User`, `Comp`, `Time`)
		 VALUES
		 (NULL, '$in', '$user', '$comp', CURRENT_TIMESTAMP);
";

$result = mysql_query($sql, $link);
if (!$result) die('Invalid query: ' . mysql_error());
mysql_close($link);

?>

