<?php    
include("Connection.php");
session_start();
$user_ID = $_SESSION['id'];




if (isset ($_REQUEST['page'])){
	$pageno = $_REQUEST['page'];

}
else{
	$pageno  = 1;
}

$forOnePage = 5;
$endForOnePage = $pageno * $forOnePage;

if($pageno ==1){
	$start = 0;
}
else{
	$start = (($pageno-1) * $forOnePage) +1;
}


$sql4 = "SELECT * FROM all_users WHERE ID != $user_ID ";
$result4 = $conn -> query($sql4);
$total_friends = $result4->num_rows;
$total_pages = ceil($total_friends / $forOnePage);










//all users
$sql = "SELECT ID,PROFILE_NAME FROM all_users WHERE ID != $user_ID limit $start,$forOnePage";
$result = $conn->query($sql) ;

echo"<h1>My Friend System</h1>";
echo"<h2>add friends</h2>";



//add new friends
if( isset( $_POST['Add_Friend'] ) ) {


   
    
	$Add_friend_ID =$_REQUEST['idval'];

	//checking already in
	$sql2 = "SELECT ID FROM relations WHERE FRIEND_ID = $user_ID AND ID = $Add_friend_ID";
	$result2 = $conn->query($sql2) ;
	$numrows2 = mysqli_num_rows($result2);

	
?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>addfriends</title>
<link rel="stylesheet" href="css/center.css">
</head>
<body>
	<div class = "wrapper">
	
<?php
   


	//check number of rows
	if($numrows2>0){
		echo "<h3 style=color: red;text-align: center;>Alrady exists.</h3>";
	}
	else{
	$sql3 = "INSERT INTO relations VALUES($user_ID,$Add_friend_ID)";
    $result3 = $conn->query($sql3) ;
	if($result3){
		echo "<h3 style=color: red;text-align: center;>Succesfully added</h3>";
	}
	else{
		echo "<h3 color: blue;text-align: center;>Alrady exists.</h3>";
	}
}
}

?>




<table width="500" border="1" class= "table">
  <tbody>
   
<?php
    if($result->num_rows>0 ){
		


	while($rowval = $result-> fetch_array()){ ?>
    <tr>
	  
      <td><?php echo $rowval["PROFILE_NAME"] ?></td>
	  <td><form method='POST'>
                <input type=hidden name=idval value=<?php echo $rowval["ID"]?> >
                <input type=submit value="Add_Friend" name=Add_Friend >
                </form>
		</td>
    


		<!--Find mutual friends for each person-->
		<td><?php 
		$idvalue = $rowval["ID"];
		 $sql7 = "SELECT a.PROFILE_NAME FROM relations r INNER JOIN all_users a ON a.ID = r.ID WHERE r.FRIEND_ID = $user_ID OR r.FRIEND_ID= $idvalue  GROUP BY PROFILE_NAME HAVING COUNT(*) > 1";
		 $result7 = $conn->query($sql7) ; 
		 $numrows7 = mysqli_num_rows($result7);
		 echo $numrows7;
		
		
		?></td>
    </tr> 
	<?php  
	}
		
	}else{
		echo "No added Freinds";
	}
		?>
  </tbody>
</table>
<a style = "margin-right: 100px;" href="profile.php">profile page</a>
<?php 
    if($pageno >1 ){
   ?>
   <a style = "margin-right: 100px;" href="addfriend.php?page=<?php echo $pageno -1; ?>">Previous</a>
  <?php 
	}
?>

<a style = "margin-right: 100px;" href="addfriend.php?page=<?php echo $pageno +1; ?>">Next</a>

</div>
</body>
</html>