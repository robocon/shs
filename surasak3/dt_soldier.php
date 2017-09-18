<?php 
session_start();

include "connect.inc";
include "checklogin.php";

?>

<style type="text/css">
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}
.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.font3 {
	font-size: 18px;
}
</style>

<?php
include "dt_menu.php";
include "dt_patient.php";


$types = array(
    1 => 'โรคหรือความผิดปกติของตา',
    'items' => array(
        'ก' => 'ตาข้างใดข้างหนึ่งบิด คือเมื่อรักษาและแก้สายตาด้วยแว่นตาแล้วการมองเห็นยังอยู่ในระดับต่ำกว่า 3/60 หรือลานสายตาโดยเฉลี่ยแคบกว่า 10 องศา',
        'ข' => 'สายตาไม่ปกติ คือเมื่อรักษาและแก้สายตาด้วยแว่นแล้ว การมองเห็นยังอยู่ในระดับ 6/24 หรือต่ำกว่าทั้งสองข้าง',
        'ค' => 'สายตาสั้นมากกว่า 8 ไดออปเตอร์ หรือสายตายาวมากกว่า 5 ไดออปเตอร์ ทั้งสองข้าง',
        'ง' => 'ต้อแก้วตาทั้งสองข้าง (Bilateral Cataract)',
        'จ' => 'ต้อหิน (Glaucoma)',
        'ฉ' => 'โรคขั้วประสาทตาเสื่อมทั้ง 2 ข้าง (Optic Atrophy)',
        'ช' => 'ขั้วประสาทตาอักเสบเรื้อรังหรือขุ่นทั้งสองข้าง',
        'ซ' => 'ประสาทการเคลื่อนไหวลูกตาไม่ทำงานสูญเสียอย่างถาวร (Cranial never 3 , 4 , 6)',
    ),
    99 => '',
    'items' => array(
        'ก' => '',
        'ข' => '',
        'ค' => '',
        'attributes' => array(
            1 => '',
            2 => '',
            3 => ''
        )
    )
);
?>
<select name="" id="">
    <option value="">เลือกข้อมูล กฎกระทรวง</option>
    <option value="">1 (ก)</option>
    <option value="">1 (ข)</option>
    <option value="">1 (ค)</option>
</select>