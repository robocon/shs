<?php
if( empty($_SESSION['sRowid']) ){ echo '<a href="login_page.php">��س��������к��ա����</a>'; exit; }
?>
<style type="text/css">
.clearfix:after{
    content: "";
    display: table;
    clear: both;
}

/* ���ҧ */
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}

/* ���� */
.chk_menu{
    margin-bottom: 1em;
    padding-bottom: 5px;
}
.chk_menu ul{
    margin: 0;
    padding: 0;
}
.chk_menu ul li{
    list-style: none;
    float: left;
}
.chk_menu ul li a{
    float: left;
    padding: 10px;
    text-decoration: none;
    color: #000000;
    background-color: #e2e2e2;
    margin-right: 2px;
}
.chk_menu ul li a:hover{
    background-color: #bfbfbf;
}
</style>
<div class="clearfix" style="height: 105px;">
    <h3>�к��Ѵ��â����� ��Ǩ�آ�Ҿ</h3>
    <div class="chk_menu clearfix">
        <ul>
            <li><a href="../nindex.htm">�к���ѡþ.</a></li>
            <li><a href="chk_company.php">�Ѵ�����ª��ͺ���ѷ</a></li>
            <li><a href="chk_import_user.php">����Ң���������к�</a></li>
            <li><a href="cxr_out_result.php">����Ң����� X-Ray</a></li>
            <li><a href="chk_labcare.php">�к�Lab</a></li>
        </ul>
    </div>
</div>