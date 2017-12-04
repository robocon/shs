<?php
    session_start();
    include("connect.inc");	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ซื้อยาเข้าคลัง</title>
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
<SCRIPT LANGUAGE="JavaScript">
<!--
	
	function checkForm(){

		var stat = true;
		var txt = "";
		
		if(document.f1.stkno.value == ''){
				txt = txt+ "กรุณาระบุ เลขที่รับ \n";
				stat = false;
		}

		if(document.f1.docno.value == ''){
				txt = txt+ "กรุณาระบุ เอกสารซื้อ \n";
				stat = false;
		}

		if(document.f1.billno.value == ''){
				txt = txt+ "กรุณาระบุ เลขที่ใบส่งของ \n";
				stat = false;
		}

		if(document.f1.billdate.value == '' || document.f1.billdate.value == '200-/--/--'){
				txt = txt+ "กรุณาระบุ วันที่ใบส่งของ \n";
				stat = false;
		}

		if(document.f1.getdate.value == '' || document.f1.getdate.value == '200-/--/--'){
				txt = txt+ "กรุณาระบุ วันที่รับสินค้า \n";
				stat = false;
		}

		if(document.f1.lotno.value == ''){
				txt = txt+ "กรุณาระบุ เลขที่ผลิต(LotNo) \n";
				stat = false;
		}
		
		if(document.f1.expdate.value == '' || document.f1.expdate.value == '200-/--/--'){
				txt = txt+ "กรุณาระบุ วันหมดอายุ  \n";
				stat = false;
		}

		if(document.f1.packamt.value == ''){
				txt = txt+ "กรุณาระบุ จำนวน pack (ของยา) \n";
				stat = false;
		}


		if(document.f1.amount.value == ''){
				txt = txt+ "กรุณาระบุ จำนวนทั้งสิ้น(ของยา) \n";
				stat = false;
		}

		if(document.f1.price.value == ''){
				txt = txt+ "กรุณาระบุ ราคาทั้งสิ้น(ของยาที่สั่งซื้อ) \n";
				stat = false;
		}
		
		if(stat == false){
			alert(txt);
		}

	return stat;
	}

//-->
</SCRIPT>
<style type="text/css">
<!--
body {
	background-color: #EBF2D3;
	font-family: "TH Sarabun New";
}
.style1 {
	font-weight: bold;
	color: #FFFFFF;
	font-size:20px;
}
-->
</style></head>
<body>
<?
if(!empty($dgcode)){
    $query = "SELECT * FROM druglst_pt WHERE drugcode = '$dgcode'";
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

          if(mysql_num_rows($result)){
	$cRowid=$row->row_id;		  
	$cComcode=$row->comcode;
	$cComname=$row->comname;                  
	$cDrugcode =$row->drugcode;
	$cTradname =$row->tradname;
	$cGenname=$row->genname;
	$cUnit=$row->unit;
	$cUnitpri =$row->unitpri;
	$cSalepri =$row->salepri;
                $cTotalstk=$row->totalstk;
                $cMainstk=$row->mainstk;

	$cPacking=$row->packing;
	$cPackamt=$row->packamt;
		$cPack=$row->pack;
	$cPackpri=$row->packpri;
	$cPackpri_vat=$row->packpri_vat;
	$cAmountfree=$row->amountfree;
                         }  
          if(!mysql_num_rows($result)){
                die("ไม่พบรหัส  : $dgcode  อาจมีสาเหตุจาก<br>
		- รหัสไม่ถูกต้อง<br>
		- เป็นยาใหม่  ยังไม่ได้ลงทะเบียนในบัญชียา<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onclick='history.back()' value='<< กลับไป'>");
                               		     }    
    include("unconnect.inc");
       }
 ?>
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5" bordercolor="#A7C941" bgcolor="#A7C941">
  <tr>
    <td align="center" bgcolor="#EBF2D3">
<form name="f1" action="stkadd_pt.php" method="post" onsubmit="return checkForm();">
    <table width="100%" border="0">
      <tr>
        <td colspan="8" align="center" bgcolor="#A7C941"><span class="style1">ข้อมูลการซื้อยาเวชภัณฑ์เข้าคลัง</span></td>
        </tr>

      <tr>
        <td width="13%" align="right">เลขที่รับ :</td>
        <td width="17%" align="left"><input name="stkno" type="text" tabindex="1" value="<?=$cStkno;?>" size="15"/></td>
        <td width="1%" align="right">&nbsp;</td>
        <td width="16%" align="right">เลขที่ใบส่งของ :</td>
        <td width="13%" align="left"><input name="billno" type="text" tabindex="3" value="<?=$cBillno;?>" size="15"></td>
        <td width="1%" align="right">&nbsp;</td>
        <td width="16%" align="right">วันที่รับสินค้า :</td>
        <td width="23%" align="left"><input name="getdate" type="text"  id="getdate" tabindex="5" value="<?=$cGetdate;?>" size="15" ></td>
      </tr>
      <tr>
        <td align="right">เอกสารซื้อ :</td>
        <td align="left"><input name="docno" type="text" tabindex="2"  value="<?=$cDocno;?>" size="15" /></td>
        <td align="right">&nbsp;</td>
        <td align="right">วันที่ใบส่งของ :</td>
        <td align="left"><input name="billdate" type="text"  id="billdate" tabindex="4" value="<?=$cBilldate;?>" size="15"></td>
        <td align="right">&nbsp;</td>
        <td align="right">รหัสบริษัท <a target="_BLANK" href="comcode.php">(ช่วยเหลือ)</a> :</td>
        <td align="left"><input name="comcode" type="text" tabindex="6" value="<?=$cComcode;?>" size="15"></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left"><span style="color:#0033FF; font-weight:bold;"><?=$cComname;?></span></td>
      </tr>
      <tr>
        <td colspan="8" align="center" bgcolor="#A7C941" class="style1">รายการซื้อ</td>
        </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right">รหัสยา <a target="_BLANK" href="drugcode.php">(ช่วยเหลือ)</a> :</td>
        <td align="left"><input type="text" name="drugcode" value="<?=$cDrugcode;?>" tabindex="7"></td>
        <td align="right">&nbsp;</td>
        <td align="right">เลขที่ผลิต (LotNo) :</td>
        <td align="left"><input name="lotno" type="text" tabindex="12" value="" size="15"></td>
        <td align="right">&nbsp;</td>
        <td align="right">ราคาทุน/หน่วย :</td>
        <td align="left"><input name="unitpri" type="text" tabindex="19" value="<?=$cUnitpri;?>" size="10" /></td>
      </tr>
      <tr>
        <td align="right">ชื่อการค้า :</td>
        <td align="left"><input type="text" name="tradname"  value="<?=$cTradname;?>" tabindex="8"></td>
        <td align="right">&nbsp;</td>
        <td align="right">วันที่ผลิต :</td>
        <td align="left"><input name="mfdate" type="text" id="mfdate" tabindex="13" value="200-/--/--" size="15"></td>
        <td align="right">&nbsp;</td>
        <td align="right">ราคาขาย/หน่วย :</td>
        <td align="left"><input name="salepri" type="text" tabindex="20" value="<?=$cSalepri;?>" size="10" /></td>
      </tr>
      <tr>
        <td align="right">ชื่อสามัญ :</td>
        <td align="left"><input type="text" name="genname"  value="<?=$cGenname;?>" tabindex="9"></td>
        <td align="right">&nbsp;</td>
        <td align="right">วันหมดอายุ :</td>
        <td align="left"><input name="expdate" type="text" id="expdate" tabindex="14" value="200-/--/--" size="15"></td>
        <td align="right">&nbsp;</td>
        <td align="right">ราคา / Pack :</td>
        <td align="left"><input name="packpri" type="text" tabindex="21" value="<?=$cPackpri;?>" size="10" />
          ราคาไม่รวม Vat</td>
      </tr>
      <tr>
        <td align="right">Packing :</td>
        <td align="left"><input type="text" name="packing" value="<?=$cPacking;?>" tabindex="10"></td>
        <td align="right">&nbsp;</td>
        <td align="right">จำนวน Pack ที่ซื้อ :</td>
        <td align="left"><input name="packamt" type="text" tabindex="15" value="<?=$cPackamt;?>" size="10" /></td>
        <td align="right">&nbsp;</td>
        <td align="right">ราคา / Pack :</td>
        <td align="left"><input name="packpri_vat" type="text" id="packpri_vat" tabindex="22" value="<?=$cPackpri_vat;?>" size="10" />
          ราคารวม Vat</td>
      </tr>
      <tr>
        <td align="right">หน่วยย่อย :</td>
        <td align="left"><input name="unit" type="text" tabindex="11" value="<?=$cUnit;?>" size="10"></td>
        <td align="right">&nbsp;</td>
        <td align="right">Pack :</td>
        <td align="left"><input name="pack" type="text" tabindex="16" value="<?=$cPack;?>" size="10" /></td>
        <td align="right">&nbsp;</td>
        <td align="right">ราคาทั้งสิ้น :</td>
        <td align="left"><input name="price" type="text" tabindex="23" value="" size="10" /></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="right">จำนวนทั้งสิ้น :</td>
        <td align="left"><input name="amount" type="text" tabindex="17" size="10" />
  &nbsp;<span style="color:#FF0000; font-weight:bold">
  <? echo $cTotalstk;?>
</span></td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="right">จำนวนที่แถม :</td>
        <td align="left"><input name="amountfree" type="text" tabindex="18" size="10" /></td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8" align="center"><input type="submit" value="ตกลง" name="B1"></td>
        </tr>
    </table>
    <p><a target="_self"  href="../nindex.htm"><< ไปเมนู</a></p>
</form>       
    </td>
  </tr>
</table>

</body>
</html>
