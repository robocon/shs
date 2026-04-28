<?php
if (!defined('BASE_API')) {
    echo "Invalid Base Path";
    exit;
}
if($action==='bloodstock'){

    $classLab = new Lab();
    $group = sprintf("%s", $data['blood_group']);
    $stockList = $classLab->getBloodstockFromGroup($group);
    if($stockList!==false){
        ?>
        <table class="table">
            <tr>
                <th>Unit_Number</th>
                <th>Component</th>
                <th>Exp_Date</th>
                <th>Source</th>
                <th>Matching</th>
                <th>Blood_Group</th>
                <th>UserCreate</th>
            </tr>
        <?php
        foreach ($stockList as $key => $v) {
            ?>
            <tr>
                <td><a href="javascript:void(0);" onclick="doSelectUnit('<?= $v['Unit_Number']; ?>')"><?= $v['Unit_Number']; ?></a></td>
                <td><?= $v['Component']?></td>
                <td><?= $v['Exp_Date']?></td>
                <td><?= $v['Source']?></td>
                <td><?= $v['Matching']?></td>
                <td><?= $v['Blood_Group']?></td>
                <td><?= $v['UserCreate']?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }else{
        ?>
        <p><strong>ไม่พบข้อมูล</strong></p>
        <?php
    }

    exit;
}