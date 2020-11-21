<?php
session_start();
$conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn, "ip_project");
if($_SESSION['adminlogin'] == true)
{
  if(isset($_REQUEST['Submit'])) 
  {
    $Department = $_POST['Staff_Department'];
    $_SESSION['Department'] = $Department;
    $Year = $_POST['Year'];
    $_SESSION['Year'] = $Year;
    $Sem = $_POST['Sem'];
    $_SESSION['Sem'] = $Sem;
    $SubjectName = $_POST['Subject_Name'];
    $_SESSION['Subject_Name'] = $SubjectName;
    $CAY = $_POST['Academic_Year'];
    $_SESSION['CAY'] = $CAY;
    $TopicName = $_POST['TopicName'];
    $_SESSION['TopicName'] = $TopicName;
    $Deadline = $_POST['deadline'];
    $_SESSION['Deadline'] = $Deadline;

   
    $query1 = "SELECT * FROM user WHERE Username = '$username'";

    $queryrun = mysqli_query($conn, $query1);
    while ($row = mysqli_fetch_array($queryrun)) {
        $Name = $row['Name'];
    }

    $_SESSION['Name'] = $Name;
    $query = "INSERT INTO staff (Name,Department,Year,Sem,Subject_Name,CAY)
        VALUES ('$Name','$Department','$Year','$Sem','$SubjectName','$CAY');";

    if (!mysqli_query($conn, $query)) {
        echo "Not Inserted";
    } 
    else {
        echo "Inserted";
        header("Location: ../PHP/material.php");
    }

    mysqli_close($conn);
  }
}
else
{
  if($_SESSION['adminlogin'] == false)
  {
    header("location:../PHP/login.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/loginformstyle.css" />
  <link rel="icon" type="image/png" sizes="32x32" href="../images/circle-cropped.png" />
  <title>Admin Management Form</title>
  <style>
  input[type="button"]
    {
        width:25%;
        position: relative;
        margin-left:14%;
        margin-right:5%;
        margin-bottom: 4%;
        text-align: center;
    }
    @media only screen and (min-width: 651px) and (max-width: 1024px) 
    {
      input[type="button"] 
      {
        margin-left: 4%;
        width: 40%;
      }
    }

    @media screen and (max-width: 650px) {

      input[type="button"] {
        margin: 2% auto;
        margin-left: 5%;
        width: 90%;
      }

      .container {
        padding-bottom: 2%;
      }
    }

    @media screen and (max-width: 350px) {
      .container {
        padding-bottom: 4%;
      }

      input[type="button"] 
      {
        margin: 2% auto;
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="title">
        <h1>
          <i class="fas fa-chalkboard-teacher"></i> Admin Management Form
        </h1>
        <nav>
        <p>
          <?php $user = $_SESSION['adminusername'];
          echo "Welcome, $user!!!"; 
        ?>
        </p>
          <a href="../PHP/logout.php"><button id="logout" name="Logout">Logout</button></a>
      </nav>
    </div>
  </header>
  <main>
    <div class="container">
        <a href="../PHP/department.php"><input name="Department" type="button" id="Department" value="Department Section" /></a>
        <a href="../PHP/subjectdetails.php"><input name="Subject" type="button" id="Subject" value="Subject Section" /></a>
        <a href="../PHP/academicyear.php"><input name="Academic" type="button" id="Academic" value="Academic Year Section"/></a>
        <a href="../PHP/teachersection.php"><input name="Teacher" type="button" id="Teacher" value="Teacher Section" /></a>
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
          College Campus, Vasai Road (W), Dist-Palghar, Vasai, Maharashtra
          401202
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
  <script src="https://kit.fontawesome.com/6d617ef3fb.js" crossorigin="anonymous"></script>
</body>

</html>