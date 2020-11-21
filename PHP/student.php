<?php
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
        input[type="submit"] {
            width: 50%;
            margin-left: 25%;
        }

        .title
        {
            display: flex;
            justify-content: center;
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
            margin: 15px auto;
            text-align: center;
            font-size: 18px;
            padding: 2rem;
        }

        @media only screen and (min-width: 651px) and (max-width:1024px) {

            input[type="submit"] {
                margin-left: 10%;
                width: 80%;
            }

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
        }

        @media screen and (max-width: 650px) {
            input[type="submit"] {
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
        }
    </style>
    <script type="text/javascript" src="../js/jqueryv3.5.1.js"></script>

</head>

<body>
    <header>
        <div class='title'>
            <h1><i class="fas fa-chalkboard-teacher"></i> Materials Detail Form</h1>
        </div>
    </header>
    <main>
        <br>
        <div class="container">
            <form class="Form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <span class="GetSubjectName" id="GetSubjectName">
                    <div class="row">
                        <div class="col-25">
                            <label for="Academic_Year">Academic Year:</label>
                        </div>
                        <div class="col-75">
                            <select name="Academic_Year" id="Academic_Year" required>
                                <option value="" disabled selected>Choose Academic Year</option>
                                <?php
                                     $conn = mysqli_connect("localhost", "root", "","ip_project");
 
                                $yearquery = mysqli_query($conn, "SELECT * FROM academicyear");
                                while ($row_list = mysqli_fetch_assoc($yearquery)) {

                                ?>
                                    <option value="<?php echo $row_list['academicyear']; ?>">
                                    <?php echo $row_list['academicyear']; ?></option>
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
                        <label for="Subject_Name">Subject Name:</label>
                    </div>
                    <div class="col-75">
                        <select name="Subject_Name" id="Subject_Name">
                            <option value="" disabled selected>Choose Subject</option>
                        </select>
                    </div>
                </div>

                <input name="Sub" type="submit" id="Submit" value="Submit" />
            </form>        
        </div>
        <?php

            if(isset($_POST['Sub'])) 
            {
                $conn = mysqli_connect("localhost", "root", "","ip_project");

                $Department = $_POST['Department'];
                $Year = $_POST['Year'];
                $Sem = $_POST['Sem'];
                $CAY  = $_POST['Academic_Year'];
                if(isset($_POST['Subject_Name']))
                {
                    $subject_name = $_POST['Subject_Name'];
                    $query1 = "SELECT * FROM pdfmaterials where subject_name='$subject_name' AND cay='$CAY'";
                    $query2 = "SELECT * FROM pptmaterials where subject_name='$subject_name' AND cay='$CAY'";
                    $query3 = "SELECT * FROM assignment where subject_name='$subject_name' AND cay='$CAY'";
                    $query4 = "SELECT * FROM quiz where subject_name='$subject_name' AND cay='$CAY'";
                    $query5 = "SELECT * FROM video where subject_name='$subject_name' AND cay='$CAY'";

                }
                else
                {
                    $query1 = "SELECT * FROM pdfmaterials where department='$Department' AND cay='$CAY' AND year='$Year'";
                    $query2 = "SELECT * FROM pptmaterials where department='$Department' AND cay='$CAY' AND year='$Year'";
                    $query3 = "SELECT * FROM assignment where department='$Department' AND cay='$CAY' AND year='$Year'";
                    $query4 = "SELECT * FROM quiz where department='$Department' AND cay='$CAY' AND year='$Year'";
                    $query5 = "SELECT * FROM video where department='$Department' AND cay='$CAY' AND year='$Year'";

                }
                $i = 0;
                $conn = mysqli_connect("localhost", "root", "","ip_project");

                $query_run = mysqli_query($conn, $query1);
        ?>
            <button id="PDFmaterials" type="button" class="collapsible">
                <h3>PDF Materials</h3>
            </button>
            <div class="content">
                <table>
                    <tr>
                        <th>Sr No</th>
                        <?php if(!isset($_POST['Subject_Name']))
                            {
                        ?>
                        <th>Subject Name</th>
                            <?php } ?> 
                        <th>Topic Name</th>       
                        <th>PDF File Name</th>
                        <th>Uploaded On</th>
                        <th>View</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($query_run)) {
                        $i++;

                    ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <?php if(!isset($_POST['Subject_Name']))
                                {
                                    ?>
                            <td><?php echo $row['subject_name'] ?></td>

                            <?php } ?>  
                            <td><?php echo $row['topicname'] ?></td>
                            <td><?php echo $row['file_name'] ?></td>
                            <td><?php echo $row['uploaded_on'] ?></td>
                            <td><a href="<?php echo $row['directory']; ?>" target="_blank"><button>View</button></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <?php
                  $conn = mysqli_connect("localhost", "root", "","ip_project");

            $query_run = mysqli_query($conn, $query2);
            $a = 0;
            ?>
            <button id="PPTmaterials" type="button" class="collapsible">
                <h3>PPT Materials</h3>
            </button>
            <div class="content">
                <table>
                    <tr>
                        <th>Sr No</th>
                        <?php if(!isset($_POST['Subject_Name']))
                            {
                        ?>
                        <th>Subject Name</th>
                            <?php } ?> 
                        <th>Topic Name</th>
                        <th>PPT File Name</th>
                        <th>Uploaded On</th>
                        <th>Download</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($query_run)) {
                        $a++;
                    ?>

                        <tr>
                            <td><?php echo $a; ?></td>
                            <?php if(!isset($_POST['Subject_Name']))
                                {
                                    ?>
                            <td><?php echo $row['subject_name'] ?></td>

                            <?php } ?>  
                            <td><?php echo $row['topicname'] ?></td>
                            <td><?php echo $row['file_name'] ?></td>
                            <td><?php echo $row['uploaded_on'] ?></td>
                            <td><a href="<?php echo $row['directory']; ?>" target="_blank"><button>Download</button></td>
                        </tr>
                    <?php
                    } ?>
                </table>
            </div>
            <?php
                  $conn = mysqli_connect("localhost", "root", "","ip_project");

            $assignpath = '../upload/assignments/';
            $updatestatus = "UPDATE assignment SET status = 0 WHERE deadline_on < now()";
            $updaterun = mysqli_query($conn, $updatestatus);
            $deletefile = "SELECT * FROM assignment where status = '0'";
            $deletefilerun = mysqli_query($conn, $deletefile);

            while ($row = mysqli_fetch_array($deletefilerun)) {
                $filename = $row['file_name'];
                unlink($assignpath . $filename);
            }
            $cronjob = "DELETE FROM `assignment` WHERE `deadline_on` < now()";
            $cronjob_run = mysqli_query($conn, $cronjob);
            $query_run = mysqli_query($conn, $query3);
            $b = 0;
            ?>
            <button id="Assignment" type="button" class="collapsible">
                <h3>Assignments</h3>
            </button>
            <div class="content">
                <table>
                    <tr>
                        <th>Sr No</th>
                        <?php if(!isset($_POST['Subject_Name']))
                            {
                        ?>
                        <th>Subject Name</th>
                            <?php } ?> 
                        <th>Topic Name</th>
                        <th>File Name</th>
                        <th>Uploaded Date</th>
                        <th>Deadline Date</th>
                        <th>View</th>
                        <th>Submission</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($query_run)) {
                        $b++;
                    ?>

                        <tr>
                            <td><?php echo $b; ?></td>
                            <?php if(!isset($_POST['Subject_Name']))
                                {
                                    ?>
                            <td><?php echo $row['subject_name'] ?></td>

                            <?php } ?>                             
                            <td><?php echo $row['topicname'] ?></td>
                            <td><?php echo $row['file_name'] ?></td>
                            <td><?php echo $row['uploaded_on'] ?></td>
                            <td><?php echo $row['deadline_on'] ?></td>
                            <td><a href="<?php echo $row['directory']; ?>" target="_blank"><button>Download</button></a></td>
                            <td><a href="<?php echo $row['submission']; ?>" target="_blank"><button>Submit</button></a></td>
                        </tr>
                    <?php
                    } ?>
                </table>
            </div>
            <?php
                  $conn = mysqli_connect("localhost", "root", "","ip_project");

            $cronjob = "DELETE FROM `quiz` WHERE `deadline_no` < now();";
            $cronjob_run = mysqli_query($conn, $cronjob);
            $query_run = mysqli_query($conn, $query4);
            $c = 0;
            ?>
            <button id="Quiz" type="button" class="collapsible">
                <h3>Quiz</h3>
            </button>
            <div class="content">
                <table>
                    <tr>
                        <th>Sr No</th>
                        <?php if(!isset($_POST['Subject_Name']))
                            {
                        ?>
                        <th>Subject Name</th>
                            <?php } ?> 
                        <th>Topic Name</th>
                        <th>Uploaded Date</th>
                        <th>Deadline Date</th>
                        <th>View</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($query_run)) {
                        $c++;
                    ?>

                        <tr>
                            <td><?php echo $c; ?></td>
                            <?php if(!isset($_POST['Subject_Name']))
                                {
                                    ?>
                            <td><?php echo $row['subject_name'] ?></td>

                            <?php } ?>  
                            <td><?php echo $row['topicname'] ?></td>
                            <td><?php echo $row['uploaded_on'] ?></td>
                            <td><?php echo $row['deadline_no'] ?></td>
                            <td><a href="<?php echo $row['URL']; ?>" target="_blank"><button>View</button></a></td>
                        </tr>
                    <?php
                    } ?>
                </table>
            </div>
            <?php
                  $conn = mysqli_connect("localhost", "root", "","ip_project");

            $query_run = mysqli_query($conn, $query5);
            $d = 0;
            ?>
            <button id="Video" type="button" class="collapsible">
                <h3>Videos</h3>
            </button>
            <div class="content">
                <table>
                    <tr>
                        <th>Sr No</th>
                        <?php if(!isset($_POST['Subject_Name']))
                            {
                        ?>
                        <th>Subject Name</th>
                            <?php } ?> 
                        <th>Topic Name</th>
                        <th>Uploaded Date</th>
                        <th>View</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($query_run)) {
                        $d++;
                    ?>

                        <tr>
                            <td><?php echo $d; ?></td>
                            <?php if(!isset($_POST['Subject_Name']))
                                {
                                    ?>
                            <td><?php echo $row['subject_name'] ?></td>

                            <?php } ?>  
                            <td><?php echo $row['topicname'] ?></td>
                            <td><?php echo $row['uploaded_on'] ?></td>
                            <td><a href="<?php echo $row['URL']; ?>" target="_blank"><button>View</button></a></td>
                        </tr>
                <?php
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#Academic_Year').change(function() {
                var stringacademicyear = $('#Academic_Year').val();
                var splityear = stringacademicyear.split("-");
                var academicyear = parseInt(splityear[0]);
                var selected;
                console.log(academicyear);
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


            $('#GetSubjectName').change(function() {
                var stringacademicyear = $('#Academic_Year').val();
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

                        $('#Subject_Name').find('option').not(':first').remove();

                        for (var i = 0; i < len; i++) {
                            var subjectid = response[i]['subjectid'];
                            var subjectname = response[i]['subjectname'];
                            $('#Subject_Name').append("<option value='" + subjectname + "'>" + subjectname + "</option>");
                        }
                    }

                });
            });

        });
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