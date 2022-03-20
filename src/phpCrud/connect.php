<?php
    //Connecting to particular Database
    $con = new mysqli('localhost','root','','crud');
    if(!$con){
        echo "connection error :(";
    }
?> 