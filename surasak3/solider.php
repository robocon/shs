<?php
include("connect.inc");
?>
<STYLE>
.font1 {
	font-family: "Angsana New";
	font-size:20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</STYLE>
</head>

<body>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form id="form1" name="form1" method="post" action="solider.php">
<table width="48%" border="0" align="center">
  <tr>
    <td align="center">รายงานการตรวจร่างกายประจำปี ทบ.</td>
  </tr>
  <tr>
    <td align="center">
          กลุ่ม :  
<select  name='camp'>
<option value='0' >--เลือกสังกัด--</option>
<option value='พลเรือน'>พลเรือน</option>
<option value='ร.17 พัน2'>ร.17 พัน2</option>
<option value='มณฑลทหารบกที่32'>มณฑลทหารบกที่32</option>
<option value='ร.พ.ค่ายสุรศักดิ์มนตรี'>ร.พ.ค่ายสุรศักดิ์มนตรี</option>
<option value='ช.พัน4'>ช.พัน4</option>
<option value='ร้อยฝึกรบพิเศษประตูผา'>ร้อยฝึกรบพิเศษประตูผา</option>
<option value='บก.มทบ.32'>บก.มทบ.32</option>
<option value='กกพ.มทบ.32'>กกพ.มทบ.32</option>
<option value='กขว.,ฝผท.มทบ.32'>กขว.,ฝผท.มทบ.32</option>
<option value='กยก.มทบ.32'>กยก.มทบ.32</option>
<option value='กกบ.มทบ.32'>กกบ.มทบ.32</option>
<option value='กกร.มทบ.32'>กกร.มทบ.32</option>
<option value='ฝคง.มทบ.32'>ฝคง.มทบ.32</option>
<option value='ฝกง.มทบ.32'>ฝกง.มทบ.32</option>
<option value='ฝสก.มทบ.32'>ฝสก.มทบ.32</option>
<option value='ฝปบฝ.มทบ.32'>ฝปบฝ.มทบ.32</option>
<option value='ผพธ.มทบ.32'>ผพธ.มทบ.32</option>
<option value='อก.ศาล มทบ.32'>อก.ศาล มทบ.32</option>
<option value='ฝสวส.มทบ.32'>ฝสวส.มทบ.32</option>
<option value='ฝธน.มทบ.32'>ฝธน.มทบ.32</option>
<option value='อศจ.มทบ.32'>อศจ.มทบ.32</option>
<option value='ร้อย.มทบ.32'>ร้อย.มทบ.32</option>
<option value='สขส.มทบ.32'>สขส.มทบ.32</option>
<option value='รจ.มทบ.32'>รจ.มทบ.32</option>
<option value='ผยย.มทบ.32'>ผยย.มทบ.32</option>
<option value='สส.มทบ.32'>สส.มทบ.32</option>
<option value='ฝสห.มทบ.32'>ฝสห.มทบ.32</option>
<option value='ร้อย.สห.มทบ.32'>ร้อย.สห.มทบ.32</option>
<option value='มว.ดย.มทบ.32'>มว.ดย.มทบ.32</option>
<option value='ผสพ.มทบ.32'>ผสพ.มทบ.32</option>
<option value='สรรพกำลัง มทบ.32'>สรรพกำลัง มทบ.32</option>
<option value='ศฝ.นศท.มทบ.32'>ศฝ.นศท.มทบ.32</option>
<option value='ศาล.มทบ.32'>ศาล.มทบ.32</option>
<option value='ศูนย์โทรศัพท์ มทบ.32'>ศูนย์โทรศัพท์ มทบ.32</option>
<option value='ผปบ.มทบ.32'>ผปบ.มทบ.32</option>
<option value='สัสดีจังหวัดลำปาง'>สัสดีจังหวัดลำปาง</option>
<option value='มว.คลัง สป.๓ฯ'>มว.คลัง สป.๓ฯ</option>
<option value='กรม ทพ.33'>กรม ทพ.33</option>
<option value='หน่วยทหารอื่นๆ'>หน่วยทหารอื่นๆ</option>
</select>
&nbsp;ปี :
<select name="year">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select>
    </td>
    </tr>
  <tr>
    <td align="center"><input type="submit" name="button" id="button" value="ตกลง" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</div>
<?
if(isset($_POST['button'])){
	$query2 = "select * from condxofyear_so where camp like '%".$_POST['camp']."%' and yearcheck='".$_POST['year']."' ";
	$aa2 = mysql_query($query2);
	while($result2 = mysql_fetch_array($aa2)){
		$query = "select *,concat(yot,' ',name,' ',surname) as name from opcard where hn='".$result2['hn']."'";
		$aa = mysql_query($query);
		$result = mysql_fetch_array($aa);
		$camp = substr($result[camp],4);
	?>
	<table width="100%" class="font1">
    	<tr><td colspan="4" align="center">รายงานการตรวจร่างกายประจำปี</td></tr>
        <tr><td width="37%">เลขที่ </td><td colspan="2">ชื่อ <?=$result['name']?></td><td width="25%">อายุ 
        <?=$result2['age']?></td></tr>
        <tr><td>บ้านเลขที่ 
        <?=$result['address']?></td><td width="22%">ตำบล 
        <?=$result['tambol']?></td><td width="16%">อำเภอ 
        <?=$result['ampur']?></td><td>จังหวัด 
        <?=$result['changwat']?></td></tr>
        <tr>
          <td colspan="4">หน่วยสังกัด
            <?=$result2['camp']?>
            <br /><hr />
		</td>
        </tr>
        <tr>
          <td colspan="4">โรคที่ตรวจพบ
          <?=$result2['diag']?></td>
        </tr>
        <tr>
          <td colspan="4">ความเห็นของแพทย์ผู้ตรวจ
          <?=$result2['dx']?></td>
        </tr>
        <tr>
        <?
        $datetime= explode(" ",$result2['thidate']);
		$add=explode("-",$datetime[0]);
		?>
          <td colspan="2">ตรวจเมื่อ <?=$add[2]."/".$add[1]."/".$add[0]." ".$datetime[1]?></td>
          <td colspan="2">แพทย์ผู้ตรวจ
          <?=$result2['doctor']?></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4" align="center"><u>รายงานผลของการตรวจธรรมดาทั่วไป</u></td>
        </tr>
        <tr>
          <td>ก.ลักษณะทั่วไป</td>
          <td colspan="3"><?=$result2['soldier1']?>&nbsp;<?=$result2['reason_sol1']?></td>
        </tr>
        <tr>
          <td>ข.ผิวหนัง</td>
          <td colspan="3"><?=$result2['soldier2']?>&nbsp;<?=$result2['reason_sol2']?></td>
        </tr>
        <tr>
          <td>ค.ทางเดินแห่งอาหาร</td>
          <td colspan="3"><?=$result2['soldier3']?>&nbsp;<?=$result2['reason_sol3']?></td>
        </tr>
        <tr>
          <td>ง.ทางเดินแห่งลมหายใจ</td>
          <td colspan="3"><?=$result2['soldier4']?>&nbsp;<?=$result2['reason_sol4']?></td>
        </tr>
        <tr>
          <td>จ.ทางเดินแห่งโลหิต</td>
          <td colspan="3"><?=$result2['soldier5']?>&nbsp;<?=$result2['reason_sol5']?></td>
        </tr>
        <tr>
          <td>ฉ.ทางเดินแห่งน้ำเหลือง</td>
          <td colspan="3"><?=$result2['soldier6']?>&nbsp;<?=$result2['reason_sol6']?></td>
        </tr>
        <tr>
          <td>ช.ทางเดินแห่งปัสสาวะและอวัยวะสืบพันธุ์</td>
          <td colspan="3"><?=$result2['soldier7']?>&nbsp;<?=$result2['reason_sol7']?></td>
        </tr>
        <tr>
          <td>ซ.สมองและประสาท</td>
          <td colspan="3"><?=$result2['soldier8']?>&nbsp;<?=$result2['reason_sol8']?></td>
        </tr>
        <tr>
          <td>ญ.กระดูกและข้อ</td>
          <td colspan="3"><?=$result2['soldier9']?>&nbsp;<?=$result2['reason_sol9']?></td>
        </tr>
        <tr>
          <td>ด.ตา,หู,คอ,จมูก</td>
          <td colspan="3"><?=$result2['soldier10']?>&nbsp;<?=$result2['reason_sol10']?></td>
        </tr>
        <tr>
          <td colspan="4" align="center"><u>รายงานผลของการตรวจพิเศษ</u></td>
        </tr>
        <tr>
          <td>ก.อุจจาระ</td>
          <td>ไม่มีการตรวจ</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>ข.ปัสสาวะ</td>
          <td><?=$result2['stat_ua']?>&nbsp;<?=$result2['reason_ua']?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>ค.เสมหะ</td>
          <td>ไม่มีการตรวจ</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>ง.เลือด</td>
          <td><?=$result2['summary']?>&nbsp;<?
          if($result2['stat_sgot']=="ผิดปกติ"|$result2['stat_sgpt']=="ผิดปกติ"|$result2['stat_alk']=="ผิดปกติ") echo "ตับ ";
		if($result2['stat_cr']=="ผิดปกติ"|$result2['stat_bun']=="ผิดปกติ") echo "ไต ";
		if($result2['stat_chol']=="ผิดปกติ"|$result2['stat_tg']=="ผิดปกติ") echo "ไขมัน ";
		if($result2['stat_bs']=="ผิดปกติ") echo "เบาหวาน ";
		if($result2['stat_uric']=="ผิดปกติ") echo "URIC ";
		//if($result2['stat_cbc']=="ผิดปกติ") echo "CBC ";
		?>
          </td>
          <td colspan="2">หมู่เลือด&nbsp;&nbsp;
          <?=$result['blood']?></td>
        </tr>
        <tr>
          <td>จ.ตรวจโรคเอ๊กซเรย์</td>
          <td><?=$result2['cxr']?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>ฉ.ตรวจโดยวิธีอื่นๆ</td>
          <td>-</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
	</table>
	<?
	echo "<div style='page-break-after: always'></div>";
	}
}
?>
</body>
</html>