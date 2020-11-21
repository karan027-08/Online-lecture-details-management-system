<?php
session_start();

if(isset($_GET['changetype']))
{
    $changetype = $_GET['changetype'];
    $_SESSION['changetype'] = $changetype;
    if($changetype=='admindept')
    {
    
        $id = $_GET['id'];
        $_SESSION['dID']=$id;
        
        $deptid = $_GET['deptid'];
        $_SESSION['deptid'] = $deptid;
    
        $deptname = $_GET['deptname'];
        $_SESSION['deptname'] = $deptname;
    
        $deptyear = $_GET['deptyear'];
        $_SESSION['deptyear'] = $deptyear;

        header("location:../PHP/updatedepartment.php");
    }
    else if($changetype=='adminsubject')
    {
        $id = $_GET['id'];
        $_SESSION['sID']=$id;

        $subjectid = $_GET['subjectid'];
        $_SESSION['subjectid']=$subjectid;

        $subjectname = $_GET['subjectname'];
        $_SESSION['subjectname']=$subjectname;

        $department = $_GET['department'];
        $_SESSION['sdepartment']=$department;

        $year = $_GET['year'];
        $_SESSION['syear']=$year;

        $semtype = $_GET['semtype'];
        $_SESSION['ssemtype']=$semtype;

        $foundedyear = $_GET['foundedyear'];
        $_SESSION['sfoundedyear']=$foundedyear;

        $validtill = $_GET['validtill'];
        $_SESSION['svalidtill']=$validtill;

        header("location:../PHP/updatesubjectdetails.php");

    }
}

else
{
    $type = $_GET['type'];
    $_SESSION['type'] = $type;
    if($type == '.pdf' || $type == '.pptx' || $type == '.video')
    {
        $id = $_GET['id'];
        $_SESSION['updateid'] = $id;

        $topicname = $_GET['topicname'];
        $_SESSION['updatetopicname'] = $topicname;

        $filename = $_GET['filename'];
        $_SESSION['updatefilename'] = $filename;
        
        $token = $_GET['token'];
        $_SESSION['materialtoken'] = $token;
    }
    else
    {
         $id = $_GET['id'];
        $_SESSION['updateid'] = $id;

        $topicname = $_GET['topicname'];
        $_SESSION['updatetopicname'] = $topicname;

        $filename = $_GET['filename'];
        $_SESSION['updatefilename'] = $filename;
        
        $token = $_GET['token'];
        $_SESSION['materialtoken'] = $token;
        
        $deadline = $_GET['deadline'];
        $_SESSION['updatedeadline'] = $deadline;
    
        $link = $_GET['link'];
        $_SESSION['link']=$link;
    }
    header("location:updatematerial.php");
}

?>