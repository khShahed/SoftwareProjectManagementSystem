<?php
    function getDBData($str)        // DB quer function.....
    {
        $conn = mysqli_connect("localhost", "root", "","db_sdpm");
        $result = mysqli_query($conn, $str) or die(mysqli_error($conn));
        
        if(gettype($result) == "boolean")
            return $result;

        $arr = array();
        while($temp = mysqli_fetch_assoc($result))
        {
            $arr[] = $temp;
        }
        return json_encode($arr);
    }

    session_start();
    if(isset($_POST['getID']) && $_POST['getID']==1)  // get all id....
    {
        $sql = "select id from data_pm";
        echo getDBData($sql);
    }
    else if(isset($_SESSION['insertProject']) && $_SESSION['insertProject'] == 1)  // insert project details into table...
    {
        $startDate = $_SESSION['syear']."-".$_SESSION['smonth']."-".$_SESSION['sday'];
        $endDate = $_SESSION['eyear']."-".$_SESSION['emonth']."-".$_SESSION['eday'];

        $sql = "insert into `data_pm`(`id`, `name`, `descFile`, `fileType`, `fileSize`, `startDate`, `endDate`, `managerName`, `priority`, `status`) values ('".$_SESSION['pId']."','".$_SESSION['pName']."','".$_SESSION['fileLocation']."','".$_SESSION['fileType']."','".$_SESSION['fileSize']."','".$startDate."','".$endDate."','".$_SESSION['projManager']."','".$_SESSION['priority']."','".$_SESSION['status']."')";
        $rowsAffected = getDBData($sql);

        session_unset();
        echo $rowsAffected." project created<br/>";
        echo "<a href='Admin.html'>Home</a>";
    }
    else if(isset($_POST['getAll']) && $_POST['getAll'] == 1)
    {
        $sql = "select * from data_pm where managerName='".$_POST['userName']."'";
        echo getDBData($sql);
    }
    else if(isset($_POST['getProjName']) && $_POST['getProjName'] == 1)
    {
        $sql = "select name from data_pm";
        echo getDBData($sql);
    }
    else if(isset($_POST['getAllProjects']) && $_POST['getAllProjects']==1)
    {
        $sql = "select * from data_pm";
        echo getDBData($sql);
    }
    
?>