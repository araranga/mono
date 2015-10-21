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
		if($currpage=='')
		{
			$currpage = 'dashboard';
		}
		include("action/".$currpage.".php");
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
