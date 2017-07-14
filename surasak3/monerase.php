<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<script>
function ch_null(){
	if(document.f1.hn.value==""){
		alert("กรุณาระบุ HN ด้วยครับ");
		return false;
	}
}

</script>
<form name="f1" action="" method="post" onsubmit="JavaScript:return ch_null();">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" align="center" bgcolor="#99CC99">โอนค่าใช้จ่ายเข้าบัญชีผู้ป่วยใน</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">วัน/เดือน/ปี</span></td>
    <td >
    <? $d=date("d");?>
    <input type="text" name="d_start" value="<?=$d;?>" class="forntsarabun"  size="5"/>
	
	<? $m=date('m'); ?>
      <select name="m_start" class="forntsarabun">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right">HN</td>
    <td ><input name="hn" type="text" class="forntsarabun" id="hn" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
    <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
      </td>
  </tr>
</table>
</form>
<HR>
<script language="JavaScript">
	function ClickCheckAll(vol)
	{
	
		var i=1;
		for(i=1;i<=document.frmMain.hdnCount.value;i++)
		{
			if(vol.checked == true)
			{
				eval("document.frmMain.chk"+i+".checked=true");
			}
			else
			{
				eval("document.frmMain.chk"+i+".checked=false");
			}
		}
	}
</script>
<script language="JavaScript">
	function onSave()
	{
		if(confirm('ยืนยันการโอนค่าใช้จ่ายเข้าบัญชีผู้ป่วยใน ?')==true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>
<?php

if($_POST['submit']){

include("connect.inc"); 

if($_POST['d_start']!=''){
$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
$day="วันที่";
}else{
$date1=$_POST['y_start'].'-'.$_POST['m_start'];
$day="เดือน";
}

switch($_POST['m_start']){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}
	  $dateshow=$_POST['d_start']." ".$printmonth." ".$_POST['y_start'];
	

	
	
	 $query = "SELECT a.row_id,a.idno,a.date,a.ptname,a.hn,a.an,a.code,a.detail,a.depart,a.amount,a.price,a.yprice,a.nprice,a.part ,b.diag,b.doctor,b.ptright ,b.tvn,a.tranipacc FROM patdata as a ,depart as b WHERE a.idno=b.row_id and a.hn='$hn' and a.date LIKE '$date1%' ";
    $result = mysql_query($query)or die("Query failed");
	
	//echo $query;

	?>
    <form name="frmMain" action="labop2ip_all.php?hn=<?=$hn;?>" method="post" OnSubmit="return onSave();">
    
    
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
  <th>#</th>
  <th>เวลา</th>
  <th>ชื่อ</th>
  <th>HN</th>
  <th>AN</th>
  <th>code</th>
  <th>รายการ</th>
  <th>แผนก</th>
  <th>จำนวน</th>
  <th>ราคา</th>
  <th>เบิกได้</th>
  <th>เบิกไม่ได้</th>
  <th><input name="CheckAll" type="checkbox" id="CheckAll" value="Y" onClick="ClickCheckAll(this);">โอนทั้งหมด</th>
    </tr>
    <?
	 while (list ($row_id,$idno,$date,$ptname,$hn,$an,$code,$detail,$depart,$amount,$price,$yprice,$nprice,$part,$diag,$doctor,$ptright,$tvn,$tranipacc) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
	

	 if($tranipacc=='ipacc'){ 
	 $color='#FF3366'; 
	 $chk1="โอนแล้ว";
	 }else{ 
	 $color=''; 
	 $chk1="<input name='chk[]'  id='chk$num' type='checkbox' value='$row_id'/>";
	 }
	 
       print (" <tr>\n".
           "  <td bgcolor='$color'>$num</td>\n".
           "  <td bgcolor='$color'>$time</td>\n".
           "  <td bgcolor='$color'>$ptname</td>\n".
           "  <td bgcolor='$color'>$hn</td>\n".
           "  <td bgcolor='$color'>$an</td>\n".
		  "  <td bgcolor='$color'>$code</td>\n".
          "  <td bgcolor='$color'>$detail</td>\n".
		  "  <td bgcolor='$color'>$depart</td>\n".
		  "  <td bgcolor='$color'>$amount</td>\n".
           "  <td bgcolor='$color' align=\"right\">$price</td>\n".
		   "  <td bgcolor='$color' align=\"right\">$yprice</td>\n".
		   "  <td bgcolor='$color' align=\"right\">$nprice</td>\n".
		    " <td bgcolor='$color' align=\"center\">$chk1</td>\n".
           " </tr>
		   
		   \n");
		 
		 echo "<input type='hidden' name='grow_id[]' id='row_id$num' value='$row_id'>";  
		echo "<input type='hidden' name='idno[]' id='idno$num' value='$idno'>";
		echo "<input type='hidden' name='part[]' id='part$num' value='$part'>";
		echo " <input type='hidden' name='tvn' value='<'$tvn'>";
   		echo "  <input type='hidden' name='ptright' value='$ptright'>";
     	echo "  <input type='hidden' name='doctor' value='$doctor'>";
    	echo " <input type='hidden' name='diag' value='$diag'>";
  		echo "  <input type='hidden' name='ptname' value='$ptname'>";
		   ?>
    </tr>
    <? 

	$i++;
	}  
	
	
	?>
    </table>
    <div align="left">

    <input type="hidden" name="hdnCount" value="<?=$num;?>">
    <input type="submit" name="b1" value="โอนค่าใช้จ่ายเข้าบัญชีผู้ป่วยใน" class="forntsarabun" /></div>
</form>
<?
}
?>