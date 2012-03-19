<?php


#if (!isset($_POST['in']) || !isset($_POST['user']) || !isset($_POST['comp'])) die('no param');

#$in = mysql_real_escape_string($_POST['in']);

#$user = mysql_real_escape_string($_POST['user']);
#$user = mysql_real_escape_string(iconv('cp1252','utf-8',$_POST['user']));

#$comp = mysql_real_escape_string($_POST['comp']);

$link = mysql_connect('localhost', 'ad', 'zYmUMJfpzJLpuKSc');
if (!$link) die('Could not connect: ' . mysql_error());


#$sql = "
#		 INSERT INTO `ad`.`log_in_out`
#		 (`id`,`in`, `User`, `Comp`, `Time`)
#		 VALUES
#		 (NULL, '$in', '$user', '$comp', CURRENT_TIMESTAMP);
#";

echo "<html>"; 
echo "<head>"; 
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'; 
echo '<meta name="keywords" content="碚特陨土">'; 
echo '<meta name="description" content="碚特陨土">'; 



$sql = "set names 'utf8';";
$result = mysql_query($sql, $link);
if (!$result) die('Invalid query: ' . mysql_error());


$sql = "SELECT * FROM  `ad`.`log_in_out`  ";


$result = mysql_query($sql, $link);
if (!$result) die('Invalid query: ' . mysql_error());

while($info = mysql_fetch_array( $result ))
{
echo $info['User'];
echo "||";
echo $info['Comp'];
echo "||| ";

}


mysql_close($link);


?>

