<?php 

// session_start();
// include 'connect.inc';
include 'bootstrap.php';

mysql_query("SET NAMES tis620");

?>
<style>
	*{
		font-family: 'TH Sarabun New','TH SarabunPSK';
		font-size: 18px;
	}
	input[readonly]{
		background-color: #d8d8d8;
	}
    input[type='radio'],
    label.radio{
        cursor: pointer;
    }
</style>

<div>
	<a href="../nindex.htm"><< ไปเมนู </a> | <a href="anc.php">ฟอร์มบันทึกข้อมูล ANC</a> | <a href="anc_view.php">ดูการบันทึกข้อมูล ANC</a><br />
</div>
