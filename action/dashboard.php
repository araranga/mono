﻿<?php
session_start();
require_once("./connect.php");
require_once("./function.php");

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
  width: 100%;
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
<div class="row" onload="resettab()">
<div class="col-md-12 col-sm-12">

<div id="incomeSummary">
	<div>Income Summary</div>
	<div class="panel-heading top">
		<label class="field">Total Earnings :</label>
		<label class="fieldVal">
			<?php
			echo number_format($_SESSION['total_earnings'],2);
			?>
		</label>
	</div>

	<div class="panel-heading">
		<label class="field">Total Available Balance :</label>
		<label class="fieldVal">
			<?php
			echo number_format($_SESSION['balance'],2);
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
            <?php
			   $rate = getRate($_SESSION['package_id']);
               $q = mysql_query("SELECT * FROM tbl_cycle WHERE account_link='".$_SESSION['accounts_id']."' AND cycle_count=1");
               ?>
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>Account #</th>
                        <th>Cycle 1</th>
                        <th>Cycle 2</th>
                        <th>Cycle 3</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        while($row=mysql_fetch_array($q))
                        {
							$stat = array();
							if($row['cycle_status']==1) { $stat[1] = $rate; } else { $stat[1] = "Ongoing"; }
							
							$count = mysql_num_rows(mysql_query("SELECT id FROM tbl_cycle WHERE cycle_link='".$row['id']."' AND cycle_status=1"));
							if($count==2)
							{
								$stat[2] = $rate;
								$stat[3] = $rate;
							}
							else if($count==1)
							{
								$stat[2] = $rate;
								$stat[3] = "Ongoing";								
							}
							else
							{
								$stat[2] = "Ongoing";
								$stat[3] = "Ongoing";								
							}
                        ?>
                     <tr>
                        <td><?php echo $pid = $row['username']; ?></td>
                        <td><?php echo $stat[1];?></td>
                        <td><?php echo $stat[2];?></td>
                        <td><?php echo $stat[3];?></td>
                     </tr>
                     <?php
                        }
                        ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>


<script>
function numberand()
{
  return Math.floor((Math.random() * 10000) + 1);
}
</script>

