<?php 
include '../bootstrap.php';

include 'head.php';
?>
<fieldset>
    <legend>���ҵ���ѹ���ѹ�֡ ��á�á�Դ</legend>
    <form action="reportNewborn.php" method="post">
        <div>
            ���͡�ѹ��� <input type="text" name="date" id="date">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="view" value="search">
        </div>
    </form>
</fieldset>
<script type="text/javascript">
var popup1;
window.onload = function() {
    popup1 = new Epoch('popup1','popup',document.getElementById('date'),false);
};
</script>

<?php 
dump($_POST);
$view = input_post('view');
if ( $view === 'search' ) {
    
    $db = Mysql::load();

    $date = input_post('date');
    $date = bc_to_ad($date);
    $date = str_replace('-', '', $date);

    $sql = "SELECT * FROM `43newborn` WHERE `D_UPDATE` LIKE '$date%' ";
    dump($sql);
    $db->select($sql);
    if ( $db->get_rows() > 0 ) {
        
        $items = $db->get_items();
        ?>
        <div>&nbsp;</div>
        <table class="chk_table">
            <tr>
                <th class="warning">HOSPCODE</th>
                <th class="warning">PID</th>
                <th class="warning">MPID</th>
                <th>GRAVIDA</th>
                <th class="warning">GA</th>
                <th class="warning">BDATE</th>
                <th class="warning">BTIME</th>
                <th>BPLACE</th>
                <th>BHOSP</th>
                <th class="warning">BIRTHNO</th>
                <th>BTYPE</th>
                <th>BDOCTOR</th>
                <th class="warning">BWEIGHT</th>
                <th class="warning">ASPHYXIA</th>
                <th class="warning">VITK</th>
                <th class="warning">TSH</th>
                <th class="warning">TSHRESULT</th>
                <th class="warning">D_UPDATE</th>
                <td>��Ѻ��ا</td>
            </tr>
        <?php
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td class="warning"><?=$item['HOSPCODE'];?></td>
                <td class="warning"><?=$item['PID'];?></td>
                <td class="warning"><?=$item['MPID'];?></td>
                <td><?=$item['GRAVIDA'];?></td>
                <td class="warning"><?=$item['GA'];?></td>
                <td class="warning"><?=$item['BDATE'];?></td>
                <td class="warning"><?=$item['BTIME'];?></td>
                <td><?=$item['BPLACE'];?></td>
                <td><?=$item['BHOSP'];?></td>
                <td class="warning"><?=$item['BIRTHNO'];?></td>
                <td><?=$item['BTYPE'];?></td>
                <td><?=$item['BDOCTOR'];?></td>
                <td class="warning"><?=$item['BWEIGHT'];?></td>
                <td class="warning"><?=$item['ASPHYXIA'];?></td>
                <td class="warning"><?=$item['VITK'];?></td>
                <td class="warning"><?=$item['TSH'];?></td>
                <td class="warning"><?=$item['TSHRESULT'];?></td>
                <td class="warning"><?=$item['D_UPDATE'];?></td>
                <td><a href="javascript: void(0);">���</a></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php

    }else{
        ?>
        <p>��辺������</p>
        <?php
    }
    
}
include 'footer.php';