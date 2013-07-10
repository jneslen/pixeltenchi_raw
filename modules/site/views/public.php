<?php
/**
 * @author jeffn
 * @date 03/20/2012
 * @brief
 *
 */
defined('SYSPATH') OR die('No direct access allowed.');
?>
<!DOCTYPE html>
<html lang="<?=\Helper::language()?>">
<head>
	<meta charset="utf-8" />
	<?php if($page_title != $title): ?>
	<?php $title_string = $title.' | '.$page_title; ?>
	<?php else: ?>
	<?php $title_string = $title; ?>
	<?php endif; ?>
	<title><?=substr($title_string, 0, 254)?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="<?=$description?>" />
	<meta name="keywords" content="<?=$keywords?>" />
	<meta name="author" content="Matrix42" />
	<link rel="shortcut icon" href="/assets/img/favicon.png" type="image/x-icon" />
	<script type="text/javascript" src="//use.typekit.net/dqk5yrb.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?=Request::$current->scripts()?>
	<?=Request::$current->styles()?>
	<!--[if lte IE 8]>
	<link href="/assets/css/stylesie6.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<?=$head_analytics->render()?>
</head>
<body>
<div class="wrapper">
	<?=$header?>
	<div class="container-fluid nav-pad">
		<div class="row-fluid padded-top">
			<div id="content" class="span12">
				<?=$content?>
			</div><!-- content -->
		</div><!-- row-fluid -->
	</div><!-- container -->
</div><!-- wrapper -->
<div id="footer">
	<?=$footer?>
</div><!-- footer -->
<?php if($modal): ?>
	<?=$modal?>
<?php endif; ?>
<!--[if lte IE 8]>
<script type="text/javascript" src="/assets/js/plugins/css3-mediaqueries.js"></script>
<![endif]-->
</body>
</html>