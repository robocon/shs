<style>
table, table td{
    border: 0;
}
</style>
<fieldset>
    <legend>�����ž�鹰ҹ</legend>
    <div class="col">
        <div class="cell">
            �ѹ����Ǩ <input type="text" name="date_add" value="<?=$date_add;?>">
            <span class="no-print">* �ٻẺ ��-��͹-�ѹ �� 2559-12-29</span>
        </div>
    </div>
    <div class="col">
        <div class="cell">
            ���� <span class="box-underline"><?=$item['name'];?></span>
            ʡ�� <span class="box-underline"><?=$item['surname'];?></span>
            <input type="hidden" name="ptname" value="<?=$ptname;?>">
            ���� <span class="box-underline"><?=$age;?></span>��
            <input type="hidden" name="age" value="<?=$age;?>">
            HN <span class="box-underline"><?=$hn;?></span>
            <input type="hidden" name="hn" value="<?=$hn;?>">
        </div>
    </div>
</fieldset>
    
<fieldset>
    <legend>�Ѵ��ͧ�����˹�ҷ��</legend>
    <table>
        <tbody>
            <tr>
                <td colspan="2">
                    <h3>1. �ѡɳзҧ��ҧ���</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="normal">
                        <input type="radio" name="1_1" id="normal" <?=($item['1_1'] == '0' ? 'checked' : '' );?> value="0"> ����
                    </label>
                    <label for="abnormal">
                        <input type="radio" name="1_1" id="abnormal" <?=($item['1_1'] == '1' ? 'checked' : '' );?> value="1"> �Դ���� <input type="text" name="1_1_detail" value="<?=urldecode($item['1_1_detail']);?>">
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>2. ����ѵԷ����</h3>
                </td>
            </tr>
            <tr>
                <!-- Left Col -->
                <td width="50%" style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="2_1">
                                    <input type="checkbox" name="2_1" id="2_1" <?=($item['2_1'] == '1' ? 'checked' : '' );?> value="1"> ����
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="notdrink">
                                    <input type="radio" name="2_2" id="notdrink" value="0" <?=($item['2_2'] == '0' ? 'checked' : '' );?>> ����������
                                </label>
                                <label for="drink">
                                    <input type="radio" name="2_2" id="drink" value="1" <?=($item['2_2'] == '1' ? 'checked' : '' );?>> �������� <input type="text" name="2_2_detail" value="<?=urldecode($item['2_2_detail']);?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="notsmoke">
                                    <input type="radio" name="2_3" id="notsmoke" value="0" <?=($item['2_3'] == '0' ? 'checked' : '' );?>> ����ٺ������
                                </label>
                                <label for="smoke">
                                    <input type="radio" name="2_3" id="smoke" value="1" <?=($item['2_3'] == '1' ? 'checked' : '' );?>> �ٺ������ <input type="text" name="2_3_detail" value="<?=urldecode($item['2_3_detail']);?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="notallergic">
                                    <input type="radio" name="2_4" id="notallergic" value="0" <?=($item['2_4'] == '0' ? 'checked' : '' );?>> �������
                                </label>
                                <label for="allergic">
                                    <input type="radio" name="2_4" id="allergic" value="1" <?=($item['2_4'] == '1' ? 'checked' : '' );?>> ���� <input type="text" name="2_4_detail" value="<?=urldecode($item['2_4_detail']);?>">
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
                <!-- Right Col -->
                <td width="50%" style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="2_5">
                                    <input type="checkbox" name="2_5" id="2_5" <?=($item['2_5'] == '1' ? 'checked' : '' );?> value="1"> �͡�
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="2_6">
                                    <input type="checkbox" name="2_6" id="2_6" <?=($item['2_6'] == '1' ? 'checked' : '' );?> value="1"> ��ҵѴ �� ����������, �����������, ��١����������
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="2_7">
                                    <input type="checkbox" name="2_7" id="2_7" <?=($item['2_7'] == '1' ? 'checked' : '' );?> value="1"> ���� <input type="text" name="2_7_detail" value="<?=urldecode($item['2_7_detail']);?>">
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>3. ����ѵԷ����</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="3_1">
                                    <input type="checkbox" name="3_1" id="3_1" <?=($item['3_1'] == '1' ? 'checked' : '' );?> value="1"> �����
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_2">
                                    <input type="checkbox" name="3_2" id="3_2" <?=($item['3_2'] == '1' ? 'checked' : '' );?> value="1"> ����
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_3">
                                    <input type="checkbox" name="3_3" id="3_3" <?=($item['3_3'] == '1' ? 'checked' : '' );?> value="1"> ��ʹ���ʹ��ͧ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_4">
                                    <input type="checkbox" name="3_4" id="3_4" <?=($item['3_4'] == '1' ? 'checked' : '' );?> value="1"> �����ѹ���Ե�٧
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_5">
                                    <input type="checkbox" name="3_5" id="3_5" <?=($item['3_5'] == '1' ? 'checked' : '' );?> value="1"> ����ҹ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_6">
                                    <input type="checkbox" name="3_6" id="3_6" <?=($item['3_6'] == '1' ? 'checked' : '' );?> value="1"> ������������٧
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="3_7">
                                    <input type="checkbox" name="3_7" id="3_7" <?=($item['3_7'] == '1' ? 'checked' : '' );?> value="1"> �Ѻ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_8">
                                    <input type="checkbox" name="3_8" id="3_8" <?=($item['3_8'] == '1' ? 'checked' : '' );?> value="1"> ���´�
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_9">
                                    <input type="checkbox" name="3_9" id="3_9" <?=($item['3_9'] == '1' ? 'checked' : '' );?> value="1"> �
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_10">
                                    <input type="checkbox" name="3_10" id="3_10" <?=($item['3_10'] == '1' ? 'checked' : '' );?> value="1"> �ä���ʹ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_11">
                                    <input type="checkbox" name="3_11" id="3_11" <?=($item['3_11'] == '1' ? 'checked' : '' );?> value="1"> ���ѡ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_12">
                                    <input type="checkbox" name="3_12" id="3_12" <?=($item['3_12'] == '1' ? 'checked' : '' );?> value="1"> �ä�ҧ�к����� <input type="text" name="3_12_detail" value="<?=urldecode($item['3_12_detail']);?>">
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>4. ����С�͹���ѵ����</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                �ѡ��͹
                                <label for="sleep">
                                    <input type="radio" name="4_1" id="sleep" value="0" <?=($item['4_1'] == '0' ? 'checked' : '' );?>> ��§��
                                </label>
                                <label for="notsleep">
                                    <input type="radio" name="4_1" id="notsleep" value="1" <?=($item['4_1'] == '1' ? 'checked' : '' );?>> �����§�� �͹ <input type="text" name="4_1_detail" value="<?=urldecode($item['4_1_detail']);?>">��.
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="4_2">
                                    <input type="checkbox" name="4_2" id="4_2" <?=($item['4_2'] == '1' ? 'checked' : '' );?> value="1"> ���´/�Ե��ѧ��
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="4_3">
                                    <input type="checkbox" name="4_3" id="4_3" <?=($item['4_3'] == '1' ? 'checked' : '' );?> value="1"> �Ѻ��зҹ������黡��/����
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="4_4">
                                    <input type="checkbox" name="4_4" id="4_4" <?=($item['4_4'] == '1' ? 'checked' : '' );?> value="1"> �ҡ�ûǴ(pain score 0-10) <input type="text" name="4_4_detail" value="<?=urldecode($item['4_4_detail']);?>">
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="4_5">
                                    <input type="checkbox" name="4_5" id="4_5" <?=($item['4_5'] == '1' ? 'checked' : '' );?> value="1"> �Ѻ��зҹ�� <input type="text" name="4_5_detail" value="<?=urldecode($item['4_5_detail']);?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="4_6">
                                    <input type="checkbox" name="4_6" id="4_6" <?=($item['4_6'] == '1' ? 'checked' : '' );?> value="1"> ���Ѻ��зҹ�� <input type="text" name="4_6_detail" value="<?=urldecode($item['4_6_detail']);?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="4_7">
                                    <input type="checkbox" name="4_7" id="4_7" <?=($item['4_7'] == '1' ? 'checked' : '' );?> value="1"> Premedication
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<fieldset>
    <legend>�Ѵ��ͧ�·ѹ�ᾷ��</legend>
    <table>
        <tbody>
            <tr>
                <td colspan="2">
                    <h3>5. �Ѵ��ͧ�����ѹ���Ե�٧</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="5_1">
                                    <input type="checkbox" name="5_1" id="5_1" <?=($item['5_1'] == '1' ? 'checked' : '' );?> value="1"> &lt; 140/90 (����)
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="5_2">
                                    <input type="checkbox" name="5_2" id="5_2" <?=($item['5_2'] == '1' ? 'checked' : '' );?> value="1"> 140-160/90-95 (����ع�ç)
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="5_3">
                                    <input type="checkbox" name="5_3" id="5_3" <?=($item['5_3'] == '1' ? 'checked' : '' );?> value="1"> 160-200/95-119 (�ҹ��ҧ)
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>6. �ҷ���Ѻ��зҹ�繻�Ш�</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="6_1">
                                    <input type="checkbox" name="6_1" id="6_1" <?=($item['6_1'] == '1' ? 'checked' : '' );?> value="1"> ������Ѻ��зҹ����
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_2">
                                    <input type="checkbox" name="6_2" id="6_2" <?=($item['6_2'] == '1' ? 'checked' : '' );?> value="1"> HT
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_3">
                                    <input type="checkbox" name="6_3" id="6_3" <?=($item['6_3'] == '1' ? 'checked' : '' );?> value="1"> DM
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_4">
                                    <input type="checkbox" name="6_4" id="6_4" <?=($item['6_4'] == '1' ? 'checked' : '' );?> value="1"> Chloresterol
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_5">
                                    <input type="checkbox" name="6_5" id="6_5" <?=($item['6_5'] == '1' ? 'checked' : '' );?> value="1"> Thyroid
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_6">
                                    <input type="checkbox" name="6_6" id="6_6" <?=($item['6_6'] == '1' ? 'checked' : '' );?> value="1"> �ä����
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="6_7">
                                    <input type="checkbox" name="6_7" id="6_7" <?=($item['6_7'] == '1' ? 'checked' : '' );?> value="1"> �� AP Ẻ��������(pt DM,HT,Chloresterol,smocking) �� aspirin
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_8">
                                    <input type="checkbox" name="6_8" id="6_8" <?=($item['6_8'] == '1' ? 'checked' : '' );?> value="1"> �� AP Ẻ dual (Aspirin+clopidogrel)
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_9">
                                    <input type="checkbox" name="6_9" id="6_9" <?=($item['6_9'] == '1' ? 'checked' : '' );?> value="1"> �� NOACS ex. Pabigatran,Apixaban Rivoroxaben
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_10">
                                    <input type="checkbox" name="6_10" id="6_10" <?=($item['6_10'] == '1' ? 'checked' : '' );?> value="1"> �ҡ���� bisphosphanate
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_11">
                                    <input type="checkbox" name="6_11" id="6_11" <?=($item['6_11'] == '1' ? 'checked' : '' );?> value="1"> ����ջ���ѵԡ���ѡ���ä�ҧ�к���� þ.�����
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_12">
                                    <input type="checkbox" name="6_12" id="6_12" <?=($item['6_12'] == '1' ? 'checked' : '' );?> value="1"> �����
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>7. �ѡɳ��ѵ����</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="7_1">
                                    <input type="checkbox" name="7_1" id="7_1" <?=($item['7_1'] == '1' ? 'checked' : '' );?> value="1"> �ٴ�Թ�ٹ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="7_2">
                                    <input type="checkbox" name="7_2" id="7_2" <?=($item['7_2'] == '1' ? 'checked' : '' );?> value="1"> �͹�ѹ����Թ 3���
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="7_3">
                                    <input type="checkbox" name="7_3" id="7_3" <?=($item['7_3'] == '1' ? 'checked' : '' );?> value="1"> ��ҵѴ�к��˹ͧ�/�͡��ͧ�ҡ
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="7_4">
                                    <input type="checkbox" name="7_4" id="7_4" <?=($item['7_4'] == '1' ? 'checked' : '' );?> value="1"> ��ҿѹ�ش 1-2���
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="7_5">
                                    <input type="checkbox" name="7_5" id="7_5" <?=($item['7_5'] == '1' ? 'checked' : '' );?> value="1"> ��ҵѴ��д١�͡
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="7_6">
                                    <input type="checkbox" name="7_6" id="7_6" <?=($item['7_6'] == '1' ? 'checked' : '' );?> value="1"> ���¡�����ͧ�ҡ����
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>8. Ἱ����ѡ�Ңͧ�ѹ�ᾷ��</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="8_1">
                                    <input type="checkbox" name="8_1" id="8_1" <?=($item['8_1'] == '1' ? 'checked' : '' );?> value="1"> �ѡ�ҷҧ�ѹ�������
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="8_2">
                                    <input type="checkbox" name="8_2" id="8_2" <?=($item['8_2'] == '1' ? 'checked' : '' );?> value="1"> �ѡ�ҡóթء�Թ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="8_3">
                                    <input type="checkbox" name="8_3" id="8_3" <?=($item['8_3'] == '1' ? 'checked' : '' );?> value="1"> �ӺѴ�ء�Թ��������Ǵ/�һ�Ԫ�ǹ�
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="8_4">
                                    <input type="checkbox" name="8_4" id="8_4" <?=($item['8_4'] == '1' ? 'checked' : '' );?> value="1"> ���͡���ѡ�ҷҧ�ѹ�����
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="8_5">
                                    <input type="checkbox" name="8_5" id="8_5" <?=($item['8_5'] == '1' ? 'checked' : '' );?> value="1"> �觻�֡��ᾷ��
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>9. Ἱ����ѡ�Ңͧᾷ��</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                
                                <label for="9_1">
                                    <input type="checkbox" name="9_1" id="9_1" <?=($item['9_1'] == '1' ? 'checked' : '' );?> value="1"> ��ش�� AP/AC/NOACS
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="9_2">
                                    <input type="checkbox" name="9_2" id="9_2" <?=($item['9_2'] == '1' ? 'checked' : '' );?> value="1"> ��Ѻ��/����/����¹��
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="9_3">
                                    <input type="checkbox" name="9_3" id="9_3" <?=($item['9_3'] == '1' ? 'checked' : '' );?> value="1"> ����͹����ѡ��
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="9_4">
                                    <input type="checkbox" name="9_4" id="9_4" <?=($item['9_4'] == '1' ? 'checked' : '' );?> value="1"> ��Ǩ�������
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="9_5">
                                    <input type="checkbox" name="9_5" id="9_5" <?=($item['9_5'] == '1' ? 'checked' : '' );?> value="1"> refer
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="9_6">
                                    <input type="checkbox" name="9_6" id="9_6" <?=($item['9_6'] == '1' ? 'checked' : '' );?> value="1"> �ѡ�ҷҧ�ѹ�������
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>�ѹ�֡�������</h3>
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <label for="10_1">
                        <textarea name="10_1" id="10_1" cols="45" rows="5"><?=urldecode($item['10_1']);?></textarea>
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>�ѹ�ᾷ�����ѡ��</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="10_1">
                        <?php
                        $officers = array(
                            '�.�.˭ԧ ˹��ķ�� ����ȹѹ��',
                            '�.�.˭ԧ ���͡�� �Ҫ����'
                        );
                        ?>
                        <select name="doctor">
                            <?php foreach ($officers as $key => $officer) { ?>
                            <?php $selected = ( $writer == $officer ) ? 'selected="selected"' : '' ; ?>
                            <option value="<?php echo $officer;?>" <?php echo $selected;?>><?php echo $officer;?></option>
                            <?php } ?>
                        </select>
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>