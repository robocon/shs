<?php 
include '../bootstrap.php';
include 'libs/functions.php';
$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $FPTYPE = input_post('FPTYPE');
    $NOFPCAUSE = input_post('NOFPCAUSE');
    $TOTALSON = input_post('TOTALSON');
    $NUMBERSON = input_post('NUMBERSON');
    $ABORTION = input_post('ABORTION');
    $STILLBIRTH = input_post('STILLBIRTH');
    $D_UPDATE = date('YmdHis');
    $CID = input_post('CID');

    $sql = "INSERT INTO `43women` ( 
        `id`, `HOSPCODE`, `PID`, `FPTYPE`, `NOFPCAUSE`, `TOTALSON`, 
        `NUMBERSON`, `ABORTION`, `STILLBIRTH`, `D_UPDATE`, `CID` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$FPTYPE', '$NOFPCAUSE', '$TOTALSON', 
        '$NUMBERSON', '$ABORTION', '$STILLBIRTH', '$D_UPDATE', '$CID');";

    $save = $db->insert($sql);

    $msg = '�ѹ�֡���������º����';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    
    redirect('women.php', $msg);
    exit;


    exit;
}


include 'head.php';

?>
<div class="clearfix">
    <h1 style="margin:0;">WOMEN</h1> <span>������˭ԧ�����ԭ�ѹ���������Թ�Ѻ����</span>
</div>

<fieldset>
    <legend>��� : PRENATAL</legend>
    <form action="women.php" method="post">
        <table>
            <tr>
                <td>���ҵ�� HN : </td>
                <td><input type="text" name="hn" id=""></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">����</button>
                    <input type="hidden" name="page" value="search">
                </td>
            </tr>
        </table>
    </form>
</fieldset>

<?php 

$page = input_post('page');

if ($page === 'search') {
    
    $hn = input_post('hn');

    $sql = "SELECT *,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' ";
    $db->select($sql);
    $user = $db->get_item();

    ?>

    <form action="women.php" method="post">
        <fieldset>
            <legend>������ѹ�֡ WOMEN</legend>
            <table>
                <tr>
                    <td class="txtRight">����-ʡ�� : </td>
                    <td><?=$user['ptname'];?></td>
                </tr>
                <tr>
                    <td class="txtRight">����ʶҹ��ԡ�� : </td>
                    <td><input type="text" name="HOSPCODE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">����¹�ؤ�� : </td>
                    <td><input type="text" name="PID" value="<?=$user['hn'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">�Ţ���ѵ� : </td>
                    <td><input type="text" name="CID" value="<?=$user['idcard'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">�Ըդ�����Դ : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_fp_63_women_172`");
                        $labor182Lists = $db->get_items();
                        $i = 1;
                        foreach ($labor182Lists as $key => $item) {
                            ?>
                            <input type="radio" name="FPTYPE" id="fptype<?=$i;?>" value="<?=$item['code'];?>"><label for="fptype<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">���˵ط����������Դ : </td>
                    <td>
                        <?php 
                        $nofpcauseList = array(1 => '��ͧ����պص�','��ѹ�����ҵ�','��� �');
                        $i = 1;
                        foreach ($nofpcauseList as $key => $item) {
                            ?>
                            <input type="radio" name="NOFPCAUSE" id="nofpcause<?=$i;?>" value="<?=$key;?>"><label for="nofpcause<?=$i;?>"><?=$item;?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">�ص÷������������ : </td>
                    <td><input type="text" name="TOTALSON" value="0"></td>
                </tr>
                <tr>
                    <td class="txtRight">�ص÷���ժ��Ե : </td>
                    <td><input type="text" name="NUMBERSON" value="0"></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�駺ص� : </td>
                    <td><input type="text" name="ABORTION" value="0"></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ��á���㹤���� ���͵�¤�ʹ : </td>
                    <td><input type="text" name="STILLBIRTH" value="0"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit">�ѹ�֡</button>
                        <input type="hidden" name="action" value="save">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    <?php
}


include 'footer.php';