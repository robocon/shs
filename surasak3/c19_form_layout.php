<form class="w3-container" id="c19_admin_form" method="POST" action="c19_form.php">
    <p>      
        <label class="w3-text"><b>HN</b></label>
        <?php 
        $readonly = ($form_type=='edit') ? 'readonly' : '' ;
        ?>
        <input class="w3-input w3-border w3-light-grey" id="hn" name="hn" type="text" value="<?=$pt['hn'];?>" <?=$readonly;?> >
    </p>
    <div id="display-name" style="display: none;">
        <p class="w3-large w3-text-teal" id="display-name-text"></p>
    </div>
    <p>      
        <label class="w3-text"><b>ชื่อแพทย์</b></label>
        <select class="w3-select w3-border" id="doctor" name="doctor">
            <option value="" disabled selected>เลือกแพทย์</option>
            <?php 
            $sql = "SELECT * FROM `doctor` WHERE `status` = 'y' AND `name` LIKE 'MD%' AND (`doctorcode` NOT LIKE '0000%' AND `doctorcode` REGEXP '[0-9]{5}')  ";
            $dt_q = $dbi->query($sql);
            while ($dt = $dt_q->fetch_assoc()) {
                $selected = ($pt['doctor'] == $dt['name']) ? 'selected="selected"' : '' ;
                ?><option value="<?=trim($dt['name']);?>" <?=$selected;?> ><?=$dt['name'];?></option><?php 
            }
            ?>
        </select>
    </p>

    <p><b>วัคซีนโควิด 19</b></p>
    <div class="w3-row-padding">
        <?php 
        $manufacturer_lists = array( 
            '7' => 'Sinovac Life Sciences',
            '1' => 'AstraZeneca', 
            '8' => 'Sinopharm',
            '6' => 'Pfizer, BioNTech',
            '5' => 'Moderna'
        );

        foreach ($manufacturer_lists as $key => $fac) { 
            $checked = ($pt['vaccine_name']==$fac) ? 'checked="checked"' : '' ;
            ?>
            <div class="w3-third">
                <label><input class="w3-radio" type="radio" name="vaccine_name" value="<?=$fac;?>" <?=$checked;?> > <?=$fac;?></label>
            </div>
            <?php
        }
        ?>
    </div>

    <p><b>Lot และ Serial</b></p>
    <div class="w3-row-padding">
        <div class="w3-third">
            <label>รหัส Barcode</label>
            <input class="w3-input w3-border w3-light-grey" type="text" id="barcode_no" name="barcode_no" value="<?=$pt['barcode_no'];?>">
        </div>
        <!--
        <div class="w3-third">
            <label>Lot.No.</label>
            <input class="w3-input w3-border w3-light-grey" type="text" id="lot_no" name="lot_no" value="<?=$pt['lot_no'];?>">
        </div>
        <div class="w3-third">
            <label>ขวดที่</label>
            <input class="w3-input w3-border w3-light-grey" type="text" id="bottle_no" name="bottle_no" value="<?=$pt['bottle_no'];?>">
        </div>
        <div class="w3-third">
            <label>Serial No.</label>
            <input class="w3-input w3-border w3-light-grey" type="text" id="serial_no" name="serial_no" value="<?=$pt['serial_no'];?>">
        </div>
    -->
    </div>

    <p><b>เข็มที่</b></p>
    <div class="w3-row-padding">
        <?php 
        $plan_count_list = array(1,2,3,4);
        foreach ($plan_count_list as $key => $plan) {
            $plan_checked = ($pt['vaccine_plant_no']==$plan) ? 'checked="checked"' : '';
            ?>
            <div class="w3-third">
                <label><input class="w3-radio" type="radio" name="vaccine_plan_no" value="<?=$plan;?>" <?=$plan_checked;?> > เข็มที่ <?=$plan;?></label>
            </div>
            <?php
        }
        ?>
    </div>
    <p>
        <button class="w3-btn w3-teal w3-round" type="submit">บันทึกข้อมูล</button>
        <a href="javascript:void(0);" class="w3-btn w3-teal w3-round" onclick="document.getElementById('id01').style.display='none'">ยกเลิก</a>
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="form_type" value="<?=$form_type;?>">
        <?php 
        if($form_type=='edit')
        {
            ?><input type="hidden" name="id" value="<?=$pt['id'];?>"><?php
        }
        ?>
    </p>
</form>