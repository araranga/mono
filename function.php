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
	function autodetectparent()
	{
		$query ="SELECT username,account_link,cycle_count,id as alink,(SELECT COUNT(id) FROM tbl_relation WHERE parent = alink) as checkparent FROM tbl_cycle HAVING checkparent < 2    ORDER by id ASC LIMIT 1 ";
		return mysql_query($query);
	}
	function autodetectchild($parentid)
	{
	$query = "SELECT username,account_link,cycle_count,id as alink,(SELECT COUNT(id) FROM tbl_relation WHERE child = alink) as checkchild FROM tbl_cycle WHERE id!=$parentid AND id > $parentid HAVING checkchild = 0 ORDER by id ASC LIMIT 1";
		return mysql_query($query);
	}
	function loadcycle($id)
	{
		$q = mysql_query("SELECT * FROM tbl_cycle WHERE id='$id'");
		$row = mysql_fetch_assoc($q);
		return $row;
	}
	function cycleinc($id)
	{
		$user = loadcycle($id);
		$inc = $user['cycle_count'] + 1;
		if($inc==4)
		{
			$username = "adminbonus-".randid();
			$account_link = 1;
			$cycle_count = 1;
			$cycle_link = 0;
			mysql_query("INSERT INTO tbl_cycle SET username='$username',account_link='$account_link',cycle_count='$cycle_count',cycle_link='$cycle_link'");			
		}
		else
		{
			$username = $user['username']."-".$inc;
			$account_link = $user['account_link'];
			$cycle_count = $inc;
			$cycle_link =$id;
			mysql_query("INSERT INTO tbl_cycle SET username='$username',account_link='$account_link',cycle_count='$cycle_count',cycle_link='$cycle_link'");
		}
	}
	function cycleevent($row)
	{
		$rowx = mysql_fetch_assoc(autodetectchild($row['alink']));
		$parent = $row['alink'];
		$child = $rowx['alink'];
		if($child!='')
		{
			mysql_query("INSERT INTO tbl_relation SET parent='$parent',child='$child'");
			$q = mysql_fetch_assoc(mysql_query("SELECT COUNT(parent) as chet FROM tbl_relation WHERE parent='$parent'"));
			if($q['chet']==2)
			{
				cycleinc($parent);
			}
		}
		
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