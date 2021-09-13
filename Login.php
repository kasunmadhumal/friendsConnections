<?php

	include("Connection.php");
	//get values from form 
	if(isset($_REQUEST['submit'])){
		
		$username = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		
	    $sql = "SELECT * FROM all_users WHERE USER_EMAIL = '$username' AND PASSWORD = '$password' ";
        $result = $conn->query($sql) ;
        $numrows = mysqli_num_rows($result);
	 if($numrows >0)
            {
               header("Location: profile.php");
		 
		       //To find ID of the user
               $sql1 = "SELECT ID FROM all_users WHERE USER_EMAIL = '$username' ";
               $result1 = $conn -> query($sql1);
               $ID = $result1->fetch_assoc();
               $id = $ID["ID"];
		       session_start();
               $_SESSION['id']=$id;
            }
        else
		{ 
			echo "invalid username or password";
		}
		
	}
     
    


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login Page</title>
<link rel="stylesheet" href="css/Login.css">
</head>

<body>
	

	 <div class = wrapper>
  <div class = "maintopics">
	<h1>My Friend System</h1>
	
	</div>
	
    
	<form name = "form1" method = "post"  class = "dataEntering" action="<?php $_SERVER['PHP_SELF']; ?>">
		<h2>Login Page</h2>
		 
		
		<div class = "mail">
		<label for="email" >Email</label>
		<input type="Email" name="email" email id= "email" placeholder="Enter your Email"><br>
		</div>
		
		
		<div class = "pword">
		<label for="password">Password</label>
		<input type="password" name= "password" id="password" placeholder="Enter password"><br>
		</div>
		
	
		
		<div class = "buttons">
		<input type="submit" name="submit" value="Login" id="fsubmit">
		<button onclick="document.getElementById('email','password').value = ''" id="clearbutton">Clear</button>
		</div>
	
	</form>
  
	
	</div>
</body>
</html>