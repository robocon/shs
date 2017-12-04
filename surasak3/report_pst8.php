<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
?>

<body>
<div align="center">
  <p><strong>รายงานจำนวนผู้มารับบริการของ รพ.ทบ.(ตัวชี้วัด) (รง.ผสต.8)<br>
  หน่วยงาน  โรงพยาบาลค่ายสุรศักดิ์มนตรี  <br>
 ประจำเดือน  <?=$mon;?>&nbsp;ปี <?=$thyear;?></strong></p>
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2" rowspan="2" align="center"><strong>ประเภทบุคคล</strong></td>
      <td width="23%" rowspan="2" align="center"><strong>ผู้ป่วยนอก<br>
      (ครั้ง)</strong></td>
      <td width="22%" align="center"><strong>ผู้ป่วนใน</strong></td>
    </tr>
    <tr>
      <td align="center"><strong>(รับใหม่)</strong></td>
    </tr>
    <tr>
      <td width="6%" align="center"><strong>ประเภท ก.</strong></td>
      <td width="49%" align="left"><p>นายทหารประจำการ , นายสิบประจำการ , นายสิบประจำการ</p>
      <p>ข้าราชการกลาโหมพลเรือน , ลูกจ้างประจำ , ลูกจ้างชั่วคราว</p></td>
      
       <?
	  $sql1="select * from opday where an is null  and thidate  between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 // echo $sql1;
	  $query1=mysql_query($sql1);
	  $aball=0;
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows1=mysql_fetch_array($query1)){
		 //  $aball++;
	  $group=substr($rows1["goup"],0,2);
	 // echo "--->".$group."<br>";
	  	if($group=="G1"){
			$ab1++;
		}
		if($group=="G2"){
			$ab2++;		
		}
		if($group=="G3" || $group=="G4"){
			$ab3++;	
		}
	  }
	  $aball=$ab1+$ab2+$ab3;
	  
	  $sql2="select * from ipcard where date between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //  $sql2="select * from opday where an is not null  and thidate  between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	// echo $sql2;
	  $query2=mysql_query($sql2);
	  $aballin=0;
	  $ab1in=0;
	  $ab2in=0;
	  $ab3in=0;
	  while($rows2=mysql_fetch_array($query2)){
		   //$aballin++;
	  $group=substr($rows2["goup"],0,2);
	 // echo "--->".$group."<br>";
	  	if($group=="G1"){
			$ab1in++;
		}
		if($group=="G2"){
			$ab2in++;		
		}
		if($group=="G3" || $group=="G4"){
			$ab3in++;	
		}
	  }
	
	  $aballin=$ab1in+$ab2in+$ab3in;
	  ?>
      
      
      
      <td><center><?=$ab1;?></td>
      <td><center><?=$ab1in;?></td>
    </tr>
    <tr>
      <td align="center"><strong>ประเภท ข.</strong></td>
      <td align="left"><p>พลทหารกองประจำการ , นักเรียนทหาร ,</p>
      <p>อาสาสมัครทหารพราน , นักโทษทหาร , และพนักงานราชการ</p></td>
      <td><center><?=$ab2;?></td>
      <td><center><?=$ab2in;?></td>
    </tr>
    <tr>
      <td align="center"><strong>ประเภท ค.</strong></td>
      <td align="left"><p>ครอบครัวทหาร , ทหารนอกประจำการ , นักศึกษาวิชาทหาร (รด.)</p>
      <p>วิวัฒน์พลเมือง , พลเรือนใช้บัตรประกันสังคม</p>
      <p>พลเรือนใช้บัตรประกันสุขภาพ , ข้าราชการพลเรือน (เบิกต้นสังกัด)</p>
      <p>พลเรือน (ไม่เบิกต้นสังกัด) , พลเรือน อื่นๆ</p>
      </td>
      <td><center><?=$ab3;?></td>
      <td><center><?=$ab3in;?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><strong>รวมทั้งสิ้น</strong></td>
      <td> <center><?=$aball;?></td>
      <td><center><?=$aballin;?></td>
    </tr>
  </table>
  <p><strong>ตรวจถูกต้อง</strong></p>
</div>
</body>
</html>
