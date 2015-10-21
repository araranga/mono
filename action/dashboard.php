<?php
session_start();
include("../../connect.php");
include("../../function.php");
?>
 <style>
 #incomeSummary > .panel-heading {
  color: #3c763d;
  background-color: #dff0d8;
  border-color: #d6e9c6;
  border: 1px solid #dff0d8;
}
#transactionSummary > .panel-heading {
  color: #8a6d3b;
  background-color: #fcf8e3;
  border-color: #faebcc;
  border: 1px solid #fcf8e3;
}
.panel-heading {
  padding: 10px 15px;
  border-bottom: 1px solid transparent;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
}
.panel-heading.top {
  border-bottom-left-radius: 8px;
  border-bottom-right-radius: 8px;
  margin-bottom: 5px;
}
.panel-heading > .fieldVal {
	font-weight: bold;
}
div#incomeSummary, div#transactionSummary {
  display: inline-block;
  width: 48%;
  margin: 7px;
  float: left;
}
.tABContent, .tPCContent {
  border: 1px solid #dff0d8;
  padding: 5px;
}
.tPCContent {
  border: 1px solid #fcf8e3;
  padding: 5px;
}
</style>
<?php
$capital = mysql_query("SELECT c.rate_start FROM tbl_accounts as a JOIN tbl_code as b JOIN tbl_rate as c WHERE accounts_id='".$_SESSION['accounts_id']."'
AND c.rate_id=b.code_package AND a.code_id=b.code_value");
$capital_row  = mysql_fetch_assoc($capital);

$capitalsum = mysql_query("SELECT SUM(amount) as sum FROM tbl_withdraw_history WHERE accounts_id='".$_SESSION['accounts_id']."'");
$capital_row_sum  = mysql_fetch_assoc($capitalsum);

if($capital_row['rate_start']=='')
{
    $capital_row['rate_start'] = 0;
}
$accounts_id = $_SESSION['accounts_id'];
$expenses = mysql_query("SELECT SUM(b.rate_start) as sum FROM tbl_buycode_history as a JOIN tbl_rate as b
WHERE a.accounts_id='$accounts_id' AND b.rate_id=a.package_id");
$expenses_row = mysql_fetch_array($expenses);

$q = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_assoc($q);



$total_earnings = $row['balance'] + $capital_row_sum['sum'];
$total_available_balance = $row['balance'];
$total_purchased_code = $expenses_row['sum'] + 0;
$total_widrawals = $capital_row_sum['sum'];
?>

<div class="row" onload="resettab()">
<div class="col-md-12 col-sm-12">

<div id="incomeSummary">
	<div>Income Summary</div>
	<div class="panel-heading top">
		<label class="field">Total Earnings :</label>
		<label class="fieldVal">
			<?php
			echo number_format($total_earnings,2);
			?>
		</label>
	</div>

	<div class="panel-heading">
		<label class="field">Total Available Balance :</label>
		<label class="fieldVal">
			<?php
			echo number_format($total_available_balance,2);
			?>
		</label>
	</div>
	<div class="tABContent">
		<?php 
		 echo '<a href="index.php?pages=withdrawrequest">Widrawal Request</a><br>';
		 echo '<a href="index.php?pages=withdrawhistory">Widrawal History</a>';
		?>
	</div>
</div>
</div>
</div>





<div class="row">
<div class="col-md-12 col-sm-12">




    <div class="panel panel-default">
        <div class="panel-heading">
			My Accounts      
        </div>        
        <div class="panel-body">
			---table---
        </div>
    </div>
</div>            
</div>


<script>
function numberand()
{
  return Math.floor((Math.random() * 10000) + 1);
}
function resetall()
{
	//.nav-tabs li
jQuery( ".nav-tabs li" ).each(function() {
  jQuery( this ).removeClass( "active" );
});	
	
	
}
function homeloader()
{
         jQuery("#home").html('<p style="color: green;font-weight: 700;"><i class="fa fa-cog fa-spin"></i> Loading your Table details please wait...</p>');
}
function resetbug()
{
         jQuery("#home").html('<p style="color: green;font-weight: 700;"><i class="fa fa-error"></i>Your History is not available. Sorry.</p>');
}
function resettab()
{

    homeloader();
    jQuery.post("dashboard/downline<?php echo $qxrow2['rate_req'];?>.php?cache="+numberand(), function(result){
        jQuery("#home").html(result);
    });
}
function switchtab(tpl,curtbl)
{

    homeloader();
    jQuery.post("dashboard/"+tpl+".php?cache="+numberand()+"&tbl="+curtbl, function(result){
        jQuery("#home").html(result);
    });
}

</script>

