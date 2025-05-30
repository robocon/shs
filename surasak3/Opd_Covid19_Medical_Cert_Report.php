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
<title>รายงานใบรับรองแพทย์ Covid-19</title>

<p align="center" style="margin-top: 20px;"><strong><u>รายงาน ใบรับรองแพทย์ Covid-19</u></strong></p>

 

<? 
if(empty($_POST['day1'])){

  echo '
  <div align="center">
  <form method="POST" action="Opd_Covid19_Medical_Cert_Report.php" >
  </p>
  <strong>ตั้งแต่วันที่ : </strong><select size="1" name="day1" class="txt">
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
  echo '<select>';
  echo '&nbsp;&nbsp;&nbsp;';

echo '
  <strong>ถึงวันที่ : </strong><select size="1" name="day2" class="txt">
  <option value="'.$tmp_d.'">'.$tmp_d.'</option>
 ';
 $number = 1;  
 for($i=01;$i<=31;$i++){
   echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
 }//end for
 
 
 echo '
 </select>
 <strong>เดือน : </strong><select size="1" name="month2" class="txt"> 
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

   
  echo '<strong>ปี : </strong><select name="year2"  class="txt">';
  echo '<option value="'.$tmp_y.'">'.$tmp_y.'</option>';
  echo '<option value="2565">2565</option>';
  echo '<option value="2566">2566</option>';
  echo '<select>';
  echo '&nbsp;&nbsp;&nbsp;';


  
  echo '       <input type="submit" value="ค้นหา" name="B1"  class="txt" />
  </form> 
  </div>
  ';

}else{
/*
  $day1 = $_POST['day1'];
  $month1 = $_POST['month1'];
  $year1 = $_POST['year1'];
  $day2 = $_POST['day2'];
  $month2 = $_POST['month2'];
  $year2 = $_POST['year2'];
*/

 
 
  $day1 = $_POST['day1'];
  $month1 = $_POST['month1'];
  $year1_th = $_POST['year1'];
  $year1_eng = $_POST['year1']-543;

  $day2 = $_POST['day2'];
  $month2 = $_POST['month2'];
  $year2_th = $_POST['year2'];
  $year2_eng = $_POST['year2']-543;

 









  
  //-----> sql
  $sql = "SELECT * FROM log_ecert INNER JOIN opselfisolation_detail 
  ON log_ecert.hn = opselfisolation_detail.hn 
  WHERE registerdate >= '".$year1_eng."-".$month1."-".$day1."' AND registerdate <= '".$year2_eng."-".$month2."-".$day2."'  ";

  $query = mysql_query($sql); 
  $num = mysql_num_rows($query);

  if(empty($num)){
    echo "<h1 align='center'>ไม่พบข้อมูล</h1>";echo "<br>".exit();
  }//end if

  echo "[ <a href='Opd_Covid19_Medical_Cert_Report.php'>ย้อนกลับ</a> ]";
  echo "<table border='1' style='border: 1px solid black;border-collapse: collapse;'>";
  echo "<tr style='background-color: #33FFF3;'>";
  echo "<td>ลำดับ</td>"; 
  echo "<td>HN</td>";
  echo "<td>VN</td>";
  echo "<td>วันที่รับบริการ</td>";  
  echo "<td>วันที่เริ่มมีอาการ</td>"; 
  echo "<td>วันที่สิ้นสุดกักตัว</td>"; 
  echo "<td>ชื่อผู้ป่วย</td>"; 
  echo "<td>อายุ</td>";
  echo "<td>เพศ</td>";
  echo "<td>สิทธิ</td>"; 
  echo "<td>เลขบัตรประชาชน</td>";
  echo "<td>ที่อยู่</td>";
  echo "<td>เบอร์โทรศัพท์</td>";
  echo "<td>แพทย์</td>";
  echo "<td>ประเภทผู้ป่วย</td>";
  echo "<td>เลขที่ใบรับรองแพทย์</td>";
  echo "<td>ผู้พิมพ์เอกสาร</td>";
  echo "<td>วันที่เวลาพิมพ์</td>";
  echo "<td>Re-Print</td>"; 
  echo "</tr>";
  
 
  $count = 0;
  while($rows = mysql_fetch_array($query)){
    $count++;
    $registerdate = $rows["registerdate"]; 
    $registerdate_y = substr($rows["registerdate"],0,4)+543;
    $registerdate_m = substr($rows["registerdate"],5,2);
    $registerdate_d = substr($rows["registerdate"],8,2);
      $registerdate = $registerdate_d."/".$registerdate_m."/".$registerdate_y;

    $hn = $rows["hn"];
    $vn = $rows["vn"];
    $symptom_date_y = substr($rows["symptom_date"],0,4)+543;
    $symptom_date_m = substr($rows["symptom_date"],5,2);
    $symptom_date_d = substr($rows["symptom_date"],8,2);
      $symptom_date = $symptom_date_d."/".$symptom_date_m."/".$symptom_date_y; 

    $dcdate = $rows["dcdate"]; 
    $dcdate_y = substr($rows["dcdate"],0,4)+543;
    $dcdate_m = substr($rows["dcdate"],5,2);
    $dcdate_d = substr($rows["dcdate"],8,2);
      $dcdate = $dcdate_d."/".$dcdate_m."/".$dcdate_y;
    $ptname = $rows["ptname"]; 
    $age = $rows["age"]; 
    $sex = $rows["sex"]; 
    $ptright = $rows["ptright"]; 
    $idcard = $rows["idcard"]; 
    $address = $rows["address"];
    $phone = $rows["phone"]; 
    $doctor = $rows["doctor"]; 
    $phone = $rows["phone"]; 
    $typeservice = $rows["typeservice"]; 
    $phone = $rows["phone"];  
    $Code_RowidVn = $rows["Code_RowidVn"]; 
    $UserPrint = $rows["UserPrint"]; 
    $DatePrint = $rows["DatePrint"];
    $Reprint = $rows["Flag_Reprint"]; 
    /////////////////////////
 
  echo "<tr>";
  echo "<td>".$count."</td>"; 
  echo "<td>".$hn."</td>";
  echo "<td>".$vn."</td>";
  echo "<td>".$registerdate."</td>";  
  echo "<td>".$symptom_date."</td>"; 
  echo "<td>".$dcdate."</td>"; 
  echo "<td>".$ptname."</td>"; 
  echo "<td>".$age."</td>";
  echo "<td>".$sex."</td>";
  echo "<td>".$ptright."</td>"; 
  echo "<td>".$idcard."</td>";
  echo "<td>".$address."</td>";
  echo "<td>".$phone."</td>";
  echo "<td>".$doctor."</td>";
  echo "<td>".$typeservice."</td>";
  echo "<td>".$Code_RowidVn."</td>";
  echo "<td>".$UserPrint."</td>";
  echo "<td>".$DatePrint."</td>";
  echo "<td>".$Reprint."</td>"; 
  echo "</tr>";

  }//end while

  echo "</table>";
  
?>


 

<?  }//end if empty['hn']  ?> 