<?PHP
session_start();
set_time_limit(30);
include("connect.inc");

function getAge($birthday) {
$then = strtotime($birthday);
return(floor((time()-$then)/31556926));
}

//------รับค่าที่ถูกส่งมาในตัวแปร------//
$gethn=$_GET["hn"];  
$getlabnumber=$_GET["labnumber"];
$getlistlab=$_GET["listlab"];
$getdepart=$_GET["depart"];
$getdoctor=$_GET["doctor"];
if(isset($_GET["lab_date"])){
	$date_now = $_GET["lab_date"];  // วันที่ที่ถูกส่งมากำหนดในตัวแปร $date_now
}else{
	$date_now = date("Y-m-d");   // ถ้าไม่มีค่าวันที่ ใช้เป็นวันที่ปัจจุบันกำหนดตัวแปร $date_now
}
//------------------------------------------//
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>พิมพ์ผล LAB</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <style type="text/css">
    /* CSS Rest */
    /* http://meyerweb.com/eric/tools/css/reset/
    v2.0 | 20110126
    License: none (public domain)
    */
    
    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup,
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }
    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section {
        display: block;
    }
    body {
        line-height: 1;
    }
    ol, ul {
        list-style: none;
    }
    blockquote, q {
        quotes: none;
    }
    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }


    /* Your Style */
    @font-face{
        font-family: 'THSarabunNew';
        src: url('fonts/webfont/THSarabunNew.eot');
        src: url('fonts/webfont/THSarabunNew.eot#iefix'),
        url('fonts/webfont/THSarabunNew.woff') format('embedded-opentype'),
        url('fonts/webfont/THSarabunNew.ttf') format('truetype'),
        url('fonts/webfont/THSarabunNew.svg#ludger_duvernayregular') format('svg');
        font-weight: normal;
        font-style: normal;
    }
    body{
        padding: 0;
    }
    strong, b, .style2{
        font-weight: bold;
    }
    td{
        vertical-align: top;
    }
    body, td, th{
        font-family: 'THSarabunNew', 'TH SarabunPSK';
        /*font-family: 'TH SarabunPSK', 'Angsana New';*/
        font-size: 1em;
    }
    .tb-header{
        border-bottom: solid 1px #000; 
        border-top: solid 1px #000;
    }
    .address{
        font-size: 0.8em;
        font-weight: bold;
    }
    .footer table td{
        font-size: 0.8em;
    }
    
    div.iBannerFix{  
        height:50px;  
        position:fixed;  
        left:0px;  
        bottom:0px;  
        background-color:#FFFFFF;  
        width:100%;  
        z-index: 99;  
    }  
    </style>
    
</head>
<body>
<?php
$sqlop = "select distinct(testgroupname) as newtestgroupname from resulthead where hn ='$gethn' AND labnumber = '$getlabnumber'";
$queryop = mysql_query($sqlop);
while($rowsop = mysql_fetch_array($queryop)){
    
	$chktestgroupname = $rowsop["newtestgroupname"];

    $sql = "Select date_format(orderdate,'%Y-%m-%d') as neworderdate,patientname,labnumber,sex,dob From resulthead where hn = '$hn' AND labnumber = '$getlabnumber' limit 0,1";
    
    $result = mysql_query($sql);
    $rows = mysql_fetch_array($result);
    $neworderdate =$rows["neworderdate"];
    $dateB=$rows["dob"]; // ตัวแปรเก็บวันเกิด
    ?>
    
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="30%" align="center"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></td>
            <td align="center"><strong>ใบรายงานผลทางห้องปฏิบัติการ</strong></td>
        </tr>
        <tr>
            <td align="center"><img src="images/surasak.jpg" width="65" height="65"></td>
            <td align="center">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="12%" align="right"><strong>Name :</strong></td>
                        <td width="22%" align="left"><?=$rows["patientname"];?></td>
                        <td width="9%" align="right"><strong>HN :</strong></td>
                        <td width="25%" align="left"><?=$gethn;?></td>
                        <td width="15%" align="right"><strong>Lab Number :</strong></td>
                        <td width="17%" align="left"><?=$getlabnumber;?></td>
                    </tr>
                    <tr>
                        <td height="24" align="right"><strong>Ward :</strong></td>
                        <td align="left"><?=$getdepart;?></td>
                        <td align="right"><strong>Test :</strong></td>
                        <td colspan="3" align="left"><?=$getlistlab;?></td>
                    </tr>
                    <tr>
                        <td align="right"><strong>Age :</strong></td>
                        <td align="left"><?=getAge($dateB)." ปี";?></td>
                        <td align="right"><strong>Doctor :</strong></td>
                        <td align="left"><?=$getdoctor;?></td>
                        <td align="center">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center"><span class="address"><b>1 หมู่ 1 ต.พิชัย อ.เมือง จ.ลำปาง 52000 โทร 054-839305</b></span></td>
            <td align="left">&nbsp;</td>
        </tr>
    </table>

    <table width="100%" class="tb-header" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="32%" align="center"><strong>Test</strong></td>
            <td width="28%"><strong>Result</strong></td>
            <td width="15%"><strong>Unit</strong></td>
            <td width="25%"><strong>Reference Range</strong></td>
        </tr>
    </table>
    <?php
    $sqlloop="select distinct(testgroupname) as newtestgroupname from resulthead where hn ='$gethn' AND labnumber = '$getlabnumber' and testgroupname='$chktestgroupname' ";
    $queryloop=mysql_query($sqlloop);
    while($rowsloop=mysql_fetch_array($queryloop)){
        $newtestgroupname=$rowsloop["newtestgroupname"];
        ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="5" align="left">
                    <strong><u><?=$newtestgroupname;?></u></strong>
                </td>
            </tr>
            <?php
            $sql1="select * from resulthead where hn ='$gethn' and labnumber = '$getlabnumber' and testgroupname='$newtestgroupname'";
            $result1= mysql_query($sql1);
            while($arr1 = mysql_fetch_assoc($result1)){
                $autonumber = $arr1["autonumber"];
                $sql2 = "select * from resultdetail where autonumber = '$autonumber' ";
                $result2= mysql_query($sql2);
                $i=0;
                while($arr2 = mysql_fetch_assoc($result2)){
                    if($arr2["flag"] != 'N'){
                        $bgcolor="#FFDDDD"; 
                    }else if($i%2==0){ //$bgcolor="#FFFFBB"; 
                        $bgcolor="#FFFFFF"; 
                    }else{
                        $bgcolor="#FFFFFF";
                    }
                ?> 
                <tr bgcolor="<?php echo $bgcolor;?>">
                    <td width="416"><font color="#000000">&nbsp;&nbsp;&nbsp;<?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo $arr2["labname"];?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></font></td>
                    <td align="left" width="248"><font><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo $arr2["result"];?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></font></td>
                    <td align="center" width="117"><font color="red"><B><?php if($arr2["flag"] != 'N'){  echo"[", $arr2["flag"],"]";};?></B></font></td>
                    <td align="left" width="195"><font><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo "". ($arr2["unit"] !=""?"".$arr2["unit"]."":"")."";?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></font></td>
                    <td align="left" width="325"><font><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php if($arr2["normalrange"] != ""){ echo "[",$arr2["normalrange"],"]" ;};?><?php if($arr2["flag"] != 'N'){ echo "</B>";}?></font></td>
                </tr>
                <?php
                }  // while result detail
            }  // while result head
        ?>
        </table>
        <?php
        // echo "<br />";
    }
    ?>
    <hr />
    <div class="footer">
        <?php
        $sql3="select * from resulthead inner join resultdetail on resulthead.autonumber=resultdetail.autonumber where resulthead.hn ='$gethn' and resulthead.labnumber = '$getlabnumber'";
        $result3= mysql_query($sql3);
        $arr3 = mysql_fetch_assoc($result3);
        ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="63%"><span><b>Reported by :</b><?=$arr3["releasename"];?>&nbsp;&nbsp;Authorize by : <?=$arr3["authorisename"];?></span></td>
                <td width="7%" align="right"><span>หมายเหตุ&nbsp;</span></td>
                <td width="30%"><span>L, H หมายถึง ค่าที่ต่ำหรือสูงกว่าค่าอ้างอิงในคน</span></td>
            </tr>
            <tr>
                <td><span><b>Date Authorise :</b><?=$arr3["authorisedate"];?> &nbsp;&nbsp;Date Printed : <?=date("Y-m-d H:i:s");?></span></td>
                <td align="right"><span></span></td>
                <td><span>LL, HH หมายถึง ค่าที่อยู่ในช่วงวิกฤต</span></td>
            </tr>
        </table>  
    </div>
    <div style="page-break-after: always"></div>
  
<?php
} // End while
?>  
</body>
</html>
