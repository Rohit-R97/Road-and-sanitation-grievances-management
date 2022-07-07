<?php 
	session_start();
	include_once('dbconnect.php');
	$none='images/profile-picture-none';
?>
<!DOCTYPE html>
<html>

<head>

<title> Main </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">

<meta name="google-signin-client_id" content="529219428652-1jhugb54h0jebnaij3t2rg4m1dlctqh9.apps.googleusercontent.com">

<link rel="stylesheet" type="text/css" href="master.css">

<script  src="jquery-3.2.1.js"></script>

</head>
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

<script>
	function openNav() {
		document.getElementById("mySidenav").style.width = "220px";
	}	

	function closeNav() {
		document.getElementById("mySidenav").style.width = 0;
	}
	function hideBtn() {
		document.getElementById("openbtn_hide").style.visibility = "hidden";
	}
	function dispBtn() {
		document.getElementById("openbtn_hide").style.visibility = "visible";
	}

	function navigate(){
		 window.location="Homepage.php";
	}

 	function onLoad(googleuser){
 		gapi.load('auth2',function(){
		gapi.auth2.init();
		});

 		var img = document.getElementById("HeaderImg");
 		var profile_img = <?php if($_SESSION["Google_ProfileIMG"]=="No")
 		{echo json_encode($none);}else{echo json_encode($_SESSION["Google_ProfileIMG"]);} ?>;
 		if(profile_img==<?php echo json_encode($none);?>)
 		{
 			alert("User Not Signed in");
 		}
 		img.src=profile_img;
 	}

 	function logout(){
 		var auth2 = gapi.auth2.getAuthInstance();
 		auth2.signOut().then(function(){
 			var profile_name = '<?php echo $_SESSION["Google_ProfileNAME"] ?>'
 			console.log('User '+profile_name+' signed out.');

 		});
 		window.location='Homepage.php';
 	}


</script>

<script>

		function openAdd()
		{
			document.getElementById("PostModal").style.display="block";
			document.getElementById("close").style.display="block";
		}

		function cancel_post()
		{
			document.getElementById("PostModal").style.display="none";
			document.getElementById("close").style.display="none";
		}

		

</script>


<body>



<div  id="HeaderText">
	
	<span id="r1"></span><div id="r2"></div>
	
	<span id="s1"></span><div id="s2"></div>

	<span id="g1"></span><div id="g2"></div>

	<span id="m1"></span><div id="m2"></div>

	<span id="sy1"></span><div id="sy2"></div>

</div>

<div id="HeaderButton" onclick="navigate();">
<!-- <img id="HeaderImg" src="Profile-Demo.png" alt="Profile Image">--> 
<img id="HeaderImg" alt="Profile Image"> 




<label for="HeaderImg" id="HeaderLabel" > Profile </label>
</div>
<div id="Logout" onclick="logout();">
</div>	
<br>
<br>
<br>
<br>
<!-- <span  class = "openbtn" onclick="openNav()">"\f039"</span> -->
<button class = "openbtn" id = "openbtn_hide" onclick = "openNav(); hideBtn();"></button>

	
<div id = "mySidenav" class = "sidenav" >
	<!-- 	javascript:void(0) will call JS within the link -->

	<a href = "javascript:void(0);" class = "closebtn" onclick = "closeNav(); setTimeout(dispBtn,300);"></a>
	<br>
	<br>
	<div id = "home">
		<a href = "Homepage.php" >Home</a>
	</div>
	<div id = "box">
		<a href = "<?php echo $_SESSION["main_url"]; ?>">Box</a>
	</div>
	<div id = "rank">
		<a href = "rank.htm">Ranking</a>
	</div>
	<div id = "contact_us">
		<a href = "#Contact_us">Contact us</a>
	</div>
	<div id = "about_us">
		<a href = "#Footer">About</a>
	</div>
</div>



<?php  
	$pi2=$_GET['pi2'];
	if($pi2 == "resolve")
	{
		if ($_SESSION["Google_ProfileNAME"]!="No" && $_SESSION["Google_ProfileId"]!=0)
		{
			echo'<form action="" method="POST" enctype="multipart/form-data" >';
			

			
			//<div id = "close" style="left:23%;top:30%;display:none" class = "close_div" onclick = "cancel_post()" ></div>
			echo '
		<div id="PostModal" style="display:block;top:20%;margin-bottom:3%;">
			
			<br>
			<input type="file" name="uploadimg" id="Uploadimg"  accept="image/*" style="border-radius:15px ;color:#7fffd4;margin-left:31%;margin-top: 79%;">
			<br>
			<input type="submit" name="addF" class="addF" style="" value="Add">
		</div></form>';
		}

		if(isset($_POST['addF']))
		{
			$pi=$_GET['pi'];
			//$desc = $_POST['DescTXTarea'];
			$image12 = $_FILES['uploadimg']['name'];
			$image123 = $_FILES['uploadimg']['tmp_name'];
			//echo '<script>alert("'.$image12.' Hello '.$image123.'");</script>';

			$success=0;

			$uploadedfile='';
			
			$uploadpath='uploads/resolved/';
			
			$targetpath=$uploadpath.basename($image12);

			//echo is_file($targetpath);
			if($image12 =="")
			{
				echo '<script>alert("Please select file to upload");</script>';
			}
			elseif(is_file($targetpath))
			{
				echo '<script>alert("Post already exists ");</script>';
				echo'<script> location.href= "'.$_SESSION["main_url"].'";</script>';
			}
			else
			{	
					if (move_uploaded_file($image123, $targetpath))
					{
						$success=1;
						$uploadedfile=$targetpath;
						//echo "222";
					
						//echo $success;

						/*date('d')+15;
						$d0=date("Y-m-d");
						$currentdate=date_create($d0);
						date_add($currentdate,new DateInterval('P16D'));
						$d1=date_format($currentdate,'Y-m-d');*/
						//echo $d1;
						$query2="INSERT INTO resolved_post VALUES('$pi','$targetpath')";
						$result1=mysqli_query($conn,$query2);

						$query2="UPDATE post SET status='C', deadline = NULL where post_id='$pi'";
						$result1=mysqli_query($conn,$query2);
						

						if(!$success)
							echo '<script>alert("Failed to resolve post'.mysqli_connect_error().'");</script>';
						else
						{	
							echo '<script>alert("Successfully resolved Post");</script>';
							$image12="";
							$targetpath="";
							echo'<script> window.location="'.$_SESSION["main_url"].'";</script>';
						}
					}
				//deadline=".date_format(date_create('0000-00-00'),'Y-m-d')."
				
			}
			
			
		}
	}
	elseif($pi2 == "notice"){
		if ($_SESSION["Google_ProfileNAME"]!="No" && $_SESSION["Google_ProfileId"]!=0)
		{
			echo'<form action="" method="POST" enctype="multipart/form-data" >';
			

			
			//<div id = "close" style="left:23%;top:30%;display:none" class = "close_div" onclick = "cancel_post()" ></div>
			echo '
		<div id="PostModal" style="display:block;top:20%;margin-bottom:3%;">
			<label for="DescTXTarea" style="position: absolute; top:5%;">Notice</label>
			<textarea id="DescTXTarea" name="DescTXTarea" rows="10" cols="40" placeholder="  Provide Notice for the selected Complaint"></textarea>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<input type="submit" name="addN" class="addF" style="" value="Add">
		</div></form>';
		}

		if(isset($_POST['addN']))
		{
			$pi = $_GET['pi'];
			$txt = $_POST['DescTXTarea'];
			//echo '<script> alert('.$pi.');</script>';
			
			if($txt == "\|")
			{
				$query2="UPDATE post SET notice='' where post_id='$pi'";
				$result2=mysqli_query($conn,$query2);
			}
			else{
				$query2="SELECT notice FROM post where post_id='$pi'";
				$result2=mysqli_query($conn,$query2);
				$r3=mysqli_fetch_assoc($result2);
				//echo '<script> alert('.$r3['notice'].');</script>';
				$txt = $r3['notice']." ".$txt; 
				//echo'<script> alert('.$txt.');</script>';
				$query2="UPDATE post SET notice = '$txt' where post_id = '$pi'";
				$result2=mysqli_query($conn,$query2);
			}
			echo'<script> window.location="'.$_SESSION["main_url"].'";</script>';
		}
	}

?>


</body>