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
        <li><a href="../nindex.htm">斯橐伺选 镁.</a></li>
        <li><a href="rg_soldier.php">斯橐伺选 得�</a></li>
        <li><a href="rg_soldier.php?page=form">嗑澡立橥临�</a></li>
        <li><a href="http://192.168.131.249/sm3/surasak3/rg_soldier_xlsx.php" target="_blank">疏汀 Amed(.xlsx)</a></li>
        <li><a href="rg_print_photo.php">觅欢枰� 1乖榍</a></li>
        <li><a href="rg_config.php">笛椐よ亦泞氛�</a></li>
    </ul>
</div>
<?php

if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}
