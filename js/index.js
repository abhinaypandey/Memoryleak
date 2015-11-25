$(document).ready(function(){
	$(document).ajaxStart(function() {
		  NProgress.start();
	});
	$(document).ajaxStop(function() {
		  NProgress.done();
	});


	var ua = navigator.userAgent,
		isMobileWebkit = /WebKit/.test(ua) && /Mobile/.test(ua);

	if (isMobileWebkit) {
		$('.navbutton').hide();
		$('#page1').css('background-image','../images/mtop_bg.png');
		$('#page2').css('background-image','../images/mpage2.jpg');
		$('#page3').css('background-image','../images/mpage3.jpg');
		$('#page4').css('background-image','../images/mleaders.png');
		$('#page5').css('background-image','../images/mpage5.jpg');
		$('#page6').css('background-image','../images/mcontact_bg.jpg');
		$(window).stellar({
			horizontalScrolling:false,
			verticalScrolling:false,
			responsive:false,		
		});
		
	}
	else{
		$(window).stellar({
			horizontalScrolling:false,
			verticalScrolling:true,
			responsive:true,		
		});
	}
	
	var links = $('.navi').find('li');
	var page = $('.page');
    var button = $('.navbutton');
    var mywindow = $(window);
    var htmlbody = $('html,body');
	
    page.waypoint(function (event, direction) {

        //cache the variable of the data-slide attribute associated with each slide
        datapage = $(this).attr('data-page');

        //If the user scrolls up change the navigation link that has the same data-slide attribute as the slide to active and 
        //remove the active class from the previous navigation link 
        if (direction === 'down') {
            $('.navi li[data-page="' + datapage + '"]').addClass('active').prev().removeClass('active');
        }
        // else If the user scrolls down change the navigation link that has the same data-slide attribute as the slide to active and 
        //remove the active class from the next navigation link 
        else {
            $('.navi li[data-page="' + datapage + '"]').addClass('active').next().removeClass('active');
        }

    });

    //waypoints doesnt detect the first slide when user scrolls back up to the top so we add this little bit of code, that removes the class 
    //from navigation link slide 2 and adds it to navigation link slide 1. 
    mywindow.scroll(function () {
        if (mywindow.scrollTop() == 0) {
            $('.navi li[data-page="1"]').addClass('active');
            $('.navi li[data-page="2"]').removeClass('active');
        }
    });

    //Create a function that will be passed a slide number and then will scroll to that slide using jquerys animate. The Jquery
    //easing plugin is also used, so we passed in the easing method of 'easeInOutQuint' which is available throught the plugin.
    function goToByScroll(datapage) {
        htmlbody.animate({
            scrollTop: $('.page[data-page="' + datapage + '"]').offset().top
        }, 1200, 'swing');
    }


	
    //When the user clicks on the navigation links, get the data-slide attribute value of the link and pass that variable to the goToByScroll function
    links.click(function (e) {
        e.preventDefault();
        datapage= $(this).attr('data-page');
        goToByScroll(datapage);
    });
	
    //When the user clicks on the button, get the get the data-slide attribute value of the button and pass that variable to the goToByScroll function
    button.click(function (e) {
        e.preventDefault();
        datapage = $(this).attr('data-page');
        goToByScroll(datapage);

    });


	
	$('.menubutton').click(function(){
		if($.trim($('.mobilemenu').is(':visible'))=="false"){
			$('.drops').hide();
			$('.mobilemenu').slideToggle('slow','swing');
		}
		else{
			$('.drops').slideUp('slow','swing');
		}
		
	});
	$('.authbutton').click(function(){
		if($.trim($('.mobiletoolpanel').is(':visible'))=="false"&&$.trim($('.msignup').is(':visible'))=="false"&&$.trim($('.mlogin').is(':visible'))=="false"){
			$('.drops').hide();
			$('.mobiletoolpanel').slideToggle('slow','swing');
		}
		else{
			$('.drops').slideUp('slow','swing');
		}
	});	
	
	
	$('.page').click(function(){
		$('.drops').fadeOut('slow');
	});

	$('#mlogin').click(function(){
		$('.drops').hide();
		$('.mlogin').slideToggle('slow','swing');
	});
	$('#msignup').click(function(){
		$('.drops').hide();		
		$('.msignup').slideToggle('slow','swing');
	});

	$('#login').click(function(){
		$('.signup').hide();
		if($('.login').is(':hidden')){
			$('.login').fadeIn('slow');
		}
		else{
			$('.login').fadeOut('slow');
		}
	});
	$('#signup').click(function(){
		$('.login').hide();
		if($('.signup').is(':hidden')){
			$('.signup').fadeIn('slow');
		}
		else{
			$('.signup').fadeOut('slow');
		}	
		
	});
	
});



var count=0;
var checkflag=0;
function validate(type){
	if(type=='email'){
		var email=$('#email').val();
//		var email_reg=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,})+$/;
		var email_reg=/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if(!email_reg.test(email)){
			$('.email').removeClass('right').addClass('wrong');
            $('#loginmessage').css('color','red').text('Enter a valid email ID');
            
		}
		else{
			count++;
			$('.email').removeClass('wrong').addClass('right');
            $('#loginmessage').css('color','red').text('');
		}
	}
	else if(type=='password'){
		var password=$('#password').val();
        var password_reg=/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!_\.]).{8,20}).*$/;
		if(password==''){
			$('.password').removeClass('right').addClass('wrong');
            $('#loginmessage').css('color','red').text('Password should be of atleast 8 characters containing a number, a lowercase, an upper case and a special character [@#!$_.]');
		}
        if(!password_reg.test(password)){
			$('.password').removeClass('right').addClass('wrong');
            $('#loginmessage').css('color','red').text('Password should be of atleast 8 characters containing a number, a lowercase, an upper case and a special character [@#!$_.]');
            
		}
		else{
			count++;
			$('.password').removeClass('wrong').addClass('right');
            $('#loginmessage').css('color','red').text('');
		}
	}
	else if(type=='semail'){
		var email=$('#semail').val();
//		var email_reg=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,})+$/;
		var email_reg=/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if(!email_reg.test(email)){
			$('.semail').removeClass('right').addClass('wrong');
            $('#signupmessage').css('color','red').text('Enter a valid e-mail ID');
		}
		else{
			count++;
			$('.semail').removeClass('wrong').addClass('right');
            $('#signupmessage').css('color','red').text('');
		}
	}
	else if(type=='spassword'){
		var password=$('#spassword').val();
        var password_reg=/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!_\.]).{8,20}).*$/;
		if(!password_reg.test(password)){
			$('.spassword').removeClass('right').addClass('wrong');
            $('#signupmessage').css('color','red').text('Password should be of atleast 8 characters containing a number, a lowercase, an upper case and a special character [@#!$_.]');
            
		}
		else{
			count++;
			$('.spassword').removeClass('wrong').addClass('right');
            $('#signupmessage').css('color','red').text('');
		}
	}
	else if(type=='cpassword'){
		var password=$('#cpassword').val();
		if(password==''){
			$('.cpassword').removeClass('right').addClass('wrong');
            $('#signupmessage').css('color','red').text('Password should be of atleast 8 characters containing a number, a lowercase, an upper case and a special character [@#!$_.]');
		}

		else if(password!=$('#spassword').val()){
			$('.cpassword').removeClass('right').addClass('wrong');
            $('#signupmessage').css('color','red').text('Both Password should match to proceed');
        }
		else{
			count++;
			$('.cpassword').removeClass('wrong').addClass('right');
            $('#signupmessage').css('color','red').text('');
		}
	}
	else if(type=='check'){
		if($.trim($('#check').is(':checked'))=="true"){
			checkflag++;
		}
	}
	else if(type=='memail'){
		var email=$('#memail').val();
//		var email_reg=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,})+$/;
		var email_reg=/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if(!email_reg.test(email)){
			$('.memail').removeClass('right').addClass('wrong');
            $('#mloginmessage').css('color','red').text('Enter a valid email ID');
            
		}
		else{
			count++;
			$('.memail').removeClass('wrong').addClass('right');
            $('#mloginmessage').css('color','red').text('');
		}
	}
	else if(type=='mpassword'){
		var password=$('#mpassword').val();
        var password_reg=/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!_\.]).{8,20}).*$/;
	
		if(password==''){
			$('.mpassword').removeClass('right').addClass('wrong');
            $('#mloginmessage').css('color','red').text('Password should be of atleast 8 characters containing a number, a lowercase, an upper case and a special character [@#!$_.]');
		}
        if(!password_reg.test(password)){
			$('.mpassword').removeClass('right').addClass('wrong');
            $('#mloginmessage').css('color','red').text('Password should be of atleast 8 characters containing a number, a lowercase, an upper case and a special character [@#!$_.]');
            
		}
		else{
			count++;
			$('.mpassword').removeClass('wrong').addClass('right');
            $('#mloginmessage').css('color','red').text('');
		}
	}
	else if(type=='msemail'){
		var email=$('#msemail').val();
//		var email_reg=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,})+$/;
		var email_reg=/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if(!email_reg.test(email)){
			$('.msemail').removeClass('right').addClass('wrong');
            $('#msignupmessage').css('color','red').text('Enter a valid e-mail ID');
		}
		else{
			count++;
			$('.msemail').removeClass('wrong').addClass('right');
            $('#msignupmessage').css('color','red').text('');
		}
	}
	else if(type=='mspassword'){
		var password=$('#mspassword').val();
		var password_reg=/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!_\.]).{8,20}).*$/;
		if(!password_reg.test(password)){
			$('.mspassword').removeClass('right').addClass('wrong');
            $('#msignupmessage').css('color','red').text('Password should be of atleast 8 characters containing a number, a lowercase, an upper case and a special character [@#!$_.]');
            
		}
		else{
			count++;
			$('.mspassword').removeClass('wrong').addClass('right');
            $('#msignupmessage').css('color','red').text('');
            
		}
	}
	else if(type=='mcpassword'){
		var password=$('#mcpassword').val();

		if(password==''){
			$('.mcpassword').removeClass('right').addClass('wrong');
            $('#msignupmessage').css('color','red').text('Password should be of atleast 8 characters containing a number, a lowercase, an upper case and a special character [@#!$_.]');
		}
		else if(password!=$('#mspassword').val()){
			$('.mcpassword').removeClass('right').addClass('wrong');
            $('#msignupmessage').css('color','red').text('Both passwords should match to proceed');
            
		}
		else{
			count++;
			$('.mcpassword').removeClass('wrong').addClass('right');
            $('#msignupmessage').css('color','red').text('');
		}
	}
	else if(type=='mcheck'){
		if($.trim($('#mcheck').is(':checked'))=="true"){
			checkflag++;
		}
	}
}

function submit(type){
	count=0;
	checkflag=0;
	if(type=='letsgo'){
		validate('email');
		validate('password');
		var email=$('#email').val();
		var password=$('#password').val();
		
		if(count===2){
			$.ajax({
				type:'POST',
				url:'./config/login.php',
				data:{ email:email, password:password}
				
			}).done(function(data){
				if(data=='normal'){
					window.location.href = './user';
				}
				else if(data=='admin'){
					window.location.href = './admin';
				}
				else if(data=='2'){	
					$('#loginmessage').css('color','red').text('Invalid Credentials');
				}
				else{
					$('#loginmessage').css('color','red').text('Something went wrong please try later'+data);
				}
				
			});
			
		}
		else{
			$('#loginmessage').css('color','red').text('Please provide all required Cradentials');
		}
	}
	else if(type=='mletsgo'){
		validate('memail');
		validate('mpassword');
		var email=$('#memail').val();
		var password=$('#mpassword').val();
		
		if(count===2){
			$.ajax({
				type:'POST',
				url:'./config/login.php',
				data:{ email:email, password:password}
				
			}).done(function(data){
				if(data=='normal'){
					window.location.href = './user';
				}
				else if(data=='admin'){
					window.location.href = './admin';
				}
				else if(data=='2'){	
					$('#mloginmessage').css('color','red').text('Invalid Credentials');
				}
				else{
					$('#mloginmessage').css('color','red').text('Something went wrong please try later');
				}
				
			});
			
		}
		else{
			$('#mloginmessage').css('color','red').text('Please provide all required Cradentials');
		}
	}
	else if(type=='forgotpassword'){
		validate('email');
		var email=$('#email').val();
		if(count===1){
			$.ajax({
				type:'POST',
				url:'./config/forgotpassword.php',
				data:{ email:email}
				
			}).done(function(data){
				if($.trim(data)=='1'){
					$('#loginmessage').css('color','green').text('Password reset link is send to your e-mail account');
				}
				else if($.trim(data)=='2'){	
					$('#loginmessage').css('color','red').text('invalid e-mail id');
				}
				else{
					$('#loginmessage').css('color','red').text('Something went wrong please try later');
				}
				
			});
		}
		else{
			$('#loginmessage').css('color','red').text('email id is required');
		}
	}
	else if(type=='mforgotpassword'){
		validate('memail');
		$email=$('#memail').val();
		if(count===1){
			$.ajax({
				type:'POST',
				url:'./config/forgotpassword.php',
				data:{ email:email}
				
			}).done(function(data){
				if($.trim(data)=='1'){
					$('#mloginmessage').css('color','green').text('Password reset link is send to your e-mail account');
				}
				else if($.trim(data)=='2'){	
					$('#mloginmessage').css('color','red').text('invalid e-mail id');
				}
				else{
					$('#mloginmessage').css('color','red').text('Something went wrong please try later');
				}
				
			});
		}
		else{
			$('#mloginmessage').css('color','red').text('email id is required');
		}
	}
	else if(type=='joinup'){
		validate('semail');
		validate('spassword');
		validate('cpassword');
		validate('check');
		var email=$('#semail').val();
		var password=$('#spassword').val();
		var cpassword=$('#cpassword').val();
		
		if(count===3){
			if(checkflag===1){
				
				$.ajax({
					type:'POST',
					url:'./config/signup.php',
					data:{ email:email, password:password,cpassword:cpassword}
					
				}).done(function(data){
					if($.trim(data)=='1'){
						$('#signupmessage').css('color','green').text('Singup Successfully. Please verify through e-mail');
						$('.text').val('');
					}
					else if($.trim(data)=='2'){	
						$('#signupmessage').css('color','red').text('You already have an account with this e-mail id');
					}
					else{
						$('#signupmessage').css('color','red').text('Something went wrong, please try later');
					}
					
				});
								
			}
			else{
				$('#signupmessage').css('color','red').text('Please accept Terms and Conditions');
			}
		}
		else{
			$('#signupmessage').css('color','red').text('Please enter the required field');
		}
	}
	else if(type=='mjoinup'){
		validate('msemail');
		validate('mspassword');
		validate('mcpassword');
		validate('mcheck');
		var email=$('#msemail').val();
		var password=$('#mspassword').val();
		var cpassword=$('#mcpassword').val();
		
		if(count===3){
			if(checkflag===1){
				
				$.ajax({
					type:'POST',
					url:'./config/signup.php',
					data:{ email:email, password:password,cpassword:cpassword}
					
				}).done(function(data){
					if($.trim(data)=='1'){
						$('#msignupmessage').css('color','green').text('Singup Successfully. Please verify through e-mail');
					}
					else if($.trim(data)=='2'){	
						$('#msignupmessage').css('color','red').text('You already have an account with this e-mail id');
					}
					else{
						$('#msignupmessage').css('color','red').text('Something went wrong please try later');
					}
					
				});
								
			}
			else{
				$('#msignupmessage').css('color','red').text('Please accept tearms and Conditions');
			}
		}
		else{
			$('#msignupmessage').css('color','red').text('Please enter the required Data');
		}
	}


}
	