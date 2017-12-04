<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript" src="epoch_classes_korsor.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('billdate'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('getdate'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('mfdate'));
	dp_cal  = new Epoch1('epoch_popup','popup',document.getElementById('expdate'));

};

</script>
		<style type="text/css">
			/*demo page css*/
			body{ font: 50% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			ul.test {list-style:none; line-height:30px;}
		</style>	
<?php

    include("connect.inc");
    $query = "SELECT * FROM combill  WHERE row_id = '$editrow'";
    $result = mysql_query($query) or die("Query failed");

   for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;
         }

     if(mysql_num_rows($result)){
	$row_id=$row->row_id;
	$docno=$row->docno;
	$billno =$row->billno ;                  
	$billdate =$row->billdate;
	$comcode =$row->comcode;
	$comname =$row->comname ;
	$drugcode =$row->drugcode ;
	$tradname  =$row->tradname ;
	$genname  =$row->genname ;
    $lotno =$row->lotno;
    $unit =$row->unit ;
	$amount=$row->amount;
	$stkbak =$row->stkbak ;
	$price =$row->price ;
	$unitpri =$row->unitpri ;
	$salepri  =$row->salepri  ;
	$mfdate =$row->mfdate ;
	$expdate  =$row->expdate  ;
	$getdate  =$row->getdate;
	$paid =$row->paid ;
	$person =$row->person ;
	$stkno  =$row->stkno;
	$contract  =$row->contract  ;
	$percent  =$row->percent  ;
	$dgexplot  =$row->dgexplot  ;
	$packing =$row->packing ;
	$packamt =$row->packamt ;
	$packpri =$row->packpri ;
 }  
///////
print "<body bgcolor='#666699' text='#FFFFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";

print "<div align='center'>";
print "  <center>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='3%'></td>";
print "      <td width='97%'>";
print "        <form method='POST' action='?do=save&row_id=$row_id'>";
print "          <div align='center'>";
print "            <table border='0' cellpadding='0' cellspacing='0' width='701'>";
print "              <tr>";
print "                <td width='699'><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  <b>&#3586;&#3657;&#3629;&#3617;&#3641;&#3621;&#3585;&#3634;&#3619;&#3595;&#3639;&#3657;&#3629;&#3618;&#3634;&#3648;&#3623;&#3594;&#3616;&#3633;&#3603;&#3601;&#3660;&#3648;&#3586;&#3657;&#3634;&#3588;&#3621;&#3633;&#3591;</b></font>";
print "                  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  &nbsp;&nbsp;&nbsp;";
print "                  &#3588;.&#3624;./&#3604;&#3604;/&#3623;&#3623;</font></p>";
print "                </td>";
print "              </tr>";
print "            </table>";
print "          </div>";
print "          <div align='center'>";
print "            <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "              <tr>";
print "                <td width='33%'><font face='Angsana New'>&#3648;&#3621;&#3586;&#3607;&#3637;&#3656;&#3619;&#3633;&#3610;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  <input type='text' name='stkno' size='12' value='$stkno' tabindex='1'><br>";
print "                  &#3648;&#3629;&#3585;&#3626;&#3634;&#3619;&#3595;&#3639;&#3657;&#3629;";
print "                  <input type='text' name='docno' size='12' value='$docno' tabindex='2'> </font></td>";
print "                <td width='35%'><font face='Angsana New'>&#3648;&#3621;&#3586;&#3607;&#3637;&#3656;&#3651;&#3610;&#3626;&#3656;&#3591;&#3586;&#3629;&#3591;&nbsp;";
print "                  <input type='text' name='billno' size='12' value='$billno' tabindex='3'> <br>";
print "                  &#3623;&#3633;&#3609;&#3607;&#3637;&#3656;&#3651;&#3610;&#3626;&#3656;&#3591;&#3586;&#3629;&#3591;&nbsp;&nbsp;";
print "                  <input type='text' name='billdate' size='12' value='$billdate' tabindex='4' id='billdate' > </font></td>";
print "                <td width='32%'><font face='Angsana New'>&#3623;&#3633;&#3609;&#3607;&#3637;&#3656;&#3619;&#3633;&#3610;&#3626;&#3636;&#3609;&#3588;&#3657;&#3634;&nbsp;&nbsp;&nbsp;";
print "                  <input type='text' name='getdate' size='12' value='$getdate' tabindex='5' id='getdate'>";
print "                  <br>";
print "                  &#3619;&#3627;&#3633;&#3626;&#3610;&#3619;&#3636;&#3625;&#3633;&#3607;";
print "                  <a target=_BLANK href='comcode.php'>(&#3594;&#3656;&#3623;&#3618;)</a>&nbsp;";
print "                  <input type='text' name='comcode' size='10' value='$comcode' tabindex='6'>";
print "                  </font>";
print "                </td>";
print "              </tr>";
print "            </table>";
print "          </div>";
print "          <div align='center'>";
print "            <table border='0' cellpadding='0' cellspacing='0' width='705'>";
print "              <tr>";
print "                <td width='703'><font face='Angsana New'>&#3610;&#3619;&#3636;&#3625;&#3633;&#3607;:: $comname</font>";
print "                  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  &nbsp;&nbsp;";
print "                  >>>>> <b> &#3619;&#3634;&#3618;&#3585;&#3634;&#3619;&#3595;&#3639;&#3657;&#3629;</b> &lt;&lt;&lt;&lt;&lt;</font></p>";
print "                </td>";
print "              </tr>";
print "            </table>";
print "          </div>";
print "          <div align='center'>";
print "            <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "              <tr>";
print "                <td width='33%'><font face='Angsana New'>&#3619;&#3627;&#3633;&#3626;&#3618;&#3634;<a target=_BLANK href='drugcode.php'>(&#3594;&#3656;&#3623;&#3618;)</a>&nbsp;<input type='text' name='drugcode' size='15' value='$drugcode' tabindex='7'><br>";
print "                  &#3594;&#3639;&#3656;&#3629;&#3585;&#3634;&#3619;&#3588;&#3657;&#3634;&nbsp;";
print "                  <input type='text' name='tradname' size='20' value='$tradname' tabindex='8'><br>";
print "                  &#3594;&#3639;&#3656;&#3629;&#3626;&#3634;&#3617;&#3633;&#3597;&nbsp;";
print "                  <input type='text' name='genname' size='20' value='$genname' tabindex='9'><br>";
print "                  packing&nbsp;&nbsp;&nbsp; <input type='text' name='packing' size='20' value='$packing' tabindex='10'><br>";
print "                  &#3627;&#3609;&#3656;&#3623;&#3618;&#3618;&#3656;&#3629;&#3618;";
print "            <input type='text' name='unit' size='10' value='$unit' tabindex='11'></font></td>";
print "                <td width='35%'><font face='Angsana New'>&#3648;&#3621;&#3586;&#3607;&#3637;&#3656;&#3612;&#3621;&#3636;&#3605;(LotNo)&nbsp;";
print "                  <input type='text' name='lotno'  value='$lotno' size='12' tabindex='12'><br>";
print "                  &#3623;&#3633;&#3609;&#3607;&#3637;&#3656;&#3612;&#3621;&#3636;&#3605;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  <input type='text' name='mfdate'  value='$mfdate' size='12' tabindex='13' value='' id='mfdate'><br>";
print "                  &#3623;&#3633;&#3609;&#3627;&#3617;&#3604;&#3629;&#3634;&#3618;&#3640;&nbsp;&nbsp;&nbsp;";
print "                  &#3640;<input type='text' name='expdate'  value='$expdate' size='12' tabindex='14' value='' id='expdate'><br>";
print "                  จำนวน pack&nbsp; <input type='text' name='packamt' size='10' value='$packamt' tabindex='15'><br>";
print "                  &#3592;&#3635;&#3609;&#3623;&#3609;&#3607;&#3633;&#3657;&#3591;&#3626;&#3636;&#3657;&#3609;";
print "                  <input type='text' name='amount' value='$amount' size='10' tabindex='16'>";
print "                  $cTotalstk</font></td>";
print "                <td width='32%'><font face='Angsana New'>&#3619;&#3634;&#3588;&#3634;&#3607;&#3640;&#3609;/&#3627;&#3609;&#3656;&#3623;&#3618;&nbsp;&nbsp;";
print "                  <input type='text' name='unitpri' size='10' value='$unitpri' tabindex='17'><br>";
print "                  &#3619;&#3634;&#3588;&#3634;&#3586;&#3634;&#3618;/&#3627;&#3609;&#3656;&#3623;&#3618;&nbsp;";
print "                  <input type='text' name='salepri' size='10' value='$salepri' tabindex='18'><br>";
print "                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &gt;&gt;&#3619;&#3634;&#3588;&#3634;&#3595;&#3639;&#3657;&#3629;&lt;&lt;<br>";
print "                  &#3619;&#3634;&#3588;&#3634;/pack&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='packpri' size='10' value='$packpri' tabindex='19'><br>";
print "                  &#3619;&#3634;&#3588;&#3634;&#3607;&#3633;&#3657;&#3591;&#3626;&#3636;&#3657;&#3609;&nbsp;&nbsp;&nbsp;";
print "                  <input type='text' name='price' value='$price' size='10' tabindex='20'></font></td>";
print "              </tr>";
print "            </table>";
print "          </div>";
print "          <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "          <input type='submit' value=' &#3605;&#3585;&#3621;&#3591;       ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "          <input type='hidden' value='$row_id' name='row_id'>";
//print "          &nbsp;&nbsp; <a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a></font></p>";
print "        </form>";
print "        <p><font face='Angsana New'>&nbsp;</font></td>";
print "    </tr>";
print "  </table>";
print "  </center>";
print "</div>";

print "</body>";


if($_GET['do']=="save"){


$sql_update="UPDATE  combill SET 
docno='$docno',
billno ='$billno' ,                 
billdate ='$billdate',
getdate ='$getdate',
lotno ='$lotno',
unit ='$unit',
amount='$amount',
price ='$price',
mfdate ='$mfdate',
expdate='$expdate',
unitpri='$unitpri',
stkno='$stkno', 
packing='$packing',
packamt='$packamt',
packpri='$packpri' 
WHERE  row_id='$row_id'  ";

$query=mysql_query($sql_update);

if($query){
echo "<FONT SIZE='3' COLOR='#FF0000'>แก้ไขข้อมูลเรียบร้อยแล้ว</FONT>";
	}else{
echo "ไม่สามารถแก้ไขได้";
	}



}
?>




