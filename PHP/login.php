<?php
session_start();

unset($_SESSION['signupmsg']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../css/loginformstyle.css" />
    <link rel="icon" type="image/png" sizes="32x32" href="../images/circle-cropped.png" />
    <script src="https://kit.fontawesome.com/6d617ef3fb.js" crossorigin="anonymous"></script>
    <style>
        .title 
        {
            justify-content: center;
        }
    </style>
</head>

<body>
    <header>
        <div class="title">
            <h1><i class="fas fa-chalkboard-teacher"></i> Login Form</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <form class="Form" action="../PHP/loginserv.php" method="POST">
                <br>
                <div class="row">
                    <div class="Username">
                        <div class="col-25">
                            <label for="Username">Username:</label>
                        </div>
                        <div class="col-75">
                            <input name="Username" type="text" size="30" id="Username" placeholder="Enter your Username"
                                required />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="Password">
                        <div class="col-25">
                            <label for="Password">Password:</label>
                        </div>
                        <div class="col-75">
                            <input name="Password" type="password" size="30" id="Password"
                                placeholder="Enter your Password" required />
                        </div>
                    </div>
                </div>

                <div class="checkemail">
                    <p class = "checkemailmsg <?php if(isset($_SESSION['msg'])) echo "display";?>">
                        <?php 
                        if(isset($_SESSION['msg']))
                            {
                                echo $_SESSION['msg']; 
                            }
                        ?>
                    </p>
                </div>
                <div class="row buttons">
                    <input name="Login" type="submit" id="Submit" value="Login" />
                    <a href="../html/signup.php"><input name="Register" type="button" id="Register"
                            value="Create Account" /></a>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <div class="Useful-links">
            <h2>Useful Links</h2>
            <ul>
                <li>
                    <i class="fas fa-link"></i><a href="" target="_blank">Student Educational Verification</a>
                </li>
                <li>
                    <i class="fas fa-link"></i><a href="" target="_blank">Mumbai University</a>
                </li>
                <li>
                    <i class="fas fa-link"></i><a href="" target="_blank">AICTE</a>
                </li>
                <li><i class="fas fa-link"></i><a href="" target="_blank">DTE</a></li>
            </ul>
        </div>
        <div class="Menu">
            <h2>Menu</h2>
            <ul>
                <li>
                    <i class="fas fa-external-link-alt"></i><a href="" target="_blank">Home</a>
                </li>
                <li>
                    <i class="fas fa-external-link-alt"></i><a href="" target="_blank">Mandatory Disclosure</a>
                </li>
                <li>
                    <i class="fas fa-external-link-alt"></i><a href="" target="_blank">German Club</a>
                </li>
                <li>
                    <i class="fas fa-external-link-alt"></i><a href="" target="_blank">AICTE FeedBack</a>
                </li>
                <li>
                    <i class="fas fa-external-link-alt"></i><a href="" target="_blank">Fee Proposal (2020-21)</a>
                </li>
            </ul>
        </div>
        <div class="Contacts">
            <h2>Contacts</h2>
            <ul>
                <li>
                    <i class="fas fa-map-marked-alt"></i>&nbsp;&nbsp;K.T. Marg, Vartak
                    College Campus, Vasai Road (W), Dist-Palghar, Vasai,
                    Maharashtra 401202
                </li>
                <li><i class="fas fa-tty"></i>&nbsp;&nbsp;0250-233 9486</li>
                <li>
                    <i class="fab fa-facebook-f"></i><a href="" target="_blank">Facebook</a>
                </li>
                <li>
                    <i class="fab fa-linkedin"></i><a href="" target="_blank">Linkedin</a>
                </li>
                <li>
                    <i class="fab fa-youtube"></i><a href="" target="_blank">Youtube</a>
                </li>
            </ul>
        </div>
    </footer>
</body>

</html>