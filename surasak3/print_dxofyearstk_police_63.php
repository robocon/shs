<?php 
// include("connect.inc");

include 'bootstrap.php';

$sql = "SELECT * FROM `opcardchk` 
WHERE part LIKE 'สอบตำรวจ63%' 
#AND ( `pid` >= 333 AND `pid` <= 450 )
ORDER BY `row` ASC ";

$query = mysql_query($sql)or die (mysql_error());

while($arr=mysql_fetch_array($query)){
    
    $hn = $arr["HN"];
    $name = $arr["yot"].' '.$arr["name"].' '.$arr["surname"];
    $exam_no = $arr['exam_no'];

    $type = '01';

    $labno2 = $hn.$type;
    // $labno2 = "621213".$exam_no."02";


    // if( pare_match('/โปรแกรมอายุ>35ปี/', $arr['course']) > 0 ){
        // dump($arr['course']);
    // }

    // if( $arr[''] )

    for ($i=0; $i < 2; $i++) { 

        print "<div style=\"page-break-after: always;\">";
        print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center>HN $hn<br></font>";
        print "<font  style='line-height:23px;'  face='Angsana New' size='3'><center>$name<br></font>";
        print "<font  style='line-height:23px;'  face='Angsana New' size='4'><u><b>STOOL</u> </b></font></center>";
        print "</div>";

    }

    print "<div style=\"page-break-after: always;\">";
    print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center>HN $hn<br></font>";
    print "<font  style='line-height:23px;'  face='Angsana New' size='3'><center>$name<br></font>";
    print "<font  style='line-height:23px;'  face='Angsana New' size='3'>เป็นปัสสาวะของ.......................................</font></center>";
    print "</div>";


    // print "<div style=\"page-break-after: always;\">";
    // print "<font  style='line-height:23px;' face='Angsana New' size='5'><center>HN $hn<br></font>";
    // print "<font  style='line-height:23px;' face='Angsana New' size='3'><center>$name<br></font>";
    // print "<font  style='line-height:23px;' face='Angsana New' size='3'>B.............. P.............. S..............</font></center>";
    // print "</div>";

    print "<div style=\"page-break-after: always;\">";
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center>HN $hn<br></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='3'><center>$name<br></font>";
    print "</div>";

    print "<div style=\"page-break-after: always;\">";
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center>HN $hn<br></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='3'><center>$name<br></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='4'><u><b>CHEM</u> </b></font></center>";
    print "</div>";

    print "<div style=\"page-break-after: always; vertical-align: top; text-align: center;\">";
    // print "<font style='line-height: 20px;' face='Angsana New' size='5'>HN $hn ($exam_no)</font><br>";
    print "<font style='line-height: 20px;' face='Angsana New' size='3'>$name $hn</font>";
    print "<div style=''><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno2\"></span></div>";


    print "</div>";

    $i++;
}
?>
<script Language="JavaScript">
    function CloseWindowsInTime(t){
        t = t*1000;
        // setTimeout("window.close()",t);
    }
    // CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>