<?php
  include '../phpCrud/connect.php';
  if(isset($_POST['submit'])){
    
    $int_email=$_POST['int_email'];
    $can_email=$_POST['can_email'];
    $remarks=$_POST['remarks'];
    $compare_start_date= $_POST['start_date'];
    $compare_end_date= $_POST['end_date'];
    $currentDateTime = date('Y-m-d H:i:s');
    $resume = $_POST['resume'];
    $start_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $_POST['start_date'])));
    $end_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $_POST['end_date'])));
   
    //Queries to match that the Interviewer has no simoultaneous interview
    $sql1 = "Select * from `interviewly` where int_email = '$int_email' and start_date <='$start_date' and end_date>='$start_date'" ;
    $sql2= "Select * from `interviewly` where int_email = '$int_email' and start_date <='$end_date' and end_date>='$end_date'" ;
    $sql3= "Select * from `interviewly` where int_email = '$int_email' and start_date >='$start_date' and end_date<='$end_date'" ;
    //Queries to match that the Candidate has no simoultaneous interview
    $sql4 = "Select * from `interviewly` where can_email = '$can_email' and start_date <='$start_date' and end_date>='$start_date'" ;
    $sql5 = "Select * from `interviewly` where can_email = '$can_email' and start_date <='$end_date' and end_date>='$end_date'" ;
    $sql6= "Select * from `interviewly` where can_email = '$can_email' and start_date >='$start_date' and end_date<='$end_date'" ;
    
    $result1 = mysqli_query($con,$sql1);
    $result2 = mysqli_query($con,$sql2);
    $result3 = mysqli_query($con,$sql3);
    $result4 = mysqli_query($con,$sql4);
    $result5 = mysqli_query($con,$sql5);
    $result6 = mysqli_query($con,$sql6);
    $rowcount1=mysqli_num_rows($result1);
    $rowcount2=mysqli_num_rows($result2);
    $rowcount3=mysqli_num_rows($result3);
    $rowcount4=mysqli_num_rows($result4);
    $rowcount5=mysqli_num_rows($result5);
    $rowcount6=mysqli_num_rows($result6);
    //If any simoultaneous interview , Give an alert.
    if($rowcount1>0 || $rowcount2>0 || $rowcount3>0){
      echo '<script>alert("The Interveiwer has an simoultaneous Interview!")</script>';
    }
    else if($rowcount5>0 || $rowcount4>0 || $rowcount6>0){
      echo '<script>alert("The Candidate has an simoultaneous Interview!")</script>';
    }
    else{
      //Date requirements checker ie, start_date > current_date , end_date > start_date etc
      if($compare_start_date<$compare_end_date){
        if($currentDateTime < $compare_start_date){
          $sql="insert into `interviewly` (int_email,can_email,start_date,end_date,resume,remarks) values('$int_email','$can_email','$start_date','$end_date','$resume','$remarks')";
          $result = mysqli_query($con,$sql);
          if($result){
            echo "<script type='text/javascript'>document.location.href='editInterviews.php';</script>";
          }
        }
        else{
          echo '<script>alert("Start time is before Current time ! Are you a time traveller ?!")</script>';
        } 
      }
      else{
        echo '<script>alert("Start time is before end time ! Are you a time traveller ?!")</script>';
  
      }
    }
    
    
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags for Bootstrap -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">

    <title>Interviewly : An Interview Creation Portal</title>
  </head>
  <body>
  <div class="topnav">
    <a class="active" href="user.php">Create New Interview</a>
    <a href="editInterviews.php">Modify An Interview</a>
    <a href="upcomingInterviews.php">View Upcoming Interviews</a>
  </div>
    <div class="container my-5">
    
        <form method = "POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Intervewer E-mail</label>
            <input type="email" name="int_email" class="form-control" id="interviewerInputEmail1" autocomplete="off" placeholder="Enter email">
            
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Candidate E-mail</label>
            <input type="email" name="can_email" class="form-control" id="candidateInputEmail1"  autocomplete="off" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Start Date and Time</label>
            <input type="datetime-local" name="start_date" class="form-control" id="inputStartDate" autocomplete="off"  >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">End Date and Time</label>
            <input type="datetime-local" name="end_date" class="form-control" id="inputEndDate" autocomplete="off" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Resume Link of Candidate</label>
            <input type="text" class="form-control" name="resume" id="inputRemarks" autocomplete="off" placeholder="Enter the links for resume (Drive / Dropbox  etc)">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Remarks for the Interview</label>
            <input type="text" class="form-control" name="remarks" id="inputRemarks" autocomplete="off" placeholder="Enter the Remarks">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>

         <!--Logout Buttons-->
        <div class="d-flex justify-content-center"> 
          <div class="p-2"><button type="submit" class="btn btn-danger my-5" id="logout"><a class ="text-light" href="../../index.php">Logout</a>
          </button>
          </div >  
        </div>
    </div>
  </body>
</html>