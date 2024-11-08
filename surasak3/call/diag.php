<?php 
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_diag.php';

$action = sprintf("%s", $_GET['action']);

/**
 * ถูกเรียกใช้งานจาก async function callYearDiag
 * แสดงรายการ diag โดยค้นหาจาก Hn จำนวน 5 รายการ
 */
if($action=='getFirstI10FromHn'){
    $diag = new Diag();
    $hn = sprintf("%s", $_GET['hn']);
    $res = $diag->getFirstI10FromHn($hn);
    ?>
    <div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
        <span style="flaot:left;">ICD10 I10</span> <strong><a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('getYearDiagContainer')">[ ปิด ]</a></strong>
    </div>
    <?php 
    if(empty($res['error_code']) && $res['error_code']!=='400'){
        if(count($res)>0){
        ?>
        <table class="loadDateTable">
            <tr>
                <th>วันที่ให้บริการ</th>
                <th>VN / AN</th>
                <th>แพทย์</th>
            </tr>
        <?php
        foreach ($res as $key => $v) {
            $shortDate = substr($v['svdate'],0,10);
            ?>
            <tr>
                <td><a href="javascript:void(0);" onclick="document.getElementById('diag_date').value = '<?=$shortDate;?>'; closeContainer('getYearDiagContainer');"><?=$v['svdate'];?></a></td>
                <td align="center"><?=$v['an'];?></td>
                <td><?=$v['office'];?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
        }
    }else{
        ?>
        <p><strong>ไม่พบข้อมูล</strong></p>
        <?php
    }
    exit;
}