function newXmlHttp(){
    var xmlhttp = false;

        try{
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(e){
                xmlhttp = false;
            }
        }

        if(!xmlhttp && document.createElement){
            xmlhttp = new XMLHttpRequest();
        }
    return xmlhttp;
}

function checksit(divId,idcard,person_id,smctoken){

    var request = new newXmlHttp();
    request.onreadystatechange = function() {
        if (request.readyState === 4){
            var data = JSON.parse(request.responseText);
            
            if(typeof data.maininscl_name !== 'undefined'){
                var html = '<br><div style="color: blue;"><b>สิทธิจาก WebService สปสช</b></div>';
                html += '<div>&gt;&gt;&nbsp;'+data.maininscl_name+'</div>';
                html += '<div>&gt;&gt;&nbsp;'+data.subinscl_name+'</div>';
                html += '<div style="color:red;"><b>สิทธิไม่ตรงกรุณาประสานทะเบียนเพื่อแก้ไขสิทธิต่อไป</b></div><br>';

                setTimeout(function(){
                    document.getElementById(divId).innerHTML = html;
                }, 1500);
            }else{
                document.getElementById(divId).innerHTML = '<br><div style="color:red;">'+data.ws_status_desc+'<br>เจ้าหน้าที่ห้องทะเบียนไม่ยืนยันตัวตนการใช้งาน<br>ไม่สามารถตรวจสอบสิทธิผ่าน WebService สปสช ได้<div><br>';
            }
        }
    };
    request.open('GET', 'nhsoBroker.php?idcard='+idcard+'&user_person_id='+person_id+'&smctoken='+smctoken, true);
    request.send();

}