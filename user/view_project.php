<?php 
    include_once './include/lock_normal.php';
    if(isset($_GET['notify']) && isset($_GET['project_id']) && isset($_GET['transaction_id'])){
        $notify=$_GET['notify'];
        $project_id=$_GET['project_id'];
        $tid=$_GET['transaction_id'];
        if($notify=='1'){
            include './include/connection.php';
            mysqli_query($con,"UPDATE project_accounts SET notify=0 WHERE project_id=$project_id and transaction_id=$tid");
            mysqli_close($con);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="./images/logo.png">
        <title>View Project</title>
        <?php
            include_once './include/head.php';
        ?>
        <style>
            
            .questdiv{
                background-color: whitesmoke ;
                width:99%;
                min-height:57px;
                margin:auto;
                border-bottom:2px solid #3bb;
                padding:0.5%;
            }
             img.image_class{
                box-shadow: #000 0 0px 10px -1px;
            }

            .questdiv img{
                float:left;
                border:2px solid whitesmoke outset;
                margin: 5px;
                width:50px;
                height: 50px;
                border-radius:50px;

            }

            .quest{
                width:90%;
                min-height:80px; 
                float:left;

            }

             .nav-div{
                margin-left:5%;
            }
            
            .nav-button,.button,.mbutton{
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
                margin-top:1%;
                margin-bottom:1%;
                width: 100px;
                cursor: pointer;
                font: bold 11px Arial, Helvetica;
                color: #fff;                                                  
    
            }
            .nav-button:hover,.nav-button:focus,.button:hover,.button:focus,.mbutton:hover,.mbutton:focus  {       
                background-color: #e97171;
                background-image: -webkit-gradient(linear, left top, left bottom, from(#d14545), to(#e97171));
                background-image: -webkit-linear-gradient(top, #d14545, #e97171);
                background-image: -moz-linear-gradient(top, #d14545, #e97171);
                background-image: -ms-linear-gradient(top, #d14545, #e97171);
                background-image: -o-linear-gradient(top, #d14545, #e97171);
                background-image: linear-gradient(top, #d14545, #e97171);
            }   
    
            .rar_popup{
    
                width:70%;
                background-color: #3bb;
                text-shadow: 0 1px 0 rgba(0,0,0,.5);
                -moz-box-shadow: 0 0 20px #9ecaed; 
                -webkit-box-shadow:0 0 20px #9ecaed; 
                box-shadow: 0 0 20px #9ecaed; 
                color: #FFF;
                display: none;
                position: fixed;
                min-height:10%;
                top:25%;
                left:15%;
                z-index: 5;
              
            }
            
            .trans_bg{
                position: fixed;
                display: none;
                background: #000000;
                opacity: 0.6;
                z-index: 1;
                width: 100%;
                height: 100%;
                top: 0px;
                left: 0px;

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
               

                $(".rar").click(function(){
                    $('.trans_bg').show();
                   $(".rar_popup").slideDown('easeIn');
               }); 
                
                $(".atc").click(function(){
                    var project_id=$.trim($(this).attr('data'));
                     $.ajax({
                         url:"./query.php",
                         type:"POST",
                         
                         data:{
                                type:33,
                               project_id:project_id
                         }
                     }).done(function(data){
                        var items= $('.cart_count').val();
                        $('.cart_count').html(items+1).show('slow');
                        window.location.href="view_project.php?project_id="+project_id;
                     });   
                });
                
                $(".coc").click(function(){
                   window.location.href="cart.php";             
                });
                
                $('.close_btn').click(function(){
                        $('.trans_bg').hide();
                        $('.rar_popup').hide();
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
                 <div class='merror' style="display:none;"></div>
                <?php 
                    $project_id=mysqli_real_escape_string($con,trim(addslashes($_GET['project_id'])));
// this checks if project is purchased
                    $result=mysqli_query($con,"select projects.user_id as au_id,profiles.user_name,project_accounts.buy_from as bu_id,transactions.user_id as tu_id from projects,profiles,project_accounts,transactions where transactions.transaction_id=project_accounts.transaction_id and profiles.user_id=project_accounts.buy_from and projects.project_id=project_accounts.project_id and (transactions.user_id=$login_session or projects.user_id=$login_session) and projects.project_id=$project_id");
                    
                    if($row=mysqli_fetch_assoc($result)){
//                        echo'<script>alert(\'if\');</script>';
                        $buy_from_id=$row['bu_id'];
                        $projecter_id=$row['au_id'];
                        $buyer_id=$row['tu_id'];
                        $user_name=$row['user_name'];    
                    }
                    else{
//                        echo'<script>alert(\'else\');</script>';
                        $result=mysqli_query($con,"select projects.user_id as au_id,profiles.user_name from projects,profiles where project_id=$project_id and projects.user_id=profiles.user_id ");
                        $row=mysqli_fetch_assoc($result);
                        $buy_from_id=0;
                        $projecter_id=$row['au_id'];
                        $buyer_id=0;
                        $user_name=$row['user_name']; 
                    }

                    if($row){
//                        echo'<script>alert(\'if -row\');</script>';
                        $project_result=mysqli_query($con,"SELECT bounty,title,description,date_time from projects where projects.project_id=$project_id");
                        $project_row=mysqli_fetch_assoc($project_result);
                        $description=nl2br($project_row['description']);
                        $bounty=$project_row['bounty'];
                        $title=$project_row['title'];
                        
                        if($login_session==$buyer_id)
                        {
                            // changed here
//                            echo'<script>alert(\'if -row-if\');</script>';
                            $date_result=mysqli_query($con,"SELECT transactions.date_time,profiles.user_name,project_accounts.rating,project_accounts.review from transactions,projects,project_accounts,profiles where project_accounts.project_id=$project_id and project_accounts.project_id=projects.project_id and transactions.transaction_id=project_accounts.transaction_id and profiles.user_id=transactions.user_id and project_accounts.buy_from=projects.user_id");
                            $date_row=mysqli_fetch_assoc($date_result);
                            $parenttime = $date_row['date_time'];
                            $timestamp=strtotime($parenttime);
                            $get_date = date('j-n-Y',$timestamp);
                            $get_time = date('H:i',$timestamp);
                            $rating=$date_row['rating'];
                            $review=nl2br($date_row['review']);
                            
                            
                            
                            
                            switch($rating){
                                case 0:
                                    $rating='F';
                                    break;
                                case 1:
                                    $rating='D';
                                    break;
                                case 2:
                                    $rating='C';
                                    break;
                                case 3:
                                    $rating='B';
                                    break;
                                case 4:
                                    $rating='A';
                                    break;
                                case 5:
                                    $rating='A+';
                                    break;
                                default:
                                    break;
                            }
                            

                            echo'
                            
                            <div style="width:80%; min-height:150px; background-color:#3BBA61; margin: 2% auto;">
                                <div style="padding:1%;">
                                    <h3> Posted By: <a href="view_profile.php?user_id='.$buy_from_id.'">'.$user_name.' </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                    Date: '.$get_date.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                    Time- '.$get_time.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    Bounty: $'.$bounty.' </h3><img  class="image_class" src="image.php?user_id='.$projecter_id.'" style="float:left; border-radius:50px; width:100px; height:100px;"/>
                                    <div>
                                        <div style="background-image: url(./images/beeper_left.png); height: 23px; top: 20px; width: 12px; position: relative; left: 10%;">
                                        </div>
                                        <div style="width:87%; padding-left:1%; margin-left:11%; background-color:whitesmoke; word-break:break-all; ">
                                            Title:<p style="color:#3bb998;">'.$title.'</p><br/>
                                            Description:
                                            <p>'.$description.'</p>
                                        </div>
                                        <div style="width:88%;  margin-left:11%; background-color:whitesmoke; word-break:break-all; margin-top:2%;">
                                        
                                   

                            ';
                            
                            if($project_file_result=mysqli_query($con,"SELECT * from project_file where project_id=$project_id")){
                               while($project_file_row=mysqli_fetch_assoc($project_file_result)){
                                     $file_name=$project_file_row['file_name'];
                                     $file_text = strrchr($file_name, ".");
                                     $back_end_name=$project_file_row['file_no'].$file_text;

                                     echo'
                                        <img src="./images/download.png"/ style="width:19px; height:18px;">
                                        <a href="./../uploads/projects_files/'.$back_end_name.'">'.$file_name.'</a><br/>

                                     ';
                                } 
                            }
                                
                            
                            echo'
                                </div>
                                 </div>
                                ';

                             if(!isset($date_row['review']) || !isset($date_row['rating'])){
                                echo '<input  class="rar" type="button" value="Rate & Review" style="margin:2%;">
                                     
                                     <input  class="rfia" type="button" value="Request for Inappropriate project" style="margin:2%">
                                    </div>
                                </div>
                                 <div class="rar_popup">
                                    <span class="close_btn" style="margin-left:98%;"><img   style="margin-top:-1%;cursor:pointer;" src="./images/cross.png"></span>
                                     <div style="margin:2%;">
                                         <form>
                                            <input type="radio" name="rating" value="5">A+ &nbsp;&nbsp;<input type="radio" name="rating" value="4">A &nbsp;&nbsp;<input type="radio" name="rating" value="3">B &nbsp;&nbsp;<input type="radio" name="rating" value="2">C &nbsp;&nbsp; <input type="radio" name="rating" value="1">D &nbsp;&nbsp;<input type="radio" name="rating" value="0">E<br/>
                                            <textarea class="review_area" style="width: 90%;height:150px; margin-top:1px; word-break=break-all;resize:none;" placeholder="Write your review here ...."></textarea><br/>
                                            <input type="button" value="Submit" class="button">
                                         </form>
                                     </div>
                                 </div>
                                
                                 <script>
                                    $(".button").click(function(){
                                         rate=$("input[name=\"rating\"]:radio:checked").val();
                                         review=$(".review_area").val();
                                       if(!(rate=="" || review=="")){
                                            $.ajax({
                                            url:"query.php",
                                            data:{rate:rate,review:review,project_id:'.$project_id.',uid:'.$login_session.',buy_from:'.$projecter_id.',type:28},
                                            type:"POST",
                                            datatype:"text"
                                            }).done(function(data){
                                                if($.trim(data)=="1"){
                                                    alert("Your review submitted successfully ");
                                                    $(".rar_popup").slideUp("easeOut");
                                                    $(".rar").hide();
                                                    window.location.href="view_project.php?project_id='.$project_id.'";

                                                }
                                                else{
                                                    alert("Something went wrong !!");
                                                }
                                            });
                                        }
                                        else{
                                           alert("Please select rating and write review");
                                        }
                                    });
                                 </script>

                                ';

                            }
                            else{
                                 echo '
                                      <input  class="rfia" type="button" value="Request for Inappropriate project" style="margin:2%">
                                    </div>
                                </div>
                                 
                                
                                ';
                            }
                            
                             echo"
                                <div class='rar_view' style='width:80%; margin:auto; margin-top:2%;'>
                                
                                </div>
                                <script>
                                
                                    $(document).ready(function(){
                                        var count=0;
                                        var i=1;
                                        $('.nav-button').click(function(){
                                            var data=$.trim($(this).val());
                                            if(data=='<'){
                                                i=i-1;
                                                if(i==1){
                                                    $('.pagecount').text(parseInt(i));
                                                    $('.nav_left').hide();
                                                    count=count-10;
                                                    loaddata(count);
                                                    $('.nav_right').show();
                                                }
                                                else{
                                                    $('.nav_left').show();
                                                    $('.nav_right').show();
                                                    $('.pagecount').text(parseInt(i));
                                                    count=count-10;
                                                    loaddata(count);
                                                }
                                            }
                                            else if(data=='>'){
                                                i=i+1;
                                                if(i==total){
                                                    $('.pagecount').text(parseInt(i));
                                                    count=count+10;
                                                    loaddata(count);
                                                    $('.nav_left').show();
                                                    $('.nav_right').hide();

                                                }
                                                else{
                                                    $('.pagecount').text(parseInt(i));
                                                    count=count+10;
                                                    loaddata(count);
                                                    $('.nav_left').show();
                                                }
                                            }    
                                        });
                                     });

                                     function loaddata(count){
                                        
                                        $.ajax({
                                            type:'POST',
                                            url:'query.php',
                                            data:{ 
                                            type:27,
                                            count:count,
                                            project_id:$project_id
                                            }
                                        }).done(function(data){
                                            
                                            $('.rar_view').html('');
                                            var obj = jQuery.parseJSON(data);
                                            $.each(obj,function(i){
                                                var rate=parseInt(obj[i]['rating']);
                                                
                                                switch(rate){

                                                    case 0:
                                                        obj[i]['rating']='F';
                                                        break;
                                                    case 1:
                                                        obj[i]['rating']='D';
                                                        break;
                                                    case 2:
                                                        obj[i]['rating']='C';
                                                        break;
                                                    case 3:
                                                        obj[i]['rating']='B';
                                                        break;
                                                    case 4:
                                                        obj[i]['rating']='A';
                                                        break;
                                                    case 5:
                                                       obj[i]['rating']='A+';
                                                        break;
                                                    default:
                                                        break;
                                                }
                                                
                                            if(!isNaN(rate)){
                                                
                                                $('<div> <div style=\'float:left;\'><img class=\"image_class\" src=\''+'image.php?user_id='+obj[i]['user_id']+'\' ></img></div><div style=\'margin-left:6%; width:92%;\'><a href=\''+'view_profile.php?user_id='+obj[i]['user_id']+'\' ><p style=\'color:#3bb998; font-weight:bold;\'> '+obj[i]['user_name']+'</p></a><p>'+obj[i]['rating']+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+obj[i]['rating_date_time']+'</p><div style=\'word-break:break-all;\'><p>'+obj[i]['review']+'</p></div></div></div>').addClass('questdiv').appendTo('.rar_view');
                                                $('<div> <div style=\'float:left;\'><img class=\"image_class\" src=\''+'image.php?user_id='+obj[i]['user_id']+'\' ></img></div><div style=\'margin-left:60px; width:80%;\'><a href=\''+'view_profile.php?user_id='+obj[i]['user_id']+'\' ><p style=\'color:#3bb998;font-weight:bold;\'> '+obj[i]['user_name']+'</p></a><p style=\'font-size:12px;\'>'+obj[i]['rating']+'&nbsp;&nbsp;&nbsp;&nbsp;'+obj[i]['rating_date_time']+'</p><div style=\'word-break:break-all;\'><p>'+obj[i]['review']+'</p></div></div></div>').addClass('questdiv').appendTo('.mrar_view');    
                                            }
                                            
                                            
                                            });
                                        });


                                    }
                                </script>
                            ";
                            
                            include './include/connection.php';
                                $result=mysqli_query($con,"select count(rating) as total from project_accounts where project_accounts.project_id=$project_id");
                                $row_count=mysqli_fetch_array($result);
                                $total=ceil($row_count['total']/10);
                                if($total==0)
                                    $count=0;
                                else
                                    $count=1;
                                echo "<script> var total=$total;
                                        
                                        </script>";
                                
                                echo '

                                     <div class="navigate" style="width:10%; height:25px; margin-top:1%; display:none; margin-left:10%;">
                                        <input class="nav-button nav_left" data="back" type="button" value="<" style="height:100%; width:50px; display:none; font-size:120%;">
                                        <span style="background-color:whitesmoke;"><span class="pagecount">'.$count.'</span>/ '.$total.'</span>
                                        <input class="nav-button nav_right" data="next" type="button" value=">" style="height:100%; width:50px; font-size:120%;">
                                    </div>

                                    <script>
                                        if(total>1)
                                            $(\'.navigate\').show();
                                    </script>

                                ';  
                            
                        }

                        else if($login_session==$projecter_id)
                        {
//                            echo'<script>alert(\'if -row-else-if\');</script>';
                            $parenttime = $project_row['date_time'];
                            $timestamp=strtotime($parenttime);
                            $get_date = date('j-n-Y',$timestamp);
                            $get_time = date('H:i',$timestamp);
                            echo'
                            <div style="width:80%; min-height:150px; background-color:#3BBA61; margin: 2% auto;">
                                <div style="padding:1%;">
                                    <h3>Date: '.$get_date.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                    Time- '.$get_time.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    Bounty: $'.$bounty.' </h3>
                                    <img class="image_class" src="image.php?user_id='.$projecter_id.'"  style="float:left; width:100px; border-radius:50px; height:100px;"/>
                                       <div>
                                           <div style=" background-image: url(./images/beeper_left.png); height: 23px; top:20px; width:12px; position:relative; left:10%;">
                                            </div>
                                            <div style="width:87%; background-color:whitesmoke; padding-left:1%; margin-left:11%; word-break:break-all;">
                                                Title:<p style="color:#3bb998;">'.$title.'</p><br/>
                                                Description:
                                                <p>'.$description.'</p>
                                            </div>
                                           <div style="width:88%;  margin-left:11%; background-color:whitesmoke; word-break:break-all; margin-top:2%;">
                                        
                                   

                            ';
                            if($project_file_result=mysqli_query($con,"SELECT * from project_file where project_id=$project_id")){
                                while($project_file_row=mysqli_fetch_assoc($project_file_result)){
                                     $file_name=$project_file_row['file_name'];
                                     $file_text = strrchr($file_name, ".");
                                     $back_end_name=$project_file_row['file_no'].$file_text;

                                     echo'
                                        <img src="./images/download.png"/ style="width:19px; height:18px;">
                                        <a href="./../uploads/projects_files/'.$back_end_name.'">'.$file_name.'</a><br/>

                                     ';
                                }
                            }
                            echo'
                                </div>
                                 </div>
                                
                            </div>
                            </div>
                             <div class="rar_view" style="width:80%; margin:auto; margin-top:2%; ">
                                
                            </div>
                            ';
                            echo"
                                    <script>
                                        $(document).ready(function(){
                                            var count=0;
                                            var i=1;
                                            $('.nav-button').click(function(){
                                                var data=$.trim($(this).val());
                                                if(data=='<'){
                                                    i=i-1;
                                                    if(i==1){
                                                        $('.pagecount').text(parseInt(i));
                                                        $('.nav_left').hide();
                                                        count=count-10;
                                                        loaddata(count);
                                                        $('.nav_right').show();
                                                    }
                                                    else{
                                                        $('.nav_left').show();
                                                        $('.nav_right').show();
                                                        $('.pagecount').text(parseInt(i));
                                                        count=count-10;
                                                        loaddata(count);
                                                    }
                                                }
                                                else if(data=='>'){
                                                    i=i+1;
                                                    if(i==total){
                                                        $('.pagecount').text(parseInt(i));
                                                        count=count+10;
                                                        loaddata(count);
                                                        $('.nav_left').show();
                                                        $('.nav_right').hide();

                                                    }
                                                    else{
                                                        $('.pagecount').text(parseInt(i));
                                                        count=count+10;
                                                        loaddata(count);
                                                        $('.nav_left').show();
                                                    }
                                                }    
                                            });
                                         });

                                         function loaddata(count){

                                            $.ajax({
                                                type:'POST',
                                                url:'query.php',
                                                data:{ 
                                                type:27,
                                                count:count,
                                                project_id:$project_id
                                                }
                                            }).done(function(data){
                                                
                                                $('.rar_view').html('');
                                                var obj = jQuery.parseJSON(data);
                                                $.each(obj,function(i){
                                                    var rate=parseInt(obj[i]['rating']);
                                                    switch(rate){
                                                    
                                                        case 0:
                                                            obj[i]['rating']='F';
                                                            break;
                                                        case 1:
                                                            obj[i]['rating']='D';
                                                            break;
                                                        case 2:
                                                            obj[i]['rating']='C';
                                                            break;
                                                        case 3:
                                                            obj[i]['rating']='B';
                                                            break;
                                                        case 4:
                                                            obj[i]['rating']='A';
                                                            break;
                                                        case 5:
                                                           obj[i]['rating']='A+';
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                if(!isNaN(rate)){
                                                     $('<div> <div style=\'float:left;\'><img class=\"image_class\" src=\''+'image.php?user_id='+obj[i]['user_id']+'\' ></img></div><div style=\'margin-left:6%; width:92%;\'><a href=\''+'view_profile.php?user_id='+obj[i]['user_id']+'\' ><p style=\'color:#3bb998; font-weight:bold;\'> '+obj[i]['user_name']+'</p></a><p >'+obj[i]['rating']+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+obj[i]['rating_date_time']+'</p><div style=\'word-break:break-all;\'><p>'+obj[i]['review']+'</p></div></div></div>').addClass('questdiv').appendTo('.rar_view');
                                                     $('<div> <div style=\'float:left;\'><img class=\"image_class\" src=\''+'image.php?user_id='+obj[i]['user_id']+'\' ></img></div><div style=\'margin-left:60px; width:80%;\'><a href=\''+'view_profile.php?user_id='+obj[i]['user_id']+'\' ><p style=\'color:#3bb998;font-weight:bold;\'> '+obj[i]['user_name']+'</p></a><p style=\'font-size:12px;\'>'+obj[i]['rating']+'&nbsp;&nbsp;&nbsp;&nbsp;'+obj[i]['rating_date_time']+'</p><div style=\'word-break:break-all;\'><p>'+obj[i]['review']+'</p></div></div></div>').addClass('questdiv').appendTo('.mrar_view');

                                                }
                                                    
                                                        
                                                });
                                            });
                                            

                                        }
                                    </script>
                                ";
                                include './include/connection.php';
                                    $result=mysqli_query($con,"select count(rating) as total from project_accounts where project_accounts.project_id=$project_id");
                                    $row_count=mysqli_fetch_array($result);
                                    $total=ceil($row_count['total']/10);
                                    if($total==0)
                                        $count=0;
                                    else
                                        $count=1;
                                    echo "<script> var total=$total;
                                            
                                            
                                            </script>";
                                    mysqli_close($con);
                                    echo '
                                        
                                         <div class="navigate" style="width:10%; height:25px; margin-top:1%; display:none; margin-left:10%;">
                                            <input class="nav-button nav_left" data="back" type="button" value="<" style="height:100%; width:50px; display:none; font-size:120%;">
                                            <span style="background-color:whitesmoke;"><span class="pagecount">'.$count.'</span>/ '.$total.'</span>
                                            <input class="nav-button nav_right" data="next" type="button" value=">" style="height:100%; width:50px; font-size:120%;">
                                        </div>

                                        <script>
                                            if(total>1)
                                                $(\'.navigate\').show();
                                        </script>

                                    ';
                            
                        }
                       
                    
                    else{
                         $project_result=mysqli_query($con,"SELECT user_id as au_id,bounty,title,description,date_time from projects where projects.project_id=$project_id;");
                            
                            if($project_row=mysqli_fetch_assoc($project_result))
                            {
                                
                                $bounty=$project_row['bounty'];
                                $projecter_id=$project_row['au_id'];
                                
                                $parenttime = $project_row['date_time'];
                                $timestamp=strtotime($parenttime);
                                $get_date = date('j-n-Y',$timestamp);
                                $get_time = date('H:i',$timestamp);
                                $title=$project_row['title'];
                                $description=nl2br($project_row['description']);
                                $length=strlen($description);
                                $description=substr($description,$length/6,$length/8);
                                $user_name_result=mysqli_query($con,"SELECT profiles.user_name from profiles where profiles.user_id=$projecter_id;");
                                $user_name_row=mysqli_fetch_assoc($user_name_result);
                                $user_name=$user_name_row['user_name'];
                                echo'
                                    <div style="width:80%; min-height:150px; background-color:#3BBA61; margin: 2% auto;">
                                        <div style="padding:1%;">
                                            <h3> Posted By: <a href="view_profile.php?user_id='.$projecter_id.'">'.$user_name.'</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                            Date: '.$get_date.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                            Time- '.$get_time.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            Bounty: $'.$bounty.' </h3>
                                            <img class="image_class" src="image.php?user_id='.$projecter_id.'" width=100px height=100px style="float:left; border-radius:50px;">
                                            <div>
                                                <div style=" background-image: url(./images/beeper_left.png); height: 23px; top: 20px; width: 12px; position: relative; left: 10%;"/>
                                                </div>
                                                <div style="width:87%; padding-left:1%; margin-left:11%; background-color:whitesmoke;  word-break:break-all;">
                                                    Title:
                                                    <p style="color:#3bb998;">'.$title.'</p></br>
                                                    Description:
                                                    <p title="Full Description On Purchase">...'.$description.'...</p>
                                                </div>
                                            </div>
                                        </div>
                                ';
                                
                                $project_cart_result=mysqli_query($con,"SELECT project_carts.user_id, project_carts.project_id from project_carts where project_carts.user_id=$login_session and project_carts.project_id=$project_id ");
                                $project_cart_row=mysqli_fetch_assoc($project_cart_result);
                                
                                if(!isset($project_cart_row)){
                                    echo'
                                     <input class="atc" type="button" data ='.$project_id.' value="Add To cart" style="margin:2%;">   
                                     ';
                                }
                                else{
                                    echo'
                                    <input class="coc" type="button" data ='.$project_id.' value="Checkout cart" style="margin:2%;">
                                    ';
                                }
                                  echo'  
                                    </div>
                                    <div class="rar_view" style="width:80%; margin:auto; margin-top:2%;">
                                            
                                    </div>
                                ';
                                
                                echo"
                                    <script>
                                        $(document).ready(function(){
                                            var count=0;
                                            var i=1;
                                            $('.nav-button').click(function(){
                                                var data=$.trim($(this).val());
                                                if(data=='<'){
                                                    i=i-1;
                                                    if(i==1){
                                                        $('.pagecount').text(parseInt(i));
                                                        $('.nav_left').hide();
                                                        count=count-10;
                                                        loaddata(count);
                                                        $('.nav_right').show();
                                                    }
                                                    else{
                                                        $('.nav_left').show();
                                                        $('.nav_right').show();
                                                        $('.pagecount').text(parseInt(i));
                                                        count=count-10;
                                                        loaddata(count);
                                                    }
                                                }
                                                else if(data=='>'){
                                                    i=i+1;
                                                    if(i==total){
                                                        $('.pagecount').text(parseInt(i));
                                                        count=count+10;
                                                        loaddata(count);
                                                        $('.nav_left').show();
                                                        $('.nav_right').hide();

                                                    }
                                                    else{
                                                        $('.pagecount').text(parseInt(i));
                                                        count=count+10;
                                                        loaddata(count);
                                                        $('.nav_left').show();
                                                    }
                                                }    
                                            });
                                         });

                                         function loaddata(count){

                                            $.ajax({
                                                type:'POST',
                                                url:'query.php',
                                                data:{ 
                                                type:27,
                                                count:count,
                                                project_id:$project_id
                                                }
                                            }).done(function(data){
                                                
                                                var obj = jQuery.parseJSON(data);
                                                $('.rar_view').html('');
                                                $.each(obj,function(i){
                                                    var rate=parseInt(obj[i]['rating']);
                                                    switch(rate){
                                                    
                                                        case 0:
                                                            obj[i]['rating']='F';
                                                            break;
                                                        case 1:
                                                            obj[i]['rating']='D';
                                                            break;
                                                        case 2:
                                                            obj[i]['rating']='C';
                                                            break;
                                                        case 3:
                                                            obj[i]['rating']='B';
                                                            break;
                                                        case 4:
                                                            obj[i]['rating']='A';
                                                            break;
                                                        case 5:
                                                           obj[i]['rating']='A+';
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                    if(!isNaN(rate)){
                                                         $('<div> <div style=\'float:left;\'><img class=\"image_class\" src=\''+'image.php?user_id='+obj[i]['user_id']+'\' ></img></div><div style=\'margin-left:6%; width:92%;\'><a href=\''+'view_profile.php?user_id='+obj[i]['user_id']+'\' ><p style=\'color:#3bb998;font-weight:bold;\'> '+obj[i]['user_name']+'</p></a><p>'+obj[i]['rating']+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+obj[i]['rating_date_time']+'</p><div style=\'word-break:break-all;\'><p>'+obj[i]['review']+'</p></div></div></div>').addClass('questdiv').appendTo('.rar_view');
                                                        $('<div> <div style=\'float:left;\'><img class=\"image_class\" src=\''+'image.php?user_id='+obj[i]['user_id']+'\' ></img></div><div style=\'margin-left:60px; width:80%;\'><a href=\''+'view_profile.php?user_id='+obj[i]['user_id']+'\' ><p style=\'color:#3bb998;font-weight:bold;\'> '+obj[i]['user_name']+'</p></a><p style=\'font-size:12px;\'>'+obj[i]['rating']+'&nbsp;&nbsp;&nbsp;&nbsp;'+obj[i]['rating_date_time']+'</p><div style=\'word-break:break-all;\'><p>'+obj[i]['review']+'</p></div></div></div>').addClass('questdiv').appendTo('.mrar_view');
                                                    }
                                                    
                                                    
                                                });
                                            });

                                        }
                                    </script>
                                ";
                                include './include/connection.php';
                                    $result=mysqli_query($con,"select count(rating) as total from project_accounts where project_accounts.project_id=$project_id");
                                    $row_count=mysqli_fetch_array($result);
                                    $total=ceil($row_count['total']/10);
                                    if($total==0)
                                        $count=0;
                                    else
                                        $count=1;
                                    echo "<script> var total=$total;
                                            
                                            </script>";
                                    mysqli_close($con);
                                    echo '
                                         <div class="navigate" style="width:10%; height:25px; margin-top:1%; display:none; margin-left:10%; ">
                                            <input class="nav-button nav_left" data="back" type="button" value="<" style="height:100%; width:50px; display:none; font-size:120%;">
                                            <span style="background-color:whitesmoke;"><span class="pagecount">'.$count.'</span>/ '.$total.'</span>
                                            <input class="nav-button nav_right" data="next" type="button" value=">" style="height:100%; width:50px; font-size:120%;">
                                        </div>

                                        <script>
                                            if(total>1)
                                                $(\'.navigate\').show();
                                        </script>

                                    ';
                            }
                            else{
                                echo "
                                    <script>
                                            alert('No such project exists');
                                            window.location.href='index.php';
                                    </script>
                                ";
                            }      
                    }
                }
                else{
                    echo "
                        <script>
                                alert('No such project exists');
                                window.location.href='index.php';
                        </script>
                    ";
                } 
               ?>
                 <div class='trans_bg'></div>
            </div>
            
            </div>
            <div class="mcontent">
                 <div class='merror' style="display:none;"></div>
                <br/>
                <?php 
                   if($row){
                       
                        if($login_session==$buyer_id)
                        {    
                            echo'
                            
                            <div style="width:100%; min-height:50px; background-color:#3BBA61; margin-top:2%;">
                                <div style="padding:1%;">
                                    <img class="image_class" src="image.php?user_id='.$projecter_id.'" style="float:left; width:50px; border-radius:50px; height:50px;"/>
                                    <a href="view_profile.php?user_id='.$buy_from_id.'"><h5>&nbsp;'.$user_name.'</h5></a>
                                    <h5>&nbsp;'.$get_date.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$get_time.'</h5>
                                    <h5>&nbsp;$'.$bounty.' </h5>
                                    <div>
                                        <div style="width:98%; padding-left:1%; background-color:whitesmoke;  word-break:break-all;  margin-top:2%;">
                                            Title:<p style="color:#3bb998;">'.$title.'</p><br/>
                                            Description:
                                            <p>'.$description.'</p>
                                        </div>
                                   <div style="width:99%;  background-color:whitesmoke; word-break:break-all; margin-top:2%;">
                                        
                                   

                            ';
                            if($project_file_result=mysqli_query($con,"SELECT * from project_file where project_id=$project_id")){
                                while($project_file_row=mysqli_fetch_assoc($project_file_result)){
                                     $file_name=$project_file_row['file_name'];
                                     $file_text = strrchr($file_name, ".");
                                     $back_end_name=$project_file_row['file_no'].$file_text;

                                     echo'
                                        <img src="./images/download.png"/ style="width:19px; height:18px;">
                                        <a href="./../uploads/projects_files/'.$back_end_name.'">'.$file_name.'</a><br/>

                                     ';
                                }
                            }
                            
                            echo'
                                </div>
                                 </div>
                                ';


                           if(!isset($date_row['review']) || !isset($date_row['rating'])){
                                echo '<input  class="rar" type="button" value="Rate & Review" style="margin:2%;">
                                     
                                     <input  class="rfia" type="button" value="Request for Inappropriate project" style="margin:2%;">
                                    </div>
                                </div>
                                 <div class="rar_popup">
                                    <span class="close_btn" style="margin-left:95%;"><img  style="margin-top:-3%;cursor:pointer;" src="./images/cross.png"></span>
                                     <div style="margin:2% ;">
                                         <form >
                                            <input type="radio" name="mrating" value="5">A+ &nbsp;&nbsp;<input type="radio" name="mrating" value="4">A &nbsp;&nbsp;<input type="radio" name="mrating" value="3">B &nbsp;&nbsp;<input type="radio" name="mrating" value="2">C &nbsp;&nbsp; <input type="radio" name="mrating" value="1">D &nbsp;&nbsp;<input type="radio" name="mrating" value="0">E<br/>
                                            <textarea class="mreview_area" style="width: 90%;height: 150px;margin-top:1px; word-break=break-all;resize:none;" placeholder="Write your review here ...."></textarea><br/>
                                            <input type="button" value="Submit" class="mbutton">
                                         </form>
                                     </div>
                                 </div>
                                
                                  <script>
                                     
                                    $(".mbutton").click(function(){
                                         rate=$("input[name=\"mrating\"]:radio:checked").val();
                                         review=$(".mreview_area").val();
                                        
                                       if(!(rate=="" || review=="")){
                                            $.ajax({
                                            url:"query.php",
                                            data:{rate:rate,review:review,project_id:'.$project_id.',uid:'.$login_session.',buy_from:'.$projecter_id.',type:28},
                                            type:"POST",
                                            datatype:"text"

                                            }).done(function(data){
                                                if($.trim(data)=="1"){
                                                     $(".merror").text("Review submitted successfully ").css("background", "none repeat scroll 0 0 #1e7909").fadeIn("slow");
                                                     $("body").on("click",function(){
                                                        $(".merror").fadeOut("slow");
                                
                                                     });
                                                    $(".rar_popup").slideUp("easeOut");
                                                    $(".rar").hide();
                                                    window.location.href="view_project.php?project_id='.$project_id.'";
                                                }
                                                else{
                                                    $(".merror").text("Something went wrong !!").css("background", "none repeat scroll 0 0 #f85959").fadeIn("slow");
                                                    $("body").on("click",function(){
                                                        $(".merror").fadeOut("slow");
                                
                                                     });
                                                }
                                            });
                                        }
                                        else{
                                            $(".merror").text("Please select rating and write review ").css("background", "none repeat scroll 0 0 #f85959").fadeIn("slow");
                                            $("body").on("click",function(){
                                                $(".merror").fadeOut("slow");
                                
                                             });
                                        }
                                    });
                                       
                                        
                                 </script>

                                ';

                            }

                            else{
                                echo'
                                        <input  class="rfia" type="button" value="Request for Inappropriate project" style="margin:2%;">
                                    </div>
                                </div>
                                <div class="mrar_view" style="width:100%; margin:auto; margin-top:2%;">
                                        
                                </div>
                                ';

                            }
                            echo "<script> var total=$total;
                                            
                                            loaddata(0);
                                            </script>";
                                   
                                    echo '
                                        <div class="navigate" style="width:10%; height:25px; margin-top:1%; display:none;">
                                            <input class="nav-button nav_left" data="back" type="button" value="<" style="height:100%; width:50px; display:none; font-size:120%;">
                                            <span style="background-color:whitesmoke;"><span class="pagecount">'.$count.'</span>/ '.$total.'</span>
                                            <input class="nav-button nav_right" data="next" type="button" value=">" style="height:100%; width:50px; font-size:120%;">
                                        </div>

                                        <script>
                                            if(total>1)
                                                $(\'.navigate\').show();
                                        </script>

                                    ';
                            
                               
                            
                        }

                        else if($login_session==$projecter_id)
                        {    
                            echo'
                           <div style="width:100%; min-height:50px; background-color:#3BBA61; margin-top:2%;">
                                <div style="padding:1%;">
                                    
                                    <img class="image_class" src="image.php?user_id='.$projecter_id.'"  style="float:left; width:50px; border-radius:50px; height:50px;"/>
                                    <h5>&nbsp;'.$get_date.'</h5>
                                    <h5>&nbsp;'.$get_time.'</h5>
                                    <h5>&nbsp;$'.$bounty.' </h5>
                                    <div>
                                        <div style="width:98%; margin:auto; background-color:whitesmoke; padding-left:1%;  word-break:break-all; margin-top:2%;">
                                            Title:<p style="color:#3bb998;">'.$title.'</p><br/>
                                            Description:
                                            <p>'.$description.'</p>
                                        </div>
                                        <div style="width:99%; margin:auto; background-color:whitesmoke; word-break:break-all; margin-top:2%;">
                                        
                                   

                            ';
                            include './include/connection.php';
                            if($project_file_result=mysqli_query($con,"SELECT * from project_file where project_id=$project_id")){
                                while($project_file_row=mysqli_fetch_assoc($project_file_result)){
                                     $file_name=$project_file_row['file_name'];
                                     $file_text = strrchr($file_name, ".");
                                     $back_end_name=$project_file_row['file_no'].$file_text;

                                     echo'
                                        <img src="./images/download.png"/ style="width:19px; height:18px;">
                                        <a href="./../uploads/projects_files/'.$back_end_name.'">'.$file_name.'</a><br/>

                                     ';
                                }
                            }
                            
                            echo'
                                        </div>
                                     </div>
                                </div>
                            </div>
                            <div class="mrar_view" style="width:100%; margin:auto; margin-top:2%; ">
                                
                            </div>
                            
                            ';
                            
                                
                                    echo "<script> var total=$total;
                                            
                                            loaddata(0);
                                            </script>";
                                   
                                    echo '
                                        <div class="navigate" style="width:10%; height:25px; margin-top:1%; display:none;">
                                            <input class="nav-button nav_left" data="back" type="button" value="<" style="height:100%; width:50px; display:none; font-size:120%;">
                                            <span style="background-color:whitesmoke;"><span class="pagecount">'.$count.'</span>/ '.$total.'</span>
                                            <input class="nav-button nav_right" data="next" type="button" value=">" style="height:100%; width:50px; font-size:120%;">
                                        </div>

                                        <script>
                                            if(total>1)
                                                $(\'.navigate\').show();
                                        </script>

                                    ';
                            
                        }
                       
                    
                    else{
                         
                         if($project_row)
                            {
                               
                                echo'
                                    <div style="width:100%; min-height:50px; background-color:#3BBA61; margin-top:2%;">
                                        <div style="padding:1%;">
                                            
                                            <img class="image_class" src="image.php?user_id='.$projecter_id.'" width=50px height=50px style="float:left;border-radius:50px;">
                                            <a href="view_profile.php?user_id='.$projecter_id.'"><h5>&nbsp; '.$user_name.'</h5></a>
                                            <h5>&nbsp; '.$get_date.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$get_time.'</h5>
                                            <h5>&nbsp; $'.$bounty.' </h5>
                                            <div>
                                                <div style="width:98%; margin:auto; padding-left:1%; background-color:whitesmoke;  word-break:break-all; margin-top:2%;">
                                                    Title:
                                                    <p style="color:#3bb998;">'.$title.'</p><br/>
                                                    Description:
                                                   <p title="Full Description On Purchase">...'.$description.'...</p>
                                                </div>
                                            </div>
                                        </div>
                                    
                                  ';
                            
                                
                                if(!isset($project_cart_row)){
                                    echo'
                                     <input class="atc" type="button" data ='.$project_id.' value="Add To cart" style="margin:2%;">   
                                     ';
                                }
                                else{
                                    echo'
                                    <input class="coc" type="button" data ='.$project_id.' value="Checkout cart" style="margin:2%;">
                                    ';
                                }
                                  echo'  
                                    </div>
                                    <div class="mrar_view" style="width:100%; margin:auto; margin-top:2%;">
                                            
                                    </div>
                                ';
                                
                        
                                
                                    
                                    echo "<script> var total=$total;
                                            loaddata(0);
                                            </script>";
                                    
                                    echo '
                                         <div class="navigate" style="width:10%; height:25px; margin-top:1%; display:none;">
                                            <input class="nav-button nav_left" data="back" type="button" value="<" style="height:100%; width:50px; display:none; font-size:120%;">
                                            <span style="background-color:whitesmoke;"><span class="pagecount">'.$count.'</span>/ '.$total.'</span>
                                            <input class="nav-button nav_right" data="next" type="button" value=">" style="height:100%; width:50px; font-size:120%;">
                                        </div>

                                        <script>
                                            if(total>1)
                                                $(\'.navigate\').show();
                                        </script>

                                    ';
                                }
                            else{
                                echo "
                                    <script>
                                        
                                        window.location.href='index.php';
                                    </script>
                                ";
                            }      
                    }
                }
                else{
                    echo "
                        <script>
                            
                            window.location.href='index.php';
                        </script>
                    ";
                } 
               ?>


             <div class='trans_bg'></div>   
            </div>
        </div>
        <?php
            include_once './include/footer.php';
        ?>
    </body>
</html>		