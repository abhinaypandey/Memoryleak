<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->
		<script src="./js/jquery2-min.js"></script>
		<script src="./js/waypoints-min.js"></script>
		<script src="./js/jquery-easing-min.js"></script>
		<script src="./js/stellar-min.js"></script>
		<script src="./js/nprogress.js"></script>
		<script src="./js/index.js"></script>
		<link rel="stylesheet"  href="./css/nprogress.css" />
		<link rel="stylesheet"  href="./css/style.css" />
                <title>Welcome to Memoryleak</title>
                <link rel="shortcut icon" href="./images/logo.png">

		<style>
			
			.quest a{
				color:green;
			}
			tbody tr td{
				padding-left:1%;
			}
			thead tr th{
				padding-left:1%;
			}
			tbody tr{
				cursor:pointer;
			}
            .h6_after:after{
                font-size:50%;
				color:white;
				content:"(You might be one of them)";
            }
            .earners_after:after{
                font-size:50%;
				color:white;
				content:"(You might be one of them)";
            }
            .h5_after:after{
                font-size:50%;
				color:white;
				content:"(One might be yours)";
            }
            .category_after:after{
                font-size:50%;
				color:white;
				content:"(One might be yours)";
            }
            .about_after:after{
            	content:"(Who We Are.Get To Know Us Better)";
            	font-size:50%;
				color:white;
            }
/*------------------------------------------------------------  STARTS FOR TOP categoris   - DESKTOP       */
            .category_text {
                
                font-size: 150%;
                line-height: 50%;
                letter-spacing: -0.02em;
                color:black;
                text-align:left;
                vertical-align:bottom;
                margin-top:70%;
            }
            .pic_frame {
            
                float: left;
                width: 15%;
                height: 18%;
                margin: 0 4% 4% 0;
                font-size: 14px;
                background-color: #ffffff;
                color: #a8a8a8;
                border: 18px solid white;
                -moz-border-radius: 10px;
                -webkit-border-radius: 10px;
                border-radius: 10px;
                }
            
                ul.cimg-list {
                  list-style-type: none;
                  margin: 0;
                  padding: 0;
                  text-align: center;

                }
            
 /*------------------------------------------------------------   STOPS FOR TOP categories    -DESKTOP      */ 
            
 /*------------------------------------------------------------  STARTS FOR TOP categories   - mobile       */
            .mcategory_text {
                
                font-size: 100%;
                line-height: 50%;
                letter-spacing: -0.02em;
                color:black;
                text-align:left;
                vertical-align:bottom;
                margin-top:70%;
            }
            .mpic_frame {
            
                float: left;
                width: 18%;
                height: 20%;
                margin: 0 4% 4% 0;
                font-size: 14px;
                background-color: #ffffff;
                color: #a8a8a8;
                border: 15px solid white;
                -moz-border-radius: 10px;
                -webkit-border-radius: 10px;
                border-radius: 10px;
                }
            
            ul.mcimg-list {
              list-style-type: none;
              margin: 0;
              padding: 0;
              text-align: center;

            }
            
 /*------------------------------------------------------------   STOPS FOR TOP categories    -mobile     */ 
            
                 
            
/*------------------------------------------------------------  STARTS FOR TOP EARNERS   - DESKTOP       */
            
            ul.img-list {
              list-style-type: none;
              margin: 0;
              padding: 0;
              text-align: center;
              
            }

            ul.img-list li {
              display: block;
              height: 165px;
              border-radius:165px;
              position: relative;
              width: 165px;
                float:left;
            }
 

            span.text-content span {
              display: table-cell;
              text-align: center;
              vertical-align: bottom;
            }
            span.text-content {
                
              background: rgba(0,0,0,0.7);
              color: white;
              cursor: pointer;
              display: table;
              height: 165px;
              position: absolute;
              width: 165px;
              font-size:15px;
              font-weight:bold;
              opacity:0;
              border-radius: 165px;
              
              -webkit-transition: opacity 500ms;
              -moz-transition: opacity 500ms;
              -o-transition: opacity 500ms;
              transition: opacity 500ms;
            }

            ul.img-list li:hover span.text-content {
              opacity: 2;
            }
            
     
            
 /*------------------------------------------------------------   STOPS FOR TOP EARNERS    -DESKTOP      */ 

/*------------------------------------------------------------  STARTS FOR TOP EARNERS   - Mobile       */
            
            ul.mimg-list {
              list-style-type: none;
              margin: 0;
              padding: 0;
              text-align: center;
              
            }

            ul.mimg-list li {
              display: block;
              height: 100px;
              border-radius:100px;
              position: relative;
              width: 100px;
              float:left;
            }

            

            span.mtext-content span {
              display: table-cell;
              text-align: center;
              vertical-align: bottom;
            }
            span.mtext-content {
                
              background: rgba(0,0,0,0.7);
              color: white;
              cursor: pointer;
              display: table;
              height: 100px;
              position: absolute;
              width: 100px;
              font-size:50%;
                font-weight:bold;
              opacity:0;
              border-radius: 100px;
              -webkit-transition: opacity 500ms;
              -moz-transition: opacity 500ms;
              -o-transition: opacity 500ms;
              transition: opacity 500ms;
            }

            ul.mimg-list li:hover span.mtext-content {
              opacity: 2;
            }

            .error_popup{
            	border-radius: 2px 2px 2px 2px;
			    color: #FFFFFF;
			    display: none;
			    font-size: 12px;
			    min-height: 25px;
			    width: 180px;
			    padding: 3px;
			    position: absolute;
			    text-align: center;
			    left: 5%;
			    margin-top:15%;
            }
 /*------------------------------------------------------------  STOPS FOR TOP EARNERS   - Mobile       */           
       
       
		</style>
        <script>
            
        </script>
	</head>
	<body>
		<header class="desktop">
			<div class="logo"></div>
			<div class="name"><a href="./index.php" style="text-decoration:none; color:white;"><h2>Memory</h2><h2>Leak</h2></a></div>
			<div class="logo_image" ></div>
			<div class="panel">
				<div class="menubar">
					<ul class="navi">
						<li data-page="1">Home</li>
						<li data-page="2">Work</li>
						<li data-page="3">Top Categories</li>
						<li data-page="4">Top Earners</li>
						<li data-page="5">About</li>
						<li data-page="6">Contact</li>
					</ul>
				</div>
				<div class="toolpanel">
					<ul>
						<li id="login">Login</li>
						<li id="signup">Join Free!</li>
					</ul>
				</div>
			</div>
			<div class="login-signup">
				<div class="signup drops" style="display:none;">
					<input class="text" type="email" placeholder="Email Id" onblur="validate('semail');" id="semail"><span class="semail"></span><br/>
					<input class="text" type="password" placeholder="Password" onblur="validate('spassword');" id="spassword"><span class="spassword"></span><span class="error_popup"></span><br/>
					<input class="text" type="password" placeholder="Confirm Password" onblur="validate('cpassword');" id="cpassword" ><span class="cpassword"></span><br/>
					<input type="checkbox" placeholder="Password" onblur="validate('check');" id="check"><span>Terms and Conditions</span><br/>
					<input class="button" type="button" value="Join Up !" id="joinup" onclick="submit('joinup');"><br/><br/>
					<span id="signupmessage" style="color:red; "></span>
				</div>
				<div class="login drops" style="display:none;">
					<input class="text" type="email" placeholder="Email Id" onblur="validate('email');" id="email"><span class="email"></span><br/>
					<input class="text" type="password" placeholder="Password" onblur="validate('password')" id="password"><span class="password"></span><br/>
					<input class="button" type="button" value="Let's Go > " id="letsgo" onclick="submit('letsgo');"><br/>
					<input class="button" type="button" value="Forgot Password !" id="forgotpassword" onclick="submit('forgotpassword');">
					<span id="loginmessage" style="color:red; "></span>
				</div>
			</div>
		</header>
		<header class="mobile">
			<div class="mobilepanel">
				<div class="menubutton" ></div>
				<div class="authbutton" ></div>
				<div class="mobilemenu drops" style="display:none;">
					<ul class="navi">
						<li data-page="1">Home</li>
						<div class="divider" style="padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;"></div>
						<li data-page="2">Work</li>
						<div class="divider" style="padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;"></div>
						<li data-page="3">Top Categories</li>
						<div class="divider" style="padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;"></div>
						<li data-page="4">Top Earners</li>
						<div class="divider" style="padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;"></div>
						<li data-page="5">About</li>
						<div class="divider" style="padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;"></div>
						<li data-page="6">Contact</li>
					</ul>
				</div>
				<div class="mobiletoolpanel drops" style="display:none;">
					<ul>
						<li id="mlogin">Login</li>
						<div class="divider" style="padding-top: 1px;margin: 5px 1px 6px;border-bottom: 1px solid #e1e8ed;"></div>
						<li id="msignup">Join Free!</li>
					</ul>
				</div>				
				<div class="mlogin drops" style="display:none;">
					<div style="width:200px; font-family:none; margin-left:auto; margin-right:auto;">
						<h3>Login</h3>
						<input class="text" type="email" placeholder="Email Id" onblur="validate('memail');" id="memail"><span class="memail"></span>
						<input class="text" type="password" placeholder="Password" onblur="validate('mpassword')" id="mpassword"><span class="mpassword"></span>
						<input class="button" type="button" value="Let's Go > " id="mletsgo" onclick="submit('mletsgo');">
						<input class="button" type="button" value="Forgot Password !" id="mforgotpassword" onclick="submit('mforgotpassword');">
						<span id="mloginmessage" style="color:red; "></span>
					</div>			
				</div>
				<div class="msignup drops" style="display:none;">
					<div style="width:200px; font-family:none; margin-left:auto; margin-right:auto;">
						<h3>Free Join!</h3>
						<input class="text" type="email" placeholder="Email Id" onblur="validate('msemail');" id="msemail"><span class="msemail"></span>
						<input class="text" type="password" placeholder="Password" onblur="validate('mspassword');" id="mspassword"><span class="mspassword"></span>
						<input class="text" type="password" placeholder="Confirm Password" onblur="validate('mcpassword');" id="mcpassword" ><span class="mcpassword"></span><br/>
						<input type="checkbox" placeholder="Password" onblur="validate('mcheck');" id="mcheck"><span>Terms and Conditions</span>
						<input class="button" type="button" value="Join Up !" id="mjoinup" onclick="submit('mjoinup');" ><br/><br/>
						<span id="msignupmessage" style="color:red; "></span>
					</div>				
				</div>
			</div>
		</header>
		

		<section	class="page" id="page1" data-page="1" data-stellar-background-ratio="0.5">
			<style>
			    .title {
					width: 100%;
					text-align: center;
					z-index: 0;
					margin-top:1%;
				}

				.title h1 {
					color: #fff;
					font-size: 70px;
					font-weight: 700;
					text-transform: uppercase;
					position: relative;
					margin-bottom: 10px;
				}

				.title h1.small {
					font-size: 50px;
					margin-bottom: 10px;
				}

				.title p {
					font-size: 24px;
					line-height: 30px;
					color: #fff;
					position: relative;
				}
				.intro-line {
					position: relative;
					border-top: 1px solid #7ACEF4;
					width: 55%;
					margin: 0 auto auto;
				}

				 .mtitle {
					width: 100%;
					text-align: center;
					z-index: 0;
				}

				.mtitle h1 {
					color: #fff;
					font-size: 200%;
					font-weight: 700;
					text-transform: uppercase;
					position: relative;
					margin-bottom: 10px;
				}

				.mtitle h1.msmall {
					font-size: 100%;
					margin-bottom: 10px;
				}

				.mtitle p {
					font-size: 80%;
					line-height: 20px;
					color: #fff;
					position: relative;
				}
				.mintro-line {
					position: relative;
					border-top: 1px solid #7ACEF4;
					width: 80%;
					margin: 0 auto auto;
				}

			</style>
			<div class="desktop" style="padding-top:100px;">

				<div class="title">
					<div class="intro-line"></div>
					<h1>Hello</h1>
					<h1 class="small">Welcome to MemoryLeak</h1>
					<div class="intro-line"></div>
					
				</div>
				<!-- <div style="font-family: 'Bree Serif', serif;">
					<div><center><h1 style="font-size:250%; color:white;">HELLO</h1></center></div>
					<div><center><h3 style="font-size:150%;  color:white;">WELLCOME TO MEMORY LEAK </h3></center></div>
					<div><center><p style="font-size:150%; color:white;">As your story may not have such a happy ,</br> But it doesn't make you who you are,</br> It's the rest of your story,</br>Who you choose to be! </p></center></div>
				</div> -->
				<div>
					<script>
						
						$(document).ready(function(){
							var index=2;
							setInterval(function() { 
								move()
							},4000);
							function move(){
								
                                $(".move li").hide();
								$(".move").children("li:nth-child("+index+")").fadeIn(5000);
                                
								index++;
								if(index>2)
									index=1;
							}
                            
                            
						});
						
					</script>
					<style>
						.move li{
							display:none;
						}
						.move{
							list-style:none;
						}
					</style>
						<center>
						<ul class="move">
							<li style="display:block;"><p style="font-size:35px; color:white; font-weight:bold; margin-top:10%;">As your story may not have such a happy beginning,</br> But it doesn't make you who you are,</br> It's the rest of your story,</br>Who you choose to be! </p></li>
							<li><img src="./images/slide02.png" style="margin-top:5%;"/></li>
                            
							
						</ul>
					</center>
				</div>
			</div>
			<div class="mobile" style="padding-top:70px;">
				<div class="mtitle">
					<div class="mintro-line"></div>
					<h1>Hello</h1>
					<h1 class="msmall">Welcome to MemoryLeak</h1>
					<div class="mintro-line"></div>
                    <p>As your story may not have such a happy beginning,</br> But it doesn't make you who you are,</br> It's the rest of your story,</br>Who you choose to be! </p></center></p>
					
				</div>
			</div>
			<a class="navbutton" data-page="2"  title=""></a>
		</section>
		<section	class="page" id="page2" data-page="2" data-stellar-background-ratio="0.5">
			<style>
				.wrapper{
							position:relative;
							padding:10%;
							padding-top:9%;
							text-align:center;
							font-family: "Avant Garde", Avantgarde, "Century Gothic", CenturyGothic, "AppleGothic", sans-serif;							
							font-size:22px;
							line-height:150%;
							color:#000000;
							height:100%;
							width:80%;
							-webkit-backface-visibility: hidden;
						}
						.wrapper h1{
							font-family:Arial, Helvetica, sans-serif;
							 font-weight:bold;
							 font-size:50px;
							 padding-bottom:2%;
							 color:#000000;
						}
						.image-wrapper{
							position:relative;
							height:32%;
							margin-top:2%;
						}
						.mimage-wrapper{
							position:relative;
							height:15%;
							margin-top:5%;
						}
						.image-box{
							position:relative;
							width:15%;
							height:100%;
							margin-left:13.3%;
							float:left;
							/*background-color:#CCC;*/
						}
						.mimage-box{
							position:relative;
							width:25%;
							height:100%;
							margin-left:6.5%;
							float:left;
							/*background-color:#CCC;*/
						}
						.image{
							position:relative;
							width:95%;
							height:73%;
							overflow:hidden;
							border-radius:50%;
						}
						.mimage{
							position:relative;
							width:100%;
							height:100%;
							margin:auto;		
							border-radius:50%;					
							overflow:hidden;
						}
						.content{
							position:absolute;
							z-index:1;
							width:100%;
							height:30%;
							bottom:0px;
							opacity:0;
`						}
						.image:hover{
							cursor:pointer;
							
						}
						.image:hover .content{
							opacity:1;							
						}
						.image:hover .img{
							-moz-transform: scale(1.4);
/*							-webkit-transform: scale(1.4);
*/							-o-transform: scale(1.4);
							transform: scale(1.4);
						}
						.img,.image,.content{
							-webkit-transition: all 500ms ease-out;  
							-moz-transition: all 500ms ease-out;  
							-o-transition: all 500ms ease-out;  
							-ms-transition: all 500ms ease-out;  
							transition: all 500ms ease-out;  
						}
						.content div{
							-webkit-transition: all 300ms ease-out;
							-moz-transition: all 500ms ease-out;
							-o-transition: all 500ms ease-out;
							-ms-transition: all 500ms ease-out;	
							transition: all 500ms ease-out;
						}
						.img{
							position:relative;
							width:100%;
							height:100%;
							
						}
						.mobile .wrapper{
							font-size:14px;
							padding-top:18%;
							line-height:140%;
						}
						.content div img{
							position: absolute;
							top: 1%;
							left: 0px;
							width: 92%;
							right: 0px;
							margin: auto;
						}
						.mobile .wrapper h1{
							font-size:40px;
						}
						.heading{
							font-size:30px;
							font-weight:bold;
						}
			
			</style>
			<div class="desktop" style="padding:1%;height:100%;">
				<div class="wrapper">
					<h1 class="heading">WORK</h1>
					<p>
						Here at MemoryLeak, you can post any type of question related to any field <br/> with its prize,
						skilled users answer your post and you can select your favourite answer.<br/>
						<b>ASK  :</b> post your question for free without any flag related to payment <br/>
						<b>ANSWER :</b> receive answers from skilled users and select your favourite  <br/>
						<b>PAY AND RATE :</b> purchase the answer and rate it for others
					</p>
					
					<div class="image-wrapper" >
						<div class="image-box" >
							<h3>ASK</h3>
							<div class="image">
								<div class="content" style="">
									<div>			
										<img src="images/ask-border.png" style="height:100%;" />				
									</div>
								</div>
								<img src="images/ask.png"  class="img">
							</div>
						</div>					
						
						<div class="image-box">	
							<h3>ANSWER</h3>
							<div class="image">
								<div class="content">
									<div>			
										<img src="images/answer-border.png"  style="height:100%;"/>					
									</div>
								</div>
								<img src="images/answer.png"  class="img">						
							</div>
						</div>
						
						<div class="image-box">
							<h3>TUTORIALS</h3>
							<div class="image">		
								<div class="content">
									<div>			
										<img src="images/tutorial-border.png" style="height:100%;" />				
									</div>
								</div>
								<img src="images/tutorial.png"  class="img">
							</div>
						</div>
	
					</div>
				</div>
			</div>
			<div class="mobile" style="height:100%;width:100%;">
				<div class="wrapper" style="padding-top:16%;">
					<p class="heading">WORK</p>
					<p class="content-para">
						Here at MemoryLeak, you can post any type of question related to any field <br/> with its prize,
						skilled users answer your post and you can select your favourite answer.<br/>
						<b>ASK  :</b> post your question for free without any flag related to payment <br/>
						<b>ANSWER :</b> receive answers from skilled users and select your favourite  <br/>
						<b>TUTORIALS :</b> post your projects and earn the best prize by selling
				</p>
					<div class="mimage-wrapper">
						<div class="mimage-box">
							<div class="mimage">
								<img src="images/ask.png" style="width:100%;height:100%;" class="img">
							</div>
						</div>					
						
						<div class="mimage-box">	
							<div class="mimage">
								<img src="images/answer.png" style="width:100%;height:100%; " class="img">						
							</div>
						</div>
						
						<div class="mimage-box">
							<div class="mimage">		
								<img src="images/tutorial.png" style="width:100%;height:100%;" class="img">
							</div>
						</div>
	
					</div>
			</div>			
			</div>	
			<a class="navbutton" data-page="3"  title=""></a>
		</section>
		<style>
			tbody tr td{
				padding:.6%;
				padding-left:1%;
			}
			thead tr th{
				padding-left:1%;
			}
			tbody tr{
				cursor:pointer;
				background-color:#F5F5F5;
			}
			.rnav-button{
				border: medium none;
				border-radius:5px;
				font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
				background:none;
				color:#fff;
				margin-top:3px;
			}
			.rnav-button:hover {
				box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
				cursor:pointer;
				color:#000000;	
			}
			.rnav-button:focus {
				position: relative;
				bottom: -1px;
				box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
				-moz-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
				-webkit-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
			}
			.rnav-button,tr{
				transition: all 0.5s ease;
				-moz-transition: all 0.5s ease;
				-webkit-transition: all 0.5s ease;
				-o-transition: all 0.5s ease;
				-ms-transition: all 0.5s ease;
			}
			#page3{
				font-family: "Avant Garde",Avantgarde,"Century Gothic",CenturyGothic,"AppleGothic",sans-serif;
			}
			#page3 .desktop h1{
				font-family:Arial,Helvetica,sans-serif;
			}
			.rpagecount{
				font-weight:bolder;
			}
			
			tbody tr:hover{
				color:#000;
				background-color:#CCC;
			}


    </style>
    <section	class="page" id="page3" data-page="3" data-stellar-background-ratio="0.5">
			<div>
                <div style="height:100%; width:100%;" class="desktop" >
                    <h5 class="h5_after" style="margin-left:10%; padding-top:8%; font-size:250%; display:block; color:white;">
                        Popular Categories.
                    </h5> 
                    <div style="padding-left:3%;">
                    <?php 
                        for($i=1;$i<7;$i++){
                            switch($i){
                                case 1:
                                    $category="CS";
                                     $title="CS";
                                    $src="./images/categories/$i.png";
                                    break;
                                case 2:
                                    $category="Marketing";
                                    $title="Marketing";
                                    $src="./images/categories/$i.png";
                                    break;
                                case 3:
                                    $category="Music";
                                     $title="Music";
                                    $src="./images/categories/$i.png";
                                    break;
                                case 4:
                                    $category="Drawing";
                                    $title="Graphics designing/Drawing";
                                    $src="./images/categories/$i.png";
                                    break;
                                case 5:
                                    $category="Tourism";
                                    $title="Travel/ Tourism";
                                    $src="./images/categories/$i.png";
                                    break;
                                case 6:
                                    $category="Others";
                                    $title="Others";
                                    $src="./images/categories/8.png";
                                    break;
                                default:
                                    break;
                            }
                          echo'
                            
                            <div class="pic_frame" style=" margin-left:6%;margin-top:2%;">
                                <div style="width:15%; height:30%; float:left;">
                                    <ul class="cimg-list">
                                      <li>
                                        <img src="'.$src.'" style="width:650%; height:500%; float:left; box-shadow: #000 0 0px 20px -1px;"/>

                                      </li>

                                    </ul>
                                </div>
                                <p class="category_text" title="'.$title.'">'.$category.'</p> 
                            </div>
                        ';
  
                        }
                        
                            
                        ?>
                    </div>
                </div>

                
                <div style="height:100%; width:100%;" class="mobile" >
                    <p class="category_after" style="margin-left:5%; padding-top:5%; font-size:150%; display:block; color:white;">
                        Popular categories.
                    </p>
                    <div style="padding-left:3%; margin-top:3%;">
                    <?php 
                        for($i=1;$i<9;$i++){
                            switch($i){
                                case 1:
                                    $category="CS";
                                    $title="CS";
                                    break;
                                case 2:
                                    $category="Marketing";
                                    $title="Marketing";
                                    break;
                                case 3:
                                    $category="Music";
                                     $title="Music";
                                    break;
                                case 4:
                                    $category="Drawing";
                                     $title="Graphics designing/Drawing";
                                    break;
                                case 5:
                                    $category="Tourism";
                                     $title="Travel/ Tourism";
                                    break;
                                case 6:
                                    $category="Writing";
                                     $title="writing";
                                    break;
                                case 7:
                                    $category="SEO";
                                     $title="Search Engine optimization";
                                    break;
                                case 8:
                                    $category="Others";
                                     $title="Others";
                                    break;
                                default:
                                    break;
                                
                            }
                            
                          echo'
                            
                            <div class="mpic_frame" style=" margin-left:4%; margin-top:1%;">
                                <div style="width:15%; height:30%; float:left;">
                                    <ul class="mcimg-list">
                                      <li>
                                        <img src="./images/categories/'.$i.'.png" style="width:650%; height:600%; float:left; box-shadow: #000 0 0px 20px -1px;"/>

                                      </li>

                                    </ul>
                                </div>
                                <p class="mcategory_text" title="'.$title.'">'.$category.'</p> 
                            </div>
                        ';
  
                        }
                        
                            
                        ?>
                    </div>
                </div>

			</div>	
			<a class="navbutton" data-page="4"  title=""></a>
		</section>
		
	<section class="page" id="page4" data-page="4" data-stellar-background-ratio="0.5">
			<div style="height:100%; width:100%;" class="desktop">

					<h5 class="h6_after" style="margin-left:10%; padding-top:8%; font-size:250%; display:block; color:white; ">
                        Top Earners.
                    </h5>
             
					   <?php 
                            include './config/connection.php';
                            $result=mysqli_query($con,"select profiles.user_id,user_name,avg_rating,rating_count,earning,user_type from profiles,users where profiles.user_id=users.user_id and user_type='normal' order by earning desc limit 8");
                            $i=1;
                            while($row=mysqli_fetch_array($result)){
                                if($row['avg_rating']==5){
                                    $rating="A+";
                                }
                                else if($row['avg_rating']>=4&& $row['avg_rating']<5){
                                    $rating="A";
                                }
                                else if($row['avg_rating']>=3&& $row['avg_rating']<4){
                                    $rating="B";
                                }
                                else if($row['avg_rating']>=2&& $row['avg_rating']<3){
                                    $rating="C";
                                }
                                else if($row['avg_rating']>=1&& $row['avg_rating']<2){
                                    $rating="D";
                                }
                                else if($row['avg_rating']>0&& $row['avg_rating']<1){
                                    $rating="F";
                                }
                                else{
                                    $rating="Newbie";
                                }
                                
                                
                                echo'
                                    <div style="width:18%; height:35%; float:left; margin-left:6%; margin-top:2%;  display:block;">
                                        <ul class="img-list">
                                          <li>
                                            <img src="./image.php?user_id='.$row['user_id'].'" style="width:165px; height:165px; border-radius:165px;  cursor:pointer; float:left; box-shadow: #000 0 0px 20px -1px;"/>
                                            <span class="text-content">
                                                <span>
                                                    <p style="color:#0CE7B1;">'.$row['user_name'].'</p>
                                                    <p style="color:#FF9102;">'.$rating.'</p>
                                                    <p style="color:#22E122;">$'.$row['earning'].'</p>
                                                </span>
                                            </span>
                                          </li>

                                        </ul>
                                    </div>
                                ';

                            }
                        ?>
						</div>
            s
            
            
            <div style="height:100%; width:98%;" class="mobile">

					<p class="earners_after" style="margin-left:5%; padding-top:5%; font-size:150%; display:block; color:white;">
                        Top Earners.
                    </p>
             
					   <?php 
                                include './config/connection.php';
                                $result=mysqli_query($con,"select profiles.user_id,user_name,avg_rating,rating_count,earning,user_type from profiles,users where profiles.user_id=users.user_id and user_type='normal' order by earning desc limit 6");
								$i=1;
                                while($row=mysqli_fetch_array($result)){
                                if($row['avg_rating']==5){
                                    $rating="A+";
                                }
                                else if($row['avg_rating']>=4&& $row['avg_rating']<5){
                                    $rating="A";
                                }
                                else if($row['avg_rating']>=3&& $row['avg_rating']<4){
                                    $rating="B";
                                }
                                else if($row['avg_rating']>=2&& $row['avg_rating']<3){
                                    $rating="C";
                                }
                                else if($row['avg_rating']>=1&& $row['avg_rating']<2){
                                    $rating="D";
                                }
                                else if($row['avg_rating']>0&& $row['avg_rating']<1){
                                    $rating="F";
                                }
                                else{
                                    $rating="Newbie";
                                }
                                echo'
                                    <div style="width:20%; height:35%; float:left; margin-left:5%; margin-right:8%;  margin-top:4%;">
                                        <ul class="mimg-list">
                                          <li>
                                            <img src="./image.php?user_id='.$row['user_id'].'" style="width:100px; height:100px; border-radius:100px;  cursor:pointer; float:left; box-shadow: #000 0 0px 20px -1px;"/>
                                            <span class="mtext-content">
                                                <span>
                                                    <p style="color:#0CE7B1;">'.$row['user_name'].'</p>
                                                    <p style="color:#FF9102;">'.$rating.'</p>
                                                    <p style="color:#22E122;">$'.$row['earning'].'</p>
                                                </span>
                                            </span>
                                          </li>

                                        </ul>
                                    </div>
                                ';

                                }
                        ?>
						</div>
            
				
				

			<a class="navbutton" data-page="5"  title=""></a>
		</section>
		<section	class="page" id="page5" data-page="5" data-stellar-background-ratio="0.5" >
			// <script>
			// 	$(document).ready(function(){
			// 		$('.small_video').click(function(){
			// 			$('#trans_bg').fadeIn('slow');
			// 			$('.video_popup').fadeIn('slow');
			// 		});
					
			// 	});
			// </script>
			<div class="desktop" style="padding-top:100px; width:80%; padding-left:10%;">
				<h1 class="about_after" style="color:white;font-size:300%;">About.</h1>
				<div style="width:40%; height:100%; float:left; background: url('./images/world.png'); background-size: 100% 100%; background-repeat: no-repeat;">
					<h3>
						</br>
						MemoryLeak is simple and effective  online platform that helps you find the answer you are looking for .</br></br>
						Here our skilled users (experienced in different categories) subjects to help your homework,projects or any other problem you have
					</h3>
				</div>
				<div class="small_video" style="width:40%; float:right;">
					<video controls style="width:100%;height:360px;" poster="./images/poster.PNG">
					  <source src="./images/facebook.MP4" type="video/mp4">
					</video> 
				</div>
				<!-- <div class="video_popup" style="background-color:black;display:none;width:90%;height:50%;margin:auto auto;margin-top:">
					 <video controls style="width:90%;height:120px;" poster="./images/poster.PNG">
					  <source src="./images/facebook.MP4" type="video/mp4">
					</video>
				</div>
				<div id='trans_bg' style="position: fixed;
					display: none;
					background: #000000;
					opacity: 0.6;
					z-index: 5;
					width: 100%;
					height: 100%;
					top: 0px;
					left: 0px;"></div> -->
			</div>	
			<div class="mobile" style="padding-top:50px; width:90%; padding-left:5%; background: url('./images/world.png'); background-size: 100% 40%; background-origin:content-box; background-repeat: no-repeat;">
				<h1 class="about_after" style="margin-left:5%;color:white;font-size:150%;">About.</h1>
				<div style="width:100%;">
					<p><b>
						</br>
						MemoryLeak is simple and effective  online platform that helps you find the answer you are looking for .</br>
						Here our skilled users (experienced in different categories) subjects to help your homework,projects or any other problem you have
					</b></p>
				</div>
				</br>
				<div style="width:100%;">
					<video controls style="width:100%;" poster="./images/poster.PNG">
					  <source src="./images/video.MP4" type="video/mp4">
					</video>
				</div>
			</div>
			<a class="navbutton" data-page="6"  title=""></a>
		</section>
		<section	class="page" id="page6" data-page="6">
			<style>

			
			.form-element input{
				margin-bottom: 10px;
				display: inline;
				margin-right:3%;

			}
			
			.textinput{
				float:left;
				width:30%;
				display: inline;
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
		

			.cbutton{
				background-color: #ac1f39;
				-moz-border-radius: 0.5em;
				-webkit-border-radius: 0.5em;
				border-radius: 0.5em;
				border: 1px solid #ac1f39;
				float: right;
				width: auto;
				height: auto;
				cursor: pointer;
				font: bold 11px Arial, Helvetica;
				color: #fff;   
				margin-right: 3%; 
				margin-top: 1%;
				padding:0.4em 1em 0.45em;                                              
	
			}
			.cbutton:hover,.cbutton:focus {		
				background-color: #e97171;
					
			}

			
			.contactus_base{
				float: left;
				display: block;
				position: absolute;
				height:auto;
				width:75%;
				font-size:10px;
				top: 82%;
			}
			.contactus_base div{
				float:left;
				width:20%;	
				display: block;
				margin-left:5%;
				margin-right:5%;
			}


			.contactus_base span{
				margin: auto auto;
				margin-bottom: 5%;
			}

			.phone_div p, .address_div p,.mail_div p{
				border-top: 1px solid #fc7e01;
				text-align: center;
				font-size:12px;
			}

			.moon-phone-3{
				background-image: url("./images/mobile.png");
				width: 30px;
				height: 30px;
				display: block;
			}
			.moon-phone-3:hover,.moon-location-3:hover,.moon-envelop-2:hover{
				-webkit-transform: translateY(-5px);
				-moz-transform: translateY(-5px);
				transform: translateY(-5apx);
				-webkit-transition: 0.3s ease;
				-moz-transition: 0.3s ease;
				transition: 0.3s ease;
			}
			.moon-location-3{
				background-image: url("./images/addrs.png");
				width: 30px;
				height: 30px;
				display: block;
			}
			.moon-envelop-2{
				background-image: url("./images/mail.png");
				width: 30px;
				height: 30px;
				display: block;
			}

			.moon-phone-3, .moon-location-3, .moon-envelop-2 {
				font-style: normal;
				font-weight: normal;
				font-variant: normal;
				text-transform: none;
				-webkit-font-smoothing: antialiased;

			}

			span.icofont {

			font-size: 20px;
			color: #c69c6d;
			}

			.contact_after:after{
				font-size:50%;
				color:white;
				content:"(Please don't spam)";
			}


			.err_span{
				margin-top:5%;
				color:red;
				display:block;
				float:left;
			}

			

			
		
		</style>
		<div  class="desktop" style="padding:1%;color:white;">
			
			<div style="width:72%;margin:10% auto;height:100%;">
				
					<h5 class="contact_after" style="font-size:250%;font-weight:bold;color:#7ACEF4;margin-left:5%;">Drop us a line. </h5>
					
				<div class="contactus_wrapper" style="margin:auto; width:90%;height:50%; padding:2%;color:white;">
						
						<div class="contact_box">
								<div class="form-element" >
										<input type="text" name="uname"  class="textinput" placeholder="Your name">
								
										<input type="text" name="email"  class="textinput" placeholder="Your email">
								
										<input type="text" name="subject"  class="textinput" placeholder="Subject">
								
								</div>
								<textarea class="textinput message" name="message" style="resize:none;width:96.5%;height:150px;" placeholder="Message"> </textarea>

								<input type="button" name="submit" class="cbutton"  value="SEND">
						</div>
						
						
				</div>	
				<div class="contactus_base" >
					<div class="phone_div">
	                    <span class="moon-phone-3"></span>
	                    <p>(+91) 8872506755</p>
	                </div>

	                <div class="address_div">
	                    <span class="moon-location-3"></span>
	                    <p>Lovely Infotech, India</p>
	            	</div>

	            	<div class="mail_div">
	                    <span class="moon-envelop-2"></span>
	                    <p><a>support@memoryleak.com</a></p>
	            	</div>
	        	</div>
			</div>
		</div>

		<div class="mobile" style="padding:1%;color:white;">
			<div style="width:100%;margin-top:50px;height:100%;">
				<h5 class="contact_after" style="font-size:150%;font-weight:bold;color:#7ACEF4;margin-left:5%;">Drop us a line. </h5>
				
				<div class="mcontactus_wrapper" style=" width:92%;min-height:60%; padding:4%;color:white;">
						
						<div class="mcontact_box">
								<div class="mform-element" >
										<input type="text" name="uname"  class="textinput" placeholder="Your name" style="width:100%;margin-bottom:2%;">
								
										<input type="text" name="email"  class="textinput" placeholder="Your email" style="width:100%;margin-bottom:2%;">
								
										<input type="text" name="subject"  class="textinput" placeholder="Subject" style="width:100%;margin-bottom:2%;">
								
								</div>
								<textarea class="textinput message" name="message" style="resize:none;width:100%;height:100px;" placeholder="Message"> </textarea>

								<input type="button" name="submit" class="cbutton"  value="SEND" style="margin-right:-1%;">
								<span class="err_span"></span>
						</div>
						
						
				</div>	
				
	        </div>
		</div>
			<script>
				$(document).ready(function(){
					


					$('.cbutton').click(function(){
						var name=$('input[name="uname"]').val();
						var email=$('input[name="email"]').val();
						var subject=$('input[name="subject"]').val();
						var message=$('.message').val();
						if(name!='' && email!='' && subject!='' && message!=''){
							$.ajax({
								url:'query.php',
								data:{name:name,email:email,subject:subject,message:message,type:'2'},
								datatype:'text',
								type:'POST'	
							}).done(function(data){
							alert(data);
								if($.trim(data)==1){
									alert("Query sent.Sit back and wait for our reply ");
								}
								else{
									alert("Dagnabit!!");
								}
							});
						}
						else{
							alert('please enter all fields');
						} 

					});

					
					
				});
			</script>
			<a class="navbutton" data-page="7"  title=""></a>
		</section>
		<section	class="page" id="page7" data-page="7" data-stellar-background-ratio="0.5" style="height:300px;">
			
			<style>
				.footer-limiter {
					margin: 0 auto;
					overflow: hidden;
					position: relative;
					color:white;
				}

				.footer-group {
					float: left;
					width: 20%;
					min-height: 200px;
					font-size: 12px;
					margin-right: 5%;
					margin-top: 2%;
				}

				.bottom-nav a {
					display: inline-block;
					margin: 0 100px 5px 0;
					font-weight: bold;
					white-space: nowrap;
					color: #777;
					text-decoration: none;
					font-size: 13px;
				}

				.footer-limiter h6, .footer_data {
					font-size: 13px;
					margin-bottom: 10px;
					text-transform: uppercase;
					}
                
				.footer-group p {
					padding: 6px 0;
				}

				h6{
					display: block;
					font-size: 15px;
					font-weight: bold;
					margin-top:2%;
				}

				h2{
					display: block;
					font-size: 1.5em;
					font-weight: bold;
					
				}

				p {
					display: block;
				}

			   .book {
					margin-right: 0;
					float:right;
				}

					.fb_span:hover,.gp_span:hover,.tw_span:hover{
					visibility: visible;
					-webkit-transform: translateX(30px);
					-moz-transform: translateX(30px);
					transform: translateX(30px);
					-webkit-transition: 0.3s ease;
					-moz-transition: 0.3s ease;
					transition: 0.3s ease;
					opacity: 1;
				}

				.fb_span,.gp_span,.tw_span{
					opacity: 0;
					width:100px;
					height:30px;
					position:absolute;
					color:white;
					font-size:14px;
					text-align: center;
					text-shadow: 1px 1px 4px rgba(0,0,0,0.3);;
					box-shadow: 4px 4px 8px rgba(0,0,0,0.3);
					margin-left: -10px;
					margin-top:10px;
				}

				.fb_span{
					background-color:#0d6eac;
				}

				.gp_span{
					background-color:#d21919;
				}

				.tw_span{
					background-color:#15b4c9;
				}

			</style>
			<div class="desktop" style="width:80%; padding-left:10%;">
				<div class="footer-limiter" >

					<div class="footer-group bottom-nav" style="min-height:0px;">
						<a href="license.php" target=_blank>Memory Leak License</a>
						<a href="privacy.php" target=_blank>Privacy Policy</a>
						<a href="terms.php" target=_blank>Terms of Use</a>
						<a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img width="100px;" src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_secured_by_pp_2line.png" border="0" alt="Secured by PayPal"></a>
						
					</div>

					<div class="footer-group bottom-nav" >
						<h6>Read our FAQs</h6>
						<p>Reading FAQs will help you know us better</p>
						<a href="faqs.php" target=_blank>FAQs</a>
					</div>

					<div class="footer-group bottom-nav" >
						<h6>Fees</h6>
						<p>Get to know about our fee charges</p>
						<a href="fees.php" target=_blank>Fees</a>
					</div>

								
					<div class="footer-group book" >
							<h2 class="footer_data">Follow us on</h2>
							<div style="margin-right:20px;">
								<a href="http://www.facebook.com/252373264941376"  class="facebook" target=_blank ><img src="./images/social/facebook.png"></a>
									<span class="fb_span" >
										<span style="width:10px;height:10px;position:absolute;margin-top:5px;left:-10%;width: 0;height: 0;border-top: 10px solid transparent;border-bottom: 10px solid transparent;border-right: 10px solid #0d6eac;"></span>
										<?php
											$mlfb_id ="252373264941376"; 
											$json_string = file_get_contents('http://graph.facebook.com/?ids=' . $mlfb_id);
											$json = json_decode($json_string, true);
											if(isset($json_string))
												echo intval( $json[$mlfb_id]['likes'] ).'+';
											else
												echo '0 +';
										?>
									</span>
							</div>

							<div style="margin-right:20px;">
								<a href="http://www.facebook.com/252373264941376"  class="googleplus" target=_blank ><img src="./images/social/googleplus.png"></a>
									<span class="gp_span" >
										<span style="width:10px;height:10px;position:absolute;margin-top:5px;left:-10%;width: 0;height: 0;border-top: 10px solid transparent;border-bottom: 10px solid transparent;border-right: 10px solid #d21919;"></span>
										<?php
											$mlgp_id='115972428755924196491';
											$url='https://www.googleapis.com/plus/v1/people/'.$mlgp_id;
											$curl = curl_init();
										    curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
										    curl_setopt($curl, CURLOPT_POST, 1);
										    curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
										    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
										    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
										    $curl_results = curl_exec ($curl);
										    curl_close ($curl);
										 
										    $json = json_decode($curl_results, true);
										 	if($json)
										   		echo intval( $json[0]['result']['metadata']['globalCounts']['count'] ).'+';
										    else
												echo '0+';
										?>
									</span>
							</div>

							<div style="display:inline;">
								<a href="http://www.facebook.com/252373264941376"  class="twitter" target=_blank ><img src="./images/social/twitter.png"></a>
									<span class="tw_span" >
										<span style="width:10px;height:10px;position:absolute;margin-top:5px;left:-10%;width: 0;height: 0;border-top: 10px solid transparent;border-bottom: 10px solid transparent;border-right: 10px solid #15b4c9;"></span>
										<?php
											$mltw_id='MemoryLeak2';
											$json_string = file_get_contents('http://urls.api.twitter.com/1/urls/count.json?url=' . $mltw_id);
										    $json = json_decode($json_string, true);
										    if($json)
										    	echo intval( $json['count'] ).'+';
										    else
										    	echo '0+';
										?>
									</span>
							</div>
					</div>
			</div>
				
			<span style="float:left;color:white;font-size:12px;top:88%;position:absolute;"><p>Memoryleak ©2014</p></span>
			<span style="color:white;font-size:12px;left:42%;top:88%;position:absolute;">All rights reserved &reg;  <a href="http://www.zamsakk.com" target=_blank style="color:white;">zamsakk | soft</a></span>
			<span style="color:white;font-size:12px;top:88%;left:80%;position:absolute;"><a href='customer_feedback.php' style="color:white;" target=_blank>Feedback</a></span>
		</div>	

			<div class="mobile" style="padding:5%;width:80%;">
				
				<div class="footer-limiter" >

					<div class="footer-group bottom-nav" style="width:80%;min-height:0px;">
						<a href="license.php" target=_blank>Memory Leak License</a>
						<a href="privacy.php" target=_blank>Privacy Policy</a>
						<a href="terms.php" target=_blank>Terms of Use</a>
						<a href="faqs.php" target=_blank>FAQs</a>
						<a href="fees.php" target=_blank>Fees</a>
						<a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img width="50px;" src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_secured_by_pp_2line.png" border="0" alt="Secured by PayPal"></a>
					</div>

					<div class="footer-group book" style="width:80%;min-height:0px;">
						<h6 style="margin-left:25%;">Follow Us<h6>
							<div style="margin-right:20px;display:inline;">
								<a href="http://www.facebook.com/252373264941376"  class="facebook" target=_blank ><img src="./images/social/facebook.png"></a>
							</div>

							<div style="margin-right:20px;display:inline;">
								<a href="http://www.facebook.com/252373264941376"  class="googleplus" target=_blank ><img src="./images/social/googleplus.png"></a>
							</div>

							<div style="display:inline;">
								<a href="http://www.facebook.com/252373264941376"  class="twitter" target=_blank ><img src="./images/social/twitter.png"></a>
							</div>
						
					</div>

			
			</div>
				
				<span style="float:left;color:white;font-size:10px;top:88%;position:absolute;"><p>Memoryleak ©2014</p></span>
				<span style="color:white;font-size:10px;left:35%;top:88%;position:absolute;">All rights reserved &reg; <a href="http://www.zamsakk.com" target=_blank style="color:white;">zamsakk | soft</a> </span>
				<span style="color:white;font-size:10px;top:88%;left:80%;position:absolute;"><a href='customer_feedback.php' style="color:white;" target=_blank>Feedback</a></span>
			</div>
			
		</section>

	</body>
</html>	