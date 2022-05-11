<? 
session_start();
include("connect.inc");
$officer = $_SESSION["sOfficer"];


?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 20px;
}


-->
</style>
<title>ใบรับรองแพทย์ Covid-19</title>
<div style="margin-left: 40px;">
<p align="center" style="margin-top: 20px;"><strong><u>ใบรับรองแพทย์ Covid-19</u></strong></p>

 

<? 
if(empty($_POST['hn'])){

  echo '
  <div align="center">
  <form method="POST" action="Opd_Covid19_Medical_Cert.php" >
  </p>
      <strong>HN : </strong> <input type="text" name="hn" id="hn">
  &nbsp;&nbsp;&nbsp;
  
         <input type="submit" value="ค้นหา" name="B1"  class="txt" />
  </form> 
  </div>
  ';

}else{

  $hn = $_POST['hn'];
  
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
$sql = "SELECT row_id, yot , name , doctorcode FROM doctor WHERE status = 'y' ";

$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
  echo "<h1 align='center'>ไม่พบข้อมูล</h1>";echo "<br>".exit();
}//end if


////////////////////////////////////////////////////////////////////

  echo '

    <div align="left">

    <a href="Opd_Covid19_Medical_Cert.php"><b>[ ย้อนกลับ ]</b></a>

    <form method="POST" action="Opd_Covid19_Medical_Cert_Show.php"  target="_blank">
    </p>
        <strong>HN : </strong> '.$hn.' 
        &nbsp;&nbsp;&nbsp;
        <strong>ชื่อ-นามสกุล : </strong> '.$Pt_Yot.' ' .$Pt_Name.' ' .$Pt_Surname.' 
        <br>
        <strong>ที่อยู่ : </strong> '.$Pt_Address.' ต.' .$Pt_Tambol.' อ.' .$Pt_Ampur.' จ.'.$Pt_Changwat.' 
        &nbsp;&nbsp;&nbsp;
        <br>
        <strong>หมายเลขบัตรประชาชน : </strong> '.$Pt_Idcard.' 
        &nbsp;&nbsp;&nbsp;
        <strong>เบอร์โทรศัพท์ : </strong> '.$Pt_Phone.' 

        <hr>
         <strong>วันที่ : </strong><select size="1" name="day1" class="txt">
        ';
        $number = 1;  
        for($i=01;$i<=31;$i++){
          echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
        }//end for
        
        
        echo '
        </select>
        <strong>เดือน : </strong><select size="1" name="month1" class="txt"> 
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
         echo '<option value="2565">2565</option>';
         echo '<select>';
    


        echo '
        <br>  
        <strong>ป่วยด้วยโรค : </strong> 
        <br>
        <textarea id="diagnosis" name="diagnosis" rows="4" cols="50" class="txt">ติดเชื้อเข้าข่ายโควิด - 19 (ATK positive)</textarea>
        <br>
        <strong>มีความเห็นว่า : </strong> 
        <br>
        <textarea id="comment" name="comment" rows="4" cols="50" class="txt">ได้มาตรวจจริง ให้รักษาแบบผู้ป่วยนอกและแยกกักตัว 10 วัน</textarea>
        <br>
        <strong>แพทย์ผู้ตรวจ : </strong><br>
        <select name="doctor" class="txt">
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
 

 
}//end if empty['hn']
?>
</div> 
 