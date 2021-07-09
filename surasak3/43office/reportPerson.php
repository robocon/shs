<?php 
session_start();

if($_SESSION['smenucode'] !== 'ADM' && $_SESSION['smenucode'] !== 'ADM43FILE' && $_SESSION['smenucode'] !== 'ADMOPD')
{
    echo '͹حҵ੾�����˹�ҷ����ͧ����¹��ҹ�� ����ѧ����� Login ����ö<a href="../login_page.php">��ԡ������</a>';
    exit;
}
include_once '../includes/config.php';
include_once 'head.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
if ($dbi->connect_error) {
    die("Connection failed: " . $dbi->connect_error);
}

// $dbi->query("SET NAMES TIS620");
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
        $year_range = range(2004, date('Y'));
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
            <input type="checkbox" name="show_error" id="show_error" value="show"><label for="show_error">�ʴ�੾�� Error</label>
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="view" value="search">
        </div>
    </form>
</fieldset>
<div>&nbsp;</div>
<?php 
$view = $_POST['view'];
if ( $view === 'search' ) { 
    ?>
    <table class="chk_table">
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
    <?php

    $year_selected = $_POST['year_selected'];

    $q_person = $dbi->query("SELECT `abbreviations` FROM `f43_person_1` ");
    $abbreviations_items = array();
    while ($per = $q_person->fetch_assoc()) {
        $abbreviations_items[] = $per['abbreviations'];
    }

    $year_selected = substr(($year_selected+543),2,2);

    $sql = "SELECT `row_id`,`hn`,`idcard`,`name`,`surname`, `dbirth` FROM `opcard` WHERE `hn` LIKE '$year_selected%' ORDER BY `row_id` ASC ";
    $q = $dbi->query($sql);
    while ($opcard = $q->fetch_assoc()) { 

        $id = $opcard['row_id'];
        $opcard_hn = $opcard['hn'];

        $item = array();
        $sql = "SELECT * FROM `PERSON` WHERE `HN` = '$opcard_hn' ";
        $q_person = $dbi->query($sql);
        if ($q_person->num_rows > 0) {
            $item = $q_person->fetch_assoc();
        }
        
        $error = false;
        if(empty($item['id']))
        {
            $error = true;
        }
        if(empty($item['CID']) OR strlen($item['CID']) < 13)
        {
            $error = true;
        }
        if(in_array($item['PRENAME'], $abbreviations_items) === false)
        {
            $error = true;
        }
        if($item['BIRTH'] === '-----' OR $item['BIRTH'] === '------' OR $item['BIRTH'] === '�.�.-��-��')
        {
            $error = true;
        }

        $item['CID'] = (empty($item['CID'])) ? $item['opcard_idcard'] : $item['CID'] ;
        $item['PID'] = empty($item['PID']) ? $item['opcard_hn'] : $item['PID'] ;
        $item['NAME'] = (empty($item['NAME'])) ? $item['opcard_name'] : $item['NAME'] ;
        $item['LNAME'] = (empty($item['LNAME'])) ? $item['surname'] : $item['LNAME'] ;

        if($error === false && $_POST['show_error'] === 'show')
        {
            continue;
        }

        $color_prename = '';
        if(in_array($item['PRENAME'], $abbreviations_items) === false)
        {
            $color_prename = 'style="background-color: #ecff4f;"';
        }

        // cid �繤����ҧ
        $cid_color = ( empty($item['CID']) OR strlen($item['CID']) < 13 ) ? 'style="background-color: #ecff4f;"' : '';

        // ������ opcard ���ѧ������ person ����ʴ��繾����ѧ��ᴧ
        $color_row = empty($item['id']) ? 'style="background-color: #ff8383;"' : '' ;

        ?>
        <tr <?=$color_row;?> >
            <td>
            <?php 
            echo $item['HOSTPCODE'];
            if(empty($item['HOSTPCODE']))
            {
                echo "�ѧ����բ��������� PERSON";
            }
            ?>
            </td>
            <td <?=$cid_color;?> >
                <?=$item['CID'];?>
            </td>
            <td>
                <?php 
                if(empty($item['PID']))
                {
                    $item['PID'] = $opcard_hn;
                }
                ?>
                <a href="../opdedit.php?cHn=<?=$item['PID'];?>" target="_blank" title="��䢢�����"><?=$item['PID'];?></a>
            </td>
            <td><?=$item['HID'];?></td>
            <td <?=$color_prename;?> ><?=$item['PRENAME'];?></td>
            <td>
                <?=$item['NAME'];?>
            </td>
            <td>
                <?=$item['LNAME'];?>
            </td>
            <td><?=$item['HN'];?></td>
            <td><?=$item['SEX'];?></td>
            
            <?php 
            $birth = $item['BIRTH'];
            $color_birth = '';
            if($birth === '-----' OR $birth === '------' OR $birth === '�.�.-��-��')
            {
                $color_birth = 'style="background-color: #ecff4f;"';
            }
            ?>
            <td <?=$color_birth;?>>
                <?=$birth;?>
            </td>
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

    } // ena while
    ?>
    </table>
    <?php

}