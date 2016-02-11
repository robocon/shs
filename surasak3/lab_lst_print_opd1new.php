<?PHP
session_start();
set_time_limit(30);
include("connect.inc");

function getAge($birthday) {
$then = strtotime($birthday);
return(floor((time()-$then)/31556926));
}

//------�Ѻ��ҷ��١����㹵����------//
$gethn=$_GET["hn"];  
$getlabnumber=$_GET["labnumber"];
$getlistlab=$_GET["listlab"];
$getdepart=$_GET["depart"];
$getdoctor=$_GET["doctor"];
if(isset($_GET["lab_date"])){
	$date_now = $_GET["lab_date"];  // �ѹ�����١���ҡ�˹�㹵���� $date_now
}else{
	$date_now = date("Y-m-d");   // �������դ���ѹ��� �����ѹ���Ѩ�غѹ��˹������ $date_now
}
//------------------------------------------//
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>������ LAB</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <style type="text/css">
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
    body,td,th {
        font-family: 'THSarabunNew', 'TH SarabunPSK';
        font-size: 18px;
    }
    
    .tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
    .tb_head2 {background-color: #0C5A2F; color:#B9F2F7; font-weight: bold; text-align:center;  }
    .tb_head3 {background-color:#FFFFFF; color:#000000; font-size:20px; font-weight: bold;font-family:"THSarabunNew"; text-align:center;  }
    .tb_head3_2 {background-color:0000A0; color:#FFFF00; font-size:25px; font-weight: bold;font-family:"THSarabunNew"; text-align:center; font-weight: bold;width: 200px; }
    .tb_head3_3 {background-color:#FFFFFF; color:#0000CC; font-size:25px; font-weight: bold;font-family:"THSarabunNew"; text-align:right;  }
    .tb_head3_1 {color:#990000; font-size:20px; font-family:"THSarabunNew";  height:15px;  }
    .tb_head4 {background-color: #99FFCC; color:#000099; font-size:25px;   font-family:"THSarabunNew";}
    .tb_head4_1 {background-color: #99FFCC; color:#FF0033; font-size:25px;  font-weight: bold; font-family:"THSarabunNew";}
    
    
    .tb_detail {background-color: #FFFFC1;  }
    .tb_menu {background-color: #FFFFC1;  }
    .style1 {font-size: 12px}
    
    div.iBannerFix{  
        height:50px;  
        position:fixed;  
        left:0px;  
        bottom:0px;  
        background-color:#FFFFFF;  
        width:100%;  
        z-index: 99;  
    }  
    .style2 {
        font-size: 14px;
        font-weight: bold;
    }
    .style3 {
        font-size: 14px;
    }
    @media print{
        body{
            font-size: 16px;
        }
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
    $dateB=$rows["dob"]; // ��������ѹ�Դ
    ?>
    <div style="page-break-after: always">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="28%" align="center"><strong>�ç��Һ�Ť�������ѡ��������</strong></td>
            <td align="center"><strong>���§ҹ�ŷҧ��ͧ��Ժѵԡ��</strong></td>
        </tr>
        <tr>
            <td align="center"><img src="images/surasak.jpg" width="72" height="72"></td>
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
                        <td align="left"><?=getAge($dateB)." ��";?></td>
                        <td align="right"><strong>Doctor :</strong></td>
                        <td align="left"><?=$getdoctor;?></td>
                        <td align="center">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center"><span class="style1">1 ���� 1 �.�Ԫ�� �.���ͧ �.�ӻҧ 52000 �� 054-839305</span></td>
            <td align="left">&nbsp;</td>
        </tr>
    </table>

    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: solid 1px #000; border-top:solid 1px #000;">
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
                    <strong style="font-size:14px;"><u><?=$newtestgroupname;?></u></strong>
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
    <div class="iBannerFix">
        <?php
        $sql3="select * from resulthead inner join resultdetail on resulthead.autonumber=resultdetail.autonumber where resulthead.hn ='$gethn' and resulthead.labnumber = '$getlabnumber'";
        $result3= mysql_query($sql3);
        $arr3 = mysql_fetch_assoc($result3);
        ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="67%"><span class="style2">Reported by : <?=$arr3["releasename"];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorize by : <?=$arr3["authorisename"];?></span></td>
                <td width="6%" align="right"><span class="style2">�����˵�&nbsp;</span></td>
                <td width="27%"><span class="style2">L, H ���¶֧ ��ҷ���������٧���Ҥ����ҧ�ԧ㹤�</span></td>
            </tr>
            <tr>
                <td><span class="style2">Date Authorise : <?=$arr3["authorisedate"];?> &nbsp;&nbsp;&nbsp;Date Printed : <?=date("Y-m-d H:i:s");?></span></td>
                <td align="right"><span class="style3"></span></td>
                <td><span class="style3"><strong>LL, HH ���¶֧ ��ҷ������㹪�ǧ�ԡĵ</strong></span></td>
            </tr>
        </table>  
    </div>
    <br/>
</div>  
<?
}
?>  
</body>
</html>
