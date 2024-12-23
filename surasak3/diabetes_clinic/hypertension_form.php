<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<script src="../js/sweetalert2.all.min.js"></script>
<FORM METHOD="post" action="<?=$urlCallBack;?>" name="F1" style="margin-top:8px;" onsubmit="return checkForm()">
    <TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" style="min-width:800px;">
        <TR>
            <TD>
                <TABLE border="0" cellpadding="0" cellspacing="0" width="100%">
                    <TR>
                        <TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;ข้อมูลผู้ป่วย</span></TD>
                    </TR>
                    <TR>
                        <TD>
                            <table border="0" width="100%">
                                <tr>
                                    <td align="right" class="tb_font_2">วันที่บันทึก</td>
                                    <td colspan="3">
                                        <span class="data_show">
                                            <input name="thaidate" type="text" class="forntsarabun1" id="thaidate" value="<?=date("Y-m-d"); ?>" />
                                            <span class="tb_font_2">// รูปแบบ ปี ค.ศ.-เดือน-วัน</span>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" class="tb_font_2">HT number :</td>
                                    <td>
                                        <span class="data_show">
                                            <input name="ht_no" type="text" class="forntsarabun1" id="ht_no" value="<?=$ht_no; ?>" readonly/>
                                        </span>
                                    </td>
                                    <td align="right"><span class="tb_font_2">HN :</span></td>
                                    <td align="left" class="forntsarabun1">
                                        <?=$arr_view["hn"]; ?>
                                        <input name="hn" type="hidden" id="hn" value="<?=$arr_view["hn"]; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><span class="tb_font_2">ชื่อ-สกุล : </span></td>
                                    <td class="forntsarabun1">
                                        <?=$arr_view["ptname"]; ?>
                                        <input name="ptname" type="hidden" id="ptname" value="<?=$arr_view["ptname"]; ?>" />
                                    </td>
                                    <td align="right" class="tb_font_2">อายุ :</td>
                                    <td align="left" class="forntsarabun1">
                                        <?=$arr_view["age"]; ?>
                                        <input name="age" type="hidden" id="age" value="<?=$arr_view["age"]; ?>" />
                                        <input name="dbirth" type="hidden" id="dbirth" value="<?=$arr_view["dbirth"]; ?>" />
                                    </td>
                                </tr>
                                <tr class="forntsarabun1">
                                    <td align="right" class="tb_font_2">เพศ :</td>
                                    <td>
                                        <?php
                                        if ($arr_view['sex'] == 'ช') {
                                            $sex1 = "checked";
                                        } elseif ($arr_view['sex'] == 'ญ') {
                                            $sex2 = "checked";
                                        }
                                        ?>
                                        <label for="sex1"><input id="sex1" name="sex" type="radio" value="0" <?=$sex1;?> />ชาย</label>
                                        <label for="sex2"><input id="sex2" name="sex" type="radio" value="1" <?=$sex2;?> />หญิง</label>
                                    </td>
                                    <td align="right" class="tb_font_2">&nbsp;</td>
                                    <td align="left">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right" class="tb_font_2">แพทย์ :</td>
                                    <td><select name="doctor" id="doctor" class="forntsarabun1">
                                            <?php
                                            echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
                                            $sql = "Select name From doctor where status = 'y' ";
                                            $result = mysql_query($sql);
                                            while ($dbarr2 = mysql_fetch_array($result)) {

                                                $sub1 = substr($arr_opd['doctor'], 0, 5);
                                                $sub2 = substr($dbarr2['name'], 0, 5);

                                                if ($dbarr2['name'] == $arr_opd['doctor']) {
                                                    echo "<option value='" . $dbarr2['name'] . "'  selected>" . $dbarr2['name'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $dbarr2['name'] . "' >" . $dbarr2['name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td align="right" class="tb_font_2">สิทธิ :</td>
                                    <td align="left" class="forntsarabun1">
                                        <?=$arr_view["ptright"]; ?>
                                        <input name="ptright" type="hidden" id="ptright" value="<?=$arr_view["ptright"]; ?>" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" bgcolor="#0000CC" class="forntsarabun" colspan="12">&nbsp;&nbsp;&nbsp;<b>การตรวจร่างกาย</b> (ข้อมูลซักประวัติเมื่อ <?=$arr_opd['thidate'];?>)</td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            $ht = $height / 100;
                            $bmi = number_format($weight / ($ht * $ht), 2);
                            ?>
                            <table border="0" class="forntsarabun1">
                                <tr>
                                    <td width="70" align="right" class="tb_font_2">ส่วนสูง : </td>
                                    <td>
                                        <input id="height" name="height" type="text" class="forntsarabun1" value="<?=$height; ?>" size="3" maxlength="5" onBlur="calbmi(this.value,document.F1.weight.value)" /> ซม.
                                    </td>
                                    <td width="70" align="right" class="tb_font_2">น้ำหนัก : </td>
                                    <td>
                                        <input id="weight" name="weight" type="text" class="forntsarabun1" value="<?=$weight; ?>" size="3" maxlength="5" onBlur="calbmi(document.F1.height.value,this.value)" /> กก.
                                    </td>
                                    <td width="70" align="right" class="tb_font_2">BMI :</td>
                                    <td width="70" class="tb_font_2">
                                        <input name="bmi" type="text" size="3" value="<?=$bmi; ?>" class="forntsarabun1" />
                                    </td>
                                    <td width="70" class="tb_font_2">&nbsp;</td>
                                    <td align="right"><span class="tb_font_2">รอบเอว : </span></td>
                                    <td>
                                        <input name="round" type="text" class="forntsarabun1" id="round" value="<?=$arr_opd["round"]; ?>" size="1" maxlength="5" /> ซม.
                                    </td>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right" class="tb_font_2">T : </td>
                                    <td>
                                        <input name="temperature" id="temperature" type="text" size="1" maxlength="5" value="<?=$arr_opd["temperature"]; ?>" class="forntsarabun1" /> C&deg;
                                    </td>
                                    <td align="right" class="tb_font_2">P : </td>
                                    <td>
                                        <input name="pause" id="pause" type="text" size="1" maxlength="3" value="<?=$arr_opd["pause"]; ?>" class="forntsarabun1" /> ครั้ง/นาที
                                    </td>
                                    <td align="right" class="tb_font_2">R :</td>
                                    <td class="" colspan="2">
                                        <input name="rate" id="rate" type="text" size="1" maxlength="3" value="<?=$arr_opd["rate"]; ?>" class="forntsarabun1" /> ครั้ง/นาที
                                    </td>
                                    <td align="right"><span class="tb_font_2">BP :</span></td>
                                    <td>
                                        <input name="bp1" id="bp1" type="text" size="1" maxlength="3" value="<?=$arr_opd["bp1"]; ?>" class="forntsarabun1" /> / <input name="bp2" id="bp2" type="text" size="1" maxlength="3" value="<?=$arr_opd["bp2"]; ?>" class="forntsarabun1" /> mmHg
                                    </td>
                                    <td>&nbsp;</td>
                                    <td class="tb_font_2">&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="right" class="tb_font_2">Repeat BP : </td>
                                    <td>
                                        <input name="bp3" type="text" size="1" maxlength="3" value="<?=$arr_opd["bp3"]; ?>" class="forntsarabun1" /> / <input name="bp4" type="text" size="1" maxlength="3" value="<?=$arr_opd["bp4"]; ?>" class="forntsarabun1" /> mmHg
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                            <table class="forntsarabun1" width="100%">
                                <tr>
                                    <td align="right" class="tb_font_2">การวินิจฉัย : </td>
                                    <td colspan="5" align="left" class="forntsarabun1">
                                        <label for="ht1"><input id="ht1" name="ht" type="radio" value="0" <?php if ($arr_opd["ht"] == 0) {echo "checked";} ?> /> No</label>
                                        <label for="ht2"><input id="ht2" name="ht" type="radio" value="1" <?php if ($arr_opd["ht"] == 1) {echo "checked";} ?> /> Essential HT</label>
                                        <label for="ht3"><input id="ht3" name="ht" type="radio" value="2" <?php if ($arr_opd["ht"] == 2) {echo "checked";} ?> /> Secondary HT</label>
                                        <label for="ht4"><input id="ht4" name="ht" type="radio" value="3" <?php if ($arr_opd["ht"] == 3) {echo "checked";} ?> /> Uncertain type</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" class="tb_font_2"></td>
                                    <td>
                                        <style>
                                            #getYearDiag {
                                                background-color: #ffffff;
                                            }

                                            .htDateSelectContainer {
                                                position: absolute;
                                                top: 28px;
                                                right: 0;
                                                background-color: #ffffff;
                                                border: 2px solid #000000;
                                                box-shadow: 5px 10px #888888;
                                            }
                                        </style>
                                        การวินิจฉัยครั้งแรกประมาณ พ.ศ. <input type="text" name="diag_date" id="diag_date" value="<?=$arr_opd['diag_date'];?>">
                                        <span><a href="javascript:void(0);" onclick="getYearDiag()">เลือกปี</a></span>
                                        <div id="getYearDiagContainer" class="" style="position:relative; display:none;">
                                            <div id="getYearDiag" class="htDateSelectContainer" style="z-index:1;"></div>
                                        </div>
                                        <script>
                                            function getYearDiag() {
                                                callYearDiag().then((res) => {
                                                    console.log(res);
                                                    document.getElementById('getYearDiag').innerHTML = res;
                                                    document.getElementById('getYearDiagContainer').style.display = '';
                                                });
                                            }
                                            async function callYearDiag() {
                                                const response = await fetch('../call/diag.php?action=getFirstI10FromHn&hn=<?= $hn; ?>');
                                                const data = await response.text();
                                                return data;
                                            }
                                        </script>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" class="tb_font_2">โรคร่วม HT :</td>
                                    <td colspan="5" align="left" class="forntsarabun1">
                                        <label for="joint1"><input id="joint1" name="joint_disease_dm" type="checkbox" value="Y" <?php if ($arr_opd["joint_disease_dm"] == "Y") {echo "checked"; } ?> /> เบาหวาน</label>
                                        <label for="joint2"><input id="joint2" name="joint_disease_nephritic" type="checkbox" value="Y" <?php if ($arr_opd["joint_disease_nephritic"] == "Y") {echo "checked"; } ?> /> ไตเรื้อรัง</label>
                                        <label for="joint3"><input id="joint3" name="joint_disease_myocardial" type="checkbox" value="Y" <?php if ($arr_opd["joint_disease_myocardial"] == "Y") {echo "checked"; } ?> /> กล้ามเนื้อหัวใจตาย</label>
                                        <label for="joint4"><input id="joint4" name="joint_disease_paralysis" type="checkbox" value="Y" <?php if ($arr_opd["joint_disease_paralysis"] == "Y") {echo "checked"; } ?> /> อัมพฤกษ์อัมพาต</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" class="tb_font_2"> ประวัติบุหรี่ : </td>
                                    <td colspan="5">
                                        <label for="cig1"><input type="radio" id="cig1" name="cigarette" value="0" <?php if ($cigarette == 0) {echo "checked";} ?> > ไม่สูบบุหรี่</label>
                                        <label for="cig2"><input type="radio" id="cig2" name="cigarette" value="1" <?php if ($cigarette == 1) {echo "checked";} ?> > สูบบุหรี่</label>
                                        <label for="cig3"><input type="radio" id="cig3" name="cigarette" value="2" <?php if ($cigarette == 2) {echo "checked";} ?> > NA</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" class="tb_font_2"><strong class="tb_font_2">ได้รับการตรวจ ECG หรือ CXR : </strong></td>
                                    <td>
                                        <?php 
                                        $checkedEcg0 = $arr_opd['ecgCxr']=='0' ? 'checked="checked"' : '' ;
                                        $checkedEcg1 = $arr_opd['ecgCxr']=='1' ? 'checked="checked"' : '' ;
                                        ?>
                                        <input type="radio" name="ecgCxr" id="ecgCxr1" value="1" onclick="activeEcgCxrContain(this.value)" <?=$checkedEcg1;?> > <label for="ecgCxr1">ได้รับการตรวจ</label>&nbsp;&nbsp;
                                        <input type="radio" name="ecgCxr" id="ecgCxr2" value="0" onclick="activeEcgCxrContain(this.value)" <?=$checkedEcg0;?> > <label for="ecgCxr2">ไม่ได้ตรวจ</label>
                                    </td>
                                </tr>
                                <?php 
                                $ecgDateDisplay = 'display:none;';
                                if($arr_opd['ecgCxr']=='1'){
                                    $ecgDateDisplay = '';
                                }
                                ?>
                                <tr id="ecgCxrContain" style="<?=$ecgDateDisplay;?>">
                                    <td></td>
                                    <td>
                                        <div style="position:relative;">
                                            <input type="text" name="dateEcgCxr" id="dateEcgCxr" value="<?=$arr_opd['dateEcgCxr'];?>" > <a href="javascript:void(0);" onclick="showDateSelected()">เลือกวันที่รับบริการ</a>
                                            <div id="landingDateSelected" style="display:none;position: absolute;top: 28px;right: 0;background-color: #ffffff;border: 2px solid #000000;box-shadow: 5px 10px #888888;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" class="tb_font_2"><strong class="tb_font_2">ได้รับการตรวจ Urine albumin : </strong></td>
                                    <td>
                                        <?php 
                                        $checkedAlbumin0 = $arr_opd['albumin']=='0' ? 'checked="checked"' : '' ;
                                        $checkedAlbumin1 = $arr_opd['albumin']=='1' ? 'checked="checked"' : '' ;
                                        ?>
                                        <input type="radio" name="albumin" id="albumin1" value="1" onclick="activeAlbuminContain(this.value)" <?=$checkedAlbumin1;?> > <label for="albumin1">ได้รับการตรวจ</label>&nbsp;&nbsp;
                                        <input type="radio" name="albumin" id="albumin2" value="0" onclick="activeAlbuminContain(this.value)" <?=$checkedAlbumin0;?> > <label for="albumin2">ไม่ได้ตรวจ</label>
                                    </td>
                                </tr>
                                <?php 
                                $dateAlbuminDisplay = 'display:none;';
                                if($arr_opd['albumin']=='1'){
                                    $dateAlbuminDisplay = '';
                                }
                                ?>
                                <tr id="albuminContain" style="<?=$dateAlbuminDisplay;?>">
                                    <td></td>
                                    <td>
                                        <div style="position:relative;">
                                            <input type="text" name="dateAlbumin" id="dateAlbumin" value="<?=$arr_opd['dateAlbumin'];?>" > <a href="javascript:void(0);" onclick="showDateAlbumin()">เลือกวันที่ตรวจ</a>
                                            <input type="hidden" name="albuminLabnumber" id="albuminLabnumber">
                                            <div id="landingDateAlbumin" style="display:none;position: absolute;top: 28px;right: 0;background-color: #ffffff;border: 2px solid #000000;box-shadow: 5px 10px #888888;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" class="tb_font_2"><strong class="tb_font_2">ได้รับการตรวจ Serum Cr. : </strong></td>
                                    <td>
                                        <?php 
                                        $checkedCreatinine0 = $arr_opd['creatinine']=='0' ? 'checked="checked"' : '' ;
                                        $checkedCreatinine1 = $arr_opd['creatinine']=='1' ? 'checked="checked"' : '' ;
                                        ?>
                                        <input type="radio" name="creatinine" id="creatinine1" value="1" onclick="activeCreatinineContain(this.value)" <?=$checkedCreatinine1;?>> <label for="creatinine1">ได้รับการตรวจ</label>&nbsp;&nbsp;
                                        <input type="radio" name="creatinine" id="creatinine2" value="0" onclick="activeCreatinineContain(this.value)" <?=$checkedCreatinine0;?>> <label for="creatinine2">ไม่ได้ตรวจ</label>
                                    </td>
                                </tr>
                                <?php 
                                $dateCreatinineDisplay = 'display:none;';
                                if($arr_opd['creatinine']=='1'){
                                    $dateCreatinineDisplay = '';
                                }
                                ?>
                                <tr id="creatinineContain" style="<?=$dateCreatinineDisplay;?>">
                                    <td></td>
                                    <td>
                                        <div style="position:relative;">
                                            <input type="text" name="dateCreatinine" id="dateCreatinine" value="<?=$arr_opd['dateCreatinine'];?>"> <a href="javascript:void(0);" onclick="showDateCreatinine()">เลือกวันที่รับบริการ</a>
                                            <input type="hidden" name="creatinineLabnumber" id="creatinineLabnumber">
                                            <div id="landingDateCreatinine" style="display:none;position: absolute;top: 28px;right: 0;background-color: #ffffff;border: 2px solid #000000;box-shadow: 5px 10px #888888;">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="min-width:800px; text-align:center;">
        <tr>
            <td>
                <input name="submit" type="submit" class="forntsarabun1" value="บันทึกข้อมูล" style="padding:8px;"/>
                <input type="hidden" value="<?=$arr_opd["row_id"];?>" name="row_id" />
                <input type="hidden" name="do" value="<?=$do;?>">
                <input type="hidden" name="hypertention_edit_id" value="<?=$hypertention_edit_id;?>">
            </td>
        </tr>
    <table>
</FORM>
<div style="margin: 8px;">&nbsp;</div>
<script type="text/javascript">
    function calbmi(a, b) {
        var h = a / 100;
        var bmi = b / (h * h);
        document.F1.bmi.value = bmi.toFixed(2);
    }
    
    function checkForm(){
        let dt =document.getElementById('doctor').value;
        let weight = document.getElementById('weight').value;
        let height = document.getElementById('height').value;
        let temperature = document.getElementById('temperature').value;
        let pause = document.getElementById('pause').value;
        let rate = document.getElementById('rate').value;
        let bp1 = document.getElementById('bp1').value;
        let bp2 = document.getElementById('bp2').value;
        
        if(dt==''){
            Swal.fire("กรุณาเลือกแพทย์");
            return false;
        }else if(height==''){
            Swal.fire("กรุณาใส่ข้อมูลส่วนสูง");
            return false;
        }else if(weight==''){
            Swal.fire("กรุณาใส่ข้อมูลน้ำหนัก");
            return false;
        }else if(temperature==''){
            Swal.fire("กรุณาใส่ข้อมูลอุณหภูมิ");
            return false;
        }else if(pause==''){
            Swal.fire("กรุณาใส่ข้อมูลอัตราการเต้นของหัวใจ");
            return false;
        }else if(rate==''){
            Swal.fire("กรุณาใส่ข้อมูลอัตราการหายใจ");
            return false;
        }else if(bp1==''){
            Swal.fire("กรุณาใส่ข้อมูลค่าหัวใจบีบตัว");
            return false;
        }else if(bp2==''){
            Swal.fire("กรุณาใส่ข้อมูลค่าหัวใจคลายตัว");
            return false;
        }

        let ecgCxrChecked = document.getElementById('ecgCxr1').checked;
        if(ecgCxrChecked==true){
            
            let dateEcgCxr = document.getElementById('dateEcgCxr');
            if(dateEcgCxr.value==''){
                Swal.fire({title: "กรุณาระบุวันที่ในการตรวจ ECG/CXR ด้วยครับ", didClose: handleOnFocus('dateEcgCxr')});
                return false;
            }
        }

        let ecgCxrChecked = document.getElementById('ecgCxr1').checked;
        if(ecgCxrChecked==true){
            
            let dateEcgCxr = document.getElementById('dateEcgCxr');
            if(dateEcgCxr.value==''){
                Swal.fire({title: "กรุณาระบุวันที่ในการตรวจ ECG/CXR ด้วยครับ", didClose: handleOnFocus('dateEcgCxr')});
                return false;
            }
        }

        function handleOnFocus(idName){
            document.getElementById(idName).focus();
        }


        let albuminChecked = document.getElementById('albumin1').checked;
        if(albuminChecked==true){
            let dateAlbumin = document.getElementById('dateAlbumin');
            if(dateAlbumin.value==''){
                Swal.fire("กรุณาระบุวันที่ในการตรวจ Albumin ด้วยครับ");
                return false;
            }
        }

        let cretinineChecked = document.getElementById('cretinine1').checked;
        if(cretinineChecked==true){
            let dateCretinine = document.getElementById('dateCretinine');
            if(dateCretinine.value==''){
                Swal.fire("กรุณาระบุวันที่ในการตรวจ Cretinine ด้วยครับ");
                return false;
            }
        }
        return true;
    }

    async function loadContent(url) {
        const response = await fetch(url);
        const body = await response.text();
        return body;
    }

    function closeContainer(idName) {
        document.getElementById(idName).style.display = 'none';
    }

    /**
     * ECG + CXR 
     */
    function activeEcgCxrContain(v) {
        if (v == 1) {
            document.getElementById('ecgCxrContain').style.display = '';
        } else {
            document.getElementById('ecgCxrContain').style.display = 'none';
            document.getElementById('dateEcgCxr').value = '';
        }
    }

    function showDateSelected() {
        const url = 'hypertension.php?action=loadDate&hn=<?= $hn; ?>';
        loadContent(url).then((res) => {
            document.getElementById('landingDateSelected').innerHTML = res;
            document.getElementById('landingDateSelected').style.display = '';
        });
    }


    /**
     * Albumin Uria
     */
    function activeAlbuminContain(v) {
        if (v == 1) {
            document.getElementById('albuminContain').style.display = '';
        } else {
            document.getElementById('albuminContain').style.display = 'none';
            document.getElementById('dateAlbumin').value = '';
            document.getElementById('albuminLabnumber').value = '';
        }
    }

    function showDateAlbumin() {
        const url = 'hypertension.php?action=loadDateAlbumin&hn=<?= $hn; ?>';
        loadContent(url).then((res) => {
            document.getElementById('landingDateAlbumin').innerHTML = res;
            document.getElementById('landingDateAlbumin').style.display = '';
        });
    }


    function activeCreatinineContain(v) {
        if (v == 1) {
            document.getElementById('creatinineContain').style.display = '';
        } else {
            document.getElementById('creatinineContain').style.display = 'none';
            document.getElementById('dateCreatinine').value = '';
            document.getElementById('creatinineLabnumber').value = '';
        }
    }

    function showDateCreatinine() {
        const url = 'hypertension.php?action=loadDateCreatinine&hn=<?= $hn; ?>';
        loadContent(url).then((res) => {
            document.getElementById('landingDateCreatinine').innerHTML = res;
            document.getElementById('landingDateCreatinine').style.display = '';
        });
    }


    var popup7;
    window.onload = function () {
        popup7 = new Epoch('popup7', 'popup', document.getElementById('diag_date'), false);
    };
</script>