<?php 
session_start();

if($_SESSION['smenucode'] !== 'ADM' && $_SESSION['smenucode'] !== 'ADM43FILE' && $_SESSION['smenucode'] !== 'ADMOPD')
{
    echo '͹حҵ੾�����˹�ҷ����ͧ����¹��ҹ��';
    exit;
}
include_once '../includes/config.php';
include_once 'head.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
if ($dbi->connect_error) {
    die("Connection failed: " . $dbi->connect_error);
}
?>
<div class="clearfix">
    <h1 style="margin:0;">��§ҹ��� PERSON</h1> <span>�����ŷ���仢ͧ��ЪҪ��ࢵ�Ѻ�Դ�ͺ ��м���������ԡ��</span>
</div>
<fieldset>
    <legend>����</legend>
    <form action="reportPerson.php" method="post">
        <!--
        <div>
            HN <input type="text" name="hn" id="hn">
        </div>
        -->
        <?php 
        $default_year = (empty($_POST['year_selected'])) ? date('Y') : $_POST['year_selected'] ;
        $year_range = range(2014, date('Y'));
        ?>
        <div>
            ���͡�� <select name="year_selected" id="year_selected">
            <?php 
            foreach ($year_range as $key => $year_item) { 
                $selected = ($year_item == $default_year) ? 'selected="selected"' : '' ;
                ?><option value="<?=$year_item;?>" <?=$selected;?>><?=$year_item+543;?></option><?php
            } 
            ?>
            </select>
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="view" value="search">
        </div>
    </form>
</fieldset>
<?php 
$view = $_POST['view'];
if ( $view === 'search' ) { 
    ?>
    <table class="chk_table">
        <tr>
            <th>����˹��º�ԡ��</th>
            <th>�Ţ���ѵû�ЪҪ�</th>
            <th>����¹�ؤ��</th>
            <th>���ʺ�ҹ</th>
            <th>��ҹ��˹��</th>
            <th>����</th>
            <th>���ʡ��</th>
            <th>�Ţ�������¹͡ (HN)</th>
            <th>��</th>
            <th>�ѹ�Դ</th>
            <th>����ʶҹ�����</th>
            <th>�����Ҫվ(���)</th>
            <th>�����Ҫվ(����)</th>
            <th>�������ͪҵ�</th>
            <th>�����ѭ�ҵ�</th>
            <th>������ʹ�</th>
            <th>�����дѺ����֡��</th>
            <th>����ʶҹ�㹤�ͺ����</th>
            <th>���� CID ��ô�</th>
            <th>���� CID ��ô�</th>
            <th>���� CID �������</th>
            <th>����ʶҹ�㹪����</th>
            <th>�ѹ������������ࢵ��鹷�</th>
            <th>����ʶҹ�/���˵ء�è��˹���</th>
            <th>�ѹ�����˹���</th>
            <th>�����������ʹ</th>
            <th>�����������ʹ RH</th>
            <th>���ʤ����繤���ҧ����</th>
            <th>�Ţ��� passport</th>
            <th>����ʶҹкؤ��</th>
            <th>�ѹ��͹�շ���Ѻ��ا������</th>
            <th>�������Ѿ��</th>
            <th>�������Ѿ����Ͷ��</th>
        </tr>
        <tr>
            <th>HOSPCODE</th>
            <th>CID</th>
            <th>PID</th>
            <th>HID</th>
            <th>PRENAME</th>
            <th>NAME</th>
            <th>LNAME</th>
            <th>HN</th>
            <th>SEX</th>
            <th>BIRTH</th>
            <th>MSTATUS</th>
            <th>OCCUPATION_OLD</th>
            <th>OCCUPATION_NEW</th>
            <th>RACE</th>
            <th>NATION</th>
            <th>RELIGION</th>
            <th>EDUCATION</th>
            <th>FSTATUS</th>
            <th>FATHER</th>
            <th>MOTHER</th>
            <th>COUPLE</th>
            <th>VSTATUS</th>
            <th>MOVEIN</th>
            <th>DISCHARGE</th>
            <th>DDISCHARGE</th>
            <th>ABOGROUP</th>
            <th>RHGROUP</th>
            <th>LABOR</th>
            <th>PASSPORT</th>
            <th>TYPEAREA</th>
            <th>D_UPDATE</th>
            <th>TELEPHONE</th>
            <th>MOBILE</th>
        </tr>
    <?php

    $year_selected = $_POST['year_selected'];

    $q_person = $dbi->query("SELECT `abbreviations` FROM `f43_person_1` ");
    $abbreviations_items = array();
    while ($per = $q_person->fetch_assoc()) {
        $abbreviations_items[] = $per['abbreviations'];
    }

    $sql = "SELECT a.*,b.*
    FROM ( 
        SELECT `row_id` AS `opcard_id`, `hn` AS `opcard_hn`, `idcard` AS `opcard_idcard`, `name` AS `opcard_name`, `surname` FROM `opcard` WHERE `regisdate` LIKE '$year_selected%' 
     ) AS a 
    LEFT JOIN `PERSON` AS b ON b.`PID` = a.`opcard_hn` 
    ORDER BY a.`opcard_id` ASC ";
    $q = $dbi->query($sql);
    while ($item = $q->fetch_assoc()) { 

        $color_noti = '';
        if(in_array($item['PRENAME'], $abbreviations_items) === false)
        {
            $color_noti = 'style="background-color: #ecff4f;" title="�ӹ�˹�Ҫ������ç�Ѻ�����Ţͧ��з�ǧ��Ҵ��"';
        }

        $color_row = empty($item['id']) ? 'style="background-color: #ff8383;"' : '' ;
        ?>
        <tr <?=$color_row;?> >
            <td><?=$item['HOSTPCODE'];?></td>
            <td>
                <?php 
                if(empty($item['CID']))
                {
                    echo $item['opcard_idcard'];
                }
                else
                {
                    echo $item['CID'];
                }
                ?>
            </td>
            <td>
                <?php 
                $show_pid = $item['PID'];
                if(empty($item['PID']))
                {
                    $show_pid =  $item['opcard_hn'];
                }
                ?>
                <a href="../opdedit.php?cHn=<?=$show_pid;?>" target="_blank" title="��䢢�����"><?=$show_pid;?></a>
            </td>
            <td><?=$item['HID'];?></td>
            <td <?=$color_noti;?> ><?=$item['PRENAME'];?></td>
            <td>
                <?php 
                if (empty($item['NAME'])) 
                {
                    echo $item['opcard_name'];
                }
                else
                {
                    echo $item['NAME'];
                }
                ?>
            </td>
            <td>
                <?php 
                if (empty($item['LNAME'])) 
                {
                    echo $item['surname'];
                }
                else
                {
                    echo $item['LNAME'];
                }
                ?>
            </td>
            <td><?=$item['HN'];?></td>
            <td><?=$item['SEX'];?></td>
            <td><?=$item['BIRTH'];?></td>
            <td><?=$item['MSTATUS'];?></td>
            <td><?=$item['OCCUPATION_OLD'];?></td>
            <td><?=$item['OCCUPATION_NEW'];?></td>
            <td><?=$item['RACE'];?></td>
            <td><?=$item['NATION'];?></td>
            <td><?=$item['RELIGION'];?></td>
            <td><?=$item['EDUCATION'];?></td>
            <td><?=$item['FSTATUS'];?></td>
            <td><?=$item['FATHER'];?></td>
            <td><?=$item['MOTHER'];?></td>
            <td><?=$item['COUPLE'];?></td>
            <td><?=$item['VSTATUS'];?></td>
            <td><?=$item['MOVEIN'];?></td>
            <td><?=$item['DISCHARGE'];?></td>
            <td><?=$item['DDISCHARGE'];?></td>
            <td><?=$item['ABOGROUP'];?></td>
            <td><?=$item['RHGROUP'];?></td>
            <td><?=$item['LABOR'];?></td>
            <td><?=$item['PASSPORT'];?></td>
            <td><?=$item['TYPEAREA'];?></td>
            <td><?=$item['D_UPDATE'];?></td>
            <td><?=$item['TELEPHONE'];?></td>
            <td><?=$item['MOBILE'];?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php

}