<?php
include_once dirname(__FILE__).'/bootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ย้ายค่าใช้จ่าย ผู้ป่วยนอก</title>
</head>
<body>
<style>
    label:hover{
        cursor: pointer;
    }
</style>
<form action="formMoveDepart.php" method="post" id="formUpdate">
    <table width="100%">
        <tr valign="top">
            <td>
                <div>
                    <div>
                        <label for="hn">HN: </label>
                        <input type="text" name="hn" id="hn" value="68-888">
                    </div>
                    <label for="dateFrom">จากวันที่: </label>
                    <input type="date" name="dateFrom" id="dateFrom" value="2568-11-04" onclick="selectDate('dateFrom','display-1')">
                    <input type="hidden" name="vnFrom" id="display-1-vn">
                </div>
                <div id="display-1">display 1</div>
                <div id="display-2">display 2</div>
            </td>
            <td>
                <div>
                    <label for="dateTo">เป็นวันที่: </label>
                    <input type="date" name="dateTo" id="dateTo" value="2568-10-14" onclick="selectDate('dateTo','display-3')">
                    <input type="hidden" name="vnTo" id="display-3-vn">
                </div>
                <div id="display-3">display 3</div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit">ย้ายข้อมูล</button>
            </td>
        </tr>
    </table>
</form>
<script>
    async function selectDate(selectId,showIn){
        const hn = document.getElementById('hn');
        let data = [];
        data.push(encodeURIComponent('hn')+"="+encodeURIComponent(hn.value));
        let dataPost = data.join("&");
        const response = await fetch('api/Opday.php?action=getOpdayLast6Months', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            body: dataPost
        });
        const res = await response.json();
        if(res.status===200){
            let htmlTxt = `<h4>กรุณาเลือกวันที่ผู้ป่วยมารับบริการจริง</h4><table border="1"><tr><th>วันที่</th><th>มาใช้บริการ</th><th>แพทย์</th></tr>`;
            for (let index = 0; index < res.data.length; index++) {
                const el = res.data[index];
                
                htmlTxt += `<tr><td><a href="javascript:void(0)" onclick="addSelectDate('${el.thidate}','${el.vn}','${hn.value}','${selectId}','${showIn}')">${el.thidate}</a></td><td>${el.toborow}</td><td>${el.doctor}</td></tr>`;
            }
            htmlTxt += '</table>';
            document.getElementById(showIn).innerHTML = htmlTxt;
            document.getElementById(showIn).style.display = '';
            
        }else{
            document.getElementById(showIn).innerHTML = '<span style="color:red;">ไม่พบข้อมูล</span>';
        }
    }

    function addSelectDate(date,vn,hn,selectId,showIn){
        document.getElementById(selectId).value = date;
        document.getElementById(showIn+'-vn').value = vn;
        if(showIn==='display-1'){
            selectDepart(date,hn);
        }
    }

    async function selectDepart(date,hn){

        let data = [];
        data.push(encodeURIComponent('date')+"="+encodeURIComponent(date));
        data.push(encodeURIComponent('hn')+"="+encodeURIComponent(hn));
        let dataPost = data.join("&");
        const response = await fetch('api/Depart.php?action=getDepartFromHn', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            body: dataPost
        });
        const res = await response.json();
        if(res.status===200){
            let htmlTxt = `<h4>กรุณาเลือกรายการ</h4>
            <table border="1">
            <tr>
            <th>date</th>
            <th>depart</th>
            <th>detail</th>
            <th>price</th>
            <th>tvn</th>
            </tr>`;
            for (let index = 0; index < res.data.length; index++) {
                const el = res.data[index];
                htmlTxt += `<tr>
                <td><input type="checkbox" id="${el.row_id}" name="depart[]" value="${el.row_id}"><label for="${el.row_id}">${el.date}</label></td>
                <td>${el.depart}</td>
                <td>${el.detail}</td>
                <td>${el.price}</td>
                <td>${el.tvn}</td>
                </tr>`;
            }
            htmlTxt += '</table>';
            document.getElementById('display-2').innerHTML = htmlTxt;
        }
    }
    
    let updateForm = document.getElementById('formUpdate');
    updateForm.addEventListener("submit", callupdateForm);
    async function callupdateForm(event){
        event.preventDefault();

        // let formData = new FormData(updateForm);
        // formData.append("dateFrom", document.getElementById('dateFrom').value );
        // formData.append("dateTo", document.getElementById('dateTo').value );
        // var inputCheckboxs = document.querySelectorAll('input[type=checkbox]'); 
        // for (let index = 0; index < inputCheckboxs.length; index++) {
        //     const el = inputCheckboxs[index];
        //     formData.append(`depart[]`, el.value);
        // }
        // formData.append("hn", document.getElementById('hn').value );
        // formData.append("vnFrom", document.getElementById('display-1-vn').value );
        // formData.append("vnTo", document.getElementById('display-3-vn').value );
        // console.log(formData);

        // let newFormData = {};
        // for (const [key, value] of formData.entries()) {
        //     newFormData[key] = value;
        // }
        // console.log(JSON.stringify(newFormData));

        let formData2 = new FormData(updateForm);
        for (let index = 0; index < updateForm.length; index++) {
            const element = updateForm.elements[index];
            if(element.type!=="submit" && element.value !== ''){
                formData2[element.name] = element.value;
            }
        }
        const inputElements = document.getElementsByName('depart[]');
        const departArray = [];
        inputElements.forEach(input => {
            departArray.push(input.value);
        });
        formData2['depart'] = departArray;

        const response = await fetch('api/Depart.php?action=updateVnDepart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData2)
        });
        const res = await response.json();

        console.log(res);
    }
</script>
</body>
</html>