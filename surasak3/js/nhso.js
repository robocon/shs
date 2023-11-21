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

                var inscl_name = data.maininscl_name;

                if(typeof data.hmain_name !== 'undefined'){
                    inscl_name += ' ('+data.hmain+' - '+data.hmain_name+')';
                }

                var html = '<br><div style="color: blue;"><b>สิทธิจาก WebService สปสช</b></div>';
                html += '<div>สิทธิหลัก:&nbsp;<b style="color: green;">'+inscl_name+'</b></div>';
                html += '<div style="color:red;"><b>หากไม่แน่ใจเรื่องสิทธิการรักษา<br>กรุณาติดต่อห้องทะเบียนเพื่อทบทวนสิทธิผู้ป่วย</b></div><br>';

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

function registerChecksit(divId,idcard,person_id,smctoken){
    var request = new newXmlHttp();
    request.onreadystatechange = function() {
        if (request.readyState === 4){
            var data = JSON.parse(request.responseText);
            
            if(typeof data.maininscl_name !== 'undefined'){ 

                var inscl_name = data.maininscl_name;

                // if(typeof data.hmain_name !== 'undefined'){
                //     inscl_name += ' ('+data.hmain+' - '+data.hmain_name+')';
                // }

                var html = '<div style="color: blue;"><h3 style="margin:0;">ข้อมูลสิทธิจาก WebService สปสช</h3></div>';
                html += '<div>ชื่อ-สกุล:&nbsp;<b style="color: green;">'+data.title_name+data.fname+' '+data.lname+'</b></div>';
                html += '<div>เลขที่บัตรประชาชน:&nbsp;<b style="color: green;">'+data.person_id+'</b></div>';

                var birthDay = data.birthdate.substring(6, 8)+" / "+data.birthdate.substring(4, 6)+" / "+data.birthdate.substring(0, 4);
                html += '<div>วัน/เดือน/ปี เกิด:&nbsp;<b style="color: green;">'+birthDay+'</b></div>';
                if(typeof data.purchaseprovince_name !== 'undefined'){
                    html += '<div>จังหวัดที่สำนักงานประกันสังคมรับผิดชอบ:&nbsp;<b style="color: green;">'+data.purchaseprovince_name+'</b></div>';
                }

                if(typeof data.hsub !== 'undefined'){
                    html += '<div>สถานพยาบาลที่เข้ารับการรักษาเบื้องต้น:&nbsp;<b style="color: green;">'+data.hsub+' - '+data.hsub_name+'</b></div>';
                    html += '<div>สถานพยาบาลที่รับการส่งต่อ:&nbsp;<b style="color: green;">'+data.hmain+' - '+data.hmain_name+'</b></div>';
                }
                
                if(typeof data.hmain !== 'undefined'){
                    html += '<div>รพ.รักษา:&nbsp;<b style="color: green;">'+data.hmain+' - '+data.hmain_name+'</b></div>';
                }
                
                // html += '<div>สิทธิประกันสุขภาพทั้งหมดของท่าน:&nbsp;<b style="color: green;">'+inscl_name+'</b></div>';
                
                if(typeof data.subinscl_name !== 'undefined'){
                    inscl_name += ' - '+data.subinscl_name;
                }

                html += '<div>สิทธิที่เข้ารับบริการ:&nbsp;<b style="color: green;">'+inscl_name+'</b></div>';

                if(data.subinscl_name=='คนพิการ' && data.maininscl=='WEL'){
                    html += '<div>รหัสผู้พิการ:&nbsp;<b style="color: green;">'+data.cardid+'</b></div>';
                    html += '<div>วันที่เริ่มสิทธิ:&nbsp;<b style="color: green;">'+data.startdate+'</b></div>';
                }
                
                setTimeout(function(){
                    document.getElementById(divId).innerHTML = html;
                }, 800);

            }else if(typeof data.status !== 'undefined'){

                if(data.status=='003'){

                    document.getElementById(divId).innerHTML = '<br><div style="color:red;">ข้อมูลตอบกลับจาก สปสช : '+data.status_desc+'<br><div><br>';
                }else if(data.status=='008'){

                    document.getElementById(divId).innerHTML = '<br><div style="color:red;">ผู้ป่วยยังไม่มีสิทธิการรักษา<br><div><br>';
                }

            }else{
                document.getElementById(divId).innerHTML = '<br><div style="color:red;">'+data.ws_status_desc+'<br>เจ้าหน้าที่ห้องทะเบียนไม่ยืนยันตัวตนการใช้งาน<br>ไม่สามารถตรวจสอบสิทธิผ่าน WebService สปสช ได้<div><br>';
            }
        }
    };
    request.open('GET', 'nhsoBroker.php?idcard='+idcard+'&user_person_id='+person_id+'&smctoken='+smctoken, true);
    request.send();
}