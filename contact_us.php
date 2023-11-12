<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>
<div class="container">
	<div class="row">
		<div class="sti">
		     <img src="img/dr.png">
			<div class="login_sign_up">
		
			</div>
			<!--- login -->
			<?php include('contactus_content.php'); ?>
			<!-- end login -->
		</div>
		<div class="span12">
			<?php include('content4.php'); ?>
			<?php include('content2.php'); ?>	
		</div>
	</div>
</div>

<script>
    var element = document.getElementById("contactus-page");
    element.classList.add("active");
    
    var element1 = document.getElementById("home-page");
    element1.classList.remove("active");
    var element2 = document.getElementById("services-page");
    element2.classList.remove("active");
    var element3 = document.getElementById("aboutus-page");
    element3.classList.remove("active");
    var element4 = document.getElementById("login-page");
    element4.classList.remove("active");
</script>
