	<div id="edit<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-body">
			<div class="alert alert-info"><strong>Edit Note</strong></div>
	<form class="form-horizontal" method="post">
			<div class="control-group">
				<label class="control-label" for="inputPassword">Message</label>
				<div class="controls">
			<input type="text" name="note_id" value="<?php echo $row['note_id']; ?>">	
			<textarea name="message" rows="3"><?php echo $row['message']; ?></textarea>
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
				<button name="edit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Update</button>
				</div>
			</div>
    </form>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
		</div>
    </div>
	
	<?php
	if (isset($_POST['edit'])){
	
	$note_id=$_POST['note_id'];
	$message=$_POST['message'];

	
	mysqli_query($conn,"update note set message='$message' where note_id='$note_id'")or die(mysqli_error($conn)); ?>
	<script>
	window.location="note.php";
	</script>
	<?php
	}
	?>