<?php
session_start();

if ($_SESSION['Loggedin'] == false) {
    header("location:../PHP/login.php");
} else {
    unset($_SESSION['Updatemsg']);
    $conn = mysqli_connect("localhost", "root", "", "ip_project");

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/loginformstyle.css">
        <title>Materials Detail Form</title>
        <link rel="icon" type="image/png" sizes="32x32" href="../images/circle-cropped.png">
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

            #PDFmaterials,
            #PPTmaterials,
            #Assignment,
            #Quiz,
            #Video {
                margin: 20px auto;
                text-align: center;
                font-size: 18px;
                padding: 2.2rem;
            }

            @media only screen and (min-width: 650px) and (max-width:1024px) {

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

            @media screen and (max-width: 650px) 
            {
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
        <script type="text/javascript" src="../js/jqueryv3.5.1.js"></script>

    </head>

    <body>
        <header>
            <div class='title'>
                <h1><i class="fas fa-chalkboard-teacher"></i> Materials Detail Form</h1>
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
            <br>
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

                    <input name="Submit" type="submit" id="Submit" value="View" />
                    <a href="../html/admin.php"><input name="Back" type="button" id="Back" value="Back" /></a>

                </form>
            </div>


            <?php
            $token = $_SESSION['token'];
            if (isset($_POST['Submit'])) {
                $Department = $_POST['Staff_Department'];
                $Year = $_POST['Year'];
                $Sem = $_POST['Sem'];
                $CAY  = $_POST['AcademicYear'];
                $subject_name = $_POST['Subject_Name'];
                $i = 0;
                $conn = mysqli_connect("localhost", "root", "","ip_project");

                $query = "SELECT * FROM pdfmaterials where subject_name='$subject_name' AND cay='$CAY' AND token='$token'";
                $query_run = mysqli_query($conn, $query);
            ?>
                <button id="PDFmaterials" type="button" class="collapsible">
                    <h3>PDF Materials</h3>
                </button>
                <div class="content">
                    <table>
                        <tr>
                            <th>Sr No</th>
                            <th>Topic Name</th>
                            <th>PDF File Name</th>
                            <th>Uploaded On</th>
                            <th>View</th>
                            <th>Update</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($query_run)) {
                            $i++;

                        ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['topicname'] ?></td>
                                <td><?php echo $row['file_name'] ?></td>
                                <td><?php echo $row['uploaded_on'] ?></td>
                                <td><a href="<?php echo $row['directory']; ?>#toolbar=0&navpanes=0" target="_blank"><button>View</button></a></td>
                                <td><a href="trail.php?id=<?php echo $row['id'] ?>&topicname=<?php echo $row['topicname'] ?>&filename=<?php echo $row['file_name'] ?>&type=<?php echo '.pdf' ?>&token=<?php echo $token ?>"><button>Update</button></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <?php
                      $conn = mysqli_connect("localhost", "root", "","ip_project");

                $query = "SELECT * FROM pptmaterials where subject_name='$subject_name' AND cay='$CAY' AND token='$token'";
                $query_run = mysqli_query($conn, $query);
                $a = 0;
                ?>
                <button id="PPTmaterials" type="button" class="collapsible">
                    <h3>PPT Materials</h3>
                </button>
                <div class="content">
                    <table>
                        <tr>
                            <th>Sr No</th>
                            <th>Topic Name</th>
                            <th>PPT File Name</th>
                            <th>Uploaded On</th>
                            <th>Download</th>
                            <th>Update</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($query_run)) {
                            $a++;
                        ?>

                            <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $row['topicname'] ?></td>
                                <td><?php echo $row['file_name'] ?></td>
                                <td><?php echo $row['uploaded_on'] ?></td>
                                <td><a href="<?php echo $row['directory']; ?>" target="_blank"><button>Download</button></td>
                                <td><a href="trail.php?id=<?php echo $row['id'] ?>&topicname=<?php echo $row['topicname'] ?>&filename=<?php echo $row['file_name'] ?>&type=<?php echo '.pptx' ?>&token=<?php echo $token ?>"><button>Update</button></a></td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                </div>
                <?php
                      $conn = mysqli_connect("localhost", "root", "","ip_project");

                $assignpath = '../upload/assignments/';
                $updatestatus = "UPDATE assignment SET status = 0 WHERE deadline_on < now() AND token='$token'";
                $updaterun = mysqli_query($conn, $updatestatus);
                $deletefile = "SELECT * FROM assignment where status = '0' AND token='$token'";
                $deletefilerun = mysqli_query($conn, $deletefile);

                while ($row = mysqli_fetch_array($deletefilerun)) {
                    $filename = $row['file_name'];
                    unlink($assignpath . $filename);
                }
                $cronjob = "DELETE FROM `assignment` WHERE `deadline_on` < now() AND token='$token'";
                $cronjob_run = mysqli_query($conn, $cronjob);
                $query = "SELECT * FROM assignment where subject_name='$subject_name' AND cay='$CAY' AND token='$token'";
                $query_run = mysqli_query($conn, $query);
                $b = 0;
                ?>
                <button id="Assignment" type="button" class="collapsible">
                    <h3>Assignments</h3>
                </button>
                <div class="content">
                    <table>
                        <tr>
                            <th>Sr No</th>
                            <th>Topic Name</th>
                            <th>File Name</th>
                            <th>Uploaded On</th>
                            <th>Deadline On</th>
                            <th>View</th>
                            <th>Update</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($query_run)) {
                            $b++;
                        ?>

                            <tr>
                                <td><?php echo $b; ?></td>
                                <td><?php echo $row['topicname'] ?></td>
                                <td><?php echo $row['file_name'] ?></td>
                                <td><?php echo $row['uploaded_on'] ?></td>
                                <td><?php echo $row['deadline_on'] ?></td>
                                <td><a href="<?php echo $row['directory']; ?>" target="_blank"><button>Download</button></a></td>
                                <td><a href="trail.php?id=<?php echo $row['id'] ?>&topicname=<?php echo $row['topicname'] ?>&filename=<?php echo $row['file_name'] ?>&type=<?php echo '.docx' ?>&token=<?php echo $token ?>&deadline=<?php echo $row['deadline_on'] ?>&link=<?php echo $row['submission'] ?>"><button>Update</button></a></td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                </div>
                <?php
                      $conn = mysqli_connect("localhost", "root", "","ip_project");

                $cronjob = "DELETE FROM `quiz` WHERE `deadline_no` < now() AND token='$token'";
                $cronjob_run = mysqli_query($conn, $cronjob);
                $query = "SELECT * FROM quiz where subject_name='$subject_name' AND cay='$CAY' AND token='$token'";
                $query_run = mysqli_query($conn, $query);
                $c = 0;
                ?>
                <button id="Quiz" type="button" class="collapsible">
                    <h3>Quiz</h3>
                </button>
                <div class="content">
                    <table>
                        <tr>
                            <th>Sr No</th>
                            <th>Topic Name</th>
                            <th>Uploaded On</th>
                            <th>Deadline On</th>
                            <th>View</th>
                            <th>Update</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($query_run)) {
                            $c++;
                        ?>

                            <tr>
                                <td><?php echo $c; ?></td>
                                <td><?php echo $row['topicname'] ?></td>
                                <td><?php echo $row['uploaded_on'] ?></td>
                                <td><?php echo $row['deadline_no'] ?></td>
                                <td><a href="<?php echo $row['URL']; ?>" target="_blank"><button>View</button></a></td>
                                <td><a href="trail.php?id=<?php echo $row['id'] ?>&topicname=<?php echo $row['topicname'] ?>&filename=<?php echo $row['URL'] ?>&type=<?php echo '.quiz' ?>&token=<?php echo $token ?>&deadline=<?php echo $row['deadline_no'] ?>&link=<?php echo $row['URL'] ?>"><button>Update</button></a></td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                </div>
                <?php
                      $conn = mysqli_connect("localhost", "root", "","ip_project");

                $query = "SELECT * FROM video where subject_name='$subject_name' AND cay='$CAY' AND token='$token'";
                $query_run = mysqli_query($conn, $query);
                $d = 0;
                ?>
                <button id="Video" type="button" class="collapsible">
                    <h3>Videos</h3>
                </button>
                <div class="content">
                    <table>
                        <tr>
                            <th>Sr No</th>
                            <th>Topic Name</th>
                            <th>Uploaded On</th>
                            <th>View</th>
                            <th>Update</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($query_run)) {
                            $d++;
                        ?>

                            <tr>
                                <td><?php echo $d; ?></td>
                                <td><?php echo $row['topicname'] ?></td>
                                <td><?php echo $row['uploaded_on'] ?></td>
                                <td><a href="<?php echo $row['URL']; ?>" target="_blank"><button>View</button></a></td>
                                <td><a href="trail.php?id=<?php echo $row['id'] ?>&topicname=<?php echo $row['topicname'] ?>&filename=<?php echo $row['URL'] ?>&type=<?php echo '.video' ?>&token=<?php echo $token ?>&link=<?php echo $row['URL'] ?>"><button>Update</button></a></td>
                            </tr>
                <?php
                        }
                    }
                } ?>
                    </table>
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
        <script src="https://kit.fontawesome.com/6d617ef3fb.js" crossorigin="anonymous"></script>
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
                    // console.log(subjectname);
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