<?php
session_start();
if(!isset($_SESSION["email"]))
{
  header("location: index.php");
}
$conn = mysqli_connect("localhost","root","","mydb");
if(!$conn)
{
    echo "Connection failed";
    die();
}

$sql = "select ID,CourseName from courses";     
$result_courses = $conn->query($sql);      

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        
        <title>iGrader</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="../css/demo.css" />
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../css/style2.css" />
        
    </head>
    <body>
        <div class="adjust_container">
            <header class="codrops-header">
                <h1>Marks</h1>
            </header>

            <section class="container">
                <div class="col-lg-offset-1 col-lg-6 margin_bottom_15">                 
                    <select class="form-control" id="dropdownCourse" name="dropdownCourse">
                        <option id="0" value="0">Select Course</option>
                        <?php while($courses = $result_courses->fetch_assoc())
                        { ?>
                            <option id="<?php echo $courses['ID'] ?>" value="<?php echo $courses['ID'] ?>"><?php echo $courses['CourseName'] ?></option>
                        <?php } ?>
                    </select>
                </div>  

        <div class="col-lg-offset-1 col-lg-6 margin_bottom_15">          
            <select class="form-control" id="dropdownStudent" name="dropdownStudent">
                <option id="" class="" value="0">Select Student</option>                        
            </select>
        </div> 

        <div class="col-md-4 col-md-offset-1 success_msg">
            <div class="alert alert-success alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a>                                     
                Successfully Updated
            </div>
        </div>
        <div class="col-lg-offset-1 row"  id="user_information">
            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Marks Area</h3>
                    </div>
                    <div class="panel-body">                        
                        <divclass="col-lg-12">
                            <div class="form-group has-success has-feedback float_left">
                                <label class="control-label col-sm-3 label_margin_5">Homework</label>
                                <div class="col-sm-6">
                                    <div class="input-group">        
                                        <input type="number" class="form-control" id="homework" />
                                        <span class="input-group-addon" id="max_homework">/ 500</span>
                                    </div>      
                                </div>
                            </div>

                            <div class="form-group has-success has-feedback float_left">
                                <label class="control-label col-sm-3 label_margin_5">Labs</label>
                                <div class="col-sm-6">
                                    <div class="input-group">        
                                        <input type="number" class="form-control" id="labs" />
                                        <span class="input-group-addon" id="max_labs">/ 500</span>
                                    </div>      
                                </div>
                            </div>

                            <div class="form-group has-success has-feedback float_left">
                                <label class="control-label col-sm-3 label_margin_5">Project</label>
                                <div class="col-sm-6">
                                    <div class="input-group">        
                                        <input type="number" class="form-control" id="project" />
                                        <span class="input-group-addon" id="max_project">/ 500</span>
                                    </div>      
                                </div>
                            </div> 

                            <div class="form-group has-success has-feedback float_left">
                                <label class="control-label col-sm-3 label_margin_5">Presentation</label>
                                <div class="col-sm-6">
                                    <div class="input-group">        
                                        <input type="number" class="form-control" id="presentation" />
                                        <span class="input-group-addon" id="max_presentation">/ 500</span>
                                    </div>      
                                </div>
                            </div>    

                            <div class="form-group has-success has-feedback float_left">
                                <label class="control-label col-sm-3 label_margin_5">Midterm</label>
                                <div class="col-sm-6">
                                    <div class="input-group">        
                                        <input type="number" class="form-control" id="midterm" />
                                        <span class="input-group-addon" id="max_midterm">/ 500</span>
                                    </div>      
                                </div>
                            </div>    

                            <div class="form-group has-success has-feedback float_left">
                                <label class="control-label col-sm-3 label_margin_5">Final</label>
                                <div class="col-sm-6">
                                    <div class="input-group">        
                                        <input type="number" class="form-control" id="final" />
                                        <span class="input-group-addon" id="max_final">/ 500</span>
                                    </div>      
                                </div>
                            </div> 

                            <div class="panel-body">
                                    <div class="col-md-offset-10 col-md-2" style="float:left;">
                                        <button type="button" class="btn btn-success save_button">Save</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <nav id="bt-menu" class="bt-menu">
                <a href="#" class="bt-menu-trigger"><span>Menu</span></a>
                <ul>
                    <li><a href="home.php"><i class="fa fa-home"></i></a>Home</li>
                    <li><a href="grade.php"><i class="fa fa-pencil"></i></a>Grade</li>
                    <li><a href="setting.php"><i class="fa fa-wrench"></i></a>Setting</li>
                    <li><a href="logout.php"><i class="fa fa-power-off"></i></a>Logout</li>                 
                </ul>
            </nav>
        </div><!-- /container -->
    </body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>      
    <script src="../js/classie.js"></script>
    <script src="../js/jquery.numeric.js"></script>
    <script src="../js/borderMenu.js"></script> 

    <script>

    var max_arr;
    var act_arr;

    $("#dropdownStudent").hide();
    $("#user_information").hide();

    $("#dropdownCourse").change(function()
    {
        $("#dropdownCourse option[value=" + 0 + "]").hide();        
        $("#dropdownStudent").show();
        var data = $("#dropdownCourse").val();

        $.ajax({                                  
            type: 'POST',
            url: 'getStudents.php',
            data: { id:data },
        }).success(function(response) {            
            var arr = response.split(";");            
            for (i = 0; i < arr.length-1; i++) {                 
                $("#dropdownStudent").append("<option value="+arr[i]+">"+arr[i]+"</option>");
            }
        }).error(function(response) {
            alert("No");
        }); 

        $.ajax({                                  
            type: 'POST',
            url: 'getMaxMarks.php',
            data: { id:data },
        }).success(function(response) {  
            max_arr = response.split("-");            
            $("#max_homework").text("/ "+max_arr[0]);
            $("#max_labs").text("/ "+max_arr[1]);
            $("#max_project").text("/ "+max_arr[2]);
            $("#max_presentation").text("/ "+max_arr[3]);
            $("#max_midterm").text("/ "+max_arr[4]);          
            $("#max_final").text("/ "+max_arr[5]);          
        }).error(function(response) {
            alert("No");
        });    

    });

    $("#dropdownStudent").change(function()
    {
        $("#dropdownStudent option[value=" + 0 + "]").hide();  
        $("#user_information").show();  
        var data = $("#dropdownStudent").val();
        
        $.ajax({                                  
            type: 'POST',
            url: 'getMarksGrade.php',
            data: { id:data },
        }).success(function(response) {  
            act_arr = response.split("-");            
            $("#homework").val(act_arr[0]);
            $("#labs").val(act_arr[1]);
            $("#project").val(act_arr[2]);
            $("#presentation").val(act_arr[3]);
            $("#midterm").val(act_arr[4]);          
            $("#final").val(act_arr[5]);          
        }).error(function(response) {
            alert("No");
        });  
    });


    $("#homework").numeric();
    $("#labs").numeric();
    $("#project").numeric();
    $("#presentation").numeric();
    $("#midterm").numeric();          
    $("#final").numeric();

    $("#homework").blur(function(){
        if(Number($("#homework").val()) > Number(max_arr[0]))
        {
            $("#homework").val(act_arr[0]);            
        }   
        else
        {
            act_arr[0] = $("#homework").val(); 
        }       
    });

    $("#labs").blur(function(){
        if(Number($("#labs").val()) > Number(max_arr[1]))
        {
            $("#labs").val(act_arr[1]);            
        }   
        else
        {
            act_arr[1] = $("#labs").val(); 
        }
    });

    $("#project").blur(function(){
        if(Number($("#project").val()) > Number(max_arr[2]))
        {
            $("#project").val(act_arr[2]);            
        }   
        else
        {
            act_arr[2] = $("#project").val(); 
        }
    });

    $("#presentation").blur(function(){
        if(Number($("#presentation").val()) > Number(max_arr[3]))
        {
            $("#presentation").val(act_arr[3]);            
        }   
        else
        {
            act_arr[3] = $("#presentation").val(); 
        }
    });

    $("#midterm").blur(function(){
        if(Number($("#midterm").val()) > Number(max_arr[4]))
        {
            $("#midterm").val(act_arr[4]);            
        }   
        else
        {
            act_arr[4] = $("#midterm").val(); 
        }
    });

    $("#final").blur(function(){
        if(Number($("#final").val()) > Number(max_arr[5]))
        {
            $("#final").val(act_arr[5]);            
        }   
        else
        {
            act_arr[5] = $("#final").val(); 
        }
    });

    $(".save_button").click(function(){
        var id = $("#dropdownStudent").val();
        var hw = $("#homework").val();
        var lb = $("#labs").val();
        var pro = $("#project").val();
        var pre = $("#presentation").val();
        var mid = $("#midterm").val();          
        var fin = $("#final").val();

        $.ajax({                                  
            type: 'POST',
            url: 'storeMarks.php',
            data: { id:id,hw:hw,lb:lb,pro:pro,pre:pre,mid:mid,fin:fin },
        }).success(function(response) {  
            $(".success_msg").show();
        }).error(function(response) {
            alert("No");
        });    

    });

  </script>
</html>