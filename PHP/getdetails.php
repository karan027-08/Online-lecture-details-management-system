<?php
$conn = mysqli_connect("localhost", "root", "", "ip_project");

if(isset($_POST['academicyear']))
{
    $academicyear = $_POST['academicyear'];
    $getdepartment =  mysqli_query($conn, "SELECT DeptID,DeptName from department WHERE DeptYear <= '$academicyear'");
    $departmentarray = array();
    while($row = mysqli_fetch_assoc($getdepartment))
    {
        $departmentid = $row['DeptID'];
        $departmentname = $row['DeptName'];
    
        $departmentarray[] = array("departmentid"=>$departmentid,"departmentname"=>$departmentname);
    }
    echo json_encode($departmentarray);
}

if(isset($_POST['Depart']) && isset($_POST['TeacherName']) )
{
    $department = $_POST['Depart'];
    $teachername = $_POST['TeacherName'];
    $user = mysqli_query($conn, "SELECT CollegeID from user WHERE Department = '$department' AND Name = '$teachername'");

    $userarray = array();
    while($row = mysqli_fetch_assoc($user))
    {
        $teacherid = $row['CollegeID'];
        $userarray[] = array("teacherid"=>$teacherid);
    }
    echo json_encode($userarray);
}

if(isset($_POST['Dept']))
{
    $department = $_POST['Dept'];

    $user = mysqli_query($conn, "SELECT CollegeID,Name from user WHERE Department = '$department' AND status='active'");

    $userarray = array();
    while($row = mysqli_fetch_assoc($user))
    {
        $teacherid = $row['CollegeID'];
        $teachername = $row['Name'];
        $userarray[] = array("teacherid"=>$teacherid,"teachername"=>$teachername);
    }
    echo json_encode($userarray);
}

if(isset($_POST['Department']) && isset($_POST['Year']) && isset($_POST['Sem']) && isset($_POST['StartingYear']) && isset($_POST['EndingYear']))
{
    $startingyear = $_POST['StartingYear'];
    $endingyear = $_POST['EndingYear'];
    $department = $_POST['Department'];
    $year = $_POST['Year'];
    $semtype = $_POST['Sem'];

    $getsubjectname = mysqli_query($conn, "SELECT subjectid,subjectname from subjectdetails WHERE department = '$department' AND year = '$year' AND semtype = '$semtype' AND FoundedYear<='$startingyear' AND ValidTill>='$endingyear'");

    $subjectarray = array();
    while($row = mysqli_fetch_assoc($getsubjectname))
    {
        $subjectid = $row['subjectid'];
        $subjectname = $row['subjectname'];
        $subjectarray[] = array("subjectid"=>$subjectid,"subjectname"=>$subjectname);
    }
    echo json_encode($subjectarray);
}

if(isset($_POST['department']) && isset($_POST['year']) && isset($_POST['semtype']) && isset($_POST['startingyear']) && isset($_POST['endingyear']) && isset($_POST['collegeid']))
{
    $startingyear = $_POST['startingyear'];
    $endingyear = $_POST['endingyear'];
    $department = $_POST['department'];
    $year = $_POST['year'];
    $semtype = $_POST['semtype'];
    $collegeid = $_POST['collegeid'];

    $getsubjectname = mysqli_query($conn, "SELECT b.subjectid,a.subjectname from teachersubject a, subjectdetails b WHERE a.subjectname = b.subjectname AND b.department = '$department' AND b.year = '$year' AND b.semtype = '$semtype' AND a.collegeid = '$collegeid' AND a.academicyear = '$startingyear-$endingyear'");

    $subjectarray = array();
    while($row = mysqli_fetch_assoc($getsubjectname))
    {
        $subjectid = $row['subjectid'];
        $subjectname = $row['subjectname'];
        $subjectarray[] = array("subjectid"=>$subjectid,"subjectname"=>$subjectname);
    }
    echo json_encode($subjectarray);
}

mysqli_close($conn);

?>