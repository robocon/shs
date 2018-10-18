<?php
    $Thaidate=date("d/m/").(date("Y")+543);
    print  "ราคายา/เวชภัณฑ์ที่ไม่ใช่ยา และอุปกรณ์การแพทย์ $Thaidate<br> ";
?>
<a target=_BLANK href="dgprigp.php">ยาเวชภัณฑ์ และอุปกรณ์การแพทย์ทั้งหมด</a>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="drugcode.php">รหัสยา ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="drugcode" size="10"></font>
	&nbsp;&nbsp;หรือค้นหา&nbsp;&nbsp;
    <select name="part" class="txt">
      <option value="">ยาทั้งหมด</option>
      <option value="e">ยา ED</option>
      <option value="n">ยา NED</option>
    </select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ตกลง     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ไปเมนู</a></font></p>
</form>
<?
if($part=="e"){
	$showised="ยา ED";
}else if($part=="n"){
	$showised="ยา NED";
}else{
	$showised="ยาทั้งหมด";
}
?>
<div align="center" style="margin-top: 20px;"><strong>ข้อมูลยา ประเภท<?=$showised;?></strong></div>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>
  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>    
  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>
  <th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>
 </tr>

<?php
    include("connect.inc");
    //runno  to find date established
    $query = "SELECT title,startday FROM runno WHERE title = 'RX1D'";
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

    $dStartday=$row->startday;
	
	if(empty($drugcode)){
		if($part=="e"){
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst WHERE part = 'DDL' AND drug_active='y'";
		}else if($part=="n"){
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst WHERE (part = 'DDY' || part='DDN')  AND drug_active='y'";
		}else{
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst WHERE part LIKE 'DD%' AND drug_active='y'";
		}
	}else{
		if($part=="e"){
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst WHERE drugcode LIKE '$drugcode%' AND part = 'DDL' AND drug_active='y'";
		}else if($part=="n"){
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst WHERE drugcode LIKE '$drugcode%' AND (part = 'DDY' || part='DDN') AND drug_active='y'";
		}else{
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE part LIKE 'DD%' AND drugcode LIKE '$drugcode%' AND drug_active='y'";
		}
	}
		  
	 //echo $query;
     $result = mysql_query($query)or die("Query failed");
//    print "รหัสยาเวชภัณฑ์และอุปกรณ์<br> ";
    print "<font face='Angsana New'>DDL =   ยาในบัญชียาหลักแห่งชาติ เบิกได้<br> ";
    print "<font face='Angsana New'>DDY =   ยานอกบัญชียาหลักแห่งชาติ เบิกได้<br> ";
    print "<font face='Angsana New'>DDN =   ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้<br> ";

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
?>

</table>

 