<?php
    $sIdname=$username;
    $sPword  =$password;
    session_register("sIdname");
    session_register("sPword");
	session_register("sRowid");
	function date_diff($str_start, $str_end){
		$str_start=strtotime($str_start);
		$str_end=strtotime($str_end);
		$nseconds=$str_end-$str_start;
		$ndays=round($nseconds/86400);
		
		return $ndays;
	}
    print "<body bgcolor='#669999' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
    print "<br>";

    print "<font face='THSarabunPSK'><CENTER><br>";
    

	include("connect.inc");
	$query = "SELECT * FROM inputm WHERE idname = '$sIdname' and pword='$sPword' and status ='Y' ";
    $result = mysql_query($query) or die("Query failed"); 
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
    if(mysql_num_rows($result)){
		$sRowid=$row->row_id;
		//$sql=mysql_query("UPDATE inputm SET date_pword='".date("Y-m-d H:s:i")."' WHERE row_id='$sRowid'");
		$sDatepass=$row->date_pword;
		$sPass=$row->pword;
		if($sPass=="1234"){
		?>
		<script>
		if(confirm('���ʼ�ҹ�ͧ��ҹ�ѧ�繤��������� (1234) ��س�����¹���ʼ�ҹ�������ͤ�����ʹ���')){
        	window.open('newpw.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=yes, status=no,resizable=no,width=800,height=600,top=220,left=650 ' );
		}
        </script>		
		<?
        }
		$datepass=substr($sDatepass,0,10);
		$datenow=date("Y-m-d");
		
		$df=date_diff($datepass,$datenow);
		if($df > 30){
		?>
		<script>
		if(confirm('��й���ҹ���� Password ����Թ�������ҷ���˹����� ������ҹ�ӡ������¹ Password ���� ���ͤ�����ʹ���㹡����ҹ�к����¤�Ѻ ����¹���ʼ�ҹ�� OK ���� �����ʼ�ҹ����� CANCLE')){
        	window.open('newpw.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=yes, status=no,resizable=no,width=800,height=600,top=220,left=650 ' );
        }
        </script>			
		<?
        }
	}
	
	
	////*runno ��Ǩ�آ�Ҿ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
////*runno ��Ǩ�آ�Ҿ*/////////

	
	

	$query3 = "SELECT * FROM tb_assess WHERE row_id = '$sRowid' and year = '$nPrefix' ";
	$result3 = mysql_query($query3) or die("Query failed");
	$nrow3 = mysql_num_rows($result3);
	if($nrow3==0){
		?>
		<script>
		alert('�ͤ���������ͪ��µͺẺ�ͺ��������֧���\n�к�������ͧ�ç��Һ�����͹�仾Ѳ��������觢�鹤�Ѻ');
        window.open('assess/question_com.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=yes, status=no,resizable=no,width=800,height=600,top=220,left=650 ' );
        </script>
        
		<?
		print "<font face='THSarabunPSK'><a href='assess/question_com.php' target='_blank' ><br><B>Ẻ�ͺ��������֧���<br>�к�������ç��Һ��</B></a></font><br><br>";
		
	}
	
	print "<font face='THSarabunPSK'><a href='menulst.php' ><B>������<BR>���������ѡ�������� 3</B></a></font>";
print "<BR>*********";	
    print "</body>";
	if($sIdname==$sPword){echo "<script>alert('����͹! ���ʼ�ҹ�ͧ��ҹ�ѧ���������¹�ŧ ��س�����¹���ʼ�ҹ�����������¹�������ͤ�����ʹ��¢ͧ��ҹ') </script>";};

	/*echo "<script>alert('�ٹ�����������зӡ�û�Ѻ��ا�ҹ�����Ť��������� �դ������繻Դ����ԡ������ 00.30 - 02.00 �ջѭ�ҡ����ҹ�Դ������� 6206') </script>"; */
	include("connect.inc");  

	$sql = "Select left(prefix,2) From runno where title = 'HN' ";
	list($title_hn) = Mysql_fetch_row(Mysql_Query($sql));

	$year_now = substr(date("Y")+543,2);

	if($title_hn != $year_now){

		$sql1= "Update runno set prefix = '56-', runno = 0 where  title = 'HN' limit 1;";
		$result1 = mysql_Query($sql1);
		$sql2 = "Update runno set prefix = '56/', runno = 0 where  title = 'AN' limit 1;";
		$result2 = mysql_Query($sql2);
		$sql3 = "Update runno set prefix = '56/', runno = 0 where  title = 'nid_c' limit 1;";
		$result3 = mysql_Query($sql3);
	}
	

	include("unconnect.inc");
?>