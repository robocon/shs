<?php

include 'bootstrap.php';
$db = Mysql::load();

$action = input_post('action');
if( $action === 'save' ){

    $hn = input_post('hn');
    $vn = input_post('vn');
    $prefix = input_post('yot');
    $name = input_post('name');
    $surname = input_post('surname');
    $idcard = input_post('idcard');
    $address = input_post('address');
    $date_chk = input_post('date_chk');
    $yearchk = get_year_checkup();
    $ear = input_post('ear');
    
    $eye = input_post('eye');
    $snell_eye = input_post('snell_eye');
    $cxr = input_post('cxr');
    $conclution = input_post('conclution');
    $suggestion = input_post('suggestion');
    $doctor = input_post('doctor');
    $officer = $_SESSION['sOfficer'];

    $sex = input_post('sex');
    $breast = '';
    if( $sex == "�" ){
        $breast = input_post('breast');
    }

    $curr_date = date('Y-m-d');
    $sql = "SELECT `id` FROM `chk_doctor` WHERE `date_chk` LIKE '$curr_date%' AND `hn` = '$hn' ";
    $db->select($sql);
    $rows = $db->get_rows();
    
    if ( $rows == 0 ) {
        
        $sql = "INSERT INTO `chk_doctor` (
            `id`, `hn`, `vn`, `prefix`, `name`, `surname`, 
            `idcard`, `address`, `date_chk`, `yearchk`, `ear`, `breast`, 
            `eye`, `snell_eye`, `cxr`, `conclution`, `suggestion`, `doctor`, 
            `officer`
        ) VALUES (
            NULL, '$hn', '$vn', '$prefix', '$name', '$surname', 
            '$idcard', '$address', NOW(), '$yearchk', '$ear', '$breast', 
            '$eye', '$snell_eye', '$cxr', '$conclution', '$suggestion', '$doctor', 
            '$officer'
        );";
        $save = $db->insert($sql);

    }else if( $rows > 0 ){

        $sql = "UPDATE `chk_doctor` SET 
        `ear` = '$ear', 
        `breast` = '$breast', 
        `eye` = '$eye', 
        `snell_eye` = '$snell_eye', 
        `cxr` = '$cxr', 
        `conclution` = '$conclution', 
        `suggestion` = '$suggestion',
        `doctor` = '$doctor' ; ";
        $save = $db->update($sql);

    }

    $msg = '�ѹ�֡���������º����';
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }

    redirect('chk_doctor_preprint.php?hn='.$hn.'&vn='.$vn.'&date='.$curr_date, $msg);
    exit;
}

include 'dt_menu.php';

session_unregister("list_bill");
session_register("list_bill");

$_SESSION['list_bill'] = '';
$vn = $_SESSION['vn_now']; //vn
$hn = $_SESSION['hn_now'];
$post_vn = 1;
$_SESSION['dt_doctor'] = $_SESSION['sOfficer'];

$date_now = date("Y-m-d H:i:s");
$date_hn = date('d-m-').( date('Y') + 543 ).$hn;

$sql = "SELECT a.*, 
b.`idcard`, b.`blood`,b.`yot`,b.`name`,b.`surname`,b.`address`,b.`tambol`,b.`ampur`,b.`changwat`,b.`sex`
FROM `opd` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`thdatehn` = '$date_hn' ";
$db->select($sql);
$opd = $db->get_item();

$cig_lists = array(0 => '����ٺ', 1 => '�ٺ', 2 => '���ٺ');
$cigok_lists = array(0 => '�����ҡ��ԡ', 1 => '��ҡ��ԡ');
$al_lists = array(0 => '������', 1 => '����', 2 => '�´���');
$drugreact_lists = array(0 => '�����', 1 => '��');

$type_lists = array('�Թ��','���ö��','�͹��','�ҵ�',);

?>
<style type="text/css">
table{
    border-collapse: collapse;
}
.chk_table{
    border-collapse: collapse;
    width: 100%;
    border: 2px solid #000000;
}
.chk_table .title{
    font-weight: bold;
    border-bottom: 2px solid #000000;
    background-color: #b9e3ae;
    text-align: center;
}

label{
    cursor: pointer;
}
.tb-title{
    font-weight: bold;
    text-align: right;
}
.tb-title:after{
    content: "\0020\003A\0020";
}
h1,h3,p{
    margin: 0;
    padding: 0;
}
</style>
<form action="chk_doctor.php" method="post">
    <h2 align="center">�ѹ�֡�ŵ�Ǩ�آ�Ҿ��Сѹ�ѧ��</h2>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>�����ż�����</h3></td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="10%" class="tb-title">����-ʡ��</td>
                        <td width="15%"><?=$opd['ptname'];?></td>
                        <td width="10%" class="tb-title">HN</td>
                        <td width="15%"><?=$opd['hn'];?></td>
                        <td width="10%" class="tb-title">VN</td>
                        <td width="15%"><?=$opd['vn'];?></td>
                        <td width="10%" class="tb-title">����</td>
                        <td width="15%"><?=$opd['age'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">�Ţ�ѵû�ЪҪ�</td>
                        <td><?=$opd['idcard'];?></td>
                        <td class="tb-title">���˹ѡ</td>
                        <td><?=$opd['weight'];?> ��.</td>
                        <td class="tb-title">��ǹ�٧</td>
                        <td><?=$opd['height'];?> ��.</td>
                        <td class="tb-title">BP</td>
                        <td><?=$opd['bp1'].'/'.$opd['bp2'];?> mmHg</td>
                    </tr>
                    <tr>
                        <td class="tb-title">T</td>
                        <td><?=$opd['temperature'];?> &#8451;</td>
                        <td class="tb-title">P</td>
                        <td><?=$opd['pause'];?> ����/�ҷ�</td>
                        <td class="tb-title">R</td>
                        <td><?=$opd['rate'];?> ����/�ҷ�</td>
                        <td class="tb-title">�������ʹ</td>
                        <td><?=$opd['blood'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">�ä��Шӵ��</td>
                        <td><?=$opd['congenital_disease'];?></td>
                        <td class="tb-title">�ٺ������</td>
                        <td>
                            <?php
                            $cig_code = $opd['cigarette'];
                            echo $cig_lists[$cig_code];

                            if( !empty($opd['cigarette']) ){
                                $cigok_code = $opd['cigok'];
                                echo ' ('.$cigok_lists[$cigok_code].')';
                            }
                            ?>
                        </td>
                        <td class="tb-title">��������</td>
                        <td>
                            <?php 
                            $al_code = $opd['alcohol'];
                            echo $al_lists[$al_code];
                            ?>
                        </td>
                        <td class="tb-title">����</td>
                        <td>
                            <?php 
                            $react_code = $opd['drugreact'];
                            echo $drugreact_lists[$react_code];
                            ?>
                        </td>
                    </tr>
                    <tr>
                    
                        <td class="tb-title">�ѡɳм�����</td>
                        <td><?=$opd['type'];?></td>
                        <td class="tb-title">�ҡ��</td>
                        <td><?=$opd['organ'];?></td>
                        <td class="tb-title">BMI</td>
                        <td>
                            <?php 
                            $ht = $opd["height"] / 100;
                            echo number_format(($_SESSION["weight"]/($ht*$ht)),2);
                            ?>
                        </td>
                        <td class=""></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>�����ŷҧ��ͧ��Ժѵԡ��</h3></td>
        </tr>
        <tr>
            <td valign="top" width="50%">
                <?php
                $curr_day = date('Y-m-d');

                $sql = "SELECT b.* 
                FROM `resulthead` AS a 
                    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
                WHERE a.`hn` = '$hn' 
                AND a.`clinicalinfo` LIKE '��Ǩ�آ�Ҿ%' 
                AND a.`profilecode` = 'CBC' 
                AND ( b.`labcode` = 'HB' OR b.`labcode` = 'HCT' OR b.`labcode` = 'WBC' 
                OR b.`labcode` = 'NEU' OR b.`labcode` = 'LYMP' OR b.`labcode` = 'MONO' 
                OR b.`labcode` = 'EOS' OR b.`labcode` = 'BASO' OR b.`labcode` = 'PLTC' 
                OR b.`labcode` = 'RBC' ) 
                AND a.`orderdate` LIKE '$curr_day%' 
                ORDER BY b.seq ASC";
                $db->select($sql);
                $cbc_items = $db->get_items();
                ?>
                <table width="100%">
                    <tr>
                        <td colspan="3" align="center"><b>CBC</b></td>
                    </tr>
                    <tr style="background-color: #e6e6e6;">
                        <td>��¡�õ�Ǩ</td>
                        <td>�ŵ�Ǩ</td>
                        <td>��һ���</td>
                    </tr>
                    <?php
                    $result_cbc = '';
                    foreach ($cbc_items as $key => $cbc) {
                        ?>
                        <tr>
                            <td><?=$cbc['labname'];?></td>
                            <td><?=$cbc['result'];?></td>
                            <td><?=$cbc['normalrange'];?></td>
                        </tr>
                        <?php
                        $result_cbc = $cbc['autonumber'];
                    }
                    ?>
                    
                </table>
            </td>
            <td valign="top">
                <?php
                $sql = "SELECT b.* 
                FROM `resulthead` AS a 
                    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
                WHERE a.`hn` = '$hn' 
                AND a.`clinicalinfo` LIKE '��Ǩ�آ�Ҿ%' 
                AND a.`profilecode` = 'UA' 
                AND ( b.`labcode` = 'SPGR' OR b.`labcode` = 'PHU' OR b.`labcode` = 'GLUU' 
                OR b.`labcode` = 'RBCU' OR b.`labcode` = 'WBCU' OR b.`labcode` = 'EPIU' 
                OR b.`labcode` = 'BLOODU' OR b.`labcode` = 'KETU' ) 
                AND a.`orderdate` LIKE '$curr_day%' ";
                $db->select($sql);
                $ua_items = $db->get_items();

                ?>
                <table  width="100%">
                    <tr>
                        <td colspan="3" align="center"><b>UA</b></td>
                    </tr>
                    <tr style="background-color: #e6e6e6;">
                        <td>��¡�õ�Ǩ</td>
                        <td>�ŵ�Ǩ</td>
                        <td>��һ���</td>
                    </tr>
                    <?php
                    $result_ua = '';
                    foreach ($ua_items as $key => $ua) {
                        ?>
                        <tr>
                            <td><?=$ua['labname'];?></td>
                            <td><?=$ua['result'];?></td>
                            <td><?=$ua['normalrange'];?></td>
                        </tr>
                        <?php
                        $result_ua = $ua['autonumber'];
                    }
                    ?>
                </table>
            </td>
        </tr>
        <?php

        $sql = "SELECT b.* 
        FROM `resulthead` AS a 
            RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
        WHERE a.`hn` = '$hn' 
        AND a.`clinicalinfo` LIKE '��Ǩ�آ�Ҿ%' 
        AND ( 
            b.`labcode` = 'GLU' 
            OR b.`labcode` = 'CREA' 
            OR b.`labcode` = 'CHOL' 
            OR b.`labcode` = 'HDL' 
            OR b.`labcode` = 'HBSAG'
        ) 
        AND a.`orderdate` LIKE '$curr_day%' ";

        $db->select($sql);
        $etc_rows = $db->get_rows();
        if( $etc_rows > 0 ){
            $etc_items = $db->get_items();
            ?>
            <tr>
                <td colspan="2">
                    <table width="50%">
                        <tr>
                            <td colspan="3" align="center"><b>��Ǩ����</b></td>
                        </tr>
                        <tr style="background-color: #e6e6e6;">
                            <td>��¡�õ�Ǩ</td>
                            <td>�ŵ�Ǩ</td>
                            <td>��һ���</td>
                        </tr>
                        <?php
                        foreach ($etc_items as $key => $etc) {
                            ?>
                            <tr>
                                <td><?=$etc['labname'];?></td>
                                <td><?=$etc['result'];?></td>
                                <td><?=$etc['normalrange'];?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>�������آ�Ҿ</h3></td>
        </tr>
        <tr>
            <td width="25%" class="tb-title">��äѴ��ͧ������Թ</td>
            <td>
                <label for="ear1"><input type="radio" name="ear" id="ear1" value="1"> ���� </label>
                <label for="ear2"><input type="radio" name="ear" id="ear2" value="0"> �Դ���� </label>
            </td>
        </tr>
        <?php
        if( $opd['sex'] == '�' ){
        ?>
        <tr>
            <td class="tb-title">��õ�Ǩ��ҹ���ᾷ��<br>���ͺؤ�ҡ��Ҹ�ó�آ</td>
            <td>
                <label for="breast1"><input type="radio" name="breast" id="breast1" value="1"> ���� </label>
                <label for="breast2"><input type="radio" name="breast" id="breast2" value="0"> �Դ���� </label>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td class="tb-title">��õ�Ǩ���¤������Ţͧ�ѡ��ᾷ��</td>
            <td>
                <label for="eye1"><input type="radio" name="eye" id="eye1" value="1"> ���� </label>
                <label for="eye2"><input type="radio" name="eye" id="eye2" value="0"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">��õ�Ǩ�Ҵ��� Snellen eye Chart</td>
            <td>
                <label for="snell_eye1"><input type="radio" name="snell_eye" id="snell_eye1" value="1"> ���� </label>
                <label for="snell_eye2"><input type="radio" name="snell_eye" id="snell_eye2" value="0"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">Chest X-ray <a href="http://pacssrsh/explore.asp?path=/All%20Patients/InternalPatientUID=58-2733" target="_blank">�ټš�õ�Ǩ</a> </td>
            <td>
                <label for="cxr1"><input type="radio" name="cxr" id="cxr1" value="1"> ���� </label>
                <label for="cxr2"><input type="radio" name="cxr" id="cxr2" value="0"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">��ػ�ŵ�Ǩ</td>
            <td>
                <label for="conclution1"><input type="radio" name="conclution" id="conclution1" value="1"> ���� </label>
                <label for="conclution2"><input type="radio" name="conclution" id="conclution2" value="0"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p class="tb-title" style="text-align: left;">���й��������㹡�ô����آ�Ҿ</p>
                <textarea name="suggestion" cols="60" rows="8" id="" placeholder="���ͺ��������´�������"></textarea>
            </td>
        </tr>
    </table>
    <br>
    <div align="center">
        <button type="submit">�ѹ�֡������</button>

        <input type="hidden" name="action" value="save">
        <input type="hidden" name="hn" value="<?=$hn;?>">
        <input type="hidden" name="vn" value="<?=$vn;?>">
        <input type="hidden" name="idcard" value="<?=$opd['idcard'];?>">
        <input type="hidden" name="doctor" value="<?=$_SESSION['dt_doctor'];?>">
        <input type="hidden" name="cbc" value="<?=$result_cbc;?>">
        <input type="hidden" name="ua" value="<?=$result_ua;?>">

        <input type="hidden" name="yot" value="<?=$opd['yot'];?>">
        <input type="hidden" name="name" value="<?=$opd['name'];?>">
        <input type="hidden" name="surname" value="<?=$opd['surname'];?>">

        <input type="hidden" name="sex" value="<?=$opd['sex'];?>">

        <?php
        $address = $opd['address'].' '.( !empty($opd['tambol']) ? '�.'.$opd['tambol'] : '' ).' '.( !empty($opd['ampur']) ? '�.'.$opd['ampur'] : '' ).' '.( !empty($opd['changwat']) ? '�.'.$opd['changwat'] : '' );
        ?>
        <input type="hidden" name="address" value="<?=$address;?>">
    </div>
</form>