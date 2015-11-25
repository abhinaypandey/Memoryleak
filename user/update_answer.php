<?php 
	include_once './include/lock_normal.php';
	include './include/connection.php';
    
    $answer_id=$_GET['answer_id'];
	$result=mysqli_query($con,"select answer_id from answers where answer_id=$answer_id and user_id=$login_session");
	if(!mysqli_fetch_array($result)){
		header("location:index.php");
	}
	if((isset($_POST['submit']))||(isset($_POST['m_submit'])))
			{
			   		
				 $solution=$_POST['solution'];
				 $query="update answers set solution='$solution' where answer_id='$answer_id' ";

                 $userfile=$_FILES['file']['tmp_name'];  //temp  file
				 $temp = explode(".", $_FILES["file"]["name"]);
				 $filename=$_FILES["file"]["name"];
				 $extension = end($temp);
				 
				$query1="select max(file_no) from answer_file";
				$result=mysqli_query($con,$query1);
				$count=mysqli_fetch_array($result);
				if($count[0]==null)
				{
					$fileno=1;
				}
				else
				{
				 $fileno=$count[0]+1;  
				}  

			    $query2="insert into answer_file(answer_id,file_name,file_no,date_time)values('$answer_id','$filename','$fileno',now())";
				
				if(!mysqli_query($con,$query))
				{
					echo "<script>alert('Error occured.Please try again');</script>";	
								///	echo"<script>alert('ok2');</script>";
		
				}
				else
				{
					echo "<script>alert('Your answer has been updated successfully ');</script>";
								//	echo"<script>alert('ok3');</script>";

				//	move_uploaded_file($_FILES["file"]["tmp_name"],"../uploads/answers_files/" .$file_upload);
				}

				if($filename!=null)
				{
                 if(!mysqli_query($con,$query2))
				{
					echo "<script>alert('Error occured in file upload');</script>";	
								///	echo"<script>alert('ok2');</script>";
		
				}
				else
				{
					echo "<script>alert('Your answer has been inserted successfully ');</script>";
								//	echo"<script>alert('ok3');</script>";

				//	move_uploaded_file($_FILES["file"]["tmp_name"],"../uploads/answers_files/" .$file_upload);
				}

				$filename=$fileno.".".$extension;
				 $targetfile='../uploads/answers_files/'.$filename;
				$i=move_uploaded_file($userfile,$targetfile) or die("Sorry file can't be uploaded");
				 if($i)
                   echo "<script>alert('File Stored successfully');</script>";
          
				}
                 $query4="SELECT question_id FROM answers WHERE answer_id='$answer_id' ";
                 $result4=mysqli_query($con,$query4);
                 $question_id=mysqli_fetch_array($result4);


				 header('Location:view_question.php?question_id='.$question_id[0]);

			}
?>
<!DOCTYPE html>

<html>
	<head>
		<title>View Question</title>
		<?php
			include_once './include/head.php';
		?>
		<style>
			.popper
			{
				cursor:pointer;	
			}
			#text1
			{
				position: relative;
				top:62px;
				margin-left: 10%;
				font-weight: bold;
			}
			.popbox 
			{		
				display:none;
				font-size:13px;			
				text-align:center;
				position: absolute;
				z-index: 99999;
				width: 160px;
				height:60px;
				padding-top:20px;
				background-color:#EEE;
				color: #000;
				border: 1px solid #999;
				margin: 0px;
				-webkit-box-shadow: 0px 0px 5px 0px rgba(164, 164, 164, 1);
				box-shadow: 0px 0px 5px 0px rgba(164, 164, 164, 1);
				font-family: Century Gothic, sans-serif;
			}
			.one
			{
				color:#000;
				height: auto;
				width: 30px;
				font-size:10px;
				padding-right:5px;
				padding-left:4px;
				font-weight:bold;
				text-align:center;
				float:left;
				overflow:hidden;
				text-overflow:ellipsis;
			}
			
			.two
			{
				cursor:pointer;
				color:#BB0000;
				width: auto;
				padding-top:1px;
				padding-right:6px;
				height: auto;
				font-size:10px;
				font-weight:bold;
				text-align:left;
				float:left;
				padding-left:6px;
			}
			
			.wrapper 
			{			
				position:relative;
				margin-bottom:40px;
				margin-top:10px;
				left:0;
				right:0;
				margin:auto;
				background-image:url(images/form-bg.png);
				width:85%;
				padding-top:40px;
				padding-bottom:40px;
				height:auto;
				margin-top:2%;
			}
			#question_box 
			{		
				position:relative;
				width:90%;
				min-height:100px;
				margin:auto;
				background-color:#FFFFFF;
				padding-bottom:20px;
				box-shadow: #000 0 0px 10px -1px;
				-webkit-box-shadow: #000 0 0px 10px -1px;	
			}
			.answer_box 
			{				
				
				background-color:#FFFFFF;
				position:relative;
				width:90%;
				height:880px;
				margin:auto;
				margin-top:2%;
				box-shadow: #000 0 0px 10px -1px;
				padding-top:2%;
				-webkit-box-shadow: #000 0 0px 10px -1px;
			}
			
			.button
			{
				font-family: Century Gothic, sans-serif;
				font-size:15px;
				width:45%;
				height:80%;	
				top-margin:10%;
				background-color: #E9E9E9;
				color:#888;
				border:solid 2px #999;
				font-weight:bold;
				cursor:pointer;
				left:0;
				right:0;
				margin:auto;
			}
			.button:active
			{
				background-color:#A5A5A5;
				color:#FFFFFF;
				border-color:#ABABAB;
			}
			.button:focus,.button:hover
			{
				border:solid 3px #555;
				color:#555;
				text-shadow: 0px 2px 3px rgba(255,255,255,0.3);
			}
			.upload
			{
				position:absolute;
				left: 4%;
				bottom: 12%;
				height: 69%;
				width: 19%;
				z-index:2;
				-moz-opacity:0;
				filter:alpha(opacity: 0);
				opacity: 0;
				cursor:pointer;
			}
			.custom_button
			{
				position:absolute;
				left: 4%;
				bottom: 12%;
				height: 69%;
				width: 19%;z-index:1;
				background-color: #E9E9E9;
				color:#888;
				border:solid 2px #999;
				font-weight:bold;
				font-size:15px;
				z-index:0;
			}
			textarea::-webkit-input-placeholder 
			{
				padding:20px;
				color: #999;
				font-size:16px;
				font-weight:bold;
				font-family: Century Gothic, sans-serif;
			}
			input::-webkit-input-placeholder 
			{
				padding-top:4px;
				color: #999;
				font-size:12px;
				font-weight:bold;
			}
			/* Firefox 18- */
			textarea:-moz-placeholder 
			{ 
				padding:20px;
				color: #999;
				font-family: Century Gothic, sans-serif;
				font-size:16px;
				font-weight:bold;
			}
			input:-moz-placeholder  
			{
				text-align:center;
				color: #999;
				font-family: Century Gothic, sans-serif;
				font-size:12px;
				font-weight:bold;
			}
			/* Firefox 19+ */
			textarea::-moz-placeholder 
			{  
				padding:20px;
				color: #777;
				font-family: Century Gothic, sans-serif;
				font-size:16px;
				font-weight:bold;
			}
			input::-moz-placeholder  
			{
				text-align:center;
				color: #777;
				font-family: Century Gothic, sans-serif;
				font-size:12px;
				font-weight:bold;
			}
			textarea:-ms-input-placeholder 
			{  
				color: #999;
				font-family: Century Gothic, sans-serif;
				font-size:16px;
				font-weight:bold;
			}
			input:-ms-input-placeholder   
			{
				padding-left:10px;
				color: #999;
				font-family: Century Gothic, sans-serif;
				font-size:12px;
				font-weight:bold;
			}
			#abstract
			{   
				border:1px solid;
				position:relative;
				left:0;
				right:0;
				margin:auto;
				width:93%;
				min-height:30px;
				top:23px;
				padding-top: 8px;
				padding-left:8px;
				padding-bottom:8px;
				padding-right:8px;
			}
			#m_abstract
			{   
				border:1px solid;
				position:relative;
				left:0;
				background-color:white;
				right:0;
				margin:auto;
				width:93%;
			    min-height:30px;
				top:53px;
				padding-top: 8px;
				padding-left:8px;
				padding-bottom:8px;
				padding-right:8px;
			}
			#solution 
			{
				position: relative;
				width: 93.3%;
				height: 70%;
				left: 0;
				top: 44px;
				border-color: #200;
				right: 0;
				margin: auto;
			}
			#solution_inner 
			{
				position:absolute;
				width:99.8%;
				height:9%;
				left:0;
				right:0;
				margin:auto;				
				top: 91%;
				border:solid 1px #AAA;
				white-space:normal;
				-moz-box-shadow:0 1px 0 #fff inset;
				-webkit-box-shadow:0 1px 0 #fff inset;
				box-shadow:0 1px 0 #fff inset;
				background:#cfd1cf;
				background-image:-webkit-gradient(linear,left top,left bottom,from(#f5f5f5),to(#cfd1cf));
				background-image:-moz-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-webkit-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-o-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-ms-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:linear-gradient(top,#f5f5f5,#cfd1cf);
				filter:progid:DXImageTransform.Microsoft.gradient(gradientType=0,startColorstr='#f5f5f5',endColorstr='#cfd1cf');
			}
			#m_solution_inner 
			{
				position:absolute;
				width:99.8%;
				height:6%;
				left:0;
				right:0;
				margin:auto;				
				top: 69%;
				border:solid 1px #AAA;
				white-space:normal;
				-moz-box-shadow:0 1px 0 #fff inset;
				-webkit-box-shadow:0 1px 0 #fff inset;
				box-shadow:0 1px 0 #fff inset;
				background:#cfd1cf;
				background-image:-webkit-gradient(linear,left top,left bottom,from(#f5f5f5),to(#cfd1cf));
				background-image:-moz-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-webkit-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-o-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-ms-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:linear-gradient(top,#f5f5f5,#cfd1cf);
				filter:progid:DXImageTransform.Microsoft.gradient(gradientType=0,startColorstr='#f5f5f5',endColorstr='#cfd1cf');
			}
			#solution_submit 
			{		
				position:absolute;
				width:94%;
				height:55px;
				left: 0;
				right:0;
				margin:auto;
				top: 89%;
			}
			.bounty
			{
				position:absolute;
				left: 76%;
				bottom: 12%;
				height: 69%;
				width: 19%;
				z-index:1;
				text-align:center;
				color: #000;
				font-family: Century Gothic, sans-serif;
				font-size:18px;
				font-weight:bold;
			}
			#solution_content
			{
				height: 88%;
				width: 99.8%;
				
			}
			.abstract_content
			{
				height: 100%;
				width:97%;
				max-width:97%;
				max-height:85%;
				position:absolute;
				left:0;
				right:0;
				margin:auto;
				padding:10px;
				color: #222;
				font-family: Century Gothic, sans-serif;
				font-size:14px;
				font-weight:bold;
			
			}
			.m_abstract_content
			{
				height: 100%;
				width:89%;
				max-width:97%;
				max-height:85%;
				position:absolute;
				left:0;
				right:0;
				margin:auto;
				padding:10px;
				color: #222;
				font-family: Century Gothic, sans-serif;
				font-size:14px;
				font-weight:bold;
			
			}
			#file
			{
				position:absolute;
				left: 19%;
				top:37%;
				color: #999;
				z-index:3;
				border-radius:2px;
				font-weight:bold;
			}
			#answer_pop2
			{
				position:absolute;
				top:22px;
				color: #999;
				border-radius:2px;
				left: 810px;
				font-weight:bold;
			}
			.popper1 
			{	cursor:pointer;
				color: white;	
				background-color:#CCC;
				border-radius:3px;
				margin-left:10px;	
			}
			#file_name 
			{
				display:none;
				z-index:3;
				position:absolute;
				width:auto;
				height:auto;
				left: 25%;
				top: 35%;
				border-radius:3px;
				background-color:#FFF;	
				padding:2px;
			}
			.one
			{
				color:#000;
				height: auto;
				width: 30px;
				font-size:10px;
				padding-right:5px;
				padding-left:4px;
				font-weight:bold;
				text-align:center;
				float:left;
				overflow:hidden;
				text-overflow:ellipsis;
			}
			
			.two
			{
				cursor:pointer;
				color:#BB0000;
				width: auto;
				padding-top:1px;
				padding-right:6px;
				height: auto;
				font-size:10px;
				font-weight:bold;
				text-align:left;
				float:left;
				padding-left:6px;
			}
			.link
			{
				cursor:pointer;
				background-color:#EEE;
				border-radius:5px;
				font-weight:bold;
			}
			.warning 
			{
				position:absolute;
				width:442px;
				height:19px;
				font-size:14px;
				font-weight:bold;
				text-align:center;
				color:#550000;
			
				left: 0;
				right: 0;
				margin: auto;
				top: 9%;
			}
			.warning_2 
			{
				position:absolute;
				width:328px;
				height:22px;
				font-size:18px;
				font-weight:bold;
				text-align:center;
				color:#550000;
				
				left: 0;
				top: -62%;
				right: 0;
				margin: auto;
			}
			.warning_3 
			{
				position:absolute;
				position: absolute;
				width: 20%;
				height: 2%;
				z-index: 1;
				left: 75.9%;
				top: 92%;
				font-size:9px;
				font-stretch:extra-expanded;
				font-weight:bold;
				text-align:center;
				color:#550000;
			}
			#title_bar 
			{
				background-image:url(images/bg_form.jpg);
				position:absolute;
				width:100%;
				height:49px;
				left: 0px;
				top: 0px;
				color: #181818;
				font-family: Century Gothic, sans-serif;;
				font-weight:bold;
				text-align:center;
			}
			#title_bar h2
			{
				position:relative;
				top:8px;
				
			}
			.question_container
			{
				padding-left:40px;
				padding-right:30px;
				padding-top:10px;
			}
			.user_link
			{
				text-decoration:none;
			}
			
			/*styles for mobile mode*/
			#mwrapper
			{
				top:10px;
				border-radius:3px;
				padding-top:10px;
				padding-bottom:10px;
				font-family: Century Gothic, sans-serif;;
				width:100%;				
			}
			#mprev_answer
			{
				top:10px;
				border-radius:3px;
				padding-top:10px;
				padding-bottom:10px;
				font-family: Century Gothic, sans-serif;;
				width:94%;
			}
			#mquestion_box
			{
				position:relative;
				width:96%;
				min-height:100px;
				margin:auto;
				background-color:#FFFFFF;
				padding-bottom:46px;
				box-shadow: #000 0 0px 10px -1px;
				-webkit-box-shadow: #000 0 0px 10px -1px;	
			}
			#mquestion_title
			{	position: relative;
				background-image:url(images/bg_form.jpg);
				width: 100%;
				height: 39px;
				border-bottom-color:#000000;
				text-align:center;
				padding-top:2%;
			}
			#mquestion_content
			{
				position:relative;
				font-size:12px;
			}
			#mquestion_section_1
			{
				width: 150px;
				padding-left: 5%;
				padding-top: 2%;
			}
			.msection_1
			{
				color:#222;
				font-weight:bold;
				padding:1% 0% 1% 0%;
			}
			.msection_2
			{
				color:#444;
				font-weight:bold;
				max-width:335px;
				padding:1% 0% 1% 2%;
			}
			#mquestion_description
			{
				padding-top:3%;
				position:relative;
				left:0;
				right:0;
				margin:auto;
				width:90%;
			}
			#mdesc_title
			{
				padding-bottom:10px;
			}
			#mbutton_div
			{
				width:100%;
				left:0;
				right:0;
				margin:auto;
				height: 51px;
				position:relative;
				top:42px;
				background-color: white;

			}
			#mpost_button
			{
				position: absolute;
				right: 0px;
				margin: auto;
				left: 0px;
				height: 32px;
				top:6px;
			}
			.manswer_box
			{
			
				position:relative;
				width:96%;
				margin:auto;			
				min-height:620px;
				background-color:#FFFFFF;
				box-shadow: #000 0 0px 10px -1px;
				-webkit-box-shadow: #000 0 0px 10px -1px;
				padding:10px 0px;
				margin-top:2%;
			}
			#m_abstract
			{
				position: relative;
				margin: auto;
				width: 88.5%;
				min-height: 70px;
			}
			#m_abstract_content
			{
				left:0;
				right:0;
				margin:auto;
				width:100%;
				height:70px;
				max-height:70px;
				max-width:100%;
				min-height:70px;
				min-width:100%;
				padding:0px;
			}
			#m_solution
			{
				position: relative;
				width: 91%;
				top:44px;
				min-height: 250px;
				margin: 21px auto 0px auto;	
						
			}
			#m_solution_content
			{
				left:0;
				right:0;
				margin:auto;
				width:100%;
				top:69%;
				height:8%;
				max-height:100%;
				max-width:100%;
				min-height:100%;
				min-width:100%;
			}
			#m_inner_solution
			{
				width:91%;
				height:40px;
				position:relative;
				top:44px;
				margin:auto;
				border:solid 1px #AAA;
				white-space:normal;
				-moz-box-shadow:0 1px 0 #fff inset;
				-webkit-box-shadow:0 1px 0 #fff inset;
				box-shadow:0 1px 0 #fff inset;
				background:#cfd1cf;
				background-image:-webkit-gradient(linear,left top,left bottom,from(#f5f5f5),to(#cfd1cf));
				background-image:-moz-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-webkit-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-o-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:-ms-linear-gradient(top,#f5f5f5,#cfd1cf);
				background-image:linear-gradient(top,#f5f5f5,#cfd1cf);
				filter:progid:DXImageTransform.Microsoft.gradient(gradientType=0,startColorstr='#f5f5f5',endColorstr='#cfd1cf');
			}
			#m_editor
			{
				height:100%;
				width:100%;
			}
			#m_upload
			{
				position: absolute;
				left: 5%;
				width: 30%;
				z-index: 2;
				opacity: 0;
				cursor: pointer;
				height: 80%;
				top: 6px;
				bottom: 0;
				margin: auto;
			}
			#m_custom_button
			{
				position: absolute;
				left: 5%;
				width: 30%;
				z-index: 0;
				cursor: pointer;
				height: 80%;
				top: 0;
				bottom: 0;
				margin: auto;
			}
			#m_bounty
			{
				height: 67%;
				width: 30%;
				position: absolute;
				right: 5%;
				top: 0;
				bottom: 0;
				margin: auto;
				text-align:center;
				font-size:12px;
			}
			#m_submit
			{
				height:44px;
				position: relative;
				top:4px;
				left: 26%;
			}
			#m_bounty::-webkit-input-placeholder 
			{
				color: #999;
				font-size:12px;
				font-weight:bold;
				text-align:center;
				padding:0px;
			}
			#m_question_table
			{
				left: 4.9%;
				position: relative;
				text-align:left;
				top:10px;
			}
			#m_file_name
			{
				position:absolute;
				display:none;
				width:auto;
				height:auto;
				border-radius:3px;
				background-color:#FFF;	
				padding:2px;
			}
			#m_two
			{
				cursor:pointer;
				color:#BB0000;
				width: auto;
				padding-top:1px;
				padding-right:6px;
				height: auto;
				font-size:10px;
				font-weight:bold;
				text-align:left;
				float:left;
				padding-left:6px;
			}
			.prev_answers
			{
				position:relative;
				margin:auto;
				width:90%;
				padding:5px 12px;
				border: solid 2px #AAA;
				margin-bottom:15px;
				margin-top:15px;
				font-size:15pxl
			}
			#answer_pop1
			{
				position:absolute;
				left: 19%;
				top:37%;
				color: #999;
				z-index:3;
				border-radius:2px;
				font-weight:bold;
			}
			#ans_image
			{
				padding: 6px 44px 0px 8px;
			}
			#ans_image img
			{
				width:50px;
				height:50px;
				box-shadow: #000 0 0px 10px -1px;
				-webkit-box-shadow: #000 0 0px 10px -1px;
				
			}
			#title_bar 
			{
				background-image:url(images/bg_form.jpg);
				position:absolute;
				width:100%;
				height:49px;
				left: 0px;
				top: 0px;
				color: #181818;
				font-family: Century Gothic, sans-serif;;
				font-weight:bold;
				text-align:center;
			}
			
		</style>
		<script src="./js/tinymce/js/tinymce/tinymce.min.js"></script>
		<script>
			$(document).ready(function()
			{
            
				//text editor function for desk top mode			
				tinymce.init(
				{
					selector:'textarea#solution_content',
					resize:false,
					statusbar:false,	
					height:'500px',
					menubar: "edit view",
					plugins: "textcolor link image print preview visualblocks visualchars fullscreen",
					toolbar: "undo redo | forecolor backcolor | styleselect | bold italic |  alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image emoticons print",
					style_formats:
					[
						{
							title: "Headers",
							items: 
							[
								{title: "Header 1",format: "h1"},
								{title: "Header 2",format: "h2"},
								{title: "Header 3",format: "h3"},
								{title: "Header 4",format: "h4"},
								{title: "Header 5",format: "h5"},
								{title: "Header 6",format: "h6"}
							]
						},
						{
							title: "Inline",
							items: 
							[
								{title: "_Underline",icon: "underline",format: "underline"}, 
								{title: "Strikethrough",icon: "strikethrough",format: "strikethrough"}, 
								{title: "Superscript",icon: "superscript",format: "superscript"}, 
								{title: "Subscript",icon: "subscript",format: "subscript"}, 
								{title: "Code",icon: "code",format: "code"}
							]
						}, 
						{
							title: "Blocks",
							items: 
							[
								{title: "Paragraph",format: "p"}, 
								{title: "Blockquote",format: "blockquote"}, 
								{title: "Div",format: "div"}, 
								{title: "Pre",format: "pre"}
							]
						}, 
						{
							title: "Font Family",
							items: 
							[
								{title: 'Arial', inline: 'span', styles: { 'font-family':'arial'}},
								{title: 'Book Antiqua', inline: 'span', styles: { 'font-family':'book antiqua'}},
								{title: 'Comic Sans MS', inline: 'span', styles: { 'font-family':'comic sans ms,sans-serif'}},
								{title: 'Courier New', inline: 'span', styles: { 'font-family':'courier new,courier'}},
								{title: 'Georgia', inline: 'span', styles: { 'font-family':'georgia,palatino'}},
								{title: 'Helvetica', inline: 'span', styles: { 'font-family':'helvetica'}},
								{title: 'Impact', inline: 'span', styles: { 'font-family':'impact,chicago'}},
								{title: 'Open Sans', inline: 'span', styles: { 'font-family':'Open Sans'}},
								{title: 'Symbol', inline: 'span', styles: { 'font-family':'symbol'}},
								{title: 'Tahoma', inline: 'span', styles: { 'font-family':'tahoma'}},
								{title: 'Terminal', inline: 'span', styles: { 'font-family':'terminal,monaco'}},
								{title: 'Times New Roman', inline: 'span', styles: { 'font-family':'times new roman,times'}},
								{title: 'Verdana', inline: 'span', styles: { 'font-family':'Verdana'}}
							]
						},
						{
							title: "Font Size", items: 
							[
								{title: '8pt', inline:'span', styles: { fontSize: '12px', 'font-size': '8px' } },
								{title: '10pt', inline:'span', styles: { fontSize: '12px', 'font-size': '10px' } },
								{title: '12pt', inline:'span', styles: { fontSize: '12px', 'font-size': '12px' } },
								{title: '14pt', inline:'span', styles: { fontSize: '12px', 'font-size': '14px' } },
								{title: '16pt', inline:'span', styles: { fontSize: '12px', 'font-size': '16px' } }
							]
						}
					]
				});
				
				//text editor for mobile mode
				tinymce.init(
				{
					selector:'textarea#m_solution_content',
					resize:false,
					statusbar:false,
					height:'200px',
					menubar: "edit view",
					plugins: "textcolor link image print emoticons preview visualblocks visualchars fullscreen",
					toolbar: "undo redo | forecolor backcolor | styleselect | bold italic |  alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image emoticons print",
					style_formats:
					[
						{
							title: "Headers",
							items: 
							[
								{title: "Header 1",format: "h1"},
								{title: "Header 2",format: "h2"},
								{title: "Header 3",format: "h3"},
								{title: "Header 4",format: "h4"},
								{title: "Header 5",format: "h5"},
								{title: "Header 6",format: "h6"}
							]
						},
						{
							title: "Inline",
							items: 
							[
								{title: "_Underline",icon: "underline",format: "underline"}, 
								{title: "Strikethrough",icon: "strikethrough",format: "strikethrough"}, 
								{title: "Superscript",icon: "superscript",format: "superscript"}, 
								{title: "Subscript",icon: "subscript",format: "subscript"}, 
								{title: "Code",icon: "code",format: "code"}
							]
						}, 
						{
							title: "Blocks",
							items: 
							[
								{title: "Paragraph",format: "p"}, 
								{title: "Blockquote",format: "blockquote"}, 
								{title: "Div",format: "div"}, 
								{title: "Pre",format: "pre"}
							]
						}, 
						{
							title: "Font Family",
							items: 
							[
								{title: 'Arial', inline: 'span', styles: { 'font-family':'arial'}},
								{title: 'Book Antiqua', inline: 'span', styles: { 'font-family':'book antiqua'}},
								{title: 'Comic Sans MS', inline: 'span', styles: { 'font-family':'comic sans ms,sans-serif'}},
								{title: 'Courier New', inline: 'span', styles: { 'font-family':'courier new,courier'}},
								{title: 'Georgia', inline: 'span', styles: { 'font-family':'georgia,palatino'}},
								{title: 'Helvetica', inline: 'span', styles: { 'font-family':'helvetica'}},
								{title: 'Impact', inline: 'span', styles: { 'font-family':'impact,chicago'}},
								{title: 'Open Sans', inline: 'span', styles: { 'font-family':'Open Sans'}},
								{title: 'Symbol', inline: 'span', styles: { 'font-family':'symbol'}},
								{title: 'Tahoma', inline: 'span', styles: { 'font-family':'tahoma'}},
								{title: 'Terminal', inline: 'span', styles: { 'font-family':'terminal,monaco'}},
								{title: 'Times New Roman', inline: 'span', styles: { 'font-family':'times new roman,times'}},
								{title: 'Verdana', inline: 'span', styles: { 'font-family':'Verdana'}}
							]
						},
						{
							title: "Font Size", items: 
							[
								{title: '8pt', inline:'span', styles: { fontSize: '12px', 'font-size': '8px' } },
								{title: '10pt', inline:'span', styles: { fontSize: '12px', 'font-size': '10px' } },
								{title: '12pt', inline:'span', styles: { fontSize: '12px', 'font-size': '12px' } },
								{title: '14pt', inline:'span', styles: { fontSize: '12px', 'font-size': '14px' } },
								{title: '16pt', inline:'span', styles: { fontSize: '12px', 'font-size': '16px' } }
							]
						}
					]
				});	
				
				//======================================================================================================
                   

		           $(".upload").change(function()
				{
					var file_name=$(".upload").val();
					var size=(this.files[0].size)/(1024*1024);
					if(size > 1000){
						alert('File size should be less than 1GB !!!');
						$('.upload').val('');
					}
					 else if((file_name.indexOf('.exe') > -1))	
					{
						alert('.exe file type is not supported.');
						$('.upload').val('');
						flag_4=false;
					}
					else
					{	
						$("#file_name").fadeIn("fast");
						$(".one").text(file_name);
						flag_4=true;		
					}
				});
				$(".two").click(function()
				{
					$("#file_name").fadeOut("fast");
					$(".upload").val('');
					
				});
				
				
		            $("#m_upload").change(function()
			    	{
					var file_name=$("#m_upload").val();
					var size=(this.files[0].size)/(1024*1024);
					if(size > 1000){
						alert('File size should be less than 1GB !!!');
						$('#m_upload').val('');
					}
					else if((file_name.indexOf('.exe') > -1))	
					{
						alert('.exe file type is not supported.');
						flag_4=false;
					}
					else
					{
						$("#m_file_name").fadeIn("fast");
						$(".one").text(file_name);
						flag_4=true;
					}	
				});
		            $("#m_two").click(function()
					{
						$("#m_file_name").fadeOut("fast");
						$("#m_upload").val('');
					});

		         
			    //======================================================================================================


		});
		</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<?php
			include_once './include/menu.php';
		?>
		<div class="body">
			<div class="content">
				<div class="wrapper">
				<!--answer box contents -->
				<div class="answer_box" >

					<form  method="post" enctype="multipart/form-data" id='answer_form'>
					<div id="title_bar">
						<h2>UPDATE SOLUTION</h2>
					</div>
					<br><br>
					
						<div id="abstract">							
							<?php 
                             include './include/connection.php';
                            // $con=mysqli_connect('localhost','root','','mldb') or die('could not connect the database') ;

                             $query ="SELECT abstract,solution,bounty from answers where answer_id='$answer_id' ";
                             $result=mysqli_query($con,$query) or die('Error in fetching abstract');
                             $row=mysqli_fetch_row($result);
                             echo $row[0];
						     ?>
						</div>
						<span class="sp1" style=" font-weight:bold; position:relative; left:3%;top:44px;">UPDATE YOUR SOLUTION:</span>						
						<div id="solution">
							<textarea id="solution_content" name="solution" placeholder="Give the complete Solution here" >
							<?php 
                             echo $row[1];
						     ?></textarea>	
                         

							<div id="solution_inner">

										<div class="warning_2"></div>
										<input type="button" class="custom_button" value="Add file">
										<input type="file" class="upload" name="file"><a id="answer_pop1" class="popper" data-popbox="attach">? </a>
										<div id="file_name">
											<div class="one" style="width:100px;"></div>
											<div class="two">X</div>
										</div>
										
								<input readonly type="text" class="bounty" placeholder=" set your Bounty $" name="bounty" value="<?php
	                            echo  '$'.$row[2];
								?>"/>
							</div>
								<div class="warning_3"></div>
						</div>
						<div id="solution_submit" align="center">
							<input type="submit" id="submit_answer" class="button" value="UPDATE" name="submit">
						</div>
					</form>               
				</div>             
				<!--answer box ends here -->
                
                
                
            </div>	
		</div>
	</div>

        <div class="mcontent">
        	
        	<div class="wrapper" id="mwrapper">
				<!--answer box contents -->
				<div class="manswer_box" >
					<form action="" method="post" enctype="multipart/form-data" id="m_answer_form">
						<div id="title_bar">
						<h2>UPDATE SOLUTION</h2>
					</div>
					
					<div class="" id="m_abstract">
				            <?php 
                             include './include/connection.php';
                            // $con=mysqli_connect('localhost','root','','mldb') or die('could not connect the database') ;

                             $query ="SELECT abstract,solution,bounty from answers where answer_id='$answer_id' ";
                             $result=mysqli_query($con,$query) or die('Error in fetching abstract');
                             $row=mysqli_fetch_row($result);
                             echo $row[0];
						     ?>

							<div class="warning" style="position:absolute;width:101%;left:0;right:0;margin:auto;top:75%;font-size:10px;"></div>					
						</div>
                        <div id="text1">
						Update Your Solution:
					    </div>
                        <div class="" id="m_solution">
								<textarea id="m_solution_content">
								 <?php 
                                 echo $row[1];
						         ?></textarea>  
								<div class="warning_2" style="position:absolute;top:90%;left:3px;">
								</div>                          
						</div>
						<div id="m_inner_solution">
								<input type="button" id="m_custom_button" class="custom_button" value="Add file">
								<input type="file" id="m_upload" class="upload" name="file">
								<div id="m_file_name" style="left:38.5%;top: 33%;">
									<div class="one" style="font-size:6px;"></div>
									<div id='m_two' style="font-size:6px;">X</div>
								</div>
								<input type="text" readonl id="m_bounty"  classs='bounty' placeholder=" Bounty $ " name="bounty" value="<?php echo'$ '.$row[2];?>"/>
								
								<div class="warning_3" style="position:absolute;top:61%;height:21%;font-size:5px;width:23%;left:69%;z-index:3;"></div>
						</div>		
						<div id="mbutton_div"> 
								<input type="submit" value="UPDATE" class="button" id="m_submit" name="submit">
						</div>
                         
					</div>
				</div>   
				</form>           
				<!--answer box ends here -->
                
                
                
            </div>	
	   

					
					<?php
			//include_once './include/footer.php';
		?>
	</body>
</html>