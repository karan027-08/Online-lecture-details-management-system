<?php
    session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'ip_project');
    if (isset($_GET['token'])) 
    {
        $token = $_GET['token'];

        $updatestatus = "UPDATE user SET status = 'active' WHERE token = '$token'";

        if(mysqli_query($conn,$updatestatus))
        {
            if(isset($_SESSION['msg']))
            {
                $_SESSION['msg'] = "Account Activated Successfully";
                header("location:login.php");
            }
            else{
                $_SESSION['msg'] = "Logged Out Successfully";
                header("location:login.php");
            }
        }
        else{
                $_SESSION['msg'] = "Account Activation Failed";
                header("location:../html/signup.php");
        }
    }
?>