<?php
session_start();
unset($_SESSION['updatedeptmsg']);

if ($_SESSION['adminlogin'] == true) {

  $deptid = $_SESSION['deptid'];
  $previousdeptname =  $_SESSION['deptname'];
  $conn = mysqli_connect("localhost", "root", "", "ip_project");
  $id =   $_SESSION['dID'];
  if (isset($_POST['Submit'])) {

    $Deptid = $_POST['DepartmentID'];
    $Deptname = $_POST['DepartmentName'];
    $DeptYear = $_POST['DepartmentYear'];
    $selectrun = mysqli_query($conn, "SELECT DeptID from department WHERE id = '$id'");
    $row = mysqli_num_rows($selectrun);

    if ($row == 1) {
      $updatedeptrun = mysqli_query($conn, "UPDATE department SET DeptID = '$Deptid', DeptName = '$Deptname', DeptYear = '$DeptYear'  WHERE id = '$id'");

      if ($updatedeptrun) {
        $updatesubjectdept =  mysqli_query($conn, "UPDATE subjectdetails SET department = '$Deptname' WHERE department = '$previousdeptname'");
        $updateuser = mysqli_query($conn, "UPDATE user SET Department = '$Deptname' WHERE Department = '$previousdeptname'");
        $updatepdfdept =  mysqli_query($conn, "UPDATE pdfmaterials SET department = '$Deptname' WHERE department = '$previousdeptname'");
        $updatepptdept =  mysqli_query($conn, "UPDATE pptmaterials SET department = '$Deptname' WHERE department = '$previousdeptname'");
        $updatequizdept =  mysqli_query($conn, "UPDATE quiz SET department = '$Deptname' WHERE department = '$previousdeptname'");
        $updatevideodept =  mysqli_query($conn, "UPDATE video SET department = '$Deptname' WHERE department = '$previousdeptname'");
        $updateassignmentdept =  mysqli_query($conn, "UPDATE assignment SET department = '$Deptname' WHERE department = '$previousdeptname'");

        $_SESSION['updatedeptmsg'] = "Update Successfully";
        $_SESSION['deptid'] = $Deptid;
        $_SESSION['deptname'] = $Deptname;
        $_SESSION['deptyear'] = $DeptYear;
      } else {
        $_SESSION['updatedeptmsg'] = "Updation Failed";
      }
    } else {
      $_SESSION['updatedeptmsg']  = "ID Not Found";
    }
  }

  if (isset($_POST['Delete'])) {

    $Deptid = $_POST['DepartmentID'];
    $Deptname = $_POST['DepartmentName'];

    $selectrun = mysqli_query($conn, "SELECT DeptID from department WHERE id = '$id'");
    $row = mysqli_num_rows($selectrun);
    if ($row == 1) {
      $deletedeptrun = mysqli_query($conn, "DELETE FROM department WHERE id = '$id'");

      if ($deletedeptrun) {
        $deletesubjectdetailsdept =  mysqli_query($conn, "DELETE FROM subjectdetails WHERE department = '$Deptname'");
        $deleteuserdept = mysqli_query($conn, "DELETE FROM user WHERE Department = '$Deptname'");
        $deletepdfdept =  mysqli_query($conn, "DELETE FROM pdfmaterials WHERE department = '$Deptname'");
        $deletepptdept =  mysqli_query($conn, "DELETE FROM pptmaterials WHERE department = '$Deptname'");
        $deletequizdept =  mysqli_query($conn, "DELETE FROM quiz WHERE department = '$Deptname'");
        $deletevideodept =  mysqli_query($conn, "DELETE FROM video WHERE department = '$Deptname'");
        $deleteassignmentdept =  mysqli_query($conn, "DELETE FROM assignment WHERE department = '$Deptname'");
        $_SESSION['updatedeptmsg'] = "Delete Successfully";
      } else {
        $_SESSION['updatedeptmsg'] = "Deletion Failed";
      }
    } else {
      $_SESSION['updatedeptmsg']  = "ID Not Found";
    }
  }

  mysqli_close($conn);
} else {
  if ($_SESSION['adminlogin'] == false) {
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
  <title>Department Deletion Form</title>

  <style>
    @media only screen and (min-width: 1025px){
      input[type="button"] {
        margin-left: 30%;
        width: 40%;
      }
    }

    @media only screen and (min-width: 651px) and (max-width: 1024px) {
  

      input[type="submit"] {
        margin-left: 8%;
        width: 40%;
      }

      input[type="button"] {
        margin-left: 30%;
        width: 40%;
      }

    }

    @media screen and (max-width: 650px) {
      input[type="submit"] {
        margin: 2% auto;
        margin-left: 5%;
        width: 90%;
      }

      input[type="button"] {
        margin: 2% auto;
        margin-left: 5%;
        width: 90%;
      }


     
    }

    @media screen and (max-width: 350px) {
     
      input[type="submit"] {
        margin: 2% auto;
        width: 100%;
        margin-bottom: 4%;
      }

      input[type="button"] {
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
        <i class="fas fa-chalkboard-teacher"></i> Department Deletion Form
      </h1>
      <nav>
        <p>
          <?php if (isset($_SESSION['adminusername'])) {
            $user = $_SESSION['adminusername'];
            echo "Welcome, $user!!!";
          } ?>
        </p>
        <a href="../PHP/logout.php"><button id="logout" name="Logout">Logout</button></a>
      </nav>
    </div>
  </header>
  <main>
    <br />
    <div class="container">
      <form class="Form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="row">
          <div class="col-25">
            <label for="DepartmentID">Department ID:</label>
          </div>
          <div class="col-75">
            <input name="DepartmentID" value="<?php echo $_SESSION['deptid'] ?>" type="text" pattern="^[A-Z0-9-_.]{5,12}$" size="30" id="DepartmentID" placeholder="Enter the Department ID (Letters in CAPS)" required />
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="DepartmentName">Department Name:</label>
          </div>
          <div class="col-75">
            <input name="DepartmentName" value="<?php echo $_SESSION['deptname'] ?>" type="text" size="30" id="DepartmentName" placeholder="Enter the Department Name" required />
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="DepartmentYear">Founded in Year:</label>
          </div>
          <div class="col-75">
            <input name="DepartmentYear" value="<?php echo $_SESSION['deptyear'] ?>" type="number" id="DepartmentYear" placeholder="Enter the Establishment Year" required />
          </div>
        </div>

        <div class="checkemail">
          <p class="checkemailmsg <?php if (isset($_SESSION['updatedeptmsg'])) echo "display"; ?>">
            <?php
            if (isset($_SESSION['updatedeptmsg'])) {
              echo $_SESSION['updatedeptmsg'];
            }
            ?>
          </p>
        </div>

        <input name="Submit" type="submit" id="Submit" value="Update Department" />
        <input name="Delete" type="submit" id="Delete" value="Delete Department" />
        <a href="../PHP/department.php"><input name="Back" type="button" id="back" value="Back" /></a>

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
  <script src="../js/staffform.js"></script>
  <script src="https://kit.fontawesome.com/6d617ef3fb.js" crossorigin="anonymous"></script>

</body>

</html>