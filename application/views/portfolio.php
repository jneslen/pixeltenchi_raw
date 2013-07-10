<?=$filter_box?>
<div id="portfolio-container">
<?php foreach($creations as $creation): ?>
	<?php
		$classes = $creation->type;
		foreach($creation->tags as $tag)
		{
			$classes .= ' '.$tag->name;
		}
	?>
	<div class="item element <?=$classes?>">
		<a class="item-image" href="/portfolio/detail/<?=$creation->id?>" data-btn-func="close" data-toggle="modal" data-title="<?=$creation->title?>" data-subtitle="<?=$creation->subtitle?>">
			<img src="/assets/img/uploads/creations/thumbs/<?=$creation->thumbnail?>" alt="<?=$creation->title?>" />
			<div class="item-hover">
				<div class="item-hover-inner">
					<h4><?=$creation->type?></h4>
					<h6><div class="icon clock"></div><?=\Format::date($creation->creation_date, 'short')?></h6>
					<div class=item-tags">
					<?php foreach($creation->tags as $itag): ?>
						<div class="item-tag" style="background-color: #<?=$itag->color ? $itag->color : '222222'?>;">@<?=$itag->name?></div>
					<?php endforeach; ?>
					<div class="clear"></div>
					</div><!-- item-tags -->
				</div><!-- item-hover-inner -->
			</div><!-- item-hover -->
		</a>
		<div class="item-detail">
			<div class="item-title"><?=$creation->title?></div>
			<div class="item-subtitle"><?=$creation->subtitle?></div>
		</div><!-- item-detail -->
	</div><!-- item -->
<?php endforeach; ?>
</div><!-- container -->