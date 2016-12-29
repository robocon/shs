<style>
table, table td{
    border: 0;
}
</style>
<fieldset>
    <legend>ข้อมูลพื้นฐาน</legend>
    <div class="col">
        <div class="cell">
            วันที่ตรวจ <input type="text" name="date_add" value="<?=$date_add;?>">
            <span class="no-print">* รูปแบบ ปี-เดือน-วัน เช่น 2559-12-29</span>
        </div>
    </div>
    <div class="col">
        <div class="cell">
            ชื่อ <span class="box-underline"><?=$item['name'];?></span>
            สกุล <span class="box-underline"><?=$item['surname'];?></span>
            <input type="hidden" name="ptname" value="<?=$ptname;?>">
            อายุ <span class="box-underline"><?=$age;?></span>ปี
            <input type="hidden" name="age" value="<?=$age;?>">
            HN <span class="box-underline"><?=$hn;?></span>
            <input type="hidden" name="hn" value="<?=$hn;?>">
        </div>
    </div>
</fieldset>
    
<fieldset>
    <legend>คัดกรองโดยเจ้าหน้าที่</legend>
    <table>
        <tbody>
            <tr>
                <td colspan="2">
                    <h3>1. ลักษณะทางร่างกาย</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="normal">
                        <input type="radio" name="1_1" id="normal" <?=($item['1_1'] == '0' ? 'checked' : '' );?> value="0"> ปกติ
                    </label>
                    <label for="abnormal">
                        <input type="radio" name="1_1" id="abnormal" <?=($item['1_1'] == '1' ? 'checked' : '' );?> value="1"> ผิดปกติ <input type="text" name="1_1_detail" value="<?=urldecode($item['1_1_detail']);?>">
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>2. ประวัติทั่วไป</h3>
                </td>
            </tr>
            <tr>
                <!-- Left Col -->
                <td width="50%" style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="2_1">
                                    <input type="checkbox" name="2_1" id="2_1" <?=($item['2_1'] == '1' ? 'checked' : '' );?> value="1"> ปกติ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="notdrink">
                                    <input type="radio" name="2_2" id="notdrink" value="0" <?=($item['2_2'] == '0' ? 'checked' : '' );?>> ไม่ดื่มสุรา
                                </label>
                                <label for="drink">
                                    <input type="radio" name="2_2" id="drink" value="1" <?=($item['2_2'] == '1' ? 'checked' : '' );?>> ดื่มสุรา <input type="text" name="2_2_detail" value="<?=urldecode($item['2_2_detail']);?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="notsmoke">
                                    <input type="radio" name="2_3" id="notsmoke" value="0" <?=($item['2_3'] == '0' ? 'checked' : '' );?>> ไม่สูบบุหรี่
                                </label>
                                <label for="smoke">
                                    <input type="radio" name="2_3" id="smoke" value="1" <?=($item['2_3'] == '1' ? 'checked' : '' );?>> สูบบุหรี่ <input type="text" name="2_3_detail" value="<?=urldecode($item['2_3_detail']);?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="notallergic">
                                    <input type="radio" name="2_4" id="notallergic" value="0" <?=($item['2_4'] == '0' ? 'checked' : '' );?>> ไม่แพ้ยา
                                </label>
                                <label for="allergic">
                                    <input type="radio" name="2_4" id="allergic" value="1" <?=($item['2_4'] == '1' ? 'checked' : '' );?>> แพ้ยา <input type="text" name="2_4_detail" value="<?=urldecode($item['2_4_detail']);?>">
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
                                    <input type="checkbox" name="2_5" id="2_5" <?=($item['2_5'] == '1' ? 'checked' : '' );?> value="1"> ฟอกไต
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="2_6">
                                    <input type="checkbox" name="2_6" id="2_6" <?=($item['2_6'] == '1' ? 'checked' : '' );?> value="1"> ผ่าตัด เช่น ข้อเข่าเทียม, ลิ้นหัวใจเทียม, ปลูกถ่ายอวัยวะ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="2_7">
                                    <input type="checkbox" name="2_7" id="2_7" <?=($item['2_7'] == '1' ? 'checked' : '' );?> value="1"> อื่นๆ <input type="text" name="2_7_detail" value="<?=urldecode($item['2_7_detail']);?>">
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>3. ประวัติทั่วไป</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="3_1">
                                    <input type="checkbox" name="3_1" id="3_1" <?=($item['3_1'] == '1' ? 'checked' : '' );?> value="1"> ไม่มี
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_2">
                                    <input type="checkbox" name="3_2" id="3_2" <?=($item['3_2'] == '1' ? 'checked' : '' );?> value="1"> หัวใจ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_3">
                                    <input type="checkbox" name="3_3" id="3_3" <?=($item['3_3'] == '1' ? 'checked' : '' );?> value="1"> หลอดเลือดสมอง
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_4">
                                    <input type="checkbox" name="3_4" id="3_4" <?=($item['3_4'] == '1' ? 'checked' : '' );?> value="1"> ความดันโลหิตสูง
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_5">
                                    <input type="checkbox" name="3_5" id="3_5" <?=($item['3_5'] == '1' ? 'checked' : '' );?> value="1"> เบาหวาน
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_6">
                                    <input type="checkbox" name="3_6" id="3_6" <?=($item['3_6'] == '1' ? 'checked' : '' );?> value="1"> คลอเรสเตอรอลสูง
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
                                    <input type="checkbox" name="3_7" id="3_7" <?=($item['3_7'] == '1' ? 'checked' : '' );?> value="1"> ตับ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_8">
                                    <input type="checkbox" name="3_8" id="3_8" <?=($item['3_8'] == '1' ? 'checked' : '' );?> value="1"> ไทรอยด์
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_9">
                                    <input type="checkbox" name="3_9" id="3_9" <?=($item['3_9'] == '1' ? 'checked' : '' );?> value="1"> ไต
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_10">
                                    <input type="checkbox" name="3_10" id="3_10" <?=($item['3_10'] == '1' ? 'checked' : '' );?> value="1"> โรคเลือด
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_11">
                                    <input type="checkbox" name="3_11" id="3_11" <?=($item['3_11'] == '1' ? 'checked' : '' );?> value="1"> ลมชัก
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="3_12">
                                    <input type="checkbox" name="3_12" id="3_12" <?=($item['3_12'] == '1' ? 'checked' : '' );?> value="1"> โรคทางระบบอื่นๆ <input type="text" name="3_12_detail" value="<?=urldecode($item['3_12_detail']);?>">
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>4. สภาวะก่อนทำหัตถการ</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                พักผ่อน
                                <label for="sleep">
                                    <input type="radio" name="4_1" id="sleep" value="0" <?=($item['4_1'] == '0' ? 'checked' : '' );?>> เพียงพอ
                                </label>
                                <label for="notsleep">
                                    <input type="radio" name="4_1" id="notsleep" value="1" <?=($item['4_1'] == '1' ? 'checked' : '' );?>> ไม่เพียงพอ นอน <input type="text" name="4_1_detail" value="<?=urldecode($item['4_1_detail']);?>">ชม.
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="4_2">
                                    <input type="checkbox" name="4_2" id="4_2" <?=($item['4_2'] == '1' ? 'checked' : '' );?> value="1"> เครียด/วิตกกังวล
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="4_3">
                                    <input type="checkbox" name="4_3" id="4_3" <?=($item['4_3'] == '1' ? 'checked' : '' );?> value="1"> รับประทานอาหารได้ปกติ/น้อย
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="4_4">
                                    <input type="checkbox" name="4_4" id="4_4" <?=($item['4_4'] == '1' ? 'checked' : '' );?> value="1"> อาการปวด(pain score 0-10) <input type="text" name="4_4_detail" value="<?=urldecode($item['4_4_detail']);?>">
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
                                    <input type="checkbox" name="4_5" id="4_5" <?=($item['4_5'] == '1' ? 'checked' : '' );?> value="1"> รับประทานยา <input type="text" name="4_5_detail" value="<?=urldecode($item['4_5_detail']);?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="4_6">
                                    <input type="checkbox" name="4_6" id="4_6" <?=($item['4_6'] == '1' ? 'checked' : '' );?> value="1"> งดรับประทานยา <input type="text" name="4_6_detail" value="<?=urldecode($item['4_6_detail']);?>">
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
    <legend>คัดกรองโดยทันตแพทย์</legend>
    <table>
        <tbody>
            <tr>
                <td colspan="2">
                    <h3>5. คัดกรองความดันโลหิตสูง</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="5_1">
                                    <input type="checkbox" name="5_1" id="5_1" <?=($item['5_1'] == '1' ? 'checked' : '' );?> value="1"> &lt; 140/90 (ปกติ)
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="5_2">
                                    <input type="checkbox" name="5_2" id="5_2" <?=($item['5_2'] == '1' ? 'checked' : '' );?> value="1"> 140-160/90-95 (ไม่รุนแรง)
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
                                    <input type="checkbox" name="5_3" id="5_3" <?=($item['5_3'] == '1' ? 'checked' : '' );?> value="1"> 160-200/95-119 (ปานกลาง)
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>6. ยาที่รับประทานเป็นประจำ</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="6_1">
                                    <input type="checkbox" name="6_1" id="6_1" <?=($item['6_1'] == '1' ? 'checked' : '' );?> value="1"> ไม่ได้รับประทานยาใดๆ
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
                                    <input type="checkbox" name="6_6" id="6_6" <?=($item['6_6'] == '1' ? 'checked' : '' );?> value="1"> โรคหัวใจ
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
                                    <input type="checkbox" name="6_7" id="6_7" <?=($item['6_7'] == '1' ? 'checked' : '' );?> value="1"> ยา AP แบบปฐมภูมิใน(pt DM,HT,Chloresterol,smocking) เช่น aspirin
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_8">
                                    <input type="checkbox" name="6_8" id="6_8" <?=($item['6_8'] == '1' ? 'checked' : '' );?> value="1"> ยา AP แบบ dual (Aspirin+clopidogrel)
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_9">
                                    <input type="checkbox" name="6_9" id="6_9" <?=($item['6_9'] == '1' ? 'checked' : '' );?> value="1"> ยา NOACS ex. Pabigatran,Apixaban Rivoroxaben
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_10">
                                    <input type="checkbox" name="6_10" id="6_10" <?=($item['6_10'] == '1' ? 'checked' : '' );?> value="1"> ยากลุ่ม bisphosphanate
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_11">
                                    <input type="checkbox" name="6_11" id="6_11" <?=($item['6_11'] == '1' ? 'checked' : '' );?> value="1"> ไม่มีประวัติการรักษาโรคทางระบบที่ รพ.ค่ายฯ
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="6_12">
                                    <input type="checkbox" name="6_12" id="6_12" <?=($item['6_12'] == '1' ? 'checked' : '' );?> value="1"> ไม่มี
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>7. ลักษณะหัตถการ</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="7_1">
                                    <input type="checkbox" name="7_1" id="7_1" <?=($item['7_1'] == '1' ? 'checked' : '' );?> value="1"> ขูดหินปูน
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="7_2">
                                    <input type="checkbox" name="7_2" id="7_2" <?=($item['7_2'] == '1' ? 'checked' : '' );?> value="1"> ถอนฟันไม่เกิน 3ซี่
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="7_3">
                                    <input type="checkbox" name="7_3" id="7_3" <?=($item['7_3'] == '1' ? 'checked' : '' );?> value="1"> ผ่าตัดระบายหนองใน/นอกช่องปาก
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
                                    <input type="checkbox" name="7_4" id="7_4" <?=($item['7_4'] == '1' ? 'checked' : '' );?> value="1"> ผ่าฟันคุด 1-2ซี่
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="7_5">
                                    <input type="checkbox" name="7_5" id="7_5" <?=($item['7_5'] == '1' ? 'checked' : '' );?> value="1"> ผ่าตัดกระดูกงอก
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="7_6">
                                    <input type="checkbox" name="7_6" id="7_6" <?=($item['7_6'] == '1' ? 'checked' : '' );?> value="1"> ศัลยกรรมช่องปากอื่นๆ
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>8. แผนการรักษาของทันตแพทย์</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <label for="8_1">
                                    <input type="checkbox" name="8_1" id="8_1" <?=($item['8_1'] == '1' ? 'checked' : '' );?> value="1"> รักษาทางทันตกรรมได้
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="8_2">
                                    <input type="checkbox" name="8_2" id="8_2" <?=($item['8_2'] == '1' ? 'checked' : '' );?> value="1"> รักษากรณีฉุกเฉิน
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="8_3">
                                    <input type="checkbox" name="8_3" id="8_3" <?=($item['8_3'] == '1' ? 'checked' : '' );?> value="1"> บำบัดฉุกเฉินด้วยยาแก้ปวด/ยาปฏิชีวนะ
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
                                    <input type="checkbox" name="8_4" id="8_4" <?=($item['8_4'] == '1' ? 'checked' : '' );?> value="1"> ชะลอการรักษาทางทันตกรรม
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="8_5">
                                    <input type="checkbox" name="8_5" id="8_5" <?=($item['8_5'] == '1' ? 'checked' : '' );?> value="1"> ส่งปรึกษาแพทย์
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>9. แผนการษักษาของแพทย์</h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                
                                <label for="9_1">
                                    <input type="checkbox" name="9_1" id="9_1" <?=($item['9_1'] == '1' ? 'checked' : '' );?> value="1"> หยุดยา AP/AC/NOACS
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="9_2">
                                    <input type="checkbox" name="9_2" id="9_2" <?=($item['9_2'] == '1' ? 'checked' : '' );?> value="1"> ปรับยา/เพิ่ม/เปลี่ยนยา
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="9_3">
                                    <input type="checkbox" name="9_3" id="9_3" <?=($item['9_3'] == '1' ? 'checked' : '' );?> value="1"> เลื่อนการรักษา
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
                                    <input type="checkbox" name="9_4" id="9_4" <?=($item['9_4'] == '1' ? 'checked' : '' );?> value="1"> ตรวจเพิ่มเติม
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
                                    <input type="checkbox" name="9_6" id="9_6" <?=($item['9_6'] == '1' ? 'checked' : '' );?> value="1"> รักษาทางทันตกรรมได้
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>บันทึกเพิ่มเติม</h3>
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
                    <h3>ทันตแพทย์ผู้รักษา</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="10_1">
                        <?php
                        $officers = array(
                            'พ.อ.หญิง หนึ่งฤทัย มหายศนันท์',
                            'พ.ท.หญิง เกื้อกูล อาชามาส'
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