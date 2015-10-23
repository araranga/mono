<?php
 $field = array("accounts_id","username","email");
 $where = getwheresearch($field);
 $total = countquery("SELECT username FROM tbl_accounts");
 //primary query
 $limit = getlimit(10,$_GET['p']);
 $q = mysql_query("SELECT * FROM tbl_accounts $where $limit");
 $options = getpackagelist();
 $pagecount = getpagecount($total,10);


?>
<style>
#dataTables-example_filter , #dataTables-example_info , #dataTables-example_wrapper .row
{
    display:none;
}
</style>
<h2>Users</h2>
<div class="panel panel-default">
   <div class="panel-body">
         <div class="row">
            <div class="col-md-2">
               <div class="panel panel-default">
                  <div class="panel-body">
                    <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=add"; ?>';" type="button" class="btn btn-primary" value="Add New Data">
                  </div>
               </div>
            </div>
            <div class="col-md-10">
               <div class="panel panel-default">
                  <div class="panel-body">
                    Search by: Username,Email,Accounts ID:
                    <form method=''>
                    <input type='text' value='<?php echo $_GET['search']; ?>' name='search'>
                    <input type='hidden' name='pages' value='<?php echo $_GET['pages'];?>'>
                    <input type='submit' name='search_button' class="btn btn-primary"/>
                    </form>
                  </div>
               </div>
            </div>            
         </div>    
      <div class="table-responsive">

         
         <br/>
         <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
            <thead>
               <tr role='row'>
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
            <div class="row">
               <div class="col-sm-6">
                  <div class="dataTables_paginate paging_simple_numbers">
                     <ul class="pagination">
                        <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">1</a></li>
                        <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">2</a></li>
                     </ul>
                  </div>
               </div>
            </div>      
   </div>
</div>
