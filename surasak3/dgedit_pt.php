
<a target=_self  href='../nindex.htm'><< ไปเมนู</a>
<?php
    include("connect.inc");
	

    $query = "SELECT * FROM druglst_pt WHERE drugcode = '$Dgcode'";
    $result = mysql_query($query)
        or die("Query failed111");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

   If ($result){
        $cComcode=$row->comcode;
        $cDrugcode=$row->drugcode;
        $cTradname=$row->tradname;
        $cGenname=$row->genname;
		$cDrugname=$row->drugname;
        $cMinimum=$row->minimum;
        $cUnit=$row->unit;
       $cUnitpri=$row->unitpri;
      $cSalepri =$row->salepri;
      $cPart =$row->part;
      $cFreepri =$row->freepri;
	$cFreelimit =$row->freelimit; 
      $cStock =$row->stock;
      $cMainstk=$row->mainstk;
      $cTotalstk=$row->totalstk;
      $cSlcode =$row->slcode;
      $cBcode =$row->bcode;
     $cEdpri =$row->edpri;
     $cPack =$row->pack;
	 $cPack2 =$row->packing;
     $cPackpri =$row->packpri;
     $cPackpri_vat =$row->packpri_vat;
     $cContract =$row->contract;
	 $spec =$row->spec;
	 $default_order = $row->default_order;
	$snspec =$row->snspec;
		$cCode24 =$row->code24;
		$cDrugtype = $row->drugtype;
		$cdpy_code = $row->dpy_code;
		$cmedical_sup_free = $row->medical_sup_free;
		$status_drug = $row->status;
		$typedrug = $row->typedrug;
		$tmt = $row->tmt;
		$procat = $row->product_category;	
                  }  
   else {
      echo "ไม่พบ รหัส : $drugcode ";
           }    
include("unconnect.inc");

print "<body bgcolor='#808080' text='#FFFFFF'>";
print "<form method='POST' action='dgupdate_pt.php' >";
print "<table border='0' width='100%' height='345'>";
print "<tr>";
print " <td width='7%' height='21'></td>";
print "  <td width='48%' height='21'>";
print "  <p align='center'><b>&#3585;&#3634;&#3619;&#3649;&#3585;&#3657;&#3652;&#3586;&#3586;&#3657;&#3629;&#3617;&#3641;&#3621;&#3617;&#3637;&#3612;&#3621;&#3605;&#3656;&#3629;&#3588;&#3621;&#3633;&#3591;&#3618;&#3634;</b>&nbsp;&nbsp;</td>";
print "  <td width='45%' height='21'><b>&#3650;&#3611;&#3619;&#3604;&#3607;&#3635;&#3604;&#3657;&#3623;&#3618;&#3588;&#3623;&#3634;&#3617;&#3619;&#3632;&#3617;&#3633;&#3604;&#3619;&#3632;&#3623;&#3633;&#3591;</b></td>";
print " </tr>";
print " <tr>";
print " <td width='7%' height='236'></td>";
print "   <td width='48%' height='236'>&#3619;&#3627;&#3633;&#3626;&#3610;&#3619;&#3636;&#3625;&#3633;&#3607;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='comcode' size='15' tabindex='1'value='$cComcode'><br>";
print "  &#3619;&#3627;&#3633;&#3626;&#3618;&#3634;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='drugcode' size='15' tabindex='2'value='$cDrugcode' readonly ><br>";
print "   &#3594;&#3639;&#3656;&#3629;&#3585;&#3634;&#3619;&#3588;&#3657;&#3634;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='tradname' size='20' tabindex='3'value='$cTradname'><br>";
print "  &#3594;&#3639;&#3656;&#3629;&#3626;&#3634;&#3617;&#3633;&#3597;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='genname' size='20' tabindex='4'value='$cGenname'><br>";
print "  ชื่อยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='drugname' size='20' tabindex='4'value='$cDrugname'><br>";

print "  ประเภทยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <select name='typedrug' >
 			<option value='$typedrug' selected>$typedrug</option>
			<option value=''>--เลือก--</option>
			<option value='T01 เม็ด'>เม็ด</option>
			<option value='T02 น้ำ'>น้ำ</option>
			<option value='T03 ฉีด'>ฉีด</option>
			<option value='T04 วัคซีน'>วัคซีน</option>
			</select><br>";

print " &#3627;&#3609;&#3656;&#3623;&#3618;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input type='text' name='unit' size='20' tabindex='6'value='$cUnit'><br>";
print "  &#3619;&#3634;&#3588;&#3634;&#3607;&#3640;&#3609;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp; <input type='text' name='unitpri' size='20' tabindex='6'value='$cUnitpri'><br>";
print "  &#3619;&#3634;&#3588;&#3634;&#3586;&#3634;&#3618;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp; <input type='text' name='salepri' size='20' tabindex='7'value='$cSalepri'><br>";
print "  <a target=_BLANK href='part.htm'>&#3585;&#3621;&#3640;&#3656;&#3617;</a>(part)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "  <input type='text' name='part' size='20' tabindex='8'value='$cPart'><br>";
?>
<select name='part' tabindex='8'>
         
          <option value='DSY' <?=($cPart=='DSY')?'selected':'';?>>DSY = เวชภัณฑ์เบิกได้</option>
          <option value='DSN' <?=($cPart=='DSN')?'selected':'';?>>DSN = เวชภัณฑ์เบิกไม่ได้</option>
          <option value='DPY' <?=($cPart=='DPY')?'selected':'';?>>DPY = อุปกรณ์เบิกได้</option>
          <option value='DPN' <?=($cPart=='DPN')?'selected':'';?>>DPN = อุปกรณ์เบิกไม่ได้ </option>
          </select><br>
<?
print "  บัญชียา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='drugtype' size='2' value='$cDrugtype' onkeypress='if(event.keyCode>=3585 && event.keyCode <=3592) return true; else return false;'><br>";

print "  &#3619;&#3634;&#3588;&#3634;&#3629;&#3640;&#3611;&#3585;&#3619;&#3603;&#3660;&#3648;&#3610;&#3636;&#3585;&#3652;&#3604;&#3657;&nbsp;&nbsp;&nbsp;<input type='text' name='freepri' size='10' tabindex='9'value='$cFreepri'><br>";
print "  ('' '' เบิกได้ไม่เกิน)&nbsp;&nbsp;&nbsp;<input type='text' name='freelimit' size='11' tabindex='9'value='$cFreelimit'><BR>";

print "     หมายเลข สป สายแพทย์&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='spec' size='20' tabindex='20' value=$spec><BR>";

print "     รหัสยา 24 หลัก&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='code24' size='30' tabindex='24' value=$cCode24><BR>";
print "     จำนวนยาที่สั่งซื้อประจำ&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='default_order' size='20' tabindex='20' value=$default_order><BR>";

print "     เวชภัณท์ผู้ป่วยนอก&nbsp;&nbsp;&nbsp;&nbsp; <SELECT NAME=\"medical_sup_free\"><Option value=\"0\" ".($cmedical_sup_free==0?"Selected":"")." >เบิกไม่ได้</Option><Option value=\"1\" ".($cmedical_sup_free==1?"Selected":"")." >เบิกได้</Option></SELECT>";

print "  </td>";



print "  <td width='45%' height='236'>&#3592;&#3635;&#3609;&#3623;&#3609;&#3651;&#3609;&#3627;&#3657;&#3629;&#3591;&#3592;&#3656;&#3634;&#3618;&nbsp;&nbsp;&nbsp;<input type='text' name='stock' size='10' tabindex='11'value='$cStock'><br>";
print "   &#3592;&#3635;&#3609;&#3623;&#3609;&#3651;&#3609;&#3588;&#3621;&#3633;&#3591;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input type='text' name='mainstk' size='10' tabindex='12'value=$cMainstk><br>";
print " &#3592;&#3635;&#3609;&#3623;&#3609;&#3626;&#3640;&#3607;&#3608;&#3636;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "<input type='text' name='totalstk' size='10' tabindex='13'value=$cTotalstk><br>";
print "  <a target=_BLANK href='slipcode.php'>&#3619;&#3627;&#3633;&#3626;&#3623;&#3636;&#3608;&#3637;&#3651;&#3594;&#3657;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp; <input type='text' name='slcode' size='10' tabindex='14'value=$cSlcode>&nbsp;&nbsp;&nbsp;&nbsp;<br>";
print "    <a target=_BLANK href='bcode.php'>&#3619;&#3627;&#3633;&#3626;&#3626;&#3634;&#3619;&#3610;&#3633;&#3597;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input type='text' name='bcode' size='15' tabindex='14'value=$cBcode><br>";
print "   &#3619;&#3634;&#3588;&#3634;&#3585;&#3621;&#3634;&#3591;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "    <input type='text' name='edpri' size='10' tabindex='16'value=$cEdpri><br>";
print "   packing&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print " &nbsp;&nbsp;&nbsp;<input type='text' name='pack' size='10' tabindex='17' value=$cPack><br>";
print "   pack&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print " &nbsp;&nbsp;&nbsp;<input type='text' name='pack2' size='10' tabindex='17' value=$cPack2><br>";
print "   &#3619;&#3634;&#3588;&#3634;/&#3649;&#3614;&#3588;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input type='text' name='packpri' size='10' tabindex='18' value=$cPackpri>ราคาไม่รวม VAT<br>";
print "   &#3619;&#3634;&#3588;&#3634;/&#3649;&#3614;&#3588;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input type='text' name='packpri_vat' size='10' tabindex='18' value=$cPackpri_vat>ราคารวม VAT<br>";
print "     &#3592;&#3656;&#3634;&#3618;&#3648;&#3591;&#3636;&#3609;contack&nbsp;&nbsp;&nbsp;";
print "    &nbsp;&nbsp;&nbsp; <input type='text' name='contract' size='10' tabindex='19' value=$cContract><br>";

print "     จำนวนวางระดับ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='minimum' size='10' tabindex='20' value=><br>";

print "     หมายเลขสิ่งอุปกรณ์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='snspec' size='20' tabindex='21' value='$snspec'><br>";

print "     รหัสอุปกรณ์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='dpy_code' size='20' tabindex='22' value=$cdpy_code><br>";

print "     ใบรับรองการใช้ยา <SELECT NAME=\"status_chdrug\"><Option value=\"\" ".($status_drug==""?"Selected":"")." >ไม่มีกลุ่ม</Option><Option value=\"A\" ".($status_drug=="A"?"Selected":"")." >ANGIOTENSIN II RECEPTOR ANTAGONISTS</Option><Option value=\"B\" ".($status_drug=="B"?"Selected":"")." >STATINS</Option><Option value=\"C\" ".($status_drug=="C"?"Selected":"")." >PROTON PUMP INHIBITORS</Option><Option value=\"D\" ".($status_drug=="D"?"Selected":"")." >COX-2 SELECTIVE INHIBITORS</Option><Option value=\"E\" ".($status_drug=="E"?"Selected":"")." >กลูโคซามีน</Option></SELECT><br>";

print "   TMT CODE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='tmt' size='10' tabindex='23' value='$tmt'>";


print "   </tr>";
print "<tr>";
print "  <td></td>";
print "<td>Product Category&nbsp;&nbsp;&nbsp;";
?>
<select name="pro_cat">
          <option value='' <? if($procat==''){ echo "selected"; } ?>>1 = ยาแผนปัจจุบันที่เป็นผลิตภัณฑ์ทางการค้า</option>
		  <option value='2' <? if($procat=='2'){ echo "selected"; } ?>>2 = ยาแผนปัจจุบันผลิตใช้เอง</option>
		  <option value='3'  <? if($procat=='3'){ echo "selected"; } ?>>3 = ยาแผนไทยที่เป็นผลิตภัณฑ์ทางการค้า</option>
		  <option value='4'  <? if($procat=='4'){ echo "selected"; } ?>>4 = ยาแผนไทยผลิตใช้เอง</option>
		  <option value='5'  <? if($procat=='5'){ echo "selected"; } ?>>5 = ยาแผนการรักษาทางเลือกอื่น</option> 
		  <option value='6' <? if($procat=='6'){ echo "selected"; } ?>>6 = เวชภัณฑ์</option> 
		  <option value='7'  <? if($procat=='7'){ echo "selected"; } ?>>7 = อื่นๆ</option> 
</select>
<?
print "</td>";
print "</tr>";
print "  <tr>";
print "    <td width='7%' height='76'></td>";
print "   <td width='48%' height='76'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='submit' value='   &#3605;&#3585;&#3621;&#3591;   ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "    <input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></td>";
print "     <td width='45%' height='76'></td>";
print "    </tr>";
print " </table>";
print "</form>";
print "</body>";

?>




    