<?php
include("connect.php");
include("function.php");
$username = '';
for ($x = 0; $x <= 100; $x++) {
	$row = mysql_fetch_assoc(autodetectparent());
	
	if($username!=$row['username']){
		$username = $row['username'];
	}
	else
	{
		break;
	}
	echo $row['username']."<br>";
	if($row['checkparent']==0)
	{
		cycleevent($row);
		cycleevent($row);
	}
	if($row['checkparent']==1)
	{
		cycleevent($row);
	}
} 

?>
