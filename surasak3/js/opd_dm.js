document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        // Your code to run when Esc is pressed
        span.click();
    }
});

/**
 * Toast ตอนบันทึกข้อมูล DM Clinic สำเร็จ
 */
let Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

////// MODAL //////
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    onLoadDmPage().then((html)=>{
        document.getElementById('formDmContent').innerHTML = html;
    });
    document.getElementById('formDmContent').style.display = "block";
    modal.style.display = "block";
}

var hyperBtn = document.getElementById("hyperBtn");

// When the user clicks on the button, open the modal
hyperBtn.onclick = function() {
    onLoadHtPage().then((html)=>{
        document.getElementById('formDmContent').innerHTML = html;
    });
    document.getElementById('formDmContent').style.display = "block";
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
    document.getElementById('formDmContent').style.display = "none";
    document.getElementById('formDmContent').innerHTML = '';
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        // modal.style.display = "none";
    }
}
////// MODAL //////

////// OPD_HT_FORM.php //////
function getYearDiag(){
    callYearDiag().then((res)=>{
        document.getElementById('getYearDiag').innerHTML = res;
        document.getElementById('getYearDiagContainer').style.display = '';
    });
}
async function callYearDiag(){
    const response = await fetch('call/diag.php?action=getFirstI10FromHn&hn=<?=$hn;?>');
    const data = await response.text();
    return data;
}

// ถ้ารายการใน การวินิจฉัย ถูกคลิกให้ทำการเลือกวันที่อัตโนมัติ
var htDiagItems = document.getElementsByClassName('htDiag');
for (let htDi = 0; htDi < htDiagItems.length; htDi++) {
    const el = htDiagItems[htDi];
    el.onclick = function(){
        document.getElementById('diag_date').focus();
    }
}

function htDateSelect(divId,url){
    loadContent(url).then((res)=>{ 
        document.getElementById(divId).innerHTML = res;
        document.getElementById(divId).style.display = '';
    });
}
function closeContainer(idName){
    document.getElementById(idName).style.display = 'none';
}
async function loadContent(url){
    const response = await fetch(url);
    const body = await response.text();
    return body;
}

async function onLoadHtPage(){
    const response = await fetch('opd_ht_form.php?hn=<?=$hn;?>');
    const body = await response.text();
    return body;
}

async function saveHtForm() {
    const form = document.querySelector('#opd_ht_form');
    const formData = new FormData(form);
    const data = {};
    
    // Convert FormData to JSON object, handling potential duplicate names or checkboxes
    formData.forEach((value, key) => {
        if (data[key]) {
            if (!Array.isArray(data[key])) {
                data[key] = [data[key]];
            }
            data[key].push(value);
        } else {
            data[key] = value;
        }
    });

    data.action = 'saveHypertension';
    data.typeDepart = 'hypertension';
    
    try {
        const response = await fetch(var_url+'/api/index.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        if(result.hypertension.status===200){
            Toast.fire({
                icon: "success",
                title: "บันทึกข้อมูลเรียบร้อยแล้ว"
            }).then(()=>{
                span.click();
            });
            
        }
    } catch (error) {
        console.error('Error:', error);
        alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' + error.message);
    }
}

////// OPD_HT_FORM.php //////

/**
 * ตอนโหลดข้อมูลเข้าไปใน Modal
 */
async function onLoadDmPage(){
    const response = await fetch('opd_dm_form.php?hn='+var_hn);
    const body = await response.text();
    return body;
}

/**
 * ตอนกด "รีเซ็ต" ในฟอร์ม DM Clinic
 */
function clearRadioButton(className){
    const comoHtItems = document.getElementsByClassName(className);
    for (let index = 0; index < comoHtItems.length; index++) {
        const element = comoHtItems[index];
        element.checked = false;
    }
}

/**
 * รวม Alert
 */
async function doAlert(validateTxt, textFocus){
    await Swal.fire({
        icon: 'warning',
        title: validateTxt,
        allowOutsideClick: false,
        didClose: () =>{
            if(textFocus!==''){
                document.getElementById(textFocus).focus();
            }
        }
    });
}

function saveDmForm(){
    event.preventDefault();

    const dmForm = document.getElementById('dmFormAdmin');
    const doctorId = document.getElementById('dm_doctor').value;
    const weight = document.getElementById('dm_weight').value;
    const height = document.getElementById('dm_height').value;
    const temperature = document.getElementById('dm_temp').value;
    const round = document.getElementById('dm_round').value; // ใน db เป็น round
    const pause = document.getElementById('dm_pulse').value;
    const rate = document.getElementById('dm_rate').value;
    const bp1 = document.getElementById('dm_bp1').value;
    const bp2 = document.getElementById('dm_bp2').value;
    const bmi = document.getElementById('dm_bmi').value;
    
    let validate = true;
    let validateTxt = '';
    let textFocus = '';
    //  Pulse (ชีพจร) หรือ Rate (อัตราการเต้น)
    if(pause==''){
        validate = false;
        validateTxt = 'กรุณากรอกชีพจร (Pulse)';
        textFocus = 'dm_pulse';

    }else if(rate==''){
        validate = false;
        validateTxt = 'กรุณากรอกอัตราการเต้น (Rate)';
        textFocus = 'dm_rate';

    }else if(bp1=='' || bp2==''){
        validate = false;
        validateTxt = 'กรุณากรอกค่าความดัน';
        textFocus = 'dm_bp1';

    }else if(round==''){
        validate = false;
        validateTxt = 'กรุณากรอกรอบเอว';
        textFocus = 'dm_round';

    }else if(doctorId==0){
        validate = false;
        validateTxt = 'กรุณาเลือกแพทย์';
        textFocus = 'dm_doctor';
    }
    
    if(validate===false){
        doAlert(validateTxt, textFocus);
        return false;
    }

    let formData = {};
    for (let index = 0; index < dmForm.elements.length; index++) {
        const element = dmForm.elements[index];
        if (!element.name || !element.type) continue;

        if( (element.type==="text" || element.type==="hidden")  && element.value !== ''){ 
            formData[element.name] = element.value;
        }else if( element.type==="checkbox" && element.checked===true){

            if (element.name.includes('[]')) {
                if (!Array.isArray(formData[element.name])) {
                    formData[element.name] = [];
                }
                formData[element.name].push(element.value);
            }else{
                formData[element.name] = element.value;
            }
            
        }else if( element.type==="radio" && element.checked===true){
            formData[element.name] = element.value;
        }else if( element.type==="select-one"){
            formData[element.name] = element.value;
        }
    }

    formData.doctor = document.getElementById('dm_doctor').value;
    formData.ptname = document.getElementById('dm_ptname').value;
    formData.ptright = var_ptright;
    formData.dbbirt = var_dbbirt;
    formData.sex = var_sex;
    formData.weight = weight;
    formData.height = height;
    formData.temperature = temperature;
    formData.round = round;
    formData.pause = pause;
    formData.rate = rate;
    formData.bp1 = bp1;
    formData.bp2 = bp2;
    formData.bmi = bmi;
    formData.age = encodeURIComponent(var_age);

    onSaveDmForm(formData).then((res)=>{
        if(res.status===200){
            let dmNumber = res.dm_clinic_id;
            let hn = res.hn;
            document.getElementById('updatedDmNumber').innerHTML = `${dmNumber} <a href="diabetes_clinic/diabetes_edit.php?hn=${hn}" target="_blank" title="ไปหน้าฟอร์ม Diabetes Clinic">➦</a><input type="hidden" name="dm_no" value="${dmNumber}">`;
            Toast.fire({
                icon: "success",
                title: res.message
            }).then(()=>{
                span.click();
            });
        }else{
            Toast.fire({
                icon: "error",
                title: res.message
            });
        }
    });
}

async function onSaveDmForm(data){
    const response = await fetch(var_url+'/api/index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    const dataResponse = await response.json();
    return dataResponse ;
}