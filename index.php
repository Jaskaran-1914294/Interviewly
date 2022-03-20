<?php
  if(isset($_POST['submit'])){
    // $con = new mysqli('localhost','$username','$password','crud');
    //For now ussername = root;
    //For now password = 123;
    $username=$_POST['username'];
    $password=$_POST['password'];
    if($username=='root' && $password=='123'){
      header('location: src/pages/user.php');
    }
    else{
      echo ("fail");
    }
    
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <title>Interviewly : An Interview Creation Portal</title>
  <body>
    <div class="d-flex justify-content-center"> 
      <div class="p-2"><img src="Images/logo.png" class="rounded float-end" >
      </div >  
    </div>
  
    <section class="vh-100" method = "POST">
      <div class="container py-5 h-120">
        <div class="row d-flex align-items-center justify-content-center h-100">
          <div class="col-md-8 col-lg-7 col-xl-6">
            <img src="Images/img.svg" class="img-fluid" alt="Phone image" />
          </div>
          <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form method = "POST">
              <div class="form-group">
                <!--Username-->
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" name="username" class="form-control" id="interviewerInputEmail1" autocomplete="off" placeholder="Enter email">
                  
              </div>
               <!--Password-->
              <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" name="password" class="form-control" id="candidateInputEmail1"  autocomplete="off" placeholder="Enter email">
              </div>

              <!-- Submit button -->
              <button  name ="submit" method = "POST" class="btn btn-primary btn-lg btn-block">
                Sign in
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
