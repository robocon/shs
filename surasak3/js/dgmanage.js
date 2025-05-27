// ลบ/ปรับสถานะเป็น n
async function delReactGroup(id){
    
    const response = await fetch('dgmanage.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({"action":"getFromId","id":id})
    });
    const content = await response.json();
    
    const reactName = content.message;
    const result = await sendPostJson({"action": "checkDrugreact","name":reactName, "id":id}).then((res)=>{
        return res;
    });

    if(result.userReactRows > 0 || result.groupReactRows > 0){
        confirmDelGroup1(id);
        
    }else{
        console.log("Do Delete");
        doDeleteGroup(id);
    }
}

async function confirmDelGroup1(id){
    const { value: userPass } = await Swal.fire({
        title: 'คุณต้องการลบข้อมูลนี้หรือไม่?',
        html: `การลบข้อมูลนี้จะทำให้รายการยาที่เคยผูกไว้กับกลุ่มยานี้หายไปทั้งหมด<br>และจะไม่สามารถกู้คืนข้อมูลได้อีก`,
        icon: 'warning',
        input: "password",
        inputLabel: "กรุณากรอกรหัสผ่านเพื่อยืนยันการลบ",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        inputValidator: (value) => {
            if (!value) {
                return "กรุณากรอกข้อมูล";
            }
        }
    });
    
    if(userPass){
        const response = await fetch('dgmanage.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({"action":"checkPass","pass":userPass})
        });
        const content = await response.json();
        if(content.status===200){
            console.log("Do Delete");
            doDeleteGroup(id)
        }else{
            Swal.fire({icon: 'warning', title:"รหัสผ่านไม่ถูกต้อง"});
        }
    }
}

async function doDeleteGroup(id){
    let objData = {
        "action": 'delete',
        "id": id
    };
    sendPostJson(objData).then((res)=>{
        if(res.status==200){
            Swal.fire({
                icon: 'success',
                title: 'ลบข้อมูลเรียบร้อย'
            }).then((res)=>{
                document.getElementById('item-tr-'+id).remove();
            });
        }else{
            Swal.fire({
                icon: 'error',
                title: 'ไม่สามารถลบข้อมูลได้',
                text: res.message
            });
        }
    });
}

async function editReactGroup(id){
    
    let objData = {
        "action": 'getFromId',
        "id": id
    };

    inputValue = await sendPostJson(objData).then((res)=>{
        return res.message;
    });

    const { value: inputName } = await Swal.fire({
        title: "แก้ไขชื่อกลุ่มยา",
        input: "text",
        inputValue,
        showCancelButton: true,
        confirmButtonText: 'แก้ไขได้เลย',
        cancelButtonText: 'ยกเลิก',
        inputValidator: (value) => {
            if (!value) {
                return "กรุณาใส่ชื่อกลุ่มยา";
            }else if (value.length <= 3) {
                return "ชื่อกลุ่มยาสั้นเกินไป";
            }
        }
    });
    if (inputName) {
        let objData = {
            "action": 'update',
            "oldName": inputValue,
            "name": inputName,
            "id": id
        };
        sendPostJson(objData).then((res)=>{
            if(res.status==200){
                Swal.fire({
                    icon: 'success',
                    title: 'บันทึกข้อมูลเรียบร้อย'
                }).then((res)=>{
                    document.getElementById('item-id-'+id).innerHTML = inputName;
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถบันทึกข้อมูลได้',
                    text: res.message
                });
            }
        });
    }
}

async function addReactGroup(){
    const { value: inputName } = await Swal.fire({
        title: "เพิ่มชื่อกลุ่มยา",
        input: "text",
        showCancelButton: true,
        confirmButtonText: 'เพิ่ม',
        cancelButtonText: 'ยกเลิก',
        inputValidator: (value) => {
            if (!value) {
                return "กรุณาใส่ชื่อกลุ่มยา";
            }else if (value.length <= 3) {
                return "ชื่อกลุ่มยาสั้นเกินไป";
            }
        }
    });
    if (inputName) {
        let objData = {
            "action": 'add',
            "name": inputName
        };
        sendPostJson(objData).then((res)=>{
            if(res.status==200){
                Swal.fire({
                    icon: 'success',
                    title: 'บันทึกข้อมูลเรียบร้อย'
                }).then((res)=>{
                    location.reload();
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถบันทึกข้อมูลได้',
                    text: res.message
                });
            }
        });
    }
}

async function sendPostJson(objData){
    const response = await fetch('dgmanage.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(objData)
    });
    const content = await response.json();
    return content;
}