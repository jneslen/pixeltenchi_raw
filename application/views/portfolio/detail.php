<div id="detail" class="row-fluid">
	<div id="detail-content" class="span8">
		<?=$creation->content?>
	</div><!-- detail-container -->
	<div class="span4">
		<div id="detail-sidebar" class="well">
			<h3><?=$creation->type?></h3>
			<h5><span class="icon clock"></span><?=\Format::date($creation->creation_date, 'short')?></h5>
		<?php if($creation->url): ?>
			<h5><a href="<?=$creation->url?>" target="_blank">Visit Site</a></h5>
		<?php endif; ?>
		<?php if($creation->download): ?>
			<h5><a href="<?=$creation->download?>" target="_blank">Download</a></h5>
		<?php endif; ?>
			<hr />
			<div class="item-tags">
			<?php foreach($creation->tags as $itag): ?>
				<div class="item-tag" style="background-color: #<?=$itag->color ? $itag->color : '222222'?>;">@<?=$itag->name?></div>
			<?php endforeach; ?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div><!-- row-fluid -->
<hr />
<div class="detail-comment">
	<h3>Comment:</h3>
	<?=$creation->markdown('comment')?>
</div>