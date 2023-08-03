<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="./css/form.css">
	<title>Results</title>
</head>
<body>

	<div class="title">
        <a href="dashboard.php"><img src="./images/logo1.png" alt="" class="logo"></a>
        <span class="heading">Dashboard</span>
        <a href="logout.php" style="color: white"><span class="fa fa-sign-out fa-2x">Logout</span></a>
    </div>

    <div class="nav">
        <ul>
            <li class="dropdown" onclick="toggleDisplay('1')">
                <a href="" class="dropbtn">Classes &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="1">
                    <a href="add_classes.php">Add Class</a>
                    <a href="manage_classes.php">Manage Class</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('2')">
                <a href="#" class="dropbtn">Students &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="2">
                    <a href="add_students.php">Add Students</a>
                    <a href="manage_students.php">Manage Students</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('3')">
                <a href="#" class="dropbtn">Results &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="3">
                    <a href="add_results.php">Add Results</a>
                    <a href="manage_results.php">Manage Results</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="main">
        <form action="" method="post">
            <fieldset>
            <legend> Enter Marks </legend>

</body>
</html>


<?php
                    include("init.php");
                    include("session.php");

                    $select_class_query="SELECT `name` from `class`";
                    $class_result=mysqli_query($conn,$select_class_query);
                    //select class
                    echo '<select name="class_name">';
                    echo '<option selected disabled>Select Class</option>';
                    
                        while($row = mysqli_fetch_array($class_result)) {
                            $display=$row['name'];
                            echo '<option value="'.$display.'">'.$display.'</option>';
                        }
                    echo'</select>';                      
                ?>

                <input type="text" name="rlno" placeholder="Roll No">
                <input type="text" name="s1" id="" placeholder="SubjectID 1.0">
                <input type="text" name="s2" id="" placeholder="SubjectID 2.0">
                <input type="text" name="s3" id="" placeholder="SubjectID 3.0">
                <input type="text" name="s4" id="" placeholder="SubjectID 4.0">
                <input type="text" name="s5" id="" placeholder="SubjectID 5.0">
                <input type="submit" value="Proceed">
            </fieldset>
        </form>
    </div>

</body>
</html>

<?php
    if(isset($_POST['rlno'],$_POST['s1'],$_POST['s2'],$_POST['s3'],$_POST['s4'],$_POST['s5']))
    {
        $rlno=$_POST['rlno'];
        if(!isset($_POST['class_name']))
            $class_name=null;
        else
            $class_name=$_POST['class_name'];
        $s1=(int)$_POST['s1'];
        $s2=(int)$_POST['s2'];
        $s3=(int)$_POST['s3'];
        $s4=(int)$_POST['s4'];
        $s5=(int)$_POST['s5'];

        $marks=$s1+$s2+$s3+$s4+$s5;
        $percentage=$marks/5;

        // validation
        if (empty($class_name) or empty($rlno) or $s1>100 or  $s2>100 or $s3>100 or $s4>100 or $s5>100 or $s1<0 or  $s2<0 or $s3<0 or $s4<0 or $s5<0 ) {
            if(empty($class_name))
                echo '<p class="error">Please select class</p>';
            if(empty($rlno))
                echo '<p class="error">Please enter your Roll Number</p>';
            if(preg_match("/[a-z]/i",$rlno))
                echo '<p class="error">Please enter a valid Roll number</p>';
            if(preg_match("/[a-z]/i",$marks))
                echo '<p class="error">Please enter valid marks</p>';
            if($s1>100 or  $s2>100 or $s3>100 or $s4>100 or $s5>100 or $s1<0 or  $s2<0 or $s3<0 or $s4<0 or $s5<0)
                echo '<p class="error">Please enter valid marks</p>';
            exit();
        }

        $name=mysqli_query($conn,"SELECT `name` FROM `students` WHERE `rlno`='$rlno' and `class_name`='$class_name'");
        while($row = mysqli_fetch_array($name)) {
            $display=$row['name'];
            echo $display;
         }

        $sql="INSERT INTO `result` (`name`, `rlno`, `class`, `s1`, `s2`, `s3`, `s4`, `s5`, `marks`, `percentage`) VALUES ('$display', '$rlno', '$class_name', '$s1', '$s2', '$s3', '$s4', '$s5', '$marks', '$percentage')";
        $sql=mysqli_query($conn,$sql);

        if (!$sql) {
            echo '<script language="javascript">';
            echo 'alert("Invalid Details")';
            echo '</script>';
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Successful")';
            echo '</script>';
        }
    }
?>