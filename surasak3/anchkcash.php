<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบหมายเลข  AN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="an" size="12" id="aLink" ></p>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>

  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>ชื่อ-สกุล</th>
  <th bgcolor=CD853F>สิทธิ</th>
  <th bgcolor=CD853F>รับป่วย</th>
  <th bgcolor=CD853F>จำหน่าย</th>
  <th bgcolor=CD853F>โรค</th>
  <th bgcolor=CD853F>แพทย์</th>
  <th bgcolor=CD853F>เตียง</th>
  <th bgcolor=CD853F>ใบข้อมูลเจ็บป่วย</th>
  <th bgcolor=CD853F>สถานะ</th>
 
 </tr>

<?php
If (!empty($an)){
    include("connect.inc");
    global $hn;
    $query = "SELECT an,hn,ptname,ptright,date,dcdate,diag,doctor,bedcode,status_log FROM ipcard WHERE an = '$an'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($an,$hn,$ptname,$ptright,$date,$dcdate,$diag,$doctor,$bedcode,$status_log) = mysql_fetch_row ($result)) {
       

	    print "<tr>";
        print   "  <td BGCOLOR=F5DEB3>$an</a></td>";
        print   "  <td BGCOLOR=F5DEB3>$hn</td>";
   	    print      "  <td BGCOLOR=F5DEB3>$ptname</td>";
        print    "  <td BGCOLOR=F5DEB3>$ptright</a></td>";
        print     "  <td BGCOLOR=F5DEB3>$date</a></td>";
        print      "  <td BGCOLOR=F5DEB3>$dcdate</td>";
        print      "  <td BGCOLOR=F5DEB3>$diag</td>";
        print     "  <td BGCOLOR=F5DEB3>$doctor</td>";
        print    "  <td BGCOLOR=F5DEB3>$bedcode</td>";
    	print	  "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"insertanchkcash.php?Can=$an&Chn=$hn&Cdate=$date\">พิมพ์</td>";
 	    print	  "  <td BGCOLOR=F5DEB3>";  
		 
          if($status_log=='จำหน่าย'){
		  ?>
        <a href="JavaScript:if(confirm('ยืนยันการปลดล๊อค')==true){ window.location='anchkcash.php?Can=<?=$an;?>&do=update';}">ปลดล๊อคผู้ป่วย</a>
           <? 
	   }else{
		  print "ปลดล๊อคผู้ป่วย";
	   }
       
		echo   "</td>";
        echo   " </tr>";
		
			     /// ตรวจสอบว่า ผป.มียอดค้างชำระหรือไม่
  
  	$strsql="select * from accrued where hn='".$hn."' and status_pay='n' ";
	$strresult = mysql_query($strsql);
	$strrow=mysql_num_rows($strresult);


	if($strrow>0){
		echo "<script>alert('ผู้ป่วยมียอดค้างชำระ กรุณาตรวจสอบ') </script>";
		echo "<br><br>&nbsp;&nbsp;&nbsp<b><font style='font-weight:bold'><a target=BLANK  href='accrued_list.php?hn=$hn'>ดูยอดค้างชำระ</a></b></font>";

	}
		
       }
	
	   
include("unconnect.inc");
       }
?>

</table>


<?
if($_REQUEST['do']=='update'){
	include("connect.inc");
	
	$update="UPDATE ipcard set status_log='' WHERE an='".$_REQUEST['Can']."'";
	$result1=mysql_query($update);
	
	if($result1){
		echo  "ปลดล๊อคผู้ป่วยเรียบร้อยแล้ว";
		echo  "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=anchkcash.php'>";	
	}
		
		include("unconnect.inc");
}
?>
