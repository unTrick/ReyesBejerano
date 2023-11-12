<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<div class="container">
    <div class="content_box">
		<div class="left">
			<div class="contact">
				
			</div>
		</div>
		<div class="right">
			<div class="right-text">
				<h2>J&E GUARDAMANO</h2>
				<h5>DENTAL CLINIC</h5>
			</div>
			<div class="right-inductor"></div>
		</div>
	</div>
</div>

<script>
    var element = document.getElementById("home-page");
    element.classList.add("active");
    
    var element1 = document.getElementById("services-page");
    element1.classList.remove("active");
    var element2 = document.getElementById("aboutus-page");
    element2.classList.remove("active");
    var element3 = document.getElementById("contactus-page");
    element3.classList.remove("active");
    var element4 = document.getElementById("login-page");
    element4.classList.remove("active");
</script>
			