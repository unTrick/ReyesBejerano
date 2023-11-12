<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<div class="container">
    <div class="content_box">
		<div class="left">
			<div class="contact">
				
			</div>
		</div>
		<div class="right" style="background: linear-gradient(212.38deg, rgba(192, 214, 223, 0.7) 0%, rgba(232, 218, 178) 100%)">
		    <div class="right-content">
		        <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>Service Offer</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $user_query=mysqli_query($conn,"select * from service")or die(mysqli_error($conn));
                        while($row=mysqli_fetch_array($user_query)){
                        $id=$row['service_id']; ?>
                        <tr class="del<?php echo $id ?>">
                            <td><?php echo $row['service_offer']; ?></td> 
                            <td><?php echo $row['price']; ?></td> 
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
		    </div>
		</div>
	</div>
</div>


<script>
    var element = document.getElementById("services-page");
    element.classList.add("active");
    
    var element1 = document.getElementById("home-page");
    element1.classList.remove("active");
    var element2 = document.getElementById("aboutus-page");
    element2.classList.remove("active");
    var element3 = document.getElementById("contactus-page");
    element3.classList.remove("active");
    var element4 = document.getElementById("login-page");
    element4.classList.remove("active");
</script>
