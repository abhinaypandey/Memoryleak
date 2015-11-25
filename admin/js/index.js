$(document).ready(function(){
	$(document).ajaxStart(function() {
		  NProgress.start();
	});
	$(document).ajaxStop(function() {
		  NProgress.done();
	});
	
	var menuflag=0;
	//for simple menu button
	$('.menubutton').click(function(){
		if(menuflag==1){
			menuflag=0;
			$('.nav').slideUp('slow','easeOutBounce');
		}
		else{
			if($('#mainmenu').is(':hidden')){
				$('#mainmenu').slideDown('slow','easeOutBounce');
				menuflag=1;
			}
			else{
				$('#mainmenu').slideUp('slow','easeOutBounce');
			}
		}
	});
	
	$('.snm').click(function(){
		$('.nav').hide();
		$('.msgtrans_bg').show();
		$('#msgpopup_main').show();
		$('.tooldrop').hide();
	});

	$('.img_close').click(function(){
		menuflag=0;
		$('#msgpopup_main').hide();
		$('.msgtrans_bg').hide();
	});
	
	
	//for lock menu button
	$('.authbutton').click(function(){
		if(menuflag==1){
			menuflag=0;
			$('.nav').slideUp('slow','easeOutBounce');
		}
		else{
			if($('#authmenu').is(':hidden')){
				$('#authmenu').slideDown('slow','easeOutBounce');
			}
			else{
				$('#authmenu').slideUp('slow','easeOutBounce');
			}
		}
	});
	
	//for mobile menu
	$('.nav li').click(function(){
		$('.nav').hide();
		var drop=$(this).attr('value');
		if(drop!=''){
			$('#'+drop).slideDown('slow','easeOutBounce');
			menuflag=1;
		}		
	});
	
	//for closing all the tooldrop when click on page body
	$('.body').click(function(){
		$('.tooldrop').slideUp('slow','easeOutBounce');
		menuflag=0;
	});
	
	//main menu bar
	$( "a.drop_down" ).click(function () {
		if ( $(this).siblings("ul").is( ":hidden" ) ) {
			$('.tooldrop').hide();
			$(this).siblings("ul").slideToggle('slow','easeOutBounce');
		} 
		else {
			$('.tooldrop').hide();
			$(this).siblings("ul").slideUp('slow','easeOutBounce');
		}
	});

	
	//for question toolbox button
	$('#question').click(function(){
		if($('.notque').is(':hidden')){
			$('.tooldrop').hide();
			$('.notque').toggle();
		}
		else{
			$('.tooldrop').hide();
		}
	});
	
	//for message toolbox button
	$('#message').click(function(){
		if($('.notmes').is(':hidden')){
			$('.tooldrop').hide();
			$('.notmes').toggle();
		}
		else{
			$('.tooldrop').hide();
		}
	});
	
	//for dollar toolbox button
	$('#dollar').click(function(){
		if($('.notdol').is(':hidden')){
			$('.tooldrop').hide();
			$('.notdol').toggle();
		}
		else{
			$('.tooldrop').hide();
		}
	});
	

	//for account toolbox button
	$('#account').click(function(){
		if($('.notacc').is(':hidden')){
			$('.tooldrop').hide();
			$('.notacc').toggle();
		}
		else{
			$('.tooldrop').hide();
		}
	});
		
});