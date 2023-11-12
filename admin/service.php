<?php include('header.php'); ?>
<?php include('session.php'); ?>
    <div class="container">

	<div class="row">	
        <div class="full-grid" style="text-align: center;">
            <img src="../img/dr.png" class="img-rounded">
        </div>
        <div class="span3">
            <?php include('sidebar.php'); ?>
        </div>
        <div class="span9">
            <?php include('navbar_dasboard.php') ?>
            <div class="full-grid" style="margin: 10px 0px;">
                <a href="add_service.php" role="button" class="btn btn-info" data-toggle="modal" style=""><i class="icon-plus icon-large"></i>&nbsp;Add Service</a>
            </div>
            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
                <thead>
                    <tr>
                        <th>Service Offer</th>
                        <th>Price</th>                                 
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $user_query=mysqli_query($conn,"select * from service")or die(mysqli_error($conn));
                        while($row=mysqli_fetch_array($user_query)){
                            $id=$row['service_id']; ?>

                            <tr class="del<?php echo $id ?>">
                                <td><?php echo $row['service_offer']; ?></td> 
                                <td><?php echo $row['price']; ?></td> 
                                <td width="100">
                                    <a rel="tooltip"  title="Delete" id="<?php echo $id; ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i></a>
                                    <a rel="tooltip"  title="Edit" id="e<?php echo $id; ?>" href="edit_service.php?id=<?php echo $id; ?>" data-toggle="modal" class="btn btn-success"><i class="icon-pencil icon-large"></i></a>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready( function() {

            // "example" is the table name according to the code above
            // use the table id as the event listener then assign the class name or id name
            // of the button you want to click.
            $("#example").on("click", ".btn-danger", function(){
                var id = $(this).attr("id");
                if(confirm("Are you sure you want to delete this Data?")){
                    $.ajax({
                        type: "POST",
                        url: "delete_service.php",
                        data: ({id: id}),
                        cache: false,
                        success: function(html){
                        $(".del"+id).fadeOut('slow'); 
                        } 
                    }); 
                }
                else{
                    return false;
                }
            });			
        });
    </script>
<?php include('footer.php') ?>