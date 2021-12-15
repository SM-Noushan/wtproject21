<?php
    if(session_status()>=0){
        session_start();
        session_unset();
        session_destroy();
        echo "Redirecting to Homepage";
    }
    header("refresh: 0.5, url = login.php");
?>