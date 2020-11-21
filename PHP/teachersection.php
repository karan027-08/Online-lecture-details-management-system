<?php
session_start();
unset($_SESSION['tchmsg']);

if ($_SESSION['adminlogin'] == true) 
{
    $conn = mysqli_connect("localhost", "root", "", "ip_project");

    if(isset($_REQUEST['Submit'])) 
    {
        $SubjectName = $_POST['SubjectName'];
        $AcademicYear = $_POST['AcademicYear'];
        $TeacherID = $_POST['TeacherIDHidden'];
        $TeacherName = $_POST['TeacherName'];

        $checkrun = mysqli_query($conn, "SELECT * FROM teachersubject WHERE subjectname = '$SubjectName' AND collegeid = '$TeacherID' AND academicyear = '$AcademicYear'");

        $checkrow = mysqli_num_rows($checkrun);

        if ($checkrow == 0) 
        {

            $assignteacher = mysqli_query($conn, "INSERT INTO teachersubject (collegeid,teachername,subjectname,academicyear) VALUES ('$TeacherID','$TeacherName','$SubjectName','$AcademicYear')");

            if ($assignteacher) {
                $_SESSION['tchmsg'] = "Teacher Assigned";
            }
        } 
        else 
        {
            $_SESSION['tchmsg'] = "Already Assigned";
        }
    }

    if(isset($_POST['Delete']))
    { 
    $id = $_GET['id'];
    $deleteteachersubject = mysqli_query($conn,"DELETE FROM teachersubject WHERE id = $id");
    if($deleteteachersubject)
        {
            $_SESSION['tchmsg'] = "Deleted Successfully";
        }
    else
        {
            $_SESSION['tchmsg'] = "Deletion Failed";
        }
    }
    mysqli_close($conn);
} 
else {
    if ($_SESSION['adminusername'] == false) {
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
    <title>Subject Assign Form</title>
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
            line-height:25px;
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

        #Teacherlist {
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
    <script src="https://kit.fontawesome.com/6d617ef3fb.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/jqueryv3.5.1.js"></script>

</head>

<body>
    <header>
        <div class="title">
            <h1>
                <i class="fas fa-chalkboard-teacher"></i> Subject Teacher Assign Form
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
                <span class="GetSubjectName" id="GetSubjectName">
                    <div class="row">
                        <div class="col-25">
                            <label for="AcademicYear">Academic Year:</label>
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
                            <label for="Department">Department:</label>
                        </div>
                        <div class="col-75">
                            <select name="Department" id="Department" required>
                                <option value="" disabled selected>Enter your Department</option>
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
                </span>

                <div class="row">
                    <div class="col-25">
                        <label for="SubjectName">Subject Name:</label>
                    </div>
                    <div class="col-75">
                        <select name="SubjectName" id="SubjectName" required>
                            <option value="" disabled selected>Choose Subject</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="TeacherName">Assign Teacher:</label>
                    </div>
                    <div class="col-75">
                        <select name="TeacherName" id="TeacherName" required>
                            <option value="" disabled selected>Assign Teacher Name</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="TeacherID">Assign Teacher:</label>
                    </div>
                    <div class="col-75" class="inputfield">
                    <input name="TeacherID" type="text" size="30" id="TeacherID" disabled placeholder="Teacher ID"
                        required />
                    <input name="TeacherIDHidden" type="hidden" size="30" id="TeacherIDHidden"  placeholder="Teacher ID"
                    required />
                    </div>
                </div>

                <div class="checkemail">
                    <p class="checkemailmsg <?php if (isset($_SESSION['tchmsg'])) echo "display"; ?>">
                        <?php
                        if (isset($_SESSION['tchmsg'])) {
                            echo $_SESSION['tchmsg'];
                        }
                        ?>
                    </p>
                </div>

                <input name="Submit" type="submit" id="Submit" value="Assign Teacher" />
                <a href="../html/details.php"><input name="Back" type="button" id="Back" value="Back" /></a>

        </div>
        </form>
        </div>
        <?php
        $i = 0;
        $conn = mysqli_connect("localhost", "root", "","ip_project");

        $query = "SELECT a.id,a.teachername, a.subjectname, b.department, b.year, b.semtype, a.academicyear FROM teachersubject a, subjectdetails b WHERE a.subjectname = b.subjectname ORDER by b.department,a.academicyear DESC";
        $query_run = mysqli_query($conn, $query);
        ?>
        <button id="Teacherlist" type="button" class="collapsible">
            <h3>Teacher Subject List</h3>
        </button>
        <div class="content">
            <table>
                <tr>
                    <th>Sr No</th>
                    <th>Teacher Name</th>
                    <th>Subject Name</th>
                    <th>Department</th>
                    <th>Year</th>
                    <th>Semtype</th>
                    <th>Academic Year</th>
                    <th>Delete</th>
                </tr>
                <?php
                if(mysqli_num_rows($query_run) > 0) 
                {

                while ($row = mysqli_fetch_array($query_run)) {
                    $i++;
                ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['teachername'] ?></td>
                        <td><?php echo $row['subjectname'] ?></td>
                        <td><?php echo $row['department'] ?></td>
                        <td><?php echo $row['year'] ?></td>
                        <td><?php echo $row['semtype'] ?></td>
                        <td><?php echo $row['academicyear'] ?></td>
                        <td><form method = "POST" action="teachersection.php?id=<?php echo $row['id']?>"><button name="Delete">Delete</button></form></td>
                    </tr>
                <?php
                }
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#AcademicYear').change(function() {
                var stringacademicyear = $('#AcademicYear').val();
                var splityear = stringacademicyear.split("-");
                var academicyear = parseInt(splityear[0]);
                $.ajax({
                    url: 'getdetails.php',
                    method: 'POST',
                    data: {
                        academicyear: academicyear
                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = response.length;

                        $('#Department').find('option').not(':first').remove();

                        for (var i = 0; i < len; i++) {
                            var departmentid = response[i]['departmentid'];
                            var departmentname = response[i]['departmentname'];
                            $('#Department').append("<option value='" + departmentname + "'>" + departmentname + "</option>");
                        }
                    }
                });

            });

            $('#Department').change(function() {
                var deptname = $('#Department').val();
                console.log(deptname);
                $.ajax({
                    url: 'getdetails.php',
                    method: 'POST',
                    data: {
                        Dept: deptname
                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = response.length;

                        $('#TeacherName').find('option').not(':first').remove();

                        for (var i = 0; i < len; i++) {
                            var teacherid = response[i]['teacherid'];
                            var teachername = response[i]['teachername'];
                            $('#TeacherName').append("<option value='" + teachername + "'>" + teachername + "</option>");
                        }
                    }

                });
            });

            $('#GetSubjectName').change(function() {
                var stringacademicyear = $('#AcademicYear').val();
                var splityear = stringacademicyear.split("-");
                var startingyear = parseInt(splityear[0]);
                var endingyear = parseInt(splityear[1]);
                var deptname = $('#Department').val();
                var year = $('#Year').val();
                var semtype = $('#Semtype').val();
                console.log(startingyear,endingyear,deptname,year,semtype);
                $.ajax({
                    url: 'getdetails.php',
                    method: 'POST',
                    data: {
                        Department: deptname,
                        Year: year,
                        Sem: semtype,
                        StartingYear: startingyear,
                        EndingYear: endingyear
                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = response.length;

                        $('#SubjectName').find('option').not(':first').remove();

                        for (var i = 0; i < len; i++) {
                            var subjectid = response[i]['subjectid'];
                            var subjectname = response[i]['subjectname'];
                            $('#SubjectName').append("<option value='" + subjectname + "'>" + subjectname + "</option>");
                        }
                    }

                });
            });

            $('#TeacherName').change(function() {
                var teacheridfield = document.getElementById("#TeacherID");
                var deptname = $('#Department').val();
                var teachername = $('#TeacherName').val();
                console.log(teachername);
                $.ajax({
                    url: 'getdetails.php',
                    method: 'POST',
                    data: {
                        Depart: deptname,
                        TeacherName:teachername
                    },
                    dataType: 'json',
                    success: function(response) {
                        var len = response.length;

                        for (var i = 0; i < len; i++) 
                        {

                        var teacherid = $.parseJSON(response[i]['teacherid']);
                        var teacherstring = JSON.stringify(teacherid);
                        console.log(teacherstring);
                        $("#TeacherIDHidden").val(teacherstring);
                        $("#TeacherID").val(teacherstring);
                     }
                    }
                    
                });
            });

           
        });
    </script>
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