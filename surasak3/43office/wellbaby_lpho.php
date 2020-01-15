<?php 

include '../bootstrap.php';

$action = input_post('action');
if($action === 'save'){
    
    dump($_POST);
    exit;
}

include 'head.php';

$apgarList = array(
    0 => 0,1,2,3,4,5,6,7,8,9,10,
    99 => '����Һ'
);

$gravidaList = array(1,2,3,4,5,6,7,8,9,10);

?>

<style>
/* ���ҧ */
body, input, button{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 14pt;
}
select > option {
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 14pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
label{
    cursor: pointer;
}

@media print{
    .div-hide{
        display: none;
    }
}
</style>

<fieldset>
    <legend>���Ң����ŵ�� AN</legend>
    <form action="wellbaby_lpho.php" method="post">
        <div>
            AN : <input type="text" name="an" id="an">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="page" value="searchAn">
        </div>
    </form>
</fieldset>
<script>
window.onload = function(){
    document.getElementById("an").focus();
}
</script>

<?php 
$page = input_post('page');
if( $page === 'searchAn' ){ 

    $db = Mysql::load();
    $an = input_post('an');
    $sql = "SELECT * FROM `ipcard` WHERE `an` = '$an'";
    $db->select($sql);

    if( $db->get_rows() > 0 ){
        $item = $db->get_item();

        $hn = $item['hn'];

        $db->select("SELECT * FROM `opcard` WHERE `hn`= '$hn'");
        $opcard = $db->get_item();

        if( $opcard['yot'] == '�.�.' ){
            $sex = '1';
        }elseif ( $opcard['yot'] == '�.�.' ) {
            $sex = '2';
        }
        
        $address = $opcard['address'].' �.'.$opcard['tambol'].' �.'.$opcard['ampur'].' �.'.$opcard['changwat'];

        ?>
        <fieldset>
            <legend>���������ͧ���ѹ������Ѻ��ԡ��</legend>
            <table>
                <tr>
                    <td><b>AN : </b><?=$item['an'];?> <b>HN : </b><?=$item['hn'];?> <b>����-ʡ�� : </b><?=$item['ptname'];?></td>
                </tr>
                <tr>
                    <td>�ѹ����Ѻ��ԡ�� : <?=$item['date'];?></td>
                </tr>
            </table>
        </fieldset>
        <form action="wellbaby_lpho.php" method="post">
            <fieldset>
                <legend>�����ž�鹰ҹ</legend>
                <table>
                    <tr>
                        <td>
                            ����ʡ�źԴ� <input type="text" name="father" id="" value="<?=trim($opcard['father']);?>"> ID <input type="text" name="fatherId" id="" size="12">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ����ʡ����ô� <input type="text" name="mother" id="" value="<?=trim($opcard['mother']);?>"> ID <input type="text" name="motherId" id="" size="12">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            �ѹ�֡��á�á�Դ <input type="radio" name="prefix" id="prefix1" value="�.�." <?=($sex==1?'checked="checked"':'');?> > <label for="prefix1">�.�.</label> 
                            <input type="radio" name="prefix" id="prefix2" value="�.�." <?=($sex==2?'checked="checked"':'');?>> <label for="prefix2">�.�.</label> 

                            ����-ʡ�� <input type="text" name="name" id="" value="<?=$opcard['name'].' '.$opcard['surname'];?>"> ID <input type="text" name="idcard" id="" size="12" value="<?=$opcard['idcard'];?>">
                            <input type="hidden" name="sex" value="<?=$sex;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ������� <input type="text" name="address" id="" value="<?=$address;?>" size="40"> 
                            �����÷��Դ����� <input type="text" name="phone" id="" value="<?=$opcard['phone'];?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ǵ�.�Դ <input type="text" name="dateBorn" id="dateBorn" value="<?=$opcard['dbirth'];?>"> 
                            ���� <input type="text" name="timeBorn" id="" size="10"> �. 
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>�����š�ä�ʹ</legend>
                <table>
                    <tr>
                        <td>
                            <!-- LABOR -->
                            ������� <select name="gravida" id="">
                            <?php 
                                foreach ($gravidaList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                            ?>
                            </select>

                            <!-- LABOR -->
                            ����� <select name="lborn" id="">
                            <?php 
                                foreach ($gravidaList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                            ?>
                            </select>

                            <!-- LABOR -->
                            ʶҹ��� <select name="bplace" id="">
                                <option value="1">�ç��Һ��</option>
                                <option value="2">ʶҹ�͹����</option>
                                <option value="3">��ҹ</option>
                                <option value="4">�����ҧ�ҧ</option>
                                <option value="5">����</option>
                            </select>

                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- LABOR -->
                            �Ըա�ä�ʹ <select name="btype" id="">
                                <option value="1">NORMAL</option>
                                <option value="2">CESAREAN</option>
                                <option value="3">VACUUM</option>
                                <option value="4">FORCEPS</option>
                                <option value="5">��ҡ�</option>
                                <option value="6">ABORTION</option>
                            </select>

                            ���������Ӥ�ʹ <select name="bdoctor" id="">
                                <option value="1">ᾷ��</option>
                                <option value="2">��Һ��</option>
                                <option value="3">���.�Ҹ�ó�آ(��������ᾷ�� ��Һ��)</option>
                                <option value="4">��ا�������ҳ</option>
                                <option value="5">��ʹ�ͧ</option>
                                <option value="6">����</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ���˹ѡ�á�Դ <input type="text" name="weight" id="" size="5">���� 
                            ������� <input type="text" name="height" id="" size="5">��. 
                            ����ͺ����� <input type="text" name="head" id="" size="5">��. 
                            ����ͺ͡ <input type="text" name="breast" id="" size="5">��. 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            APGAR SCORE(1�ҷ�) <select name="apgar1" id="">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                            </select>
                            (5�ҷ�) <select name="apgar5" id="">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                            </select>
                            (10�ҷ�) <select name="apgar10" id="">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            �����Դ��������Դ <input type="radio" name="disorder" id="disorder1" value="�����"><label for="disorder1">�����</label> 
                            <input type="radio" name="disorder" id="disorder2" value="��"><label for="disorder2">��</label> 
                            �к� <input type="text" name="disorderDetail" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ������آ�Ҿ�á�Դ <input type="radio" name="health" id="health1" value="���ç��"><label for="health1">���ç��</label> 
                            <input type="radio" name="health" id="health2" value="�Դ����"><label for="health2">�Դ����</label> 
                            �к� <input type="text" name="healthDetail" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            �ӴѺ���ͧ��á <select name="birthNo" id="">
                                <option value="1">��ʹ�����</option>
                                <option value="2">��ὴ�ӴѺ��� 1</option>
                                <option value="3">��ὴ�ӴѺ��� 2</option>
                                <option value="4">��ὴ�ӴѺ��� 3</option>
                                <option value="5">��ὴ�ӴѺ��� 4</option>
                            </select>

                            ����÷���Ѻ��зҹ <select name="" id="">
                                <option value="1">��������ҧ����</option>
                                <option value="2">�������й��</option>
                                <option value="3">�������й����</option>
                                <option value="4">��������ҧ����</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>�ѹ����˹��� <input type="text" name="discharge" id="dischargeDate" size="10"> 
                            ���˹ѡ�ѹ����˹��� <input type="text" name="weightDischarge" id="" size="5">����
                        </td>
                    </tr>
                    <tr>
                        <td>
                            �Ե��Թ� <input type="radio" name="vitamink" id="vitamink1" value="�մ"><label for="vitamink1">�մ</label> 
                            <input type="radio" name="vitamink" id="vitamink2" value="���մ"><label for="vitamink2">���մ</label>
                        </td>
                    </tr>
                    <tr>
                        <td>��õ�Ǩ����о��ͧ���´�������� <input type="radio" name="thyroid" id="thyroid1" value="����"><label for="thyroid1">����</label> 
                            <input type="radio" name="thyroid" id="thyroid2" value="�Դ����"><label for="thyroid2">�Դ����</label>
                            �š�õ�Ǩ���´� <input type="text" name="thyroidResult" id="" size="5">mU/L
                        </td>
                    </tr>
                    <tr>
                        <td>��õ�ǨPKU <input type="radio" name="pku" id="pku1" value="����"><label for="pku1">����</label> 
                            <input type="radio" name="pku" id="pku2" value="�Դ����"><label for="pku2">�Դ����</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="bcgDate" id="bcg" size="10"> Ǵ�. �����մ�Ѥ�չ��ͧ�ѹ�ä(BCG)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="hbDate" id="hb" size="10"> Ǵ�. �����մ�Ѥ�չ��ͧ�ѹ�ä�Ѻ�ѡ�ʺ��(HB)
                        </td>
                    </tr>
                </table>

            </fieldset>
            <div>
                <button type="submit">�ѹ�֡������</button>
                <input type="hidden" name="action" value="save">
            </div>
        </form>
        <script type="text/javascript">
            var popup1, popup2, popup3, popup4;
            window.onload = function() {
                popup1 = new Epoch('popup1','popup',document.getElementById('dateBorn'),false);
                popup2 = new Epoch('popup2','popup',document.getElementById('dischargeDate'),false);
                popup3 = new Epoch('popup2','popup',document.getElementById('bcg'),false);
                popup4 = new Epoch('popup2','popup',document.getElementById('hb'),false);
            };
        </script>
        <?php

    }else{
        ?>
        <h1>��辺������</h1>
        <?php
    }
    ?>
    <?php
}
?>



<?php 

include 'footer.php';
?>