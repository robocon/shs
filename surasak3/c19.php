<?php 
include 'bootstrap.php';

$db = Mysql::load();

?>
<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;��Ѻ˹����ѡ �.�.</a>
</div>
<style>
    *{
        font-family: "TH Sarabun New", "TH SarabunPSK";
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
<form action="c19.php" method="post">
    <div>
        ���Ң����ż����� ARI Clinic
    </div>
    <div>
        <span>�ѹ��� : </span> <input type="text" name="dateSearch">
    </div>
    <div>������ҧ�� 2563-03</div>
    <div>
        <button type="submit">����</button>
        <input type="hidden" name="action" value="search">
    </div>
</form>
<?php 

$action = $_REQUEST['action'];
if ($action==='search')
{

    $dateTH = $_REQUEST['dateSearch'];
    
    $sql = "SELECT `row_id`, `thdatehn`, `hn`, `ptname`, `age`, SUBSTRING(`thidate`, 1, 10) AS `thDate`, `toborow`, 
    `ptright`, SUBSTRING(`ptright`, 1, 3) AS `ptrightCode` 
    FROM `opday2` 
    WHERE `thidate` LIKE '$dateTH%' 
    AND ( `borow` LIKE '%c19%' OR `toborow` LIKE 'EX50%' )";
    $db->select($sql);

    $items = $db->get_items();

    ?>
    <table class="chk_table">
        <tr style="text-align: center;">
            <th>#</th>
            <th>�ѹ���</th>
            <th>HN</th>
            <th>����-ʡ��</th>
            <th>����</th>
            <th>Ex</th>
            <th>ᾷ��</th>
            <th>�Է�ԡ���ѡ��</th>
        </tr>
    
    <?php
    $i = 1;

    $doctorList = array();
    $doctorNameList = array();

    $ptrightList = array();
    $ptrightNameList = array();
    foreach ($items as $key => $item)
    { 

        $opday2Thdatehn = $item['thdatehn'];

        $sqlOpd = "SELECT `row_id`, `doctor` FROM `opd` WHERE `thidate` LIKE '$dateTH%' AND `thdatehn` = '$opday2Thdatehn' ";
        $db->select($sqlOpd);
        $opd = $db->get_item();

        if(empty($opd))
        {
            $opd['doctor'] = "��辺�����ūѡ����ѵ�";
        }

        $key = substr($opd['doctor'],0,5);
        if(preg_match('/MD\d+/',$opd['doctor']) > 0)
        {
            $doctorList[$key][] = $item['hn'];
            $doctorNameList[$key] = $opd['doctor'];
        }

        $ptrightCode = $item['ptrightCode'];
        $ptrightList[$ptrightCode][] = $item['hn'];
        $ptrightNameList[$ptrightCode] = $item['ptright'];
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['thDate'];?></td>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['age'];?></td>
            <td><?=$item['toborow'];?></td>
            <td><?=$opd['doctor'];?></td>
            <td><?=$item['ptright'];?></td>
        </tr>
        <?php
        $i++;
    }
    ?>
    </table>
    <div>
        <p><b>ᾷ����Шӹǹ������</b></p>
        <table style="border: 0;">
        <?php 
        $i = 0;
        foreach ($doctorList as $key => $hnList)
        { 
            ++$i;
            $dtName = $doctorNameList[$key];
            ?>
            <tr>
                <td><?=$dtName;?></td>
                <td><?=count($hnList)." ���";?></td>
            </tr>
            <?php
        }
        ?>
        </table>
    </div>

    <div>
        <p><b>�Է�ԡ���ѡ��</b></p>
        <table style="border: 0;">
        <?php 
        foreach ($ptrightNameList as $key => $value)
        {
            ?>
            <tr>
                <td><?=$value;?></td>
                <td><?=count($ptrightList[$key]);?></td>
            </tr>
            <?php
        }
        ?>
        </table>
    </div>
    <?php
}