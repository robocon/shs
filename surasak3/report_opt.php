<?  session_start(); ?>
<html>
<head>
<style type="text/css">
			body {
			padding: 0px; 
			margin: 0px;
			}
			.boxreg2{
			font-size:1pt;
			border: 1px  solid;
			width: 2.7in;
			top:8.48in;
			left:4.1in;
			height:0.697in;			
			}
			.boxreg{
			font-size:1pt;
			border: 1px  solid;
			width: 2.7in;
			top:7.614in;
			left:3.9in;
			height:0.697in;			
			}
			div{
			font-family: Tahoma;
			font-size: 11pt;
			border: 0px none;
			left:0.120in;
			color:#000000;
			background-color:transparent;
			position: absolute;
			}
			.line{
			position:absolute;font-size:1pt;
			border: 1px  solid #808080;
			left: 0.052in;
			width: 7.058in;
			height: 1px;
			}
			.BoxForNote{
			position: absolute ;
			font-size:1pt;
			border: 1.5px  solid;
			width: 2.9in;
			left: 0.045in;
			top:3.1in;
			height:0.735in;
			}
			.BoxBenf{
			position: absolute ;
			font-size:1pt;
			border: 1.5px  solid;
			width: 2in;
			left: 4.15in;
			top:1.5in;
			height:0.735in;
			}
			.3of9B{
			font-family: 3 of 9 Barcode;
			font-size: 16pt;
			background-color:transparent;
			}
		</style>
<? 
include("connect.inc");
$cHn=$_GET['cHn'];

$sql="SELECT concat(yot,name,' ',surname)as ptname ,idcard,hn,dbirth  FROM opcard WHERE hn='$cHn' ";
$result = mysql_query($sql)or die("Query failed opcard");
$arr=mysql_fetch_array($result);
?>

<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head><body><div style="width:100%;top:0in;page-break-after:always;page-break-inside:avoid;"><div style="top:0.25in;">�ç��Һ��: �.�.��������ѡ���(11512)</div><hr style="top:0.45in;" class="line"><div style="top:0.5in;">HN: <?=$arr['hn']?></div><div style="top:0.5in; left:4.108in;">�Ţ���͹��ѵ�</div>
  <div style="text-align: center; width: 1.020in; left: 4.854in; top: 0.5in; font-weight: bold; background-color: #FFFF00;">_ _ _ _ _ _ _ </div><div style="top:0.75in;left:0.5in;" class="3of9B">*<?=$arr['hn']?>*</div><div style="top:1in; left:3.5in;">�Ţ��Шӵ�ǻ�ЪҪ� <?=$arr['idcard']?></div><div style="top:1.25in;left:4.15in;" class="3of9B">*<?=$arr['idcard']?>*</div><div class="BoxBenf"></div><hr style="top:1.75in; left:4.15in; width:2in" class="line"><div style="top:1.5in; left:4.17in;">�Է�����ʴԡ���ѡ�Ҿ�Һ�� :</div><div style="top:1.75in; left:4.2in;">ͧ���û���ͧ��ǹ��ͧ���</div><div style="top:0in; left:2.3in; font-weight: bold;">��Ѥ��ç��è��µç�Է��ͧ���û���ͧ��ǹ��ͧ���</div><div style="top:2in;">������Ѻŧ����¹�����¹͡�ѡ�ҵ�����ͧ</div><div style="top:2.25in;"><i>**��ͧ����ѹ���ǡѹ * �����Ţ������������ѹ</i></div><div style="top:1in;">����-ʡ��: <?=$arr['ptname'];?></div><div style="top:1.5in; font-size: 11pt;"><i></i></div><div style="top:2.635in;">�͡����ѹ���  <?=date("d/m/").(date("Y")+543);?></div><div style="top:2.635in; left:2in;">����  <?=date("H:i:s");?></div><div style="top:2.885in;">����֧�ѹ��� _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</div><div class="BoxForNote"></div><div style="top:3.105in; left:4.060in;">���˹�ҷ������Թ���</div><div style="top:3.4in; left:3.164in;">ŧ����  _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</div><div style="top:3.664in; left:2.997in;">���˹觇 _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</div><div style="top:3.105in;">�����˵�����Ѻ �.�.</div><hr style="top:3.916in; border: 1px  dotted;" class="line"><div style="top:4.120in; left:2.237in; font-weight: bold;">Ẻ���Ѥ���������ç��� �</div><div style="top:4.360in; left:0.6in;">�ç����ԡ���µç�Թ���ʴԡ������ǡѺ����ѡ�Ҿ�Һ���ʶҹ��Һ�Ţͧ�ҧ�Ҫ���</div><div style="top:4.631in; font-weight: bold;">�����ż����Ѥ�</div><div style="top:4.939in; left:1.125in; ">��Ҿ���  <u><?=$arr['ptname']?></u></div><div style="top:5.179in;">�Ţ��Шӵ�Ǽ����� <u><?=$arr['hn']?></u></div><div style="top:5.179in; left:2.05in;">�Ţ��Шӵ��  <u><?=$arr['idcard']?></u></div><div style="top:5.179in; left:4.05in;">�ѹ-��͹-�� �Դ <?=$arr['dbirth'];?></div><div style="top:5.42in; font-size:10pt;"> ����繼�����Է�Է������ª��ͻ�ҡ�����㹰ҹ�����ż�����Է�����Ѻ�Թ����ѡ�Ҿ�Һ�� �դ������ʧ����Ѥ���� </div><div style="top:5.6in; font-size:10pt;"><span style="top:5.42in; font-size:10pt;">�����ç��á���ԡ���µç�Թ���ʴԡ������ǡѺ����ѡ�Ҿ�Һ���ʶҹ��Һ�Ţͧ�ҧ�Ҫ��� ���</span></div><div style="top:5.78in; font-size:10pt;">����Ҫ��ɯա��Թ���ʴԡ������ǡѺ����ѡ�Ҿ�Һ�� �.�.2553 ��з������������</div><div style="top:6.1in; left:0.966in;">��Ҿ����Թ�ըл�ԺѵԵ������º������˹����ء��С��</div><div style="top:6.6in; left:0.347in;">ŧ���� ................................... ����Ѻ��᷹ (�����)</div><div style="top:6.893in; left:0.74in;">(...................................)</div><div style="top:7.143in; left:1.03in;">....../....../.............</div><div style="top:6.6in; left:4in;">ŧ���� ...................................... ������</div>
  <div style="top:6.883in; left:4.6in;">(<?=$arr['ptname']?>)</div><div style="top:7.143in; left:4.7in;">....../....../.............</div><div style="top:7.677in; left:0.347in;">ŧ����  ................................... ����Ѻ��᷹ (�����)</div><div style="top:7.937in; left:0.74in;">(...................................)</div><div style="top:8.187in; left:1.03in;">....../....../.............</div><div class="boxreg"></div><div style="top:7.687in; left:4in;">����Ѻ���˹�ҷ��</div>
  <div style="top:7.958in; left:4in;">�ѹ�����Ѥ� ................... ���� ........</div></div></body></html>