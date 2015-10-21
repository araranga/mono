<?php
session_start();
include("../../connect.php");
include("../../function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query("SELECT * FROM tbl_withdraw_history WHERE accounts_id='$accounts_id' ORDER by history DESC");

?>
<h2>Withdrawal History</h2>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tracking Number #</th>
                                            <th>Amount</th>
                                            <th>Balance Remaining</th>
											<th>Claim Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=mysql_fetch_array($q))
									{
									?>
                                        <tr>
                                            <td><?php echo $row['transnum']; ?></td>
                                            <td><?php echo $row['amount']; ?></td>
                                            <td><?php echo $row['new_balance']; ?></td>
											<?php
											$tracking = $row['id']+1000000;
											?>
											<th>
                                                <?php 
                                                if($row['claim_status']==0 && $row['claimtype']=='pickup'){ 
                                                echo "Pickup - <a href='pdf/withdrawal.php?id=".$row['transnum']."' target='_newtab'>Download Form Here</a>"; 
                                                }
                                                if($row['claim_status']==0 && $row['claimtype']=='remit'){ 
                                                    echo "On Process (Remittance) - ".$row['remit_name'];
                                                }

                                                if($row['claim_status']==0 && $row['claimtype']=='bank'){ 
                                                    echo "On Process (Bank Deposit) - ".$row['bank_name'];
                                                }
                                                if($row['claim_status']==0 && $row['claimtype']=='smartpadala'){ 
                                                    echo "On Process (Smart Padala)";
                                                }                                                

                                                if($row['claim_status']==1)
                                                {     
                                                    echo "<p>Claimed</p>";
                                                }
                                                ?>
                                            </th>
                                            <td><?php echo $row['history']; ?></td>
                                        </tr>
									<?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   
