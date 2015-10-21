<?php
//REQUEST OF MONEY WITHDRAWAL
session_start();
include("../../connect.php");
include("../../function.php");
include("html2pdf.class.php");
$html2pdf = new HTML2PDF('P', 'A4', 'fr');
$html2pdf->pdf->SetDisplayMode('real');
$tracking = $_GET['id'];
//1000000
//
$ids = explode("-",$tracking);
$q = mysql_query("SELECT * FROM tbl_withdraw_history WHERE transnum='$tracking'");
$ss = mysql_fetch_assoc($q);
$amount = number_format($ss['amount'],2);
$accounts_id = $ss['accounts_id'];
$q = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_assoc($q);
$name = $row['firstname']." ".$row['lastname'];

if($_SESSION['accounts_id']=='')
{
	exit("Youre not allowed on this page.");
}


if($_SESSION['accounts_id']!=$accounts_id)
{
	exit("Youre not allowed on this page.");
}



$content .='
<table style="width: 100%;">
<tr>
<td style="text-align: center;    width: 100%;font-size:35px;">REQUEST OF MONEY WITHDRAWAL</td>
</tr>
</table><br><br>
';
$content .= "<div>Mr/Ms:"."<strong>CEO of Company</strong></div>
<div>Address:<br>19 Sample Street <br/> Legazpi Village<br> Sample Tower<br> Makati City Philippines<br> 2002"."</div>";
$content .= "<div>Tracking Number:<strong>".$tracking."</strong></div>";
$content .= "<div>Date:<strong>".date("M d, Y")."</strong></div><br>";
$content .= "<p> Hi I'am $name,<br/>
Requesting a withdrawal of $amount pesos only for my account.
</p>";
$content .='<br><br><br>
<table style="width: 100%;">
<tr>
<td style="text-align: center;width: 45%;">
_____________________
<br/>
Signature of Customer
</td>
<td style="text-align: center;width: 45%;">
_____________________
<br/>
Approved By.
</td>
</tr>
</table><br><br>
';
$html2pdf->writeHTML($content);
$html2pdf->Output('utf8.pdf');
?>
