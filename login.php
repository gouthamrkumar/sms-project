<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/login.css">
	<link rel="icon" href="favicon.icon">
	<link href="https://fonts.googleapis.com/css?family=Merriweather|Nunito| Nunito Sans" rel="stylesheet">
	<title> Index Page </title>
</head>
<body>

<!----------------------------------------------------------- HEADING ----------------------------------------------------------------------------->

	<div class = "title">
		<h1> STUDENT MANAGEMENT SYSTEM </h1>
     	<h3><span class="learn"> ONE STOP SOLUTION! </span></h3>
	</div>

<!----------------------------------------------------------- Admin Login ----------------------------------------------------------------------------->


	<div class="main">
		<div class="login">
			<form action="" method="post" name="login">
				<fieldset>
                    <legend class="heading">Admin Login</legend>
                    <input type="text" name="userid" placeholder="Email/Username" autocomplete="off">
                    <input type="password" name="password" placeholder="Password" autocomplete="off">
                    <input type="submit" value="Login">
                </fieldset>
			</form>
			
		</div>
		
	</div>

<!----------------------------------------------------------- Admin Login ----------------------------------------------------------------------------->

	<div class="search">
		<form action="./student.php" method="get">
			<fieldset>
				<legend class="heading"> For Students </legend>
					<?php
						include ('init.php');

						$class_result=mysqli_query($conn, "SELECT 'name' FROM 'class' ");
						echo '<select name="class">';
						echo '<option selected disabled>Select Class</option>';
                        while($row = mysqli_fetch_array($class_result)){
                            $display=$row['name'];
                            echo '<option value="'.$display.'">'.$display.'</option>';
                        }
                        echo'</select>'
                    ?>
                    <input type="text" name="rn" placeholder="Roll No">
                    <input type="submit" value="Get Result">
			</fieldset>
			
		</form>
		
	</div>
</div>

</body>
</html>

<!----------------------------------------------------- Session record php ----------------------------------------------------------------------------->


<?php
    include("init.php");
    session_start();

    if (isset($_POST["userid"],$_POST["password"]))
    {
        $username=$_POST["userid"];
        $password=$_POST["password"];
        $sql = "SELECT userid FROM admin_login WHERE userid='$username' and password = '$password'";
        $result=mysqli_query($conn,$sql);

        // $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result);
        
        if($count==1) {
            $_SESSION['login_user']=$username;
            header("Location: dashboard.php");
        }else {
            echo '<script language="javascript">';
            echo 'alert("Invalid Username or Password")';
            echo '</script>';
        }
        
    }
?>