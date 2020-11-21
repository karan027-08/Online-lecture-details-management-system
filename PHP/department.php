<?php
session_start();

unset($_SESSION['deptmsg']);
if($_SESSION['adminlogin'] == true)
{
  $conn = mysqli_connect("localhost", "root", "","ip_project");

  if(isset($_REQUEST['Submit'])) 
  {

    $Deptid = $_POST['DepartmentID'];
    $Deptname = $_POST['DepartmentName'];
    $DeptYear = $_POST['DepartmentYear'];

    $checkrun = mysqli_query($conn,"SELECT * FROM department WHERE DeptID = '$Deptid'");

    $checkrow = mysqli_num_rows($checkrun);

    if($checkrow==0)
    {

        $insertdeptrun = mysqli_query($conn,"INSERT INTO department (DeptID,DeptName,DeptYear) VALUES ('$Deptid','$Deptname','$DeptYear')");

        if($insertdeptrun)
        {
            $_SESSION['deptmsg'] = "Department Added";
        }
        else
        {
            $_SESSION['deptmsg'] = "Department Name Already Exists";
        }
    }
    else
    {
        $_SESSION['deptmsg'] = "Department ID Already Exists";
    }
    mysqli_close($conn);
  }
}
else
{
  if($_SESSION['adminusername'] == false)
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
  <title>Department Section Form</title>
  <style>

        h3 {
            font-size: 20px;
            font-weight: normal;
        }
         table {
            margin: 10px auto;
            text-align: center;
            width: 100%;
            background-color: #f2f2f2;
            font-size: medium;
            border-spacing: 0;
            border-collapse: collapse;
            line-height: 5px;
        }

        tr,
        th {
            text-align: center;
            border: 1px solid black;
            padding: 30px;

        }

        td {
            border: 1px solid black;
            padding: 1%;

        }

        table button {
            padding: 10px;
            text-align: center;
            background-color: none;
        }

        table button:hover {
            border: 2px solid #007bff;
        }

        .collapsible {
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: center;
            outline: none;
            font-size: 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
        .active,
        .collapsible:hover {
            background-color: #ccc;
        }

        /* Style the collapsible content. Note: hidden by default */
        .content {
            padding: 0 18px;
            display: none;
            overflow: auto;
            background-color: #f1f1f1;
        }

        #Department {
            margin: 15px auto;
            text-align: center;
            font-size: 18px;
            padding: 2rem;
        }

    @media only screen and (min-width: 651px) and (max-width: 1024px) {
        table {
                font-size: smaller;
                line-height: 23px;

            }

        .content {
            padding: 0;
        }

        h3 {
            font-size: 18px;
            font-weight: normal;
        }

        tr,
        th {
            padding: 10px 30px;

        }

      input[type="submit"] {
        margin-left: 8%;
        width: 40%;
      }

      input[type="button"] {
        margin-left: 4%;
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


      .container {
        padding-bottom: 2%;
      }

      table {
                font-size: small;
                line-height: 23px;

        }

        th {
            font-size: 15px;
        }

        .content {
            padding: 0;
        }

        h3 {
            font-size: 16px;
        }

        tr,
        th {
            padding: 10px 30px;

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
          <i class="fas fa-chalkboard-teacher"></i> Staff Details Management
          Form
        </h1>
        <nav>
        <p>
          <?php if(isset($_SESSION['adminusername']))
        { 
          $user = $_SESSION['adminusername'];
          echo "Welcome, $user!!!"; 
        }?>
        </p>
          <a href="../PHP/logout.php"><button id="logout" name="Logout">Logout</button></a>
      </nav>
    </div>
  </header>
  <main>
    <br />
    <div class="container">
      <form class="Form" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
          <div class="row">
              <div class="col-25">
                <label for="DepartmentID">Department ID:</label>
              </div>
              <div class="col-75">
                <input name="DepartmentID" type="text" pattern="^[A-Z0-9-_.]{5,12}$" size="30" id="DepartmentID" placeholder="Enter the Department ID (Letters in CAPS)"
                required />
            </div>
          </div>

          <div class="row">
              <div class="col-25">
                <label for="DepartmentName">Department Name:</label>
              </div>
              <div class="col-75">
                <input name="DepartmentName" type="text" size="30" id="DepartmentName" placeholder="Enter the Department Name"
                required />
            </div>
          </div>

          <div class="row">
              <div class="col-25">
                <label for="DepartmentYear">Founded in Year:</label>
              </div>
              <div class="col-75">
                <input name="DepartmentYear" type="number" id="DepartmentYear" placeholder="Enter the Establishment Year"
                required />
            </div>
          </div>

          <div class="checkemail">
                <p class = "checkemailmsg <?php if(isset($_SESSION['deptmsg'])) echo "display";?>">
                    <?php 
                    if(isset($_SESSION['deptmsg']))
                        {
                            echo $_SESSION['deptmsg']; 
                        }
                    ?>
                </p>
            </div>
         
        <input name="Submit" type="submit" id="Submit" value="Add Department" />
        <a href="../html/details.php"><input name="Back" type="button" id="Back" value="Back" /></a>

        </div>
      </form>
    </div>
    <?php
      $conn = mysqli_connect("localhost", "root", "","ip_project");

            $i = 0;
            $query = "SELECT * FROM department ORDER BY DeptID";
            $query_run = mysqli_query($conn, $query);
        ?>
        <button id="Department" type="button" class="collapsible">
                <h3>Complete Department List</h3>
            </button>
            <div class="content">
                <table>
                    <tr>
                        <th>Sr No</th>
                        <th>Department ID</th>
                        <th>Department Name</th>
                        <th>Founded in Year</th>
                        <th>Update</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($query_run)) {
                        $i++;
                    ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['DeptID'] ?></td>
                            <td><?php echo $row['DeptName'] ?></td>
                            <td><?php echo $row['DeptYear'] ?></td>
                            <td><a href="trail.php?id=<?php echo $row['id']?>&changetype=<?php echo 'admindept'?>&deptid=<?php echo $row['DeptID']?>&deptname=<?php echo $row['DeptName']?>&deptyear=<?php echo $row['DeptYear']?>"><button>Update</button></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
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
  <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }

        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }
    </script>
</body>

</html>