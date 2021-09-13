<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/signup.css">
<title>Signup page</title>
</head>

<body>
	<?php
	include("Connection.php");
	//get values from form 
	if(isset($_REQUEST['submit'])){
		
		$email = $_REQUEST['email'];
		$profileName = $_REQUEST['profilename'];
		$password = $_REQUEST['password'];
		$CPassword = $_REQUEST['conformPW'];
		
		if($password == $CPassword){
			
	    $sql = "INSERT INTO all_users(USER_EMAIL,PASSWORD,PROFILE_NAME) VALUES('".$email."','".$password."','".$profileName."')";
        $result = $conn->query($sql) ;
			
	
			if($result){
			echo "<h4>succesfully registered...<h4>";
			header("Location: Home.html");
		}
			else{
				echo "<h4>Erro....<h4>";
			}
        
		}
		
		
	}
			
			?>
		


	
  <div class = wrapper>
  <div class = "maintopics">
	<h1>My Friend System</h1>
	<h3>Registration Page</h3>
	</div>
	

	<form method = "post"  class = "dataEntering" action="<?php $_SERVER['PHP_SELF']; ?>">
		
	
		
		<div class = "mail">
		<label for="email" >Email</label>
		<input type="Email" name= email id= "email" placeholder="Enter your Email"><br>
		</div>
		
		<div class = "uname">
		<label for= "username">Profile Name</label>
		<input type="text" name="profilename" id="profilename" placeholder="Enter your Username"><br>
		</div>
		
		<div class = "pword">
		<label for="password">Password</label>
		<input type="password" name= "password" id="password" placeholder="Enter password"><br>
		</div>
		
		<div class = "cpassword">
		<label for="confirmPW">Conform Password</label>
		<input type="password" name="conformPW" id="conformPW" placeholder="Conform your password"><br>
		</div>
		
		<div class = "buttons">
		<input type="submit" name="submit" value="submit" id="fsubmit">
		<button onclick="document.getElementById('email','profilename','password','conformPW').value = ''" id="clearbutton">Clear</button>
		</div>
	
	</form>
  
	
	</div>
</body>
</html>
