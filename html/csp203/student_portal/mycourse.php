<!DOCTYPE HTML>
<?php
	@ob_start();
    session_start();
    include('database.php');
?>
<!--
	Aesthetic by gettemplates.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://gettemplates.co
-->
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>OneClick</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="GetTemplates.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style>
	.w3-button {width:150px;}
	</style>
	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<div class="page-inner">

	<div id="head-top" style="position: absolute; width: 100%; top: 0; ">
		<div class="gtco-top">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div id="gtco-logo"><a href="index.php">OneClick <em>.</em></a></div>
					</div>
					<div class="col-md-6 col-xs-6 social-icons">
						<ul class="gtco-social-top">
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-instagram"></i></a></li>
						</ul>
					</div>
				</div>
			</div>	
		</div>
		<nav class="gtco-nav sticky-banner" role="navigation">
			<div class="gtco-container">
				
				<div class="row">
					<div class="col-xs-12 text-center menu-1">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li class="active"><a href="mycourse.php">My Courses</a></li>
							<li><a href="contact.html">Contact Us</a></li>
                            <li><a href="logout.php">Log Out</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav></div>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_4.jpg)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row row-mt-15em">
				<div class="col-md-7 mt-text text-left animate-box" data-animate-effect="fadeInUp">
					<h1>My Courses.</h1>	
					<h2>Following is the list of courses you have registered for.</h2>
				</div>
			</div>
		</div>
	</header>

<div>
		<div class="col-1">
			<div class="text">

				<div class="row">
                <?php
                    
                    $email = $_SESSION['login_user'];
                    $get_sql = "SELECT StudentID,FirstName,LastName FROM student WHERE email=\"$email\"";
                    $res = mysqli_query($connection,$get_sql);
                    if($res){
                        $get_id = 0;
                        
                        while ($row=mysqli_fetch_row($res)){
                            $get_id = $row[0];
                            $fname = $row[1];
                            $lname = $row[2];
                        }
                        
                        
                        $sql="SELECT cn,ct FROM instructor INNER JOIN (SELECT InstructorID, alias1.CourseName as cn,cid as ccid,alias1.CourseTitle as ct FROM Instructor_courses INNER JOIN (Select CourseName,CourseID as cid,CourseTitle from course WHERE CourseID IN (SELECT CourseID FROM Student_Attendance WHERE StudentID = $get_id ))alias1 ON alias1.cid = Instructor_courses.CourseID)alias2 ON alias2.InstructorID = instructor.InstructorID;";
                        $result = mysqli_query($connection,$sql);
                        if ($result)
                        {
                        	echo "<div class=\"gtco-section gtco-gray-bg\"><div class=\"gtco-container\"><div class=\"row\">";
                        	echo "<h1 style=\"color: black; font-family: 'Trocchi', serif; font-size: 45px; font-weight: normal; line-height: 48px; margin: 0;\">&nbspName: $fname $lname</h1>";
	                        echo "<h2 style=\"color: black; font-family: 'Trocchi', serif; font-size: 35px; font-weight: normal; line-height: 48px; margin: 0;\">&nbsp&nbspEmail: $email</h2>";
	                        echo "<p>&nbsp&nbsp&nbsp&nbsp&nbsp<a href=\"add_photos.php?id=$get_id\"><button class=\"w3-button w3-green\">Add Photos</button></a></p>";
	                        
	                        
                            while ($row2=mysqli_fetch_row($result))
                            {
                            	$coursename = $row2[0];
                            	$coursetitle = $row2[1];
                            	$vcsv = $coursename . "/" . $coursename .".csv";
                            	echo "<div class=\"col-lg-4 col-md-4 col-sm-6\"><a href=\"../course/$vcsv\" class=\"gtco-card-item\"><figure><div class=\"overlay\"><i class=\"ti-plus\"></i></div><img src=\"images/img_1.jpg\" alt=\"Image\" class=\"img-responsive\"></figure><div class=\"gtco-text\"><h2>$coursename</h2><p></p><p class=\"gtco-category\"><span style=\"font-size: 20px;\">Click to view the attendance details ...</span></p></div></a></div>" ;
                            }
                            echo "</div></div></div>";
                            
                        }
                    }else{
                    	echo "<h1>No courses found to register for. Please talk to your course instructor to verify if he has added the course you are looking for.</h1><br><h2>Have a nice day :)</h2>";
                    }
                    mysqli_close($connection);
                ?>
				</div>
			</div>
		</div>
	</div>


	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
			<div class="row row-p	b-md">

				<div class="col-md-4">
					<div class="gtco-widget">
						<h3>About Us</h3>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore eos molestias quod sint ipsum possimus temporibus officia iste perspiciatis consectetur in fugiat.</p>
						<p><a href="#">Learn more...</a></p>
					</div>
				</div>

				<div class="col-md-4 col-md-push-1">
					<div class="gtco-widget">
						<h3>Services</h3>
						<ul class="gtco-footer-links">
							<li><a href="#">Data Analytics</a></li>
							<li><a href="#">Web Development</a></li>
							<li><a href="#">Branding &amp; Identity</a></li>
							<li><a href="#">eCommerce Development</a></li>
							<li><a href="#">Design &amp; UX</a></li>
							<li><a href="#">Strategt</a></li>
						</ul>
					</div>
				</div>

				

				<div class="col-md-3 col-md-push-1">
					<div class="gtco-widget">
						<h3>Get In Touch</h3>
						<ul class="gtco-quick-contact">
							<li><a href="#"><i class="icon-phone"></i> +1 234 567 890</a></li>
							<li><a href="#"><i class="icon-mail2"></i> info@GetTemplates.co</a></li>
							<li><a href="#"><i class="icon-chat"></i> Live Chat</a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://GetTemplates.co/" target="_blank">GetTemplates.co</a> Demo Images: <a href="http://unsplash.com/" target="_blank">Unsplash</a></small>
					</p>
					
					
						<ul class="gtco-social-icons pull-right">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					
				</div>
			</div>

		</div>
	</footer>
	</div>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/sticky.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>
