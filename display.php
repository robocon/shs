<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>New Page 5</title>
<base target="_self">
<style type="text/css">
    
    @font-face {
        font-family: THSarabunPSK;
        src: url("surasak3/THSarabun.eot")
        /*src: url("http://192.168.1.2/sm3/surasak3/THSarabun.eot")*/
        /* EOT file for IE */
    }
    @font-face {
        font-family: THSarabunPSK;
        src: url("surasak3/THSarabun.ttf") /* TTF file for CSS3 browsers */
    }
    body, table td, p{
        font-size: 14px;
        font-weight: normal;
    }
    .news-contain a{
        color: #ffffff;
        text-decoration: none;
    }
    .news-contain a:hover{
        text-decoration: underline;
    }
    .news-header{
        color: #00FFFF;
    }
</style>
</head>
<body bgcolor="#008080"  text="#ffffff" >
    <center>
        <h3 style="color: #fb042d">*** ������� �ç��Һ�Ť�������ѡ��������  ***</h3>
    </center>

    <marquee>
        <strong>
            <span>
                <font size="1" color="#ffffff" face="THSarabunPSK" > 
                    ����·�ȹ� :�ç��Һ�ŷ����дѺ�ص������� 
                    ��������ȴ�ҹ����ѡ�Ҿ�Һ�� �����������آ�Ҿ ***** �ѹ��Ԩ : �ç��Һ�Ť�������ѡ�������� 
                    ����������ԡ���ѡ�Ҿ�Һ�ŷ���դس�Ҿ ����ҵðҹ�ҡŴ��¤��� 
                    ���˹ѡ�����þ�Է�Լ����� ����ִ���㹨��¸��� 
                    ����������Ѻ��ԡ����м������ԡ�����آ�Ҿ�� 
                    �����駻�Ѻ��ا����Է�Լ����ҧ������ͧ 
                    ��л�Ժѵ���áԨ������Ѻ�ͺ���¨ҡ˹����˹�� 
                    ******
                </FONT>
            </span>
        </strong>
    </marquee>

    <br><center>************************************</center><br>
    <?php
    include("connect.inc");
    // mysql_query("SET NAMES tis620");
    
    echo "<font color=#00FFFF  face='THSarabunPSK' size='4'>**��ª���ᾷ������͡��Ǩ�ѹ��� (".date("d-m-").(date("Y")+543).")**<br>";
    
    $sql = "select * from dr_offline where dateoffline = '".date("d-m-").(date("Y")+543)."'";
    $row = mysql_query($sql);
    while($result = mysql_fetch_array($row)){
        $arr = explode(" ",$result[2]);
        echo "ᾷ�� ".$arr[1]." ".$arr[2]." , ";
    }
    echo "</font>";
    
    ?><table><?php
    
    $Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $today = (date("Y")+543).date("-m-d");
    
    $num = 'Y';
    $query = "SELECT  row,depart,new,datetime,file,date,numday FROM new  WHERE status ='$num' ORDER BY row DESC ";
    $result = mysql_query($query) or die("Query failed");
    while( list($row,$depart,$new,$datetime,$file,$start,$end) = mysql_fetch_row ($result)) {

        // ��駤��ʶҹ��� N �ѵ��ѵ� ����ѹ�������ش�ͧ���ǵç�Ѻ�ѹ�Ѩ�غѹ
        if($today == $end){
            $query = "UPDATE  new SET status = 'N' WHERE  row = '$row' ";
            $result = mysql_query($query) or die("Query failed update new N");
        }
        ?>
        <tr>
            <td>
                <p style="margin-bottom: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=15 src='new.gif' width=30> *** <?=$new;?> *** ( <?=$depart;?> <?=$datetime;?> ) <u>( ����ش <?=$end;?> )</u> *** 
                    <?php
                    if($file){
                        echo "<a href='surasak3/file_news/$file' target='_blank'><font color='#FF00FF'>��ǹ���Ŵ���</font></a>"; 
                    }
                    ?>
                </p>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <div class="news-contain">
        <h3 class="news-header">���ǻ�Ъ�����ѹ��</h3>
        <div>
            <ol>
                <li class="news-link">
                    <a href="surasak3/news_detail.php">��ǹ����ش ��� 0421.3/� 106 ŧ�ѹ��� 2 �չҤ� 2559 ����ͧ�ͤ��������������¡�úԹ���������������� 㹡���Թ�ҧ��Ҫ������㹻����</a> <img height="15" src="new.gif" width="30"> 
                </li>
                <li class="news-link">
                    <a href="surasak3/news_detail.php">��ǹ����ش ��� �� 0421.5/� 18 ŧ�ѹ��� 14 ���Ҥ� 2559 ����ͧ ��èѴ����������´��Сͺ��öʹẺ�ӹǳ�Ҥҡ�ҧ�ҹ������ҧ�������Ǣ�ͧ�Ѻ��ҹ���ѹ�������</a> <img height="15" src="new.gif" width="30"> 
                </li>
            </ol>
        </div>
    </div>
    <?php
    include("surasak3/unconnect.inc");
    ?>
    
</body>
</html>