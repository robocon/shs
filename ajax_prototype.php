<script type="text/javascript">

var SmHttp = function(){}
SmHttp.prototype = {
	ajax: function(url, data, callback){
		try{
			xHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			try{
				xHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xHttp = false;
			}
		}
		if(!xHttp && document.createElement){
			xHttp = new XMLHttpRequest();
		}
		
		xHttp.onreadystatechange = function(){
			if( xHttp.readyState == 4 && xHttp.status == 200 ){
				callback(xHttp.responseText);
			}
		};
		xHttp.open("POST", url, true);
		xHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		data = this.objToStr(data);
		xHttp.send(data);
	},
	objToStr: function(data){
		
		if( data === null ){
			return null;
		}
		
		test_str = [];
		for(var p in data){
			test_str.push(encodeURIComponent(p)+"="+encodeURIComponent(data[p]));
		}
		return test_str.join("&");
	}
}

var newSm = new SmHttp();
newSm.ajax(
	'test.php', 
	{ name: 'TestName', email: 'test@mail.com' }, 
	function(res){
		document.write(res);
	}
);
</script>