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
        <font size="5"  face="THSarabunPSK" color="#fb042d">
            <b>*** ข่าวสาร โรงพยาบาลค่ายสุรศักดิ์มนตรี  ***</b>
        </font>
    </center>
    
    <MARQUEE>
        <STRONG>
            <SPAN>
                <font size="1"  face="THSarabunPSK" color="#ffffff">
                    วิสัยทัศน์ :โรงพยาบาลทหารระดับทุติยะภูมิ 
                    ที่เป็นเลิศด้านการรักษาพยาบาล และส่งเสริมสุขภาพ ***** พันธกิจ : โรงพยาบาลค่ายสุรศักดิ์มนตรี 
                    มุ่งมั่นให้บริการรักษาพยาบาลที่มีคุณภาพ ตามมาตรฐานสากลด้วยความ 
                    ตระหนักและเคารพสิทธิผู้ป่วย และยึดมั่นในจริยธรรม 
                    เพื่อให้ผู้รับบริการและผู้ให้บริการมีสุขภาพดี 
                    รวมทั้งปรับปรุงประสิทธิผลอย่างต่อเนื่อง 
                    และปฏิบัติภารกิจที่ได้รับมอบหมายจากหน่วยเหนือ 
                    ******
                </font>
            </SPAN>
        </STRONG>
    </MARQUEE>
    
    <br>
    <center>************************************</center>
    <br>
    
    <?php
    include("connect.inc");
    echo "<font color=#00FFFF  face='THSarabunPSK' size='4'>
            **รายชื่อแพทย์ไม่ออกตรวจวันนี้ (".date("d-m-").(date("Y")+543).")**
            <br>";
    
    $sql = "select * from dr_offline where dateoffline = '".date("d-m-").(date("Y")+543)."'";
    $row = mysql_query($sql);
    while($result = mysql_fetch_array($row)){
        $arr = explode(" ",$result[2]);
        echo "แพทย์ ".$arr[1]." ".$arr[2]." , ";
    }
    echo "</font>";
    
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    // include("connect.inc");
    
    $today=(date("Y")+543).date("-m-d");
    
    print "<table>";
    
    $num = 'Y';
    $query = "SELECT  row,depart,new,datetime,file,date,numday FROM new  WHERE status ='$num' ORDER BY row DESC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($row,$depart,$new,$datetime,$file,$start,$end) = mysql_fetch_row ($result)) {
    
        if($today==$end){
            $query = "UPDATE  new SET status = 'N' WHERE  row = '$row' ";
            $result = mysql_query($query)or die("Query failed update new N");
        }
        
        ?>
        <tr>
            <td>
                <font face="THSarabunPSK" >
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height="15" src='new.gif' width="30">&nbsp;***&nbsp;
                    <?=$new;?>
                
                ***(<?=$depart;?>&nbsp;<?=$datetime;?>)&nbsp;(สิ้นสุด&nbsp;<?=$end;?>)&nbsp;*** 
                <?php 
                if($file){ 
                    echo "<a href='surasak3/file_news/$file' target='_blank'><font color='#FF00FF'>ดาวน์โหลดไฟล์</font></a>"; 
                } 
                ?>
                </font>
            </td>
        </tr>
        <?php
    }
    print "</table>";
    
    $last_day = date('Y-m-d', strtotime("-2 week"));
    $new_date = date('Y-m-d', strtotime("-1 week"));
    $sql = "SELECT * FROM `news` 
    WHERE `status` = 1
    AND `date_start` > '$last_day'
    ORDER BY `date_start` DESC;
    ";
    $q = mysql_query($sql);
    $rows = mysql_num_rows($q);
    if( $rows > 0 ){
    ?>
    <style type="text/css">
    .news-header{
        color: #00FFFF;
    }
    .news-contain a{
        text-decoration: none;
        color: #ffffff;
    }
    .news-contain a:hover{
        text-decoration: underline;
    }
    </style>
    <div class="news-contain">
        <h3 class="news-header">ข่าวประชาสัมพันธ์ บก. รพ.ค่าย</h3>
        <div>
            <?php
            
            ?>
            <ol>
                <?php
                while( $item = mysql_fetch_assoc($q) ){
                    ?>
                    <li class="news-link">
                        <a href="surasak3/news_detail.php?id=<?=$item['id'];?>"><?=$item['title'];?></a>
                        <?php
                        if( $new_date < $item['date_start'] ){
                            ?><img height="15" src="new.gif" width="30"><?php
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>
            </ol>
        </div>
    </div>
    <?php
    }
    
    include("surasak3/unconnect.inc");
?>
</body>
</html>