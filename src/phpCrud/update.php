<?php
  include 'connect.php';
  $id = $_GET['updateid'];
  $sql="Select * from `interviewly` where id = $id";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $int_email=$row['int_email'];
    $can_email=$row['can_email'];
    $start_date=$row['start_date'];
    $end_date=$row['end_date'];
    $resume=$row['resume'];
    $remarks=$row['remarks'];

  if(isset($_POST['submit'])){
    
    $int_email=$_POST['int_email'];
    $can_email=$_POST['can_email'];
    $remarks=$_POST['remarks'];
    $resume=$_POST['resume'];
    $compare_start_date= $_POST['start_date'];
    $compare_end_date= $_POST['end_date'];
    $currentDateTime = date('Y-m-d H:i:s');
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
    if($rowcount1>1 || $rowcount2>1 || $rowcount3>1){
      echo '<script>alert("The Interveiwer has an simoultaneous Interview!")</script>';
    }
    else if($rowcount5>1 || $rowcount4>1 || $rowcount6>1){
      echo '<script>alert("The Candidate has an simoultaneous Interview!")</script>';
    }
    else{
      if($compare_start_date<$compare_end_date){
          if($currentDateTime < $compare_start_date){
            $sql="update `interviewly` set id = $id,int_email='$int_email',can_email='$can_email',
          start_date='$start_date',end_date='$end_date' ,resume='$resume' ,remarks = '$remarks' where id = $id";
    
            $result = mysqli_query($con,$sql);
            if($result){
              header('location: ../pages/editInterviews.php');
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   <title>Interviewly : An Interview Creation Portal</title>
  </head>
  <body>
    <div class="container my-5">
    
            <form method = "POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Interviewer E-mail</label>
            <input type="email" name="int_email" class="form-control" id="interviewerInputEmail1" autocomplete="off" placeholder="Enter email" value ="<?php echo $int_email;?>">
            
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Candidate E-mail</label>
            <input type="email" name="can_email" class="form-control" id="candidateInputEmail1"  autocomplete="off" placeholder="Enter email"value ="<?php echo $can_email;?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Start Date and Time</label>
            <input type="datetime-local" name="start_date" class="form-control" id="inputStartDate" autocomplete="off" value ="<?php echo $start_date;?>" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">End Date and Time</label>
            <input type="datetime-local" name="end_date" class="form-control" id="inputEndDate" autocomplete="off" value ="<?php echo $end_date;?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Resume Link of Candidate</label>
            <input type="text" class="form-control" name="resume" id="inputRemarks" autocomplete="off" placeholder="Enter the links for resume (Drive / Dropbox  etc)">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Remarks for the Interview</label>
            <input type="text" class="form-control" name="remarks" id="inputRemarks" autocomplete="off" placeholder="Enter the Remarks" value ="<?php echo $remarks;?>">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
        <button type="submit" class="btn btn-danger" name="Cancel"><a class ="text-light" href ="editInterviews.php">Cancel</a></button>
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