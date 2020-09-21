/*
ระบบเช็กสิทธออนไลน์ผ่าน ucAuthen4.x ถ้าใน IE มีปัญหาสามารถแก้ไขได้โดยเข้าไปที่
Internet Options > Security > Internet > Custom level... 
ที่เมนู Miscellaneous 
1. Access data sources across domains เปิด Enable
2. Allow META REFRESH เปิด Enable
3. Allow scripting of Microsoft web browser control เปิด Enable
*/
function checkPtRight(link, ev, hn){

    // อย่าลืมตรวจดูก่อนว่า include ไฟล์ templates/classic/main.js แล้วรึยัง
    var newSm = new SmHttp();
    newSm.ajax(
        'http://192.168.1.43/index.php',
        { "hn": hn },
        function(res){
            var txt = JSON.parse(res);
            if (txt.ws_status === "NHSO-00003") {
                alertTxt = txt.ws_status_desc+"\nกรุณาเปิดใช้งานโปรแกรม nhsoauthen4.x ก่อนการใช้งานตรวจสอบสิทธิออนไลน์";

            }else{
            
                var subInScl, hMain, hMainOp, hSub, mainInScl, alertTxt = '';
                var title = '';
                if (parseInt(txt.title)==1) {
                    title = 'ด.ช.';
                }else if(parseInt(txt.title)==2){
                    title = 'ด.ญ.';
                }else if(parseInt(txt.title)==3){
                    title = 'นาย';
                }else if(parseInt(txt.title)==4){
                    title = 'น.ส.';
                }else if(parseInt(txt.title)==5){
                    title = 'นาง';
                }

                alertTxt += "## ข้อมูลส่วนบุคคล และสิทธิที่ใช้เบิก ##"+"\n";
                alertTxt += "เลขบัตรประชาชน : "+txt.person_id+"\n";
                alertTxt += "ชื่อ-สกุล : "+title+txt.fname+" "+txt.lname+"\n";
                alertTxt += "ว.ด.ป.เกิด : "+txt.birthdate.substring(6, 8)+"/"+txt.birthdate.substring(4, 6)+"/"+txt.birthdate.substring(0, 4)+"    ";

                if(txt.sex==1){
                    alertTxt += "เพศ : ชาย\n";
                }else{
                    alertTxt += "เพศ : หญิง\n";
                }

                if( txt.status !== undefined ){
                    
                    var ptstatus = '';
                    if (parseInt(txt.status)==1) {
                        ptstatus = 'มีชื่ออยู่ตามทะเบียนบ้านในเขตรับผิดชอบและอยู่จริง';
                    }else if(parseInt(txt.status)==2){
                        ptstatus = 'มีชื่ออยู่ตามทะเบียนบ้านในเขตรับผิดชอบแต่ตัวไม่อยู่จริง';
                    }else if(parseInt(txt.status)==3){
                        ptstatus = 'มาอาศัยอยู่ในเขตรับผิดชอบแต่ทะเบียนบ้านอยู่นอกเขตรับผิดชอบ';
                    }else if(parseInt(txt.status)==4){
                        ptstatus = 'ที่อาศัยอยู่นอกเขตรับผิดชอบและเข้ามารับบริการ';
                    }else if(parseInt(txt.status)==5){
                        ptstatus = 'มาอาศัยในเขตรับผิดชอบแต่ไม่ได้อยู่ตามทะเบียนบ้านในเขตรับผิดชอบ เช่น คนเร่ร่อน ไม่มีที่พักอาศัย เป็นต้น';
                    }

                    alertTxt += "สถานะภาพบุคคล : "+ptstatus+"\n";
                }

                alertTxt += "\n";

                if( txt.maininscl !== undefined ){
                    if( txt.maininscl_name !== undefined ){
                        alertTxt += "สิทธิหลักในการรับบริการ : "+txt.maininscl+" "+txt.maininscl_name+"\n";
                    }

                    if( txt.subinscl_name !== undefined){
                        alertTxt += "ประเภทสิทธิย่อย : "+txt.subinscl+" "+txt.subinscl_name+"\n";
                    }

                    if( txt.cardid !== undefined){
                        alertTxt += "รหัสบัตร : "+txt.cardid+"\n";
                    }

                    if( txt.startdate !== undefined){
                        alertTxt += "วันที่เริ่ม : "+txt.startdate.substring(6, 8)+"/"+txt.startdate.substring(4, 6)+"/"+txt.startdate.substring(0, 4)+"\n";
                    }

                    if( txt.expdate !== undefined){
                        alertTxt += "วันที่หมดสิทธิ : "+txt.expdate.substring(6, 8)+"/"+txt.expdate.substring(4, 6)+"/"+txt.expdate.substring(0, 4)+"\n";
                    }

                    if( txt.purchaseprovince_name !== undefined){
                        alertTxt += "จังหวัดที่ลงทะเบียน : "+txt.purchaseprovince_name+"\n";
                    }

                    if( txt.hsub_name !== undefined){
                        alertTxt += "หน่วยบริการปฐมภูมิ : "+txt.hsub+" "+txt.hsub_name+"\n";
                    }

                    if( txt.hmain_name !== undefined){
                        alertTxt += "หน่วยบริการที่รับส่ง : "+txt.hmain+" "+txt.hmain_name+"\n";
                    } 

                    if( txt.hmain_op_name !== undefined){
                        alertTxt += "หน่วยบริการประจำ : "+txt.hmain_op+" "+txt.hmain_op_name+"\n";
                    } 
                    
                }else if( txt.new_maininscl !== undefined ){

                    if( txt.new_maininscl_name !== undefined ){
                        alertTxt += "สิทธิหลักในการรับบริการ : "+txt.new_maininscl+" "+txt.new_maininscl_name+"\n";
                    }

                    if( txt.new_subinscl_name !== undefined){
                        alertTxt += "ประเภทสิทธิย่อย : "+txt.new_subinscl+" "+txt.new_subinscl_name+"\n";
                    }

                    if( txt.new_type_register !== undefined){
                        alertTxt += "ประเภทการลงทะเบียนใหม่ : "+txt.new_type_register_desc+"\n";
                    }

                    if( txt.new_startdate !== undefined){
                        alertTxt += "วันที่เริ่ม : "+txt.new_startdate.substring(6, 8)+"/"+txt.new_startdate.substring(4, 6)+"/"+txt.new_startdate.substring(0, 4)+"\n";
                    }

                    if( txt.new_expdate !== undefined){
                        alertTxt += "วันที่หมดสิทธิ : "+txt.new_expdate.substring(6, 8)+"/"+txt.new_expdate.substring(4, 6)+"/"+txt.new_expdate.substring(0, 4)+"\n";
                    }

                    if( txt.new_purchaseprovince_name !== undefined){
                        alertTxt += "จังหวัดที่ลงทะเบียน : "+txt.new_purchaseprovince_name+"\n";
                    }

                    if( txt.new_hsub_name !== undefined){
                        alertTxt += "หน่วยบริการปฐมภูมิ : "+txt.new_hsub+" "+txt.new_hsub_name+"\n";
                    } 

                    if( txt.new_hmain_name !== undefined){
                        alertTxt += "หน่วยบริการที่รับส่ง : "+txt.new_hmain+" "+txt.new_hmain_name+"\n";
                    } 

                    if( txt.new_hmain_op_name !== undefined){
                        alertTxt += "หน่วยบริการประจำ : "+txt.new_hmain_op+" "+txt.new_hmain_op_name+"\n";
                    } 
                }
                
            }
            
            alert(alertTxt);
        },
        false // true is Syncronous and false is Assyncronous (Default by true)
    );
}