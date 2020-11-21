<?php
session_start();

unset($_SESSION['yearmsg']);
if($_SESSION['adminlogin'] == true)
{

  $conn = mysqli_connect("localhost", "root", "","ip_project");
  if(isset($_REQUEST['Submit'])) 
  {
    $startingyear = $_POST['StartingYear'];
    $endingyear =  $_POST['EndingHidden'];
    $insertyear = mysqli_query($conn,"INSERT INTO academicyear (academicyear) VALUES ('$startingyear-$endingyear')");

    if($insertyear)
    {
        $_SESSION['yearmsg'] = "Year Added";
    }
    else
    {
        $_SESSION['yearmsg'] = "Year Already Exists";
    }
  }

  if(isset($_POST['Delete']))
  {
    $id = $_GET['id'];
    $academicyear = $_GET['academicyear'];
    $deleteyear = mysqli_query($conn,"DELETE FROM academicyear WHERE id = $id");
    if($deleteyear)
    {
        $deleteteachersubjectname = mysqli_query($conn,"DELETE FROM teachersubject WHERE academicyear = '$academicyear'");
        $deletepdfsubject =  mysqli_query($conn,"DELETE FROM pdfmaterials WHERE cay = '$academicyear'");
        $deletepptsubject =  mysqli_query($conn,"DELETE FROM pptmaterials WHERE cay = '$academicyear'");
        $deletequizsubject =  mysqli_query($conn,"DELETE FROM quiz WHERE cay = '$academicyear'");
        $deletevideosubject =  mysqli_query($conn,"DELETE FROM video WHERE cay = '$academicyear'");
        $deleteassignmentsubject =  mysqli_query($conn,"DELETE FROM assignment WHERE cay = '$academicyear'");
        $_SESSION['yearmsg'] = "Year Deleted";
    }
    else
    {
        $_SESSION['yearmsg'] = "Year Does Not Exists";
    }
  }
  mysqli_close($conn);

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
  <title>Academic Year Section Form</title>
  <style>
        input[type="number"]{
            font-size: medium;
            width: 100%;
            padding: 10px;
            background-color:#ffffff;
            resize: vertical;
            margin-bottom: 2rem;
            border:1px solid black;
            outline:none;
        }
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

        #AcademicYear {
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

            input[type="date"] {
                font-size: small;
                padding: 7px;
                width:96%;
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

      input[type="datetime-local"] {
        font-size: small;
        padding: 9px;
        border:2px;
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
          <i class="fas fa-chalkboard-teacher"></i> Academic Year Form
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
    <div class="container" >
      <form class="Form" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST" >
          <div class="row">
              <div class="col-25">
                <label for="StartingYear">Starting Year:</label>
              </div>
              <div class="col-75">
                <input name="StartingYear" type="number" id="StartingYear" placeholder="Enter the Starting Year (YYYY)"
                required onchange="endacademicyear();" />

            </div>
          </div>

          <div class="row">
              <div class="col-25">
                <label for="EndingYear">Ending Year:</label>
              </div>
              <div class="col-75" >
                <input name="EndingYear" type="number" disabled id="EndingYear" placeholder="Enter the Ending Year (YYYY)"/>
                <input name="EndingHidden" value="" type="hidden" id="EndingHidden"/>
            </div>
          </div>

          <div class="checkemail">
                <p class = "checkemailmsg <?php if(isset($_SESSION['yearmsg'])) echo "display";?>">
                    <?php 
                    if(isset($_SESSION['yearmsg']))
                        {
                            echo $_SESSION['yearmsg']; 
                        }
                    ?>
                </p>
            </div>
         
        <input name="Submit" type="submit" id="Submit" value="Add Academic Year" />
        <a href="../html/details.php"><input name="Back" type="button" id="Back" value="Back" /></a>

        </div>
      </form>
    </div>
    <?php
      $conn = mysqli_connect("localhost", "root", "","ip_project");

            $i = 0;
            $query = "SELECT * FROM academicyear ORDER BY academicyear";
            $query_run = mysqli_query($conn, $query);
        ?>
        <button id="AcademicYear" type="button" class="collapsible">
                <h3>Complete Academic Year List</h3>
            </button>
            <div class="content">
                <table>
                    <tr>
                        <th>Sr No</th>
                        <th>Academic Year</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($query_run)) 
                    {
                        $i++;
                    ?>
                        <tr>
                            <?php $tmpid = $row['id'];?>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['academicyear'] ?></td>
                            <td><form method = "POST" action="academicyear.php?id=<?php echo $row['id']?>&academicyear=<?php echo $row['academicyear']?>"><button name="Delete">Delete</button></form></td>
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
  <script>
    function endacademicyear()
    {
      var startingyear = parseInt(document.getElementById("StartingYear").value);
      var end = (startingyear + 1);
      console.log(end);
      document.getElementById("EndingYear").value = end;
      document.getElementById("EndingHidden").value = end;
    }
  </script>
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