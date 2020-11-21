<?php
session_start();
unset($_SESSION['submsg']);

if($_SESSION['adminlogin'] == true)
{
  $conn = mysqli_connect("localhost", "root", "","ip_project");
  $deleterun = mysqli_query($conn,"DELETE FROM subjectdetails WHERE ValidTill < YEAR(CURDATE())");

  if(isset($_REQUEST['Submit'])) 
  {

    $SubjectID = $_POST['SubjectID'];
    $SubjectName = $_POST['NewSubjectName'];
    $Department = $_POST['Department'];
    $Year = $_POST['Year'];
    $Semtype = $_POST['Sem'];
    $Foundedyear = $_POST['FoundedYear'];
    $ValidTill = $_POST['ValidTillHidden'];

    $checkrun = mysqli_query($conn,"SELECT * FROM subjectdetails WHERE subjectid = '$SubjectID'");

    $checkrow = mysqli_num_rows($checkrun);

    if($checkrow==0)
    {

        $insertsubject = mysqli_query($conn,"INSERT INTO subjectdetails (subjectid,subjectname,department,year,semtype,FoundedYear,ValidTill,academicyear) VALUES ('$SubjectID','$SubjectName','$Department','$Year','$Semtype',$Foundedyear,$ValidTill,'$Foundedyear-$ValidTill')");

        if($insertsubject)
        {
            $_SESSION['submsg'] = "Subject Added";
        }
    }
    else
    {
        $_SESSION['submsg'] = "Subject Already Exists";
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
  <title>Subject Section Form</title>
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
            line-height: 25px;
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

        #SubjectName {
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
          <i class="fas fa-chalkboard-teacher"></i> Subject Details Form
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
                <label for="SubjectID">Subject ID:</label>
              </div>
              <div class="col-75">
                <input name="SubjectID" type="text" pattern="^[A-Z0-9-_.]{4,12}$" size="30" id="SubjectID" placeholder="Enter the Subject ID (Letters in CAPS)"
                required />
            </div>
          </div>

          <div class="row">
              <div class="col-25">
                <label for="NewSubjectName">Subject Name:</label>
              </div>
              <div class="col-75">
                <input name="NewSubjectName" type="text" size="30" id="NewSubjectName" placeholder="Enter the Subject Name" required />
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
                          $conn = mysqli_connect("localhost", "root", "","ip_project");

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
              <label for="Semtype">Sem Type:</label>
            </div>
            <div class="col-75">
              <select name="Sem" id="Semtype" required>
                <option value="" disabled selected>Choose Sem Type</option>
                <option value="Odd Sem">Odd Sem</option>
                <option value="Even Sem">Even Sem</option>
              </select>
            </div>
          </div>

          <div class="row">
              <div class="col-25">
                <label for="FoundedYear">Came in Year:</label>
              </div>
              <div class="col-75">
                <input name="FoundedYear" type="number" id="FoundedYear" placeholder="Enter the Founded Year"
                required  onchange="endvalidyear();"/>
            </div>
          </div>

          <div class="row">
              <div class="col-25">
                <label for="ValidTill">Valid Till Year:</label>
              </div>
              <div class="col-75">
                <input name="ValidTill" type="number" id="ValidTill" placeholder="Enter the Ending Year"
               disabled required />
                <input name="ValidTillHidden" value="" type="hidden" id="ValidTillHidden"/>
            </div>
          </div>

          <div class="checkemail">
                <p class = "checkemailmsg <?php if(isset($_SESSION['submsg'])) echo "display";?>">
                    <?php 
                    if(isset($_SESSION['submsg']))
                        {
                            echo $_SESSION['submsg']; 
                        }
                    ?>
                </p>
            </div>
         
        <input name="Submit" type="submit" id="Submit" value="Add Subject" />
        <a href="../html/details.php"><input name="Back" type="button" id="Back" value="Back" /></a>

        </div>
      </form>
    </div>
    <?php
          $conn = mysqli_connect("localhost", "root", "","ip_project");

            $i = 0;
            $query = "SELECT * FROM subjectdetails ORDER BY department ASC";
            $query_run = mysqli_query($conn, $query);
        ?>
        <button id="SubjectName" type="button" class="collapsible">
                <h3>Complete Subject List</h3>
            </button>
            <div class="content">
                <table>
                    <tr>
                        <th>Sr No</th>
                        <th>Subject ID</th>
                        <th>Subject Name</th>
                        <th>Department</th>
                        <th>Year</th>
                        <th>Sem Type</th>
                        <th>Valid Till</th>
                        <th>Update</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($query_run)) {
                        $i++;
                    ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['subjectid'] ?></td>
                            <td><?php echo $row['subjectname'] ?></td>
                            <td><?php echo $row['department'] ?></td>
                            <td><?php echo $row['year'] ?></td>
                            <td><?php echo $row['semtype'] ?></td>
                            <td><?php echo $row['ValidTill'] ?></td>
                            <td><a href="trail.php?id=<?php echo $row['id']?>&changetype=<?php echo 'adminsubject'?>&subjectid=<?php echo $row['subjectid']?>&subjectname=<?php echo $row['subjectname']?>&department=<?php echo $row['department']?>&year=<?php echo $row['year']?>&semtype=<?php echo $row['semtype']?>&foundedyear=<?php echo $row['FoundedYear']?>&validtill=<?php echo $row['ValidTill']?>"><button>Update</button></a></td>
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
      function endvalidyear()
      {
        var foundedyear = parseInt(document.getElementById("FoundedYear").value);
        var validtillyear = (foundedyear + 4);
        console.log(validtillyear);
        document.getElementById("ValidTill").value = validtillyear;
        document.getElementById("ValidTillHidden").value = validtillyear;
     }
  </script>
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