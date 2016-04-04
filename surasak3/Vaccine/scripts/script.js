// JavaScript Document
$(window).load(function() {	
		
		$('#slide_img').nivoSlider({
					effect:'random', //Specify sets like: 'fold,fade,sliceDown'
					animSpeed:800, //Slide transition speed
					pauseTime:2500,
					startSlide:0, //Set starting Slide (0 index)
					directionNav:true, //Next & Prev
					directionNavHide:true, //Only show on hover
					controlNav:true, //1,2,3...
					controlNavThumbs:false, //Use thumbnails for Control Nav
					keyboardNav:false, //Use left & right arrows
					pauseOnHover:true //Stop animation while hovering
					//captionOpacity:1,
    	});
			
		Cufon.replace('h1,.left_sidebar_header,.right_sidebar_head,.right_sidebar_header');
		
		Cufon.replace('.nav_head',{
					  color: '#111',textShadow: '0px 1px 2px #1d9ec4'
		});
		
		Cufon.replace('#footer_right',{
					  color: '#ffffff',textShadow: '0px 1px 0px #000000',
					  hover: {
								textShadow: '0px 1px 0px #000000',
								color: '#ffc600'}
		});
				
		/*$(".btn").hover(
					function () {
								$(this).css("background-position","0 -37px");
					}, 
					function () {
								$(this).css("background-position","0 0");
					}
		);*/
		
		$(".nivo-nextNav").hover(
					function () {
								$(this).css("background-position","-40px -37px");
					}, 
					function () {
								$(this).css("background-position","-40px 0");
					}
		);
		
		Cufon.replace('.nav_li',{
					  color: '#444',
					  hover: {color: '#0088cc'}
		});
		
		$('.nav_li').hover(
					function () {
								$(this).css({"background-position": "0 -35px"});
								$(this).animate({"padding-left": "+=8px"}, "fast");
					}, 
					function () {
								$(this).css({"background-position": "0 0"});
								$(this).animate({"padding-left": "-=8px"}, "fast");
					}
		);
		
		$('.right_sidebar_li').hover(
					function () {
								$(this).css({"background-position": "0 -25px"});
								$(this).animate({"padding-left": "+=8px"}, "fast");
					}, 
					function () {
								$(this).css({"background-position": "0 0"});
								$(this).animate({"padding-left": "-=8px"}, "fast");
					}
		);
		
		$('#toTop').scrollToTop();
		
		$('.input-text').clearField();

						
});