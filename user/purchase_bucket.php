<?php 
	include_once './include/lock_normal.php';
?>


<!DOCTYPE html>
<html>
<head>
        <link rel="shortcut icon" href="./images/logo.png">
        <title>Purchase Bucket</title>
        <?php
            include_once './include/head.php';
        ?>

        <style>
        </style>

        <script>
            $(document).ready(function(){
                
                $('form').submit(function(event){
                    if($(this).children('#select_type').val()=='Select Type'){
                        alert('Please select type');
                        $(this).children('#select_type').focus();
                        event.preventDefault();
                    }

                });

                /*
                $('form').submit(function(){
                   if($("#select_type").val()=="Select Type"){
                     alert("Please Select Type");
                    $("#select_type").focus();
                   } 
                    else{
                        $('form').submit();

                    }


                });
                */
        });

        </script>
    </head>
    <body>
        <?php
            include_once './include/menu.php';
        ?>
        <div class="body">
            <div class="content">
                <div style="width:76%; margin:0 10%; padding:2%; margin-top:5%; background-color:white; opacity:0.8;">
                     <h1>Purchase Bucket</h1>
                    <div style="width:300px; margin:0 auto;">
                        <form method="post">
                            <select id="select_type" name="type" autofocus>
                                <option>Select Type</option>
                                <option value="Answer">Answer</option>
                                <option value="Project">Project</option>
                            </select>
                            <input id="submit" type="submit" value="Submit">
                        </form>
                        
                    </div>
                    <div>
            <?php
                if(isset($_POST['type'])){
                    $type=$_POST['type'];
                    if($type=="Project"){
                        echo "
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
                                        type:19,
                                        count:count
                                        }
                                    }).done(function(data){
                                        $('tbody').html('');
                                        var obj = jQuery.parseJSON(data);
                                        $.each(obj,function(i){
                                            if(obj[i]['title'].length>70)
                                                 obj[i]['title']=obj[i]['title'].substring(0,69)+' ...';
                                                 
                                            if(i%2==0)
                                                $(\"<tr onclick='referto(\"+obj[i]['project_id']+\");' data=\"+obj[i]['project_id']+\" style=' cursor:pointer; height: 25px; background-color:#3bb998; border-bottom:1px solid grey;'><td>\"+obj[i]['project_id']+\"</td><td>\"+obj[i]['title']+\"</td></tr>\").appendTo('tbody');
                                            else
                                                $(\"<tr onclick='referto(\"+obj[i]['project_id']+\");' data=\"+obj[i]['project_id']+\" style=' cursor:pointer; height: 25px; background-color:#399bb8;'><td>\"+obj[i]['project_id']+\"</td><td>\"+obj[i]['title']+\"</td></tr>\").appendTo('tbody');
                                        });


                                    });

                                }

                                function referto(link){
                                    window.location.href='view_project.php?project_id='+link;
                                }
                            </script>
                        ";
                        echo '
                            <div style="border-top-left-radius:10px; border-top-right-radius:10px; margin-top:1%; overflow:hidden;">
                                <table  style=" border-collapse:collapse; width:100%;">
                                    <thead class="tablehead">
                                        <tr style="background-color:#4695c0; color:white; height: 35px; "><th>Project Id</th><th style="width:65%">Title</th></tr>
                                    </thead>
                                    <tbody id="tbody">
                                ';
                        include './include/connection.php';
                        $result=mysqli_query($con,'select count(*) as total from project_accounts, transactions where transactions.transaction_id=project_accounts.transaction_id and transactions.user_id='.$login_session);
                        $row=mysqli_fetch_array($result);
                        $total=ceil($row['total']/10);
                        if($total==0)
                            $count=0;
                        else
                            $count=1;
                        echo "<script> var total=$total;
                                    
                                </script>";
                        mysqli_close($con);
                        echo '
                                    </tbody>
                                </table>
                                <div id="navigate" style="width:100%; height:35px; margin-top:1%; display:none; ">
                                    <input class="nav-button nav_left" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; display:none; font-size:120%;">
                                    <span><span class="pagecount">'.$count.'</span>/ '.$total.'<span>
                                    <input class="nav-button nav_right" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold font-size:120%;">
                                </div>
                            </div>
                            <script>
                                if(total>1)
                                    $(\'.navigate\').show();
                            </script>

                        ';
                    }
                    else if($type=="Answer"){
                        echo "
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
                                        type:20,
                                        count:count
                                        }
                                    }).done(function(data){
                                        $('tbody').html('');
                                        var obj = jQuery.parseJSON(data);
                                        $.each(obj,function(i){
                                            if(obj[i]['abstract'].length>70)
                                                  obj[i]['abstract']=obj[i]['abstract'].substring(0,69)+' ...';
                                            if(i%2==0)
                                                $(\"<tr onclick='referto(\"+obj[i]['answer_id']+\");' data=\"+obj[i]['answer_id']+\" style=' cursor:pointer; height: 25px; background-color:#3bb998; border-bottom:1px solid grey;'><td>\"+obj[i]['answer_id']+\"</td><td>\"+obj[i]['abstract']+\"</td></tr>\").appendTo('tbody');
                                            else
                                                $(\"<tr onclick='referto(\"+obj[i]['answer_id']+\");' data=\"+obj[i]['answer_id']+\" style=' cursor:pointer; height: 25px; background-color:#399bb8;'><td>\"+obj[i]['answer_id']+\"</td><td>\"+obj[i]['abstract']+\"</td></tr>\").appendTo('tbody');
                                        });


                                    });

                                }

                                function referto(link){
                                    window.location.href='view_answer.php?aid='+link;
                                }
                            </script>
                        ";
                        echo '
                            
                            <div style="border-top-left-radius:10px; border-top-right-radius:10px; margin-top:1%; overflow:hidden;">
                                <table  style=" border-collapse:collapse; width:100%;">
                                    <thead class="tablehead">
                                        <tr style="background-color:#4695c0; color:white; height: 35px;"><th>Answer Id</th><th style="width:65%">Abstract</th></tr>
                                    </thead>
                                    <tbody id="tbody">
                                ';
                        include './include/connection.php';
                        $result=mysqli_query($con,'select count(*) as total from answer_accounts, transactions where transactions.transaction_id=answer_accounts.transaction_id and transactions.user_id='.$login_session);
                        $row=mysqli_fetch_array($result);
                        $total=ceil($row['total']/10);
                        if($total==0)
                            $count=0;
                        else
                            $count=1;
                        echo "<script> var total=$total;
                                
                                
                                </script>";
                        mysqli_close($con);
                        echo '
                                    </tbody>
                                </table>
                                <div id="navigate" style="width:100%; height:35px; margin-top:1%; display:none; ">
                                    <input class="nav-button nav_left" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; display:none; font-size:120%;">
                                    <span><span class="pagecount">'.$count.'</span>/ '.$total.'<span>
                                    <input  class="nav-button nav_right" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
                                </div>
                            </div>
                            <script>
                                    
                                if(total>1)
                                    $(\'.navigate\').show();
                                
                                
                                    
                            </script>

                        ';

                    }

                }
            ?>
            </div>
        </div>
    </div>
            <div class="mcontent">
                <div style="width:90%; margin:0 3%; padding:2%; margin-top:5%; background-color:white; opacity:0.8;">
                    <h4>Purchase Bucket</h4>
                    <div style="width:300px; margin:0 auto;">
                        <form method="post">
                            <select id="select_type" name="type" autofocus>
                                <option>Select Type</option>
                                <option value="Answer">Answer</option>
                                <option value="Project">Project</option>
                            </select>
                            <input id="submit" type="submit" value="Submit">
                        </form>
                        
                    </div>
                    <div>
                    <?php
                        if(isset($_POST['type'])){
                            $type=$_POST['type'];
                            if($type=="Project"){
                                echo '
                                <div style="border-top-left-radius:10px; border-top-right-radius:10px; margin-top:1%; overflow:hidden;">
                                <table  style=" border-collapse:collapse; width:100%;">
                                    <thead class="tablehead">
                                        <tr style="background-color:#4695c0; color:white; height: 35px; "><th>Project Id</th><th style="width:65%">Title</th></tr>
                                    </thead>
                                    <tbody id="tbody">
                                ';
                                echo"<script>
                                            if(total==0){
                                                $('.tablehead').hide();
                                                $(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td colspan=4>No Records Found.....</td></tr>\").appendTo('tbody');
                                            }
                                            else
                                                loaddata(0);
                                    </script>
                                ";
                                echo '
                                    </tbody>
                                    </table>
                                    <div id="navigate" style="width:100%; height:35px; margin-top:1%; display:none; ">
                                        <input  class="nav-button nav_left" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; display:none; font-size:120%;">
                                        <span><span class="pagecount">'.$count.'</span>/ '.$total.'<span>
                                        <input  class="nav-button nav_right" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
                                    </div>
                                </div>
                                <script>
                                if(total>1)
                                    $(\'.navigate\').show();
                                 </script>
                            ';
                            }
                            else if($type=='Answer'){
                                 echo '
                                <div style="border-top-left-radius:10px; border-top-right-radius:10px; margin-top:1%; overflow:hidden;">
                                <table  style=" border-collapse:collapse; width:100%;">
                                    <thead class="tablehead">
                                        <tr style="background-color:#4695c0; color:white; height: 35px; "><th>Answer ID</th><th style="width:65%">Abstract</th></tr>
                                    </thead>
                                    <tbody id="tbody">
                                ';
                                echo"<script>
                                            if(total==0){
                                                $('.tablehead').hide();
                                                $(\"<tr style='  height: 25px; background-color:#b4d4f4; border-bottom:1px solid grey;'><td colspan=4>No Records Found.....</td></tr>\").appendTo('tbody');
                                                
                                            }
                                                
                                                
                                            else
                                                loaddata(0);
                                    </script>
                                ";
                                echo '
                                    </tbody>
                                    </table>
                                    <div id="navigate" style="width:100%; height:35px; margin-top:1%; display:none; ">
                                        <input class="nav-button nav_left" data="back" type="button" value="<" style="height:100%; width:50px; font-weight:bold; display:none; font-size:120%;">
                                        <span><span class="pagecount">'.$count.'</span>/ '.$total.'<span>
                                        <input class="nav-button nav_right" data="next" type="button" value=">" style="height:100%; width:50px; font-weight:bold; font-size:120%;">
                                    </div>
                                </div>
                                <script>
                                if(total>1)
                                    $(\'.navigate\').show();
                                 </script>
                            ';
                            }
                        }
                    ?>
                </div>
                </div>
                
            </div>
        </div>
        
        <?php
            include_once './include/footer.php';
        ?>
    </body>
</html>