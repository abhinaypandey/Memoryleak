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
			$('.nav').slideUp('slow','swing');
		}
		else{
			if($('#mainmenu').is(':hidden')){
				$('#mainmenu').slideDown('slow','swing');
				menuflag=1;
			}
			else{
				$('#mainmenu').slideUp('slow','swing');
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
			$('.nav').slideUp('slow','swing');
		}
		else{
			if($('#authmenu').is(':hidden')){
				$('#authmenu').slideDown('slow','swing');
				menuflag=1;
			}
			else{
				$('#authmenu').slideUp('slow','swing');
			}
		}
	});
	
	//mobile search
	$('#msearch_box').bind("enterKey",function(e){
		var searchtext=$('#msearch_box').val();
		var category=$('input[name="category"]:radio:checked').val();

		if(category=='question'){
			window.location.href='searchresult.php?searchtext='+encodeURIComponent(searchtext)+'&category='+category;
		
		}

		if(category=='project'){
			window.location.href='searchresult.php?searchtext='+encodeURIComponent(searchtext)+'&category='+category;
		
		}
		
		
	});
	$('#msearch_box').on('keyup',function(e){
		if(e.keyCode == 13)
		{
			$(this).trigger("enterKey");
		}

	});

	$('#msearchbuttonimg').click(function(){
		var searchtext=$('#msearch_box').val();
		var category=$('input[name="category"]:radio:checked').val();

		if(category=='question'){
			window.location.href='searchresult.php?searchtext='+encodeURIComponent(searchtext)+'&category='+category;
		
		}

		if(category=='project'){
			window.location.href='searchresult.php?searchtext='+encodeURIComponent(searchtext)+'&category='+category;
		
		}
	});
	
	//for search button
	$('.searchbutton').click(function(){
		if(menuflag==1){
			menuflag=0;
			$('.nav').slideUp('slow','swing');
		}
		else{
			if($('#msearchdiv').is(':hidden')){
				$('#msearchdiv').slideDown('slow','swing');
				menuflag=1;
			}
			else{
				$('#msearchdiv').slideUp('slow','swing');
			}
		}
	});


	$('.cartbutton').click(function(){
		if(menuflag==1){
			menuflag=0;
			$('.nav').slideUp('slow','swing');
		}
		else{
			if($('#mcart_div').is(':hidden')){
				$('#mcart_div').slideDown('slow','swing');
				menuflag=1;
			}
			else{
				$('#mcart_div').slideUp('slow','swing');
			}
		}
	});
	
	//for mobile menu
	$('.nav li').click(function(){
		$('.nav').hide();
		var drop=$(this).attr('value');
		if(drop!=''){
			$('#'+drop).slideDown('slow','swing');
			menuflag=1;
		}		
	});
	
	//for closing all the tooldrop when click on page body
	$('.body').click(function(){
		$('.tooldrop').hide();
		$('.cart_popup').fadeOut(1000).stop();
		menuflag=0;
	});
	
	//main menu bar
	$( "a.drop_down" ).click(function () {
		if ( $(this).siblings("ul").is( ":hidden" ) ) {
			$('.tooldrop').hide();

			$(this).siblings("ul").show();
		} 
		else {
			$('.tooldrop').hide();
			$(this).siblings("ul").hide();
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
	
	//for grade toolbox button
	$('#grade').click(function(){
		if($('.notgra').is(':hidden')){
			$('.tooldrop').hide();
			$('.notgra').toggle();
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
	
	$('#search_box').bind("enterKey",function(e){
			var searchtext=$('#search_box').val();
			var category=$('input[name="category"]:radio:checked').val();
				window.location.href='searchresult.php?searchtext='+encodeURIComponent(searchtext)+'&category='+category;
			
	});
	$('#search_box').on('keyup',function(e){
	    if(e.keyCode == 13 )
	    {
	        $(this).trigger("enterKey");
	    }
	});

	$('#searchbuttonimg').click(function(){
		var searchtext=$('#search_box').val();
			var category=$('input[name="category"]:radio:checked').val();
				window.location.href='searchresult.php?searchtext='+encodeURIComponent(searchtext)+'&category='+category;
			
	});

	var flag=0;
	$('.search_image').on('click',function(){
		if(flag==0){
			flag=1;
			$('.searchpanel').animate({
				display:'block',
			    right:'100px',
			  }, {
			    duration: 1000,
			    step: function( now, fx ){
			      $( ".searchpanel:gt(0)" ).css( "right", now);
			    }
			  });
		}
		else{
			flag=0;
			$('.searchpanel').animate({
				display:'block',
			    right:'-50%'
			  }, {
			    duration: 1000,
			    step: function( now, fx ){
			      $( ".searchpanel:gt(0)" ).css( "right", now);
			    }
			  });
		}
		
			
	});

	$('.cart_image').click(function(){
		window.location.href='./cart.php';
	});

	$('.cart_image').on('mouseover',function(){
		$('.cart_popup').stop().fadeIn(1000);	

	});
	$('.cart_image').on('mouseout',function(){
		$('.cart_popup').fadeOut(1000).stop();	

	});

	
		
});