<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('navbar_dasboard.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">
				
				<div class="span3">
					    <ul class="nav nav-tabs nav-stacked">
							<li class="active">
							
							</li>
					
						</ul>
						<p><strong>Today is:</strong></p>
				 <div class="alert alert-success">
                        <i class="icon-calendar icon-large"></i>
                        <?php
                        $Today = date('d:m:y');
                        $new = date('l, F d, Y', strtotime($Today));
                        echo $new;
                        ?>
                    </div>		
							<div class="alert alert-info">Time Guide for Each Number</div>
						<p>Number 1  - 9:30 - 10:00</p>
						<p>Number 2  - 10:00 - 10:30</p>
						<p>Number 3  - 10:30 - 11:00</p>
						<p>Number 4  - 11:30 - 12:00</p>
						<p>Number 5  - 12:30 - 1:00</p>
						
						<p>Number 6  - 3:00 - 3:30</p>
						<p>Number 7  - 3:30 - 4:00</p>
						<p>Number 8  - 4:30 - 5:00</p>
				
					
				<div class="alert alert-info">Office Hours</div>
					<p>Monday - Firday (9:30 am to 1:00 pm)</p>
						<p>Monday - Friday (3:00 pm to 5:00 pm)</p>
						<p>Room 312</p>
						<p>Saturday(half day)</p>
						<p>(9:30 pm to 1:00 pm)</p>
						<p>Dr. Pablo O Torre Memorial Hospital B.S Aquino Drive</p>
						<p>Bacolod City Negros Occidental</p>
					
					
					
					
				<div class="alert alert-info">Testimonial</div>
				<div class="testimonial_div">
					<p>
					ako badjao hindi sama tao hingi lang pera konti mga bente lang pang bili 13 pro maks po
					</p>
					</div>		
				</div>
				<div class="span6">
					<img src="img/dr.jpg">
					<br>
					<br>
					
				<div class="alert alert-info">My Schedule</div>
	
					<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
                            
                                <thead>
                                    <tr>
                                        <th>My Number</th>
                                        <th>Date</th>                                 
                                        <th>Service</th>                                 
                                        <th>Price</th>                                 
                              
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php $user_query=mysqli_query($conn,"select * from schedule where member_id = '$session_id' ")or die(mysqli_error($conn));
									while($row=mysqli_fetch_array($user_query)){
									$id=$row['id'];
									$member_id = $row['member_id'];
									$service_id = $row['service_id'];
									/* member query  */
									$member_query = mysqli_query($conn,"select * from members where member_id = ' $member_id'")or die(mysqli_error($conn));
									$member_row = mysqli_fetch_array($member_query);
									/* service query  */
									$service_query = mysqli_query($conn,"select * from service where service_id = '$service_id' ")or die(mysqli_error($conn));
									$service_row = mysqli_fetch_array($service_query);
									?>
									
									 <tr class="del<?php echo $id ?>">
									 <td width="100"><?php  echo $row['Number'];  ?></td>
                                    <td><?php  echo $row['date'];  ?></td> 
                                    <td><?php  echo $service_row['service_offer'];  ?></td> 
                                    <td><?php  echo $service_row['price'];  ?></td> 
                             
							
									</tr>
									<?php } ?>
                           
                                </tbody>
                            </table>


	
	
	
				</div>
				<div class="span3">
				
				<div class="alert alert-info">List of Services</div>
						<table class="table  table-bordered">
                            
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
									<?php } ?>
                           
                                </tbody>
                            </table>
				<div class="alert alert-info">Dra. Erly & Jel Guardamano</div>	
					<img  class="img img-polaroid" src="img/log.jpg">
				</div>
				
			</div>
		</div>
    </div>
<?php include('footer.php') ?>