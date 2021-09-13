<?php
include("Connection.php");
session_start();
$id_quary = $_SESSION['id'];


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


$sql7 = "SELECT * FROM relations r INNER JOIN all_users a ON a.ID = r.ID WHERE r.FRIEND_ID = $id_quary limit $start,$forOnePage";
$result7 = $conn -> query($sql7);
$total_friends = $result7->num_rows;
$total_pages = ceil($total_friends / $forOnePage);









//Delete selected row.......................
if( isset( $_POST['delete'] ) ) {
   
    
	$delete_friend_ID =$_REQUEST['id'];
	
    $sql5 = " DELETE FROM relations WHERE FRIEND_ID = '$id_quary' AND ID = '$delete_friend_ID' ";
    $result5 = $conn->query($sql5) ;
}


//find user name
$sql6 = "SELECT PROFILE_NAME FROM all_users WHERE ID = '$id_quary' ";
$result6  = $conn->query($sql6);
$myname = $result6-> fetch_array();


//To find friends names
$sql3 = "SELECT a.PROFILE_NAME,a.ID FROM relations r INNER JOIN all_users a ON a.ID = r.ID WHERE r.FRIEND_ID = $id_quary limit $start,$forOnePage";
$result3 = $conn->query($sql3) ;



//To find how many friends user have
$sql2 = "SELECT count(*) as total FROM relations WHERE FRIEND_ID = '$id_quary'";
$result2 = $conn->query($sql2) ;
$numOfFriends = $result2->fetch_assoc();



?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>My profile</title>
<link rel="stylesheet" href="css/center.css">
</head>
	
	

<body>
	<div class = "wrapper">
		<h1>My Friend System</h1>
		<h4><?php echo $myname["PROFILE_NAME"]?> friend list page <br>  total number of freinds <?php echo $numOfFriends['total']; ?></h4>
	    
<table width="200" border="1" class= "table">
  <tbody>





   
<?php
    if($result3->num_rows>0){


    if($pageno == 1){ $i = 1;}else{ $i = (($pageno-1) * $forOnePage) +1; }
	$i =1;		
	while($rowval = $result3-> fetch_array()){  ?>
    <tr>

      <td><?php echo $rowval["PROFILE_NAME"] ?></td>
	  <td><form method='POST'>
                <input type=hidden name=id value=<?php echo $rowval["ID"]?> >
                <input type=submit value=Unfriend name=delete >
                </form>
		</td>
    </tr> 
    <?php $i++;
		
	}
		
	}else{
		echo "No Freinds";
	}
		?>
  </tbody>
</table>


<?php 
    if($pageno >1 ){
   ?>
   <a style = "margin-right: 150px;" href="profile.php?page=<?php echo $pageno -1; ?>">Previous</a>
  <?php 
	}
?>

<a style = "margin-right: 150px;" href="profile.php?page=<?php echo $pageno +1; ?>">Next</a>
<a style = "margin-right: 150px;" href="addfriend.php">Friends</a>


	
	</div>
</body>
</html>