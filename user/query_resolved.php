<?php 
	include_once './include/lock_normal.php';
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
              width: 96%;
              min-height: 7px;
              background-color: white;
              position: relative;
              margin-top: 8%;
              margin-left: 2%;
              margin-right: 10%;
         }
         #subject
         {
              width: 80%;
              min-height: 10px;
              margin-top: 1%;
              margin-left: 10%;
              margin-right: 10%;
              font-size: 21px;
              color:#191542;
              font-weight: bold;ight: bold;
         }
          #m_subject
         {
              width: 103%;
              min-height: 10px;
              margin-top: 1%;
              margin-left: 0%;
              margin-right: 10%;
              font-size: 21px;
              color:#191542;
              font-weight: bold;ight: bold;
         }
           #inner_box
         {
              width: 84%;
              min-height: 10px;
              margin-top: 1%;
              margin-left: 6%;
              margin-right: 10%;
              padding: 17px;
              border-radius: 8px;
              background-color: #ECACBF;
         }
          #m_inner_box
         {
              width: 84%;
              min-height: 10px;
              margin-top: 1%;
              margin-left: 2%;
              margin-right: 10%;
              padding: 17px;
              border-radius: 8px;
              background-color: #ECACBF;
         }
         #admins_reply
         {
              color:#CA2B59;
              font-weight: bold;
              font-size: 20px;
              margin-top: 5%;
              margin-left: 7%;
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
                      
              width: 100%;
              min-height: 10px;
              margin-left: 0%;
              margin-right: 10%;
         }
         .button
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
         .mbutton
        {
          margin-left: 60%;
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
        #text
        {
              width: 80%;
              min-height: 10px;
              margin-left: 7.5%;
              margin-right: 10%;
              font-size: 16px;
              font-weight: bold;
        }
        text
         {
          color:#CA2B59;
          margin-left: 43%;
          font-weight: bold;
          font-size: 23px;
         }
        #box1
        {
          width: 94%;
          margin-left: 3%;
          margin-top: 2%;
        }
        #m_box1
        {
          width: 100%;
          margin-left: -8%;
          margin-top: 2%;
        }
         hr
         {
         	margin-top: 2%;
         	width: 84%;
         	margin-left: 8%;

         }
         #m
         {
            margin-top: 2%;
           width: 100%;
           margin-left: -1%;

         }
         text2
         {
          color:#CA2B59;
         }
         #ticket
         {
            font-size: 20px;
            font-weight: bold;
            margin-left: 10%;
         }
		     #m_ticket
         {
            font-size: 20px;
            font-weight: bold;
            margin-left: 0%;
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
          <br> <text>Your Query</text>
			 		<?php
		             include_once './include/connection.php';
		             $ticket_id=$_GET['ticket_id'];
                 $query2="select user_id from supports where ticket_id=".$ticket_id;
                 $result2=mysqli_query($con,$query2);
                 $row2=mysqli_fetch_array($result2);
                 if($row2[0]!=$login_session)
                 {
                    echo"<script>alert('You are not Authenticated  to Visit this page..!!') </script>";
                    echo "<script>window.location.href = 'index.php';</script>";

                 }
                 else
                 {
                 $query1="update supports set flag=0 where ticket_id=".$ticket_id;
                 $result1=mysqli_query($con,$query1) or die("Not updated");
                 if($result1)
                  echo "<style>
                                 #question
                                 {
                                background-image:url('./images/ques.png');
                                 }
                                </style>";
          
		             $query="select subject,description,reply from supports where ticket_id=".$ticket_id;
		             $result=mysqli_query($con,$query);
		             echo"<br>";
		             $row=mysqli_fetch_array($result);
                }
               

          ?>
          <div id="inner_box">
             
             <div id="ticket"> 
             <text2>Ticket-id : </text2><?php  echo $ticket_id; ?>
             </div>

             <div id="subject"><text2>Subject - </text2> 
               <?php  echo $row[0]; ?> 
  				   </div>

  				 	 <div id="description">
              <text2><b>Description</b></text2>
              <br>
  				 	  <?php  echo $row[1]; ?> 
  				   </div>
           <div id="box1"> 
          
          <div id="admins_reply">
            Admin's Reply :- 
          </div>

				  <div id="text">
				    <?php  echo $row[2]; ?>     
          </div>
           </div>
   
          <hr>
     	    <br>
    	    </div>
          <br><br>   
    	    </div>
				
				
			</div>	

			<div class="mcontent">
				<div id="mbox" >
			 		<?php
                 include_once './include/connection.php';
                 $ticket_id=$_GET['ticket_id'];
                 $query2="select user_id from supports where ticket_id=".$ticket_id;
                 $result2=mysqli_query($con,$query2);
                 $row2=mysqli_fetch_array($result2);
                 if($row2[0]!=$login_session)
                 {
                    echo"<script>alert('You are not Authenticated  to Visit this page..!!') </script>";
                    echo "<script>window.location.href = 'index.php';</script>";

                 }
                 else
                 {

                 $query1="update supports set flag=0 where ticket_id=".$ticket_id;
                 $result1=mysqli_query($con,$query1) or die("Not updated");
          
                 $query="select subject,description,reply from supports where ticket_id=".$ticket_id;
                 $result=mysqli_query($con,$query);
                 echo"<br>";
                 $row=mysqli_fetch_array($result);

                }

          ?>
            <div id="m_inner_box">
             <div id="m_ticket"> 
             <text2>Ticket-id : </text2><?php  echo $ticket_id; ?>
             </div>
             <div id="m_subject"><text2>Subject - </text2> 
               <?php  echo $row[0]; ?> 
             </div>

             <div id="m_description">
              <text2><b>Description</b></text2>
              <br>
              <?php  echo $row[1]; ?> 
             </div>
           <div id="m_box1"> 
          
          <div id="admins_reply">
            Admin's Reply :- 
          </div>

          <div id="text">
            <?php  echo $row[2]; ?>     
          </div>
           </div>
                     <hr id="m">
              <br>
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