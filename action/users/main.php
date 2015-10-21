<?php
$q = mysql_query("SELECT * FROM tbl_accounts");

$packrowq = mysql_query("SELECT * FROM tbl_package");
while($packrow = mysql_fetch_assoc($packrowq))
{
	$options[$packrow['package_id']] = $packrow['package_name'];
}
?>
<h2>Users</h2>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
							<input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=add"; ?>';" type="button" class="btn btn-primary btn-lg" value="Add">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Accounts ID</th>
                                            <th>UserName / Password</th>
                                            <th>Package</th>
											<th>Email</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=mysql_fetch_array($q))
									{
									?>
                                        <tr>
                                            <td><?php echo $pid = $row['accounts_id']; ?></td>
                                            <td><?php echo $row['username']; ?> / <?php echo $row['password']; ?></td>
											<td><?php echo $options[$row['package_id']]; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td>
											
											<input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=edit&id=$pid"; ?>';" type="button" class="btn btn-primary btn-sm" value="Edit">
											<input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=delete&id=$pid"; ?>';" type="button" class="btn btn-primary btn-sm" value="Delete">
											</td>
                                        </tr>
									<?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   
