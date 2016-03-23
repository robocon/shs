<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>New Page 5</title>
<base target="_self">
<style type="text/css">
    
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
    body, table td, p{
        font-size: 14px;
        font-weight: normal;
    }
    .news-contain a{
        color: #ffffff;
        text-decoration: none;
    }
    .news-contain a:hover{
        text-decoration: underline;
    }
    .news-header{
        color: #00FFFF;
    }
</style>
</head>
<body bgcolor="#008080"  text="#ffffff" >
    <center>
        <h3 style="color: #fb042d">*** ข่าวสาร โรงพยาบาลค่ายสุรศักดิ์มนตรี  ***</h3>
    </center>

    <marquee>
        <strong>
            <span>
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
            </span>
        </strong>
    </marquee>

    <br><center>************************************</center><br>
    <?php
    include("connect.inc");
    // mysql_query("SET NAMES tis620");
    
    echo "<font color=#00FFFF  face='THSarabunPSK' size='4'>**รายชื่อแพทย์ไม่ออกตรวจวันนี้ (".date("d-m-").(date("Y")+543).")**<br>";
    
    $sql = "select * from dr_offline where dateoffline = '".date("d-m-").(date("Y")+543)."'";
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
            <td>
                <p style="margin-bottom: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=15 src='new.gif' width=30> *** <?=$new;?> *** ( <?=$depart;?> <?=$datetime;?> ) <u>( สิ้นสุด <?=$end;?> )</u> *** 
                    <?php
                    if($file){
                        echo "<a href='surasak3/file_news/$file' target='_blank'><font color='#FF00FF'>ดาวน์โหลดไฟล์</font></a>"; 
                    }
                    ?>
                </p>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <div class="news-contain">
        <h3 class="news-header">ข่าวประชาสัมพันธ์</h3>
        <div>
            <ol>
                <li class="news-link">
                    <a href="surasak3/news_detail.php">ด่วนที่สุด ที่ 0421.3/ว 106 ลงวันที่ 2 มีนาคม 2559 เรื่องขอความร่วมมือใช้สายการบินไทยสมายล์แอร์เวย์ ในการเดินทางไปราชการภายในประเทศ</a> <img height="15" src="new.gif" width="30"> 
                </li>
                <li class="news-link">
                    <a href="surasak3/news_detail.php">ด่วนที่สุด ที่ กค 0421.5/ว 18 ลงวันที่ 14 มกราคม 2559 เรื่อง การจัดทำรายละเอียดประกอบการถอดแบบคำนวณราคากลางงานก่อสร้างที่เกี่ยวข้องกับค่าน้ำมันเพิ่มเติม</a> <img height="15" src="new.gif" width="30"> 
                </li>
            </ol>
        </div>
    </div>
    <?php
    include("surasak3/unconnect.inc");
    ?>
    
</body>
</html>