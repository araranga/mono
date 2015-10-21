<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];

	if($_POST['submit']!='')
	{
	
		if($_POST['new_password1']!=$_POST['new_password2'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Input password is mismatch.<br>";

		}
		if($_POST['old_password']!=$_SESSION['password'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Please input the current password correctly.<br>";
		}
		
		if($error=='')
		{
		$_SESSION['password'] = $_POST['new_password1'];
		unset($_POST['submit']);
		$fields = formquery($_POST);
		mysql_query("UPDATE tbl_accounts SET password='".$_POST['new_password1']."' WHERE accounts_id='$accounts_id'");
		$success = 1;
		}
	}



$field[] = array("type"=>"password","value"=>"old_password","label"=>"Old Password");
$field[] = array("type"=>"password","value"=>"new_password1","label"=>"New Password");
$field[] = array("type"=>"password","value"=>"new_password2","label"=>"Confirm Password");
//
?>
<h2>Change Password</h2>   
<?php
if($error!='')
{
?>
<div class="warning"><ul class="fa-ul"><li><?php echo $error;?></li></ul></div>
<?php
}
?>


<?php
if($success!='')
{
?>
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done updating your password!.</li></ul></div>
<?php
}
?>



<form method='POST' action=''>
<table width="100%">
						<?php
						$is_editable_field = 1;
						foreach($field as $inputs)
						{
												if($inputs['label']!='')
												{
												$label = $inputs['label'];
												}
												else
												{
												$label = ucwords($inputs['value']);
												}
						?>
									<!---weee--->
										<tr>
											<td style="width:180px;" class="key" valign="top" ><label for="accounts_name"><?php echo $label; ?><?php echo $req_fld?>:</label></td>
											<?php if ( $is_editable_field ) { ?>
											<td>
											<?php
											if ($inputs['type']=='select')
											{
												if($$inputs['value']!='' && $inputs['value']=='code_id')
												{ 
												 $code = $$inputs['value'];
												 $codeqq = mysql_query("SELECT * FROM tbl_code as a JOIN tbl_rate as b JOIN tbl_accounts as c WHERE c.code_id=a.code_value AND a.code_value='$code' AND a.code_package=b.rate_id");
												 $coderow = mysql_fetch_array($codeqq);
												 
												//asds
												
												echo "Package Name"." : ".$coderow['rate_name'];
												echo "<br>";
												echo "Registration FEE"." : ".$coderow['rate_start'];
												echo "<br>";
												echo "Salary"." : ".$coderow['rate_end'];
												echo "<br>";
												echo "Code Value - Code Pin"." : ".$coderow['code_value']." - ".$coderow['code_pin'];
												echo "<br><br>";
												echo "Total Earnings"." : ".$coderow['total_earnings'];
												echo "<br>";
												echo "Current Balance"." : ".$coderow['balance']; 
												//
												}
												else
												{
													
												
											
												?>
												<select name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" required <?php echo $inputs['attr']; ?>>
												<?php
												foreach($inputs['option'] as $val)
												{
													?>
													<option <?php if($$inputs['value']==$val){echo"selected='selected'";} ?> value='<?php echo $val;?>'><?php echo $val;?></option>
													<?php
												}
												?>
												</select>
												<span class="validation-status"></span>
												<?php
												}
											}
											else
											{
												?>
												<input required <?php echo $inputs['attr']; ?> type="<?php echo $inputs['type']; ?>" name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" size="40" maxlength="255" value="<?php echo $$inputs['value']; ?>" />
												<span class="validation-status"></span>												
												<?php
											}
											?>

											</td>
											<?php } else { ?>
											<td><?php echo $$inputs['value']; ?></td>
											<?php } ?>                                                                                                    
										</tr>
						<?php
						}
						?>
</table>
<center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Update'></center>
</form>