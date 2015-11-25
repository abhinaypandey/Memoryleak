
<?php 
	include_once './include/lock_admin.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<?php
			include_once './include/head.php';
		?>
		<style>
		  #box
         {
              width: 60%;
              min-height: 7px;
              background-color: white;
              position: relative;
              margin-top: 8%;
              margin-left: 20%;
              margin-right: 20%;
         }
          #mbox
         {
              width: 94%;
              min-height: 7px;
              background-color: white;
              position: relative;
              margin-top: 8%;
              margin-left: 3%;
              margin-right: 3%;
         }
         #subject
         {
              width: 80%;
              min-height: 10px;
              margin-top: 5%;
              margin-left: 10%;
              margin-right: 10%;
               color:#191542;
         	    font-weight: bold;
         }
         #m_subject
         {
              width: 100%;
              min-height: 10px;
              margin-top: 5%;
              margin-left: 0%;
              margin-right: 0%;
               color:#191542;
              font-weight: bold;
         }
          #innerbox
         {
              width: 80%;
              min-height: 10px;
              margin-top: 2%;
              margin-left: 10%;
              margin-right: 10%;
              padding: 17px;
              border-radius: 8px;
              background-color: #ECACBF;
         }
          #m_innerbox
         {
              width: 85%;
              min-height: 10px;
              margin-top: 2%;
              margin-left: 2%;
              margin-right: 5%;
              padding: 17px;
              border-radius: 8px;
              background-color: #ECACBF;
         }
        
         #description
         {
                      
              width: 80%;
              min-height: 10px;
              margin-left: 10%;
              margin-right: 10%;
            
         }

         #m_description
         {
                      
              width:100%;
              min-height: 10px;
              margin-left: -2%;
              margin-right: 10%;
            
         }
         .button
        {
          margin-left: 77%;
          position: relative;
          width: auto;
          height: 26px;
          font-weight: bold;
          background-color: #0047AB;
          color: white;
          border: none;
          border-radius: 2px;
          margin-top: 1%;
        }
         .mbutton
        {
          margin-left: 80%;
          position: relative;
          width: auto;
          height: 26px;
          font-weight: bold;
          background-color: #0047AB;
          color: white;
          border: none;
          border-radius: 2px;
          margin-top: 1%;
        }

        #texteditor
        {
          display: none;	
          width: 80%;
          margin-left: 10%;
          margin-right: 10%;
          margin-top: 2%;
        }
        #mtexteditor
        {
          display: none;	
          width: 100%;
          margin-left: 0%;
          margin-right: 10%;
          margin-top: 2%;
        }
         #text
         {
          color:#CA2B59;
          margin-left: 35%;
          font-weight: bold;
          font-size: 23px;
         }
         text
         {
          color:red;
         }
         #time
         {
          float: right;
          margin-right: 26px;
          margin-top:-20px;
         }
        
         hr
         {
         	margin-top: 2%;
         	width: 84%;
         	margin-left: 8%;

         }
		
		</style>
		<script type="text/javascript" src="js/tinymce/js/tinymce/tinymce.min.js"></script>
		<script>
	     $(document).ready(function(){
             $('#resolve').click(function(){
                $("#texteditor").slideToggle("slow");	
                $('#resolve').hide();
                $('#reply').show();
             });

             $('#mresolve').click(function(){
                $("#mtexteditor").slideToggle("slow");	
                $('#mresolve').hide();
                $('#mreply').show();
             });
             
             tinymce.init({
                selector: 'textarea#text' ,
                height:'152px',
                resize: false
              });
             tinymce.init({
                selector: 'textarea#mtext' ,
                height:'152px',
                resize: false
              });

		 });
		</script>
	</head>
	<body>
	 <form method="post">
		<?php
			include_once './include/menu.php';
		?>
		<div class="body">
			<div class="content">
			 	<div id="box" >
			 		<?php

		             include_once './include/connection.php';
                  echo "<style>
                                   #question
                                   {
                                  background-image:url('./images/ques.png');
                                   }
                                  </style>";  
		             $ticket_id=$_GET['id'];
		             $query="select subject,description,user_id,entry_date_time from supports where ticket_id=".$ticket_id;
		             $result=mysqli_query($con,$query);
		             echo"<br>";
		             $row=mysqli_fetch_array($result);

                 $pos=strpos($row[3]," ");
                 $date=substr($row[3],0,$pos);
                 $query1="select user_name from profiles where user_id=".$row[2];
                 $result1=mysqli_query($con,$query1);
                 $row1=mysqli_fetch_array($result1);


		             if(isset($_POST['reply']))
      					 {
      					 	$reply=mysqli_real_escape_string($con,addslashes($_POST['text']));
      					    $query="update supports set reply='".$reply."',reply_date_time=NOW(),flag=2 where ticket_id=".$ticket_id;
      					    $result=mysqli_query($con,$query) or die("Not updated");
      					    header('Location:support.php');

      					 }

      					  if(isset($_POST['mreply']))
      					 {
      					 	$reply=mysqli_real_escape_string($con,addslashes($_POST['mtext']));
      					    $query="update supports set reply='".$reply."',reply_date_time=NOW(),flag=2 where ticket_id=".$ticket_id;
      					    $result=mysqli_query($con,$query) or die("Not updated");
      					    header('Location:support.php');

      					 }
		             ?>
           <div id="innerbox">      
		       <div id="subject">
            <div id="name">
                         <text>Query From:</text> <?php echo $row1[0]?>
                      </div>
                      <div id="time">
                         <text>On:</text> <?php echo $date ?>
                      </div>
                      <br>
                      <text >Subject</text>
                      <br>
             <?php  echo $row[0]; ?> 
				   </div>
           <br>
            
				 	 <div id="description">
				 	  <text ><b>Description</b></text>
            <br>
            <?php  echo $row[1]; ?> 
				     </div>
				     <input type='button' name='resolve' value='Resolve' id='resolve' class='button'> </input>
				     <div id="texteditor">
				     	<textarea  id="text" name="text"> 
                         </textarea>
                     </div>
                     <input type='submit' name='reply' value='Reply' id='reply' class='button' style="display:none;"> </input>
				     
                     <hr>
                   </div>
     	        <br><br>
    	       
    	        </div>
				
				
			</div>	

			<div class="mcontent">
				<div id="mbox" >
			 		<?php
		             include_once './include/connection.php';
		             $ticket_id=$_GET['id'];
		             $query="select subject,description,user_id,entry_date_time from supports where ticket_id=".$ticket_id;
		             $result=mysqli_query($con,$query);
		             echo"<br>";
		             $row=mysqli_fetch_array($result);

                 $pos=strpos($row[3]," ");
                 $date=substr($row[3],0,$pos);
                 $query1="select user_name from profiles where user_id=".$row[2];
                 $result1=mysqli_query($con,$query1);
                 $row1=mysqli_fetch_array($result1);


		             if(isset($_POST['reply']))
      					 {
      				  	 	$reply=mysqli_real_escape_string($con,addslashes($_POST['text']));
      					    $query="update supports set reply='".$reply."',reply_date_time=NOW(),flag=2 where ticket_id=".$ticket_id;
      					    $result=mysqli_query($con,$query) or die("Not updated");
      					    header('Location:support.php');

      					 }
		             ?>
                 <div id="m_innerbox"> 
		              <div id="m_subject">
                      <div id="name">
                         <text>Query From:</text> <?php echo $row1[0]?>
                      </div>
                      
                                    

                          <text >Subject</text>
                          <br>  
                      <?php  echo $row[0]; ?> 
				          </div>
                 <br>
				 	       <div id="m_description">
                   <text ><b>Description</b></text>
                    <br>
				 	          <?php  echo $row[1]; ?> 
				         </div>
				        <input type='button' name='mresolve' value='Resolve' id='mresolve' class='mbutton'> </input>
				        <div id="mtexteditor">
				     	    <textarea  id="mtext" name="mtext"> 
                         </textarea>
                </div>
                <input type='submit' name='reply' value='Reply' id='mreply' class='mbutton' style="display:none;"> </input>
				        
    	       
    	          </div>
                <br><br>
          
				
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
	 	?>
	  </form>	
	</body>
</html>