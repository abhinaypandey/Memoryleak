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
         #subject
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
          #mbox
         {
              width: 90%;
              min-height: 7px;
              background-color: white;
              position: relative;
              margin-top: 8%;
              margin-left: 5%;
              margin-right: 20%;
         }
         #msubject
         {
              width: 80%;
              min-height: 10px;
              margin-top: 2%;
              margin-left: 4%;
              margin-right: 10%;
              padding: 17px;
              border-radius: 8px;
              background-color: #ECACBF;
         }
         #text
         {
         	color:#CA2B59;
         	margin-left: 35%;
         	font-weight: bold;
            font-size: 23px;
         }
          #m_text
         {
         	color:#CA2B59;
         	margin-left: 17%;
         	font-weight: bold;
            font-size: 23px;
         }
         #inner_box
         {
         	min-height: 100px;
         	border:1px solid;
         	width: 80%;
         	margin-left: 9%;
         	padding-bottom: 8px;
         	border-radius: 11px;
         	background-color: #B0ADA6;
         }
         #m_inner_box
         {
         	min-height: 100px;
         	border:1px solid;
         	width: 95%;
         	margin-left: 2%;
         	padding-bottom: 8px;
         	border-radius: 11px;
         	background-color: #B0ADA6;
         }
         .viewall
        {
          width: 100%;
          height: 26px;
          text-align: center;
          background-color: #B0ADA6;
          border-bottom-right-radius: 17px;
          border-bottom-left-radius: 17px;
          padding-top: 13px;
          margin-top: 2%;
        }

         #alink:a{
         	 color:#191542;
         	 font-weight: bold;
         }
         hr
         {
         	margin-top: 2%;
         	width: 84%;
         	margin-left: 8%;

         }
         text
         {
         	color:red;
         }
         #time
         {
         	float: right;
         	margin-right: 26px;
         	margin-top:-17px;
         }


		</style>
		
		<script>
	     $(document).ready(function(){
             $('#subject').click(function(){
                $("#description").slideToggle("slow");	
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
			 		<br><br>
                    <div id="text">
			 		Unresolved Queries
			 		</div>
			 		<div id="inner_box">
				 		<?php
				 		 echo "<style>
			                             #question
			                             {
				                          background-image:url('./images/ques.png');
			                             }
			                            </style>";	
							    
			             include_once './include/connection.php';
			             
			             $query2="select count(*) from supports where flag=1";
			             $result2=mysqli_query($con,$query2);
                         $row2=mysqli_fetch_array($result2);
                         $count=$row2[0];
						 if($count==0){
							echo "<script>
											alert('No Record Exists...');
											window.location.href='index.php';
								</script>";
						 }
                         $rec_limit=5;

                         if( isset($_GET{'page'} ) )
                          {
                            $page = $_GET{'page'} + 1;
                            $offset = $rec_limit * $page ;
                          } 
                          else
                          {
                              $page = 0;
                              $offset = 0;
                          }
                          $left_rec = $count - ($page * $rec_limit);
                         if($count-($page * $rec_limit)>0)
                         {
			             $query="select subject,ticket_id,user_id,entry_date_time from supports where flag=1 order by entry_date_time desc limit $offset, $rec_limit";
			             $result=mysqli_query($con,$query);
			             while($row=mysqli_fetch_array($result))
			             {
			             	$pos=strpos($row[3]," ");
			             	$date=substr($row[3],0,$pos);
			             	$query1="select user_name from profiles where user_id=".$row[2];
			             	$result1=mysqli_query($con,$query1);
			             	$row1=mysqli_fetch_array($result1);
			             	 echo'<div id="subject">
			             	      
			                              <div id="name">
			                              <text>Query From:</text> '.$row1[0].'
			                              </div>
			                              <div id="time">
		                                  <text>On:</text> '.$date.'
			                              </div>
			                              

			             	      <text >Subject</text>
			             	      <br>  
	                              <a id="alink" href="resolve.php?id='.$row[1].'">'.$row[0].' </a>
	                              
		                                  
			                      </div>
					 		      ';

			
			             } 	
			              echo '<div class="viewall">';
                 
                             if( $page > 0 )
				              {
				                 $last = $page - 2;
				                 echo "<a id=\"alink\" href=\"support.php?page=$last \">Last 5 Records</a> |";
				                 echo "<a id=\"alink\" href=\"support.php?page=$page \">Next 5 Records</a>";
				              }
				              else if( $page == 0 )
				              {
				                 echo "<a id=\"alink\" href=\"support.php?page=$page \">Next 5 Records</a>";
				              }
				              else if( $left_rec < $rec_limit )
				              {
				                 $last = $page - 2;
				                 echo "<a id=\"alink\" href=\"support.php?page=$last \">Last 5 Records</a>";
				              }
				              echo "</div>";	 
						}
						else
						{
							$c=$page-2;
							echo"<script>alert('No More Records.. Click Ok to go back to last page');</script>";
							
							echo "<script>window.location.href = \"support.php?page=$c\";</script>";
						}			 	
	                    ?>
                    </div>
    	        <br><br>
    	       
    	        </div>
				
				
			</div>	

			<div class="mcontent">
				<div id="mbox" >
					<br>
					<div id="m_text">
			 		Unresolved Queries
			 		</div>
			 		<div id="m_inner_box">
			 		<?php
			 		 echo "<style>
		                             #question
		                             {
			                          background-image:url('./images/ques.png');
		                             }
		                            </style>";	
						    
		             include_once './include/connection.php'	;
		             $query2="select count(*) from supports where flag=1";
			         $result2=mysqli_query($con,$query2);
                     $row2=mysqli_fetch_array($result2);
                     $count=$row2[0];
                     $rec_limit=5;

                     if( isset($_GET{'page'} ) )
                      {
                            $page = $_GET{'page'} + 1;
                            $offset = $rec_limit * $page ;
                      } 
                     else
                      {
                            $page = 0;
                            $offset = 0;
                      }
                      $left_rec = $count - ($page * $rec_limit);
                      if($count-($page * $rec_limit)>0)
                      {
			             $query="select subject,ticket_id,user_id,entry_date_time from supports where flag=1 order by entry_date_time desc limit $offset, $rec_limit";
			             $result=mysqli_query($con,$query);
			             echo"<br>";
			             while($row=mysqli_fetch_array($result))
			             {
			             	 $pos=strpos($row[3]," ");
				             $date=substr($row[3],0,$pos);
				             $query1="select user_name from profiles where user_id=".$row[2];
				             $result1=mysqli_query($con,$query1);
				             $row1=mysqli_fetch_array($result1);
				             	
			             	 echo'<div id="msubject">
			             	      <div id="name">
				                              <text>Query From:</text> '.$row1[0].'
				                              </div>
				                              <div id="time">
			                                  </div>
				                   <text>Subject:</text> <br>          
	                              <a id=\"alink\" href="resolve.php?id='.$row[1].'">'.$row[0].' </a>
					 		      </div>
					 		      ';
			             } 		 
			             echo '<div class="viewall">';
                 
                             if( $page > 0 )
				              {
				                 $last = $page - 2;
				                 echo "<a id=\"alink\" href=\"support.php?page=$last \">Last 5 Records</a> |";
				                 echo "<a id=\"alink\" href=\"support.php?page=$page \">Next 5 Records</a>";
				              }
				              else if( $page == 0 )
				              {
				                 echo "<a id=\"alink\" href=\"support.php?page=$page \">Next 5 Records</a>";
				              }
				              else if( $left_rec < $rec_limit )
				              {
				                 $last = $page - 2;
				                 echo "<a id=\"alink\" href=\"support.php?page=$last \">Last 5 Records</a>";
				              }
				              echo "</div>";	 
						}
									 	
					   
					   else
						{
							$c=$page-2;
							echo"<script>alert('No More Records.. Click Ok to go back to last page');</script>";
							
							echo "<script>window.location.href = \"support.php?page=$c\";</script>";
						}	
	                    ?>
                </div>
    	        <br><br>
    	       
    	        </div>
				
				
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
	 	?>
	  </form>	
	</body>
</html>