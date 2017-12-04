<?php
    include("connect.inc");

    $query = "SELECT * FROM ipcard WHERE an = '$cAn'";
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
   If ($result){
	  //$cDate=$row->date;	
        $cHn=$row->hn;
        $cAn= $row->an;
        $cPtname=$row->ptname;
       // $cPtright=$row->ptright;
      //  $cGoup=$row->goup;
       // $cCamp=$row->camp;
      //  $cDiag=$row->diag;
        $cIcd10=$row->icd10;
        $cComorbid=$row->comorbid;
        $cComplica=$row->complica;
	  $cOther=$row->other;
 	  $cExtcause=$row->extcause;
       // $cIcd9=$row->icd9cm;
      //  $cSecond=$row->second;
      //  $cResult=$row->result;
	 // $cDctype=$row->dctype; 
      //  $cDoctor=$row->doctor;
                  }  
   else {
      echo "ไม่พบ AN : $cAn";
           }    
 print "&nbsp;&nbsp;&nbsp;$cPtname,HN: $cHn, AN: $cAn<br>";
 print "&nbsp;&nbsp;&nbsp;<b>**ICD10**</b><br>";
  print "          principle:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>$cIcd10</b><br>";
  print "          comorbidity:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>$cComorbid</b><br>";
  print "          complication:&nbsp;&nbsp;&nbsp;&nbsp;<b>$cComplica</b><br>";
  print "          other:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>$cOther</b><br>";
  print "          external cause:&nbsp; &nbsp;&nbsp;&nbsp;<b>$cExtcause</b><br>";
?>
<table>
 <tr>
  <th bgcolor=CC9900><b>รหัส ICD9CM</th>
  <th bgcolor=CC9900>วันที่ทำหัตถการ</b></th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT icd9cm,icddate FROM ipicd9cm where an='$cAn' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($icd9cm, $icddate) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF>$icd9cm</a></td>\n".
           "  <td BGCOLOR=99CCFF>$icddate</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>

