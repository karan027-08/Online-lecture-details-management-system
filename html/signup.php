<?php
session_start();

$error = "";
$conn = mysqli_connect('localhost', 'root', '', 'ip_project');
if (isset($_REQUEST['Submit'])) 
{
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $user = mysqli_real_escape_string($conn, $_POST['Username']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $pass = mysqli_real_escape_string($conn, $_POST['Password']);
    $collegeid = mysqli_real_escape_string($conn, $_POST['CollegeID']);
    $department = mysqli_real_escape_string($conn, $_POST['Department']);
    $token = bin2hex(random_bytes(15));
    $query = "INSERT INTO user(id,CollegeID,Name,Username,Email,Password,Department,token,status) VALUES ('','$collegeid','$name','$user','$email',MD5('$pass'),'$department', '$token', 'inactive')";

    $dupcollegeid = "SELECT * FROM user WHERE CollegeID = '$collegeid';";
    $idresult = mysqli_query($conn, $dupcollegeid);

    $idrow = mysqli_num_rows($idresult);

    if ($idrow > 0) {
        $_SESSION['signupmsg'] =  "CollegeID Already Exists";
    } 
    else
    {
        $dupemail = "SELECT * FROM user WHERE Email = '$email';";
        $emailresult = mysqli_query($conn, $dupemail);

        $emailrow = mysqli_num_rows($emailresult);

        if ($emailrow > 0) {
            $_SESSION['signupmsg'] =  "Email Already Exists";
        } 
        else 
        {
            if (!mysqli_query($conn, $query)) 
            {
                $_SESSION['signupmsg'] =  "Error Occured";
            } 
            else 
            {
                $subject = "Email Activation Link";
                $headers = "From: smmauryatwo@gmail.com";
                $body = "Hello $name, here is the activation link to create a new account.active
                    
                    Click on the Link below to activate your account
                    
                    http://localhost//Online%20Lectures%20Management%20System/PHP/reg.php?token=$token';

                    ";

                if (mail($email, $subject, $body, $headers)) 
                {
                    $_SESSION['msg'] = "Check your email '$email' for Activation Link";
                } 
                else {
                    $_SESSION['signupmsg'] = "Email Sending Failed...";
                }
                header("location:../PHP/login.php");
            }
        }
    }
    mysqli_close($conn);

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../css/loginformstyle.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/circle-cropped.png">
</head>
<style>
    .title
    {
        justify-content:center;
    }
</style>

<body>
    <header>
        <div class='title'>
            <h1><i class="fas fa-chalkboard-teacher"></i> Registration Form</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <form class="Form" onsubmit="return checkPassword(this);" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <br>
                <div class="row">
                    <div class="CollegeID">
                        <div class="col-25">
                            <label for="CollegeID">College ID:</label>
                        </div>
                        <div class="col-75">
                            <input value="<?php echo $_POST['CollegeID'] ?? ''; ?>" name="CollegeID" type="text" pattern="[0-9]+" size="30" id="CollegeID" placeholder="Enter your ID Number" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="Name">
                        <div class="col-25">
                            <label for="Name">Name:</label>
                        </div>
                        <div class="col-75">
                            <input value="<?php echo $_POST['Name'] ?? ''; ?>" name="Name" type="text" size="30" id="Name" placeholder="Enter your Full Name" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="Username">
                        <div class="col-25">
                            <label for="Username">Username:</label>
                        </div>
                        <div class="col-75">
                            <input value="<?php echo $_POST['Username'] ?? ''; ?>" name="Username" type="text" size="30" id="Username" placeholder="Enter your Username" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="email">
                        <div class="col-25">
                            <label for="email">Email Address:</label>
                        </div>
                        <div class="col-75">
                            <input value="<?php echo $_POST['Email'] ?? ''; ?>" pattern=".+@vcet.edu.in" name="Email" type="email" size="30" id="email" placeholder="Enter your Vcet Email Address" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="Password">
                        <div class="col-25">
                            <label for="Password">Password:</label>
                        </div>
                        <div class="col-75">
                            <input name="Password" type="password" size="30" id="Password" placeholder="Enter your Password" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="Confirm">
                        <div class="col-25">
                            <label for="ConfirmPassword">Confirm Password:</label>
                        </div>
                        <div class="col-75">
                            <input name="ConfirmPassword" type="password" size="30" id="ConfirmPassword" placeholder="Confirm your Password" required>
                        </div>
                    </div>
                </div>

        <div class="row">
              <div class="col-25">
                <label for="Department">Department:</label>
              </div>
              <div class="col-75">
                <select name="Department" id="Department" required>
                    <option value="" disabled selected>Enter your Department</option>
                    <?php
                    $departmentquery = mysqli_query($conn,"SELECT * FROM department ORDER BY DeptID");
                    while($row_list=mysqli_fetch_assoc($departmentquery))
                    {
                    ?>
                    <option value="<?php echo $row_list['DeptName'];?>"><?php echo $row_list['DeptName'];?></option>
                    <?php
                    }
                    ?>
                </select>
              </div>
          </div>

                <div class="checkemail">
                    <p class = "checkemailmsg <?php if(isset($_SESSION['signupmsg'])) echo "display";?>">
                        <?php 
                        if(isset($_SESSION['signupmsg']))
                            {
                                echo $_SESSION['signupmsg']; 
                            }
                        ?>
                    </p>
                </div>

                <div class="row buttons">
                    <input name="Submit" type="submit" id="Register" value="Register" />
                    <a href="../PHP/login.php"><input name="Back" type="button" id="Back"
                            value="Back" /></a>
                </div>            
            </form>
        </div>
    </main>
    <footer>
        <div class="Useful-links">
            <h2>Useful Links</h2>
            <ul>
                <li><i class="fas fa-link"></i><a href="" target="_blank">Student Educational Verification</a></li>
                <li><i class="fas fa-link"></i><a href="" target="_blank">Mumbai University</a></li>
                <li><i class="fas fa-link"></i><a href="" target="_blank">AICTE</a></li>
                <li><i class="fas fa-link"></i><a href="" target="_blank">DTE</a></li>
        </div>
        <div class="Menu">
            <h2>Menu</h2>
            <ul>
                <li><i class="fas fa-external-link-alt"></i><a href="" target="_blank">Home</a></li>
                <li><i class="fas fa-external-link-alt"></i><a href="" target="_blank">Mandatory Disclosure</a></li>
                <li><i class="fas fa-external-link-alt"></i><a href="" target="_blank">German Language Club</a></li>
                <li><i class="fas fa-external-link-alt"></i><a href="" target="_blank">AICTE FeedBack</a></li>
                <li><i class="fas fa-external-link-alt"></i><a href="" target="_blank">Fee Proposal (2020-21)</a></li>
        </div>
        <div class="Contacts">
            <h2>Contacts</h2>
            <ul>
                <li><i class="fas fa-map-marked-alt"></i>&nbsp;&nbsp;K.T. Marg, Vartak College Campus, Vasai Road (W),<br>Dist-Palghar, Vasai, Maharashtra 401202</li>
                <li><i class="fas fa-tty"></i>&nbsp;&nbsp;0250-233 9486</li>
                <li><i class="fab fa-facebook-f"></i><a href="" target="_blank">Facebook</a></li>
                <li><i class="fab fa-linkedin"></i><a href="" target="_blank">Linkedin</a></li>
                <li><i class="fab fa-youtube"></i><a href="" target="_blank">Youtube</a></li>
            </ul>
        </div>
    </footer>
    <script src="../js/signup.js"></script>
    <script src="https://kit.fontawesome.com/6d617ef3fb.js" crossorigin="anonymous"></script>
</body>

</html>