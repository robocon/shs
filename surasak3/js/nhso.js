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

async function loadSRM(idcard){ 
    Swal.fire({
        title: "กำลังตรวจสอบสิทธิจาก WebService สปสช \nกรุณารอสักครู่",
        didOpen: () => {
            Swal.showLoading();
        },
    });
    
    loadTokenKey()
    .then((res)=>{
        if(res!==false){
            rightSearch(idcard,res.srmAccessToken).then((resRight)=>{
                if(resRight.error){
                    Swal.fire({
                        title: resRight.error+"\n"+'Token หมดอายุ กรุณาเสียบบัตรประชาชน\nและกด PIN ใหม่อีกครั้ง',
                        icon: "warning",
                        allowOutsideClick: false
                    });
                }else{
                    let hospSubTxt = ``;
                    if(resRight.funds[0].hospSub){
                        hospSubTxt = `<p><b>หน่วยบริการปฐมภูมิ:</b> ${resRight.funds[0].hospSub.hname}(${resRight.funds[0].hospSub.hcode})</p>`;
                    }

                    let departmentTxt = ``;
                    if(resRight.funds[0].department){
                        departmentTxt = `<p><b>หน่วยงานที่สังกัด:</b> ${resRight.funds[0].department.name} (${resRight.funds[0].department.id})</p>`;
                    }

                    let hospMainOpTxt = ``;
                    if(resRight.funds[0].hospMainOp){
                        hospMainOpTxt = `<p><b>หน่วยบริการประจำ:</b> ${resRight.funds[0].hospMainOp.hname}(${resRight.funds[0].hospMainOp.hcode})</p>`;
                    }

                    let hospMainTxt = ``;
                    if(resRight.funds[0].hospMain){
                        hospMainTxt = `<p><b>หน่วยบริการส่งต่อ:</b> ${resRight.funds[0].hospMain.hname}(${resRight.funds[0].hospMain.hcode})</p>`;
                    }

                    let purchaseProvinceTxt = ``;
                    if(resRight.funds[0].purchaseProvince){
                        purchaseProvinceTxt = `<p><b>จังหวัดที่ลงทะเบียน:</b> ${resRight.funds[0].purchaseProvince.name} (${resRight.funds[0].purchaseProvince.id})</p>`;
                    }
                    
                    Swal.fire({
                        title: "ข้อมูลจาก API สปสช",
                        icon: "success",
                        html:`<div class="sweetContainer"><p><b>ชื่อ-สกุล:</b> ${resRight.tname}${resRight.fname}  ${resRight.lname}</p>
                        <p><b>เลขที่บัตรประชาชน:</b> ${resRight.pid}</p>
                        <p><b>เดือนปีเกิด:</b> ${resRight.birthDate}</p>
                        <p><b>เพศ:</b> ${resRight.sex.name}  <b>สัญชาติ:</b> ${resRight.nation.name}</p>
                        ${hospMainOpTxt}
                        ${hospSubTxt}
                        ${hospMainTxt}
                        <p><b>สิทธิหลัก:</b> ${resRight.funds[0].mainInscl.name} (${resRight.funds[0].mainInscl.id})</p>
                        <p><b>สิทธิย่อย:</b> ${resRight.funds[0].subInscl.name} (${resRight.funds[0].subInscl.id})</p>
                        ${purchaseProvinceTxt}
                        ${departmentTxt}
                        </div>`,
                        allowOutsideClick: false
                    });
                }
            });
        }
    })
    .catch((err)=>{
        console.error("Application level error handling:", err);
    });
}

async function loadTokenKey(){
    try {
        const response = await fetch('http://localhost:8123/index.php');
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const body = await response.json();
        return body;
        
    } catch (error) {
        Swal.fire({
            title: "ไม่พบ Broker surasak",
            icon: "warning",
            html:`<a href="https://www.canva.com/design/DAG0ce5_6uY/aleba9PDJTX2epGVi41dMw/view?utm_content=DAG0ce5_6uY&utm_campaign=designshare&utm_medium=link2&utm_source=uniquelinks&utlId=h0a7d134f55" target="_blank">คลิกที่นี่</a> เพื่อดูขั้นตอนการติดตั้งและใช้งาน`,
            allowOutsideClick: false
        });
        return false;
    }
}

async function rightSearch(idcard,token){
    try {
        const response = await fetch('https://srm.nhso.go.th/api/ucws/v1/right-search?pid='+idcard,{
            headers:{
                'Authorization':'Bearer '+token
            }
        });
        const body = await response.json();
        return body;
    } catch (error) {
        Swal.fire({
            title: "Token หมดอายุ",
            icon: "warning",
            html:`กรุณาเสียบบัตรประชาชน\nและกด PIN ใหม่อีกครั้ง`,
            allowOutsideClick: false
        });
        return false;
    }
    
}