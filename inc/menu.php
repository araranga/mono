<nav class="navbar-default navbar-side" role="navigation">
   <div class="sidebar-collapse">
      <ul class="nav" id="main-menu">
         <li class="text-center">
            <!--<img src="assets/img/<?php echo strtolower($_SESSION['gender']);?>.png" class="user-image img-responsive"/>-->
            <div style='  color: white;text-align: left;margin-left: 9px;'>
               <br/>
               Username: <?php echo $_SESSION['username']; ?>
               <br/>
               Total Money: <?php echo number_format($_SESSION['balance'],2);?> 
               <br/>
               <?php if($_SESSION['role']==1){ echo "Role: Administrator"; } else { echo ""; }?>
            </div>
            <br/>
         </li>
         <li>
            <a class="active-menu" href="index.php"><i class="fa fa-home fa-3x"></i>Dashboard</a>
         </li>
         <li>
            <a href="#"><i class="fa fa-user fa-3x"></i>My Account<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
               <li>
                  <a href="index.php?pages=editprofile">Edit Information</a>
               </li>
               <li>
                  <a href="index.php?pages=changepass">Change Password</a>
               </li>
            </ul>
         </li>
         <li class="">
            <a href="#"><i class="fa fa-money fa-3x"></i>Income Summary<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
               <li>
                  <a href="index.php?pages=withdrawrequest">Withdrawal Request</a>
               </li>
               <li>
                  <a href="index.php?pages=withdrawhistory">Withrawal History</a>
               </li>
            </ul>
         </li>
			<?php if($_SESSION['role']==1)
			{ 
			?>
				 <li class="">
					<a href="#"><i class="fa fa-wrench fa-3x"></i>Administration<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
					   <li>
						  <a href="index.php?pages=packages">Packages</a>
					   </li>
					   <li>
						  <a href="index.php?pages=users">Users</a>
					   </li>
                  <li>
                    <a href="index.php?pages=withdraw">Withdraw</a>
                  </li>                  
					</ul>
				 </li>			
			<?php
			}
			?>
         <li>
            <a href="logout.php"><i class="fa fa-sign-out fa-3x"></i>Logout</a>
         </li>
      </ul>
   </div>
</nav>
<!-- /. NAV SIDE  -->