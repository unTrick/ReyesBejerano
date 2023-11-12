<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>
<div class="container">
    <div class="row">
        <div class="sti"> 
            <img src="img/dr.png">
            <?php include('about_content.php'); ?>
        </div>
        <div class="span12">
            <?php include('content1.php'); ?>
        </div>
    </div>
</div>

<script>
    var element = document.getElementById("aboutus-page");
    element.classList.add("active");
    
    var element1 = document.getElementById("home-page");
    element1.classList.remove("active");
    var element2 = document.getElementById("services-page");
    element2.classList.remove("active");
    var element3 = document.getElementById("contactus-page");
    element3.classList.remove("active");
    var element4 = document.getElementById("login-page");
    element4.classList.remove("active");
</script>
