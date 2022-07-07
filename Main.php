<?php 
	include_once('dbconnect.php');
	
	session_start();
 	$_SESSION["Google_ProfileIMG"] = $_GET["pfl"];
 	$_SESSION["Google_ProfileNAME"] = $_GET["pfl1"];
 	$_SESSION["Google_ProfileId"] = $_GET["pfl2"];
 	
 	$proimg=$_SESSION["Google_ProfileIMG"];
 	$email=$_GET["pfl3"];
 	$proname=$_SESSION["Google_ProfileNAME"];
 	$proid=$_SESSION["Google_ProfileId"];
 	$_SESSION["Google_ProfileEmailId"]=$email;

 	$none='images/profile-picture-none';
 	$_SESSION["main_url"] = 'Main.php?pfl='.$_SESSION["Google_ProfileIMG"].'&pfl1='.$_SESSION["Google_ProfileNAME"].'&pfl2='.$_SESSION["Google_ProfileId"].'&pfl3='.$email. '';
 	/*if($_GET["pfl"]="No" && $_GET["pfl1"]="No")
 	{
 		echo'<script>alert("User Not Signed in");</script>';
 	}*/
 	
	/*if( $result)
	$r1=mysqli_fetch_assoc($result);
	else
	echo mysqli_error($conn);*/

 	$q1="SELECT * FROM post ";
 	$result=mysqli_query($conn,$q1);
 	//$r1=mysqli_fetch_assoc($result);
 	$count=mysqli_num_rows($result);
 	
 	$q1="SELECT * FROM authority where email='$email'";
 	$result3=mysqli_query($conn,$q1);
 	
 	$q2="SELECT * FROM citizen where email='$email'";
 	$result4=mysqli_query($conn,$q2);

 	if(mysqli_num_rows($result3)>0)
 	{
 		$type="A";
 	}
 	else{
 		if (mysqli_num_rows($result4)>0) {
	 		$type="C";
	 	}
	 	else{
	 		if($proname == "No" && $proimg == "No")
	 		{
	 			$type="No";
	 		}
	 		else{
	 			$q1="INSERT INTO citizen(c_id,name,email,img_path,past_posts) values('$proid','$proname','$email','$proimg',NULL)";
				$result=mysqli_query($conn,$q1);
	 		}
	 	}
 	}
 	$_SESSION["type"] =	$type;


 	
 	/*if($proname!='No' && $proimg!='No' && $type == "A")
 	{
 		//echo ("<script type = 'text/javascript'>alert('$proid');</script>");
 		

	}*/

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
		var j='<?php echo $_SESSION["Google_ProfileNAME"]?>';
		//alert("Hello "+j);
		if( j != "No")
			window.location="Profile.php";
		else
		{
			alert("You are not Signed In.");
			window.location="Homepage.php";
		}
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
var div_cls_names = [];
var div_modal_names = [];
	$(document).ready(function () {
		for (var i = 0;i<(<?php echo $count; ?>);i++) {
			//$i = i;
			var div_cls_name = "close" + i;

			//console.log(div_cls_name);
			div_cls_names.push(div_cls_name);
			console.log(div_cls_names[i]);

			var div_modal_name = "myModal" + i;
			div_modal_names.push(div_modal_name);
			console.log(div_modal_names[i]);

			$("#" + div_cls_names[i]).hide();
			$("#" + div_modal_names[i]).hide();

		}

	});

	/*var modal_struct = [];
	var open_modal = [];
	var closebtn_modal = [];
	var modal_handle_arr = [];
	

	for (var i = 0; i <=4; i++) {
			modal_handle_arr.push(modal_handle(i));
	}

			function modal_handle(i) {
				return (function modal_handle_func(){

					
																			// CHECK FOR ID AND CLASS VALUES
					modal_struct.push(document.getElementById('myModal'));		//  ID myModal IS DIV OF MAP TO BE DISPLAYED
					open_modal.push(document.getElementById('Map'));			// 	GET THE ID WHICH WILL RESULT IN POPOUP OF MAP IN MODAL
					
						
					close_modal.push(document.getElementById('close'));

					
					
					close_modal[i].onclick = function() {

						modal_struct[i].style.display = "none";
						close_modal[i].style.display = "none";

					}		

			});
		}*/

		function load_modal (i) {
			console.log(div_cls_names[i]);
			

			$("#" + div_modal_names[i]).show();

			$("#" + div_cls_names[i]).show();


			/*$("#" + div_modal_names[i]).style.top="50%"+i*10;

			$("#" + div_cls_names[i]).show();*/
			/*var ms = modal_struct[i];
			console.log(ms);
			console.log(i);
			var cm = close_modal[i];

			ms.style.display = "block";
			cm.style.display =  "block";
*/
		
		}


		function close_modal (i) {
			$("#" + div_cls_names[i]).hide();
			$("#" + div_modal_names[i]).hide();
		}

		function up(i,c_id,id,email)
		{
		
			var uplabel = document.getElementById("u"+id).innerHTML;      // uid is post id
			//alert("done "+uplabel);
			
			$.ajax({
			type:'post',
			url:'up.php',
			data:{
				pid:id,
				c_id:c_id,
				uplabel:uplabel,
				Upvote:'Upvote',
				email:email
			},
			success:function(response)
			{
				
				if(response=="")
				{
					document.getElementById("u"+id).innerHTML=parseInt(uplabel) + 1;
					document.getElementById("u"+id).style.color="brown";
				}
				else
				{
					alert(response);
				}
			},
			error:function(response)
			{
				alert("Error \n"+response);
			}

			});
			
		}

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

		/*function addPost()
		{
			var desc=document.getElementById("DescTXTarea").value;
			var imgfile = document.getElementById("Uploadimg");
			//var imgf= $_FILES['uploadimg']['name'];
			$.ajax({
				type:'post',
				url:'up.php',
				data:{
					desc:desc,
					add:'addPost',
					imgf:'',
					imgf2:''
			},
			success:function(response)
			{
				alert("Successfully Added Post"+response);
			},
			error:function(response)
			{
				alert("Failed to add Post "+response);
			}

			});
		}*/

		function resolve(i,k)
		{
			var uri2='resolve.php?pi='+i+'&pi2='+k+'';
			window.location = uri2;
		}

		function addPost(image_name, image_tmp, lat, lng, desc, path, locality,deadline)
		{
			//var desc=document.getElementById("DescTXTarea").value;
			var imgfile = document.getElementById("Uploadimg");
			alert("Inside addPost function"+desc);
			//var imgf= $_FILES['uploadimg']['name'];
			$.ajax({
				type:'post',
				url:'geotag.php',
				data:{
					desc:desc,
					image_tmp : image_tmp,
					image_name : image_name,
					path : path,
					lat : lat,
					lng : lng,
					locality:locality,
					deadline:deadline,
					
					//add:'addPost',
					//desc = desc
					//imgf:'',
					//imgf2:''
				},
				success:function(response)
				{

				},

				error : function(response) {
					alert("Error:"+response);
				}

			});
		}

</script>
		
<!-- <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
	
	<script >
	var googleUser = {};
	function onSuccess(googleUser) {
      console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
      var profile = googleUser.getBasicProfile();
	  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
	  console.log('Name: ' + profile.getName());
	  console.log('Image URL: ' + profile.getImageUrl());
    }
    function onFailure(error) {
      console.log(error);
    }


	  /*
    	gapi.load('auth2',function(){
		gapi.auth2.init();
	});
	*/
	

    function signIn(googleUser) {
    //console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
	var profile = googleUser.getBasicProfile();
	console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
	console.log('Name: ' + profile.getName());
	console.log('Image URL: ' + profile.getImageUrl());
   } 

    function renderButton() {
      gapi.signin2.render('my-signin', {
        'scope': 'profile email',
        'width': 270,
        'height': 50,
        'margin-left' : 120,
        'margin-top' : 80,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure,
        'onclick':signIn,

      });
    }



</script> -->
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
	<div id = "Profile">
		<a href = "Profile.php">Profile</a>
	</div>
	<div id = "contact_us">
		<a href = "#Contact_us">Contact us</a>
	</div>
	<div id = "about_us">
		<a href = "#Footer">About</a>
	</div>
</div>

<!--
<div id="signin" onclick="signIn()" >
	<img id="glogo" src="https://developers.google.com/identity/images/g-logo.png">
	<p id="gtext"> Sign in with Google</p>
</div> 
 -->

 <!-- <div class="g-signin2" data-onsuccess="onSignIn" data-theme="light" style="height: 50px; display: inline-block;padding-left: 40px;font-family:'Roboto',sans-serif;font-weight: bold;vertical-align: middle;width:290px;margin-left: 40%;
	margin-top:20%;"></div> -->

<div class="container">
	<br>
	<br>
	<br>

<?php  
	if ($_SESSION["Google_ProfileNAME"]!="No" && $_SESSION["Google_ProfileId"]!=0)
	{
		echo'<form action="" method="POST" enctype="multipart/form-data" >';
		if($type == "C")
			echo'<div id="Addpost" onclick="openAdd()"><label id="LBAddpost" style="margin: auto;cursor: pointer;">Add Post</label></div>';
		/*elseif ($type == "A") {
			echo'<div id="Addpost" onclick="openAdd()"><label id="LBAddpost" style="margin: auto;cursor: pointer;">Add Resolved Post</label></div>';
		}*/

		echo '
		<div id = "close" style="left:23%;top:30%;display:none" class = "close_div" onclick = "cancel_post()" ></div>
	<div id="PostModal">
		<label for="DescTXTarea" style="position: absolute; top:5%;">Description</label>
		<textarea id="DescTXTarea" name="DescTXTarea" rows="10" cols="40" placeholder="  Give Description of your Complaint"></textarea>
		<br>
		<input type="file" name="uploadimg" id="Uploadimg"  accept="image/*" style="border-radius:15px ;color:#7fffd4;margin-left:31%;margin-top: 54%;">
		<br>
		<input type="submit" name="addF" class="addF" style="" value="Add">
	</div></form>';
	}

	if(isset($_POST['addF']))
	{	

		echo('<script>console.log("in addF");</script>');
		

		$desc = $_POST['DescTXTarea'];
		//$imgf = $_POST["imgf"];
		//$imgf2 = $_POST["imgf2"];
		
		$image_name = $_FILES['uploadimg']['name'];
		$image_tmp = $_FILES['uploadimg']['tmp_name'];
		echo '<script>alert("'.$image_name.' Hello '.$image_tmp.'");</script>';

		$success=0;

		$uploadedfile='';
		
		$uploadpath='uploads/';
		
		$targetpath=$uploadpath.basename($image_name);

		//echo is_file($targetpath);
		if($image_name =="")
		{
			echo('<script>console.log("file not selected");</script>');
			echo '<script>alert("Please select file to upload");</script>';
		}
		
		elseif(is_file($targetpath))
		{
			echo('<script>console.log("File already exists");</script>');
			echo '<script>alert("Post already exists ");</script>';
		}
		

		else
		{

/*			move_uploaded_file($image_tmp, $targetpath);
			//print_r($_FILES);
			$exif = exif_read_data($targetpath,0,true);
			print_r($exif);
			var_dump($exif);
*/			

//$geo5 = "SELECT past_posts FROM citizen WHERE email = '$_SESSION["Google_ProfileEmailId"]'";

			if (move_uploaded_file($image_tmp, $targetpath))
			{


				//echo('<script>console.log("File uploaded");</script>');


				function dmsToDec($arr) {
					$arr = $arr[0] + ($arr[1] / 60) + ($arr[2] / 3600);
					return($arr);
				}

			

				$filename = $targetpath;
				$exif = exif_read_data($filename,0,true);
				//var_dump($exif);
				
				$gps = $exif['GPS'];
				
				//print_r($exif);

				//print_r($gps);
				$gps_lat = $gps['GPSLatitude'];
				$gps_lng = $gps['GPSLongitude'];


				$lat_arr = [];
				foreach ($gps_lat as $key => $value) {
					//echo ($value);
					$val = explode("/", $value);
					$val[0] = (int)$val[0];
					//echo($val[0]);
					$val[1] = (int)$val[1];
					$value = $val[0] / $val[1];
					array_push($lat_arr, $value);
					//print_r($value);
					//echo($value.'</br>');
					# code...
				}
				$lat = dmsToDec($lat_arr);
				//echo($lat);
				$_SESSION["curr_lat"] = $lat;



				$lng_arr = [];
				foreach ($gps_lng as $key => $value) {
					$val = explode("/", $value);
					$val[0] = (int)$val[0];
					//echo($val[0]);
					$val[1] = (int)$val[1];
					$value = $val[0] / $val[1];
					array_push($lng_arr, $value);
					//echo($value.'</br>');
					# code...
				}

				$lng = dmsToDec($lng_arr);
				//echo($lng."czdx1");
				$_SESSION["curr_lng"] = $lng;
				/*$geo = [$lat, $lng];
				return ($geo);
				*/

				//********		REVERSE GEOCODING		********

				//echo($lng);


					//echo('<script> alert("Hello")</script>');
				/*echo('<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYeznobWeEvvZaH6pVasI-78h5iT2OimE"></script>');

						echo('<script  async defer 
					src = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDYeznobWeEvvZaH6pVasI-78h5iT2OimE">
						</script>');*/
				 $success=1;
					$uploadedfile=$targetpath;
					$d0=date("Y-m-d");
					$currentdate=date_create($d0);
					date_add($currentdate,new DateInterval('P16D'));
					$d1=date_format($currentdate,'Y-m-d');
					
				echo('<script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDYeznobWeEvvZaH6pVasI-78h5iT2OimE">
					</script>

			<script>
				var locality;
				var flag=0;
				function revCoder(lat,lng) {
					alert(lat + " " + lng);

					var geocoder = new google.maps.Geocoder();
					var geo = {lat: lat, lng: lng};
							
					return geocoder.geocode({"location" : geo }, function (results, status) {
								
						if (status === "OK") {
							if (results[0]) {
								//var addr = results[0].address_components[0];
								//var addr = results[0].types;

								for (var i = 0; i < results[0].address_components.length; i++)
								{
									var addr = results[0].address_components[i];
									var locality;
									if (addr.types[0] == "political") 
										locality = addr.long_name;
								}

								 alert(locality+" hello");
								 flag=1;
								 addPost(\''.$image_name.'\',\''.$image_tmp.'\','.$lat.','.$lng.',\''.$desc.'\',\''.$targetpath.'\',locality,\''.$d1.'\');
								 //return locality;
							}
							else {
								alert("No result found");
								//return  ;
							}

						}
						else {
							alert("Geocoder failed due to : " +status);
							//return ;
						}
						

							});
					
							
				}
				locality = revCoder('.$lat.','.$lng.');

					
				console.log("LOCALITY :"+locality);
				var loc="yo";
				</script>');

					
					//echo "222";
				
					//echo $success;

					//date('d')+15;
					
				
					echo('');
					
					//echo $d1;
					/*$query2="INSERT INTO post (img_url,geo_lat,geo_long,notice,deadline,status,description) VALUES('$targetpath',10,10,NULL,'$d1','P','$desc')";
					$result1=mysqli_query($conn,$query2);*/
					if(!$success) {
						echo '<script>alert("failed to add post'.mysqli_connect_error().'");</script>';
					}
					

					else
					{	
						echo '<script>alert("Successfully added Post");</script>';
						$image_name="";
						$targetpath="";
					}
			}			
		}

//$geo5 = "SELECT past_posts FROM citizen WHERE email = '$_SESSION["Google_ProfileEmailId"]'"
	}
?>
	
<script>
		

			
			function initMap(i,pid,lat,lng) 
			{
				//alert(lat);
				var lat = parseInt(lat);
				//alert("parsed " + lat);
				//alert(lng);	
				var lng = parseInt(lng);
				//alert("Parsed " + lng);
				var geo = {lat : lat,lng : lng};
				//alert(geo);



				var map = new google.maps.Map(document.getElementById('myModal' + i), {
					scrollwheel: true,
					zoom: 12,
					center : geo
				});	
				var marker = new google.maps.Marker({
					position : geo,
					map : map
				});
		}
</script>


<?php  
$i=0; 
$pos[0]=23;
while($r1=mysqli_fetch_assoc($result))  
{
	
	$pid[$i]=$r1["post_id"];



	$desc[$i]=$r1["description"];
 	$img[$i]=$r1["img_url"];
 	$upvote[$i]=$r1["upvotes"];
 	$status[$i]=$r1["status"];
 	$geo_lat[$i] = $r1["geo_lat"];
	$geo_lng[$i] = $r1["geo_long"];


 	$deadline[$i]=$r1["deadline"];
 	$date1 = new DateTime($deadline[$i]);
	$date2 = new DateTime(date("Y-m-d h:i:sa"));
	$interval = $date2->diff($date1);
 	$deadline[$i]=$interval->d;
 	$invert=$interval->invert;
 	//echo $invert;
 	if($invert!=0)
 	{
 		$deadline[$i]=0;
 	}

 	$query3="SELECT * FROM resolved_post WHERE resolved_id='$pid[$i]'";
 	$result5= mysqli_query($conn,$query3);
 	$r3=mysqli_fetch_assoc($result5);

 	$notice[$i]=$r1["notice"];
 	if($status[$i]=="P")
 	{
		if($type=="A")
		{
			echo '<div class="post" style="border-right: solid 10px yellow;" >';
		}
		else{
			echo '<div class="post">';
		}
	}
	else{
		echo'<div class="post" style="border-right: solid 10px #8f1b1b; margin-left:7%;">';
	}
		echo '<div class="post_img">
			<img src="'.$img[$i].'" alt="Complaint image" style="max-width:fit-content; max-height: 100%; ">
		</div>
		<div class="post_txt">
			<p name="noticetxt" class="divtext" style="font-size: 15px; padding-top:20px; padding-right:20px; color:red; margin-bottom:0px;">Notice: '.$notice[$i].'</p>
			<p class="divtext" style="font-size: 15px; padding-top:20px; padding-right:20px;">'.$desc[$i].'</p>
		</div>
		<form action="" method="POST">
		<div class="post_low">';
		if($type == "C")
			echo'<div name="Upvote" class="divtext upvote"  onclick="up('.$i.','.$proid.','.$pid[$i].',\''.$email.'\');" style="cursor: pointer;">';
		elseif ($type == "A" || $type == "No") {
			echo'<div name="Upvote" class="divtext upvote"  >';
		}
		
		//<div name="Upvote" class="divtext upvote"  onclick="up('.$i.','.$proid.','.$pid[$i].',\''.$email.'\');">
		
		echo '<span id="Upno"><label id="u'.$pid[$i].'" for="Upvote">'.$upvote[$i].'</label></span> <span id="Uptxt"> Upvote</span></div>';
		if($status[$i]=="P")
	 	{
		echo '<span id="deadline">'.$deadline[$i].' Days Left</span>';
		}
		else{
			echo'<span id="deadline">Old</span>';
		}
		echo '<div id="Map" class="divtext" onclick = "load_modal(' .$i. '); initMap(' .$i. ','.$pid[$i].','.$geo_lat[$i].','.$geo_lng[$i].');"> On Map</div>
		</div>
		</form>';
		if($type == "A")
		{
			if($status[$i]=="P")
		 	{
				echo '<div style="height:320px;width:100px;background: orange;display:;margin-left:614px; border-right-color:brown;border-right-width:3px;border-right-style:solid;" >

					<span  style="height:320px;width:100px;background: orange;" onclick=" resolve('.$pid[$i].',\'resolve\')";>

						<label style="padding-top:25%;padding-left:3%;padding-bottom:24%;padding-right:4%;position:absolute;">Resolve</label>

					</span>

			

				<div style="height:320px;width:100px;background: #bdb76b;display:;margin-left:103px;" onclick=" resolve('.$pid[$i].',\'notice\')";">

					<label style="margin-top:25%;margin-left:4%;position:absolute;">Notice</label>
				</div>
				</div>';
			}
			
		}
		echo'	
	</div>';
	if($status[$i]!="P")
	{
		echo'<div class="resimg">
		<div class="post_img rimg_radius" style="position:absolute; width:350px;">
			<img src="'.$r3["img_url"].'" alt=" Resolved Complaint image" class="rimg_radius" style="max-width:350px; 
	max-height: 100%;min-width:100%;min-height:100%; ">
		</div>
		<div class="post_low" style="border-bottom-left-radius:10px; border-bottom-right-radius:25px">
		<span style="display: inline-flex;margin-left: 157px;margin-top: 15px;font-size: large;">New</span>
		</div>
		</div>';
	}
	echo'
	<div id = "close' .$i. '" style="top:'.$pos[$i].'%;" class = "close_div" onclick = "close_modal(' .$i. ')" ></div>
		<br><br>
		<div id = "myModal' .$i. '" style="top:'.$pos[$i].'%;" class = "modal"></div>';
	
	//$pos=$pos+80;
	if($notice[$i]=="")
	{
		echo'<script>var ntc = document.getElementsByName("noticetxt")['.$i.'];</script>';
		echo '<script>ntc.style.visibility="hidden";</script><script>ntc.style.width="";</script>';
	}
	$pos[$i+1]=$pos[$i]+65;
	$i++;
	
}



?>
<br>
<br>
<br>
</div>

<div id="Footer">
	<p class="footertext" style="padding-bottom: 2px; border-bottom: 2px solid black;"> Created by:<br>
		Rohit Rayte<br>
		Sahishnu Patil<br>
	</p>

	<p class="footertext" id="Contact_us">Contact Us for any help on:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:rohit.rayte@somaiya.edu">Rohit Rayte</a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:sahishnu.p@somaiya.edu">Sahishnu Patil</a></p>
</div>
</body>

