<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_assoc($q);
function trans()
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 12; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

	if($_POST['submit']!='')
	{
		if($_POST['password']!=$row['password'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Password do not match.<br>";
		}
		if($_POST['withdraw']==0 || $_POST['withdraw']<0)
		{
						$error .= "<i class=\"fa fa-warning\"></i>Please input valid and not empty amount to withdraw.<br>";
		}
		if($_POST['withdraw']>$row['balance']) 
		{
			$error .= "<i class=\"fa fa-warning\"></i>Amount to withdraw(".$_POST['withdraw'].") is insufficient on current balance(".$row['balance']."). Please input valid amount.<br>";
		}
		
		if($error=='')
		{
		$sum  = $row['balance'] - $_POST['withdraw'];
		mysql_query("UPDATE tbl_accounts SET balance='".$sum."' WHERE accounts_id='$accounts_id'");
		$success = 1;
		$trans = trans();
		mysql_query("INSERT INTO tbl_withdraw_history SET cp_number='".$_POST['cp_number']."',team_name='".$_POST['team_name']."',transnum='$trans',remit_name='".$_POST['remit_name']."',smartpadala='".$_POST['smartpadala']."',claimtype='".$_POST['claimtype']."',name='".$_POST['name']."',phone='".$_POST['phone']."',address='".$_POST['address']."',accounts_id='$accounts_id',new_balance='".$sum."',amount='".$_POST['withdraw']."',current_balance='".$row['balance']."',bank_name='".$_POST['bank_name']."',bank_accountname='".$_POST['bank_accountname']."',bank_accountnumber='".$_POST['bank_accountnumber']."'");
		$q = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
		$row = mysql_fetch_assoc($q);		
		}
	}
	
$field[] = array("type"=>"text","value"=>"bank_name","label"=>"Bank Name");
$field[] = array("type"=>"text","value"=>"bank_accountname","label"=>"Account Name");
$field[] = array("type"=>"text","value"=>"bank_accountnumber","label"=>"Account Number");
//
$field[] = array("type"=>"text","value"=>"name","label"=>"Fullname");
$field[] = array("type"=>"text","value"=>"address","label"=>"Address");
$field[] = array("type"=>"text","value"=>"phone","label"=>"Phone Number");
//
$field[] = array("type"=>"number","value"=>"withdraw","label"=>"Amount to withraw");
$field[] = array("type"=>"password","value"=>"password","label"=>"Please enter password");
//
?>
<h2>Withdrawal Request - Balance(<?php echo $row['balance'];?>)</h2>   
<?php
if($error!='')
{
?>
<div class="warning"><ul class="fa-ul"><li><?php echo $error;?></li></ul></div>
<?php
}
?>

<style>
.bank,.remit,.remitmain,.smartpadala,.antibug
{
	display:none;
}
</style>
<?php
if($success!='')
{
?>
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done requesting for withdrawal please see status <a href='?pages=withdrawhistory'>here</a> </li></ul></div>
<?php
}
?>

<form method="POST" action="">
   <table width="100%">
      <tbody>

         <tr>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Widrawal Type</label></td>
            <td>
				<select name='claimtype' onchange="widraw(this.value)" required>
						<option>Select Mode of Widrawal</option>
						<option value='pickup'>Pick up</option>
						<option value='bank'>Bank Deposit</option>
				</select>											
            </td>
         </tr>


         <tr class='bankremit'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Team Name:</label></td>
            <td>
               <input style="width: 302px;" required="" type="text" name="team_name" id="team_name" size="40" maxlength="255" value="">
               <span class="validation-status"></span>												
            </td>
         </tr>
         <tr class='bankremit'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">CP Number:</label></td>
            <td>
               <input style="width: 302px;" required="" type="text" name="cp_number" id="cp_number" size="40" maxlength="255" value="">
               <span class="validation-status"></span>												
            </td>
         </tr>
         <tr class='bank'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Bank Name:</label></td>
            <td>
               <input style="width: 302px;" required="" type="text" name="bank_name" id="bank_name" size="40" maxlength="255" value="">
               <span class="validation-status"></span>												
            </td>
         </tr>
         <tr class='bank'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Account Name:</label></td>
            <td>
               <input style="width: 302px;" required="" type="text" name="bank_accountname" id="bank_accountname" size="40" maxlength="255" value="">
               <span class="validation-status"></span>												
            </td>
         </tr>
         <tr class='bank'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Account Number:</label></td>
            <td>
               <input style="width: 302px;" required="" type="text" name="bank_accountnumber" id="bank_accountnumber" size="40" maxlength="255" value="">
               <span class="validation-status"></span>												
            </td>
         </tr>


         <tr class='smartpadala'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Smart Padala No.:</label></td>
            <td>
               <input style="width: 302px;" required="" type="text" name="smartpadala" id="smartpadala" size="40" maxlength="255" value="">
               <span class="validation-status"></span>												
            </td>
         </tr>
         <tr class='remitmain'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Remittance (eg. Cebunana/Palawan):</label></td>
            <td>
				<select name='remit_name' onchange="widraw(this.value)">
						<option value='Cebuana'>Cebuana</option>
						<option value='Palawan Express'>Palawan Express</option>
				</select>	
               <span class="validation-status"></span>												
            </td>
         </tr>
         <tr class='remit'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Fullname:</label></td>
            <td>
               <input style="width: 302px;" required="" type="text" name="name" id="namex" size="40" maxlength="255" value="">
               <span class="validation-status"></span>												
            </td>
         </tr>
         <tr class='remit'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Address:</label></td>
            <td>
               <input style="width: 302px;" required="" type="text" name="address" id="addressx" size="40" maxlength="255" value="">
               <span class="validation-status"></span>												
            </td>
         </tr>
         <tr class='remit'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Phone Number:</label></td>
            <td>
               <input style="width: 302px;" required="" type="text" name="phone" id="phonex" size="40" maxlength="255" value="">
               <span class="validation-status"></span>												
            </td>
         </tr>





         <tr class='antibug'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Amount to withraw:</label></td>
            <td>
               <input style="width: 302px;" required="" type="number" name="withdraw" id="withdraw" size="40" maxlength="255" value="">
               <span class="validation-status"></span>												
            </td>
         </tr>
         <tr class='antibug'>
            <td style="width:180px;" class="key" valign="top"><label for="accounts_name">Please enter password:</label></td>
            <td>
               <input style="width: 302px;" required="" type="password" name="password" id="password" size="40" maxlength="255" value="">
               <span class="validation-status"></span>												
            </td>
         </tr>
      </tbody>
   </table>
   <br>
   <center><input class="btn btn-primary btn-lg" type="submit" name="submit" value="Process"></center>
</form>
<script>
function widraw(myval)
{



if(myval=='smartpadala')
{
		$('#bank_name').val('na');
		$('#bank_accountname').val('na');
		$('#bank_accountnumber').val('na');
		$('#namex').val('');
		$('#addressx').val('');
		$('#phonex').val('');
		$('#smartpadala').val('');
		$( ".remit" ).each(function() {
			$(this).show();
		});
		$( ".bank" ).each(function() {
			$(this).hide();
		});			
		$( ".smartpadala" ).each(function() {
			$(this).show();
		});		
		$( ".remitmain" ).each(function() {
			$(this).hide();
		});	
		$( ".bankremit" ).each(function() {
			$(this).hide();
		});			
		$( ".antibug" ).each(function() {
			$(this).show();
		});		

}





if(myval=='remit')
{
		$('#bank_name').val('na');
		$('#bank_accountname').val('na');
		$('#bank_accountnumber').val('na');
		$('#namex').val('');
		$('#addressx').val('');
		$('#phonex').val('');
		$('#smartpadala').val('na');		
		$( ".remit" ).each(function() {
			$(this).show();
		});
		$( ".bank" ).each(function() {
			$(this).hide();
		});	
		$( ".smartpadala" ).each(function() {
			$(this).hide();
		});		
		$( ".remitmain" ).each(function() {
			$(this).show();
		});	
		$( ".antibug" ).each(function() {
			$(this).show();
		});	
		$( ".bankremit" ).each(function() {
			$(this).show();
		});	
}


if(myval=='bank')
{
		$('#bank_name').val('');
		$('#bank_accountname').val('');
		$('#bank_accountnumber').val('');	
		$('#namex').val('na');
		$('#addressx').val('na');
		$('#phonex').val('na');
		$('#smartpadala').val('na');			
		$( ".remit" ).each(function() {
			$(this).hide();
		});
		$( ".bank" ).each(function() {
			$(this).show();
		});
		$( ".smartpadala" ).each(function() {
			$(this).hide();
		});		
		$( ".remitmain" ).each(function() {
			$(this).hide();
		});	
		$( ".antibug" ).each(function() {
			$(this).show();
		});	
		$( ".bankremit" ).each(function() {
			$(this).show();
		});	

}


if(myval=='pickup')
{
		$('#bank_name').val('na');
		$('#bank_accountname').val('na');
		$('#bank_accountnumber').val('na');	
		$('#namex').val('na');
		$('#addressx').val('na');
		$('#phonex').val('na');	
		$('#smartpadala').val('na');				
		$( ".remit" ).each(function() {
			$(this).hide();
		});
		$( ".bank" ).each(function() {
			$(this).hide();
		});		
		$( ".smartpadala" ).each(function() {
			$(this).hide();
		});		
		$( ".remitmain" ).each(function() {
			$(this).hide();
		});	
		$( ".antibug" ).each(function() {
			$(this).show();
		});	
		$( ".bankremit" ).each(function() {
			$(this).hide();
		});					

}



}
</script>
