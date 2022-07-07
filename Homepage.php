<?php 
	include_once('dbconnect.php');
	session_start();
 	$_SESSION["main_url"] = 'Main.php?pfl=No&pfl1=No&pfl2=0&pfl3=No';
 ?>
<!DOCTYPE html>
<html>

<head>

<title>Home Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">

<meta name="google-signin-client_id" content="529219428652-1jhugb54h0jebnaij3t2rg4m1dlctqh9.apps.googleusercontent.com">

<link rel="stylesheet" type="text/css" href="master.css">


</head>

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
</script>


<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
<!-- <script src="https://www.googleapis.com/oauth2/v1/userinfo?access_token={accessToken}" async defer></script> -->
<script >
	var googleUser = {};

	function onSuccess(googleUser) {
      console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
      var profile = googleUser.getBasicProfile();
	  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
	  console.log('Name: ' + profile.getName());
	  console.log('Image URL: ' + profile.getImageUrl());
	   var id_token = googleUser.getAuthResponse().id_token;
	   console.log('ID Token:'+id_token);

	   var id= profile.getId();
	   var name= profile.getName();
	   var emailId=profile.getEmail();
	   var img= profile.getImageUrl();
	   //var gender= profile.getGender();
	  
	  var uri = 'Main.php?pfl='+profile.getImageUrl()+'&pfl1='+profile.getName()+'&pfl2='+profile.getId()+'&pfl3='+profile.getEmail()+'';
	  window.location = uri;
    }

    function onFailure(error) {
      console.log(error);
      var uri = 'Main.php?pfl=No&pfl1=No&pfl2=0&pfl3=No';
	  window.location = uri;
	  alert("Not Signed in");
    }


	  /*
    	gapi.load('auth2',function(){
		gapi.auth2.init();
	});
	*/
	

    function signIn(googleUser) {
    //console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
	var profile = googleUser.getBasicProfile();
	console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID tokeninstead.
	console.log('Name: ' + profile.getName());
	console.log('Image URL: ' + profile.getImageUrl());
	
	//document.getElementById("txt").value = profile;
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



</script>

<?php 
	/*if()
	  	$q1="INSERT INTO citizen values('"+id+"','"+name+"','"+emailId+"','"+img+"','0')";
	  	$result=mysqli_query($conn,$q1);
	  	$r1=mysqli_fetch_assoc($result);
	  	echo mysqli_connect_errno();*/
	  ?>

<body>



<div  id="HeaderText">
	
	<span id="r1"></span><div id="r2"></div>
	
	<span id="s1"></span><div id="s2"></div>

	<span id="g1"></span><div id="g2"></div>

	<span id="m1"></span><div id="m2"></div>

	<span id="sy1"></span><div id="sy2"></div>

</div>
<br>
<br>
<br><br>
	
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

<div id = "my-signin" style = "margin-left:41%; margin-top: 20%"></div>

<p id="Welcometxt"> Welcome to the website<br><br><br><br> This website provides an interface to deliver your complaints directly to your authority, with an ease.</p>
<div id="Potholediv" class="introdiv"><br><br><br>
	
	<p class="divtext" style="padding-right: 244px;">&nbsp;&nbsp;&nbsp;Here Grievances regarding the regular transit's problem and the reason for those bumpy rides <br><b style="color: black;">The bad roads</b> can be solved. It's been a major issue since it causes great damage to vehicles as well as human lives. </p>
</div>
<img src="images/cone_1.gif" id="Potholegif" class="igif" height="200px" width="300px" alt=" Road ">

<div id="Garbagediv" class="introdiv"><br><br><br>
	
	<p class="divtext" style="padding-left: 265px;">&nbsp;&nbsp;&nbsp;Lack of <b style="color: black;">Sanitation</b> is greatly responsible for many diseases, which is a great threat to society. These issues can be reported here. </p>
</div>
<img src="images/garbage.gif" id="Garbagegif" class="igif" height="200px" width="300px" alt=" garbage ">
<div id="Footer">
	<p class="footertext" style="padding-bottom: 2px;border-bottom: 2px solid black;"> Created by:<br>
		Rohit Rayte<br>
		Sahishnu Patil<br>
	</p>

	<p class="footertext" id="Contact_us">Contact Us for any help on:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:rohit.rayte@somaiya.edu">Rohit Rayte</a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:sahishnu.p@somaiya.edu">Sahishnu Patil</a></p>
</div>
</body>

