<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>New Page 5</title>
<base target="_self">
<style type="text/css" media="screen">
    @font-face {
        font-family: THSarabunPSK;
        src: url("surasak3/THSarabun.eot")
        /*src: url("http://192.168.1.2/sm3/surasak3/THSarabun.eot")*/
        /* EOT file for IE */
    }
    @font-face {
        font-family: THSarabunPSK;
        src: url("surasak3/THSarabun.ttf") /* TTF file for CSS3 browsers */
    }
</style>
</head>
<body bgcolor="#008080"  text="#ffffff" >
    <center>
        <font size="5" face="THSarabunPSK" color="#fb042d"> <b>*** ข่าวสาร โรงพยาบาลค่ายสุรศักดิ์มนตรี  ***</font>
    </center>

    <MARQUEE>
        <STRONG>
            <SPAN>
                <font size="1" color="#ffffff" face="THSarabunPSK" > 
                    วิสัยทัศน์ :โรงพยาบาลทหารระดับทุติยะภูมิ 
                    ที่เป็นเลิศด้านการรักษาพยาบาล และส่งเสริมสุขภาพ ***** พันธกิจ : โรงพยาบาลค่ายสุรศักดิ์มนตรี 
                    มุ่งมั่นให้บริการรักษาพยาบาลที่มีคุณภาพ ตามมาตรฐานสากลด้วยความ 
                    ตระหนักและเคารพสิทธิผู้ป่วย และยึดมั่นในจริยธรรม 
                    เพื่อให้ผู้รับบริการและผู้ให้บริการมีสุขภาพดี 
                    รวมทั้งปรับปรุงประสิทธิผลอย่างต่อเนื่อง 
                    และปฏิบัติภารกิจที่ได้รับมอบหมายจากหน่วยเหนือ 
                    ******
                </FONT>
            </SPAN>
        </STRONG>
    </MARQUEE>

    <br><center>************************************</center><br>
    <?php
    include("connect.inc");
    $sql = "select * from dr_offline where dateoffline = '".date("d-m-").(date("Y")+543)."'";
    echo "<font color=#00FFFF  face='THSarabunPSK' size='4'>**รายชื่อแพทย์ไม่ออกตรวจวันนี้ (".date("d-m-").(date("Y")+543).")**<br>";
    $row = mysql_query($sql);
    while($result = mysql_fetch_array($row)){
        $arr = explode(" ",$result[2]);
        echo "แพทย์ ".$arr[1]." ".$arr[2]." , ";
    }
    echo "</font>";
    
    ?><table><?php
    
    $Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $today = (date("Y")+543).date("-m-d");
    
    $num = 'Y';
    $query = "SELECT  row,depart,new,datetime,file,date,numday FROM new  WHERE status ='$num' ORDER BY row DESC ";
    $result = mysql_query($query) or die("Query failed");
    while( list($row,$depart,$new,$datetime,$file,$start,$end) = mysql_fetch_row ($result)) {

        // ตั้งค่าสถานะเป็น N อัตโนมัติ ถ้าวันที่สิ้นสุดของข่าวตรงกับวันปัจจุบัน
        if($today == $end){
            $query = "UPDATE  new SET status = 'N' WHERE  row = '$row' ";
            $result = mysql_query($query) or die("Query failed update new N");
        }
        ?>
        <tr>
            <td BGCOLOR=F5DEB3><font face='THSarabunPSK'></b><br>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=15 src='new.gif' width=30>&nbsp;***&nbsp;<FONT SIZE='4' ><?=$new;?></FONT></td>
            <td BGCOLOR=F5DEB3><font face='THSarabunPSK'>***(<?=$depart;?></td>
            <td BGCOLOR=F5DEB3><font face='THSarabunPSK'>&nbsp;<?=$datetime;?>)&nbsp;(สิ้นสุด&nbsp;<?=$end;?>)&nbsp;*** <? if($file){ 		echo "<a href='surasak3/file_news/$file' target='_blank'><font color='#FF00FF'>ดาวน์โหลดไฟล์</font></a>"; } ?>
                <br>
            </td>
        </tr>
        <?php
    }
    ?></table><?php
    include("surasak3/unconnect.inc");
    ?>
</body>
</html>