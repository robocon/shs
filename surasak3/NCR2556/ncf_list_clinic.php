<?php 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>

<?php include 'menu.php'; ?>

<div><!-- InstanceBeginEditable name="detail" -->
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->

.form-search{
    display: inline;
    float: left;
}
</style>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('nonconf_date'));

};

</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<h1 class="forntsarabun" align="center">ใบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง <font color="#FF0000">เฉพาะ ที่ยังไม่ระบุระดับความรุนแรง</font></h1>

<table border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
    <tr class="forntsarabun">
        <th align="center" bgcolor="#99CC99" colspan="2">ค้นหาใบเหตุการณ์สำคัญ</th>
    </tr>
    <tr class="forntsarabun">
        <th align="center" bgcolor="#99CC99">ตามวันที่</th>
        <th align="center" bgcolor="#99CC99">ตามเลข NCR</th>
    </tr>
    <tr>
        <td>
            <form name="f1" class="form-search" action="ncf_list_clinic.php" method="post">
                <?php
                $months = array( 1 => 'ม.ค.','ก.พ.','มี.ค.','เม.ษ.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.',);
                
                $sql = "SELECT date_format(`nonconf_date`, '%Y') as `years` FROM `ncr2556` GROUP BY `years` ORDER BY `years` DESC";
                $q = mysql_query($sql);
                ?>
                <select id="year_select" name="set_year">
                    <option value="0" >เลือกปี</option>
                    <?php 
                    $default_year = isset($_POST['set_year']) ? $_POST['set_year'] : 0;
                    $i = 0;
                    while($item = mysql_fetch_assoc($q)){
                        $select = $default_year == $item['years'] ? 'selected="selected"' : '' ;
                        ?>
                        <option value="<?php echo $item['years'];?>" <?php echo $select;?>><?php echo $item['years'];?></option>
                        <?php
                    }
                    ?>
                </select>
                
                <select id="month_select" name="set_month">
                    <option value="0" >เลือกเดือน</option>
                    <?php 
                    $default_month = isset($_POST['set_month']) ? $_POST['set_month'] : 0 ;
                    foreach($months as $key => $month){
                        
                        $selected = ( $default_month == $key ) ? 'selected="selected"' : '' ;
                        ?>
                        <option value="<?php echo sprintf("%02d", $key);?>" <?php echo $selected;?> ><?php echo $month;?></option>
                        <?php
                    }
                    ?>
                </select>
                <div>
                    <button type="submit" class="forntsarabun">ค้นหา</button>
                </div>
                
            </form>
        </td>
        <td>
            <form name="f1" class="form-search" action="ncf_list_clinic.php" method="post">
                <span>เลข NCR: </span>
                <input type="text" name="ncr"  class="forntsarabun"/>
                <div>
                    <button type="submit" class="forntsarabun">ค้นหา</button>
                </div>
            </form>
        </td>
    </tr>
</table>

<br>
<?php
include("connect.inc");

$nonconf_date = '';
if( isset($_POST['set_year']) && $_POST['set_year'] != 0 ){
    $nonconf_date = $_POST['set_year'];
    
    if( isset($_POST['set_month']) && $_POST['set_month'] != 0 ){
        $nonconf_date .= '-'.$_POST['set_month'];
    }
}

if( $nonconf_date != '' ){

    $sql1="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time 
    FROM  ncr2556 
    WHERE nonconf_date like '$nonconf_date%' 
    AND risk2 !='1' 
    AND risk3 !='1' 
    AND clinic='' 
    ORDER BY until ASC, ncr ASC";

}else if($_POST['ncr']!=''){
	
    $sql1="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time 
    FROM  ncr2556 
    WHERE ncr='".$_POST['ncr']."' 
    AND risk2 !='1' 
    AND risk3 !='1' 
    AND clinic='' 
    ORDER BY until ASC, ncr ASC";

}else{
    $nonconf_date = date('Y')+543;
    $sql1="SELECT nonconf_id, ncr, until, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time 
    FROM  ncr2556 
    WHERE nonconf_date like '$nonconf_date%'  
    AND risk2 !='1' 
    AND risk3 !='1'	
    AND clinic='' 
    ORDER BY until ASC, ncr ASC";	
}

$query1 = mysql_query($sql1)or die (mysql_error());
$row = mysql_num_rows($query1);
if( $row === 0 ){
    echo '<h1 class="forntsarabun">ไม่พบข้อมูล</h1>';
    exit;
}
// print "<div><font class='forntsarabun' >สถิติผู้ป่วยในจำแนกตาม แพทย์ $_POST[doctor]  $ประจำ$day  $dateshow </font></div><br>";
?>
<table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
        <td width="5%" align="center">ลำดับ</td>
        <td width="35%" align="center">หน่วยงาน/ทีม</td>
        <td align="center">วันที่</td>
        <td align="center">เวลา</td>
        <td align="center">NCR </td>
        <?php
            if($_SESSION["statusncr"]=='admin'){
        ?>
        <td width="5%" align="center">แก้ไข</td>
        <td width="5%" align="center">ลบ</td>
        <?php } ?>
        <td width="5%" align="center">พิมพ์</td>
    </tr>
<?php
$i=0;
while($arr1=mysql_fetch_array($query1)){
    
    $sql="SELECT * FROM `departments` where code='".$arr1['until']."' and status='y' ";
    $query=mysql_query($sql)or die (mysql_error());
    $arr=mysql_fetch_array($query);
    
    $i++;
    if($i%2==0){
        $bg = "#CCCCCC";
    }else{
        $bg = "#FFFFFF";
    }
    ?>
    <tr bgcolor="<?=$bg;?>">
        <td align="center"><?=$i?></td>
        <td><?=$arr['name']?></td>
        <td><?=$arr1['date1'].($arr1['date2'])?></td>
        <td><?=$arr1['time']?></td>
        <td><?=$arr1['ncr']?></td>
        <?php
        if($_SESSION["statusncr"]=='admin'){
        ?>
        <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?=$arr1['nonconf_id'];?>" target="_blank">แก้ไข</a></td>
        <td align="center"><a href="javascript:if(confirm('ยืนยันการลบ NCR : <?=$arr1['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr1['nonconf_id']?>','','width=400,height=500')}">ลบ</a></td>
        <?php } ?>
        <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr1['nonconf_id'];?>" target="_blank">พิมพ์</a></td>
    </tr>
    <?php
}
?>
</table>
<?php

/*}else{
	echo "<font class=\"forntsarabun\">ไม่มีข้อมูลของ $_POST[doctor]  $day  $dateshow</font>";
}*/
?>
<!-- InstanceEndEditable -->

</div>
</body>
<!-- InstanceEnd -->
</html>