<?php include('header.php'); ?>
<!-- -->
      <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse collapse">
					<ul class="nav">
					<li><a rel="tooltip"  data-placement="bottom" title="Home" id="home" href="index.php" class=""></i>&nbsp;Home</a></li>
					<li><a rel="tooltip"  data-placement="bottom" title="Services" id="services" href="services.php" class=""></i>&nbsp;Services</a></li>
					<li><a rel="tooltip"  data-placement="bottom" title="About Us" id="aboutus" href="about.php" class=""></i>&nbsp;About Us</a></li>
					<li  class="active"><a rel="tooltip"  data-placement="bottom" title="Contact Us" id="contactus" href="contact_us.php" class=""></i>&nbsp;Contact US</a></li>
					
					
                 
                    </div>
                </div>
            </div>
        </div>
   
<!-- -->
<?php include('dbcon.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">
				<div class="span12">
			 <img src="img/dr.png">
				<div class="login_sign_up">
				<a rel="tooltip"  data-placement="left" title="Click Here to Login" id="login" href="login.php"  class="btn btn-info btn-large"><i class="icon-signin icon-large"></i>&nbsp;Login</a>
				<p><a rel="tooltip"  data-placement="bottom" title="Click Here to Sign UP" id="signup" href="signup.php">Not a Member? Sign Up Now</a></p>
				</div>
				<!--- login -->
				<?php include('contactus_content.php'); ?>
				<!-- end login -->
				</div>
				<div class="span12">
				</div>		
				<div class="clearfix"></div>
				<div class="span12">
					<?php include('thumbnail.php'); ?>
				</div>
				<div class="span12">
				<?php include('content1.php'); ?>
				</div>
				<div class="span12">
				<?php include('content2.php'); ?>	
				</div>
			</div>
		</div>
    </div>
<?php include('footer.php') ?>