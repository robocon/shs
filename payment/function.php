<?
function convert($number){ 
$txtnum1 = 
array('�ٹ��','˹��','�ͧ','���','���','���','ˡ','��','Ỵ','���','�Ժ'); 
$txtnum2 = 
array('','�Ժ','����','�ѹ','����','�ʹ','��ҹ'); 
$number = str_replace(",","",$number); 
$number = str_replace(" ","",$number); 
$number = str_replace("�ҷ","",$number); 
$number = explode(".",$number); 
if(sizeof($number)>2){ 
return '�ȹ������µ�ǹШ��'; 
exit; 
} 
$strlen = strlen($number[0]); 
$convert = ''; 
for($i=0;$i<$strlen;$i++){ 
$n = substr($number[0], $i,1); 
if($n!=0){ 
if($i==($strlen-1) AND $n==1){ $convert .= 
'���'; } 
elseif($i==($strlen-2) AND $n==2){ 
$convert .= '���'; } 
elseif($i==($strlen-2) AND $n==1){ 
$convert .= ''; } 
else{ $convert .= $txtnum1[$n]; } 
$convert .= $txtnum2[$strlen-$i-1]; 
} 
} 
$convert .= '�ҷ'; 
if($number[1]=='0' OR $number[1]=='00' OR 
$number[1]==''){ 
$convert .= '��ǹ'; 
}else{ 
$strlen = strlen($number[1]); 
for($i=0;$i<$strlen;$i++){ 
$n = substr($number[1], $i,1); 
if($n!=0){ 
if($i==($strlen-1) AND $n==1){$convert 
.= '���';} 
elseif($i==($strlen-2) AND 
$n==2){$convert .= '���';} 
elseif($i==($strlen-2) AND 
$n==1){$convert .= '';} 
else{ $convert .= $txtnum1[$n];} 
$convert .= $txtnum2[$strlen-$i-1]; 
} 
} 
$convert .= 'ʵҧ��'; 
} 
return $convert; 
}
?>