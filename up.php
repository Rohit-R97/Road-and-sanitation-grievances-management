<?php

	session_start();
	include_once('dbconnect.php');

	if(isset($_POST["Upvote"]))
	{
		$rowid=$_POST["pid"];
		$email=$_POST["email"];
		$c_id = $_SESSION["Google_ProfileId"];//$_POST["c_id"];

		if($email == "No")
		{

			echo("You must login to upvote!!");

		}

		elseif (isset($_POST["Upvote"]) )
		{//&& intval($_SESSION[$email."pid".$rowid])!=1) {
			

			$q_chk = "SELECT * FROM citizen_post WHERE post_id = '$rowid' AND c_id = '$c_id'";  //CHECK HOW TO INSERT VARIABLES IN MYSQL

			echo mysqli_connect_error();
			$chk = mysqli_query($conn,$q_chk);
			if(mysqli_num_rows($chk) === 1) {
				echo('You can upvote only once');
			}
			else {
				$uplabel=$_POST["uplabel"]+1;
				$q1="UPDATE post SET upvotes='$uplabel' where post_id='$rowid'";
		 		$result=mysqli_query($conn,$q1);

		 		$q2 = "INSERT INTO citizen_post VALUES('$c_id','$rowid','U')";
		 		//echo $c_id.'  ,  '.$rowid;
		 		$q2_cnf = mysqli_query($conn, $q2);
		 		//$r1=mysqli_fetch_assoc($result);
		 		//echo mysqli_connect_error();

		 		//exit();
		 		//$_SESSION[$email."pid".$rowid]=1;
			}

		}

	}
		//echo('You can upvote a post only once');



	/*if(isset($_POST["Upvote"]) && intval($_SESSION[$email."pid".$rowid])!=1)
	{
		$uplabel=$_POST["uplabel"]+1;
		$q1="UPDATE post SET upvotes='$uplabel' where post_id='$rowid'";
 		$result=mysqli_query($conn,$q1);
 		//$r1=mysqli_fetch_assoc($result);
 		echo mysqli_connect_error();
 		//exit();
 		$_SESSION[$email."pid".$rowid]=1;
	}*/
	/*else
		echo('You can upvote a post only once');	*/
	
	

?>