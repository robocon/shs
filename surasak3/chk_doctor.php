<?php

// session_start();

// include("connect.inc");

include 'bootstrap.php';
include 'dt_menu.php';
// include("dt_menu.php");

session_unregister("list_bill");
session_register("list_bill");

$_SESSION['list_bill'] = '';
$vn = $_SESSION['vn_now']; //vn
$hn = $_SESSION['hn_now'];
$post_vn = 1;
$_SESSION['dt_doctor'] = $_SESSION['sOfficer'];

$date_now = date("Y-m-d H:i:s");
$date_hn = date('d-m-').( date('Y') + 543 ).$hn;

$db = Mysql::load();

$sql = "SELECT * FROM `opd` WHERE `thdatehn` = '$date_hn'";
$db->select($sql);
$pt = $db->get_item();

$sql = "SELECT b.`name`  
FROM `opcardchk` AS a 
LEFT JOIN `chk_company_list` AS b ON b.`code` = a.`part` 
WHERE a.`HN` = '$hn' ";

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
}
h1,h3,p{
    margin: 0;
    padding: 0;
}
</style>
<form action="chk_doctor.php" method="post" >
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
                        <td width="15%"><?=$pt['ptname'];?></td>
                        <td width="10%" class="tb-title">HN</td>
                        <td width="15%"><?=$pt['hn'];?></td>
                        <td width="10%" class="tb-title">����ѷ</td>
                        <td width="15%">xxx</td>
                        <td width="10%" class="tb-title">����</td>
                        <td width="15%"><?=$pt['age'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">���˹ѡ</td>
                        <td><?=$pt['weight'];?></td>
                        <td class="tb-title">��ǹ�٧</td>
                        <td><?=$pt['height'];?></td>
                        <td class="tb-title">BP</td>
                        <td><?=$pt['bp1'].'/'.$pt['bp2'];?></td>
                        <td class="tb-title">Repeat-BP</td>
                        <td>xxx</td>
                    </tr>
                    <tr>
                        <td class="tb-title">T</td>
                        <td><?=$pt['temperature'];?></td>
                        <td class="tb-title">P</td>
                        <td><?=$pt['pause'];?></td>
                        <td class="tb-title">R</td>
                        <td><?=$pt['rate'];?></td>
                        <td class="tb-title">�ä��Шӵ��</td>
                        <td><?=$pt['organ'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">�ٺ������</td>
                        <td><?=$pt['cigarette'];?></td>
                        <td class="tb-title">��������</td>
                        <td><?=$pt['alcohol'];?></td>
                        <td class="tb-title">�͡���ѧ���</td>
                        <td><?=$pt['exercise'];?></td>
                        <td class="tb-title">����</td>
                        <td><?=$pt['drugreact'];?></td>
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
            <td>
                <table width="100%">
                    <tr>
                        <td colspan="2" align="center">CBC</td>
                    </tr>
                    <tr>
                        <td>test</td>
                        <td>1234</td>
                    </tr>
                </table>
            </td>
            <td>
                <table  width="100%">
                    <tr>
                        <td colspan="2" align="center">UA</td>
                    </tr>
                    <tr>
                        <td>test</td>
                        <td>1234</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>�������آ�Ҿ</h3></td>
        </tr>
        <tr>
            <td width="25%" class="tb-title">��äѴ��ͧ������Թ : </td>
            <td>
                <label for="ear1"><input type="radio" name="ear" id="ear1"> ���� </label>
                <label for="ear2"><input type="radio" name="ear" id="ear2"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">��õ�Ǩ��ҹ���ᾷ��<br>���ͺؤ�ҡ��Ҹ�ó�آ : </td>
            <td>
                <label for="breast1"><input type="radio" name="breast" id="breast1"> ���� </label>
                <label for="breast2"><input type="radio" name="breast" id="breast2"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">��õ�Ǩ���¤������Ţͧ�ѡ��ᾷ�� : </td>
            <td>
                <label for="eye1"><input type="radio" name="eye" id="eye1"> ���� </label>
                <label for="eye2"><input type="radio" name="eye" id="eye2"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">��õ�Ǩ�Ҵ��� Snellen eye Chart : </td>
            <td>
                <label for="snell_eye1"><input type="radio" name="snell_eye" id="snell_eye1"> ���� </label>
                <label for="snell_eye2"><input type="radio" name="snell_eye" id="snell_eye2"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">Chest X-ray : <a href="http://pacssrsh/explore.asp?path=/All%20Patients/InternalPatientUID=58-2733" target="_blank">�ټš�õ�Ǩ</a> </td>
            <td>
                <label for="cxr1"><input type="radio" name="cxr" id="cxr1"> ���� </label>
                <label for="cxr2"><input type="radio" name="cxr" id="cxr2"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">��ػ�ŵ�Ǩ : </td>
            <td>
                <label for="conclution1"><input type="radio" name="conclution" id="conclution1"> ���� </label>
                <label for="conclution2"><input type="radio" name="conclution" id="conclution2"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p class="tb-title">���й��������㹡�ô����آ�Ҿ</p>
                <textarea name="suggestion" cols="60" rows="8" id="" placeholder="���ͺ��������´�������"></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br>
    <div align="center">
        <button type="submit">�ѹ�֡������</button>
    </div>
</form>