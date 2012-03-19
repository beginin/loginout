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
echo '<meta name="keywords" content="íÕÌØÔÉÍÁ">'; 
echo '<meta name="description" content="íÕÌØÔÉÍÁ">'; 



$sql = "set names 'utf8';";
$result = mysql_query($sql, $link);
if (!$result) die('Invalid query: ' . mysql_error());


$sql = "SELECT * FROM  `ad`.`log_in_out`  ";
$sql1 = "SELECT `Comp` FROM `ad`.`log_in_out` WHERE `Time` > DATE_ADD(NOW(), INTERVAL -60 DAY)  GROUP BY `Comp`";

$result = mysql_query($sql, $link);
if (!$result) die('Invalid query: ' . mysql_error());

$result1 = mysql_query($sql1, $link);
if (!$result1) die('Invalid query: ' . mysql_error());

$i=0;
while ($info = mysql_fetch_array( $result1 ))
{
    $people[$i]=$info['Comp'];
    $i=$i+1;
}

$arr = array();
foreach ($people as $k => $man)
{
    $arrman = array();
    $man_sql=mysql_real_escape_string($man);
    $sql = "SELECT * FROM `ad`.`log_in_out` WHERE `Comp`='$man_sql'   ORDER BY `ad`.`log_in_out`.`Time`  DESC limit 5 ";
    $result = mysql_query($sql, $link);
    if (!$result) die('Invalid query: ' . mysql_error());
    //echo "<br>";
    //echo $man;
    
    $arrman['name'] = $man;
    while ($info = mysql_fetch_array( $result ))
    {
	$arrman['logs'][] = $info;
#	echo "<br>";
#	if ($info['in']==true){echo "Ð²Ñ…Ð¾Ð´";}
#	else {echo "Ð²Ñ‹Ñ…Ð¾Ð´";}; 
#	echo " ";
#	echo $info['Comp'];
#	echo " ";
#	echo $info['Time'];
	
    }
    $arr[] = $arrman;
    
} 




#while($info = mysql_fetch_array( $result1 ))
#{
#    echo $info['User'];
#    echo "||";
#    while($info1 = mysql_fetch_array( $result ))
#    {
#	if (!strcmp($info['User'],$info1['User']))
#	{    
#	    echo "<br>";
#	    echo $info1['Comp'];
#	    echo " ";
#	    echo $info1['Time'];
#	    echo "       ";
#	}
#    }
#    #echo $info['Comp'];
#    #echo "||| ";
#
#}


mysql_close($link);


?>

<?php foreach($arr as $man): ?>
<div>
		 <a href="#" onclick="
		 		 var id = '<?php echo md5($man['name']); ?>';
		 		 if (document.getElementById(id).style.display != 'block')
		 		 {document.getElementById(id).style.display = 'block'}
		 		 else {document.getElementById(id).style.display = 'none'}
		 		 return false;"><?php echo $man['name'];  ?></a>
<div id="<?php echo md5($man['name']); ?>" style="display: none;">
<?php foreach($man['logs'] as $row): ?>
<div>
<?php 
if ($row['in']==true){echo "Ð²Ñ…Ð¾Ð´";}
else {echo "Ð²Ñ‹Ñ…Ð¾Ð´";}; 
echo " ";
echo $row['Time']." ";
echo $row['User']." "; 

?></div>
<?php endforeach; ?>
</div>
</div>
<?php endforeach; ?>
