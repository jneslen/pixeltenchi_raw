<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>

<?php get_sidebar(); ?>

	</div>

	<div id="column_2">

		<div id="awheader_1">
		</div>

		<div id="awsubheader">
		<div id="description"><?php bloginfo('description'); ?></div>
		</div>

		<div id="content" class="widecolumn">

		<h2>Links:</h2>
		<ul>
		<?php wp_list_bookmarks(); ?>
		</ul>

		</div>

	</div>

<?php get_footer(); ?>
