<?php
include("connect.php");
include("function.php");
$row = mysql_fetch_assoc(autodetectparent());
if($row['checkparent']==0)
{
	cycleevent($row);
	cycleevent($row);
}
if($row['checkparent']==1)
{
	cycleevent($row);
}



?>
