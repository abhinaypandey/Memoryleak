<?php 
	include_once './include/lock_normal.php';
?>
<!DOCTYPE html>

<?php
	include './include/connection.php';
	if($_SERVER['REQUEST_METHOD']=="POST"){
        
		if(isset($_POST['oldpasswd']) && isset($_POST['newpasswd']) &&  isset($_POST['cnfrmpasswd'])){
            
			$old_passwd=trim(mysqli_real_escape_string($con,$_POST['oldpasswd']));
            $new_passwd=trim(mysqli_real_escape_string($con,$_POST['newpasswd']));
            $result=mysqli_query($con,"SELECT * FROM users WHERE user_id=$login_session AND password=sha1('$old_passwd')");
            $row=mysqli_fetch_assoc($result);
            if(($row=mysqli_num_rows($result))==1){
                $result=mysqli_query($con,"UPDATE users SET password=sha1('$new_passwd') WHERE user_id=$login_session");
                if((mysqli_affected_rows($con))==1){
                     echo "<script>alert('Password changed successfully');</script>";
                     echo "<script>window.location.href='index.php';</script>";
                }
                else{
                     echo "<script>alert('Try again!!');</script>";
                }

            }
            else{
                echo "<script>alert('Your current password didn\'t match');</script>";
            }

             mysqli_close($con);

        }
        else if(isset($_POST['moldpasswd']) && isset($_POST['mnewpasswd']) &&  isset($_POST['mcnfrmpasswd'])){
        	$old_passwd=trim(mysqli_real_escape_string($con,$_POST['moldpasswd']));
            $new_passwd=trim(mysqli_real_escape_string($con,$_POST['mnewpasswd']));
            $result=mysqli_query($con,"SELECT * FROM users WHERE user_id=$login_session AND password=sha1('$old_passwd')");
            $row=mysqli_fetch_assoc($result);
            if(($row=mysqli_num_rows($result))==1){
                $result=mysqli_query($con,"UPDATE users SET password=sha1('$new_passwd') WHERE user_id=$login_session");
                if((mysqli_affected_rows($con))==1){
                     echo "<script>alert('Password changed successfully');</script>";
                     echo "<script>window.location.href='index.php';</script>";
                }
                else{
                     echo "<script>alert('Try again!!');</script>";
                }

            }
            else{
                echo "<script>alert('Your current password dint match');</script>";
            }

             mysqli_close($con);
        }

            
	}


?>
<html>
	<head>
		<title>Password Change </title>
                <link rel="shortcut icon" href="./images/logo.png">
		<?php
			include_once './include/head.php';
		?>


		<style>
			.form-element{
				margin-bottom: 10%;
			}
			
			.textinput{
				width:100%;
				display: inline-block;
				height: 25px;
				padding: 4px 0px;
				font-size: 14px;
				line-height: 20px;
				color: rgb(85, 85, 85);
				border: 1px solid rgb(204, 204, 204);
				background-color: #ffffff;
			    border: 1px solid #cccccc;
			    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
			    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
			    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
			    -webkit-transition: border linear .2s, box-shadow linear .2s;
			    -moz-transition: border linear .2s, box-shadow linear .2s;
			    -o-transition: border linear .2s, box-shadow linear .2s;
			    transition: border linear .2s, box-shadow linear .2s;
			    border-radius: 3px;
			}

			.textinput:focus{
				outline: none;
			    border-color: #9ecaed;
			    box-shadow: 0 0 20px #9ecaed;
			    transition: all 0.25s ease-in-out;
			    -webkit-transition: all 0.25s ease-in-out;
			    -moz-transition: all 0.25s ease-in-out;
			  

			}
		

			.button{
				background-color: #d14545;
				background-image: -webkit-gradient(linear, left top, left bottom, from(#e97171), to(#d14545));
				background-image: -webkit-linear-gradient(top, #e97171, #d14545);
				background-image: -moz-linear-gradient(top, #e97171, #d14545);
				background-image: -ms-linear-gradient(top, #e97171, #d14545);
				background-image: -o-linear-gradient(top, #e97171, #d14545);
				background-image: linear-gradient(top, #e97171, #d14545);
				-moz-border-radius: 3px;
				-webkit-border-radius: 3px;
				border-radius: 3px;
				text-shadow: 0 1px 0 rgba(0,0,0,.5);
				-moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
				-webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
				box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;    
				border: 1px solid #d14545;
				float: left;
				margin:2px;
				width: 100%;
				height: 30px;
				cursor: pointer;
				font: bold 11px Arial, Helvetica;
				color: #fff;                                                  
	
			}
			.button:hover,.button:focus {		
					background-color: #e97171;
					background-image: -webkit-gradient(linear, left top, left bottom, from(#d14545), to(#e97171));
					background-image: -webkit-linear-gradient(top, #d14545, #e97171);
					background-image: -moz-linear-gradient(top, #d14545, #e97171);
					background-image: -ms-linear-gradient(top, #d14545, #e97171);
					background-image: -o-linear-gradient(top, #d14545, #e97171);
					background-image: linear-gradient(top, #d14545, #e97171);
			}

			.err_span{
				margin-top:5%;
				color:red;
				display:block;
				float:left;
			}

			.merror{
				border-radius: 2px 2px 2px 2px;
			    color: #FFFFFF;
			    font-size: 10px;
			    height: 20px;
			    width: 100%;
			    opacity: 0.8;
			    padding: 2px 2px 2px 2px;
			    position: fixed;
			    text-align: center;
				top:0px;
			    z-index: 5;
			}
		
		</style>
		<script>
			$(document).ready(function(){
				$('.pwd_chng_form').on('submit',function(e1){

					var oldpasswd=$('input[name="oldpasswd"]').val();
					var newpasswd=$('input[name="newpasswd"]').val();
					var cnfrmpasswd=$('input[name="cnfrmpasswd"]').val();
                    var password_reg=/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!_\.]).{8,20}).*$/;
                    
                    
					if(oldpasswd=="" || newpasswd==""||cnfrmpasswd==""){
						e1.preventDefault();
						$('.err_span').text('You can\'t leave fields blank');
						
					}
                    
                    else if(!password_reg.test(newpasswd)){
                        e1.preventDefault();
                        $('.err_span').text('Password should be of atleast 8 characters containing a number, a lowercase, an upper case and a special character [@#!$_.]');
                    }
                    
					else if(newpasswd!=cnfrmpasswd){
						
						e1.preventDefault();
						$('.err_span').text('New password and Confirm password should be same');
						
					}
                    
                    
				});

				$('.mpwd_chng_form').on('submit',function(e2){

					var moldpasswd=$('input[name="moldpasswd"]').val();
					var mnewpasswd=$('input[name="mnewpasswd"]').val();
					var mcnfrmpasswd=$('input[name="mcnfrmpasswd"]').val();
                    var mpassword_reg=/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!_\.]).{8,20}).*$/;
                    alert(mnewpasswd+" ..... "+moldpasswd+" ... "+mcnfrmpasswd);
					if(moldpasswd=="" || mnewpasswd==""||mcnfrmpasswd==""){
						e2.preventDefault();
						$('.merror').text('You can\'t leave fields blank').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('normal');
						$('input').on('click',function(){
							$('.merror').fadeOut('normal');
					
						});
					}
                    else if(!mpassword_reg.test(mnewpasswd)){
                        e2.preventDefault();
                        $('.merror').text('Password should be of atleast 8 characters containing a number, a lowercase, an upper case and a special character [@#!$_.]').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('normal');
                        $('input').on('click',function(){
							$('.merror').fadeOut('normal');
					
						});
                        
                    }
					else if(mnewpasswd!=mcnfrmpasswd){
						
						e2.preventDefault();
						$('.merror').text('New password and Confirm password should be same').css('background', 'none repeat scroll 0 0 #f85959').fadeIn('normal');
						$('input').on('click',function(){
							$('.merror').fadeOut('normal');
					
						});
					}
                    
					
				});
			});
		</script>

	</head>
	<body>
		<?php
			include_once './include/menu.php';
		?>
		<div class="body">
			<div class="content">

				<div class="pwd_wrapper" style="margin:auto; margin-top:50px;  background-color:whitesmoke;width:60%;min-height:450px; padding:5%;">
					<div class="msg" style="float:left;width:57%;height:100%;background-color:whitesmoke;">	
						<h1>Change your Memoryleak password</h1>
						<p style="width:100%;">Enter a new passwd for your account. We highly recommend you create a unique passwd - one that you don't use for any other websites.</p>
					</div>
					
					<div class="change_passwd_box" style="float:right;width:40%;min-height:80%;">
						<form class="pwd_chng_form" action="password_change.php"  name="chng_passwd" method="post">
							<div class="form-element">
								<label class="old_passwd">Current Password
									<input type="password" name="oldpasswd"  class="textinput">
								</label>
								
							</div>

							<div class="form-element">
								<label class="new_passwd">New Password
									<input type="password" name="newpasswd"  class="textinput">
								</label>
							
							</div>

							<div class="form-element">
								<label class="cnfrm_passwd_">Confirm New Password
									<input type="password" name="cnfrmpasswd"  class="textinput">
								</label>
								
							</div>
							<input type="submit" name="submit" class="button"  value="Change password">
							<span class="err_span"></span>
						</form>
					</div>
					
				</div>
			</div>	

			<div class="mcontent">
				<div class='merror' style="display:none;"></div>
				<div class="pwd_wrapper" style="background-color:whitesmoke; width:88%; min-height:500px; margin:auto; margin-top:50px; padding:1%;">
					
					<div class="msg" style="width:90%;height:20%;background-color:whitesmoke;padding:5%;">
						<h3>Change your Memoryleak password</h3>
						
						<p style="width:100%;">Enter a new passwd for your account. We highly recommend you create a unique passwd - one that you don't use for any other websites.</p>
					</div>
					
					<div class="change_passwd_box" style="width:90%;min-height:50%;background-color:#f1f1f1;display:block;padding:5%;">
						<form class="mpwd_chng_form" action="password_change.php" name="chng_passwd" method="post">
							<div class="form-element">
								<label class="old_passwd">Current Password
									<input type="password" name="moldpasswd"  class="textinput">
								</label>
								
							</div>

							<div class="form-element">
								<label class="new_passwd">New Password
									<input type="password" name="mnewpasswd"  class="textinput">
								</label>
							
							</div>

							<div class="form-element">
								<label class="cnfrm_passwd_">Confirm New Password
									<input type="password" name="mcnfrmpasswd"  class="textinput">
								</label>
								
							</div>
							<input type="submit" name="submit" class="button" value="Change password">
							
						</form>
					</div>
					
				</div> 
			</div>
				
		
		</div>
		
		<?php
			include_once './include/footer.php';
		?>

	</body>
</html>