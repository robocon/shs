<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$id = sprintf("%d", $_GET['id']);
if(!empty($id) && $id>0){ 

    $q = $dbi->query("SELECT * FROM drugreact_group WHERE id = '$id' ");
    $g = $q->fetch_assoc();

    $sqlDrugreactGroupList = "SELECT a.drugcode,b.tradname,b.genname,a.officer FROM ( 
        SELECT * FROM drugreact_group_list WHERE drugreact_group = '$id' 
    ) AS a 
    LEFT JOIN druglst AS b ON a.drugcode = b.drugcode";
    $q = $dbi->query($sqlDrugreactGroupList);

    $showItems = array();
    $itemJs = array();
    while ($a = $q->fetch_assoc()) { 
        $showItems[] = $a;
        
        $itemJs[] = '{"drugcode":"'.$a['drugcode'].'", "tradname":"'.$a['tradname'].'", "genname":"'.$a['genname'].'", "officer":"'.$a['officer'].'"}';
        
    }

    $jsObject = '['.implode(',', $itemJs).']';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$g['name'];?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="">
        <h3>ยา<?=$g['name'];?></h3>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="พิมพ์เพื่อค้นหาจากรหัส ชื่อการค้า ชื่อสามัญ" aria-label="Search" aria-describedby="button-addon2" id="nameSearch" onkeyup="findName(this.value)">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="cleardata()">ยกเลิก</button>
        </div>
        <div id="groupAllItem">
            <table class="table table-striped table-hover">
                <tr class="table-warning">
                    <th>รหัสยา</th>
                    <th>ชื่อการค้า</th>
                    <th>ชื่อสามัญ</th>
                    <th>ผู้บันทึก</th>
                </tr>
                <?php 
                foreach($showItems AS $a){ 
                    ?>
                    <tr>
                        <td><small><?=$a['drugcode'];?></small></td>
                        <td><small><?=$a['tradname'];?></small></td>
                        <td><small><?=$a['genname'];?></small></td>
                        <td><small><?=$a['officer'];?></small></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        
    </div>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="js/jql.min.js"></script>
    <script>
        var jsonData = JSON.parse('<?=$jsObject;?>');

        function findName(v){ 
            var j = new JQL(jsonData);

            if (v.length<3) {
                var res123 = j.select('*').fetch();
            }else{
                var res1 = j.select('*').where('drugcode').contains(v).fetch();
                var res2 = j.select('*').where('tradname').contains(v).fetch();
                var res3 = j.select('*').where('genname').contains(v).fetch();
                var res123 = res1.concat(res2,res3);
            }
            
            if(res123.length==0){
                return false;
            }

            var htmlTxt = getTemplate(res123);
            document.getElementById('groupAllItem').innerHTML =htmlTxt;
        }

        function cleardata(){
            document.getElementById('nameSearch').value='';

            var j = new JQL(jsonData);
            var res123 = j.select('*').fetch();
            var htmlTxt = getTemplate(res123);
            document.getElementById('groupAllItem').innerHTML =htmlTxt;
        }

        function getTemplate(res123){
            var htmlTxt = '<table class="table table-striped table-hover"><tr><th>รหัสยา</th><th>ชื่อการค้า</th><th>ชื่อสามัญ</th><th>ผู้บันทึก</th></tr>';
            for (var index = 0; index < res123.length; index++) {
                var element = res123[index];
                htmlTxt += '<tr><td><small>'+element.drugcode+'</small></td><td><small>'+element.tradname+'</small></td><td><small>'+element.genname+'</small></td><td><small>'+element.officer+'</small></td></tr>';
            }
            htmlTxt += '</table>';
            return htmlTxt;
        }
    </script>
</body>
</html>
<?php 
}else{
    echo "Invalid";
}