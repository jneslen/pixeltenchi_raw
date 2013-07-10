<div id="options" class="well">
	<div id="filter-navbar" class="navbar left">
		<h4>category:</h4>
		<ul id="filter" class="nav">
			<li class="active"><a data-filter="*" href="#show-all">all</a></li>
			<?php foreach($categories as $category): ?>
			<li><a data-filter=".<?=$category?>" href="#<?=$category?>"><?=$category?></a></li>
			<?php endforeach; ?>
		</ul><!-- filter -->
	</div><!-- filter-navbar -->
	<h4>tags:</h4>
	<ul id="tag" class="tag-pills span4">
		<li class="active"><a data-tag="*" href="#show-all">all</a></li>
	<?php foreach($tags as $tag): ?>
		<li><a class="tag" style="background-color: #<?=$tag->color ? $tag->color : '222222'?>;" data-tag=".<?=$tag->name?>" href="#<?=$tag->name?>">@<?=$tag->name?></a></li>
	<?php endforeach; ?>
	</ul><!-- tag -->
	<div class="clear"></div>
</div><!-- options -->