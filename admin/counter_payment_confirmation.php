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
			<div class="full-grid" style="text-align: center;">
                <span style="font-size: xx-large;">Payment Successful</span>
            </div>
		</div>
	</div>
</div>

<?php include('footer.php') ?>