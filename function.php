<?php
function getbaseme()
{
	$q = mysql_query("SELECT * FROM tbl_core_config_data WHERE path='web/unsecure/base_url'");
	$row = mysql_fetch_array($q);
	return $row['value'];
}
	function countfield($field,$value)
	{
		$query = mysql_query("SELECT * FROM tbl_accounts WHERE $field='$value'");
		return mysql_num_rows($query);
	}
	function formquery($post)
	{
	$return = array();
	foreach($post as $key=>$val)
	{
		$return[] = "$key='$val'";
	}
	 return implode(",",$return);
	}

	function randid()
	{
		return rand().strtotime("now");
	}
	function totalaccount()
	{
		$query = "SELECT username,accounts_id as aid,(SELECT COUNT(id) FROM tbl_cycle WHERE account_link = aid AND cycle_count=1 AND cycle_link = 0) as totalacct,account_count FROM tbl_accounts as acct
		JOIN tbl_package as pck WHERE pck.package_id = acct.package_id
		HAVING totalacct < account_count LIMIt 1";
		return mysql_query($query);

	}

	function autocreateaccount()
	{
		while($row=mysql_fetch_assoc(totalaccount()))
		{
			$limit  = $row['account_count'] - $row['totalacct'];
			$aid = $row['aid'];
			for ($x = 1; $x <= $limit; $x++) {
				$username = $row['username']."-".randid();
				mysql_query("INSERT INTO tbl_cycle SET username='$username',account_link='$aid',cycle_count='1',cycle_link='0'");
			}			
			return;
		}
	}


function success200($curtbladded,$id)
{
$log  = '';
			$q1 = mysql_query("SELECT parent as parentx,curtbl,(SELECT COUNT(child) FROM tbl_othertablebeta WHERE parent=parentx AND curtbl='$curtbladded') AS total FROM tbl_othertablebeta WHERE curtbl = '$curtbladded' AND parent!=0
			GROUP by parent
			HAVING total < 2");			
			$q1row = mysql_fetch_assoc($q1);
			if($q1row['parentx']=='')
			{
				$q2 = mysql_query("SELECT child FROM tbl_othertablebeta  WHERE curtbl='$curtbladded' AND child NOT IN (SELECT parent FROM tbl_othertablebeta WHERE curtbl='$curtbladded') GROUP by child ORDER BY id ASC LIMIT 0 , 1");			
				$q2row = mysql_fetch_assoc($q2);
				if($q2row['child']!='')
				{
					mysql_query("INSERT INTO tbl_othertablebeta SET curtbl='$curtbladded',child='$id',parent='".$q2row['child']."'");								
				}
				else
				{
					$q3 = mysql_query("SELECT child FROM tbl_othertablebeta WHERE parent=0 AND curtbl='$curtbladded'");									
					if(mysql_num_rows($q3)==0)
					{
					mysql_query("INSERT INTO tbl_othertablebeta SET curtbl='$curtbladded',child='$id',parent='0'");						
					}
					else
					{
					$q3row = mysql_fetch_assoc($q3);
					mysql_query("INSERT INTO tbl_othertablebeta SET curtbl='$curtbladded',child='$id',parent='".$q3row['child']."'");											
					mysql_query("DELETE FROM tbl_othertablebeta WHERE child='".$q3row['child']."' AND parent='0' AND curtbl='$curtbladded'");
					} 
				}
			} 
			else
			{	
				mysql_query("DELETE FROM tbl_othertablebeta WHERE child='".$q1row['parentx']."' AND parent='0' AND curtbl='$curtbladded'");
				mysql_query("INSERT INTO tbl_othertablebeta SET curtbl='$curtbladded',child='$id',parent='".$q1row['parentx']."'");						
			}	
			
			#mysql_query("INSERT INTO tbl_logger SET acc='$id',log='$log'");
	
}
function mytimestamp()
{
	return date('Y-m-d H:i:s');
} 

function getrow($var)
{
	$array['title'] = 'Monoline';
	$array['image'] = 'https://placeholdit.imgix.net/~text?txtsize=19&txt=150%C3%97150&w=200&h=75';
	return $array;
}	
?>