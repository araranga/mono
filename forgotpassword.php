<?php
session_start();
include("connect.php");
include("function.php");
$main = getrow("tbl_logo");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $main['title'];?> - Forgot Password</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                 <br />
            </div>
        </div>
         <div class="row ">
				  
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
<div id="notibar">

</div>
<?php
if($_GET['error']==1)
{
	?>
<div class="warning"><ul class="fa-ul"><li><i class="fa fa-warning fa-li"></i> Please login before accessing that page.</li></ul></div>
	<?php
}
?>

                        <div class="panel panel-default">
                        <div class="panel-heading" style=' background-color: #131212'>
                        <strong><img src="/adminpage/media/<?php echo $main['image'];?>" alt="Genesis"></strong>  
                        </div>
                            <div class="panel-body">
                                <form role="form">
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input id="email" type="email" class="form-control" placeholder="Your Email" />
                                        </div>                              
                                     <a href="javascript:void(0);" onclick="processemail()" class="btn btn-primary ">Send now</a>
									 <a href='login.php' style='float:right;'><< Back</a>
                                    </form>
                            </div>
                          
                        </div>
                    </div>
                
                
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
	<script>
	function processemail()
	{
		var email = $('#email').val();
		$('#notibar').html('<div class="noti"><ul class="fa-ul"><li><i class="fa fa-cog fa-spin fa-li"></i> Please wait.. Checking your acccount.</li></ul></div>');
    $.post("action/process-email.php",{email:email}, function(data, status){
		//alert(data);
		$('#notibar').html('');
		if(data=="0")
		{
			$('#notibar').html('<div class="warning"><ul class="fa-ul"><li><i class="fa fa-warning fa-li"></i>Please check your email not exist.</li></ul></div>');
		}
		if(data=="1")
		{
			$('#notibar').html('<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i> Password sent to the email.</li></ul></div>');
		}
    });		
	}
	</script>
</body>
</html>
