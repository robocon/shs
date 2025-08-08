<? 
session_start();
include("connect.inc");
$officer = $_SESSION["sOfficer"];

$tmp_y = date("Y")+543;
$tmp_m = date("m");
$tmp_d = date("d");
//echo $tmp_y."/".$tmp_m."/".$tmp_d;
?>
<style type="text/css">
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 20px;
}
</style>
<title>ใบรับรองแพทย์ Covid-19</title>

<p align="center" style="margin-top: 20px;"><strong><u>ใบรับรองแพทย์ Covid-19</u></strong></p>

<? 
if(empty($_POST['hn'])){
  if(empty($_GET["hn"])){
	$hn = $_POST['hn'];
  }else{
	$hn=$_GET["hn"];
  } 
  ?>
  <div align="center">
  <form method="POST" action="Opd_Covid19_Medical_Cert.php" >
  </p>
      <strong>HN : </strong> <input type="text" name="hn" id="hn" value="<?=$hn;?>">
  &nbsp;&nbsp;&nbsp;
  
         <input type="submit" value="ค้นหา" name="B1"  class="txt" />
  </form> 
  </div>
  <?
}else{	  
  
  //-----> sql
  $sql = "SELECT idcard , yot , name , surname , phone , address , tambol ,	ampur	, changwat FROM opcard WHERE hn = '$hn' ";

  $query = mysql_query($sql); 
  $num = mysql_num_rows($query);

  if(empty($num)){
    echo "<h1 align='center'>ไม่พบข้อมูล</h1>";echo "<br>".exit();
  }//end if

  while($rows = mysql_fetch_array($query)){

    $Pt_Idcard = $rows["idcard"];
    $Pt_Yot = $rows["yot"];
    $Pt_Name = $rows["name"];
    $Pt_Surname = $rows["surname"];
    $Pt_Phone = $rows["phone"];
    $Pt_Address = $rows["address"];
    $Pt_Tambol = $rows["tambol"];
    $Pt_Ampur = $rows["ampur"];
    $Pt_Changwat = $rows["changwat"]; 
    $Pt_Phone = $rows["phone"]; 

    $Pt_Full_Name = $Pt_Yot.' '.$Pt_Name.' '.$Pt_Surname;
    $Pt_Full_Address = $Pt_Address.' '.$Pt_Tambol.' '.$Pt_Ampur.' '.$Pt_Changwat;

  }//end while
 
/////////////////////////////////////////////////////////////////////


//-----> sql เลขเอกสาร run no
$sql = "SELECT row_id,vn,hn FROM opday where hn = '$hn' ORDER BY row_id ASC ";

$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
  echo "<h1 align='center'>ไม่พบข้อมูล run no.</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){

  $Runno_Rowid = $rows["row_id"]; 
  $Runno_Vn = $rows["vn"]; 
  $Runno_Hn = $rows["hn"]; 

  $Runno_Show = 'CO'.$Runno_Rowid.'-'.$Runno_Vn;

}//end while

/////////////////////////////////////////////////////////////////////

//-----> sql หมอ
$sql = "SELECT row_id, yot , name , doctorcode FROM doctor WHERE status = 'y' AND (`name` NOT REGEXP '^HD' AND `name` NOT REGEXP '^NID') AND (`doctorcode` IS NOT NULL AND `doctorcode` != '00000' AND `doctorcode` != '0000')";
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
  echo "<h1 align='center'>ไม่พบข้อมูล</h1>";echo "<br>".exit();
}//end if


////////////////////////////////////////////////////////////////////

//-----> sql วันกักตัว
$sql0 = "SELECT symptom_date	, dcdate FROM opselfisolation_detail WHERE hn = '$hn' ";

$query0 = mysql_query($sql0); 
$num0 = mysql_num_rows($query0);

//if(empty($num0)){
//  echo "<h1 align='center'>ไม่พบข้อมูล กักตัว</h1>";echo "<br>".exit();
//}//end if

while($rows0 = mysql_fetch_array($query0)){
 
  $symptom_date_y = substr($rows0["symptom_date"],0,4)+543;
  $symptom_date_m = substr($rows0["symptom_date"],5,2);
  $symptom_date_d = substr($rows0["symptom_date"],8,2);
    $symptom_date = $symptom_date_d."/".$symptom_date_m."/".$symptom_date_y; 
  $dcdate = $rows0["dcdate"]; 
  $dcdate_y = substr($rows0["dcdate"],0,4)+543;
  $dcdate_m = substr($rows0["dcdate"],5,2);
  $dcdate_d = substr($rows0["dcdate"],8,2);
    $dcdate = $dcdate_d."/".$dcdate_m."/".$dcdate_y;
  

}//end while

$txt_doctor = 'ได้มาตรวจจริง ให้รักษาแบบผู้ป่วยนอกและแยกกักตัว 3 วัน ('.$symptom_date.' ถึง '.$dcdate.')';
////////////////////////////////////////////////////////////////////

  echo '

    <div align="left">

    <a href="Opd_Covid19_Medical_Cert.php"><b>[ ย้อนกลับ ]</b></a>

    <form method="POST" action="Opd_Covid19_Medical_Cert_Show.php"  target="_blank">
    </p>
        <strong>HN : </strong> '.$hn.' 
        &nbsp;&nbsp;&nbsp;
        <strong>ชื่อ-นามสกุล : </strong> '.$Pt_Yot.'' .$Pt_Name.'' .$Pt_Surname.' 
        <br>
        <strong>ที่อยู่ : </strong> '.$Pt_Address.'' .$Pt_Tambol.'' .$Pt_Ampur.' '.$Pt_Changwat.' 
        &nbsp;&nbsp;&nbsp;
        <br>
        <strong>หมายเลขบัตรประชาชน : </strong> '.$Pt_Idcard.' 
        &nbsp;&nbsp;&nbsp;
        <strong>เบอร์โทรศัพท์ : </strong> '.$Pt_Phone.' 

        <hr>
         <strong>วันที่ : </strong><select size="1" name="day1" class="txt">
         <option value="'.$tmp_d.'">'.$tmp_d.'</option>
        ';
        $number = 1;  
        for($i=01;$i<=31;$i++){
          echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
        }//end for
        
        
        echo '
        </select>
        <strong>เดือน : </strong><select size="1" name="month1" class="txt"> 
        <option value="'.$tmp_m.'">'.$tmp_m.'</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
          </select>';

          
         echo '<strong>ปี : </strong><select name="year1"  class="txt">';
         echo '<option value="'.$tmp_y.'">'.$tmp_y.'</option>';
         echo '<option value="2565">2565</option>';
         echo '<option value="2566">2566</option>';
         echo '</select>';
    


        echo '
        <br>  
        <strong>ป่วยด้วยโรค : </strong> 
        <br>
        <textarea id="diagnosis" name="diagnosis" rows="4" cols="50">ติดเชื้อเข้าข่ายโควิด - 19 (ATK positive)</textarea>
        <br>
        <strong>มีความเห็นว่า : </strong> 
        <br>
        <textarea id="comment" name="comment" rows="4" cols="50">'.$txt_doctor.'</textarea>
        <br>
        <strong>แพทย์ผู้ตรวจ : </strong><br>
        <select name="doctor">
        ';

        while($rows = mysql_fetch_array($query)){

          $Doctor_Rowid = $rows["row_id"];
          $Doctor_Yot = $rows["yot"];
          $Doctor_Name = substr($rows["name"],5);
          $Doctor_Code = $rows["doctorcode"]; 
        
          echo '<option value="'.$Doctor_Rowid.'">'.$Doctor_Yot.' '.$Doctor_Name.' ('.$Doctor_Code.')</option>';

        }//end while


  echo '</select>

        <br>
        <strong>ประจำคลินิก : </strong> คลินิก ARI (ติดเชื้อระบบทางเดินหายใจ)

        <br><br><br><br>
        <input type="submit" value="พิมพ์ใบรับรองแพทย์" name="B1"  class="txt" />


        <input type="hidden" value="'.$hn.'" name="hn">
        <input type="hidden" value="'.$Pt_Idcard.'" name="idcard">
        <input type="hidden" value="'.$Pt_Full_Name.'" name="ptname">
        <input type="hidden" value="'.$Pt_Full_Address.'" name="ptaddress">
        <input type="hidden" value="'.$Doctor_Rowid.'" name="doctor_rowid">
        <input type="hidden" value="'.$Pt_Phone.'" name="phone"> 
        <input type="hidden" value="'.$officer.'" name="officer">
        <input type="hidden" value="'.$Runno_Show.'" name="runno">

    </form> 
    </div>
  ';
 

 

?>


<!------------ start log    --------------->
<br>
<hr>
<br>
<h3>ประวัติการพิมพ์</h3>
<? 
$sql = "select * from log_ecert where hn = '".$_POST['hn']."' AND Type = 'CO' order by DatePrint desc";
$row = mysql_query($sql);      
$i=0;	
while($result = mysql_fetch_array($row)){ 

	echo "<font size=3>HN : ".$result["HN"]." | เวลาพิมพ์ : ".$result["DatePrint"]." | ผู้พิมพ์ : ".$result["UserPrint"]." | เอกสาร : ".$result["Desc_Type"]." | เลขที่เอกสาร : ".$result["Code_RowidVn"]." | [ <a href='Opd_Covid19_Medical_Cert_Show_Reprint.php?hn=".$hn."&vn=".$Runno_Vn."&doc_no=".$result["Code_RowidVn"]."' target=_blank> Re-Print </a>]</font><br>"; //
	$i++;
}//emd while
if($i==0){echo "::: ไม่มีข้อมูลการพิมพ์ :::";}
?>

<!------------  end log   --------------->

<?  }//end if empty['hn']  ?>

<h4 align="center" style="color:red">*** ระบบนี้มีการเก็บข้อมูลการพิมพ์เอกสาร ***</h4>


<br><br><br><br>
<hr>
<a href='Opd_Covid19_Medical_Cert_Report.php'>รายงานการพิมพ์เอกสาร ใบรับรองแพทย์ Covid-19</a>