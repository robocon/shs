<?php
//    $Thidate = (date("Y")+543).date("-m-d G:i:s"); 
    $Thdate = date("d-m-").(date("Y")+543).'   '.date("H:i:s");
    print "��§ҹ����� $Thdate<br>";
	if($_GET['id']=="41"){
    	print "��¡������� �ͼ����ª��<br>";
	}elseif($_GET['id']=="42"){
    	print "��¡������� �ͼ�����˭ԧ<br>";
	}elseif($_GET['id']=="43"){
    	print "��¡������� �ͼ������ٵԹ��<br>";
	}elseif($_GET['id']=="44"){
    	print "��¡������� �ͼ�����˹ѡ(ICU)<br>";
	}elseif($_GET['id']=="45"){
    	print "��¡������� �ͼ����¾����<br>";
	}
	?>
<style>
.font{
	font-family: AngsanaUPC; 
	font-size:18px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
<table width="100%" class="font">
  <tr>
     <th bgcolor=6495ED width="5%">��§</th>
     <th width="30%" bgcolor=6495ED>���ͼ�����</th>
     <th width="20%" bgcolor=6495ED>�ä</th>
     <th width="15%" bgcolor=6495ED>�ä��Шӵ��</th>
     <th width="30%" bgcolor=6495ED>�����</th>
 </tr>
    <?
    include("connect.inc");
 
    $query = "SELECT bed,ptname,diagnos,diag1,food,bedcode,age,hn
                     FROM bed WHERE bedcode LIKE '".$_GET['id']."%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($bed,$ptname,$diagnos,$diag1,$food,$bedcode,$age,$hn) = mysql_fetch_row ($result)) {
		if($diag1 == "�ä��Шӵ��"){
			$diag1_value = "";
		}else{
			$diag1_value = $diag1;
		}
		
		$sql = "SELECT thidate,weight,height FROM opd WHERE  hn ='$hn' order by thidate DESC limit 1 ";

	   list($thidate,$weight,$height) = mysql_fetch_row(Mysql_Query($sql));
	$bmi='';
	 if($height != "" && $height > 0 && $weight != "" && $weight > 0){$ht = $height/100;
		$bmi =	number_format(($weight/($ht*$ht)),2); }
		
		//print "<table width='100%' border='1' ><tr><th width='7%'>��§</th><th width=37%>���ͼ�����</th><th width=14%>�ä</th><th width=30%>�ä��Шӵ��</th><th width=10%>����</th><th width=10%>BMI</th></tr>";
		?>
          
         <tr style="line-height:16px;">
           <td align="center" valign="top"><?=$bed?></td>
           <td valign="top"><?=$ptname?></td>
           <td valign="top"><?=$diagnos?></td>
           <td valign="top"><?=$diag1_value?></td>
           <td valign="top">
               <u>
               <? 
					if($ptname=="��� �ح���� �ǧʹ�"){
						$food="����û��� ����ҹ ZNa<2g/d,pro90g/d,choles<br /><200mg/d,satfat<10,totaalfat<30totalcal800kcal/d";
						echo $food;
					}else{
						echo $food;
					}			   
			   ?>
               </u>
           </td>
      </tr>
         <?
        }
   // include("unconnect.inc");
?>
</table>
<div id="no_print" > 
---------����§ҹ------------
</div>
