<?php

    $db_server="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="turf_booking";
    $port = 3307;


    $conn="";
    
    try{
        $conn=mysqli_connect($db_server,
                             $db_user,
                             $db_pass,
                             $db_name,
                             $port);
    }
    catch(mysqli_sql_exception)
    {
        echo"unnable to connec";
    }

?>