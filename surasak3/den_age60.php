<?php 
require_once dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานผู้สูงอายุที่มาใช้บริการทันตกรรม</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://www.w3schools.com/lib/w3.js"></script>
</head>
<body>
    <div class="w3-bar w3-teal">
        <a href="../nindex.htm" class="w3-bar-item w3-button w3-mobile">Home</a>
    </div>
    <div class="w3-container" style="margin-top: 12px;">

        <h2>ยอดผู้สูงอายุทั้งหมด ที่มาใช้บริการทันตกรรม</h2>

        <form action="den_age60.php" method="post" style="max-width: 600px;">
            <fieldset>
                <legend>ค้นหาตามปีงบประมาณ</legend>
                <p>
                    <?php 
                    $chk_year = get_year_checkup(true,false);
                    $prev_chk_year = $chk_year - 5;
                    $chk_lists = array_reverse(range($prev_chk_year, $chk_year));
                    ?>
                    เลือกปีงบ: <select class="w3-select w3-border" name="year_selected">
                        <?php 
                        foreach ($chk_lists as $key => $list) {
                            ?>
                            <option value="<?=$list;?>"><?=$list;?></option>
                            <?php
                        }
                        ?>
                        </select>
                </p>
                <p>
                    <button type="submit" class="w3-button w3-medium w3-teal">ค้นหา</button>
                    <input type="hidden" name="view" value="show_table">
                </p>
            </fieldset>
            
        </form>

        <?php 
        $view = $_REQUEST['view'];
        if($view == 'show_table'){

            $year_selected = $_POST['year_selected'];
            $prev_year = $year_selected - 1;
            
            $sql = "SELECT `hn`,`ptname`,`ptright`,`age` AS `full_age`,SUBSTRING(`age`,1,2) as `age` 
            FROM `opday2` 
            WHERE ( `thidate` >= '$prev_year-10-01 00:00:00' AND `thidate` <= '$year_selected-09-31 23:59:59' ) 
            AND `toborow` like 'EX07%' 
            AND `hn` <> '' 
            AND ( `age` <> '' AND TRIM(SUBSTRING(`age`,1,2)) >=60 )
            group by `hn` ";
            $q = $dbi->query($sql);
            $pt_rows = $q->num_rows;

            if($pt_rows > 0)
            {
                ?>
                <p>จำนวนผู้มาใช้บริการที่อายุมากกว่าหรือเท่ากับ 60ปี ในปีงบประมาณ<?=$year_selected;?> มีจำนวน <?=$pt_rows;?>ราย</p>
                <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-left-align w3-green">ดูข้อมูลทั้งหมด</button>

                <div id="Demo2" class="w3-hide">
                    <table class="w3-table-all">
                        <tr>
                            <th>HN</th>
                            <th>ชื่อสกุล</th>
                            <th>อายุ</th>
                            <th>สิทธิการรักษา</th>
                        </tr>
                        <?php 
                        while ($item = $q->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?=$item['hn'];?></td>
                                <td><?=$item['ptname'];?></td>
                                <td><?=$item['full_age'];?></td>
                                <td><?=$item['ptright'];?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        
                    </table>
                </div>
                <?php
            }
        }
        ?>


    </div>
    <script>
        // var request = new XMLHttpRequest();
        // request.open('GET', '/my/url', true);

        // request.onreadystatechange = function() {
        // if (this.readyState === 4) {
        //     if (this.status >= 200 && this.status < 400) {
        //     // Success!
        //     var resp = this.responseText;
        //     } else {
        //     // Error :(
        //     }
        // }
        // };
        // request.send();
        // request = null;

        function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}

    </script>
</body>
</html>