<?php 
include("connect.inc");

$sql = "SELECT * FROM `opcardchk` 
WHERE part = '�ͺ���Ǩ60' 
AND exam_no >= 601 
AND exam_no <= 750 
ORDER BY `row` ASC";
// var_dump($sql);
$query = mysql_query($sql)or die (mysql_error());
$i = 301;
while($arr=mysql_fetch_array($query)){
    
    $hn = $arr["HN"];
    $name = $arr["yot"].' '.$arr["name"].' '.$arr["surname"];
    $exam_no = $arr['exam_no'];

    $labno2 = "180211".$exam_no."01";

    print "<div style=\"page-break-after: always;\">";
    print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center>HN $hn ($exam_no)<br></font>";
    print "<font  style='line-height:23px;'  face='Angsana New' size='3'><center>$name<br></font>";
    print "<font  style='line-height:23px;'  face='Angsana New' size='4'><u><b>STOOL</u> </b></font></center>";
    print "</div>";

    print "<div style=\"page-break-after: always;\">";
    print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center>HN $hn ($exam_no)<br></font>";
    print "<font  style='line-height:23px;'  face='Angsana New' size='3'><center>$name<br></font>";
    print "<font  style='line-height:23px;'  face='Angsana New' size='3'>�繻�����Тͧ.......................................</font></center>";
    print "</div>";

    print "<div style=\"page-break-after: always;\">";
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center>HN $hn ($exam_no)<br></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='3'><center>$name<br></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='3'>B.............. P.............. S..............</font></center>";
    print "</div>";

    print "<div style=\"page-break-after: always;\">";
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center>HN $hn ($exam_no)<br></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='3'><center>$name<br></font>";
    print "</div>";

    print "<div style=\"page-break-after: always;\">";
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center>HN $hn ($exam_no)<br></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='3'><center>$name<br></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='4'><u><b>CHEM</u> </b></font></center>";
    print "</div>";

    print "<div style=\"page-break-after: always; vertical-align: top; text-align: center;\">";
    print "<font style='line-height: 20px;' face='Angsana New' size='5'>HN $hn ($exam_no)</font><br>";
    print "<font style='line-height: 20px;' face='Angsana New' size='3'>$name</font>";
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
    CloseWindowsInTime(2/*����������ԹҷչФ�Ѻ�ç�Ţ 5 */); 
</Script>