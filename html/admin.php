<?php
session_start();
$conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn, "ip_project");
unset($_SESSION['deletemsg']);
if ($_SESSION['Loggedin'] == true) {

  if (isset($_REQUEST['Submit'])) 
  {
    $username = $_SESSION['Username'];
    $Department = $_POST['Staff_Department'];
    $_SESSION['Department'] = $Department;
    $Year = $_POST['Year'];
    $_SESSION['Year'] = $Year;
    $Sem = $_POST['Sem'];
    $_SESSION['Sem'] = $Sem;
    $SubjectName = $_POST['Subject_Name'];
    $_SESSION['Subject_Name'] = $SubjectName;
    $CAY = $_POST['AcademicYear'];
    $_SESSION['CAY'] = $CAY;


    $query1 = "SELECT * FROM user WHERE Username = '$username'";

    $queryrun = mysqli_query($conn, $query1);
    while ($row = mysqli_fetch_array($queryrun)) {
      $Name = $row['Name'];
    }

    $_SESSION['Name'] = $Name;

    header("Location: ../PHP/material.php");

    mysqli_close($conn);
  }
} else {
  if ($_SESSION['Loggedin'] == false) {
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
  <title>Staff Detail Form</title>
  <style>

    @media only screen and (min-width: 651px) and (max-width: 1024px) {
      input[type="submit"] {
        margin-left: 8%;
        width: 40%;
      }

      input[type="button"] {
        margin-left: 4%;
        width: 40%;
      }

      input[type="datetime-local"] {
        font-size: small;
        padding: 7px;
        width: 96%;
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

      input[type="datetime-local"] {
        font-size: small;
        padding: 9px;
        border: 2px;
      }

      .container {
        padding-bottom: 2%;
      }
    }

    @media screen and (max-width: 350px) {
      .container {
        padding-bottom: 4%;
      }

      input[type="submit"] {
        margin: 2% auto;
        width: 100%;
        margin-bottom: 4%;
      }

    }
  </style>
  <script type="text/javascript" src="../js/jqueryv3.5.1.js"></script>
</head>

<body>
  <header>
    <div class="title">
      <h1>
        <i class="fas fa-chalkboard-teacher"></i> Staff Management </h1>
      <nav>
        <p>
          <?php if (isset($_SESSION['Username'])) {
            $user = $_SESSION['Username'];
            echo "Welcome, $user!!!";
            $collegeid = $_SESSION['CollegeID'];
          ?>
            <input name="CollegeID" type="hidden" id="CollegeID" value="<?php echo $collegeid; ?>">
          <?php
          }
          ?>
        </p>
        <a href="../PHP/logout.php"><button id="logout" name="Logout">Logout</button></a>
      </nav>
    </div>
  </header>
  <main>
    <br />
    <div class="container">
      <form class="Form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
      <span id="GetSubjectName">

        <div class="row">
          <div class="col-25">
            <label for="AcademicYear">Current Academic Year:</label>
          </div>
          <div class="col-75">
            <select name="AcademicYear" id="AcademicYear" required>
              <option value="" disabled selected>Choose Academic Year</option>
              <?php
                    $conn = mysqli_connect("localhost", "root", "","ip_project");

              $yearquery = mysqli_query($conn, "SELECT * FROM academicyear");
              while ($row_list = mysqli_fetch_assoc($yearquery)) {

              ?>
                <option value="<?php echo $row_list['academicyear']; ?>"><?php echo $row_list['academicyear']; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="Staff_Department">Department:</label>
          </div>
          <div class="col-75">
            <select name="Staff_Department" id="Staff_Department" required>
              <option value="" disabled selected>
                Enter your Department
              </option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="Year">Year:</label>
          </div>
          <div class="col-75">
            <select name="Year" id="Year" required>
              <option value="" disabled selected>Choose Year</option>
              <option value="First Year">First Year</option>
              <option value="Second Year">Second Year</option>
              <option value="Third Year">Third Year</option>
              <option value="Fourth Year">Fourth Year</option>
            </select>
          </div>
        </div>


        <div class="row">
          <div class="col-25">
            <label id="Sem">Sem Type:</label>
          </div>
          <div class="col-75">
            <select name="Sem" id="Semtype" required>
              <option value="" disabled selected>Choose Sem Type</option>
              <option value="Odd Sem">Odd Sem</option>
              <option value="Even Sem">Even Sem</option>
            </select>
          </div>
        </div>
        </span>

        <div class="row">
          <div class="col-25">
            <label for="Subject_Name">Subject Name:</label>
          </div>
          <div class="col-75">
            <select name="Subject_Name" class="Subject" id="Subject_Name" required>
              <option value="" disabled selected>Choose your Subject</option>
            </select>
          </div>
        </div>


        <input name="Submit" type="submit" id="Submit" value="Add Materials" />
        <a href="../PHP/studentadmin.php"><input name="Studentadmin" type="button" id="Studentadmin" value="View Materials" /></a>

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
  <script src="https://kit.fontawesome.com/6d617ef3fb.js" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('#AcademicYear').change(function() {
      // console.log(collegeid,academicyear);
      var startingyear = $(this).val();
      var splityear = startingyear.split("-");
      var academicyear = parseInt(splityear[0]);
      // console.log(academicyear);

      $.ajax({
        url: '../PHP/getdetails.php',
        method: 'POST',
        data: {
          academicyear: academicyear
        },
        dataType: 'json',
        success: function(response) {

          var len = response.length;

          $('#Staff_Department').find('option').not(':first').remove();

          for (var i = 0; i < len; i++) {
            var department = response[i]['departmentname'];
            $('#Staff_Department').append("<option value='" + department + "'>" + department + "</option>");
            console.log(department);
          }
        }

      });

    });

    $('#GetSubjectName').change(function() {
      var collegeid = $("#CollegeID").val();
      var stringacademicyear = $('#AcademicYear').val();
      var splityear = stringacademicyear.split("-");
      var startingyear = parseInt(splityear[0]);
      var endingyear = parseInt(splityear[1]);
      var department = $('#Staff_Department').val();
      var year = $('#Year').val();
      var semtype = $('#Semtype').val();
      console.log(collegeid,startingyear,endingyear,department,year,semtype);
      $.ajax({
        url: '../PHP/getdetails.php',
        method: 'POST',
        data: {
          department: department,
          year: year,
          semtype: semtype,
          startingyear:startingyear,
          endingyear:endingyear,
          collegeid:collegeid
         
        },
        dataType: 'json',
        success: function(response) {

          var len = response.length;

          $('#Subject_Name').find('option').not(':first').remove();


          for (var i = 0; i < len; i++) {
            var subjectname = response[i]['subjectname'];

            $('#Subject_Name').append("<option value='" + subjectname + "'>" + subjectname + "</option>");
          }
        }

      });

    });
  });
</script>

</html>