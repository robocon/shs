<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 16px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<p align="center" style="margin-top: 20px;"><strong>เลือกวันที่ต้องการดูข้อมูลหมายเลข Approve Code สิทธิเบิกจ่ายตรง</strong></p>
<div align="center">
<form method="POST" action="report_approvecode.php">
<input type="hidden" name="act" value="show" />
  <strong>HN :</strong>
  <input name="hn" type="text" id="hn" size="20" class="txt" 
         value="<?=(isset($_POST['hn'])?$_POST['hn']:'');?>"> 
  <br><br>
	<strong>ระหว่างวันที่ : </strong>
    <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>เลือกเดือน : </strong><select size="1" name="month1" class="txt">
    <option selected>-------เลือก-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>มกราคม</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>กุมภาพันธ์</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>มีนาคม</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>เมษายน</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>พฤษภาคม</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>มิถุนายน</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>กรกฎาคม</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>สิงหาคม</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>กันยายน</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>ตุลาคม</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>พฤศจิกายน</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>ธันวาคม</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year1'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       &nbsp; <strong>ถึงวันที่</strong> 
    <input name="date2" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>เลือกเดือน : </strong><select size="1" name="month2" class="txt">
    <option selected>-------เลือก-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>มกราคม</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>กุมภาพันธ์</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>มีนาคม</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>เมษายน</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>พฤษภาคม</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>มิถุนายน</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>กรกฎาคม</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>สิงหาคม</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>กันยายน</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>ตุลาคม</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>พฤศจิกายน</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>ธันวาคม</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year2'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>       
       <input type="submit" value="ดูข้อมูล" name="B1"  class="txt" />
       &nbsp;&nbsp;
       <input type="button" value="ไปเมนูหลัก" name="B2"  class="txt" onclick="window.location='../nindex.htm' " />
</form>
</div>
<?
if($_POST["act"]=="show"){
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];


$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

    // รับค่า HN จากฟอร์ม
    $hn = trim($_POST["hn"]);

    // สร้างเงื่อนไขค้นหา
    $where = " (a.txdate >= '$chkdate1' AND a.txdate <= '$chkdate2') AND a.credit='จ่ายตรง' ";
    if($hn != ""){
        $where .= " AND a.hn='$hn' ";
    }

?>
<hr />
<div align="center" style="margin-top: 20px;"><strong>รายงานแสดงหมายเลข Approve Code สิทธิเบิกจ่ายตรง</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?>
</div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="2%" align="center" bgcolor="#66CC99"><strong>DATE</strong></td>
    <td width="2%" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>ชื่อผู้ป่วย</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>ID CARD</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>หมวดหมู่</strong></td>
    <td width="16%" align="center" bgcolor="#66CC99"><strong>รายการ</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>จำนวนเงิน</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>จำนวนที่ขอเบิก</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>เจ้าหน้าที่</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>Approve Code</strong></td>
	<td width="6%" align="center" bgcolor="#66CC99"><strong>Billno</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>ผลการตอบกลับ</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>Statment No</strong></td>
	<td width="13%" align="center" bgcolor="#66CC99"><strong>จัดการ</strong></td>
  </tr>
<?
if($_SESSION["smenucode"]=="ADM" || $_SESSION["smenucode"]=="ADMCSCD"){ 
    $sql="SELECT a.row_id,a.date,a.txdate,a.hn,a.vn,a.price,a.paidcscd,a.credit,a.typecscd,a.idname,a.credit_detail,a.billno,a.detail,a.depart, 
                 CONCAT(c.yot,' ',c.name,' ',c.surname) AS ptname, 
                 c.idcard
          FROM opacc a
          LEFT JOIN opcard c ON a.hn=c.hn
          WHERE $where
          ORDER BY a.hn ASC";
}else{
    $sql="SELECT a.row_id,a.date,a.txdate,a.hn,a.vn,a.price,a.paidcscd,a.credit,a.typecscd,a.idname,a.credit_detail,a.billno,a.detail,a.depart, 
                 CONCAT(c.yot,' ',c.name,' ',c.surname) AS ptname, 
                 c.idcard
          FROM opacc a
          LEFT JOIN opcard c ON a.hn=c.hn
          WHERE $where
          ORDER BY a.txdate ASC";
}
//echo $sql;
$query=mysql_query($sql);
$i=0;
$sumprice=0;
$sumpaidcscd=0;
while($rows=mysql_fetch_array($query)){
	$i++;
	$sumprice=$sumprice+$rows["price"];
	$sumpaidcscd=$sumpaidcscd+$rows["paidcscd"];

	$txdate=substr($rows["txdate"],0,10); 
	
	$d=substr($rows["txdate"],8,2);
	$m=substr($rows["txdate"],5,2); 
	$y=substr($rows["txdate"],0,4);	
	
	$thdatehn="$d-$m-$y".$rows["hn"];



                    if( $rows["typecscd"] =="C"){
                        $bg="#F08080";
                    }else{
                        $bg="#F5FFFA";
                    }
					
					
					if($rows["credit_detail"]==""){
						$typecscd="<div style='color:red;'><strong>รอเลข approve code / จ่ายตรง กทม.</strong></div>";
					}else{
						if($rows["typecscd"]=="C"){
							$typecscd="<div style='color:red;'><strong>ติด C</strong></div>";
						}else if($rows["typecscd"]=="A"){
							$typecscd="<div style='color:blue;'><strong>แก้ C ผ่าน</strong></div>";
						}else if($rows["icd10_cscd"]=="y" && $rows["typecscd"]==""){
							$typecscd="<div style='color:green;'><strong>ผ่าน</strong></div>";
						}else if($rows["icd10_cscd"]=="" && $rows["typecscd"]==""){
							$typecscd="<div style='color:#FF6600;'><strong>รอส่งค้างลง ICD10</strong></div>";					
						}else{
							$typecscd="<div style='color:green;'><strong>&nbsp;</strong></div>";
						}
					}

					$y1=$y-543;
									
					$date="$y1$m$d";		
					$invbillno=str_replace(array("/"," "),'',$rows['billno']);	
					$invbillno=sprintf('%05d',$invbillno);
					$invvn=sprintf('%03d',$rows['vn']);

					$invno=$date.$invvn.$invbillno;  //อ้างอิง billtran.invno ขนาดข้อมูลต้อง >=9 && <= 16	

					
					$sql2="select accperiod	 from stm_cscd where hn='".$rows['hn']."' and invno='".$invno."'";
					$query2=mysql_query($sql2);
					$rows2=mysql_fetch_array($query2);
					$accperiod=$rows2["accperiod"];	

		
?>  
  <tr bgcolor="<?=$bg;?>">
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["date"]?></td>
    <td align="center"><?=$rows["vn"]?></td>
    <td align="center"><?=$rows["hn"]?></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows["idcard"];?></td>
    <td><?=$rows["depart"]?></td>
    <td><?=$rows["detail"]?></td>
    <td align="right"><?=$rows["price"]?></td>
    <td align="right"><?=$rows["paidcscd"]?></td>
    <td align="left"><?=$rows["idname"]?></td>
    <td align="center"><?=$rows["credit_detail"]?></td>
	<td align="center"><?=$rows["billno"]?></td>
    <td align="center"><?=$typecscd;?></td>
    <td align="center"><?=$accperiod;?></td>
    <td align="center"><a href="report_approvecode.php?getid=<?=$rows["row_id"];?>&act=edit">แก้ไข</a></td>
  </tr>
<?
}
?>  
  <tr>
    <td colspan="9" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="right"><?=number_format($sumprice,2);?></td>
    <td align="right"><?=number_format($sumpaidcscd,2);?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<p align="center">*** พื้นหลังสีแดง คือ มีส่วนเกินที่เบิกไม่ได้</p>
<?
}
if($_GET["act"]=="edit"){
$sql="select * from opacc where row_id=".$_GET['getid']."";
//echo $sql;
$query=mysql_query($sql);
$i=0;

$rows=mysql_fetch_array($query);
$i++;
$sql1="select * from opcard where hn='$rows[hn]'";
$query1=mysql_query($sql1);
$rows1=mysql_fetch_array($query1);
$ptname=$rows1["yot"]." ".$rows1["name"]."&nbsp;&nbsp;".$rows1["surname"];
?>
<hr />
<p align="center"><strong>แก้ไขหมายเลข Approve Code</strong></p>
<form id="form1" name="form1" method="post" action="report_approvecode.php">
<input type="hidden" name="act" value="update" />
<input type="hidden" name="postid" value="<?=$rows["row_id"]?>" />
<table width="80%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td><strong>วัน/เดือน/ปี ที่เก็บเงิน</strong></td>
    <td align="center">:</td>
    <td><?=$rows["date"]?></td>
  </tr>
  <tr>
    <td><strong>วัน/เดือน/ปี ที่เกิดค่าใช้จ่าย</strong></td>
    <td align="center">:</td>
    <td><?=$rows["txdate"]?></td>
  </tr>  
  <tr>
    <td width="19%"><strong>HN</strong></td>
    <td width="3%" align="center">:</td>
    <td width="78%"><?=$rows["hn"]?></td>
  </tr>
  <tr>
    <td><strong>VN</strong></td>
    <td align="center">:</td>
    <td><?=$rows["vn"]?></td>
  </tr>
  <tr>
    <td><strong>ชื่อ - นามสกุล</strong></td>
    <td align="center">:</td>
    <td><?=$ptname;?></td>
  </tr>
  <tr>
    <td><strong>หมวดหมู่</strong></td>
    <td align="center">:</td>
    <td><?=$rows["depart"]?></td>
  </tr>
  <tr>
    <td><strong>รายการ</strong></td>
    <td align="center">:</td>
    <td><?=$rows["detail"]?></td>
  </tr>
  <tr>
    <td><strong>จำนวนเงิน</strong></td>
    <td align="center">:</td>
    <td><?=$rows["price"]?></td>
  </tr>
  <? if($rows["depart"]=="PHAR"){ 
	$paidcscd=$rows["essd"]+$rows["nessdy"]+$rows["dpy"]+$rows["dsy"];
	$paidcscd=number_format($paidcscd,2);
  ?>
  <tr>
    <td><strong>จำนวนเงินค่ายา/เวชภัณฑ์ที่เบิกได้</strong></td>
    <td align="center">:</td>
    <td><?=$paidcscd;?></td>
  </tr>
  <? }else{ ?>
  <tr>
    <td><strong>จำนวนเงินที่เบิกได้</strong></td>
    <td align="center">:</td>
    <td><?=$rows["paidcscd"]?></td>
  </tr>  
  <? } ?>
<? if($_SESSION["smenucode"]=="ADM" || $_SESSION["smenucode"]=="ADMCSCD"){ ?>
  <tr>
    <td><strong>จำนวนเงินที่ขอเบิก</strong></td>
    <td align="center">:</td>
    <td><input name="paidcscd" type="text" class="txt" id="paidcscd" value="<?=$rows["paidcscd"];?>" /></td>
  </tr>
  <tr>
    <td><strong>Billno</strong></td>
    <td align="center">:</td>
    <td><input name="billno" type="text" class="txt" id="billno" value="<?=$rows["billno"];?>" /></td>
  </tr>  
  <? } ?>
  <tr>
    <td><strong>Approve Code</strong></td>
    <td align="center">:</td>
    <td><input name="approvecode" type="text" class="txt" id="approvecode" value="<?=$rows["credit_detail"];?>" /></td>
  </tr>
  <tr>
    <td bgcolor="#FF9999"><strong>สถานะ Statement</strong></td>
    <td align="center" bgcolor="#FF9999">:</td>
    <td bgcolor="#FF9999"><label>
      <input name="status_stm" type="checkbox" id="status_stm" value="n" <? if($rows["status_stm"]=="n"){ echo "checked";}?>>
      <strong>ยังไม่ได้รับ Statment      </strong></label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td><input type="submit" value="แก้ไขข้อมูล" name="submit"  class="txt" id="submit" /></td>
  </tr>
</table>
</form>
<?
}
if($_POST["act"]=="update"){
	$postid=$_POST["postid"];
	$approvecode=trim($_POST["approvecode"]);
	$billno=trim($_POST["billno"]);
	$paidcscd=$_POST["paidcscd"];
	$paidcscd=number_format( $paidcscd, 2, '.', '');
	
	$status_stm=$_POST["status_stm"];
	
	if($_SESSION["smenucode"]=="ADM" || $_SESSION["smenucode"]=="ADMCSCD"){
		$edit="update opacc set credit_detail='$approvecode', status_stm='$status_stm',paidcscd='$paidcscd',billno='$billno' where row_id='$postid'";
	}else{
		$edit="update opacc set credit_detail='$approvecode', status_stm='$status_stm' where row_id='$postid'";
	}
	if(mysql_query($edit)){
		echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');windows.location='report_apporvecode.php';</script>";
	}else{
		echo "<script>alert('!!!ผิดพลาด...ไม่สามารถแก้ไขข้อมูลได้');window.location='report_apporvecode.php?act=edit&getid=$postid';</script>";
	}
}
?>