<?php
	require_once('src/session.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Dev 101 - 2021 | Alt Tech</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Import CSS files -->
	<link rel="stylesheet" type="text/css" href="">
	
	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

	<!-- Import fontawesome for icons -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/brands.min.css" integrity="sha512-AMDXrE+qaoUHsd0DXQJr5dL4m5xmpkGLxXZQik2TvR2VCVKT/XRPQ4e/LTnwl84mCv+eFm92UG6ErWDtGM/Q5Q==" crossorigin="anonymous" />
	
    <!--Import JQuery-->
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>             
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
	
	<style> 
	</style>
</head>

<body>

<main role="main" id="main" style="background-color: #fefdfd; opacity: 100%;">
	<div class="container">
		<?php include('pages/top-nav.php'); ?>

		<!--#8CC63F primary color-->
		<br>
		    <?php require_once('src/routes.php'); ?>
		<br>
	</div>
</main>


<footer class="green">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-12 text-orane">
				<h5 class="orange-text">Contact</h5>
				<ul class="contact-info list-unstyled">
					<li><a href="mailto:altmedialab@gmail.com" class="text-dark">Mail Us</a></li>
					<li><a href="" class="text-dark">+0 123 456 789</a></li>
				</ul>
			</div>
			<div class="col m3 s12 text-orange">
				<h5 class="orange-text">Dev</h5>
				<ul class="contact-info list-unstyled">
					<Li><a href="#" class="text-dark">Websites</a></Li>
                    <Li><a href="#" class="text-dark">Web Apps</a></Li>
					<li><a href="#" class="text-dark">Mobile Apps</a></li>
				</ul>
			</div>
			<div class="col m3 s12 text-orange">
				<h5 class="orange-text">Alt tech</h5>
				<ul class="contact-info list-unstyled">
					<!--li><a href="#" class="text-dark">Our Story</a></li>
					<li><a href="#" class="text-dark">Our Vision</a></li-->
					<li><a href="#" class="text-dark">Mission</a></li>
					<li><a href="#" class="text-dark">Team</a></li>
				</ul>
            </div>
			<div class="col m3 s12 text-orange">
				<h5 class="orange-text">Social</h5>
				<ul class="list-unstyled">
					<a href="#" class="orange-text"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="orange-text"><i class="bi bi-github"></i></a>
					<a href="#" class="orange-text"><i class="bi bi-instagram"></i></a>
					<a href="#" class="orange-text"><i class="bi bi-twitter"></i></a>
				</ul>
			</div>
		</div>
	</div>

	<div class="footer-copyright orange container white-text">copyright &copy; Alt Tech. <span class=""><?php echo date("Y"); ?></span></li></div>
	</footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

	</body>
</html>
