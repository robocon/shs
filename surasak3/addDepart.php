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
            <input type="text" name="name" id="name" value="ศุภกันต์">

            <label for="surname">Surname: </label>
            <input type="text" name="surname" id="surname" value="โยธา">

            <button type="submit">Search</button>
        </div>
    </form>
    <form action="addDepart.php" method="post">
        <div>
            <!-- ใส่ HN เลือกวันที่จาก date -->
            <label for="hn">HN: </label>
            <input type="text" name="hn" id="hn" value="57-9030">

            <label for="date">Date: </label>
            <input type="text" name="date" id="date" onclick="searchOpday()">

            <label for="code">Code: </label>
            <input type="text" name="code" id="code">

            <button type="submit">Save</button>
        </div>
        <div id="resContent"></div>
    </form>
    <script>
        async function searchOpday(){
            const hn = document.getElementById('hn').value;

            let data = [];
            data.push(encodeURIComponent('hn')+"="+encodeURIComponent(hn));
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

        document.getElementById('searchHn').onsubmit = function(ev){
            ev.preventDefault();
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
    </script>
</body>
</html>