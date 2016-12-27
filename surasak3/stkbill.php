<?php
    session_start();
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<font face='Angsana New'>วันที่  $d/$m/$yr&nbsp;&nbsp;เลขที่ใบเบิก&nbsp;&nbsp;".$_SESSION["cBillno"]."<br>";
    print "<font face='Angsana New'>รายการเบิกจากคลังยาใหญ่ไป $cDepcode<br>";
?>
<table>
 <tr>
  <th><font face='Angsana New'>#</th>
  <th><font face='Angsana New'>รหัส</th>
  <th><font face='Angsana New'>รายการ</th>
  <th><font face='Angsana New'>Exp.</th>
  <th><font face='Angsana New'>Lot.</th>
  <th><font face='Angsana New'>จำนวน</th>
  <th><font face='Angsana New'>เบิก</th>
  <th><font face='Angsana New'>หน่วย</th>

  <th ><font face='Angsana New'>เหลือสุทธิ</th>
  <th ><font face='Angsana New'>ในคลัง</th>
  <th ><font face='Angsana New'>ในห้องจ่าย</th>
 </tr>

<?php
   $no=0;
   for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $no++;
        print("<tr>\n".
                "<td><font face='Angsana New'>$no</td>\n".
                "<td><font face='Angsana New'>$aDgcode[$n]</td>\n".
                "<td><font face='Angsana New'>$aTrade[$n]</td>\n".
                "<td><font face='Angsana New'>$aExpdate[$n]</td>\n".
                "<td><font face='Angsana New'>$aLotno[$n]</td>\n".
                "<td><font face='Angsana New'>$aAmount[$n]</td>\n".  
                "<td><font face='Angsana New'>$aStkcut[$n]</td>\n".
                "<td><font face='Angsana New'>$aUnit[$n]</td>\n".  
                "<td><font face='Angsana New'>$aTotalstk[$n]</td>\n".  
                "<td><font face='Angsana New'>$aMainstk[$n]</td>\n".
                "<td><font face='Angsana New'>$aStock[$n]</td>\n".  
                " </tr>\n");
	        }  
	}
?>
</table>


