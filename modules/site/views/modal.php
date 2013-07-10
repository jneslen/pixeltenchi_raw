<div id="modal" class="modal fade hide">
	<div class="modal-header">
		<button class="close" data-dismiss="modal">x</button>
		<h3 id="modal-title"><?=$title?></h3>
		<h6 id="modal-subtitle"><?=$subtitle?></h6>
	</div><!-- modal-header -->
	<div class="modal-body" id="modal-body"><?=$content?></div>
	<div class="modal-footer">
		<?php if($type == 'form'): ?>
		<a href="#" class="btn btn-primary submit-button<?=$button_name == 'Close' ? ' close' : ''?>"<?=$button_name == 'Close' ? ' data-dismiss="modal"' : ''?>><?=__($button_name)?></a>
		<?php endif; ?>
	</div>
</div><!-- modal -->