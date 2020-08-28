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
        'http://192.168.143.126/index.php',
        { "hn": hn },
        function(res){
            var txt = JSON.parse(res);
            if (txt.ws_status === "NHSO-00003") {
                alertTxt = txt.ws_status_desc+"\nกรุณาเปิดใช้งานโปรแกรม nhsoauthen4.x ก่อนการใช้งานตรวจสอบสิทธิออนไลน์";

            }else{
            
                var subInScl, hMain, hMainOp, hSub, mainInScl, alertTxt = '';

                if( txt.maininscl !== undefined ){
                    if( txt.maininscl_name !== undefined ){
                        alertTxt += "สิทธิหลักในการรับบริการ : "+txt.maininscl+" "+txt.maininscl_name+"\n";
                    }

                    if( txt.subinscl_name !== undefined){
                        alertTxt += "ประเภทสิทธิย่อย : "+txt.subinscl+" "+txt.subinscl_name+"\n";
                    }

                    if( txt.hmain_op_name !== undefined){
                        alertTxt += "หน่วยบริการประจำ : "+txt.hmain_op+" "+txt.hmain_op_name+"\n";
                    } 
                
                    if( txt.hmain_name !== undefined){
                        alertTxt += "หน่วยบริการที่รับส่ง : "+txt.hmain+" "+txt.hmain_name+"\n";
                    } 

                    if( txt.hsub_name !== undefined){
                        alertTxt += "หน่วยบริการปฐมภูมิ : "+txt.hsub+" "+txt.hsub_name+"\n";
                    } 
                }else if( txt.new_maininscl !== undefined ){
                    if( txt.new_maininscl_name !== undefined ){
                        alertTxt += "สิทธิหลักในการรับบริการ : "+txt.new_maininscl+" "+txt.new_maininscl_name+"\n";
                    }

                    if( txt.new_subinscl_name !== undefined){
                        alertTxt += "ประเภทสิทธิย่อย : "+txt.new_subinscl+" "+txt.new_subinscl_name+"\n";
                    }

                    if( txt.new_hmain_op_name !== undefined){
                        alertTxt += "หน่วยบริการประจำ : "+txt.new_hmain_op+" "+txt.new_hmain_op_name+"\n";
                    } 
                
                    if( txt.new_hmain_name !== undefined){
                        alertTxt += "หน่วยบริการที่รับส่ง : "+txt.new_hmain+" "+txt.new_hmain_name+"\n";
                    } 

                    if( txt.new_hsub_name !== undefined){
                        alertTxt += "หน่วยบริการปฐมภูมิ : "+txt.new_hsub+" "+txt.new_hsub_name+"\n";
                    } 
                }
                
            }
            
            alert(alertTxt);
        },
        false // true is Syncronous and false is Assyncronous (Default by true)
    );
}