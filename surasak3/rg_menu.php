<style type="text/css">
body,td,th,input,select,button{
	font-family: TH SarabunPSK;
	font-size: 16pt;
}
input, p{
    padding: 0;
    margin: 0;
}

.claearfix::after{
    content: " ";
    clear: both;
    display: table;
}

ul.topnav{
    list-style-type: none; 
    margin: 0; 
    padding: 0; 
    overflow: hidden;

    background-color: #ECECEC;
    color: #6B6B6B;
}
ul.topnav li {
    float: left;
}
ul.topnav li a{
    display: block;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
ul.topnav li a:hover{
    text-decoration: underline;

    background-color: #6B6B6B;
    color: #ffffff;
}
#inputForm div{
    margin-bottom: 6px;
}
</style>
<div class="claearfix" style="height: 50px;">
    <ul class="topnav">
        <li><a href="../nindex.htm">หน้าหลัก รพ.</a></li>
        <li><a href="rg_soldier.php">หน้าหลัก ตรช</a></li>
        <li><a href="rg_soldier.php?page=form">เพิ่มข้อมูล</a></li>
        <li><a href="rg_report_opday.php">รายชื่อผู้มาขอใบรับรอง</a></li>
        <li><a href="http://192.168.1.13/sm3/surasak3/rg_soldier_xlsx.php">ส่งออก Amed(.xlsx)</a></li>
        <li><a href="rg_print_photo.php" target="_blank">ถ่ายรูป 1นิ้ว</a></li>
    </ul>
</div>