<!doctype html>
<html>
<body>
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYeznobWeEvvZaH6pVasI-78h5iT2OimE">
	</script>
 -->
<?php
	session_start();
	include_once('dbconnect.php');

//		GET PID AS NAME OF FILE
//		RUN THIS SCRIPT ON UPLOAD OF FILE  &  IF IT RETURNS NULL ECHO ERROR

/*echo('<script  async defer 
	src = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDYeznobWeEvvZaH6pVasI-78h5iT2OimE">
</script>');
*/


	$image_name = $_POST["image_name"];
	$image_tmp = $_POST["image_tmp"];
	$desc = $_POST["desc"];
	$targetpath = $_POST["path"];
	$locality = $_POST["locality"];
	$lat = $_POST["lat"];
	$lng = $_POST["lng"];
	$deadline = $_POST["deadline"];
	//echo "222";

	//echo $success;


	$qry_insert = "INSERT INTO post (img_url,geo_lat,geo_long,notice,deadline,status,description,locality) VALUES ('$targetpath','$lat','$lng',NULL,'$deadline','P','$desc','$locality')";
	$result = mysqli_query($conn, $qry_insert);

	echo  mysqli_connect_error();

	$c_id=$_SESSION["Google_ProfileId"];
	$q5="SELECT past_posts FROM citizen WHERE c_id='$c_id'";
	$result6=mysqli_query($conn,$q5);
	$r6=mysqli_fetch_assoc($result6);

	echo  mysqli_connect_error();

	
	$incrpast_posts=$r6["past_posts"]+1;
	$qry_insert = "UPDATE citizen SET past_posts='$incrpast_posts' WHERE c_id='$c_id'";
	$result = mysqli_query($conn, $qry_insert);

	echo  mysqli_connect_error();

	$q5="SELECT * FROM authority WHERE locality='$locality'";
	$result6=mysqli_query($conn,$q5);
	$r6=mysqli_fetch_assoc($result6);

	echo  mysqli_connect_error();

	$a_id=$r6["a_id"];
	$incrtotal_post=$r6["total_post"]+1;

	if($r6["total_post"] != 0)
	{
		$ranking=( ($r6["completed_posts"])/($r6["total_post"]) )*5;
		$qry_insert = "UPDATE authority SET total_post='$incrtotal_post',ranking='$ranking' WHERE a_id='$a_id'";
	}
	else{
		$qry_insert = "UPDATE authority SET total_post='$incrtotal_post' WHERE a_id='$a_id'";
	}
	$result = mysqli_query($conn, $qry_insert);




	echo'<script>alert("Inside geo-tag.php after  '.$image_name.'   '.$image_tmp.'   '.$desc.'   '.$targetpath.'   '.$lat.' '.$lng.' '.$deadline.' '.$locality.'");</script>';
	/*echo('<script  async defer 
		src = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDYeznobWeEvvZaH6pVasI-78h5iT2OimE&callback=revCoder">
	</script>');
	*/


?>


</body>
</html>

 
<!--

Array([GPS] => Array ( [GPSAltitudeRef] => [GPSLatitudeRef] => N [GPSLatitude] => Array ( [0] => 19/1 [1] => 2/1 [2] => 486405/10000 ) [GPSLongitudeRef] => E [GPSLongitude] => Array ( [0] => 72/1 [1] => 52/1 [2] => 303106/10000 ) [GPSAltitude] => 0/1000 [GPSTimeStamp] => Array ( [0] => 10/1 [1] => 4/1 [2] => 56/1 ) [GPSProcessingMode] => ASCII [GPSDateStamp] => 2017:10:07 )  )
 -->





