<?
session_start();
if (isset($sIdname)){} else {die;} //for security
include("connect.inc");

		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
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
		
?>
<style type="text/css">
<!--
body,td,th {
	font-family: AngsanaUPC;
	font-size: 16px;
}
-->
</style>

<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center"><strong>Fitness ��� Exercise</strong></td>
  </tr>
  <tr>
    <td width="86%"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td align="center" bgcolor="#FFCCCC"><strong>�����Թ�������ç</strong></td>
        <td align="center" bgcolor="#FFCCCC"><strong>���� - ���ʡ��</strong></td>
      </tr>
      <tr>
        <td width="26%" align="left"><strong>BMI</strong></td>
        <td width="74%" align="left"><?
		$sql = "select * from armychkup where yearchkup='$nPrefix'";
		$query = mysql_query($sql);  		
		while($result=mysql_fetch_array($query)){
		$ptname=$result["yot"]." ".$result["ptname"];		
			if($result['bmi'] >=23.5){
				echo $ptname."<br>";
			}
		}
		?></td>
        </tr>
      <tr>
        <td align="left"><strong>����ͺ���</strong></td>
        <td align="left"><?
		$sql1 = "select * from armychkup where yearchkup='$nPrefix'";
		$query1 = mysql_query($sql1);  			
		while($result1=mysql_fetch_array($query1)){
		$ptname=$result1["yot"]." ".$result1["ptname"];
			if($result1["gender"]=="1"){
				if($result1["waist"] >=35.4){
					echo $ptname."<br>";
				}
			}else if($result1["gender"]=="1"){
				if($result1["waist"] >=31.5){
					echo $ptname."<br>";
				}		
			}
		}
		?></td>
        </tr>
      <tr>
        <td align="left"><strong>%��ѹ</strong></td>
        <td align="left"><?
		$sql2 = "select * from armychkup where yearchkup='$nPrefix'";
		$query2 = mysql_query($sql2);  		
		while($result2=mysql_fetch_array($query2)){
		$ptname=$result2["yot"]." ".$result2["ptname"];		
        	if($result2['result_fat']==4 || $result2['result_fat']==5){
				echo $ptname."<br>";
			}
		}
		?></td>
        </tr>
      <tr>
        <td align="left"><strong>�ç�պ���</strong></td>
        <td align="left"><?
		$sql3 = "select * from armychkup where yearchkup='$nPrefix'";
		$query3 = mysql_query($sql3);  		
		while($result3=mysql_fetch_array($query3)){
		$ptname=$result3["yot"]." ".$result3["ptname"];		
        	if($result3['result_hand']==1 || $result3['result_hand']==2){
				echo $ptname."<br>";
			}
		}
		?></td>
        </tr>
      <tr>
        <td align="left"><strong>�ç����´��</strong></td>
        <td align="left"><?
		$sql4 = "select * from armychkup where yearchkup='$nPrefix'";
		$query4 = mysql_query($sql4);  		
		while($result4=mysql_fetch_array($query4)){
		$ptname=$result4["yot"]." ".$result4["ptname"];		
        	if($result4['result_leg']==1 || $result4['result_leg']==2){
				echo $ptname."<br>";
			}
		}
		?></td>
        </tr>
      <tr>
        <td align="left"><strong>3 Minute Test</strong></td>
        <td align="left"><?
		$sql5 = "select * from armychkup where yearchkup='$nPrefix'";
		$query5 = mysql_query($sql5);  		
		while($result5=mysql_fetch_array($query5)){
		$ptname=$result5["yot"]." ".$result5["ptname"];		
        	if($result5['result_steptest']==1 || $result5['result_steptest']==2){
				echo $ptname."<br>";
			}
		}
		?></td>
        </tr>

    </table></td>
  </tr>
  <tr>
    <td align="center"><strong>�Ѵ��ô�ҹ����ҡ��</strong></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td align="center" bgcolor="#FFCCCC"><strong>�����Թ������آ�Ҿ</strong></td>
        <td align="center" bgcolor="#FFCCCC"><strong>���� - ���ʡ��</strong></td>
      </tr>

      <tr>
        <td width="26%" valign="top"><strong>��ӵ������ʹ</strong></td>
        <td width="74%" valign="top"><?
		$sql6 = "select * from armychkup where yearchkup='$nPrefix'";
		$query6 = mysql_query($sql6);  		
		while($result6=mysql_fetch_array($query6)){
		$ptname=$result6["yot"]." ".$result6["ptname"];		
			if($result6['glu_lab'] =="�Դ����"){
				echo $ptname."<br>";
			}
		}
		?></td>
        </tr>
      <tr>
        <td valign="top"><strong>����ҳ��ѹ</strong></td>
        <td valign="top"><?
		$sql7 = "select * from armychkup where yearchkup='$nPrefix'";
		$query7 = mysql_query($sql1);  			
		while($result7=mysql_fetch_array($query7)){
		$ptname=$result7["yot"]." ".$result7["ptname"];
        	if($result7['chol_lab']=="�Դ����" || $result7['trig_lab']=="�Դ����" || $result7['hdl_lab']=="�Դ����" || $result7['ldl_lab']=="�Դ����"){
				echo $ptname."<br>";
			}
		}
		?></td>
        </tr>
      <tr>
        <td valign="top"><strong>��÷ӧҹ�ͧ�</strong></td>
        <td valign="top"><?
		$sql8 = "select * from armychkup where yearchkup='$nPrefix'";
		$query8 = mysql_query($sql1);  			
		while($result8=mysql_fetch_array($query8)){
		$ptname=$result8["yot"]." ".$result8["ptname"];
        	if($result8['bun_lab']=="�Դ����" || $result8['crea_lab']=="�Դ����"){
				echo $ptname."<br>";
			}
		}
		?></td>
        </tr>
      <tr>
        <td valign="top"><strong>��÷ӧҹ�ͧ�Ѻ</strong></td>
        <td valign="top"><?
		$sql9 = "select * from armychkup where yearchkup='$nPrefix'";
		$query9 = mysql_query($sql1);  			
		while($result9=mysql_fetch_array($query9)){
		$ptname=$result9["yot"]." ".$result9["ptname"];
        	if($result9['alp_lab']=="�Դ����" || $result9['alt_lab']=="�Դ����" || $result9['ast_lab']=="�Դ����"){
				echo $ptname."<br>";
			}
		}
		?></td>
        </tr>
      <tr>
        <td valign="top"><strong>�ô���ԡ</strong></td>
        <td valign="top"><?
		$sql10 = "select * from armychkup where yearchkup='$nPrefix'";
		$query10 = mysql_query($sql10);  			
		while($result10=mysql_fetch_array($query10)){
		$ptname=$result10["yot"]." ".$result10["ptname"];
        	if($result10['uric_lab']=="�Դ����"){
				echo $ptname."<br>";
			}
		}
		?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><strong>�ѡ���ä</strong></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td align="center" bgcolor="#FFCCCC"><strong>���´����ä</strong></td>
        <td align="center" bgcolor="#FFCCCC"><strong>��������´</strong></td>
        </tr>
      <tr>
        <td width="26%" valign="top"><strong>���������</strong><br />
        �ջ���ѵԡ���ѡ����ç��Һ�Ť����</td>
        <td width="74%" valign="top">
        <div style="margin: 5px 5px 5px 5px;">
        <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
          <tr>
            <td align="center" width="30%"><strong>���� - ���ʡ��</strong></td>
            <td align="center" width="30%"><strong>����ѵ���ç��Һ��</strong></td>
            <td align="center" width="38%"><strong>�ä������ᾷ��</strong></td>
          </tr>
          <?
		$sql11 = "select * from armychkup where yearchkup='$nPrefix' and hospitalcongenital_disease !='����ʸ'";
		$query11 = mysql_query($sql11);  		
		while($result11=mysql_fetch_array($query11)){
		$ptname=$result11["yot"]." ".$result11["ptname"];
		$prawat=$result11["prawat"];
        if($result11["prawat"]!="0" && ($result11["hospital"]=="�ç��Һ�Ť�������ѡ��������" || $result11["hospital"]=="�ç��Һ�ž�����خ����")){  //control
		?>
          <tr>
            <td><?=$ptname;?></td>
            <td><?=$result11["hospitalcongenital_disease"];?></td>
            <td><?
				if($prawat=="1"){
					echo "1=�����ѹ���Ե�٧<br>";
				}else if($prawat=="2"){
					echo "2=����ҹ<br>";
				}else if($prawat=="3"){
					echo "3=�ä���������ʹ���ʹ<br>";
				}else if($prawat=="4"){
					echo "4=��ѹ����ʹ�٧<br>";
				}else if($prawat=="5"){
					echo "5=�ä����˹�������� 2 �ä���� (";
					if(!empty($result11['prawat_ht'])){
						echo "HT ";
					}
					if(!empty($result11['prawat_dm'])){
						echo " DM ";
					}
					if(!empty($result11['prawat_cad'])){
						echo " CAD ";
					}
					if(!empty($result11['prawat_dlp'])){
						echo " DLP";
					}
					echo ")<br>";									
				}else if($prawat=="6"){
					echo "6=�ä��Шӵ������ (".$result11['congenital_disease'].")<br>";
				}
			?>            </td>
          </tr>
          <?
	}
}
?>
        </table>
        </div>        </td>
        </tr>
      <tr>
        <td valign="top"><strong>�����·�辺����ѵ�㹤��駹��</strong><br>
        �ѧ����ջ���ѵԡ���ѡ�ҷ���ç��Һ�Ť����</td>
        <td valign="top">
          <div style="margin: 5px 5px 5px 5px;">
            <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr>
                <td align="center" width="30%"><strong>���� - ���ʡ��</strong></td>
                <td align="center" width="30%"><strong>����ѵ���ç��Һ��</strong></td>
                <td align="center" width="38%"><strong>�ä������ᾷ��</strong></td>
              </tr>
        <?
		$sql12 = "select * from armychkup where yearchkup='$nPrefix' and (hospitalcongenital_disease='' || hospitalcongenital_disease like '%����ʸ%') and prawat !='0'";
		//echo $sql12;
		$query12 = mysql_query($sql12);  		
		while($result12=mysql_fetch_array($query12)){
		$ptname=$result12["yot"]." ".$result12["ptname"];
		$prawat=$result12["prawat"];		
        if($result12["prawat"]!="0" && ($result12["hospital"]!="�ç��Һ�Ť�������ѡ��������")){	//Un control
		?>
              <tr>
                <td><?=$ptname;?></td>
                <td><? if(empty($result12["hospitalcongenital_disease"])){ echo "&nbsp;";}else{ echo $result12["hospitalcongenital_disease"];}?></td>
                <td><?
				if($prawat=="1"){
					echo "1=�����ѹ���Ե�٧<br>";
				}else if($prawat=="2"){
					echo "2=����ҹ<br>";
				}else if($prawat=="3"){
					echo "3=�ä���������ʹ���ʹ<br>";
				}else if($prawat=="4"){
					echo "4=��ѹ����ʹ�٧<br>";
				}else if($prawat=="5"){
					echo "5=�ä����˹�������� 2 �ä���� (";
					if(!empty($result12['prawat_ht'])){
						echo "HT ";
					}
					if(!empty($result12['prawat_dm'])){
						echo " DM ";
					}
					if(!empty($result12['prawat_cad'])){
						echo " CAD ";
					}
					if(!empty($result12['prawat_dlp'])){
						echo " DLP";
					}
					echo ")<br>";									
				}else if($prawat=="6"){
					echo "6=�ä��Шӵ������ (".$result12['congenital_disease'].")<br>";
				}
			?>            	</td>
              </tr>
              <?
	}
}
?>
            </table>
          </div></td>
        </tr>

    </table></td>
  </tr>
  <tr>
    <td align="center"><strong>X-Ray</strong></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td align="center" bgcolor="#FFCCCC"><strong>�ѧ�ա���</strong></td>
        <td align="center" bgcolor="#FFCCCC"><strong>���� - ���ʡ��</strong></td>
      </tr>
      <tr>
        <td width="26%" valign="top"><strong>�� X-Ray �Դ����</strong></td>
        <td width="74%" valign="top"><?
		$sql14 = "select * from armychkup where yearchkup='$nPrefix'";
		$query14 = mysql_query($sql14);  		
		while($result14=mysql_fetch_array($query14)){
		$ptname=$result14["yot"]." ".$result14["ptname"];		
        if($result14["xray"]=="�Դ����"){  //control
				echo $ptname."<br>";
			}
		}
		?></td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td align="center"><strong>�ѹ�����</strong></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td align="center" bgcolor="#FFCCCC"><strong>�š�õ�Ǩ����Ъ�ͧ�ҡ</strong></td>
        <td align="center" bgcolor="#FFCCCC"><strong>���� - ���ʡ��</strong></td>
      </tr>
      <tr>
        <td width="26%" valign="top"><strong>�ŵ�Ǩ �Դ����</strong></td>
        <td width="74%" valign="top"><?
		$sql15 = "select * from armychkup where yearchkup='$nPrefix'";
		$query15 = mysql_query($sql15);  		
		while($result15=mysql_fetch_array($query15)){
		$ptname=$result15["yot"]." ".$result15["ptname"];		
        if($result15["result_dental"]=="�Դ����"){  //control
				echo $ptname."<br>";
			}
		}
		?></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>

