<?php 
	include_once './include/lock_normal.php';
?>
<!DOCTYPE html>
<html>
	<head>
        <link rel="shortcut icon" href="./images/logo.png">
		<title>Your Ratings</title>
		<?php
			include_once './include/head.php';
		?>
		<style>
			#box
     {
        width: 60%;
        min-height: 962px;
        background-color: white;
        margin-left: 20%;
        margin-right:20%;
        }
        #container
        {
          background-color: white;
          width: 80%;
          height: 917px;
          border-top-left-radius: 17px;
          border-top-right-radius: 17px;
          position: relative;
          top: 35px;
          left:18%;
          margin-bottom:8%; 

        }
         #outer
        {
          
          border-radius: 17px;
    
          width: 65%;
          height:auto;
          background-color:gray;
          margin-left: 8%;
          
          position: relative;
          top:80px;
          
       }
        #head
        {
     
          border-top-right-radius: 17px;
          border-top-left-radius: 17px;
          height: auto;
          width: 100%;
          background-color :gray;
          alpha(opacity=50); 
          font-size: 35px;
          font-weight:bold;
          text-align:center;
          padding-top:2%;
          padding-bottom: 2%;
        }
       
        #t1
        {
        
          width: 44%;
          float: left; 
          margin-left: 2%;  
          margin-top: 8px; 
          text-align: center;
        }
        #t2
        {
          width: 40%;
          float: left;    
          margin-left: 5%;
          margin-top: 8px;
          text-align: center; 
          text-decoration: none;
        
        }
      
         #outer1
        {
          overflow:hidden;
          margin-top: 8px;
          border-radius:20px;
          background-color: gray;
          height: auto;
          width: 100%;
          
       }
        .head2
        {
          position:relative;
          border-radius:20px;
          margin-top:8px;
          margin-left: 1%;
          font-size: 26px;
          color: #000000;
          float: left;
          height: auto;
          width: 98%;
          background-color:#B0ADA6;
          alpha(opacity=50); 
          vertical-align: center;
          margin-bottom: 8px;
        }
        .head2:first-child
        {
          margin-top: 17px;
        }

         #v1
        {
        
          width: 25%;
          font-size: 17px;
          float: left; 
          margin-left: 7%;  
          margin-top: 20px; 
          text-align: center;
        }
        #v2
        {
          width: 40%;
          float: left;    
          font-size: 17px;
          margin-left: 15%;
          margin-top: 17px;
          height: auto;
          text-align: center; 
          text-decoration: none;
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
          margin-top:10px;
        }
        #l1
        {
          
          position: relative;
          top: 11px;
        }
        a
        {
          text-decoration: none;
        }
        hr
        {
           width:100%;
        } 
      /*=================================================================================================*/

      #mbox
     {
        width: 96%;
        min-height: 962px;
        background-color: white;
        margin-left: 1%;
      
        }
        #mcontainer
        {
          background-color: white;
          width: 98%;
          height: 917px;
          border-top-left-radius: 17px;
          border-top-right-radius: 17px;
          position: relative;
          left:1%;
          margin-bottom:8%; 

        }
         #mouter
        {
          
          border-radius: 17px;
    
          width: 100%;
          height:auto;
          background-color:gray;
          margin-left: 0%;
          
          position: relative;
          top:80px;
          
       }
        #mhead
        {
     
          border-top-right-radius: 17px;
          border-top-left-radius: 17px;
          height: auto;
          width: 100%;
          background-color :gray;
          alpha(opacity=50); 
          font-size: 35px;
          font-weight:bold;
          text-align:center;
          padding-top:2%;
          padding-bottom: 2%;
        }
        
        #mt1
        {
        
          width: 30%;
          float: left; 
          margin-left: 8%;  
          margin-top: 8px; 
          text-align: center;
        }
        #mt2
        {
          width: 44%;
          float: left;    
          margin-left: 9%;
          margin-top: 8px;
          text-align: center; 
          text-decoration: none;
        
        }
        #mt3
        {
          width: 20%;
          float: left;    
          margin-left: 1%;
          margin-top: 8px;
          margin-bottom: 2%;
          text-align: center;
        }
        
         #mouter1
        {
          overflow:hidden;
          border-radius:20px;
          background-color: gray;
          height: auto;
          width: 100%;
          
       }
        .head2
        {
          position:relative;
          border-radius:20px;
          margin-top:8px;
          margin-left: 1%;
          font-size: 26px;
          color: #000000;
          float: left;
          height: auto;
          width: 98%;
          background-color:#B0ADA6;
          alpha(opacity=50); 
          vertical-align: center;
          margin-bottom: 8px;
        }
        .head2:first-child
        {
          margin-top: 17px;
        }

         #mv1
        {
        
          width: 26%;
          font-size: 17px;
          float: left; 
          margin-left: 6%;  
          margin-top: 17px; 
          text-align: center;
        }
        #mv2
        {
          width: 44%;
          float: left;    
          font-size: 17px;
          margin-left: 15%;
          margin-top: 17px;
          height: auto;
          text-align: center; 
          text-decoration: none;
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
        }
		
		</style>
		<script>
		
		</script>
	</head>
	<body>
		<?php
			include_once './include/menu.php';
		?>
		<div class="body">
			<div class="content">
				<div id="box">
         <div id= "container">  
        <div id="outer">
          <div id="head">
            RATING
          </div>
          
                    <div id="outer1">
                      <?php
                          error_reporting(0);
                          session_start();
                          
                          $con=mysqli_connect('localhost','root','','mldb') or die('could not connect the database') ;
                          $sql = "SELECT count(answer_id) FROM answer_accounts ";
                          $retval = mysqli_query($con,$sql )or die( 'failed to get data');
                          $row3 = mysqli_fetch_array($retval, MYSQL_NUM );
                          $rec_count = $row3[0];
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
                        $left_rec = $rec_count - ($page * $rec_limit);
                        $query1="SELECT answer_id ,rating from `answer_accounts` 
                        WHERE buy_from =2 order by answer_id desc LIMIT $offset, $rec_limit";


                            $result1=mysqli_query($con,$query1) or die( 'failed to get data1');
                            while($row=mysqli_fetch_array($result1))
                            {
                             if($row[1]!='')
                             {
                              if($row[1]==5)
                              {
                                  $grade1 = 'A+' ;
                              }

                             elseif($row[1]==4)
                             {
                                  $grade1='A';
                             }
                             
                             elseif($row[1]==3)
                             {
                                  $grade1 ='B';
                             }

                             elseif($row[1]==2)
                             {
                              $grade1 ='C';
                             }
                            
                             else 
                             {
                              $grade1 ='D';
                             }    
                                 $query2="Select question_id from answers where answer_id=".$row[0]."";
                                 $result2= mysqli_query($con, $query2);
                                 $row2= mysqli_fetch_array($result2);

                                 $query3="Select user_id from questions where question_id=".$row2[0]."";
                                 $result3=mysqli_query($con,$query3);
                                 $row3=mysqli_fetch_array($result3); 
                                
                                 $query4="select name from profiles where user_id=".$row3[0]."";
                                 $result4=mysqli_query($con,$query4);
                                 $row4=mysqli_fetch_array($result4); 

                                 $query5="select title from questions where question_id=".$row2[0]."";
                                 $result5=mysqli_query($con,$query5);
                                 $row5=mysqli_fetch_array($result5); 
                                 $length=strlen($row5[0]);
                                 $question_title=substr($row5[0],0,50);
                                   if(strlen($question_title)<$length)
                                   {
                                    $question_title=$question_title."....";
                                   }
                                 echo"<br>";
                                 echo '<div style="width:80%;height:80px;background-color:#E4F6F4;margin-left:10%"><div class="q" style="width:100%; height:55px; cursor:pointer;">
                                                <div style="float:left; width:48px; height:50px; margin-top:2px;margin-left:5%; 
                                                    background-image:url(http://localhost/memoryleak/user/image.php?user_id='.$row3[0].');
                                                    background-size:45px 45px;
                                                    background-repeat:no-repeat;
                                                    display: block;
                                                    border-radius: 50px;
                                                    -webkit-border-radius:50px;
                                                    -moz-border-radius: 50px;
                                                    ">
                                                </div> 
                                                
                                                <a href=view_question.php?question_id='.$row2[0].'&answer_id='.$row[0].'><div id="grade_notify" style="width:80%;background-color:#E4F6F4;margin-left:10%"><i><b>'.$row4[0].' </b></i> Rated <b>'.$grade1.'</b> On <br> '.$question_title.' </div></a><br>
                                              </div>
                                              </div><hr>';  

                                
                             }
                          }


                            
                           ?>
                    </div>
        
        <?php
                           echo '<div class="viewall">';
                 
                           if( $page > 0 )
              {
                 $last = $page - 2;
                 echo "<a href=\"$_PHP_SELF?page=$last \">Last 5 Records</a> |";
                 echo "<a href=\"$_PHP_SELF?page=$page \">Next 5 Records</a>";
              }
              else if( $page == 0 )
              {
                 echo "<a href=\"$_PHP_SELF?page=$page \">Next 5 Records</a>";
              }
              else if( $left_rec < $rec_limit )
              {
                 $last = $page - 2;
                 echo "<a href=\"$_PHP_SELF?page=$last \">Last 5 Records</a>";
              }
              mysqli_close($con);
              echo "</div>";
                          ?>
		  </div><!-- outer-->
      </div>
      </div><!--box-->
				
				
			</div>		
			<div class="mcontent">
				<div id="mbox">
         <div id= "mcontainer">  
        <div id="mouter">
          <div id="mhead">
            Notifications
          </div>
         
                    <div id="mouter1">
   
                     <?php
                          error_reporting(0);
                          session_start();
                          
                          $con=mysqli_connect('localhost','root','','mldb') or die('could not connect the database') ;
                          $sql = "SELECT count(answer_id) FROM answer_accounts ";
                          $retval = mysqli_query($con,$sql )or die( 'failed to get data');
                          $row3 = mysqli_fetch_array($retval, MYSQL_NUM );
                          $rec_count = $row3[0];
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
                        $left_rec = $rec_count - ($page * $rec_limit);
                        $query1="SELECT answer_id ,rating from `answer_accounts` 
                        WHERE buy_from =2 order by answer_id desc LIMIT $offset, $rec_limit";


                            $result1=mysqli_query($con,$query1) or die( 'failed to get data1');
                            while($row=mysqli_fetch_array($result1))
                            {
                             if($row[1]!='')
                             {
                              if($row[1]==5)
                              {
                                  $grade1 = 'A+' ;
                              }

                             elseif($row[1]==4)
                             {
                                  $grade1='A';
                             }
                             
                             elseif($row[1]==3)
                             {
                                  $grade1 ='B';
                             }

                             elseif($row[1]==2)
                             {
                              $grade1 ='C';
                             }
                            
                             else 
                             {
                              $grade1 ='D';
                             }    
                                 $query2="Select question_id from answers where answer_id=".$row[0]."";
                                 $result2= mysqli_query($con, $query2);
                                 $row2= mysqli_fetch_array($result2);

                                 $query3="Select user_id from questions where question_id=".$row2[0]."";
                                 $result3=mysqli_query($con,$query3);
                                 $row3=mysqli_fetch_array($result3); 
                                
                                 $query4="select name from profiles where user_id=".$row3[0]."";
                                 $result4=mysqli_query($con,$query4);
                                 $row4=mysqli_fetch_array($result4); 

                                 $query5="select title from questions where question_id=".$row2[0]."";
                                 $result5=mysqli_query($con,$query5);
                                 $row5=mysqli_fetch_array($result5); 
                                 $length=strlen($row5[0]);
                                 $question_title=substr($row5[0],0,30);
                                   if(strlen($question_title)<$length)
                                   {
                                    $question_title=$question_title."....";
                                   }
                                 echo"<br>";
                                 echo '<div style="width:80%;height:80px;background-color:#E4F6F4;margin-left:10%"><div class="q" style="width:100%; height:55px; cursor:pointer;">
                                                <div style="float:left; width:48px; height:50px; margin-top:2px;margin-left:5%; 
                                                    background-image:url(http://localhost/memoryleak/user/image.php?user_id='.$row3[0].');
                                                    background-size:45px 45px;
                                                    background-repeat:no-repeat;
                                                    display: block;
                                                    border-radius: 50px;
                                                    -webkit-border-radius:50px;
                                                    -moz-border-radius: 50px;
                                                    ">
                                                </div> 
                                                
                                                <a href=view_question.php?question_id='.$row2[0].'&answer_id='.$row[0].'><div id="grade_notify" style="width:80%;background-color:#E4F6F4;margin-left:10%"><i><b>'.$row4[0].' </b></i> Rated <b>'.$grade1.'</b> On <br> '.$question_title.' </div></a><br>
                                              </div>
                                              </div><hr>';  

                                
                             }
                          }


                            
                           ?>
                    </div>
        
        <?php
                           echo '<div class="viewall">';
                 
                           if( $page > 0 )
              {
                 $last = $page - 2;
                 echo "<a href=\"$_PHP_SELF?page=$last \">Last 5 Records</a> |";
                 echo "<a href=\"$_PHP_SELF?page=$page \">Next 5 Records</a>";
              }
              else if( $page == 0 )
              {
                 echo "<a href=\"$_PHP_SELF?page=$page \">Next 5 Records</a>";
              }
              else if( $left_rec < $rec_limit )
              {
                 $last = $page - 2;
                 echo "<a href=\"$_PHP_SELF?page=$last \">Last 5 Records</a>";
              }
              mysqli_close($con);
              echo "</div>";
                          ?>
                      </div>
                                                    </div><!-- outer-->
                                    </div>
                                    </div><!--box-->
				
				
			</div>		
		</div>
		<?php
			include_once './include/footer.php';
		?>
	</body>
</html>