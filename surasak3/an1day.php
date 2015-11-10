<?php
session_start();
include 'includes/functions.php';
?>
<p>....................รายชื่อผู้ป่วยในทั้งหมด....................</p>
<?php
$appd = $appdate.'-'.$appmo.'-'.$thiyr;
$appd1 = $thiyr.'-'.$appmo.'-'.$appdate;
$today = "$yr-$m-$d";
?>
<style type="text/css">
@media print{
    .hide{display: none;}
}
table{width: 100%!important;}
table, tr, td, th{
    font-family: 'Angsana New';
    border: 1px solid #000000;
}
p{
    margin: 0;
}
</style>
<p>วันที่ <?php echo $appd;?> รายชื่อคนไข้เรียงตามลำดับเวลาก่อนหลัง</p>
<input type="button" onclick="history.back()" value="<< กลับไป" class="hide">
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
    <tr bgcolor="6495ED">
        <th>ลำดับ</th>
        <th>AN</th>
        <th>HN</th>
        <th>ชื่อ-สกุล</th>
        <th>อายุ</th>
        <th>สิทธิ</th>
        <th>หอผู้ป่วย</th>
        <th>วันนอน</th>
        <th>วันจำหน่าย</th>
        <th>โรค</th>
        <th>แพทย์</th>
    </tr>
    <?php
    $detail = "ค่ายา";
    include("connect.inc");
  
    $query = "SELECT date_format(date,'%d/ %m/ %Y %H:%i'),date_format(date,'%H:%i'),an,hn,ptname,age,ptright,bedcode,date_format(dcdate,'%d/ %m/ %Y %H:%i'),diag,doctor,dcdate FROM ipcard WHERE date LIKE '$appd1%' ";
    $result = mysql_query($query) or die("Query failed");
    $n=0;
    
    $notdc_count = 0;
    $ndc_lists = array();
    while (list ($datea,$timea,$an,$hn,$ptname,$age,$ptright,$bedcode,$dcdate,$diag,$doctor,$pdcdate) = mysql_fetch_row ($result)) {
        // $time = substr($thidate,11);
        
        $date = bc_to_ad($pdcdate);
        // var_dump(strtotime($date));
        if( preg_match('/(0000\-00\-00)/', $date) > 0 ){
            $notdc_count++;
            $ndc_lists[] = array($an, $hn, $ptname, $age, $ptright, $bedcode, $datea, $dcdate, $diag, $doctor);
        }
        
        $n++;
        ?>
        <tr bgcolor="66CDAA">
            <td><?php echo $n; ?></td>
            <td><?php echo $an; ?></td>
            <td><?php echo $hn; ?></td>
            <td><?php echo $ptname; ?></td>
            <td><?php echo $age; ?></td>
            <td><?php echo $ptright; ?></td>
            <td><?php echo $bedcode; ?></td>
            <td><?php echo $datea; ?></td>
            <td><?php echo $dcdate; ?></td>
            <td><?php echo $diag; ?></td>
            <td><?php echo $doctor; ?></td>
        </tr>
    <?php
    }
?>
</table>
<p>จำนวนที่ Admit ในเดือนนี้: <?php echo $n;?> ราย</p>
<p>จำนวนที่ Discharge ในเดือนนี้: <?php echo ($n - $notdc_count);?> ราย</p>
<p>จำนวนที่ยังไม่ได้ Discharge ในเดือนนี้: <?php echo $notdc_count;?> ราย</p>

<h3 style="page-break-before: always;">รายชื่อผู้ป่วยที่ยังไม่ได้ทำการ Discharge</h3>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
    <tr bgcolor="6495ED">
        <th>ลำดับ</th>
        <th>AN</th>
        <th>HN</th>
        <th>ชื่อ-สกุล</th>
        <th>อายุ</th>
        <th>สิทธิ</th>
        <th>หอผู้ป่วย</th>
        <th>วันนอน</th>
        <th>วันจำหน่าย</th>
        <th>โรค</th>
        <th>แพทย์</th>
    </tr>
    <?php 
    $n = 0;
    foreach($ndc_lists as $key => $item){
        list($an, $hn, $ptname, $age, $ptright, $bedcode, $datea, $dcdate, $diag, $doctor) = $item;
        // var_dump($hn);
        $n++;
        ?>
        <tr bgcolor="66CDAA">
            <td><?php echo $n; ?></td>
            <td><?php echo $an; ?></td>
            <td><?php echo $hn; ?></td>
            <td><?php echo $ptname; ?></td>
            <td><?php echo $age; ?></td>
            <td><?php echo $ptright; ?></td>
            <td><?php echo $bedcode; ?></td>
            <td><?php echo $datea; ?></td>
            <td><?php echo $dcdate; ?></td>
            <td><?php echo $diag; ?></td>
            <td><?php echo $doctor; ?></td>
        </tr>
        <?php
    }
    ?>
</table>