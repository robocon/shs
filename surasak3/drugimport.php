<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
.font1 {
	font-family:"TH SarabunPSK";
}
-->
</style>
<table width="100%" border="0" class="font1">
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td colspan="3" align="center">โรงพยาบาลค่ายสุรศักดิ์มนตรี</td>
        </tr>
      <tr>
        <td colspan="3" align="center">ใบเบิกยาและเวชภัณฑ์ กองเภสัชกรรม</td>
        </tr>
      <tr>
        <td colspan="3" align="center">กองเภสัชกรรม เอกสารหมายเลข FR-PHA-004/3 แก้ไขครั้งที่ ...02...</td>
        </tr>
      <tr>
        <td width="28%">&nbsp;</td>
        <td width="24%">&nbsp;</td>
        <td width="48%">วันที่มีผลบังคับใช้ ...ส.ค...2551</td>
      </tr>
      <tr>
        <td>ที่ใบเบิก</td>
        <td>&nbsp;</td>
        <?
        $arrmon =  array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคา","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		?>
        <td>วันที่...<?=date("d")?>....เดือน...<?=$arrmon[date("m")]?>...พ.ศ...<?=date("Y")+543?>...</td>
      </tr>
      <tr>
        <td>ผู้ขอเบิก <?=$_SESSION['sOfficer']?></td>
        <td>&nbsp;</td>
        <td>แผนก..............................</td>
      </tr>
      <tr>
        <td colspan="3">คำนวณการจ่ายยาตั้งแต่วันที่ <?=$_SESSION['yymall']?> ตรวจสอบเมื่อวันที่ <?=$_SESSION['datetime']?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
      <tr>
        <td width="4%" rowspan="2" align="center">ลำดับ</td>
        <td width="13%" rowspan="2" align="center">Drugcode</td>
        <td width="32%" rowspan="2" align="center">Tradname</td>
        <td width="6%" rowspan="2" align="center">Min</td>
        <td width="5%" rowspan="2" align="center">Max</td>
        <td width="6%" rowspan="2" align="center">ห้องจ่าย</td>
        <td width="5%" rowspan="2" align="center">คลัง</td>
        <td width="6%" rowspan="2" align="center">จ่ายยา</td>
        <td colspan="2" align="center">จำนวน</td>
        <td width="7%" rowspan="2" align="center">หมายเหตุ</td>
      </tr>
      <tr>
        <td width="8%" align="center">ขอเบิก</td>
        <td width="8%" align="center">จ่ายจริง</td>
      </tr>
      <?
	  	$query = "SELECT title,prefix,runno FROM runno WHERE title = 'drugimp'";
	  	$result = mysql_query($query) or die("Query failed");
			
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
			
			if(!($row = mysql_fetch_object($result)))
				continue;
		}
			
		$nRunno=$row->runno;
		$nRunno++;
			
		$query ="UPDATE runno SET runno = $nRunno WHERE title='drugimp'";
		$result = mysql_query($query) or die("Query failed");
		
      $cont = $_POST['sump'];
	  for($p=1;$p<=$cont;$p++){
		  if($_POST['import'.$p]!=""||$_POST['import'.$p]!=0){

			$sel2 = "SELECT a.*, b.`min` AS `new_min`, b.`max` AS `new_max` 
			FROM `druglst` AS a 
			RIGHT JOIN `drug_control_user` AS b ON b.`drugcode` = a.`drugcode` 
			WHERE a.`drugcode` = '".$_POST['drx'.$p]."' 
			AND b.`username` = '".$_SESSION['sOfficer']."'";

			  $row2 = mysql_query($sel2);
			  $result2 = mysql_fetch_array($row2);

			  $r++;
			
			  $import = "insert into drugimport (thidate,drugcode,tradname,min,max,stock,mainstk,dispense,amountrx,idno,usercontrol,datesearch) values ('".$_SESSION['datetime']."','".$_POST['drx'.$p]."','".$result2['tradname']."','".$result2['new_min']."','".$result2['new_max']."','".$result2['stock']."','".$result2['mainstk']."','".$_POST['rxdrug'.$p]."','".$_POST['import'.$p]."','".$nRunno."','".$_SESSION['sOfficer']."','".$_SESSION['yymall']."')";
			  $result56 = mysql_query($import) or die(mysql_error());
	  ?>
      <tr>
        <td align="center"><?=$r?></td>
        <td><?=$_POST['drx'.$p]?></td>
        <td><?=$result2['tradname']?></td>
        <td align="center"><?=$result2['new_min']?></td>
        <td align="center"><?=$result2['new_max']?></td>
        <td align="center"><?=$result2['stock']?></td>
        <td align="center"><?=$result2['mainstk']?></td>
        <td align="center"><?=$_POST['rxdrug'.$p]?></td>
        <td align="center"><?=$_POST['import'.$p]?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?
		  }
	  }
	  ?>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td colspan="2">ตรวจแล้วเห็นว่า.................................................................................</td>
        <td colspan="2">ขอเบิกสิ่งอุปกรณ์ตามที่ระบุไว้ในช่อง &quot;จำนวนเบิก&quot; และขอมอบให้</td>
        </tr>
      <tr>
        <td colspan="2"> .........................................................................................................</td>
        <td colspan="2">..........................................................................เป็นผู้รับแทน</td>
        </tr>
      <tr>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
      </tr>
      <tr>
        <td>(ลงนาม) ผู้ตรวจสอบ</td>
        <td>วัน เดือน ปี</td>
        <td>(ลงนาม) ผู้เบิก</td>
        <td>วัน เดือน ปี</td>
      </tr>
      <tr>
        <td colspan="2">อนุมัติให้จ่ายได้เฉพาะในรายการและจำนวนที่ผู้ตรวจสอบเสนอ</td>
        <td colspan="2">ได้รับสิ่งอุปกรณ์ตามรายการและจำนวนที่แจ้งไว้ในช่อง &quot;จ่ายจริง&quot;</td>
        </tr>
      <tr>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
      </tr>
      <tr>
        <td>(ลงนาม) ผู้สั่งจ่าย</td>
        <td>วัน เดือน ปี</td>
        <td>(ลงนาม) ผู้รับ</td>
        <td>วัน เดือน ปี</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
      </tr>
      <tr>
        <td>(ลงนาม) ผู้จ่าย</td>
        <td>วัน เดือน ปี</td>
        <td>(ลงนาม) จนท.ส่วนควบคุมทางบัญชี</td>
        <td>วัน เดือน ปี</td>
      </tr>
    </table></td>
  </tr>
</table>
