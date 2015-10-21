        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php
                  $main = getrow("tbl_logo");
                ?>
                <a class="navbar-brand" href="index.php"><img src="/adminpage/media/<?php echo $main['image'];?>" style="margin-top: -8px;width:100%;" alt="Genesis"></a> 
            </div>

        </nav>   
           <!-- /. NAV TOP  -->
<script type="text/javascript">
 function timedMsg()
  {
    var t=setInterval("change_time();",1000);
  }
 function change_time()
 {
   var d = new Date();
   var curr_hour = d.getHours();
   var curr_min = d.getMinutes();
   var curr_sec = d.getSeconds();    
   if(curr_hour > 12)
   {
   curr_hour = curr_hour - 12;
   document.getElementById('hour').innerHTML =curr_hour+":";
   document.getElementById('minute').innerHTML=curr_min+":";
   document.getElementById('secs').innerHTML=curr_sec;	   
   }

 }
timedMsg();   
</script>		   
		   