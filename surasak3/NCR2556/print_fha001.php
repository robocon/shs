<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Ẻ��§ҹ������Ҵ����͹�ҧ���ç��Һ�Ť�������ѡ��������</title>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('fha_date'));

};

</script>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14px;
	color: #FFFFFF;
	font-weight: bold;

}
</style>
</head>

<body>
<?php
include("connect.inc");

if(empty($_GET["view"])){
?>
<script language="javascript">
	window.onload = function(){
		window.print();
		//window.close();
	}
	
</script>
<?php } ?>
<?php
	

		
		$sql = "Select * From drug_fail where drug_fail_id = '".$_GET["id"]."' limit  1 ";
		$result = Mysql_Query($sql) or die(mysql_error());
		$arr_edit = mysql_fetch_assoc($result);
		

?>

<table width="741" border="1" bordercolor="#3366FF" align="center" cellpadding="2" cellspacing="2" >
  <tr>
    <td align="center" bgcolor="#3366FF"><FONT SIZE="1" COLOR="#FFFFFF"><B>Ẻ��§ҹ������Ҵ����͹�ҧ���ç��Һ�Ť�������ѡ��������</B></FONT></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellpadding="2" cellspacing="1">
      <tr>
        <td width="741"></td>
      </tr>
      <tr>
        <td align="left">���ͼ����§ҹ (���Ѫ��, ᾷ��, ��Һ��) :
          <input name="send_by" type="text" id="send_by" value="<?php echo $arr_edit["send_by"];?>" maxlength="50" />
          ˹��§ҹ�ͧ��ҹ  :
          <select name="until">
            <option value="">--------------</option>
            <?php
										foreach($cfg_until as $key => $value){
											echo "<Option value=\"".$key."\" ";
												if($arr_edit["until"] == $key ) echo " Selected ";
											echo ">".$value."</Option>";
										}
									?>
          </select></td>
      </tr>
      <tr>
        <td align="left">
          ʶҹ��辺�˵ء�ó�
          <input name="location" type="text" id="location" maxlength="50" value="<?php echo $arr_edit["location"];?>"/>
          ʶҹ����Դ�˵ء�ó�
          <select name="area">
            <option value="">--------------</option>
            <?php
										foreach($cfg_until as $key => $value){
											echo "<Option value=\"".$key."\" ";
												if($arr_edit["area"] == $key ) echo " Selected ";
											echo ">".$value."</Option>";
										}
									?>
          </select></td>
      </tr>
      <tr>
        <td align="left">�ѹ��͹�շ���Դ������Ҵ����͹�ҧ�Ң��
          <input name="fha_date" type="text" id="fha_date" size="10" maxlength="10" value="<?php echo $arr_edit["fha_date"];?>" />
          &nbsp;&nbsp;
          ���ҷ���Դ
          <select name="fha_time1">
		  		<option value="">--</option>
                <?php 
				list($fha_time1,$fha_time2,$fha_time3) = explode(":",$arr_edit["fha_time"]);
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($fha_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
              </select>
          :
          <select name="fha_time2">
		  	<option value="">--</option>
            <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($fha_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
          </select>
          �.</td>
      </tr>
      <tr>
        <td align="left" valign="top">��سҺ����¤�����Ҵ����͹�ҧ�ҷ���Թ���<br />
          &nbsp; &nbsp; &nbsp; &nbsp;
          <textarea name="detail" cols="60" rows="4" id="detail"><?php echo $arr_edit["detail"];?></textarea></td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
            <tr>
              <td width="41%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
			  	 <tr>
                    <td align="left">
					�������ͧ Error :
                      <select name="type_error">
					  <option value="" >-- �������ͧ Error --</option>
                      <option value="T" <?php if($arr_edit["type_error"]=="T") echo " Selected "; ?>>Transcribing Error</option>
                      <option value="P" <?php if($arr_edit["type_error"]=="P") echo " Selected "; ?>>Processing Error</option>
                      <option value="D" <?php if($arr_edit["type_error"]=="D") echo " Selected "; ?>>Dispansing</option>
                      <option value="A" <?php if($arr_edit["type_error"]=="A") echo " Selected "; ?>>Administration</option>

                    </select>                    </td>
                  </tr>
                  <tr>
                    <td align="left"><strong>���Ѿ��</strong>&nbsp; ��ͼ�����<br />
                      Category :
                      <select name="category">
					  <option value="">-- category --</option>
                      <option value="A" <?php if($arr_edit["category"]=="A") echo " Selected "; ?>>A</option>
                      <option value="B" <?php if($arr_edit["category"]=="B") echo " Selected "; ?>>B</option>
                      <option value="C" <?php if($arr_edit["category"]=="C") echo " Selected "; ?>>C</option>
                      <option value="D" <?php if($arr_edit["category"]=="D") echo " Selected "; ?>>D</option>
                      <option value="E" <?php if($arr_edit["category"]=="E") echo " Selected "; ?>>E</option>
                      <option value="F" <?php if($arr_edit["category"]=="F") echo " Selected "; ?>>F</option>
                      <option value="G" <?php if($arr_edit["category"]=="G") echo " Selected "; ?>>G</option>
                      <option value="H" <?php if($arr_edit["category"]=="H") echo " Selected "; ?>>H</option>
                      <option value="I" <?php if($arr_edit["category"]=="I") echo " Selected "; ?>>I</option>
                    </select>                    </td>
                  </tr>
                  <tr>
                    <td align="left"><br />
<strong>��Դ</strong> �ͧ������Ҵ����͹�ҧ��<br />
                            <input name="kind1" type="checkbox" value="1" <?php if($arr_edit["kind1"]=="1") echo " Checked "; ?> />
                      &nbsp;��������ú (���������ͼ����»���ʸ��)<br />
                      <input name="kind2" type="checkbox" value="1" <?php if($arr_edit["kind2"]=="1") echo " Checked "; ?> />
                      &nbsp;����ҼԴ��Դ<br />
                      <input name="kind3" type="checkbox" value="1" <?php if($arr_edit["kind3"]=="1") echo " Checked "; ?> />
                      &nbsp;������¼���������������<br />
                      <input name="kind4" type="checkbox" value="1" <?php if($arr_edit["kind4"]=="1") echo " Checked "; ?> />
                      &nbsp;����ҼԴ��<br />
                      <input name="kind5" type="checkbox" id="kind5" value="1" <?php if($arr_edit["kind5"]=="1") echo " Checked "; ?> />
                      &nbsp;����ҼԴ��Ҵ<br />
                      <input name="kind6" type="checkbox" id="kind6" value="1" <?php if($arr_edit["kind6"]=="1") echo " Checked "; ?> />
                      &nbsp;����ҼԴ�Զշҧ<br />
                      <input name="kind7" type="checkbox" id="kind7" value="1" <?php if($arr_edit["kind7"]=="1") echo " Checked "; ?> />
                      &nbsp;����ҼԴ����<br />
                      <input name="kind8" type="checkbox" id="kind8" value="1" <?php if($arr_edit["kind8"]=="1") echo " Checked "; ?> />
                      &nbsp;������ҡ���Ҩӹǹ���駷�����<br />
                      <input name="kind9" type="checkbox" id="kind9" value="1" <?php if($arr_edit["kind9"]=="1") echo " Checked "; ?> />
                      &nbsp;�������ѵ�����Ƿ��Դ<br />
                      <input name="kind10" type="checkbox" id="kind10" value="1" <?php if($arr_edit["kind10"]=="1") echo " Checked "; ?> />
                      &nbsp;����ҼԴ෤�Ԥ<br />
                      <input name="kind11" type="checkbox" id="kind11" value="1" <?php if($arr_edit["kind11"]=="1") echo " Checked "; ?> />
                      &nbsp;����ҼԴ�ٻẺ��<br />
                      <input name="kind12" type="checkbox" id="kind12" value="1" <?php if($arr_edit["kind12"]=="1") echo " Checked "; ?> />
                      &nbsp;�������������������<br />
                      <input name="kind13" type="checkbox" id="kind13" value="1" <?php if($arr_edit["kind13"]=="1") echo " Checked "; ?> />
                      &nbsp;��õԴ�������������������������Դ<br />
                      &nbsp;  &nbsp;  &nbsp;
                      <input name="kind13_1" type="checkbox" id="kind13_1" value="1" <?php if($arr_edit["kind13_1"]=="1") echo " Checked "; ?> />
                      &nbsp;��ԡ����������ҧ
                      &nbsp;  &nbsp;  &nbsp;
                                        <input name="kind13_2" type="checkbox" id="kind13_2" value="1" <?php if($arr_edit["kind13_2"]=="1") echo " Checked "; ?> />
                      &nbsp;���Ѻ�ҷ��������ջ���ѵ���<br />
                      ���� (�к�)
                      <input name="kind_etc" type="text" value="<?php echo $arr_edit["kind_etc"];?>" maxlength="50" />
                      <br />                    </td>
                  </tr>
                  <tr>
                    <td align="left"><strong>��</strong> ��Դ��� 1 �������Ǣ�ͧ<br />
                      ���͡�ä����
                      <input name="genname1" type="text" id="genname1" value="<?php echo $arr_edit["genname1"];?>" size="15" />
                      &nbsp;<br />
                      �������ѭ�ҧ��
                      <input name="tradname1" type="text" id="tradname1" value="<?php echo $arr_edit["tradname1"];?>" size="15" />
                      <br />
                      �ٻẺ��
                      <input name="until1" type="text" id="until1" value="<?php echo $arr_edit["until1"];?>" size="15" />
                      <br />
                      �����ç/��������
                      <input name="flavoure1" type="text" id="flavoure1" value="<?php echo $arr_edit["flavoure1"];?>" size="15" /></td>
                  </tr>
                  <tr>
                    <td align="left"><br /></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>��</strong> ��Դ��� 2 �������Ǣ�ͧ<br />
                      ���͡�ä����
                      <input name="genname2" type="text" id="genname2" value="<?php echo $arr_edit["genname2"];?>" size="15" />
                      &nbsp;<br />
                      �������ѭ�ҧ��
                      <input name="tradname2" type="text" id="tradname2" value="<?php echo $arr_edit["tradname2"];?>" size="15" />
                      <br />
                      �ٻẺ��
                      <input name="until2" type="text" id="until2" value="<?php echo $arr_edit["until2"];?>" size="15" />
                      <br />
                      �����ç/��������
                      <input name="flavoure2" type="text" id="flavoure2" value="<?php echo $arr_edit["flavoure2"];?>" size="15" /></td>
                  </tr>
              </table></td>
              <td width="59%" align="left" valign="top">���˵� �ͧ������Ҵ����͹�ҧ�� : �Դ�ҡ (���͡�� <u>&gt;</u> 1���)<br />
                &nbsp;&nbsp; 1. ��õԴ���������� <br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                <input name="cause1_1" type="checkbox" id="cause1_1" value="1" <?php if($arr_edit["cause1_1"]=="1") echo " Checked "; ?> />
                �����Ҩ�<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                <input name="cause1_2" type="checkbox" id="cause1_2" value="1" <?php if($arr_edit["cause1_2"]=="1") echo " Checked "; ?> />
                ��äѴ�͡/�Ť�������ҼԴ<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; �����¹���������<br />
                <table width="100%" border="0">
                  <tr>
                    <td>&nbsp;</td>
                    <td width="7%"><input name="cause1_3" type="checkbox" id="cause1_3" value="1" <?php if($arr_edit["cause1_3"]=="1") echo " Checked "; ?> /></td>
                    <td width="27%">��ҹ����������͡</td>
                    <td width="7%" align="right"><input name="cause1_6" type="checkbox" id="cause1_6" value="1" <?php if($arr_edit["cause1_6"]=="1") echo " Checked "; ?> /></td>
                    <td width="53%">�����������������</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause1_4" type="checkbox" id="cause1_4" value="1" <?php if($arr_edit["cause1_4"]=="1") echo " Checked "; ?> /></td>
                    <td>��˹��¼Դ</td>
                    <td align="right"><input name="cause1_7" type="checkbox" id="cause1_7" value="1" <?php if($arr_edit["cause1_7"]=="1") echo " Checked "; ?> /></td>
                    <td>���ٹ����ѧ�ش�ȹ���</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause1_5" type="checkbox" id="cause1_5" value="1" <?php if($arr_edit["cause1_5"]=="1") echo " Checked "; ?> /></td>
                    <td>���ٹ��˹�ҵ���Ţ</td>
                    <td align="right"><input name="cause1_8" type="checkbox" id="cause1_8" value="1" <?php if($arr_edit["cause1_8"]=="1") echo " Checked "; ?> /></td>
                    <td>����ըش�ȹ���
                      <input name="cause1_9" type="checkbox" id="cause1_9" value="1" <?php if($arr_edit["cause1_9"]=="1") echo " Checked "; ?> />
                      ��ҹ�Դ </td>
                  </tr>
                </table>
������
            ��������
            ��������
            ��������
            ��������
            ��������
            ��������
            ��������
            ��������
            ��������
            ��������
            ��������
            ��������
            ��������
            ��������
            ��������
            2.����/�ѡɳТͧ�ҷ�����Ѻʹ
            <table width="100%" border="0">
              <tr>
                <td width="6%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td width="94%"><input name="cause2_1" type="checkbox" id="cause2_1" value="1" <?php if($arr_edit["cause2_1"]=="1") echo " Checked "; ?> />
                  �������͡���§����¡ѹ ���
                  <input name="cause2_1_1" type="text" id="cause2_1_1" value="<?php echo $arr_edit["cause2_1_1"];?>" size="12" />
                  �Ѻ
                  <input name="cause2_1_2" type="text" id="cause2_1_2" value="<?php echo $arr_edit["cause2_1_2"];?>" size="12" /></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td><input name="cause2_2" type="checkbox" id="cause2_2" value="1" <?php if($arr_edit["cause2_2"]=="1") echo " Checked "; ?> />
                  �Ҫ�к�èؤ���¡ѹ  ���
                  <input name="cause2_2_1" type="text" id="cause2_2_1" value="<?php echo $arr_edit["cause2_2_1"];?>" size="12" />
                  �Ѻ
                  <input name="cause2_2_2" type="text" id="cause2_2_2" value="<?php echo $arr_edit["cause2_2_2"];?>" size="12" /></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td><input name="cause2_3" type="checkbox" id="cause2_3" value="1" <?php if($arr_edit["cause2_3"]=="1") echo " Checked "; ?> />
                  �ѡɳ�/���Ҥ���¡ѹ  ���
                  <input name="cause2_3_1" type="text" id="cause2_3_1" value="<?php echo $arr_edit["cause2_3_1"];?>" size="12" />
                  �Ѻ
                  <input name="cause2_3_2" type="text" id="cause2_3_2" value="<?php echo $arr_edit["cause2_3_2"];?>" size="12" /></td>
              </tr>
            </table>
                <br />
                3.��ҡ��
                <table width="100%" border="0">
                  <tr>
                    <td width="5%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td colspan="2"><input name="cause3_1" type="checkbox" id="cause3_1" value="1" <?php if($arr_edit["cause3_1"]=="1") echo " Checked "; ?> />
                      ��ҡ�ҡ����ѷ�Ҥ���¡ѹ</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2"><input name="cause3_2" type="checkbox" id="cause3_2" value="1" <?php if($arr_edit["cause3_2"]=="1") echo " Checked "; ?> />
                      ��ҡ�ҷ�������������</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td width="40%"><input name="cause3_3" type="checkbox" id="cause3_3" value="1" <?php if($arr_edit["cause3_3"]=="1") echo " Checked "; ?> />
                      ���й�㹡������</td>
                    <td width="55%"><input name="cause3_6" type="checkbox" id="cause3_6" value="1" <?php if($arr_edit["cause3_6"]=="1") echo " Checked "; ?> />
                      ���й�㹡���������ú</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause3_4" type="checkbox" id="cause3_4" value="1" <?php if($arr_edit["cause3_4"]=="1") echo " Checked "; ?> />
                      �����ҼԴ</td>
                    <td><input name="cause3_7" type="checkbox" id="cause3_7" value="1" <?php if($arr_edit["cause3_7"]=="1") echo " Checked "; ?> />
                      ��Ҵ�ҼԴ</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause3_5" type="checkbox" id="cause3_5" value="1" <?php if($arr_edit["cause3_5"]=="1") echo " Checked "; ?> />
                      �����¼Դ��</td>
                    <td>���� �к� :
                      <input name="cause3_8" type="text" id="cause3_8" value="<?php echo $arr_edit["cause3_8"];?>" size="15" /></td>
                  </tr>
                </table>
                <br />
                4. �ؤ�ҡ�
                <table width="100%" border="0">
                  <tr>
                    <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td width="6%"><input name="cause4_1" type="checkbox" id="cause4_1" value="1" <?php if($arr_edit["cause4_1"]=="1") echo " Checked "; ?> /></td>
                    <td width="42%">�Ҵ�������</td>
                    <td width="7%"><input name="cause4_5" type="checkbox" id="cause4_5" value="1" <?php if($arr_edit["cause4_5"]=="1") echo " Checked "; ?> /></td>
                    <td width="41%">��û�Ժѵԧҹ�����ͧ</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause4_2" type="checkbox" id="cause4_2" value="1" <?php if($arr_edit["cause4_2"]=="1") echo " Checked "; ?> /></td>
                    <td>����������Դ��Ҵ</td>
                    <td><input name="cause4_6" type="checkbox" id="cause4_6" value="1" <?php if($arr_edit["cause4_6"]=="1") echo " Checked "; ?> /></td>
                    <td>���������ҼԴ��Ҵ</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause4_3" type="checkbox" id="cause4_3" value="1" <?php if($arr_edit["cause4_3"]=="1") echo " Checked "; ?> /></td>
                    <td>����ҼԴ�Ѵ�͡��������ҼԴ</td>
                    <td colspan="2">���� �к� :
                      <input name="cause4_7" type="text" id="cause4_7" value="<?php echo $arr_edit["cause4_7"];?>" size="15" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause4_4" type="checkbox" id="cause4_4" value="1" <?php if($arr_edit["cause4_4"]=="1") echo " Checked "; ?> /></td>
                    <td>�ӹǹ��Ҵ�������ѵ�ҡ��</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <br />
                5.�Ѩ�����������ԧ�к���ͧ
                <table width="100%" border="0">
                  <tr>
                    <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td width="6%"><input name="cause5_1" type="checkbox" id="cause5_1" value="1" <?php if($arr_edit["cause5_1"]=="1") echo " Checked "; ?> /></td>
                    <td width="36%">�ʧ���ҧ ���§ú�ǹ </td>
                    <td width="7%"><input name="cause5_5" type="checkbox" id="cause5_5" value="1" <?php if($arr_edit["cause5_5"]=="1") echo " Checked "; ?> /></td>
                    <td width="47%">��âѴ�ѧ���</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause5_2" type="checkbox" id="cause5_2" value="1" <?php if($arr_edit["cause5_2"]=="1") echo " Checked "; ?> /></td>
                    <td>��ý֡ͺ��</td>
                    <td><input name="cause5_6" type="checkbox" id="cause5_6" value="1" <?php if($arr_edit["cause5_6"]=="1") echo " Checked "; ?> /></td>
                    <td>�ؤ�ҡ������§��</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause5_3" type="checkbox" id="cause5_3" value="1" <?php if($arr_edit["cause5_3"]=="1") echo " Checked "; ?> /></td>
                    <td>�к����������������ҧ</td>
                    <td><input name="cause5_7" type="checkbox" id="cause5_7" value="1" <?php if($arr_edit["cause5_7"]=="1") echo " Checked "; ?> /></td>
                    <td>�ؤ�ҡ�����������</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause5_4" type="checkbox" id="cause5_4" value="1" <?php if($arr_edit["cause5_4"]=="1") echo " Checked "; ?> /></td>
                    <td>�Ҵ��º��</td>
                    <td colspan="2">���� �к� :
                      <input name="cause5_8" type="text" id="cause5_8" value="<?php echo $arr_edit["cause5_8"];?>" size="15" /></td>
                  </tr>
                </table></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php echo $hd;?>

</body>
</html>

