<?php
    include("connect.inc");

    $query = "SELECT * FROM druglst WHERE drugcode = '$Dgcode'";
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
        $cRowid=$row->row_id;
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
		$condition = $row->drug_condition;	
		$minstock = $row->drug_minstock;	
		$lacktime = $row->drug_lacktime;
		$lockucsso = $row->drug_lockucsso;		
                  }  
   else {
      echo "ไม่พบ รหัส : $drugcode ";
           }    
if($_POST["act"]=="edit"){
	$edit="update druglst set drug_condition='$_POST[condition]',
											drug_minstock='$_POST[minstock]',
											drug_lacktime='$_POST[lacktime]',
											drug_lockucsso='$_POST[lockucsso]' where row_id='$_POST[drugid]'";
	if(mysql_query($edit)){
		echo "<script>alert('บันทึกข้อมูลเรียบร้อย');window.location='dglstcondition.php';</script>";
	}else{
		echo "<script>alert('!!! ผิดพลาด...ไม่สามารถบันทึกข้อมูลได้');window.location='dglstcondition.php';</script>";
	}									
}
?>
<p align="center" style="margin-top: 20px;">รหัสยา : <?=$cDrugcode;?> &nbsp;&nbsp;ชื่อยา : <?=$cTradname;?></p>
<form action="<? $PHP_SELF;?>" method="post">
<input type="hidden" name="act" value="edit" />
<input type="hidden" name="drugid" value="<?=$cRowid;?>" />
<table width="60%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="67%" align="center" bgcolor="#66CC99"><strong>เงื่อนไข</strong></td>
    <td width="33%" align="center" bgcolor="#66CC99"><strong>ความเคลื่อนไหว</strong></td>
  </tr>
  <tr>
    <td>1. ยาสั่งซื้อแล้ว แต่บริษัทยังไม่ได้จัดส่ง</td>
    <td align="center"><input name="condition" type="checkbox" id="condition" value="1" <? if($condition==1){ echo "checked='checked'";} ?> /></td>
  </tr>
  <tr>
    <td>2. ยาใกล้หมด Stock</td>
    <td align="center"><input type="checkbox" name="minstock" id="minstock" value="1" <? if($minstock==1){ echo "checked='checked'";} ?> /></td>
  </tr>
  <tr>
    <td>3. ยาขาดคราวจากบริษัท</td>
    <td align="center"><input type="checkbox" name="lacktime" id="lacktime" value="1" <? if($lacktime==1){ echo "checked='checked'";} ?> /></td>
  </tr>
  <tr>
    <td>4. Lock การจ่ายยา Original</td>
    <td align="center"><input type="checkbox" name="lockucsso" id="lockucsso" value="1" <? if($lockucsso==1){ echo "checked='checked'";} ?> /></td>
  </tr>
  </table>
<p align="center"><input name="submit" type="submit" id="submit" value="บันทึกข้อมูล" />
</p>
</form>
<?
include("unconnect.inc");
?>


    