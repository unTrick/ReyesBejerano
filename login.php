<?php
    include('header.php');
    include('dbcon.php');
?>
<div class="container">
    <div class="content_box">
		<div class="left">
			<div class="contact">
				<form method="post" class="form-horizontal">
				    <h3><i class="icon-user"></i></h3>
                	<div class="control-group">
                		<div class="controls">
                		<input type="text" name="username"  placeholder="Username" required>
                		</div>
                	</div>
                	<div class="control-group">
                		<div class="controls">
                		<input type="password" name="password" placeholder="Password" required>
                		</div>
                	</div>
                	<div class="">
                	    <p style="color: red;">
                	        <?php
                                if(isset($_SESSION["wrongPasswordMessage"])){
                                    $error = $_SESSION["wrongPasswordMessage"];
                                    echo "<span>$error</span>";
                                }
                            ?>  
                	    </p>
                	</div>
                	<div class="control-group">
                		<div class="controls">
                		<button name="submit1" type="submit" class="submit"></i>Login</button>
                		</div>
                	</div>
                </form>
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
    var element = document.getElementById("login-page");
    element.classList.add("active");
    
    var element1 = document.getElementById("home-page");
    element1.classList.remove("active");
    var element2 = document.getElementById("services-page");
    element2.classList.remove("active");
    var element3 = document.getElementById("aboutus-page");
    element3.classList.remove("active");
    var element4 = document.getElementById("contactus-page");
    element4.classList.remove("active");
</script>

<?php
    if (isset($_POST['submit1'])){
    
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM members WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn,$query)or die(mysqli_error($conn));
        $num_row = mysqli_num_rows($result);
        $row=mysqli_fetch_array($result);
        
        function redirect($url) {
            if (!headers_sent())
            {    
                header('Location: '.$url);
                exit;
                }
            else
                {  
                echo '<script type="text/javascript">';
                echo 'window.location.href="'.$url.'";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
                echo '</noscript>'; exit;
            }
        }
        
        if( $num_row > 0 ) {		
            if(isset($_SESSION["wrongPasswordMessage"])){
                unset($_SESSION["wrongPasswordMessage"]);
            }
            $_SESSION['id']=$row['member_id'];
            redirect("dasboard.php");
        }
        else{
            $_SESSION['wrongPasswordMessage']="Please check your Username and Password";
            redirect("login.php");
        }
    }
?>