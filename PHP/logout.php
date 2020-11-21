<?php
    session_start();
    $_SESSION['Loggedin'] = false;
    $_SESSION['msg'] = "Logout Successfully";
    session_destroy();
    header("location:../PHP/login.php");
?>