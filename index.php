<?php
session_start();
include("connect.php");
include("function.php");
if($_SESSION['accounts_id']=='')
{
exit("<script> window.location='login.php' </script>");
}
$main = getrow("tbl_logo");
$tablerowxxx = "tbl_accounts";
$queryrowxxx = "SELECT * FROM $tablerowxxx WHERE accounts_id='".$_SESSION['accounts_id']."'";
$qrowxxx = mysql_query($queryrowxxx);
$rowxxx = mysql_fetch_assoc($qrowxxx);
foreach($rowxxx as $key=>$val)
{
$_SESSION[$key] = $val;
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $main['title'];?> - Dashboard</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65439011-1', 'auto');
  ga('send', 'pageview');

</script>   
</head>
<body>
    <div id="wrapper">
<div id="fade"></div>
<div id='fade2' class='fademe'>test</div>
<?php
include("inc/top.php");
include("inc/menu.php");
?>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div id="maindash" class="col-md-12">
					
					<?php
					$currpage = $_GET['pages'];
					#echo "SELECT * FROM tbl_code as a JOIN tbl_rate as b WHERE b.rate_id=a.code_package AND a.code_value='".$_SESSION['code_id']."'";
					$qx = mysql_query("SELECT * FROM tbl_code as a JOIN tbl_rate as b WHERE b.rate_id=a.code_package AND a.code_value='".$_SESSION['code_id']."'");
					$qxrow = mysql_fetch_assoc($qx);					
					if($currpage=='')
					{
					$currpage = "dashboard";
					#include("action/"."downline".$qxrow['rate_req'].".php");
					}
?>

<?php
					if($currpage=='downline')
					{
						include("action/".$currpage.$qxrow['rate_req'].".php");
					}
					else
					{
					include("action/".$currpage.".php");
					}
					//echo $currpage.$qxrow['rate_req'].".php";
					
					
					if($qxrow['rate_req']==3)
					{
						$limitsx = 7;
					}
					if($qxrow['rate_req']==4)
					{
						$limitsx = 15;
					}					
					if($qxrow['rate_req']==2)
					{
						$limitsx = 3;
					}	
					
					if($_SESSION['curtbl']=='')
					{
					breakfree_child_wager(array($_SESSION['accounts_id']),"wager",$limitsx);
					}
					else
					{
					breakfree_child_wager_bonus(array($_SESSION['accounts_id']),"wager",$limitsx,$_SESSION['curtbl']);
					}
					 $cd = countdownlines($_GET['wager']);
					 $succesmeter = (($cd / $limitsx) * 100);			
					if($_GET['tp']==1)
					{
					echo "$cd = $limitsx";
					echo "<pre>";
					print_r($_GET['wager']);
					echo "</pre>";
					}
					if($limitsx=='')
					{
					exit("ERROR");
					}
					if($cd>=$limitsx)
					{
						if($_SESSION['curtbl']=='')
						{						
							echo "reward main";
							addmoney($qxrow['rate_end'],$_SESSION['accounts_id'],$qxrow['rate_id']);
						}
						else
						{
							echo "reward bonus";
							addmoneyothertbl($qxrow['rate_bonus'],$_SESSION['accounts_id']);
						}
					}
					else
					{
					?>
<div class="warning" style='display:none;'><ul class="fa-ul">
<li>
<i class="fa fa-check"></i>
<?php
$need = ($limitsx-$cd) + 1;
echo "You need $need more person/s to get ".$qxrow['rate_end'];
?>
<br>
</li>
</ul>
</div>							
					<?php
					}
					?>
					
  
					 
					 
					 
					 
					 
		 
					 
					 
					 
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>	
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	
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
?>
<script>
function profile(idd)
{
    jQuery.post("action/getuser.php", {id: idd}, function(result){
        jQuery("#fade2").html(result);
		jQuery("#fade2").fadeIn();
		jQuery("#fade").fadeIn();
    });
}
function closepopup()
{
		jQuery("#fade2").fadeOut();
		jQuery("#fade").fadeOut();
}
			<?php
			$special = $_SESSION['specialmap'];
			if($special=='')
			{
			$reset = 'resettab';
			}
			else
			{
			$reset = 'resetbug';
			}
			?>
<?php echo $reset;?>();

//jQuery('#progressmeter').attr('style','width:<?php echo $succesmeter;?>40%;').hide();
</script>
 
   
</body>
</html>
