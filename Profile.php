<?php 
	include_once('dbconnect.php');
	session_start();

	$c_id=$_SESSION["Google_ProfileId"];

		if($_SESSION["type"]=="C")
		{
		$q6="SELECT * FROM post WHERE post_id IN (SELECT post_id FROM citizen_post WHERE c_id='$c_id')";
		}
		elseif ($_SESSION["type"]=="A") {
			$q6="SELECT * FROM post WHERE locality IN (SELECT locality FROM authority WHERE a_id='$c_id')";

		}
	 	$result7=mysqli_query($conn,$q6);
		$count=mysqli_num_rows($result7);
 ?>
<!DOCTYPE html>
<html>

<head>

<title>Profile</title>
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
	
	function onLoad(googleuser){
 		gapi.load('auth2',function(){
		gapi.auth2.init();
		});
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
function resolve(i,k)
		{
			var uri2='resolve.php?pi='+i+'&pi2='+k+'';
			window.location = uri2;
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
<?php 
	$email=$_SESSION["Google_ProfileEmailId"];
	if($_SESSION["type"]=="C")
	{
		$q5="SELECT past_posts FROM citizen where email='$email'";
	 	$result6=mysqli_query($conn,$q5);
	 	$r6=mysqli_fetch_assoc($result6);
	}
	else
	{
		$q5="SELECT * FROM authority where email='$email'";
	 	$result6=mysqli_query($conn,$q5);
	 	$r6=mysqli_fetch_assoc($result6);
	}
?>
	<div id="Pdetails">
		<div id="Pinfo">
			<table>
				<tr>
					<td>
				        <label class="highlight">Name:</label>
				        <br>
				        <label><?php echo $_SESSION["Google_ProfileNAME"]; ?></label>
				        <br><br><hr><br>
		    		</td>
		    		<td>
				       <?php if($_SESSION["type"]=="A")
				       {
				       	echo'<label class="highlight">Solved Posts:</label>
					        <br>
					        <label>'.$r6["completed_posts"].'</label>
					        <br><br><hr><br>';
				       }
				       ?>
		    		</td>
		        </tr>
		        <tr>
		        	<td>
		        		<label class="highlight">Email id:</label>
				        <br>
				        <label><?php echo $_SESSION["Google_ProfileEmailId"]; ?></label>
				        <br><br><hr><br>
				    </td>
					<td>
						<?php if($_SESSION["type"]=="A")
				       {
				       	echo'<label class="highlight">Total Posts:</label>
					        <br>
					        <label>'.$r6["total_post"].'</label>
					        <br><br><hr><br>';
				       }
				       ?>
					</td>
				</tr>
				<tr>
		        	<td>
		        		<?php 
						if($_SESSION["type"]=="C")
						{
							echo'<label class="highlight">Past Posts:</label>
						        <br>
						        <label>'.$r6["past_posts"].'</label>
						        <br><br><hr><br>';
						}
						else
						{
							echo'<label class="highlight">Ranking:</label>
					        <br>
					        <label>'.$r6["ranking"].'/5 </label>
					        <br><br><hr><br>';
						}
						?>
				    </td>
					<td>
						<?php if($_SESSION["type"]=="A")
				       {
				       	echo'<label class="highlight">Locality:</label>
					        <br>
					        <label>'.$r6["locality"].'</label>
					        <br><br><hr><br>';
				       }
				       ?>
					</td>
				</tr>
				</table>

	        
		</div>
		<div id="Pimgd">
			<img src="<?php echo $_SESSION['Google_ProfileIMG']?>" alt="Profile Image" class="pimg">
		</div><br>
		<div id="Logout" onclick="logout();" style="width: 165px;margin-top:;position: relative; right:-212px;color:brown; ">
			LogOut
		</div>	
	</div>
	
	
	<div class="container">
	<br>
	<br>
	<br>

	<?php  
		$i=0; 
		$pos[0]=100;
		
	 	//echo'<script>alert("helloooo'.mysqli_connect_error().'  '.$count.' k ");</script>';
		while($r7=mysqli_fetch_assoc($result7))  
		{
			
			$pid[$i]=$r7["post_id"];



			$desc[$i]=$r7["description"];
		 	$img[$i]=$r7["img_url"];
		 	$upvote[$i]=$r7["upvotes"];
		 	$status[$i]=$r7["status"];
		 	$geo_lat[$i] = $r7["geo_lat"];
			$geo_lng[$i] = $r7["geo_long"];


		 	$deadline[$i]=$r7["deadline"];
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

		 	$notice[$i]=$r7["notice"];
		 	if($status[$i]=="P")
		 	{
				if($_SESSION["type"]=="A")
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
				if($_SESSION["type"] == "C")
					echo'<div name="Upvote" class="divtext upvote"  onclick="up('.$i.','.$_SESSION["Google_ProfileId"].','.$pid[$i].',\''.$email.'\');" style="cursor: pointer;">';
				elseif ($_SESSION["type"] == "A" || $_SESSION["type"] == "No") {
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
				if($_SESSION["type"] == "A")
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
	<script  async defer 
		src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDYeznobWeEvvZaH6pVasI-78h5iT2OimE">
	</script>

	<br>
	<br>
	<br>
	</div>





<div id="Footer">
	<p class="footertext" style="padding-bottom: 2px;border-bottom: 2px solid black;"> Created by:<br>
		Rohit Rayte<br>
		Sahishnu Patil<br>
	</p>

	<p class="footertext" id="Contact_us">Contact Us for any help on:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:rohit.rayte@somaiya.edu">Rohit Rayte</a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:sahishnu.p@somaiya.edu">Sahishnu Patil</a></p>
</div>
</body>

