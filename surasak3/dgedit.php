<style type="text/css">
<!--
body{ font-family:"TH SarabunPSK"; 
font-size:18px;
}
.headsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:22px;
	color: #0000FF;
	}
.txtsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:16px; 
	font-weight:bold;
	}

.style1 {
	font-family: "TH SarabunPSK";
	font-size: 28px;
	font-weight: bold;
}
-->
</style>
<?php
    include("connect.inc");

    $query = "SELECT * FROM druglst WHERE drugcode = '$Dgcode'";
	//echo $query;
    $result = mysql_query($query)
        or die("Query failed");
 
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
		$cDrug_nature=$row->drug_nature;
		$cDrug_properties=$row->drug_properties;
		$cDrugnote=$row->drugnote;
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
		$prodrugtype = $row->product_drugtype;
		
        $edpri_from = $row->edpri_from;
		$grouptype = $row->grouptype;
                  }  
   else {
      echo "ไม่พบ รหัส : $drugcode ";
           }    
include("unconnect.inc");
?>
 <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><div style="margin: 5px 5px 5px 5px;"><img src="../shs.png" width="119" height="92" border="0" /></div>      
    <p class="style1">โปรแกรมปรับปรุงและแก้ไขข้อมูลยา/เวชภัณฑ์</p>
    </td>
  </tr>
</table>
 <br />
 <table width="95%" border="5" align="center" cellpadding="2" cellspacing="0" bordercolor="#339999">
    <td>
<?
        $cComcode=trim($cComcode);
        $cDrugcode=trim($cDrugcode);
        $cTradname=trim($cTradname);
        $cGenname=trim($cGenname);
		$cDrugname=trim($cDrugname);
print "<form method='POST' action='dgupdate.php' >";
print "<table border='0' width='100%' height='345'>";
print "<tr>";
print " <td width='7%' height='25'></td>";
print "  <td width='48%' height='25'>";
print "  <p align='left' class='headsarabun'><b>การแก้ไขข้อมูลมีผลต่อคลังยา</b></p></td>";
print "  <td width='45%' height='25'><p align='left' class='headsarabun'><b>โปรดทำด้วยความระมัดระวัง</b></p></td>";
print " </tr>";
print " <tr>";
print " <td width='7%' height='236'></td>";
print "   <td width='48%' height='236'>รหัสบริษัท&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='comcode' size='15' tabindex='1' value='$cComcode'><br>";
print "  รหัสยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drugcode' size='15' tabindex='2' value='$cDrugcode' readonly ><br>";
print "   ชื่อการค้า&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='tradname' size='40' tabindex='3' value='$cTradname'><br>";
print "  ชื่อสามัญ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='genname' size='40' tabindex='4' value='$cGenname'><br>";
print "  ชื่อยาภาษาไทย&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drugname' size='40' tabindex='4' value='$cDrugname'><br>";

print "  ลักษณะยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drug_nature' size='40' tabindex='4' value='$cDrug_nature'><br>";
print "  สรรพคุณ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drug_properties' size='40' tabindex='4' value='$cDrug_properties'><br>";
print "  คำเตือนการใช้ยา&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drugnote' size='40' tabindex='4' value='$cDrugnote'><br>";

print "  ประเภทยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <select name='typedrug' class='txtsarabun' >
 			<option value='$typedrug' selected>$typedrug</option>
			<option value=''>--เลือก--</option>
			<option value='T01 เม็ด'>เม็ด</option>
			<option value='T02 น้ำ'>น้ำ</option>
			<option value='T03 ฉีด'>ฉีด</option>
			<option value='T04 วัคซีน'>วัคซีน</option>
			</select><br>";

print " &#3627;&#3609;&#3656;&#3623;&#3618;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input class='txtsarabun'  type='text' name='unit' size='20' tabindex='6'value='$cUnit'><br>";
print "  &#3619;&#3634;&#3588;&#3634;&#3607;&#3640;&#3609;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp; <input class='txtsarabun'  type='text' name='unitpri' size='20' tabindex='6'value='$cUnitpri'><br>";
print "  &#3619;&#3634;&#3588;&#3634;&#3586;&#3634;&#3618;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp; <input class='txtsarabun'  type='text' name='salepri' size='20' tabindex='7'value='$cSalepri'><br>";
print "  <a target=_BLANK href='part.htm'>&#3585;&#3621;&#3640;&#3656;&#3617;</a>(part)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "  <input class='txtsarabun'  type='text' name='part' size='20' tabindex='8'value='$cPart'><br>";
?>
<select name='part' tabindex='8' class="txtsarabun">
          <option value='DDL' <?=($cPart=='DDL')?'selected':'';?>>DDL = ยาในบัญชียาหลักแห่งชาติ </option>
          <option value='DDY' <?=($cPart=='DDY')?'selected':'';?>>DDY = ยานอกบัญชียาหลักแห่งชาติ แต่เบิกได้</option>
          <option value='DDN' <?=($cPart=='DDN')?'selected':'';?>>DDN = ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้</option>
          <option value='DSY' <?=($cPart=='DSY')?'selected':'';?>>DSY = เวชภัณฑ์เบิกได้</option>
          <option value='DSN' <?=($cPart=='DSN')?'selected':'';?>>DSN = เวชภัณฑ์เบิกไม่ได้</option>
          <option value='DPY' <?=($cPart=='DPY')?'selected':'';?>>DPY = อุปกรณ์เบิกได้</option>
          <option value='DPN' <?=($cPart=='DPN')?'selected':'';?>>DPN = อุปกรณ์เบิกไม่ได้ </option>
      </select><br>
<?
print "  บัญชียา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drugtype' size='2' value='$cDrugtype' onkeypress='if(event.keyCode>=3585 && event.keyCode <=3592) return true; else return false;'><br>";

print "  &#3619;&#3634;&#3588;&#3634;&#3629;&#3640;&#3611;&#3585;&#3619;&#3603;&#3660;&#3648;&#3610;&#3636;&#3585;&#3652;&#3604;&#3657;&nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='freepri' size='10' tabindex='9'value='$cFreepri'><br>";
print "  ('' '' เบิกได้ไม่เกิน)&nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='freelimit' size='11' tabindex='9'value='$cFreelimit'><BR>";

print "     หมายเลข สป สายแพทย์&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='spec' size='20' tabindex='20' value=$spec><BR>";

print "     รหัสยา 24 หลัก&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='code24' size='30' tabindex='24' value=$cCode24><BR>";
print "     จำนวนยาที่สั่งซื้อประจำ&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='default_order' size='20' tabindex='20' value=$default_order><BR>";

print "     เวชภัณท์ผู้ป่วยนอก&nbsp;&nbsp;&nbsp;&nbsp; <SELECT NAME=\"medical_sup_free\" class='txtsarabun'><Option value=\"0\" ".($cmedical_sup_free==0?"Selected":"")." >เบิกไม่ได้</Option><Option value=\"1\" ".($cmedical_sup_free==1?"Selected":"")." >เบิกได้</Option></SELECT>";

print "  </td>";



print "  <td width='45%' height='236'>&#3592;&#3635;&#3609;&#3623;&#3609;&#3651;&#3609;&#3627;&#3657;&#3629;&#3591;&#3592;&#3656;&#3634;&#3618;&nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='stock' size='10' tabindex='11' value='$cStock' readonly><br>";
print "   &#3592;&#3635;&#3609;&#3623;&#3609;&#3651;&#3609;&#3588;&#3621;&#3633;&#3591;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input class='txtsarabun'  type='text' name='mainstk' size='10' tabindex='12' value='$cMainstk' readonly><br>";
print " &#3592;&#3635;&#3609;&#3623;&#3609;&#3626;&#3640;&#3607;&#3608;&#3636;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "<input class='txtsarabun'  type='text' name='totalstk' size='10' tabindex='13' value='$cTotalstk' readonly><br>";
print "  <a target=_BLANK href='slipcode.php'>&#3619;&#3627;&#3633;&#3626;&#3623;&#3636;&#3608;&#3637;&#3651;&#3594;&#3657;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp; <input class='txtsarabun'  type='text' name='slcode' size='10' tabindex='14' value=$cSlcode>&nbsp;&nbsp;&nbsp;&nbsp;<br>";
print "    <a target=_BLANK href='bcode.php'>&#3619;&#3627;&#3633;&#3626;&#3626;&#3634;&#3619;&#3610;&#3633;&#3597;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input class='txtsarabun'  type='text' name='bcode' size='15' tabindex='14'value=$cBcode><br>";
print "   &#3619;&#3634;&#3588;&#3634;&#3585;&#3621;&#3634;&#3591;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "    <input class='txtsarabun'  type='text' name='edpri' size='10' tabindex='16'value=$cEdpri><br>";
print "   packing&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print " &nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='pack' size='10' tabindex='17' value=$cPack><br>";
print "   pack&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print " &nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='pack2' size='10' tabindex='17' value=$cPack2><br>";
print "   &#3619;&#3634;&#3588;&#3634;/&#3649;&#3614;&#3588;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input class='txtsarabun'  type='text' name='packpri' size='10' tabindex='18' value=$cPackpri>ราคาไม่รวม VAT<br>";
print "   &#3619;&#3634;&#3588;&#3634;/&#3649;&#3614;&#3588;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input class='txtsarabun'  type='text' name='packpri_vat' size='10' tabindex='18' value=$cPackpri_vat>ราคารวม VAT<br>";
print "     &#3592;&#3656;&#3634;&#3618;&#3648;&#3591;&#3636;&#3609;contack&nbsp;&nbsp;&nbsp;";
print "    &nbsp;&nbsp;&nbsp; <input class='txtsarabun'  type='text' name='contract' size='10' tabindex='19' value=$cContract><br>";

print "     จำนวนวางระดับ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='minimum' size='10' tabindex='20' value=><br>";

print "     หมายเลขสิ่งอุปกรณ์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='snspec' size='20' tabindex='21' value='$snspec'><br>";

print "     รหัสอุปกรณ์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='dpy_code' size='20' tabindex='22' value=$cdpy_code><br>";

print "     ใบรับรองการใช้ยา <SELECT NAME=\"status_chdrug\"><Option value=\"\" ".($status_drug==""?"Selected":"")." >ไม่มีกลุ่ม</Option><Option value=\"A\" ".($status_drug=="A"?"Selected":"")." >ANGIOTENSIN II RECEPTOR ANTAGONISTS</Option><Option value=\"B\" ".($status_drug=="B"?"Selected":"")." >STATINS</Option><Option value=\"C\" ".($status_drug=="C"?"Selected":"")." >PROTON PUMP INHIBITORS</Option><Option value=\"D\" ".($status_drug=="D"?"Selected":"")." >COX-2 SELECTIVE INHIBITORS</Option><Option value=\"E\" ".($status_drug=="E"?"Selected":"")." >กลูโคซามีน</Option></SELECT><br>";

print "   TMT CODE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='tmt' size='10' tabindex='23' value='$tmt'><br>";

$edpri_from_list = array(
    1 => '(๑) ราคาที่ได้มาจากการคำนวณตามหลักเกณฑ์ที่คณะกรรมการราคากลางกำหนด',
    2 => '(๒) ราคาที่ได้มาจากฐานข้อมูลราคาอ้างอิงของพัสดุที่กรมบัญชีกลางจัดทำ',
    3 => '(๓) ราคามาตรฐานที่สำนักงบประมาณหรือหน่วยงานกลางอื่นกำหนด(ราคามาตรฐานเวชภัณฑ์ที่มิใช่ยา ที่ สธ 0228.07.2/ว688 ลง วันที่ 6 สิงหาคม พ.ศ.2556)<br>(ประเภทและอัตราค่าอวัยวะเทียมและอุปกรณ์ในการบำบัดรักษาโรค ที่ กค 0422.2/พิเศษ ว 1 ลงวันที่ 4 ธันวาคม 2556)',
    4 => '(๔) ราคาที่ได้มาจากการสืบราคาจากท้องตลาด',
    5 => '(๕) ราคาที่เคยซื้อหรือจ้างครั้งหลังสุดภายในระยะเวลาสองปีงบประมาณ',
    6 => '(๖) ราคาอื่นใดตามหลักเกณฑ์ วิธีการ หรือแนวทางปฏิบัติของหน่วยงานของรัฐนั้นๆ',
);
?>
แหล่งที่มาของราคากลาง 
<select name="edpri_from" class="txtsarabun">
    <?php 

    $def_edpri = 5;
    if ( $cEdpri > 0 OR $cFreelimit > 0 ) {
        $def_edpri = 3;
    }

    if( $edpri_from !== NULL ){
        $def_edpri = $edpri_from;
    }

    foreach ($edpri_from_list as $key => $value) {

        $selected = ( $key == $def_edpri ) ? 'selected' : '' ;

        ?>
        <option value="<?=$key;?>" <?=$selected;?>><?=substr($value,1,80).'...';?></option>
        <?php
    }
    ?>
</select>
<?php


print "   </tr>";
print "<tr>";
print "  <td></td>";
print "<td>Product Category&nbsp;&nbsp;&nbsp;";
?>
<select name="pro_cat" class="txtsarabun">
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
print "<tr>";
print "<td></td>";
print "<td colspan='2'>พัสดุส่งเสริมสุขภาพและสาธารณสุข&nbsp;&nbsp;&nbsp;";
?>
<select name="product_drugtype" class="txtsarabun">
          <option value='' <? if($prodrugtype==''){ echo "selected='selected'"; } ?>>ไม่อยู่ในหมวด 6 พัสดุส่งเสริมสุขภาพและสาธารณสุข</option>
		  <option value='1' <? if($prodrugtype=='1'){ echo "selected='selected'"; } ?>>1 = ยาตามชื่อสามัญ (gereric name) ในบัญชียาหลักแห่งชาติ</option>
          <option value='2' <? if($prodrugtype=='2'){ echo "selected='selected'"; } ?>>2 = ยาที่อยู่ในบัญชียาหลักแห่งชาติหรือเวชภัณฑ์ ซึ่งองค์การเภสัชกรรมหรือสภากาชาดไทยได้ผลิตออกจำหน่ายแล้ว</option>
		  <option value='3'  <? if($prodrugtype=='3'){ echo "selected='selected'"; } ?>>3 = ยาที่อยู่ในบัญชียาหลักแห่งชาติหรือเวชภัณฑ์ ซึ่งองค์การเภสัชกรรมหรือโรงงานเภสัชกรรมทหาร มิได้เป็นผู้ผลิตแต่มีจำหน่าย</option>
		  <option value='4'  <? if($prodrugtype=='4'){ echo "selected='selected'"; } ?>>4 = ยาและเวชภัณฑ์ที่ได้ขึ้นบัญชีนวัตกรรมไทย</option>
		  <option value='5'  <? if($prodrugtype=='5'){ echo "selected='selected'"; } ?>>5 = วัคซีนโรคตับอักเสบบี และผลิตภัณฑ์อื่นๆ ที่สภากาชาดไทยผลิตเอง และไม่มีอยู่ในบัญชี</option> 
</select>
<?
print "</td>";
print "</tr>";
print "<tr>";
print "<td></td>";
print "<td colspan='2'>หน่วยที่จัดซื้อ&nbsp;&nbsp;&nbsp;";
?>
<select name="grouptype">
          <option value='' <? if($grouptype==''){ echo "selected"; } ?>>กองเภสัชกรรม</option>
		  <option value='pc' <? if($grouptype=='pc'){ echo "selected"; } ?>>แผนกจัดซื้อ สป.สายแพทย์</option>
</select>
<?
print "</td>";
print "</tr>";
?>
<tr align="center">
<td  width='7%' height='76'></td>
<td colspan="2" width='93%' height='76'>
<input type='submit' value='บันทึก/แก้ไขข้อมูล' name='B1' class="txtsarabun">&nbsp;&nbsp;
<input type="button" name="button" id="button" value="ค้นหายาตัวใหม่" onclick="window.location='dglst.php' " class="txtsarabun" />&nbsp;&nbsp;
<input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="txtsarabun" />
</td>
</tr>
</table>
</form> 
    </td>
  </tr>
</table>




    