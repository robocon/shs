<?php 
include '../bootstrap.php';

$db = Mysql::load();
$action = input('action');
if ( $action === 'delete' ) {
    
    $id = input_get('id');
    $del = $db->delete("DELETE FROM `43newborn` WHERE `id` = '$id' ");
    $msg = 'ź���������º����';

    if( $del !== true ){
        $msg = errorMsg('delete', $del['id']);
    }

    redirect('reportNewborn.php', $msg);
    exit;
}

include 'head.php';


?>
<div class="clearfix">
    <h1 style="margin:0;">��§ҹ NEWBORN</h1> <span>�����Ż���ѵԡ�ä�ʹ�ͧ��á�ҡ˭ԧ �ࢵ�Ѻ�Դ�ͺ ���ͷ�á����ʹ���˹��º�ԡ��</span>
</div>
<fieldset>
    <legend>���ҵ���ѹ��� Discharge</legend>
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
$view = input_post('view');
if ( $view === 'search' ) {
    
    $date = input_post('date');

    $sql = "SELECT a.*,b.`discharge`
    FROM `43newborn` AS a 
    LEFT JOIN `gyn_newborn` AS b ON a.`gyn_id` = b.`id` 
    WHERE `discharge` LIKE '$date%' 
    ORDER BY `id` DESC";
    $db->select($sql);
    if ( $db->get_rows() > 0 ) {
        
        $items = $db->get_items();
        ?>
        <div>&nbsp;</div>
        <table class="chk_table" width="200%">
            <tr>
                <th>HOSPCODE</th>
                <th>PID</th>
                <th>MPID</th>
                <th>GRAVIDA</th>
                <th>GA</th>
                <th>BDATE</th>
                <th>BTIME</th>
                <th>BPLACE</th>
                <th>BHOSP</th>
                <th>BIRTHNO</th>
                <th>BTYPE</th>
                <th>BDOCTOR</th>
                <th>BWEIGHT</th>
                <th>ASPHYXIA</th>
                <th>VITK</th>
                <th>TSH</th>
                <th>TSHRESULT</th>
                <th>D_UPDATE</th>
                <th>CID</th>
                <th>LENGTH</th>
                <th>HEADCIRCUM</th>
                <th rowspan="2">���</th>
            </tr>
            <tr>
                <th>����ʶҹ��ԡ��</th>
                <th>����¹�ؤ�� (��)</th>
                <th>����¹�ؤ�� (���)</th>
                <th>�������</th>
                <th>���ؤ��������ͤ�ʹ</th>
                <th>�ѹ����ʹ</th>
                <th>���ҷ���ʹ</th>
                <th>ʶҹ����ʹ</th>
                <th>����ʶҹ��Һ�ŷ���ʹ</th>
                <th>�ӴѺ���ͧ��á����ʹ</th>
                <th>�Ըա�ä�ʹ</th>
                <th>�������ͧ���Ҥ�ʹ</th>
                <th>����˹ѡ�á��ʹ(����)</th>
                <th>���ǡ�ó�Ҵ�͡��ਹ</th>
                <th>���Ѻ VIT K �������</th>
                <th>���Ѻ��õ�Ǩ TSH �������</th>
                <th>�š�õ�Ǩ TSH</th>
                <th>�ѹ��͹�շ���Ѻ��ا</th>
                <th>�Ţ���ѵû�ЪҪ�</th>
                <th>�������</th>
                <th>����ͺ�����</th>
            </tr>
            
        <?php
        foreach ($items as $key => $item) { 
            $id = $item['id'];
            ?>
            <tr>
                <td><?=$item['HOSPCODE'];?></td>
                <?php 
                $color_pid = (empty($item['PID'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_pid;?> ><?=$item['PID'];?></td>
                <td><?=$item['MPID'];?></td>
                <td><?=$item['GRAVIDA'];?></td>
                <?php 
                $color_ga = (empty($item['GA'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_ga;?>><?=$item['GA'];?></td>
                <?php 
                $color_bdate = (empty($item['BDATE'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_bdate;?> ><?=$item['BDATE'];?></td>
                <td><?=$item['BTIME'];?></td>
                <td><?=$item['BPLACE'];?></td>
                <td><?=$item['BHOSP'];?></td>
                <td><?=$item['BIRTHNO'];?></td>
                <td><?=$item['BTYPE'];?></td>
                <td><?=$item['BDOCTOR'];?></td>
                <?php 
                $color_bweight = (empty($item['BWEIGHT']) OR strlen($item['BWEIGHT']) < 4) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_bweight;?>><?=$item['BWEIGHT'];?></td>
                <?php 
                $color_asphyxia = (empty($item['ASPHYXIA'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_asphyxia;?> ><?=$item['ASPHYXIA'];?></td>
                <td><?=$item['VITK'];?></td>
                <td><?=$item['TSH'];?></td>
                <td><?=$item['TSHRESULT'];?></td>
                <td><?=$item['D_UPDATE'];?></td>
                <?php 
                $color_cid = (empty($item['CID']) OR $item['CID'] == '-') ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_cid;?>><?=$item['CID'];?></td>
                <?php 
                $color_length = (empty($item['LENGTH'])) ? 'class="warning"' : '' ;
                ?>
                <td <?=$color_length;?> ><?=$item['LENGTH'];?></td>
                <td><?=$item['HEADCIRCUM'];?></td>
                <td>
                    <a href="editFormNewborn.php?id=<?=$id;?>" target="_blank">���</a> | <a href="reportNewborn.php?action=delete&id=<?=$id;?>" onclick="return notiConfirm();">ź</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <script>
            function notiConfirm(){
                var c=confirm('�׹�ѹ����ź������');
                return c;
            }
        </script>
        <?php

    }else{
        ?>
        <p>��辺������</p>
        <?php
    }
    
}
include 'footer.php';