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
    <title>Document</title>
</head>
<body>
    <form action="javascript:void(0);" method="post" id="searchHn">
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" value="">

            <label for="surname">Surname: </label>
            <input type="text" name="surname" id="surname" value="">

            <button type="submit">Search</button>
        </div>
    </form>
    <form action="addDepart.php" method="post" id="saveForm" onsubmit="saveForm()">
        <div>
            <!-- ใส่ HN เลือกวันที่จาก date -->
            <label for="hn">HN: </label>
            <input type="text" name="hn" id="hn" value="" required="required">

            <label for="date">Date: </label>
            <input type="text" name="date" id="date" onclick="searchOpday()" autocomplete="off" required="required" value="">
            <input type="hidden" name="vn" id="vn" value="">
            <input type="hidden" name="ptright" id="ptright" value="">

            <label for="code">Code: </label>
            <input type="text" name="code" id="code" onkeyup="searchLab(this.value)" autocomplete="off" value="" required="required">
            <a href="javascript:void(0);">AgCG3</a>
            <input type="hidden" name="depart" id="depart" value="">
        </div>
        <div>
            <label for="money">Money: </label>
            <input type="text" name="money" id="money" value="นางสาว พวงเพ็ชร หอมแก่นจันทร์" required="required">

            <label for="detail">Detail: </label>
            <input type="text" name="detail" id="detail" value="ค่าตรวจวิเคราะห์โรค" required="required">

            <label for="diag">Diag: </label>
            <input type="text" name="diag" id="diag" value="ตรวจวิเคราะห์เพื่อการรักษา" required="required">

            <label for="cashok">CashOK: </label>
            <input type="text" name="cashok" id="cashok" value="30บาท" required="required">
        </div>
        <div>
            <label for="officer">Officer: </label>
            <input type="text" name="officer" id="officer" value="สมยศ แสงสุข" required="required">

            <label for="doctor">Doctor: </label>
            <?php
            $q=$dbi->query("SELECT * FROM `doctor` WHERE `status` = 'y' AND `doctorcode` IS NOT NULL ORDER BY `row_id` ASC");
            ?>
            <select name="doctor" id="doctor" required="required">
                <option value="">-- เลือกแพทย์ --</option>
                <?php
                if($q->num_rows>0){
                    while ($a = $q->fetch_assoc()) {
                        ?>
                        <option value="<?=$a['name'];?>"><?=$a['name'];?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <button type="submit">Save</button>
        </div>
        <div id="resContent"></div>
    </form>
    <script>

        async function searchLab(codeLab){
            document.getElementById('resContent').innerHTML = '';
            document.getElementById('resContent').style.display = '';
            if(codeLab.length>=2){

                let data = [];
                data.push(encodeURIComponent('labcode')+"="+encodeURIComponent(codeLab));
                let dataPost = data.join("&");
                const response = await fetch('api/Labcare.php?action=listLabItems', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                    body: dataPost
                });
                const res = await response.json();
                if(res.status===200){
                    let htmlTxt = `<table border="1"><tr><th>Code</th><th>Detail</th><th>Price</th></tr>`;
                    for (let index = 0; index < res.data.length; index++) {
                        const el = res.data[index];
                        htmlTxt += `<tr><td><a href="javascript:void(0)" onclick="addSelectLab('${el.code}','${el.depart}')">${el.code}</a></td><td>${el.detail}</td><td>${el.price}</td></tr>`;
                        
                    }
                    htmlTxt += '</table>';
                    document.getElementById('resContent').innerHTML = htmlTxt;
                    
                }else{
                    document.getElementById('resContent').innerHTML = 'ไม่พบข้อมูล';
                }
            }
        }

        
        function addSelectLab(labCode, depart){
            document.getElementById('code').value=labCode;
            document.getElementById('depart').value=depart;
            document.getElementById('resContent').style.display = 'none';
        }

        async function searchOpday(){
            document.getElementById('resContent').innerHTML = '';
            document.getElementById('resContent').style.display = '';
            const hn = document.getElementById('hn').value;

            let data = [];
            data.push(encodeURIComponent('hn')+"="+encodeURIComponent(hn));
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
                let htmlTxt = `<table border="1"><tr><th>วันที่</th><th>มาใช้บริการ</th><th>แพทย์</th></tr>`;
                for (let index = 0; index < res.data.length; index++) {
                    const el = res.data[index];
                    
                    htmlTxt += `<tr><td><a href="javascript:void(0)" onclick="addSelectDate('${el.thidate}','${el.vn}','${el.ptright}')">${el.thidate}</a></td><td>${el.toborow}</td><td>${el.doctor}</td></tr>`;
                }
                htmlTxt += '</table>';
                document.getElementById('resContent').innerHTML = htmlTxt;
                
            }else{
                document.getElementById('resContent').innerHTML = 'ไม่พบข้อมูล';
            }
        }

        function addSelectDate(thidate,vn,ptright){
            document.getElementById('date').value=thidate;
            document.getElementById('vn').value=vn;
            document.getElementById('ptright').value=ptright;
            
            document.getElementById('resContent').style.display = 'none';
        }

        document.getElementById('searchHn').onsubmit = function(ev){
            event.preventDefault();
            const name = document.getElementById('name').value;
            const surname = document.getElementById('surname').value;

            onFindHnFromName(name, surname).then((res)=>{
                if(res.status===200){
                    document.getElementById('hn').value = res.data.hn;
                }else{
                    document.getElementById('resContent').innerHTML = 'ไม่พบข้อมูล';
                }
            });
        }

        async function onFindHnFromName(name, surname){
            let data = [];
            data.push(encodeURIComponent('name')+"="+encodeURIComponent(name));
            data.push(encodeURIComponent('surname')+"="+encodeURIComponent(surname));
            let dataPost = data.join("&");
            const response = await fetch('api/Opcard.php?action=getFromName', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: dataPost
            });
            const res = await response.json();
            return res;
        }

        async function saveForm(){
            event.preventDefault();

            saveForm = document.getElementById('saveForm');
            let formData = {};
            for (let index = 0; index < saveForm.length; index++) {
                const element = saveForm.elements[index];
                if(element.type!=="submit" && element.value !== ''){
                    formData[element.name] = element.value;
                }
            }

            const response = await fetch('api/Depart.php?action=saveExpense', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });
            const res = await response.json();
            console.log(res);

            return false;
        }
    </script>
</body>
</html>