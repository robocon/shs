<?php
session_start();
   
require "includes/functions.php";

if(PHP_VERSION_ID <= 50217){
	session_unregister("cIdcard");  
	session_unregister("cHn");  
	session_unregister("cPtname");
	session_unregister("cPtright");
	session_unregister("nVn");
	session_unregister("cAge");  
	session_unregister("nRunno");  
	session_unregister("vAN"); 
	session_unregister("thdatehn"); 
	session_unregister("cNote"); 
}else{
	unset($_SESSION['cIdcard']);
	unset($_SESSION['cHn']);
	unset($_SESSION['cPtname']);
	unset($_SESSION['cPtright']);
	unset($_SESSION['nVn']);
	unset($_SESSION['cAge']);
	unset($_SESSION['nRunno']);
	unset($_SESSION['vAN']);
	unset($_SESSION['thdatehn']);
	unset($_SESSION['cNote']);
}
?>


<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		var stat = true;
		var id13 = document.f1.idcard.value;
		var sum = 0;

		
			if(id13 != "" && id13 != "-"){
				
				if(id13.length != 13){
					alert("�Ţ�ѵû�ЪҪ����١��ͧ");
					stat = false;
				}

				if(stat == true){
						
						for (i = 0; i < 12; i++)
						{
							sum += eval(id13.charAt(i)) * (13 - i);
						}

					sum = ((11 - (sum % 11)) % 10)
					
					if(eval(id13.charAt(12)) != sum)
						if(confirm("�к���Ǩ�ͺ��Ҥس��͡�Ţ�ѵû�ЪҪ����١��ͧ \n �س��ͧ��á�Ѻ�����������?"))
							stat = false;
						else
							stat = true;
				}
			}
			
		return stat;
	}

</SCRIPT>

<form name="f1" method="post" action="<?php echo $PHP_SELF ?>" Onsubmit="return checkForm();">
  <p>&nbsp;&nbsp;&nbsp;���Ҥ���ҡ�Ţ�ѵû�Шӵ��13��ѡ</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ID&nbsp;&nbsp;&nbsp;
  <input type="text" name="idcard" size="16" id="aLink"></p>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="     ��ŧ     " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ź���  " name="B2"></p>
</form>

<table>
 <tr>
  <th bgcolor=6495ED>�Ţ�ѵ� ���.</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>��</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>ʡ��</th>
   <th bgcolor=6495ED>�Է��</th>
 <th bgcolor=6495ED>�� þ.</th>
  <th bgcolor=6495ED>��Ǩ�Ѵ</th>
  <th bgcolor=6495ED>��Ǩ�͹</th>
 </tr>

<?php
$pre_hn = null;
If (!empty($idcard)){
    include("connect.inc");
    $query = "SELECT idcard,hn,yot,name,surname,ptright1, idcard FROM opcard WHERE idcard = '$idcard'";
    $result = mysql_query($query)
        or die("query failed,opcard");

    while (list ($idcard,$hn,$yot,$name,$surname,$ptright, $idcard) = mysql_fetch_row ($result)) {
		
		$pre_hn = $hn;
		
		if(substr($ptright,0,3)=='R07' && !empty($idcard)){
			$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "#CCFF00";
			}else{
				$color = "FF8C8C";
			}
		}else if(substr($ptright,0,3)=='R03'){
			$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "99CC00";
			}else{
				$color = "FF8C8C";
			}
		}else{
			$color = "66CDAA";
		}



	if(!empty($idcard)){
		$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			echo"���������Է�Ի�Сѹ�ѧ��";
		}else{
			echo"";
		}
	}else{
		echo"������������Ţ��Шӵ�ǻ�ЪҪ�";
	}


	if(!empty($hn)){
		$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";			
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			echo"���������Է�Ԩ��µç";
		}else{
			echo"";
		}
	}else{
		echo"����������� HN";
	}



        print (" <tr>\n".
           "  <td BGCOLOR=".$color."><a target=_BLANK  href=\"opedit.php? cIdcard=$idcard&cHn=$hn & cName=$name &cSurname=$surname\">$idcard</a></td>\n".
           "  <td BGCOLOR=".$color.">$hn</td>\n".
           "  <td BGCOLOR=".$color.">$yot</td>\n".
           "  <td BGCOLOR=".$color.">$name</td>\n".
           "  <td BGCOLOR=".$color.">$surname</td>\n".
			    "  <td BGCOLOR=".$color.">$ptright</td>\n".
 "  <td BGCOLOR=".$color."><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">�� þ.</td>\n".
         "  <td BGCOLOR=".$color."><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">��Ǩ�Ѵ</td>\n".
    "  <td BGCOLOR=".$color."><a target= _BLANK href=\"ancheck.php?hn=$hn\">��Ǩ�͹</td>\n".
           " </tr>\n");
       }

       }
?>
</table>
<FONT SIZE="2" COLOR="#990000">***��͸Ժ��***</FONT> <BR>
<FONT SIZE="" COLOR="66CDAA">������ ��� �ѧ�����ӡ�õ�Ǩ�Է�ԡ���ѡ��</FONT><BR>
<FONT SIZE="" COLOR="#CCFF00">��������͹ ��� ��Ǩ�ͺ���� ���Է�Ի�Сѹ�ѧ��</FONT><BR>
<FONT SIZE="" COLOR="#99CC00">��������͹ ��� ��Ǩ�ͺ���� ���Է�Ԩ��µç</FONT><BR>
<FONT SIZE="" COLOR="#FF0033">��ᴧ ��� ������Է��</FONT><BR>

<?php

if($pre_hn !== null){
	
	$sql = sprintf("SELECT `hn`,`dcdate`, `my_ward`
	FROM `ipcard` 
	WHERE `hn` = '%s' 
	ORDER BY `row_id` DESC LIMIT 1", $pre_hn);
	$query = mysql_query($sql);
	$item = mysql_fetch_assoc($query);
	
	if($item != false && $item['dcdate'] == '0000-00-00 00:00:00'){
		?>
		<script type="text/javascript">
			alert('<?php echo '�������ѧ������ '.$item['my_ward'];?>');
		</script>
		<?php
	}
}	
	
include("unconnect.inc");
?>