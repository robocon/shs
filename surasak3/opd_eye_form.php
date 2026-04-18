<?php
$eye_thdatehn = $thidate.$cHn;
$sql = "SELECT * FROM `pt_opd_eye` WHERE `thdatehn` = '$eye_thdatehn' ";
$q = $dbi->query($sql);
$eye = array();
if($q->num_rows > 0)
{
    $eye = $q->fetch_assoc();
}

// ดึงข้อมูลยาต้านการแข็งตัวของเกล็ดเลือดครั้งก่อนหน้า
$todayDMY = date('d-m-').(date('Y')+543);
$sql = "SELECT `antiplatelet` FROM `pt_opd_eye` WHERE `hn` = '$cHn' AND `thdatehn` NOT LIKE '$todayDMY%' ORDER BY DESC LIMIT 1 ";
$q = $dbi->query($sql);
if($q->num_rows>0){
    $prevEye = $q->fetch_assoc();
    $eye['antiplatelet'] = $prevEye['antiplatelet'];
}
?>
<tr>
    <td colspan="5">
        <!-- <div style="border: 1px solid red; width: 100%;">&nbsp;</div> -->
        <fieldset>
            <legend style="font-weight:bold;">ฟอร์มบันทึกห้องตา</legend>
            <table width="100%">
                <tr class="data_show" style="vertical-align: top;">
                    <td align="left" colspan="6">
                        <table width="100%">
                            <tr>
                                <td>
                                    ยาต้านการแข็งตัวของเกล็ดเลือด : 
                                    <?php 
                                    $antiplatelet_list = array(
                                        'ไม่มี', 'มี'
                                    );

                                    if(empty($eye['antiplatelet_txt'])){
                                        $eye['antiplatelet'] = 'ไม่มี';
                                    }

                                    foreach ($antiplatelet_list as $key => $platelet) { 
                                        $default_platelet = ($platelet == $eye['antiplatelet']) ? 'checked="checked"' : '' ;
                                        ?>
                                        <input type="radio" name="antiplatelet" id="antiplatelet<?=$key;?>" onclick="focus_antiplatelet<?=$key;?>()" value="<?=$platelet;?>" <?=$default_platelet;?> ><label for="antiplatelet<?=$key;?>"><?=$platelet;?></label>
                                        <?php
                                    }
                                    ?>
                                    <input type="text" name="antiplatelet_txt" id="antiplatelet_txt" onfocus="focus_antiplate_txt()" onfocusout="unfocus_antiplate_txt()" value="<?=$eye['antiplatelet_txt'];?>">
                                    <script type="text/javascript">

                                        function focus_antiplatelet0(){
                                            document.getElementById('antiplatelet_txt').value = '';
                                        }
                                        function focus_antiplatelet1(){
                                            document.form2.antiplatelet_txt.focus();
                                        }

                                        function focus_antiplate_txt(){
                                            document.form2.antiplatelet1.checked = true;
                                        }
                                        function unfocus_antiplate_txt(){
                                            if(document.getElementById('antiplatelet_txt').value==''){
                                                document.form2.antiplatelet1.checked = false;
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="6">
                        <table width="100%">
                            <tr>
                                <td><b style="font-weight:bold; font-size: 22px; text-decoration: underline;">EYE screening</b>&nbsp;&nbsp;VA</td>
                                <td>R <input type="text" name="esr" id="esr" value="<?=$eye['esr'];?>"></td>
                                <td>PH <input type="text" name="esr_ph" id="esr_ph" value="<?=$eye['esr_ph'];?>"></td>
                                <td>with glass <input type="text" name="esr_glass" id="esr_glass" value="<?=$eye['esr_glass'];?>"></td>
                                <td>NOT <input type="text" name="esr_not" id="esr_not" value="<?=$eye['esr_not'];?>"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>L <input type="text" name="esl" id="esl" value="<?=$eye['esl'];?>"></td>
                                <td>PH <input type="text" name="esl_ph" id="esl_ph" value="<?=$eye['esl_ph'];?>"></td>
                                <td>with glass <input type="text" name="esl_glass" id="esl_glass" value="<?=$eye['esl_glass'];?>"></td>
                                <td>NOT <input type="text" name="esl_not" id="esl_not" value="<?=$eye['esl_not'];?>"></td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="6" style="font-weight:bold; font-size: 22px; text-decoration: underline;">ข้อวินิจฉัยทางการพยาบาล Nursing DX:</td>
                </tr>
                <tr>
                    <td colspan="6">
                        <?php 
                        $nurse_dx1 = (!empty($eye['nurse_dx1'])) ? 'checked="checked"' : '' ;
                        $nurse_dx2 = (!empty($eye['nurse_dx2'])) ? 'checked="checked"' : '' ;
                        $nurse_dx3 = (!empty($eye['nurse_dx3'])) ? 'checked="checked"' : '' ;
                        $nurse_dx4 = (!empty($eye['nurse_dx4'])) ? 'checked="checked"' : '' ;
                        $nurse_dx5 = (!empty($eye['nurse_dx5'])) ? 'checked="checked"' : '' ;
                        $nurse_dx6 = (!empty($eye['nurse_dx6'])) ? 'checked="checked"' : '' ;
                        $nurse_dx7 = (!empty($eye['nurse_dx7'])) ? 'checked="checked"' : '' ;
                        $nurse_dx8 = (!empty($eye['nurse_dx8'])) ? 'checked="checked"' : '' ;
                        $nurse_dx10 = (!empty($eye['nurse_dx10'])) ? 'checked="checked"' : '' ;
                        
                        /**
                         * 2566-02-09 หน้างานปรับฟอร์มใหม่ขอยกเลิกฟิลด์ nurse_dx3_txt, nurse_dx2_txt
                         */
                        ?>
                        <table style="min-width: 800px;">
                            <tr>
                                <td><input type="checkbox" name="nurse_dx1" id="nurse_dx1" value="มีโอกาส/เสี่ยงต่อการเกิดภาวะแทรกซ้อนของโรค" <?=$nurse_dx1;?> > <label for="nurse_dx1">มีโอกาส/เสี่ยงต่อการเกิดภาวะแทรกซ้อนของโรค</label><input type="text" name="nurse_dx1_txt" id="nurse_dx1_txt" value="<?=$eye['nurse_dx1_txt'];?>" ></td>
                                <td><input type="checkbox" name="nurse_dx2" id="nurse_dx2" value="มีโอกาส/เสี่ยงต่อการเกิดภาวะแทรกซ้อนของโรควุ้นน้ำลูกตาเสื่อม" <?=$nurse_dx2;?>> <label for="nurse_dx2">มีโอกาส/เสี่ยงต่อการเกิดภาวะแทรกซ้อนของโรควุ้นน้ำลูกตาเสื่อม</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="nurse_dx3" id="nurse_dx3" value="ต้องการความรู้/การปรึกษาเรื่องการปฏิบัติตัวหลังlaser / การหยอดยาหดม่านตา หรือยาขยายม่านตา" <?=$nurse_dx3;?>> <label for="nurse_dx3">ต้องการความรู้/การปรึกษาเรื่องการปฏิบัติตัวหลังlaser / การหยอดยาหดม่านตา หรือยาขยายม่านตา</label></td>
                                <td><input type="checkbox" name="nurse_dx4" id="nurse_dx4" value="ไม่สุขสบาย: ปวด, เคืองตา, แสบตา" <?=$nurse_dx4;?>> <label for="nurse_dx4">ไม่สุขสบาย: ปวด, เคืองตา, แสบตา</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="nurse_dx5" id="nurse_dx5" value="เสี่ยงต่อการเกิดอุบัติเหตุ เนื่องจากการมองเห็นลดลง" <?=$nurse_dx5;?>> <label for="nurse_dx5">เสี่ยงต่อการเกิดอุบัติเหตุ เนื่องจากการมองเห็นลดลง</label></td>
                                <td><input type="checkbox" name="nurse_dx6" id="nurse_dx6" value="เสี่ยงต่อการเกิดอุบัติเหตุ จากตาสู้แสงจ้าไม่ได้ ตาพร่ามัว" <?=$nurse_dx6;?>> <label for="nurse_dx6">เสี่ยงต่อการเกิดอุบัติเหตุ จากตาสู้แสงจ้าไม่ได้ ตาพร่ามัว</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="nurse_dx7" id="nurse_dx7" value="เสี่ยงต่อการเกิดอุบัติเหตุ เนื่องจากตาพร่ามัว จากการได้รับยาหยอดขยายม่านตา" <?=$nurse_dx7;?>> <label for="nurse_dx7">เสี่ยงต่อการเกิดอุบัติเหตุ เนื่องจากตาพร่ามัว จากการได้รับยาหยอดขยายม่านตา</label></td>
                                <td><input type="checkbox" name="nurse_dx8" id="nurse_dx8" value="ผป.มีความวิตกกังวลเกี่ยวกับอาการที่มารพ." <?=$nurse_dx8;?>> <label for="nurse_dx8">ผป.มีความวิตกกังวลเกี่ยวกับอาการที่มารพ.</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="nurse_dx9_txt" id="nurse_dx9_txt" value="<?=$eye['nurse_dx9_txt'];?>" size="50"></td>
                                <td><input type="checkbox" name="nurse_dx10" id="nurse_dx10" value="เสี่ยงต่อการเกิดอุบัติเหตุ เนื่องจาก ผป.สูงอายุ" <?=$nurse_dx10;?> ><label for="nurse_dx10">เสี่ยงต่อการเกิดอุบัติเหตุ เนื่องจาก ผป.สูงอายุ</label></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <script type="text/javascript">
                    document.getElementById('nurse_dx1').onclick = function(){
                        if(this.checked==true){
                            document.getElementById('nurse_dx1_txt').focus();
                        }else{
                            document.getElementById('nurse_dx1_txt').value = '';
                        }
                    };
                </script>

                <tr>
                    <td colspan="6" style="font-weight:bold; font-size: 22px; text-decoration: underline;"><b>การพยาบาลและการประเมินผล Implementation</b></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <?php 
                        $imp1 = (!empty($eye['imp1'])) ? 'checked="checked"' : '' ;
                        $imp2 = (!empty($eye['imp2'])) ? 'checked="checked"' : '' ;
                        $imp3 = (!empty($eye['imp3'])) ? 'checked="checked"' : '' ;
                        $imp4 = (!empty($eye['imp4'])) ? 'checked="checked"' : '' ;
                        $imp5 = (!empty($eye['imp5'])) ? 'checked="checked"' : '' ;
                        $imp6 = (!empty($eye['imp6'])) ? 'checked="checked"' : '' ;
                        $imp7 = (!empty($eye['imp7'])) ? 'checked="checked"' : '' ;
                        $imp8 = (!empty($eye['imp8'])) ? 'checked="checked"' : '' ;
                        $imp9 = (!empty($eye['imp9'])) ? 'checked="checked"' : '' ;
                        $imp10 = (!empty($eye['imp10'])) ? 'checked="checked"' : '' ;
                        $imp11 = (!empty($eye['imp11'])) ? 'checked="checked"' : '' ;
                        $imp12 = (!empty($eye['imp12'])) ? 'checked="checked"' : '' ;
                        ?>
                        <table>
                            <tr>
                                <td colspan="2"><input type="checkbox" name="imp1" id="imp1" value="เฝ้าระวังการเกิด fall, แนะนำการระมัดระวังพลัดตกหกล้มต่อที่บ้าน" <?=$imp1;?> ><label for="imp1">เฝ้าระวังการเกิด fall, แนะนำการระมัดระวังพลัดตกหกล้มต่อที่บ้าน</label></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="checkbox" name="imp2" id="imp2" value="ให้ความรู้/การปรึกษาเรื่อง" <?=$imp2;?>><label for="imp2">ให้ความรู้/การปรึกษาเรื่อง</label><input type="text" name="imp2_txt" id="imp2_txt" value="<?=$eye['imp2_txt'];?>"></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="imp3" id="imp3" value="แนะนำวิธีการใช้ยาตามแผนการรักษาของแพทย์" <?=$imp3;?>><label for="imp3">แนะนำวิธีการใช้ยาตามแผนการรักษาของแพทย์</label></td>
                                <td><input type="checkbox" name="imp4" id="imp4" value="เฝ้าระวังการเปลี่ยนแปลงขณะรอ Laser / หลังหยอดยาหดม่านตา หรือ ขยายม่านตา" <?=$imp4;?>><label for="imp4">เฝ้าระวังการเปลี่ยนแปลงขณะรอ Laser / หลังหยอดยาหดม่านตา หรือ ขยายม่านตา</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="imp5" id="imp5" value="ให้ความรู้/การปรึกษาเรื่องการทำความสะอาดเปลือกตา หลีกเลี่ยงการขยี้ตา Cold/Warm compression" <?=$imp5;?>><label for="imp5">ให้ความรู้/การปรึกษาเรื่องการทำความสะอาดเปลือกตา หลีกเลี่ยงการขยี้ตา Cold/Warm compression</label></td>
                                <td><input type="checkbox" name="imp6" id="imp6" value="บรรเทาอาการเจ็บปวด ดูแล" <?=$imp6;?>><label for="imp6">บรรเทาอาการเจ็บปวด ดูแล</label><input type="text" name="imp6_txt" id="imp6_txt" value="<?=$eye['imp6_txt'];?>"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="checkbox" name="imp7" id="imp7" value="ให้ความรู้/การปรึกษาเรื่องการแยกของใช้ร่วมกับคนอื่นในบ้าน ล้างมือให้สะอาด แนะนำ Airborne-Contact Precaution" <?=$imp7;?>><label for="imp7">ให้ความรู้/การปรึกษาเรื่องการแยกของใช้ร่วมกับคนอื่นในบ้าน ล้างมือให้สะอาด แนะนำ Airborne-Contact Precaution</label></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="checkbox" name="imp8" id="imp8" value="ให้ความรู้/การปรึกษาเรื่อง absolute bed rest, นอนศรีษะสูง HOB 30-45 องศา" <?=$imp8;?>><label for="imp8">ให้ความรู้/การปรึกษาเรื่อง absolute bed rest, นอนศรีษะสูง HOB 30-45 องศา</label></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="checkbox" name="imp9" id="imp9" value="ให้ความรู้/การปรึกษาเรื่อง การเตรียมตัวผ่าตัดต้อกระจก" <?=$imp9;?>><label for="imp9">ให้ความรู้/การปรึกษาเรื่อง การเตรียมตัวผ่าตัดต้อกระจก</label></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="checkbox" name="imp10" id="imp10" value="ให้ความรู้/การปรึกษาเรื่องการกระพริบตา พักสายตาเป็นระยะๆ ใช้แว่นกรองแสง" <?=$imp10;?>><label for="imp10">ให้ความรู้/การปรึกษาเรื่องการกระพริบตา พักสายตาเป็นระยะๆ ใช้แว่นกรองแสง</label></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="checkbox" name="imp11" id="imp11" value="ให้ความรู้/การปรึกษาเรื่องตาพร่ามัว หลังหยอดยาขยายม่านตา 4-6 ชม. อาการตาพร่ามัวจะดีขึ้นเมื่อหมดฤทธิ์ยาหลีกเลี่ยงการขับรถ" <?=$imp11;?>><label for="imp11">ให้ความรู้/การปรึกษาเรื่องตาพร่ามัว หลังหยอดยาขยายม่านตา 4-6 ชม. อาการตาพร่ามัวจะดีขึ้นเมื่อหมดฤทธิ์ยาหลีกเลี่ยงการขับรถ</label></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="checkbox" name="imp12" id="imp12" value="หลีกเลี่ยงการขยี้ตา เลี่ยงการกลอกตา" <?=$imp12;?>><label for="imp12">หลีกเลี่ยงการขยี้ตา เลี่ยงการกลอกตา</label></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="text" name="imp13_txt" id="imp13_txt" value="<?=$eye['imp13_txt'];?>" size="50"></td>
                            </tr>
                            
                        </table>
                        <script type="text/javascript">
                            document.getElementById('imp2').addEventListener('click', function () {
                                if(this.checked==true){
                                    document.getElementById('imp2_txt').focus();
                                }else{
                                    document.getElementById('imp2_txt').value = '';
                                }
                            }, false);

                            document.getElementById('imp6').onclick = function(){
                                if(this.checked==true){
                                    document.getElementById('imp6_txt').focus();
                                }else{
                                    document.getElementById('imp6_txt').value = '';
                                }
                            };
                        </script>
                    </td>
                </tr>

                <tr>
                    <td colspan="6" style="font-weight:bold; font-size: 22px; text-decoration: underline;"><b>Evaluation</b></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <?php 
                        $eva1 = (!empty($eye['eva1'])) ? 'checked="checked"' : '' ;
                        $eva2 = (!empty($eye['eva2'])) ? 'checked="checked"' : '' ;
                        $eva3 = (!empty($eye['eva3'])) ? 'checked="checked"' : '' ;
                        $eva4 = (!empty($eye['eva4'])) ? 'checked="checked"' : '' ;
                        $eva5 = (!empty($eye['eva5'])) ? 'checked="checked"' : '' ;
                        $eva6 = (!empty($eye['eva6'])) ? 'checked="checked"' : '' ;
                        $eva7 = (!empty($eye['eva7'])) ? 'checked="checked"' : '' ;
                        $eva8 = (!empty($eye['eva8'])) ? 'checked="checked"' : '' ;
                        $eva9 = (!empty($eye['eva9'])) ? 'checked="checked"' : '' ;
                        $eva10 = (!empty($eye['eva10'])) ? 'checked="checked"' : '' ;
                        $eva11 = (!empty($eye['eva11'])) ? 'checked="checked"' : '' ;
                        $eva12 = (!empty($eye['eva12'])) ? 'checked="checked"' : '' ;
                        $eva13 = (!empty($eye['eva13'])) ? 'checked="checked"' : '' ;
                        $eva14 = (!empty($eye['eva14'])) ? 'checked="checked"' : '' ;
                        $eva15 = (!empty($eye['eva15'])) ? 'checked="checked"' : '' ;
                        $eva16 = (!empty($eye['eva16'])) ? 'checked="checked"' : '' ;
                        $eva17 = (!empty($eye['eva17'])) ? 'checked="checked"' : '' ;
                        $eva18 = (!empty($eye['eva18'])) ? 'checked="checked"' : '' ;
                        ?>
                        <table>
                            
                            <tr>
                                <td><input type="checkbox" name="eva1" id="eva1" value="ผู้ป่วยมีความรู้เรื่องโรคที่เป็น ผป.คลายความวิตกกังวล" <?=$eva1;?> > <label for="eva1">ผู้ป่วยมีความรู้เรื่องโรคที่เป็น ผป.คลายความวิตกกังวล</label></td>
                            </tr>

                            <tr>
                                <td><input type="checkbox" name="eva2" id="eva2" value="ให้คำแนะนำตาม D METHOD" <?=$eva2;?>> <label for="eva2">ให้คำแนะนำตาม D METHOD</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="eva3" id="eva3" value="ไม่เกิดอุบัติเหตุพลัดตกหกล้มขณะรอตรวจ" <?=$eva3;?>> <label for="eva3">ไม่เกิดอุบัติเหตุพลัดตกหกล้มขณะรอตรวจ</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="eva4" id="eva4" value="สังเกตอาการผิดปกติ ถ้าตาแดงมากขึ้น ปวดตามาก น้ำตาไหล การมองเห็นลดลงให้มาพบแพทย์" <?=$eva4;?>> <label for="eva4">สังเกตอาการผิดปกติ ถ้าตาแดงมากขึ้น ปวดตามาก น้ำตาไหล การมองเห็นลดลงให้มาพบแพทย์</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="eva5" id="eva5" value="เน้นย้ำการมาตรวจตามนัด" <?=$eva5;?>> <label for="eva5">เน้นย้ำการมาตรวจตามนัด</label> <input type="checkbox" name="eva6" id="eva6" value="รักษาตามสิทธิ" <?=$eva6;?>><label for="eva6">รักษาตามสิทธิ</label> <input type="checkbox" name="eva7" id="eva7" value="ส่งตัวรักษาต่อ" <?=$eva7;?>><label for="eva7">ส่งตัวรักษาต่อ</label> <input type="checkbox" name="eva8" id="eva8" value="ไม่นัด" <?=$eva8;?>><label for="eva8">ไม่นัด</label> <input type="checkbox" name="eva9" id="eva9" value="ทานยาและหยอดยาตามแผนการักษา" <?=$eva9;?>><label for="eva9">ทานยาและหยอดยาตามแผนการักษา</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="eva11" id="eva11" value="ประเมิน PS" <?=$eva11;?> > <label for="eva11">ประเมิน PS</label><input type="text" name="eva11_txt" id="eva11_txt" value="<?=$eye['eva11_txt'];?>"></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="eva12" id="eva12" value="ผป./ญาติ ทราบวิธีการปฏิบัติตัวตามคำแนะนำตามโรคที่เป็น ไม่เกิดภาวะแทรกซ้อนของโรค" <?=$eva12;?> > <label for="eva12">ผป./ญาติ ทราบวิธีการปฏิบัติตัวตามคำแนะนำตามโรคที่เป็น ไม่เกิดภาวะแทรกซ้อนของโรค</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="eva13" id="eva13" value="ไม่เกิดภาวะแทรกซ้อนหลัง laser" <?=$eva13;?> > <label for="eva13">ไม่เกิดภาวะแทรกซ้อนหลัง laser</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="eva14" id="eva14" value="ไม่เกิดภาวะแทรกซ้อนหลังหยอดยาขยายม่านตา" <?=$eva14;?> > <label for="eva14">ไม่เกิดภาวะแทรกซ้อนหลังหยอดยาขยายม่านตา</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="eva15" id="eva15" value="ผป./ญาติ ทราบวิธีการพักสายตาที่ถูกต้อง ใช้แว่นกรองแสงเมื่อออกที่แจ้ง" <?=$eva15;?> > <label for="eva15">ผป./ญาติ ทราบวิธีการพักสายตาที่ถูกต้อง ใช้แว่นกรองแสงเมื่อออกที่แจ้ง</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="eva16" id="eva16" value="ผป./ญาติ ทราบวิธีการใช้ยาตามแผนการรักษาของแพทย์" <?=$eva16;?> > <label for="eva16">ผป./ญาติ ทราบวิธีการใช้ยาตามแผนการรักษาของแพทย์</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="eva17" id="eva17" value="ผป./ญาติ ทราบวิธีการปฏิบัติหลังผ่าตัด" <?=$eva17;?> > <label for="eva17">ผป./ญาติ ทราบวิธีการปฏิบัติหลังผ่าตัด</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="eva10" id="eva10" value="อื่นๆ" <?=$eva10;?>> <label for="eva10">อื่นๆ</label> <input type="text" name="eva10_txt" id="eva10_txt" value="<?=$eye['eva10_txt'];?>"></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="eva18" id="eva18" value="ผู้ป่วย/ญาติ รับทราบและปฏิบัติได้" <?=$eva18;?> ><label for="eva18"> ผู้ป่วย/ญาติ รับทราบและปฏิบัติได้</label>, <span><?=$_SESSION['sOfficer'];?></span> /RN ผู้ให้คำแนะนำ
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <script type="text/javascript">
                    document.getElementById('eva10').onclick = function(){
                        if(this.checked==true){
                            document.getElementById('eva10_txt').focus();
                        }else{
                            document.getElementById('eva10_txt').value = '';
                        }
                    };
                    document.getElementById('eva11').onclick = function(){
                        if(this.checked==true){
                            document.getElementById('eva11_txt').focus();
                        }else{
                            document.getElementById('eva11_txt').value = '';
                        }
                    };
                </script>
            </table>

        </fieldset>
    </td>
</tr>