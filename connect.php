<?php
    $HOSTNAME= 'localhost';
    $USERNAME='root';
    $PASSWORD='';
    $DATABASE='signupforms'; 

    $con=mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE, 3306);

    if(!$con)
    {
        die(mysqli_connect_error());
    }
    ?>