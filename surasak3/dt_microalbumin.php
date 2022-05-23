<?php 
// require_once 'bootstrap.php';

$dbi = new mysqli('192.168.131.250','remoteuser','','smdb');

$sql = "select code,name from ptright";
$q = $dbi->query($sql);
$ptright_list = array();
while ($b = $q->fetch_assoc()) {
    $code = $b['code'];
    $ptright_list[$code] = iconv("TIS-620","UTF-8",$b['name']);;
}




// $sql = "select hn,ptname,dbbirt,ptright,dateN,l_microal from diabetes_clinic_history where dateN >= '2021-10-01' and dateN <= '2022-09-30'  ";
$sql = "select hn,ptname,dbbirt,ptright,dateN,l_microal from diabetes_clinic_history where dateN >= '2020-10-01' and dateN <= '2021-09-30' ";
?>
<style>
    *{
        font-family: "TH SarabunPSK";
    }
    td{
        font-size: 16px;
    }
    .chk_table{
            border-collapse: collapse;
        }
        .chk_table th,
        .chk_table td{
            padding: 3px;
            border: 1px solid black;
        }
</style>
<table class="chk_table">
    <tr>
        <th>#</th>
        <th>วันที่มารับบริการ</th>
        <th>HN</th>
        <th>ชื่อ-สกุล</th>
        <th>อายุ</th>
        <th>สิทธิ</th>
        <th></th>
    </tr>
    <?php
    $q = $dbi->query($sql);
    $i=1;
    while ($a = $q->fetch_assoc()) { 

        if(empty($a['hn']))
        {
            continue;
        }

        $age = '-';
        if(!empty($a['dbbirt']))
        {
            list($dbY,$dbM,$dbD) = explode('-', $a['dbbirt']);
            $dBirth = ($dbY-543).'-'.$dbM.'-'.$dbD;
            
            $dateBirth=date_create($dBirth);
            $dateService=date_create($a['dateN']);
            $diff=date_diff($dateBirth,$dateService);
            $age = $diff->format("%Y ปี");
        }

        $ptright = substr($a['ptright'],0,3);
        // if(!empty($a['ptright']) && $a['ptright']!=='-')
        // {
        //     $ptright = iconv("TIS-620","UTF-8",$a['ptright']);
        // }

        // var_dump(substr($a['ptright'],0,3));

        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$a['dateN'];?></td>
            <td><?=$a['hn'];?></td>
            <td><?=iconv("TIS-620","UTF-8",$a['ptname']);?></td>
            <td><?=$age;?></td>
            <td><?=$ptright_list[$ptright];?></td>
            <td><?=$a['l_microal'];?></td>
        </tr>
        <?php 
        $i++;
    }
    ?>
</table>