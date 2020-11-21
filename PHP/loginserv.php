<?php
session_start();

$error = "";
if (isset($_POST['Login'])) {
    if (empty($_POST['Username']) || empty($_POST['Password'])) {
        $_SESSION['msg'] = "Username or Password is Empty";
    } 
    else 
    {
        $user = $_POST['Username'];
        $pass = $_POST['Password'];
        $conn = mysqli_connect("localhost", "root", "", "ip_project");

        $admin = mysqli_query($conn, "SELECT * FROM admin WHERE Password=md5('$pass') AND Username='$user'");

        while ($adminarray = mysqli_fetch_array($admin)) 
        {
            $Email = $adminarray['Email'];
            $_SESSION['adminemail'] = $Email;
            $Username = $adminarray['Username'];
            $_SESSION['adminusername'] = $Username;
        }

        $adminrow = mysqli_num_rows($admin);

        if ($adminrow == 1) 
        {
            $_SESSION['adminlogin'] = true;
            $_SESSION['adminusername'] = $Username;
            header("location:../html/details.php");
        }
        else
        { 
            $active = mysqli_query($conn, "SELECT * FROM user WHERE Password=md5('$pass') AND Username='$user' AND status = 'active'");
            $inactive = mysqli_query($conn, "SELECT * FROM user WHERE Password=md5('$pass') AND Username='$user' AND status = 'inactive'");

            while ($row = mysqli_fetch_array($active)) 
            {
                $Email = $row['Email'];
                $_SESSION['Email'] = $Email;
                $Username = $row['Username'];
                $_SESSION['Username'] = $Username;
                $token = $row['token'];
                $_SESSION['token'] = $token;
                $CollegeID = $row['CollegeID'];
                $_SESSION['CollegeID'] = $CollegeID;

            }

            $rows = mysqli_num_rows($active);
            if ($rows == 1) 
            {
                $_SESSION['Loggedin'] = true;

                header("location:../html/admin.php");
            } 
            else 
            {
                $inactiverow = mysqli_num_rows($inactive);
                if($inactiverow == 1)
                {
                    $_SESSION['Loggedin'] = false;
                    $_SESSION['msg'] = "Account Activation Pending";
                    header("location:../PHP/login.php");
                }
                else{
                    $_SESSION['Loggedin'] = false;
                    $_SESSION['msg'] = "Invalid Credentials or Account not Exists";
                    header("location:../PHP/login.php");
                }
            }
        }
        mysqli_close($conn);
    }
}

?>
