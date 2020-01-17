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
<fieldset>
    <legend>���Ң����ŵ�� AN</legend>
    <form action="formNewborn.php" method="post">
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
        <form action="formNewborn.php" method="post">
            <fieldset>
                <legend>�����ž�鹰ҹ</legend>
                <table>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">����ʡ�źԴ� <input type="text" name="father" id="" value="<?=trim($opcard['father']);?>"></span>
                            <span class="sRow">ID <input type="text" name="fatherId" size="12"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">����ʡ����ô� <input type="text" name="mother" id="" value="<?=trim($opcard['mother']);?>"></span>
                            <span class="sRow">ID <input type="text" name="motherId" class="important" size="12"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">�ѹ�֡��á�á�Դ <input type="radio" name="prefix" id="prefix1" value="�.�." <?=($sex==1?'checked="checked"':'');?> > <label for="prefix1">�.�.</label> 
                            <input type="radio" name="prefix" id="prefix2" value="�.�." <?=($sex==2?'checked="checked"':'');?>> <label for="prefix2">�.�.</label></span>

                            <span class="sRow">����-ʡ�� <input type="text" name="name" id="" value="<?=$opcard['name'].' '.$opcard['surname'];?>"></span>
                            <span class="sRow">ID <input type="text" name="idcard" id="" size="12" value="<?=$opcard['idcard'];?>"></span>

                            <input type="hidden" name="sex" value="<?=$sex;?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">������� <input type="text" name="address" id="" value="<?=$address;?>" size="40"></span>
                            <span class="sRow">�����÷��Դ����� <input type="text" name="phone" id="" value="<?=$opcard['phone'];?>"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">Ǵ�.�Դ <input type="text" name="dateBorn" class="important" id="dateBorn" value="<?=$opcard['dbirth'];?>"></span>
                            <span class="sRow">���� <input type="text" name="timeBorn" class="important" id="" size="10"> �.</span>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>�����š�ä�ʹ</legend>
                <table>
                    <tr>
                        <td class="tdRow">
                            <!-- LABOR -->
                            <span class="sRow">������� <select name="gravida">
                            <?php 
                                foreach ($gravidaList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                            ?>
                            </select></span>
                            
                            <span class="sRow">���ؤ���� <input type="text" name="ga" class="important" size="3">�ѻ����</span>

                            <!-- LABOR -->
                            <span class="sRow">����� <select name="lborn" id="">
                            <?php 
                                foreach ($gravidaList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                            ?>
                            </select></span>

                            <!-- LABOR -->
                            
                            <span class="sRow">ʶҹ��� <select name="bplace" id="">
                            <?php 
                            $db->select("SELECT * FROM `f43_labor_182_newborn_187`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select></span>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <!-- LABOR -->
                            <span class="sRow">�Ըա�ä�ʹ <select name="btype" id="">
                                <?php 
                                $db->select("SELECT * FROM `f43_labor_184_newborn_190`");
                                $bdoctorLists = $db->get_items();
                                foreach ($bdoctorLists as $key => $bdoc) {
                                    ?>
                                    <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                    <?php
                                }
                                ?>
                            </select></span>

                            <span class="sRow">���������Ӥ�ʹ 
                                <select name="bdoctor" id="">
                                <?php 
                                $db->select("SELECT * FROM `f43_labor_185_newborn_191`");
                                $bdoctorLists = $db->get_items();
                                foreach ($bdoctorLists as $key => $bdoc) {
                                    ?>
                                    <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">���˹ѡ�á�Դ <input type="text" name="weight" id="" size="5" class="important">���� </span>
                            <span class="sRow">������� <input type="text" name="height" id="" size="5" class="important">��. </span>
                            <span class="sRow">����ͺ����� <input type="text" name="head" id="" size="5" class="important">��. </span>
                            <span class="sRow">����ͺ͡ <input type="text" name="breast" id="" size="5">��. </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">APGAR SCORE(1�ҷ�) <select name="apgar1" id="" class="important">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                            </select></span>
                            <span class="sRow">(5�ҷ�) <select name="apgar5" id="">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                            </select></span>
                            <span class="sRow">(10�ҷ�) <select name="apgar10" id="">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                            </select></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            �����Դ��������Դ<span style="color: red;">*</span> <input type="radio" name="disorder" id="disorder1" value="�����"><label for="disorder1">�����</label> 
                            <input type="radio" name="disorder" id="disorder2" value="��"><label for="disorder2">��</label> 
                            �к� <input type="text" name="disorderDetail" id="">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            ������آ�Ҿ�á�Դ <input type="radio" name="health" id="health1" value="���ç��"><label for="health1">���ç��</label> 
                            <input type="radio" name="health" id="health2" value="�Դ����"><label for="health2">�Դ����</label> 
                            �к� <input type="text" name="healthDetail" id="">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">�ӴѺ���ͧ��á <select name="birthNo" class="important">
                            <?php 
                            $db->select("SELECT * FROM `f43_newborn_18_pp`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            ����÷���Ѻ��зҹ <select name="food" id="" class="important">
                                <option value="1">��������ҧ����</option>
                                <option value="2">�������й��</option>
                                <option value="3">�������й����</option>
                                <option value="4">��������ҧ����</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            �Ե��Թ�<span style="color: red;">*</span> <input type="radio" name="vitamink" id="vitamink1" value="�մ"><label for="vitamink1">�մ</label> 
                            <input type="radio" name="vitamink" id="vitamink2" value="���մ"><label for="vitamink2">���մ</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">��õ�Ǩ����о��ͧ���´��������<span style="color: red;">*</span> <input type="radio" name="thyroid" id="thyroid1" value="����"><label for="thyroid1">����</label> 
                            <input type="radio" name="thyroid" id="thyroid2" value="�Դ����"><label for="thyroid2">�Դ����</label></span>
                            <span class="sRow">�š�õ�Ǩ���´� <input type="text" name="thyroidResult" id="" size="5" class="important">mU/L</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">��õ�ǨPKU <input type="radio" name="pku" id="pku1" value="����"><label for="pku1">����</label> 
                            <input type="radio" name="pku" id="pku2" value="�Դ����"><label for="pku2">�Դ����</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <input type="text" name="bcgDate" id="bcg" size="10"> Ǵ�. �����մ�Ѥ�չ��ͧ�ѹ�ä(BCG)
                            <input type="text" name="hbDate" id="hb" size="10"> Ǵ�. �����մ�Ѥ�չ��ͧ�ѹ�ä�Ѻ�ѡ�ʺ��(HB)
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">�ѹ����˹��� <input type="text" name="discharge" id="dischargeDate" size="10"> </span>
                            <span class="sRow">���˹ѡ�ѹ����˹��� <input type="text" name="weightDischarge" id="" size="5">����</span>
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