<div class="alert alert-info">
<thead>  

</thead>
<table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
                            
                            <thead>
                                <tr>
                                    <th>Service Offer</th>
                                    <th>Price</th>                                 
                                    </ul>	</div>
    
					    
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