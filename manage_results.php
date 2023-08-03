<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="./css/form.css">
    <title>Dashboard</title>
</head>
<body>
    <!----------------------------------------------------------- HEADING ----------------------------------------------------------------------------->
    <center>
        <div class="container">
        <h1> STUDENT MANAGEMENT SYSTEM </h1>
        <h3><span class="learn"> ONE STOP SOLUTION! </span></h3>
     </center>
        </div>



<!----------------------------------------------------------- DROP DOWN ----------------------------------------------------------------------------->
<nav class="navbar bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
 
  <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="home.html">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="about.html"> About us </a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="login.php"> Admin Login </a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#"> Contact Us </a>
  </li>
  </ul>
</nav>

<br>
<br>
<br>


<!----------------------------------------------------------- DASHBOARD ----------------------------------------------------------------------------->
        
    <div class="title">
        <a href="dashboard.php"></a>
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
        <br><br>
        <form action="" method="post">
            <fieldset>
                <legend>Delete Result</legend>
                <?php
                    include('init.php');
                    include('session.php');
                    
                    $class_result=mysqli_query($conn,"SELECT `name` FROM `class`");
                        echo '<select name="class_name">';
                        echo '<option selected disabled>Select Class</option>';
                    while($row = mysqli_fetch_array($class_result)){
                        $display=$row['name'];
                        echo '<option value="'.$display.'">'.$display.'</option>';
                    }
                    echo'</select>'
                ?>
                <input type="text" name="rlno" placeholder="Roll No">
                <input type="submit" value="Delete">
            </fieldset>
        </form>
        <br><br>

        <form action="" method="post">
            <fieldset>
                <legend>Update Result</legend>
                
                <?php
                    $class_result=mysqli_query($conn,"SELECT `name` FROM `class`");
                        echo '<select name="class">';
                        echo '<option selected disabled>Select Class</option>';
                    while($row = mysqli_fetch_array($class_result)){
                        $display=$row['name'];
                        echo '<option value="'.$display.'">'.$display.'</option>';
                    }
                    echo'</select>'
                ?>
                
                <input type="text" name="rlno" placeholder="Roll No">
                <input type="text" name="s1" id="" placeholder="SubjectID 1.0">
                <input type="text" name="s2" id="" placeholder="SubjectID 2.0">
                <input type="text" name="s3" id="" placeholder="SubjectID 3.0">
                <input type="text" name="s4" id="" placeholder="SubjectID 4.0">
                <input type="text" name="s5" id="" placeholder="SubjectID 5.0">
                <input type="submit" value="Update">
            </fieldset>
        </form>
    </div>

    <!-- <div class="footer">
        <span>Designed & Coded By Jibin Thomas</span>
    </div> -->
    
</body>
</html>

<?php
    if(isset($_POST['class_name'],$_POST['rlno'])) {
        $class_name=$_POST['class_name'];
        $rlno=$_POST['rlno'];
        echo $class_name;
        echo $rlno;
        $delete_sql=mysqli_query($conn,"DELETE from `result` where `rlno`='$rlno' and `class`='$class_name'");
        if(!$delete_sql){
            echo '<script language="javascript">';
            echo 'alert("Not available")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Deleted")';
            echo '</script>';
        }
    }

    if(isset($_POST['rlno'],$_POST['s1'],$_POST['s2'],$_POST['s3'],$_POST['s4'],$_POST['s5'],$_POST['class'])) {
        $rlno=$_POST['rlno'];
        $class_name=$_POST['class'];
        $p1=(int)$_POST['s1'];
        $p2=(int)$_POST['s2'];
        $p3=(int)$_POST['s3'];
        $p4=(int)$_POST['s4'];
        $p5=(int)$_POST['s5'];

        $marks=$s1+$s2+$s3+$s4+$s5;
        $percentage=$marks/5;
        

        $sql="UPDATE `result` SET `s1`='$s1',`s2`='$s2',`s3`='$s3',`s4`='$s4',`s5`='$s5',`marks`='$marks',`percentage`='$percentage' WHERE `rlno`='$rlno' and `class`='$class_name'";
        $update_sql=mysqli_query($conn,$sql);

        if(!$update_sql){
            echo '<script language="javascript">';
            echo 'alert("Invalid Details")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Updated")';
            echo '</script>';
        }
    }
?>