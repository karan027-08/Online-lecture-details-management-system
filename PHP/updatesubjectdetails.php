<?php
session_start();
unset($_SESSION['updatemsg']);

if($_SESSION['adminlogin'] == true)
{
  $conn = mysqli_connect("localhost", "root", "","ip_project");
  $previoussubjectname = $_SESSION['subjectname'];
  
  if(isset($_REQUEST['Submit'])) 
  {
    $id = $_SESSION['sID'];
    $SubjectID = $_POST['SubjectID'];
    $SubjectName = $_POST['NewSubjectName'];
    $Department = $_POST['Department'];
    $Year = $_POST['Year'];
    $Semtype = $_POST['Sem'];
    $Foundedyear = $_POST['FoundedYear'];
    $ValidTill = $_POST['ValidTill'];
    $checkrun = mysqli_query($conn,"SELECT subjectid FROM subjectdetails WHERE id = '$id'");

    $checkrow = mysqli_num_rows($checkrun);

    if($checkrow == 1)
    {

        $updatesubject = mysqli_query($conn,"UPDATE subjectdetails SET subjectid ='$SubjectID', subjectname = '$SubjectName', department = '$Department', year = '$Year', semtype = '$Semtype', FoundedYear = '$Foundedyear', ValidTill = '$ValidTill', academicyear = '$Foundedyear-$ValidTill' WHERE id='$id'");

        if($updatesubject)
        {
            $updateteachersubjectname = mysqli_query($conn,"UPDATE teachersubject SET subjectname = '$SubjectName' WHERE subjectname = '$previoussubjectname'");
            $updatepdfsubject =  mysqli_query($conn,"UPDATE pdfmaterials SET subject_name = '$SubjectName' WHERE subject_name = '$previoussubjectname'");
            $updatepptsubject =  mysqli_query($conn,"UPDATE pptmaterials SET subject_name = '$SubjectName' WHERE subject_name = '$previoussubjectname'");
            $updatequizsubject =  mysqli_query($conn,"UPDATE quiz SET subject_name = '$SubjectName' WHERE subject_name = '$previoussubjectname'");
            $updatevideosubject =  mysqli_query($conn,"UPDATE video SET subject_name = '$SubjectName' WHERE subject_name = '$previoussubjectname'");
            $updateassignmentsubject =  mysqli_query($conn,"UPDATE assignment SET subject_name = '$SubjectName' WHERE subject_name = '$previoussubjectname'");

            $_SESSION['updatemsg'] = "Update Successfully";
            $_SESSION['sID'] = $id;
            $_SESSION['subjectid']=$SubjectID;
            $_SESSION['subjectname']=$SubjectName;
            $_SESSION['sdepartment']=$Department;
            $_SESSION['syear']=$Year;
            $_SESSION['ssemtype']=$Semtype;
            $_SESSION['sfoundedyear']=$Foundedyear;
            $_SESSION['svalidtill']=$ValidTill;
        }
        else
        {
            $_SESSION['updatemsg'] = "Updation Failed";

        }
    }
    else
    {
        $_SESSION['updatemsg'] = "ID Not Found";
    }
  }

  if(isset($_POST['Delete'])) 
  {

    $id = $_SESSION['sID'];
    $SubjectID = $_POST['SubjectID'];
    $SubjectName = $_POST['NewSubjectName'];
    $Department = $_POST['Department'];
    $Year = $_POST['Year'];
    $Semtype = $_POST['Sem'];
    $Foundedyear = $_POST['FoundedYear'];
    $ValidTill = $_POST['ValidTillHidden'];

    $checkrun = mysqli_query($conn,"SELECT subjectid,subjectname FROM subjectdetails WHERE id = $id;");
    $row = mysqli_num_rows($checkrun);
    $currentsubjectnamequery = mysqli_fetch_assoc($checkrun);
    $currentsubjectname = $currentsubjectnamequery['subjectname'];
    if ($row == 1) 
    {
      $deletesubject = mysqli_query($conn,"DELETE FROM subjectdetails WHERE id = '$id'");
  
          if($deletesubject)
          {
              $deleteteachersubjectname = mysqli_query($conn,"DELETE FROM teachersubject WHERE subjectname = '$currentsubjectname'");
              $deletepdfsubject =  mysqli_query($conn,"DELETE FROM pdfmaterials WHERE subject_name = '$currentsubjectname'");
              $deletepptsubject =  mysqli_query($conn,"DELETE FROM pptmaterials WHERE subject_name = '$currentsubjectname'");
              $deletequizsubject =  mysqli_query($conn,"DELETE FROM quiz WHERE subject_name = '$currentsubjectname'");
              $deletevideosubject =  mysqli_query($conn,"DELETE FROM video WHERE subject_name = '$currentsubjectname'");
              $deleteassignmentsubject =  mysqli_query($conn,"DELETE FROM assignment WHERE subject_name = '$currentsubjectname'");
              $_SESSION['updatemsg'] = "Delete Successfully";

          }
          else
          {
              $_SESSION['updatemsg'] = "Deletion Failed";
          }
    } 
    else 
    {
      $_SESSION['updatemsg']  = "ID Not Found";
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
  <title>Subject Details Form</title>
  <style>
    #Delete
    {
        margin-left:10%;
    }

    #back
    {
        position: relative;

    }

    input[type="button"] 
    {
        margin-left:35%;
        margin-right:35%;

        width: 30%;
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
    <div class="container" >
      <form class="Form" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
          <div class="row">
              <div class="col-25">
                <label for="SubjectID">Subject ID:</label>
              </div>
              <div class="col-75">
                <input name="SubjectID" value="<?php echo $_SESSION['subjectid']?>" type="text" pattern="^[A-Z0-9-_.]{4,12}$" size="30" id="SubjectID" placeholder="Enter the Subject ID (Letters in CAPS)"
                required />
            </div>
          </div>

          <div class="row">
              <div class="col-25">
                <label for="NewSubjectName">Subject Name:</label>
              </div>
              <div class="col-75">
                <input name="NewSubjectName" value="<?php echo $_SESSION['subjectname']?>" type="text" size="30" id="NewSubjectName" placeholder="Enter the Subject Name" required />
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
                    <option value="<?php echo $row_list['DeptName'];?>" <?php if($_SESSION['sdepartment']==$row_list['DeptName']){ echo "selected";}?>><?php echo $row_list['DeptName'];?></option>
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
                <option value="First Year" <?php if($_SESSION['syear']=="First Year"){ echo "selected";}?>>First Year</option>
                <option value="Second Year" <?php if($_SESSION['syear']=="Second Year"){ echo "selected";}?>>Second Year</option>
                <option value="Third Year" <?php if($_SESSION['syear']=="Third Year"){ echo "selected";}?>>Third Year</option>
                <option value="Fourth Year" <?php if($_SESSION['syear']=="Fourth Year"){ echo "selected";}?>>Fourth Year</option>
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
                <option value="Odd Sem" <?php if($_SESSION['ssemtype']=="Odd Sem"){ echo "selected";}?>>Odd Sem</option>
                <option value="Even Sem" <?php if($_SESSION['ssemtype']=="Even Sem"){ echo "selected";}?>>Even Sem</option>
              </select>
            </div>
          </div>

          <div class="row"  onclick="endvalidyear();">
              <div class="col-25">
                <label for="FoundedYear">Came in Year:</label>
              </div>
              <div class="col-75">
                <input name="FoundedYear" value="<?php echo $_SESSION['sfoundedyear']?>" type="number" id="FoundedYear" placeholder="Enter the Founded Year"
                required />
            </div>
          </div>

          <div class="row">
              <div class="col-25">
                <label for="ValidTill">Valid Till Year:</label>
              </div>
              <div class="col-75">
                <input name="ValidTill" value="<?php echo $_SESSION['svalidtill']?>" type="text" id="ValidTill" placeholder="Enter the Ending Year"
                required />
                <input name="ValidTillHidden" value="" type="hidden" id="ValidTillHidden"/>
            </div>
          </div>

          <div class="checkemail">
                <p class = "checkemailmsg <?php if(isset($_SESSION['updatemsg'])) echo "display";?>">
                    <?php 
                    if(isset($_SESSION['updatemsg']))
                        {
                            echo $_SESSION['updatemsg']; 
                        }
                    ?>
                </p>
            </div>
         
        <input name="Submit" type="submit" id="Submit" value="Update Subject" />
        <input name="Delete" type="submit" id="Delete" value="Delete Subject" />
        <a href="../PHP/subjectdetails.php"><input name="Back" type="button" id="back" value="Back" /></a>

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
  <script>
      function endvalidyear()
      {
        var startingyear = parseInt(document.getElementById("FoundedYear").value);
        var endingyear = parseInt(document.getElementById("ValidTill").value);
        if(endingyear<startingyear)
        {
            alert("Incorrect Ending Year");
        }
     }
  </script>
  <script src="https://kit.fontawesome.com/6d617ef3fb.js" crossorigin="anonymous"></script>
</body>

</html>