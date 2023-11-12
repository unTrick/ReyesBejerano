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
            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>                                 
                        <th>Gender</th>                                 
                        <th>Address</th>                                 
                        <th>Contact No</th>                                 
                        <th>Email Address</th>                                 
                                                    
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $user_query=mysqli_query($conn,"select * from members")or die(mysqli_error($conn));
                        while($row=mysqli_fetch_array($user_query)){
                            $id=$row['member_id']; ?>
                            <tr class="del<?php echo $id ?> row-link" data-href="<?php echo 'member_history.php?id='.$row['member_id'];?>">
                                <td width="100" class="table-link"><span><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?> </span></td> 
                                <td class="table-link"><?php echo $row['age']; ?></td> 
                                <td class="table-link"><?php echo $row['gender']; ?></td> 
                                <td class="table-link"><?php echo $row['address']; ?></td> 
                                <td class="table-link"><?php echo $row['contact_no']; ?></td> 
                                <td class="table-link"><?php echo $row['email']; ?></td> 
                                <td width="50" class="button-menu">
                                    <a rel="tooltip"  title="Delete" id="<?php echo $id; ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i></a>
                                </td>
                                <?php //include('toolttip_edit_delete.php'); ?>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready( function() {

        $(".table-link").on("click", function() {
            const rowLink = $(this).closest("tr");
            window.location = rowLink.data("href");
        });
        $('.btn-danger').click( function() {
            var id = $(this).attr("id");
            if(confirm("Are you sure you want to delete this Member?")){
                $.ajax({
                    type: "POST",
                    url: "delete_member.php",
                    data: ({id: id}),
                    cache: false,
                    success: function(html){
                    $(".del"+id).fadeOut('slow'); 
                    } 
                }); 
            }else{
                return false;}
        });				
    });
</script>
<?php include('footer.php') ?>