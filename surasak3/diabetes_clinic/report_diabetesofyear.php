<?php 
session_start();
require "../connect.php";
require "../includes/functions.php";

// Verify user before load content
if( authen() === false ){ die('Session หมดอายุ <a href="../login_page.php">คลิกที่นี่</a> เพื่อทำการเข้าสู่ระบบอีกครั้ง'); }

require "header.php";

$d=date('d');
$m=date('m');
$year=date("Y");
  	$startdate=$_POST["y_start"]."-".$_POST["m_start"]."-".$_POST["d_start"];
	$enddate=$_POST["y_end"]."-".$_POST["m_end"]."-".$_POST["d_end"];
	$showstart=$_POST["d_start"]."/".$_POST["m_start"]."/".$_POST["y_start"];
	$showend=$_POST["d_end"]."/".$_POST["m_end"]."/".$_POST["y_end"];
	$tbsql="SELECT * FROM `diabetes_clinic` WHERE thidate between '2013-10-01' and '2014-09-30' GROUP BY hn";
	//echo $tbsql;
	$tbquery=mysql_query($tbsql);
	$tbnum=mysql_num_rows($tbquery);
?> 
<p align="center"><strong>รายงานผู้ป่วย DM ประจำปีงบประมาณ 2557</strong></p>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="4%" rowspan="2" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="7%" rowspan="2" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="14%" rowspan="2" align="center" bgcolor="#66CC99"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="15%" rowspan="2" align="center" bgcolor="#66CC99"><strong>สิทธิการรักษา</strong></td>
    <td width="15%" rowspan="2" align="center" bgcolor="#66CC99"><strong>ประเภท</strong></td>
    <td width="16%" rowspan="2" align="center" bgcolor="#66CC99"><strong>
    <div>HBA1C ครั้งสุดท้าย</div>
    <div>น้อยกว่า 7 %</div>
    </strong></td>
    <td width="17%" rowspan="2" align="center" bgcolor="#66CC99"><strong>
    <div>FBS 3 ครั้งสุดท้ายติดต่อกัน</div>
    <div>ไม่เกิน 130 mg/D1</div>
    </strong></td>
    <td width="27%" colspan="5" align="center" bgcolor="#66CC99"><strong>
      <div>ได้รับการตรวจ     </div><div>อย่างน้อย 1 ครั้ง ต่อปี</div></strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#66CC99"><strong>BS</strong></td>
    <td align="center" bgcolor="#66CC99"><strong>HbA1c</strong></td>
    <td align="center" bgcolor="#66CC99"><strong>LDL</strong></td>
    <td align="center" bgcolor="#66CC99"><strong>Creatinine</strong></td>
    <td align="center" bgcolor="#66CC99"><strong>Microalbuminuria</strong></td>
  </tr>
  <?php 	if($tbnum < 1){
		echo "<tr><td colspan='8' align='center' style='color:red;'>------------------------ ไม่มีข้อมูล ------------------------</td></tr>";
	}else{
		$i=0;
		while($tbrows=mysql_fetch_array($tbquery)){
		$i++;
		$sql=mysql_query("select idguard, camp from opcard where hn='".$tbrows["hn"]."'");
		list($idguard, $camp)=mysql_fetch_array($sql);
/*		if($camp=="M01 พลเรือน" && $idguard !="MX01 ทหาร/ครอบครัว"){
			$idguard="MX00 บุคคลทั่วไป";
		}*/		
?>  
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["hn"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptname"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptright"];?></td>  
    <td align="left" bgcolor="#CCFFCC"><?=$idguard;?></td>
    <td align="center" bgcolor="#CCFFCC">
	<?php       $laball1="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='HBA1C' and b.orderdate like '$year%' Order by b.orderdate desc";
	  $result_laball1=mysql_query($laball1);
	  $rowall1=mysql_num_rows($result_laball1);
	  $resultall1=mysql_fetch_array($result_laball1);
	  if($rowall1 < 1){
	  	echo "ไม่ได้ตรวจ";
	  }else{
	  	if($resultall1["result"] < 7.0){
			echo "1";
		}else{
			echo "0";
		}
	  }
	?>    </td>
    <td align="center" bgcolor="#CCFFCC">
	<?php       $laball1="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='Blood Sugar' and b.orderdate like '$year%' Order by b.orderdate desc limit 3";
	  $result_laball1=mysql_query($laball1);
	  $rowall1=mysql_num_rows($result_laball1);

	  if($rowall1 < 3){
	  	 if($rowall1 < 1){
		 	echo "ไม่ได้ตรวจ";
	  	 }else{
		 	echo "ตรวจไม่ถึง 3 ครั้ง";
		 }
	  }else{
	  	$num=0;
	  	while($resultall1=mysql_fetch_array($result_laball1)){
			if($resultall1["result"] < 130){
				$num++;
			}
		}  //close while
			if($num==3){
				echo "1";
			}else{
				echo "0";
			}			
	  } //close if
	?>    </td>
    <td align="center" bgcolor="#CCFFCC">
	<?php       $labtest1="Select labname,result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='Blood Sugar' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
	  $result_labtest1=mysql_query($labtest1);
	  $rowlabtest1=mysql_num_rows($result_labtest1);
		  if($rowlabtest1 < 1){
			echo "0";
		  }else{
			echo "1";
		  }
	?>    </td>
    <td align="center" bgcolor="#CCFFCC"><?php       $labtest2="Select labname,result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='HBA1C' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
	  $result_labtest2=mysql_query($labtest2);
	  $rowlabtest2=mysql_num_rows($result_labtest2);
		  if($rowlabtest2 < 1){
			echo "0";
		  }else{
			echo "1";
		  }
	?></td>
    <td align="center" bgcolor="#CCFFCC"><?php       $labtest3="Select labname,result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='LDL' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
	  $result_labtest3=mysql_query($labtest3);
	  $rowlabtest3=mysql_num_rows($result_labtest3);
		  if($rowlabtest3 < 1){
			echo "0";
		  }else{
			echo "1";
		  }
	?></td>
    <td align="center" bgcolor="#CCFFCC"><?php       $labtest4="Select labname,result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='Creatinine' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
	  $result_labtest4=mysql_query($labtest4);
	  $rowlabtest4=mysql_num_rows($result_labtest4);
		  if($rowlabtest4 < 1){
			echo "0";
		  }else{
			echo "1";
		  }
	?></td>
    <td align="center" bgcolor="#CCFFCC"><?php       $labtest5="Select labname,result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$tbrows["hn"]."' and  a.labname='Urine Microalbumin' and b.orderdate like '$year%' Order by b.orderdate desc LIMIT 1";
	  $result_labtest5=mysql_query($labtest5);
	  $rowlabtest5=mysql_num_rows($result_labtest5);
		  if($rowlabtest5 < 1){
			echo "0";
		  }else{
			echo "1";
		  }
	?></td>
  </tr>
  <?php 	  	}
	}
  ?>
</table>
<?php
include 'footer.php';