<?php
    session_start();
    include("connect.inc");

	function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

//    print "row_id=$sRow_id<br>";
//    print "$report<br>";
//update data in patdata
        $query ="UPDATE patdata SET copy = 'Y', report='".jschars($report)."'
                       WHERE row_id='$sRow_id' ";
        $result = mysql_query($query)
                       or die("Query failed,update patdata");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";
                       print "HN $sHn<br>";
	       if (!empty($sAn)){
	        	print "AN $sAn<br>";
			}
	       print "$sPtname<br>";
	       print "อายุ: $sAge<br>";
	       if (!empty($sPtright)){
		print "สิทธิการรักษา: $sPtright<br>";
			}
	//       print "ที่อยู่:$cAddress $cMuang<br>";
	       print "แพทย์: $sDoctor<br>";
                       print "การตรวจ: $sDetail<br>";
	       print "วันที่ตรวจ: $dDate<br>";
	       print "อ่านผล:-<br>";
	  //   print "$report<br>";
                       print"<textarea rows='13' name='S1' cols='65'>$report</textarea>";
   include("unconnect.inc");
?>
<div>
    <button onclick="force_print()">สั่ง Print</button>
</div>

<script type="text/javascript">
function force_print(){
    print();
}
</script>