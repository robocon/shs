/*
�к����Է��͹�Ź��ҹ ucAuthen4.x ���� IE �ջѭ������ö����������价��
Internet Options > Security > Internet > Custom level... 
������� Miscellaneous 
1. Access data sources across domains �Դ Enable
2. Allow META REFRESH �Դ Enable
3. Allow scripting of Microsoft web browser control �Դ Enable
*/
function checkPtRight(link, ev, hn){

    // ���������Ǩ�١�͹��� include ��� templates/classic/main.js �������ѧ
    var newSm = new SmHttp();
    newSm.ajax(
        'http://192.168.143.126/index.php',
        { "hn": hn },
        function(res){
            var txt = JSON.parse(res);
            if (txt.ws_status === "NHSO-00003") {
                alertTxt = txt.ws_status_desc+"\n��س��Դ��ҹ����� nhsoauthen4.x ��͹�����ҹ��Ǩ�ͺ�Է���͹�Ź�";

            }else{
            
                var subInScl, hMain, hMainOp, hSub, mainInScl, alertTxt = '';

                if( txt.maininscl !== undefined ){
                    if( txt.maininscl_name !== undefined ){
                        alertTxt += "�Է����ѡ㹡���Ѻ��ԡ�� : "+txt.maininscl+" "+txt.maininscl_name+"\n";
                    }

                    if( txt.subinscl_name !== undefined){
                        alertTxt += "�������Է������ : "+txt.subinscl+" "+txt.subinscl_name+"\n";
                    }

                    if( txt.hmain_op_name !== undefined){
                        alertTxt += "˹��º�ԡ�û�Ш� : "+txt.hmain_op+" "+txt.hmain_op_name+"\n";
                    } 
                
                    if( txt.hmain_name !== undefined){
                        alertTxt += "˹��º�ԡ�÷���Ѻ�� : "+txt.hmain+" "+txt.hmain_name+"\n";
                    } 

                    if( txt.hsub_name !== undefined){
                        alertTxt += "˹��º�ԡ�û������ : "+txt.hsub+" "+txt.hsub_name+"\n";
                    } 
                }else if( txt.new_maininscl !== undefined ){
                    if( txt.new_maininscl_name !== undefined ){
                        alertTxt += "�Է����ѡ㹡���Ѻ��ԡ�� : "+txt.new_maininscl+" "+txt.new_maininscl_name+"\n";
                    }

                    if( txt.new_subinscl_name !== undefined){
                        alertTxt += "�������Է������ : "+txt.new_subinscl+" "+txt.new_subinscl_name+"\n";
                    }

                    if( txt.new_hmain_op_name !== undefined){
                        alertTxt += "˹��º�ԡ�û�Ш� : "+txt.new_hmain_op+" "+txt.new_hmain_op_name+"\n";
                    } 
                
                    if( txt.new_hmain_name !== undefined){
                        alertTxt += "˹��º�ԡ�÷���Ѻ�� : "+txt.new_hmain+" "+txt.new_hmain_name+"\n";
                    } 

                    if( txt.new_hsub_name !== undefined){
                        alertTxt += "˹��º�ԡ�û������ : "+txt.new_hsub+" "+txt.new_hsub_name+"\n";
                    } 
                }
                
            }
            
            alert(alertTxt);
        },
        false // true is Syncronous and false is Assyncronous (Default by true)
    );
}