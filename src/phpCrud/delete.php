<?php
    //Deleting a particular Record
    include'connect.php';
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];
        $sql = "delete from `interviewly` where id =$id";
        $result=mysqli_query($con,$sql);
        if($result){
            header('location: ../pages/editInterviews.php');
        }
        else{
            die(mysqli_error($con));
        }
    }
?>
