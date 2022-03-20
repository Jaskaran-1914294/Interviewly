<?php
  //connecting to database
  include '../phpCrud/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="../../style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<title>Interviewly : An Interview Creation Portal</title>
<body>
    <div class="topnav">
    <a  href="user.php">Create New Interview</a>
    <a  href="editInterviews.php">Modify An Interview</a>
    <a class="active" href="upcomingInterviews.php">View Upcoming Interviews</a>
  </div>
    <table class="table table-striped my-5">
  <thead>
    <!--Making required table from database dynamically-->
    <tr>
      <th scope="col">U_ID</th>
      <th scope="col">Remarks</th>
      <th scope="col">Interviewer Email</th>
      <th scope="col">Candidate Email</th>
      <th scope="col">Start Date/Time</th>
      <th scope="col">End Date/Time</th>
      <th scope="col">Resume</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = "Select * from `interviewly` ORDER BY start_date ASC";
      $result = mysqli_query($con,$sql);
      $cnount=0;
      if($result){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $count++;
            $int_email = $row['int_email'];
            $can_email = $row['can_email'];
            $start_date=$row['start_date'];
            $end_date= $row['end_date'];
            $resume=$row['resume'];
            $remarks= $row['remarks'];


            //Filling up values in that table
            echo '<tr>
            <th scope="row">'.$id.'</th>
            <td>'.$remarks.'</td>
            <td>'.$int_email.'</td>
            <td>'.$can_email.'</td>
            <td>'.$start_date.'</td>
            <td>'.$end_date.'</td>
            <td><a target="_blank" href= "'.$row['resume'].'"><button class="btn btn-danger">Click Here</button></a></td>
            <td>';
        }
        if($count==0){
          echo '<tr>
            <th scope="row"></th>
            <td>Not Enough Records to show</td>
            <td>';
        }
      } 
    ?>
  </tbody>

  
``</table>
<!--Logout Buttons-->
    <div class="d-flex justify-content-center"> 
      <div class="p-2"><button type="submit" class="btn btn-danger my-5" id="logout"><a class ="text-light" href="../../index.php">Logout</a>
      </button>
      </div >  
    </div>
</body>
</html>