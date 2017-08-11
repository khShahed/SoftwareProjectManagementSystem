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
    if(isset($_POST['getAll']) && $_POST['getAll'] == 1)     // get all data from data_admin table;
    {
        $sql = "select * from data_admin";
        echo getDBData($sql);
    }

    else if(isset($_SESSION['insert']) && $_SESSION['insert'] == 1)    // adds new user from admin page;
    {
        $dob = $_SESSION['year']."-".$_SESSION['month']."-".$_SESSION['day'];
        $sql = "insert into `data_admin`(`id`, `userName`, `password`, `DOB`, `contact`, userType) values ('".$_SESSION['id']."','".$_SESSION['userName']."','".md5($_SESSION['password'])."','".$dob."','".$_SESSION['contact']."','".$_SESSION['userType']."')";
        $rowsAffected = getDBData($sql);
        session_unset();
        echo $rowsAffected." rows affected";
        echo "<a href='Admin.html'>Home</a>";
    }
    else if(isset($_SESSION['loginCheck']) && $_SESSION['loginCheck'] == 1)    // get info to let user sign in;
    {
        $sql = "select password, usertype from data_admin where userName = '".$_SESSION['name']."'";
        $row = getDBData($sql);
        
        $value = json_decode($row);

        if(sizeof($value) == 0)
        {
            echo "<div align='center'>
                        no user with such username is found<br/>
                        <a href='login.html'>Back</a>
                  </div>";
            session_unset();
            header("lcoation: login.html");
        }
        else{
            if($_SESSION['pass'] == $value[0]->password)
            {
                if($_SESSION['type'] == $value[0]->usertype && $value[0]->usertype == "admin")
                {
                    setcookie("userName", $_SESSION['name'], time()+5000);
                    setcookie("userType", "admin", time()+5000);
                    
                    echo "<pre>";
                    print_r($GLOBALS);
                    echo "</pre>";
                    session_unset();
                    header("location: Admin.html");
                }
                else if($_SESSION['type'] == $value[0]->usertype && $value[0]->usertype == "projectManager")
                {
                    setcookie("userName", $_SESSION['name'], time()+5000);
                    setcookie("userType", "projectManager", time()+5000);
                    
                    echo "<pre>";
                    print_r($GLOBALS);
                    echo "</pre>";
                    session_unset();
                    header("location: ProjectManager.html");
                }
                else{
                    echo "<div align='center'>
                        make sure the user type is correct<br/>
                        <a href='login.html'>Back</a>
                  </div>";
                }
            }
            else{
                echo "password not correct";
                echo "<br/><a href='login.html'>Back</a>";
            }
        }
    }
    else if(isset($_POST['delete']) && $_POST['delete'] == 1)       // delete entry...
    {
        $sql = "delete from data_admin where id='".$_POST['id']."'";
        $rowsAffected = getDBData($sql);
        echo $rowsAffected." rows affected";
        echo "<br/><a href='Admin.html'>Go Home</a>";
        session_unset();
    }
    else if(isset($_SESSION['update']) && $_SESSION['update']==1)   // update entries...
    {
        $ok=1;
        foreach($_POST as $k => $val)
		{
			if(strlen($_POST[$k]) == 0)
			{
				echo "the $k field must not be empty</br>";
				echo "<hr/>";
                $ok=0;
			}
		}
        $id = $_POST['id'];
        if(!is_numeric($id)){
            echo "id must be numerical";
            $ok=0;
        }
        $val = $_POST['contact'];
        if(!is_numeric($val)){
            echo "contact must be a phone number";
            $ok=0;
        }
        
        if($ok == 0)
            echo "<br/><a href='Admin.html'>Go Home</a>";
        else
        {
            $sql = "update data_admin set";
            $x=0;
            foreach($_POST as $k=>$v)
            {
                $sql .= " ".$k."= '".$v."' ";
                if($x!=4)
                    $sql.=',';
                $x++;
            }
            $sql.="where data_admin.id='".$_POST['id']."'";
            $row = json_decode(getDBData($sql));
            echo $row."entries updated<br/>";
            echo "<a href='Admin.html'>Go Home</a>";   
        }
    }
    else if(isset($_POST['getPMFromAdmin']) && $_POST['getPMFromAdmin']==1) // get pm names....
    {
        $sql = "select userName from data_admin where userType='projectManager'";
        echo getDBData($sql);
    }
    else if(isset($_POST['getDevFromAdmin']) && $_POST['getDevFromAdmin']==1) // get pm names....
    {
        $sql = "select userName from data_admin where userType='softwareDeveloper'";
        echo getDBData($sql);
    }
    
?>