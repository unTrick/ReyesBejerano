 
<!-- Modal -->
<div id="delete<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">

</div>
<div class="modal-body">
<p>Are you sure you want to delete this data?</p>
</div>
<div class="modal-footer">
<a href="delete_note.php<?php echo '?id='.$id;  ?>" class="btn btn-danger"><i class="icon-check icon-large"></i>&nbsp;YES</a>
<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;NO</button>
</div>
</div>