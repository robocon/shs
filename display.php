<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>New Page 5</title>
<base target="_self">
<style type="text/css" media="screen">
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
</style>
</head>

<body bgcolor="#008080"  text="#ffffff" >
    
    <center>
        <font size="5"  face="THSarabunPSK" color="#fb042d">
            <b>*** ������� �ç��Һ�Ť�������ѡ��������  ***</b>
        </font>
    </center>
    
    <MARQUEE>
        <STRONG>
            <SPAN>
                <font size="1"  face="THSarabunPSK" color="#ffffff">
                    ����·�ȹ� :�ç��Һ�ŷ����дѺ�ص������� 
                    ��������ȴ�ҹ����ѡ�Ҿ�Һ�� �����������آ�Ҿ ***** �ѹ��Ԩ : �ç��Һ�Ť�������ѡ�������� 
                    ����������ԡ���ѡ�Ҿ�Һ�ŷ���դس�Ҿ ����ҵðҹ�ҡŴ��¤��� 
                    ���˹ѡ�����þ�Է�Լ����� ����ִ���㹨��¸��� 
                    ����������Ѻ��ԡ����м������ԡ�����آ�Ҿ�� 
                    �����駻�Ѻ��ا����Է�Լ����ҧ������ͧ 
                    ��л�Ժѵ���áԨ������Ѻ�ͺ���¨ҡ˹����˹�� 
                    ******
                </font>
            </SPAN>
        </STRONG>
    </MARQUEE>
    
    <br>
    <center>************************************</center>
    <br>
    
    <?php
    include("connect.inc");
    echo "<font color=#00FFFF  face='THSarabunPSK' size='4'>
            **��ª���ᾷ������͡��Ǩ�ѹ��� (".date("d-m-").(date("Y")+543).")**
            <br>";
    
    $sql = "select * from dr_offline where dateoffline = '".date("d-m-").(date("Y")+543)."'";
    $row = mysql_query($sql);
    while($result = mysql_fetch_array($row)){
        $arr = explode(" ",$result[2]);
        echo "ᾷ�� ".$arr[1]." ".$arr[2]." , ";
    }
    echo "</font>";
    
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    // include("connect.inc");
    
    $today=(date("Y")+543).date("-m-d");
    
    print "<table>";
    
    $num = 'Y';
    $query = "SELECT  row,depart,new,datetime,file,date,numday FROM new  WHERE status ='$num' ORDER BY row DESC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($row,$depart,$new,$datetime,$file,$start,$end) = mysql_fetch_row ($result)) {
    
        if($today==$end){
            $query = "UPDATE  new SET status = 'N' WHERE  row = '$row' ";
            $result = mysql_query($query)or die("Query failed update new N");
        }
        
        ?>
        <tr>
            <td>
                <font face="THSarabunPSK" >
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height="15" src='new.gif' width="30">&nbsp;***&nbsp;
                    <?=$new;?>
                
                ***(<?=$depart;?>&nbsp;<?=$datetime;?>)&nbsp;(����ش&nbsp;<?=$end;?>)&nbsp;*** 
                <?php 
                if($file){ 
                    echo "<a href='surasak3/file_news/$file' target='_blank'><font color='#FF00FF'>��ǹ���Ŵ���</font></a>"; 
                } 
                ?>
                </font>
            </td>
        </tr>
        <?php
    }
    print "</table>";
    
    $last_day = date('Y-m-d', strtotime("-2 week"));
    $new_date = date('Y-m-d', strtotime("-1 week"));
    $sql = "SELECT * FROM `news` 
    WHERE `status` = 1
    AND `date_start` > '$last_day'
    ORDER BY `date_start` DESC;
    ";
    $q = mysql_query($sql);
    $rows = mysql_num_rows($q);
    if( $rows > 0 ){
    ?>
    <style type="text/css">
    .news-header{
        color: #00FFFF;
    }
    .news-contain a{
        text-decoration: none;
        color: #ffffff;
    }
    .news-contain a:hover{
        text-decoration: underline;
    }
    </style>
    <div class="news-contain">
        <h3 class="news-header">���ǻ�Ъ�����ѹ�� ��. þ.����</h3>
        <div>
            <?php
            
            ?>
            <ol>
                <?php
                while( $item = mysql_fetch_assoc($q) ){
                    ?>
                    <li class="news-link">
                        <a href="surasak3/news_detail.php?id=<?=$item['id'];?>"><?=$item['title'];?></a>
                        <?php
                        if( $new_date < $item['date_start'] ){
                            ?><img height="15" src="new.gif" width="30"><?php
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>
            </ol>
        </div>
    </div>
    <?php
    }
    
    include("surasak3/unconnect.inc");
?>
</body>
</html>